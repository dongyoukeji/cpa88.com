<?php
namespace Home\Controller;
use Think\Controller;
class PrivateController extends BaseController {
    public function index()
    {
        $this->display('service');
    }

    public function service() {
        $this->display();
    }

    public function details(){
        $this->display();
    }

    public function login(){
        $this->display();
    }

    public function mlist(){
        $map['status']=0;
        $order='id desc';

        if(!empty($_GET['t'])){
            $map['cid']=I('get.t');
        }
        if(!empty($_GET['tt'])){
            $map['type'] = array('like','%'.I('get.tt').'%');
        }

        $map['mid']=session('mid');
        $list = $this->getlist(M('producted'),$map,$order,'cid,pid');
		
		
        foreach ($list as $k => $v){
			$temp = M('producted')->where(array('pid'=>$v['pid'],'mid'=>$v['mid']))->group('type')->select();
			foreach($temp as $t){
				$tt= M('packdata')->where(array('pid'=>$v['id'],'mid'=>$v['mid']))->order('time desc')->find();
				$t['last'] = $tt['time'];
				$ss1[$k][] =$t;
			}
            //$ss[] =M('producted')->where(array('pid'=>$v['pid'],'mid'=>$v['mid']))->group('type')->select();
			//$ss[] = M('producted')->where(array(''=>))->find();
        }
		
        //$this->date =  date('Y-m-d',strtotime("$nowtime -1 day"));
		
        $this->list = $ss1;
        $this->display();
    }

    public function detail(){
        $model=M('producted');
        $pro = $model->where(array('id'=>I('get.pid')))->find();
        $map['mid']=session('mid');
        $map['pid']=$pro['pid'];
        $map['status']=0;
        
        $this->ty= $list1 = $this->getlist(M('producted'),$map,$order,'type');

        if(empty($pro)){
            $this->_error();
        }
        
        $ss = $model->where(array('type'=>$pro['type'],'pid'=>$pro['pid'],'mid'=>$pro['mid'],'status'=>0))->select();

        $id="";
        $date="";
        $price="";
        foreach ($ss as $j){
            $id []= $j['id'];
            if($j['date']==1){
                $date .= '日结/';
            }else if($j['date']==2){
                $date .= '周结/';
            }else{
                $date .= '月结/';
            }

            $price .= $j['price'].'/';
            $pro['pack']= array(
                'id'=>$id,
                'date'=>substr($date,0,-1),
                'price'=>substr($price,0,-1)
            );
        }

        $pro['pack_list']=$ss;

        $this->pro=$pro;
        $map1['pid']=$pro['id'];
        $map1['mid']=$pro['mid'];
        $this->list =$list = $this->getlist(M('packdata'),$map1,'time desc','',15);
        
        $this->display();
    }

    /**
     * 下载打款截图
     * @param int $id
     */
    public function down_kuan($id=0){
        if($id){
           $data =  M('packdata')->find($id);

            if(empty($data)){
                $this->error('数据不存在');
            }
            if(empty($data['file_kuan'])){
                $this->error('打款截图不存在');
            }

            try{
                download($data['file_kuan']);
            }catch (\Exception $e){
                $this->error('数据不存在');
            }
        }
    }
    /**
     * 获取分页数据
     * @param type $model模型名(默认获取当前model)
     * @param type $map条件
     * @param type $order排序
     * @param type $field需要查询的字段，默认全部
     * @param type $pagination为每页显示的数量，默认为配置中的值
     * @return type返回结果数组
     */
    protected function getlist($model = '', $map = '', $order = '',$group = '', $pagination = '', $field = '*') {

        $model=!empty($model)?$model:M(CONTROLLER_NAME);

        $count = $model->where($map)->cache(true)->group($group)->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');

        $p = new \Think\Page($count, $pagination,array('url'=>'/details',$_GET['pid']?I('get.pid'):0));
        $p->setConfig('header', '<a class="rows">共 %TOTAL_ROW% 条记录&nbsp;当前 %NOW_PAGE% 页/共 %TOTAL_PAGE% 页</a>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last', '最后一页');
        $p->setConfig('first','第一页');
        $p->setConfig('theme', '%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');

        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $this->assign('page', $show);
        $res = $model->where($map)->cache(true)->field($field)->group($group)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();

        return $res;
    }
    /*
     * 下载截图
     */
    public function dimage($id=0){
        if(!$id){
            //exit('NO Product');
        }
        $proed = M('packdata')->find($id);
		//p($proed);die;
        if(!empty($proed['image'])){
            //下载图片
			try{
               download($proed['image']);
            }catch (\Exception $e){
                $this->error('数据不存在');
            }
        }
    }

