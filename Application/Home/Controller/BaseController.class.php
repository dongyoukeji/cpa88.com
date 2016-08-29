<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
  	protected function _initialize(){
		header('Content-type:text/html;charset=utf-8;');
		set_time_limit(0); 
	}


    /**
     * 开始方法
     */
	public function index(){
		$this->display();
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

        $p = new \Think\Page($count, $pagination);
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

    protected function get_ajax_list($model = '', $map = '', $order = '', $pagination = '', $field = '*') {

        $model=!empty($model)?$model:M(CONTROLLER_NAME);

        $count = $model->where($map)->cache(true)->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');

        $p = new \Think\Page($count, $pagination);
        $p->setConfig('header', '<li class="rows">共%TOTAL_ROW%条记录&nbsp;当前%NOW_PAGE%页/共%TOTAL_PAGE%页</li>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last', '最后一页');
        $p->setConfig('first','第一页');
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $res = $model->where($map)->cache(true)->field($field)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();

        return array(
            'status'=>1,
            'count'=>$count,
            'list'=>$res,
            'page'=>$show
        );
    }

    /**
     * 修改密码
     */
    public function check_password(){
        if(IS_POST){

            $id =  session('mid');

            if(empty($id)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'还未登录,请登录修改'));
            }

            $member = M('member')->find($id);

            if(empty($member)){
                $this->ajaxReturn(array('status'=>1,'msg'=>'没有此用户'));
            }

            if($member['password'] != md5(I('post.old_pwd'))){
                $this->ajaxReturn(array('status'=>2,'msg'=>'原密码错误'));
            }

            if(I('post.new_pwd')!=I('post.cofrim_pwd')){
                $this->ajaxReturn(array('status'=>3,'msg'=>'两次输入密码不一样码错误'));
            }
            if(I('post.new_pwd')==I('post.old_pwd')){
                $this->ajaxReturn(array('status'=>4,'msg'=>'原来密码不能和新密码一致'));
            }

            $data=array(
                'id'=>$member['id'],
                'password'=>md5(I('post.new_pwd')),
            );

            if(!M('member')->save($data)){
                $this->ajaxReturn(array('status'=>5,'msg'=>'密码修改失败,请重试!'));
            }
            session('mid',null);
            session('mname',null);
            session('jifen',null);
            $this->ajaxReturn(array('status'=>6,'msg'=>'密码修改成功','redirect'=>U('/login')));
        }
    }


    public function com_list(){
        $map['com']=array('like',"%1%");
        $list = $this->getlist(M('product'),$map,'sort asc,id desc');

        $temps='';
//        foreach ($list as $v){
//            $temp = explode(',',$v['com']);
//            foreach ($temp as $j){
//                $temp1 = explode('_',$j);
//                if($temp1[1]==1){
//
//                    if($temp1[0]=='meiti')
//                        $temps .='富媒体/';
//                    else
//                        $temps .=$temp1[0].'/';
//                }
//            }
//            $v['com']=substr($temps,0,-1);
//            $_result[] = $v;
//        }
        foreach ($list as $v){
            $v['attr'] = str_replace('meiti','富媒体',$v['attr']);
            $v['price']=$this->_merge_attr($v['price']);
            $v['com']=$this->_merge_attr($v['com']);
            $v['balance_time']=$this->_merge_attr($v['balance_time'],1);
            $v['create_time']=date('Y-m-d',$v['create_time']);
            $v['service']=explode(',',$v['service']);
            $v['t'] =  ($v['type']==1)?'PC':'APP';
            $list1[] =$v;
        }

       $this->ajaxReturn(array(
           'status'=>1,
           'list'=>$list1
       ));
    }


    /**
     * 删除图片
     * @param $path 图片路径
     */
    protected function delImage($path){
    	$path=!empty($path)?$path:I('path');
    	
    	if(!empty($path)){
    		$id=I('id','',intval);
            $index=I('index','',intval);
            $result=M('Article')->find($id);

            $image=array_filter(explode(',', $result['image']));
            unset($image[$index]); 
            $image=implode(',', $image);
         
    		$data=array('id'=>$id,'image'=>$image);
    		$result=M('Article')->save($data);

    		if(!unlink('./Uploads/ueditor/'.$path) || !$result){
    			if(!$result){
    				echo 1;
    			}else{
    				echo 2;
    			}
    		}else{
    			echo 0;
    		}
    	}
    }

    /**
     * 删除文件
     * @param int $id
     */
    public function delFile($id=0){
        $id=$id?$id:I('id','',intval);
        $file=!empty($_POST['file'])?$_POST['file']:'';
       
        if(!unlink('./Uploads/file/'.$file)){  
            echo 0;
        }else{
            $data=array('id'=>$id,'file'=>'');
            $result=M('Article')->save($data);
            echo 1;
        }
    }
  	/**
  	* [_setDel 定时删除]
    * @param integer $time [间隔]
    * @param string  $model [模型]
    * @param string  $type [跨度]
  	*/
    protected function _setDel($time=10,$model='',$type='day'){	
        switch ($type) {
        	case 'day':
        		$after=time()- $time*24*60*60;
        		break;
        	case 'week':
        		$after=time()- $time*24*60*60*7;
        		break;
        	case 'hour':
        		$after=time()- $time*60*60;
        		break;
        	default:
        		$after=time()- $time*24*60*60;
        		break;
        }
        
        $name=!empty($model)?$model:$this->getActionName();
        $model=M($name);
        $where['create_time']=array('lt',$after);
        $result=$model->where($where)->delete(); 
        return $result;
    }

    /**
     * 获取参数信息
     * @param string $param 参数
     * @return string
     */
    protected function _param($param=''){
        if(empty($param)){
            foreach ($_REQUEST as $k => $v) {
                if($k!='_URL_'){
                    $param[$k]=$v;
                }
            }
        }
        return $param;
    }

    /**
     * 分拆属性
     * @param $attr
     * @return array
     */
    protected function _details($attr){

        $array= array(
            'CPA','CPS','CPC','CPM','meiti'
        );
        foreach ($attr as $k => $v){;
            if(in_array($v['t'],$array)){
                $attr1[]=$v['t'];
                $price[]=$v['t'].'_'.$v['price'];
                $type[]=$v['t'].'_'.$v['type'];
                $com[]=$v['com']?$v['t'].'_'.$v['com']:$v['t'].'_0';
            }
        }
        return array(
            'attr'=>$attr1,
            'price'=>$price,
            'time'=>$type,
            'com'=>$com,
        );
    }

    /**
     * 组合属性
     * @param $arr
     * @return array
     */
    protected function _merge($arr,$t=1){
        $a = explode(',',$arr['attr']);
        $b = explode(',',$arr['price']);
        $c = explode(',',$arr['com']);
        $d = explode(',',$arr['balance_time']);

        for($i=0;$i<count($a);$i++){

            $b1 = explode('_',$b[$i]);
            $c1 = explode('_',$c[$i]);
            $d1 = explode('_',$d[$i]);
            if($t){
                $temp[$a[$i]]=array(
                    't'=>   $a[$i],
                    'price'=>$b1[1],
                    'com'=>$c1[1],
                    'type'=>$d1[1]
                );
            }else{
                $temp[]=array(
                    't'=>   $a[$i],
                    'price'=>$b1[1],
                    'com'=>$c1[1],
                    'type'=>$d1[1]
                );
            }

        }

        $arr['service']=explode(',',$arr['service']);
        $arr['pro_attr']=$temp;

        return  $arr;
    }

    public function lists(){
        $map['status']=0;
        if(empty($_GET['cid'])){
            $map['cid']  = array('in','4,5,6');
        }else{
            $map['cid']  = array('in',I('get.cid'));
        }
        if(!empty($_GET['q'])){
            $map['title'] = array('like','%'.I('get.q').'%');
        }

        if(!empty($_GET['attr'])){
            $attr = explode(',',$_GET['attr']);

            foreach ($attr as $v){
                $map[$v] =1;
            }
        }

        $size = $_GET['sz']?I('get.sz'):5;
        $list = $this->get_ajax_list(M('article'),$map,'create_time desc',$size,"id,title,description,create_time");
        unset($list['page']);
        foreach ($list['list'] as $v){
            $content = htmlspecialchars_decode($v['description']);
            if($_GET['sp']!=0){
                $v['description']=substr($content,0,$_GET['sp']);
            }
            $v['create_time']=date('Y-m-d',$v['create_time']);
            $v['uri']=U('/notices/'.$v['id']);
            $list1[]=$v;
        }
        $list['list']=$list1;
        $this->ajaxReturn($list);
    }

    public function detail($id=0){
        if($id){
            $article =  M('article')->field('id,title,description,content,create_time')->find($id);
            $article['create_time']=date('Y-m-d',$article['create_time']);
            if(!empty($article)){
                $this->ajaxReturn(array('status'=>1,'content'=>$article));
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'没有数据'));
            }

        }
    }

    /**
     * 用户登出
     */
    public function logout(){
        session('mid',null);
        session('mname',null);
        session('jifen',null);
        $this->ajaxReturn(array('status'=>1,'msg'=>'退出成功','redirect'=>U('/')));
    }

    /**
     * 用户登录状态
     */
    public function is_login(){
        $mid = session('mid');
        if(empty($mid)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您还未登陆,请登录网站','redirect'=>U('/login')));
        }

        $username = M('member')->field('id,username,tel,type,email,real_name,jifen')->where(array("id"=>$mid))->find();
        //p($username);die;
        $username['ptype']='';
        if(empty($username)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您还未登陆,请登录网站','redirect'=>U('/login')));
        }
        $username['personal']=U('/private');
        $this->ajaxReturn(array('status'=>1,'data'=>$username));
    }

    /**
     * 用户支付方式
     */
    public function user_pay(){
        $mid = session('mid');
        if(empty($mid)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您还没有登录网站'));
        }
        $username = M('payway')->field('id,bank_type,bank_name,pay_account,pay_getname,pay_type')->where(array("mid"=>$mid,'pay_default'=>1))->find();

        if($username['bank_type']==0){
            $username['btype']="支付宝";
        }else{
            $username['btype']="网银";
            $bank = C('Bank');
            unset($bank[0]);
            $_result="";
            foreach ($bank as $k=>$v){
                if($k==$username['bank_type']){
                    $_result.="<option value='".$k."' selected=\"selected\">$v</option>";
                }else{
                    $_result.="<option value='".$k."'>$v</option>";
                }
            }
            $username['bank_select']=$_result;
        }

        if(empty($username)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您还没有设置支付方式'));
        }
        $this->ajaxReturn(array('status'=>1,'data'=>$username));
    }

    public function get_bank($t=0){
        $mid = session('mid');
        if(!$mid){
            $this->ajaxReturn(array('status'=>0,'data'=>'还没有登录'));
        }

        if(!$t){     //支付宝
            $_result = M('payway')->field('mid,create_time,bank_name',true)->where(array('mid'=>$mid,'pay_type'=>0))->find();
        }else{
            $_result = M('payway')->field('mid,create_time',true)->where(array('mid'=>$mid,'pay_type'=>1))->find();
         
            $bank = C('Bank');
            unset($bank[0]);
            $_result2="";
            foreach ($bank as $k=>$v){
                if($k==$_result['bank_type']){
                    $_result2.="<option value='".$k."' selected=\"selected\">$v</option>";
                }else{
                    $_result2.="<option value='".$k."'>$v</option>";
                }
            }
        }
        $_result1['last_pay']=$_result;
        $_result1['banks']=$_result2;
        $this->ajaxReturn(array('status'=>1,'data'=>$_result1));
    }

    /**
     * 获取产品列表
     */
    public function plist(){
        $map['status']=0;
        $order='sort desc';

        if(!empty($_GET['t'])){
            $map['type']=I('get.t');
        }
        if(!empty($_GET['tt'])){
            $map['attr'] = array('like','%'.I('get.tt').'%');
        }
        if(!empty($_GET['q'])){
            $map['title']=I('get.q');
        }

        $list = $this->get_ajax_list(M('product'),$map,$order,I('get.sz'),'id,title,desc,image,content,type,attr,price,com,balance_time,service,create_time');

        foreach ($list['list'] as $v){
            $v['attr'] = str_replace('meiti','富媒体',$v['attr']);
            $v['price']=$this->_merge_attr($v['price']);
            $v['com']=$this->_merge_attr($v['com']);
            $v['balance_time']=$this->_merge_attr($v['balance_time'],1);
            $v['create_time']=date('Y-m-d',$v['create_time']);
            $v['service']=explode(',',$v['service']);
            $list1[] =$v;
        }
        $list['list']=$list1;
        unset( $list['page']);
        $this->ajaxReturn($list);
    }

    protected function _merge_attr($arr, $t = 0) {
        $arr1 =  explode(',',$arr);
        $_result = '';
        foreach ($arr1 as $v){
            $temp =  explode('_',$v);

            if($t==1){
                if($temp[1]==1){
                    $_result .="日结/";
                }elseif ($temp[1]==2){
                    $_result .= "周结/";
                }else{
                    $_result .="月结/";
                }
            }else{
                $_result .= $temp[1].'/';
            }
        }
        return substr($_result,0,-1);
    }
    /**
     * 用户登录
     */
    public function user_login(){
        if(empty($_POST['code'])){
            $this->ajaxReturn(array('status'=>0,'msg'=>'验证码不能为空'));
        }
        $username = M('member')->field('id,username,password,email,real_name,jifen,status')->where(array("username"=>I('post.username')))->find();

        if(empty($username)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'用户名不存在'));
        }
        $pwd = md5(trim(I('post.password')));
        if($pwd!=$username['password']){
            $this->ajaxReturn(array('status'=>1,'msg'=>'密码错误'));
        }

        session('mid',$username['id'],3600*5);
        session('mname',$username['username'],3600*5);
        session('mtype',$username['type'],3600*5);
        $this->ajaxReturn(array('status'=>2,'data'=>$username,'redirect'=>U('/private')));
    }
    /**
     * 用户注册
     */
    public function register_handler(){

        $User = D("Member"); // 实例化User对象
        $pay = D('payway');
        $utype = ($_POST['puserType']==2)?1:0;
        $data = array(
            'username'=>I('post.username'),
            'password'=>I('post.password_md5'),
            'real_name'=>I('post.contacts'),
            'email'=>I('post.email'),
            'tel'=>I('post.phonenumber'),
            'type'=>$utype,
            'create_time'=>time(),
        );

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
            $data1['pay_account']=I('post.AliPayName');
            $data1['pay_getname']=I('post.AliGetMoney');
            $data1['pay_default']=1;
        }
        
        if (!$User->create($data)){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $this->ajaxReturn(array('status'=>0,'msg'=>$User->getError()));
        }
        if (!$pay->create($data1)){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $this->ajaxReturn(array('status'=>0,'msg'=>$pay->getError()));
        }
        $id = $User->add($data);
        if($id){
            $data1['mid']=$id;
            $pay->add($data1);
            $this->ajaxReturn(array('status'=>1,'msg'=>'恭喜您注册成功','redirect'=>U('/login')));
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'注册失败请重试','redirect'=>U('/register')));
        }
    }
    /**
     * 检查用户名是否存在
     */
    public function check_username(){
        $username= I('post.username');
        $user = M('member')->where(array('username'=>$username))->find();

        if(!empty($user)){
            $this->ajaxReturn(array('status'=>1,'msg'=>'用户名已存在'));
        }
        $this->ajaxReturn(array('status'=>0,'msg'=>'恭喜您可以注册'));
    }
    /**
     * 验证码
     */
    public function verify(){
        $verify = new \Think\Verify();
        //$verify->imageW=180;
        $verify->imageH=50;
        $verify->length   = 4;
        $verify->entry();
    }

    /**
     * 校验验证码
     * @param $code
     */
    public function check_code($code){
        if($this->check($code)){
            $this->ajaxReturn(array('status'=>1,'msg'=>'验证码输入正确'));
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'验证码输入错误'));
        }
    }

    /**
     * 验证码检查
     */
    protected function check($code, $id =""){
        $verify = new \Think\Verify();
        return $verify->check($code,$id);
    }

    public function kefu($qq=0){
        if(!$qq){
            exit('QQ号不能为空');
        }
        $url = 'http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes';
        header('Location:'.$url);
    }

    /**
     * 获取友情链接
     * @param int $l        长度
     * @param int $sort     排序
     */
    public function get_flink($l=10,$sort=0){
        if($sort){
            $sort='sort desc';
        }else{
            $sort='sort asc';
        }
        $list =  M('flink')->field('id,title,description,ico,uri')->where('status=0')->order($sort)->limit($l)->select();
        foreach ($list as $v){
            $v['ico'] ='/Uploads/'.$v['ico'];
            $list1[]=$v;
        }

        if(empty($list)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有添加友情链接'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'查询成功','list'=>$list1));
    }

    /**
     * 获取客服列表
     * @param int $lg       长度
     */
    public function get_kefu($lg=3){
        $list = M('kefu')->field('id,name,qq')->where('status=0')->limit($lg)->select();
        if(empty($list)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有可用的客服'));
        }
        foreach ($list as $v){
            $v['uri']=U('Public/kefu?qq='.$v['qq']);
            $list1[]=$v;
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'查询成功','list'=>$list1));
    }
    protected function _error(){
        header("HTTP/1.0 404 Not Found");
        $this->assign('home',C('DOMAIN'));
        $this->display("Common:404");
    }
}