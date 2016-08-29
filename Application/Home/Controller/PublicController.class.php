<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends BaseController {

    public function flink($size=12){
        $m  =  M('flink');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $m->page($_GET['p'].','.$size)->select();
        $count      = $m->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$size);// 实例化分页类 传入总记录数和每页显示的记录数
        //$show       = $Page->show();// 分页显示输出

        if(empty($list)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有查到相关数据'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>$list));
    }

}