    /**
     * 修改用户信息
     */
    public function user_check_info(){
        $data = array(
            'id'=>I('post.mid'),
            'real_name'=>I('post.username'),
            'email'=>I('post.email'),
            'tel'=>I('post.phonenumber'),
            'time'=>time()
        );
        $user =D('member');
        if(!$user->create($data)){
            $this->ajaxReturn(array('status'=>0,'msg'=>$user->getError()));
        }
        if(!$user->save($data)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败请重试','redirect'=>U('/private')));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'恭喜您修改成功','redirect'=>U('/private')));
    }

    /**
     * 修改支付信息
     */
    public function user_check_pay(){

        if($_POST['makeMoney']==3){
            $data1['pay_type']=1;
            $data1['bank_type']=I('post.accountIfor');                 //开户银行
            $data1['bank_name']=I('post.bankAddress');             //支行
            $data1['pay_account']=I('post.bankNumber');            //账户
            $data1['pay_getname']=I('post.getMoney');             //开户人
            $data1['pay_default']=1;
        }
        if($_POST['makeMoney']==2){
            $data1['pay_type']=0;
            $data1['pay_account']=I('post.AliMoney');
            $data1['pay_getname']=I('post.AliPayName');
            $data1['pay_default']=1;
        }

        $data1['create_time']=time();

        $is_in = M('payway')->where(array('pay_type'=>$data1['pay_type'],'mid'=>I('post.mid')))->find();
        //
        $user = D('payway');
        if(!$user->create($data1)){
            $this->ajaxReturn(array('status'=>0,'msg'=>$user->getError()));
        }
        M('payway')->where('mid='.I('post.mid'))->save(array('pay_default'=>0));
        if(empty($is_in)){         //不存在

            $data1['mid']=I('post.mid');

            if(!$user->add($data1)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败请重试','redirect'=>U('/private')));
            }
            $this->ajaxReturn(array('status'=>1,'msg'=>'恭喜您修改成功','redirect'=>U('/private')));
        }else{

            if(!$user->where(array('id'=>$is_in['id']))->save($data1)){

                $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败请重试','redirect'=>U('/private')));
            }

            $this->ajaxReturn(array('status'=>1,'msg'=>'恭喜您修改成功','redirect'=>U('/private')));
        }
    }

    public function user_product($mid=0){
        if($mid){
            $map['mid']=I('get.mid');
            if(!empty($_GET['t'])){
                $map['type']=I('get.t');
            }
            if(!empty($_GET['tt'])){
                $map['attr'] = array('like','%'.I('get.tt').'%');
            }
            if(!empty($_GET['q'])){
                $map['title']=I('get.q');
            }

            $order='id desc';
            $list = $this->getPageList(M('producted'),$map,$order);
            if(empty($list)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'尚未添加产品'));
            }
            foreach ($list as $v){
                if($v['cid']==1){
                    $v['ptype']='PC端';
                }
                if($v['cid']==2){
                    $v['ptype']='移动端';
                }
                $ss = M('producted')->where(array('type'=>$v['type']))->select();

                $id="";
                $date="";
                $price="";
                foreach ($ss as $j){
                    $id .= $j['id'].'/';
                    if($j['date']==1){
                        $date .= '日结/';
                    }else if($j['date']==2){
                        $date .= '周结/';
                    }else{
                        $date .= '月结/';
                    }

                    $price .= $j['price'].'/';
                    $v['pack']= array(
                        'id'=>substr($id,0,-1),
                        'date'=>substr($date,0,-1),
                        'price'=>substr($price,0,-1)
                    );
                }
                unset($v['mid']);
                unset($v['cid']);
                unset($v['pid']);
                $_result[] = $v;
            }
           $this->ajaxReturn(array('status'=>1,'list'=>$_result));
        }
    }

    public function in_res($id=0){
        if(!IS_POST){
            $this->ajaxReturn(array('status'=>0,'msg'=>'非法请求'));
        }
        if(!$id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
        }
        $packdata = M('producted')->find($id);

        if(empty($packdata['resource'])){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有下载资源'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'可以下载','redirect'=>U('down_res?id='.$id)));
    }
    public function down_res($id=0){
        $packdata = M('producted')->find($id);

        if(empty($packdata['resource'])){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有下载资源'));
        }
        try{
			download($packdata['resource']);
		}catch(\Exception $e){
			$this->_error();
		}
    }
    
    /**
     *
     * 导出Excel
     */
    public function export_excel($mid=0,$pid=0){//导出Excel
        $xlsModel = M('packdata');
        if(IS_GET){
            if(!$mid){
                $this->ajaxReturn(array('status'=>0,'msg'=>'没有登录'));
            }
            if(!$pid){
                $this->ajaxReturn(array('status'=>0,'msg'=>'参数出错'));
            }
            $xlsName  = "数据信息";
            $xlsData  = $xlsModel->Field('time,price,qudao,checked,total1,choushui,total,status')->where(array('mid'=>$mid,'pid'=>$pid))->order('time desc')->select();
            $xlsCell  = array(
                array('time','日期'),
                array('price','单价/元'),
                array('qudao','数据'),
                array('checked','核减数据'),
                array('total1','收益金额/元'),
                array('choushui','扣税金额/元'),
                array('total','结算金额/元'),
                array('status','结算状态'),
            );

            $pro = M('producted')->find($pid);
            $type = $pro['cid']==1?'PC':'APP';
            $header='      用户产品对账单:'.$pro['title'].'/'.$type.'/'.$pro['type'].'/'.session('mname').'   生成日期:'.date('Y-m-d',time());
            if(!empty($xlsData)){
                foreach ($xlsData as $k => $v) {
                    $xlsData[$k]['total1'] =( $v['total1']!=0)?$v['total1']:'-';
                    $xlsData[$k]['choushui'] =( $v['choushui']!=0)?$v['choushui']:'-';
                    $xlsData[$k]['total'] =( $v['total']!=0)?$v['total']:'-';
                    $xlsData[$k]['status']=($v['status']==1)?'已结算':'-';
                    $xlsData[$k]['time']=date('Y-m-d',$v['time']);
                }
                $this->exportExcel($xlsName,$xlsCell,$xlsData,$header);
            }
        }

        if(IS_POST){
           
            $xlsData  = $xlsModel->Field('time,price,qudao,checked,total1,choushui,total,status')->where(array('mid'=>$mid,'pid'=>$pid))->select();
            if(!empty($xlsData)){
               $this->ajaxReturn(array('status'=>1,'msg'=>'有导出数据','redirect'=>U('export_excel?mid='.$mid.'&pid='.$pid)));
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'没有包数据'));
            }
        }
    }

    /**
     * 导出Excel数据
     * @param $expTitle     string 文件名
     * @param $expCellName  array  表名称
     * @param $expTableData array  表数据
     * @param $header       string 表格标题
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    protected function exportExcel($expTitle,$expCellName,$expTableData,$header){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['mname'].date('_YmdHis_').'对账单';//or $xlsTitle 文件名称可根据自己情况设定

        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");

        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $header);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);


        //设置单元格
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(20);
        }
        //填充数据
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    

    protected function getPageList($model = '', $map = '', $order = '', $field = '*', $pagination = '') {
        $count = $model->where($map)->group('type,cid')->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');
        $page = new \Think\Page($count, $pagination);// 实例化上传类
        $page->setConfig('header', '');
        $page->setConfig('prev','上一页');
        $page->setConfig('next', '下一页');
        $show = $page->show();
        $this->assign('page', $show);
        $res = $model->where($map)->field($field)->limit($page->firstRow . ',' . $page->listRows)->order($order)->group('type,cid')->select();
        return $res;
    }

}