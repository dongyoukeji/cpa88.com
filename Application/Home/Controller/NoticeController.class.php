<?php
namespace Home\Controller;
use Think\Controller;
use Tool;

class NoticeController extends BaseController {
    public function index() {

        if(empty($_GET['cid'])){
            $map['cid']  = array('in','4,5,6');
        }else{
            $map['cid']  = array('in',I('get.cid'));
        }
        if(!empty($_GET['q'])){
            $map['title'] = array('like','%'.I('get.q').'%');
        }

        $list = $this->get_ajax_list(M('article'),$map,'create_time desc','',"id,cid,title,content,create_time");

        $this->list=$list['list'];
        $this->page=$list['page'];
        $this->display();
    }

    public function details($id=0){
        if($id){
            $this -> vo=$vo= M('article')->cache(true)->find($id);
            $this->cid=$vo['cid'];
          
            M('article')->save(array('hits'=>$vo['hits']+1,'id'=>$id));
            if(empty($vo)){
                $this->_error();
            }
            $this->pre=$pre=D('Article')->cache(true)->get_pre($id,$vo['cid']);
            $this->next=$next=D('Article')->cache(true)->get_next($id,$vo['cid']);
        }else{
            $this->_error();
        }
        $this->display();
    }
}