<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 
 */
class KefuController extends BaseController {
  	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
		//$this->kefu=C('Kefu');
		$map='';
		$this->list = $this->getlist(M('kefu'),$map,'id asc');
    	$this->display();
    }
	public function add($id=0){

		if($id){
			$this->kefu=$kefu = M('kefu')->find($id);
		}
		$this->display();
	}
	public function addhd(){
		if(!IS_POST){
			$this->ajaxReturn(array('status'=>0,'msg'=>'错误的请求'));
		}
		$data = $_POST;
		$data['time']=time();

		if(empty($data['id'])){
			if(!M('kefu')->add($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}else{
			if(!M('kefu')->save($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function del($id=0){
		if(!$id){
			$this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
		}
		if(!M('kefu')->delete($id)){
			$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function status($id=0,$t=0){
		if(!$id){
			$this->error('参数错误');
		}
		if(!M('kefu')->save(array('id'=>$id,'status'=>$t))){
			$this->error('操作失败');
		}
		$this->redirect('index');
	}
}