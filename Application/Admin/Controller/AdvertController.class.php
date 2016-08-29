<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 
 */
class AdvertController extends BaseController {
  	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
		$map='';
		$this->list = $this->getlist(M('Advert'),$map,'id asc');
    	$this->display();
    }
	public function add($id=0){
		if($id){
			$this->kefu=$kefu = M('Advert')->find($id);
		}
		$this->display();
	}
	public function addhd(){
		if(!IS_POST){
			$this->ajaxReturn(array('status'=>0,'msg'=>'错误的请求'));
		}
		$data = $_POST;
		if(!empty($_FILES)){
			$image = $this->upload();
			$path  = '/Uploads/'.$image['image']['savepath'].$image['image']['savename'];
			if(!empty($path)){
				$data['image']=$path;
			}
			unlink('./'.$data['image_old']);
		}else{
			$data['image']=$data['image_old'];
		}
		if(empty($data['id'])){
			$data['time']=time();
			if(!M('Advert')->add($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}else{
			$data['times']=time();
			if(!M('Advert')->save($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function del($id=0){
		if(!$id){
			$this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
		}
		$ad = M('Advert')->find($id);
		if(!M('Advert')->delete($ad['id'])){
			$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
		}
		unlink('./'.$ad['image']);
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function status($id=0,$t=0){
		if(!$id){
			$this->error('参数错误');
		}
		if(!M('Advert')->save(array('id'=>$id,'status'=>$t))){
			$this->error('操作失败');
		}
		$this->redirect('index');
	}
}