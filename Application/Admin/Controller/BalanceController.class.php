<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 
 */
class BalanceController extends BaseController {
  	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
		$map=$this->_search();
		$map['total']=array('neq',0);
		$this->list=$list=$this->getlist(M('packdata'),$map,'time desc');
		$this->display();
    }
	public function check(){

		$this->pro = $list = M('packdata')->find(I('id'));
		$this->member =$member =M('member')->find(I('mid'));
		$pay = M('payway')->where(array('mid'=>$member['id'],'pay_default'=>1))->find();

		if($list['status']==1){		//已支付
			$p = explode(',',$list['pay_account']);
			if($pay['bank_type']==1){
				$pay['pay_type1']=$p[0];
				$pay['bank_type1']=$p[1];
				$pay['bank_name']=$p[2];
				$pay['pay_account']=$p[3];
				$pay['pay_getname']=$p[4];
			}else{
				$pay['pay_type1']=$p[0];
				$pay['pay_account']=$p[1];
				$pay['pay_getname']=$p[2];
			}
		}

		$this->pay  = $pay;

		$this->bank  = C('Bank');
		$id = $list['time'];
		$p = M('packdata')->query('SELECT * FROM `think_packdata` WHERE time < '.$id.' AND checked!="-" AND mid='.$member['id'].' AND pid='.$list['pid'].' ORDER BY time asc LIMIT 1');       //上一次核减

		if(!empty($p)){
			$start= $p[0]['time'];
			$lists = $this->getlist(M('packdata'),'time>'.$start.' and time <='.$id.' and pid='.$list['pid'].' and mid='.$member['id'],'time desc',15);			//M('packdata')->where('time>'.$start.' and time <='.$id.' and pid='.$list['pid'].' and mid='.$member['id'])->select();
		}else{

			$str = 'SELECT * FROM `think_packdata` WHERE time < '.$id.' AND checked="-" AND mid='.$member['id'].' AND pid='.$list['pid'].' ORDER BY time asc LIMIT 1';
			$p = M('packdata')->query($str);       //上一次核减
			if(empty($p)){
				$start = $_GET['id'];
			}else{
				$start= $p[0]['id'];
			}
			$lists = $this->getlist(M('packdata'),"time>=$start and time <=$id  AND pid=".$list['pid'].' and mid='.$member['id'],'time desc');
		}

		$this->list=$lists;
		$this->display();
	}

	/**
	 * 导出结算对账单
	 * @param int $id
	 * @param int $mid
	 * @param int $pid
	 */
	public function export($id=0,$mid=0,$pid=0){
		if($id!=0 && $mid!=0 && $pid!=0){
			$xlsModel = M('packdata');
			$list = M('packdata')->find(I('id'));
			$id = $list['time'];
			$p = M('packdata')->query('SELECT * FROM `think_packdata` WHERE time < '.$id.' AND checked!="-" AND mid='.$mid.' AND pid='.$pid.' ORDER BY time asc LIMIT 1');       //上一次核减

			if(!empty($p)){
				$start= $p[0]['time'];
				$xlsData = $xlsModel->field('time,sh_price,price,real,qudao,sh_checked,checked,total,sh_total,shouyi,status')->where('time>'.$start.' and time <='.$id.' and pid='.$pid.' and mid='.$mid)->select();
			}else{
				$str = 'SELECT * FROM `think_packdata` WHERE time < '.$id.' AND checked="-" AND mid='.$mid.' AND pid='.$pid.' ORDER BY time asc LIMIT 1';
				$p = M('packdata')->query($str);       //上一次核减

				if(empty($p)){
					$start = $_GET['id'];
				}else{
					$start= $p[0]['time'];
				}
				$xlsData = $xlsModel->field('time,sh_price,price,real,qudao,sh_checked,checked,total,sh_total,shouyi,status')->where("time>=$start and time<=$id and mid=$mid and pid=$pid")->select();
			}

			if(empty($xlsData)){
				$this->error('没有数据');
			}
			$xlsName  = "数据信息";
			$xlsCell  = array(
				array('time','日期'),
				array('sh_price','上家单价'),
				array('price','用户单价'),
				array('real','上家数据'),
				array('qudao','用户数据'),
				array('sh_checked','上家核减'),
				array('checked','用户核减'),
				array('total','支付金额/元'),
				array('sh_total','上家金额/元'),
				array('shouyi','收益金额/元'),
				array('status','结算状态'),
			);
		    $pro  =M('producted')->find($pid);
			$member  =M('member')->find($mid);
			$type = $pro['cid']==1?'PC':'APP';
			$header='      产品结算对账单(结算数据下载)：'.$pro['title'].'/'.$type.'/'.$pro['type'].'/'.$member['username'].'   生成日期：'.date('Y-m-d',time());

			if(!empty($xlsData)){
				foreach ($xlsData as $k => $v) {
					$xlsData[$k]['status']=($v['status']==1)?'已结算':'-';
					$xlsData[$k]['time']=date('Y-m-d',$v['time']);
				}
				$this->exportExcel($xlsName,$xlsCell,$xlsData,$header);
			}
		}else{
			exit('参数错误');
		}
	}

	public function add(){
		$file = $this->upload();
		$path  = './Uploads/'.$file['file_kuan']['savepath'].$file['file_kuan']['savename'];
		$image = new \Think\Image(); 
		$image->open($path)->text('CPA88.COM广告联盟','./Data/Font/simhei.ttf',25,'#ffffff',\Think\Image::IMAGE_WATER_SOUTHEAST)->save($path); 
		//获取账单
		$d = M('packdata')->field('id,mid,total,pay,des,time,status')->find(I('post.id'));
		$data=array(
			'id'=>$d['id'],
			'pay_account'=>trim_all(I('post.pay_account')),
			'pay'=>I('post.pay_pay'),
			'status'=>1,
			'des'=>I('post.des'),
			'file_kuan'=>$path,
			'times'=>time()
		);

		//积分兑换比例
		$_jifen=C('JI_FEN');
		$jifen  =round($d['total']/$_jifen);
		if($jifen<0){
			$jifen=0;
		}
		//更新用户数据
		$_sql='UPDATE `think_member` SET `banlace`= banlace+'.$d['total'].',`jifen`=jifen+'.$jifen.',`time`='.time().' WHERE `id`='.$d['mid'];
		if($d['status']==1){
			$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败,已经支付'));
		}

		if(!M('packdata')->save($data)){
			$this->ajaxReturn(array('status'=>0,'msg'=>'支付操作失败,请重试'));
		}else{
			//更新积分用户提取总额
			if(!M('member')->execute($_sql)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'积分获取操作,失败请重试'));
			}
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功'));
	}

	/**
	 * @return array
	 */
	protected function _search() {
		$map = array();
		$username = I('get.username','', 'trim');
		if($username){
			$user = M('member')->field('id')->where(array('username'=>array('like','%'.$username.'%')))->select();
			$_res = '';
			foreach ($user as $v){
				$_res.=$v['id'].',';
			}
			if($user){
				$map['mid']=substr($_res,0,-1);
			}
		}
		//状态（正常，禁用）
		if ($_GET['status'] == -1 || $_GET['status'] == null) {
			$status = '';
		} else {
			$status = intval($_GET['status']);
			$map['status'] = array('eq', $status);
		}
		//输出
		$this->assign('search', array(
			'name' => $username,
			'status' => $status,
		));

		return $map;
	}
}