<?php

namespace Admin\Controller;
use Think\Controller;
/**
 * 登录操作
 * @author 魏巍
 *
 */
class FlinkController extends BaseController {

	public function index(){
        $this->list = $list = $this->getlist(M('flink'));
		$this->display();
	}

    public function add($id=0){
        if($id){
            $this->arc=$arc = M('flink')->find($id);
        }
       $this->display();
    }

    public function addhd(){
        $data=$_POST;
        if(!empty($_FILES)){
            $file =  $this->upload();
            $data['ico']=$file['file']['savepath'].$file['file']['savename'];
        }
        $data['date']=time();

       
       if(!empty($_POST['id'])){
           if(!M('flink')->save($data)){
               $this->ajaxReturn(array('status'=>0,'msg'=>'友情链接修改失败,请重试'));
           }
           $this->ajaxReturn(array('status'=>1,'msg'=>'友情链接修改成功','redirect'=>U('index')));
       }else{
           if(!M('flink')->add($data)){
               $this->ajaxReturn(array('status'=>0,'msg'=>'友情链接添加失败,请重试'));
           }
           $this->ajaxReturn(array('status'=>1,'msg'=>'友情链接添加成功','redirect'=>U('index')));
       }
    }

    public function delImage($id=0){

        if(!$id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败,参数错误'));
        }
        $arc = M('flink')->find($id);
        if(empty($arc['ico'])){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败,图片不存在'));
        }
        $path = './Uploads/'.$arc['ico'];

        if(!unlink($path)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败,文件不存在'));
        }
        M('flink')->save(array('id'=>$id,'ico'=>''));
        $this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));
    }

    public function status(){
        $data=array(
            'id'=>I('get.id'),
            'status'=>I('get.t'),
        );

        if(!M('flink')->save($data)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'操作失败'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'操作成功'));
    }
}
