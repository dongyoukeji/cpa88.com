<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index() {
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
//        if(!empty($_GET['com'])){
//            $map['com']=I('get.q');
//        }
        $list = $this->get_ajax_list(M('product'),$map,$order,I('get.sz'),'id,title,desc,image,type,attr,price,com,balance_time,service,create_time');

        foreach ($list['list'] as $v){

            //$v['attr'] = str_replace(',','/',str_replace('meiti','富媒体',$v['attr']));
//            $v['price']=$this->_merge_attr($v['price']);
//            $v['com']=$this->_merge_attr($v['com']);
//            $v['balance_time']=$this->_merge_attr($v['balance_time'],1);
            //$v['create_time']=date('Y-m-d',$v['create_time']);
            //$v['service']=explode(',',$v['service']);

            $list1[] = $this->split_pro($v);
        }

        unset( $list['page']);

        foreach ($list1 as $v){
           if(count($v)>1){
                foreach ($v as $j){
                    $j['url']=U('/product/'.$j['id']);
                    $t[]=$j;
                }
           }else{
               $v[0]['url']=U('/product/'.$v[0]['id']);
               $t[]=$v[0];
           }
        }
       
        $this->display();
    }
    public function login(){
        $this->display('Private/login');
    }
    public function register(){
        $this->display('Private/register');
    }
    
    public function com_list(){
        $map['com']=array('like',"%1%");
        $map['status']=0;
        $list = $this->getlist(M('product'),$map,'sort asc,id asc');
        foreach ($list as $v){
           $list1[] = $this->split_pro($v);;
        }
        $i=0;
        foreach ($list1 as $v){
            if($i<10){
                if(count($v)>1){
                    foreach ($v as $j){
                        if($j['com']==1){
                            $j['image'] = str_replace('/web',__APP__,$j['image']);
                            $j['url'] =U('pro_details/'.$j['id']);
                            $t[]=$j;
                        }

                    }
                }else{
                    if($v[0]['com']==1){
                        $v[0]['image'] = str_replace('/web',__APP__,$v[0]['image']);
                        $v[0]['url']=U('/pro_details/'.$v[0]['id']);
                        $t[]=$v[0];
                    }
                }
            }
            $i++;
        }

        $this->ajaxReturn(array(
            'status'=>1,
            'list'=>$t
        ));
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

    protected function split_pro($pro){
        $pri = explode(',',$pro['price']);
        $com = explode(',',$pro['com']);

        for ($i=0;$i<count($com);$i++ ){
            $temp = explode('_',$com[$i]);
            $tps= explode('_',$pri[$i]);

            $temps[] = array(
                'id'=>$pro['id'],
                'title'=>$pro['title'],
                'ptype'=>($temp[0]=='meiti')?'富媒体':$temp[0],
                'price'=>$tps[1],
                'com'=>$temp[1],
                'image'=>$pro['image'],
                'type'=>($pro['type']==1)?'PC':'APP',
                'balance_time'=>get_fangshi1($pro['balance_time'])
            );
        }

        return $temps;
    }
}