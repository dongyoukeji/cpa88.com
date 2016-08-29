<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/23
 * Time: 10:42
 */

namespace Home\Controller;
use Think\Controller;

class EmptyController extends BaseController{
    private $homepage='';
    public function _initialize(){
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->homepage=U('/');
    }

    public function index(){
        header("HTTP/1.0 404 Not Found");
        $this->assign('home',$this->homepage);
        $this->display("Common:404");
    }
    //注意 city方法 本身是 protected 方法
    protected function _empty(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->assign('home',$this->homepage);
        $this->display("Common:404");
    }

}