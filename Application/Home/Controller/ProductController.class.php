<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function index() {
        $map['status']=0;
        $order='sort asc';
      
        if(!empty($_GET['t'])){
            $map['type']=I('get.t');
        }
        if(!empty($_GET['tt'])){
            $map['attr'] = array('like','%'.I('get.tt').'%');
        }
        if(!empty($_GET['q'])){
            $map['title']=array('like','%'.$_GET['q'].'%');
        }

        $list = $this->getlist(M('product'),$map,$order,'',12,'id,title,desc,image,content,type,attr,price,com,balance_time,service,create_time');

        foreach ($list as $v){
            $v['attr'] = str_replace(',','/',str_replace('meiti','富媒体',$v['attr']));
            $v['price']=$this->_merge_attr($v['price']);
            $v['com']=$this->_merge_attr($v['com']);
            $v['balance_time']=$this->_merge_attr($v['balance_time'],1);
            $v['create_time']=date('Y-m-d',$v['create_time']);
            $v['service']=explode(',',$v['service']);
            $list1[] =$v;
        }

        $this->list =$list1;
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

        $p = new \Think\Page($count, $pagination,array('url'=>'/product',$_GET['t']?I('get.t'):0,$_GET['tt']?I('get.tt'):0,$_GET['q']?I('get.q'):'0'));
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

    /**
     * 产品详细
     * @param int $id
     */
    public function details($id=0) {

        if($id){
            $product = M('product')->field('id,title,desc,image,content,type,attr,price,com,balance_time,service,create_time')->find($id);
            if(!empty($product)){
                $product['attr'] = str_replace(',','/',str_replace('meiti','富媒体',$product['attr']));
                $product['price']=$this->_merge_attr($product['price']);
                $product['com']=$this->_merge_attr($product['com']);
                $product['balance_time']=$this->_merge_attr($product['balance_time'],1);
                $product['create_time']=date('Y-m-d',$product['create_time']);
                $product['service']=explode(',',$product['service']);
                $this->vo=$product;
                $this->kefu =$kefu= M('kefu')->where('status=0')->select();       // C('Kefu')
                $this->display();
            }else{
                $this->_error();
            }
        }else{
            $this->_error();
        }
    }

    /**
     * 产品详细
     * @param int $id
     */
    public function detail($id=0) {
        if($id){
            $product = M('product')->field('id,title,desc,image,content,type,attr,price,com,balance_time,service,create_time')->find($id);
            if(!empty($product)){

                $product['attr'] = str_replace('meiti','富媒体',$product['attr']);
                $product['price']=$this->_merge_attr($product['price']);
                $product['com']=$this->_merge_attr($product['com']);
                $product['balance_time']=$this->_merge_attr($product['balance_time'],1);
                $product['create_time']=date('Y-m-d',$product['create_time']);
                $product['service']=explode(',',$product['service']);

                $this->ajaxReturn(array('status'=>1,'content'=>$product));
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'没有查到数据'));
            }


        }
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

}