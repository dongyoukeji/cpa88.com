<?php
/**
 * Created by PhpStorm.
 * User: dongyou02
 * Date: 2016/4/28
 * Time: 15:39
 */

namespace Admin\Controller;


class ProductController extends  BaseController{
    public function _initialize(){
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 产品列表
     */
    public function index(){
        $map=$this->_search();
        //排序
        $ordermap = 'sort asc,status asc';
        $this->list=$list=$this->getlist(M('product'),$map,$ordermap);
        $this->col=$col=M('column')->field('id,title')->where('fid=0 and id!=3')->select();
        $this->display();
    }

    public function add(){
        $this->col=$col=M('column')->field('id,title')->where('fid=0 and id!=3')->select();
        $this->kefu=$kefu = M('kefu')->where('status=0')->select();
        $this->display();
    }

    public function addhd(){

        if(IS_POST){
            $_data = $this->_details(I('post.pro_attr'));
            $product = array(
                'title'=>I('post.pro_name'),
                'content'=>I('post.pro_content'),
                'image'=>I('post.pro_image'),
                'type'=>I('post.pro_type'),
                'attr'=>implode(',',$_data['attr']),
                'price'=>implode(',',$_data['price']),
                'sh_price'=>implode(',',$_data['sh_price']),
                'com'=>implode(',',$_data['com']),
                'balance_time'=>implode(',',$_data['time']),
                'service'=>implode(',',I('post.server')),
                'sort'=>I('post.sort'),
                'status'=>$_POST['status']?I('post.status'):0,
                'create_time'=>time()
            );

            if(!M('product')->add($product)){
                //$this->error('产品添加失败');
                $this->ajaxReturn(array('status'=>0,'msg'=>'产品添加失败'));
            }
            //$this->success('产品添加成功','index');
            $this->ajaxReturn(array('status'=>1,'msg'=>'产品添加成功'));
        }
    }
    public function edit(){
        $id=I('get.pid',intval);
        $pro = M('product')->find($id);
        $this-> pro =$pro = $this->_merge($pro);
        $this->col=$col=M('column')->field('id,title')->where('fid=0 and id!=3')->select();
        $this->kefu=$kefu = M('kefu')->where('status=0')->select();
        $this->display();
    }

    public function edithd(){
        if(IS_POST){
            $_data = $this->_details(I('post.pro_attr'));
            $product = array(
                'id'=>I('post.id'),
                'title'=>I('post.pro_name'),
                'content'=>I('post.pro_content'),
                'image'=>I('post.pro_image'),
                'type'=>I('post.pro_type'),
                'attr'=>implode(',',$_data['attr']),
                'price'=>implode(',',$_data['price']),
                'sh_price'=>implode(',',$_data['sh_price']),
                'com'=>implode(',',$_data['com']),
                'balance_time'=>implode(',',$_data['time']),
                'service'=>implode(',',I('post.server')),
                'sort'=>I('post.sort'),
                'status'=>$_POST['status']?I('post.status'):0,
                'revise_time'=>time()
            );
            
            if(!M('product')->save($product)){
                //$this->error('修改失败');
                $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败'));
            }
            //$this->success('修改成功','index');
            $this->ajaxReturn(array('status'=>1,'msg'=>'修改成功'));
        }
    }

    /**
     * 修改状态
     */
    public function  status(){
        $data = array('id'=>I('get.pid'),'status'=>I('get.t'));
       if(!M('product')->save($data)){
           $this->error('操作失败请重试');
       }
        $this->redirect('index');
    }

    /**
     * 删除产品
     */
    public function del(){
        $id = I('get.pid',intval);
        $delobj =M('product')->find($id);
        if(!M('product')->delete($id)){
            if(!empty($delobj['image'])){
                unlink($delobj['image']);
            }
            $this->ajaxReturn(array('status'=>0,'msg'=>'产品删除失败，请重试'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'产品删除成功'));
    }
}