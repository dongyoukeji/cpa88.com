<?php
namespace Admin\Controller;
use Think\Controller;

class MemberController extends BaseController {
    /**
     * 列表
     */
    public function index(){
        $map=$this->_search();
        $map['status']=0;
        //排序
        $ordermap = 'create_time desc';
        $this->list=$this->getlist(M('member'),$map,$ordermap);
        $this->display();
    }

    public function see(){
        $id=I('get.mid',intval);
        $this->member = $member = M('member')->find($id);
        $this->payway = $payway =M('payway')->where(array('mid'=>$id,'pay_default'=>1))->select();
       
        $bank  =C('Bank');
        unset($bank[0]);
        $this->bank =$bank;
        $this->display();
    }

    public function see_info(){
        if(IS_POST){
            $id =$_POST['pay']['id'];
            if($_POST['pay']['payway']==1){
                $data=array(
                    'bank_type'=>$_POST['pay']['bank'],
                    'pay_type'=>$_POST['pay']['payway'],
                    'bank_name'=>$_POST['pay']['bank_name'],
                    'pay_account'=>$_POST['pay']['pay_account'],
                    'pay_getname'=>$_POST['pay']['pay_getname'],
                    'create_time'=>time()
                );

            }else{
                $data=array(
                    'bank_type'=>$_POST['pay']['bank'],
                    'pay_type'=>$_POST['pay']['payway'],
                    'bank_name'=>$_POST['pay']['bank_name'],
                    'pay_account'=>$_POST['pay']['pay_account1'],
                    'pay_getname'=>$_POST['pay']['pay_getname1'],
                    'create_time'=>time()
                );
            }

            M('member')->where('id='.I('post.mid'))->save(array(
                'email'=>I('post.email'),
                'tel'=>I('post.tel'),
                'real_name'=>I('post.real_name'),
            ));
            if(!M('payway')->where('id='.$id)->save($data)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败'));
            }

            $this->ajaxReturn(array('status'=>1,'msg'=>'修改成功'));
        }
    }

    public function plist(){
        $map=$this->_search();
        $model=M('producted');
        $map['mid']=I('get.mid');
        $map['status']=0;

        $count = $model->where($map)->group('pid,type')->count('*');
        $pagination =  C('PAGE_SIZE');
        $p = new \Think\Page($count, $pagination);
        $p->setConfig('header', '<li class="rows">共%TOTAL_ROW%条记录&nbsp;当前%NOW_PAGE%页/共%TOTAL_PAGE%页</li>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last', '最后一页');
        $p->setConfig('first','第一页');
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $this->assign('page', $show);
        $res = $model->where($map)->limit($p->firstRow . ',' . $p->listRows)->order('id asc')->group('pid,type')->select();
        $_result=array();

        foreach ($res as $v){
            if($v['status']!=1){
                $ss = $model->where(array('type'=>$v['type'],'mid'=>I('get.mid'),'pid'=>$v['pid'],'status'=>0))->select();
            }

            $id="";
            $date="";
            $price="";
            $title='';
            foreach ($ss as $j){
                $id .= $j['id'].'/';
                $date .= $j['date'].'/';
                $price .= $j['price'].'/';
                $title .= $j['title'].'/';
                $v['pack']= array(
                    'id'=>substr($id,0,-1),
                    'date'=>substr($date,0,-1),
                    'price'=>substr($price,0,-1),
                    'title'=>substr($title,0,-1)
                );
            }
            $_result[] = $v;
        }

        $this->list=$_result;
        $this->display();
    }

    public function ckeck(){
        $pid = I('get.id');
        $pro = M('producted')->find($pid);
        $map1=array('type'=>$pro['type'],'mid'=>I('get.mid'),'pid'=>$pro['pid']);
        $map1['status']=0;
        $ss =  M('producted')->where($map1)->select();
        $lastpro =  M('producted')->query('SELECT * FROM `think_packdata` WHERE pid='.$pid.' AND mid='.I('mid').' ORDER BY time DESC LIMIT 1');

        if(!empty($lastpro[0])){
            $pro['price']=$lastpro[0]['price'];
            $pro['sh_price']=$lastpro[0]['sh_price'];
        }

        $this->shui = C('SHUI');
        $pro['pack_list']=$ss;
        $pro['ids']=explode('/',$pro['pack']['id']);

        $map['pid']=$pid;
        $map['mid']=I('mid');

        $member= M('member')->find(I('mid'));
        $this->member_type=$member['type'];         //0个人，11企业
        //排序
        $ordermap = 'time desc';
        $this->list=$list=$this->getlist(M('packdata'),$map,$ordermap,25);

        $this->pro = $pro;
        $this->display();
    }

    public function package(){
        $date= date('Y-m-d',time());
        if(!empty($_FILES)){
            $files = $this->upload();
        }


        $p= M('packdata')->where('time>'.strtotime($_POST['date']).' and checked!="-" and pid='.I('post.pid').' and mid='.I('mid'))->order('time asc')->find();
        if(!empty($p)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'处在核减周期内,不能再次核减'));
        }

//        if(empty($_POST['data_id']) && strtotime($_POST['date']) < strtotime($date)){
//            $this->ajaxReturn(array('status'=>0,'msg'=>'没有记录'));
//        }

        $mid=I('post.mid');

        if(!empty($files['file1']['savename'])){        //下载资源上传了
            $url ='./Uploads/'.$files['file1']['savepath'].$files['file1']['savename'];
            $tt = $data['download']=1;
        }else{
            $tt =  $data['download']=0;
            $url =I('post.url');
        }
        if(!empty($files['file']['savename'])){
            $image ='./Uploads/'.$files['file']['savepath'].$files['file']['savename'];
        }else{
            $image ='';
        }
        $str = strtotime(I('post.date'));
        $_map['time']=$str;
        $_map['pid']=I('post.pid');
        $_map['mid']=I('post.mid');


        $datas = M('packdata')->where($_map)->select();

        if(!empty($datas) && $_POST['data_insert']!=1){
            $this->ajaxReturn(array('status'=>0,'msg'=>'日期数据已存在'));
        }
        $data_desc=array(
            'id'=>I('post.pid'),
            'des'=>I('post.desc')
        );

        $data = array(
            'mid'=>I('post.mid'),
            'pid'=>I('post.pid'),
            'time'=>strtotime(I('post.date')),
            'price'=>I('post.price'),
            'sh_price'=>I('post.sh_price'),
            'real'=>I('post.real'),
            'qudao'=>I('post.qudao'),
            'checked'=>($_POST['ckeck']==='')?'-':$_POST['ckeck'],
            'sh_checked'=>($_POST['sh_ckeck']==='')?'-':$_POST['sh_ckeck'],
            'image'=>$image,
            'url'=>$url,
            'des'=>I('post.desc')
        );

        $producted = M('producted')->find(I('post.pid'));

        if($producted['resource']!=$url){  //资源变动
            M('producted')->save(array(
                'id'=>I('post.pid'),
                'resource'=>$url,
                'download'=>$tt
            ));
        }
        //插入包说明
        if(!empty($data_desc['des'])){
            M('producted')->save($data_desc);
        }
        if(!D('packdata')->create($data)){
            $this->ajaxReturn(array('status'=>0,'msg'=>D('packdata')->getError()));
        }

        //修改
        if($_POST['data_insert']==1){
            $data['id']=I('post.data_id');
            $id =  $data['id'];
            $data['times']=time();
            if(!D('packdata')->save($data)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请重试'));
            }
        }else{//添加
            if(!$id = D('packdata')->add($data)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请重试'));
            }
        }


        //上家核减
        if($_POST['sh_ckeck']!==''){
            $ckeck=$_POST['sh_ckeck']?$_POST['sh_ckeck']:0;
            $this->jiesuan1($id,$mid,I('post.sh_price'),$ckeck,I('post.sh_shui'));
        }
        if($_POST['ckeck']!==''){
            $ckeck=$_POST['ckeck']?$_POST['ckeck']:0;
            $this->jiesuan($id,$mid,I('post.price'),$ckeck,I('post.shui'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'操作操作成功'));
    }

    public function check_data(){

        $data['id'] = I('post.id');
        $data[I('post.t')] = I('post.val');
        $data['times']=time();
        $temps = M('packdata')->find($data['id']);


        if(!M('packdata')->save($data)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'修改操作失败'));
        }
        $member = M('member')->find($temps['mid']);

        if($member['type']==0){     //个人
            $shui = C('SHUI');
        }else{
            $shui=0;
        }

        //用户核减
        if(I('post.t')=='checked'){
            if(I('post.t')=='checked'){
                $this->jiesuan($temps['id'],$temps['mid'],$temps['price'],I('post.val'),$shui);
            }
        }
        if(I('post.t')!='checked' && $temps['checked']!='-'){
            $this->jiesuan($temps['id'],$temps['mid'],$temps['price'],$temps['checked'],$shui);
        }

        //上家核减
        if(I('post.t')=='sh_checked'){
            if(I('post.t')=='sh_checked'){  //修改核减操作
                $this->jiesuan1($temps['id'],$temps['mid'],$temps['sh_price'],I('post.val'),I('post.sh_shui'));
            }
        }
        if(I('post.t')!='sh_checked' && $temps['sh_checked']!='-' ){
            if($temps['sh_checked']!='-'){   //修改其他数据
                $this->jiesuan1($temps['id'],$temps['mid'],$temps['sh_price'],$temps['sh_checked'],$temps['sh_type']);
            }
        }
        unset($data['time']);
        $this->ajaxReturn(array('status'=>1,'msg'=>'修改操作成功','data'=>$data));
    }


    public function check_packname(){
        $_result = M('producted')->where(array('pid'=>I('post.pid'),'title'=>I('post.title'),'cid'=>I('post.cid'),'mid'=>I('post.mid'),'status'=>0))->find();
        if(!empty($_result)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'包名已经存在'));
        }else{
            $this->ajaxReturn(array('status'=>1,'msg'=>'包名可以使用'));
        }
    }


    /**
     * 用户结算
     * @param $id
     * @param $mid
     * @param int $price
     * @param int $ckeck
     * @param int $shui
     */
    protected function jiesuan($id,$mid,$price=0,$ckeck=0,$shui=0){
        $cont = M('packdata')->where('`mid`='.$mid.' AND pid='.I('post.pid'))->count();
        if($cont==1){
            $p = M('packdata')->field('id,total,total1,time')->find($id);
        }else{
            $p = M('packdata')->field('time')->query('SELECT * FROM `think_packdata` WHERE time < '.strtotime($_POST['date']).' AND checked!="-" AND `mid`='.$mid.' AND pid='.I('post.pid').' ORDER BY time DESC LIMIT 1');
        }

        if(!empty($p) && $cont>1){
            $start= $p[0]['time'];
            $real_sum = M('packdata')->query('SELECT SUM(`qudao`) as `sum` FROM `think_packdata` WHERE time > '.$start.' AND `mid`='.$mid.' AND time <='.strtotime($_POST['date']).' AND pid='.I('post.pid'));
            $sh_sum = M('packdata')->query('SELECT SUM(`sh_total`) as `sh_sum` FROM `think_packdata` WHERE time > '.$start.' AND `mid`='.$mid.' AND time <='.strtotime($_POST['date']).' AND pid='.I('post.pid'));
        }else{
            if($cont==1){
                $p = M('packdata')->field('id,total,total1,time')->find($id);
                $start= $p['time'];
            }else{
                $p = M('packdata')->field('time')->query('SELECT * FROM `think_packdata` WHERE time < '.strtotime($_POST['date']).' AND `mid`='.$mid.' AND pid='.I('post.pid').' ORDER BY time asc LIMIT 1');
                $start= $p[0]['time'];
            }

            $real_sum = M('packdata')->query('SELECT SUM(`qudao`) as `sum` FROM `think_packdata` WHERE time >= '.$start.' AND `mid`='.$mid.' AND time <='.strtotime($_POST['date']).' AND pid='.I('post.pid'));
            $sh_sum = M('packdata')->query('SELECT SUM(`sh_total`) as `sh_sum` FROM `think_packdata` WHERE time >= '.$start.' AND `mid`='.$mid.' AND time <='.strtotime($_POST['date']).' AND pid='.I('post.pid'));
        }
        if($_POST['check_shui']==1){
            //抽税
            $shui  = C('SHUI');
        }else{
            $shui  =0;
        }
        //计算支付金额开始
        //总数据减去核减数据
        $_total = ($real_sum[0]['sum']-$ckeck);
        //总金额=单价*(渠道数据-核减数据)
        $totals = $_total * $price;
        //扣税=总金额*税率
        $_shui =$totals*$shui;
        //支付金额=总金额-扣税
        $total= $totals-$_shui;
        //$total  = (($real_sum[0]['sum']-I('post.ckeck')) * I('post.price')) *(1-$shui);
        //计算收益开始
        $shouyi = $sh_sum[0]['sh_sum'] - $total;

        $sql = 'UPDATE `think_packdata` SET `total`='.$total.', `choushui`='.$_shui.',`total1`='.$totals.',`shouyi`='.$shouyi.' WHERE `id`='.$id;

        M('packdata')->execute($sql);
    }

    /**
     * 上家结算
     * @param int $id               产品id
     * @param int $mid              用户id
     * @param int $sh_price         上家单价
     * @param int $sh_ckeck         上家核减
     * @param int $shui             是否抽税
     */
    protected function jiesuan1($id,$mid,$sh_price=0,$sh_ckeck=0,$shui=0){
        $packdata = M('packdata')->find($id);
        $cont = M('packdata')->where('`mid`='.$mid.' AND pid='.I('post.pid'))->count();

        if($cont==1){
            $p = M('packdata')->field('id,total,total1,time')->find($id);
        }else{
            $p = M('packdata')->field('time')->query('SELECT * FROM `think_packdata` WHERE time < '.strtotime($_POST['date']).' AND checked!="-" AND `mid`='.$mid.' AND pid='.I('post.pid').' ORDER BY time DESC LIMIT 1');
        }

        if(!empty($p) && $cont>1){
            $start= $p[0]['time'];
            $real_sum = M('packdata')->query('SELECT SUM(`real`) as `sum` FROM `think_packdata` WHERE time > '.$start.' AND `mid`='.$mid.' AND time <='.strtotime($_POST['date']).' AND pid='.I('post.pid'));
        }else{
            if($cont==1){
                $p = M('packdata')->field('id,total,total1,time')->find($id);
                $start= $p['time'];
            }else{
                $p = M('packdata')->field('time')->query('SELECT * FROM `think_packdata` WHERE time < '.strtotime($_POST['date']).' AND `mid`='.$mid.' AND pid='.I('post.pid').' ORDER BY time asc LIMIT 1');
                $start= $p[0]['time'];
            }
            $str = 'SELECT SUM(`real`) as `sum` FROM `think_packdata` WHERE time >= '.$start.' AND `mid`='.$mid.' AND time <='.strtotime($_POST['date']).' AND pid='.I('post.pid');
            $real_sum = M('packdata')->query($str);

        }
        
        if($_POST['sh_shui']==1){
            //抽税
            $shui  = 0.06;
            $_type=1;
        }else{
            $shui  =0;
            $_type=0;
        }

        //总数据减去核减数据
        $_total = ($real_sum[0]['sum']-$sh_ckeck);
        //总金额
        $totals = $_total * $sh_price;
        //税率
        $_shui =$totals*$shui;
        //抽税后金额
        $total= $totals-$_shui;

        if(!empty($packdata['total'])){
            $js = $total - $packdata['total'];
        }else{
            $js=0;
        }
        
        $sql1 = 'UPDATE `think_packdata` SET `shouyi`='.$js.',`sh_total`='.$total.', `sh_choushui`='.$_shui.',`sh_type`='.$_type.' WHERE `id`='.$id;

        M('packdata')->execute($sql1);
    }

    protected function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     1024*1024*250 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','zip','rar','txt','apk');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'files/'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        return $info;
    }

    public function add(){
        $this->col=$col=M('column')->field('id,title')->where('fid=0 and id!=3')->select();
        $this->pro=$pro=M('product')->field('id,title')->where('type='.$col[0]['id'])->select();
        $tpro=M('product')->find($pro[0]['id']);
        $this->tpro=$_data = $this->_merge($tpro);
        $this->display();
    }

    public function delpack($id=0,$mid=0){

        if(!$id || !$mid ){
            $this->ajaxReturn(array('status'=>0,'msg'=>'参数错误,请选择包名'));
        }

        $map['pid']=I('post.pid');
        $map['mid']=I('post.mid');
        $map['type']=I('post.t');
        $map['cid']=I('post.cid');

        $map1['pid']=I('post.id');
        $map1['mid']=I('post.mid');

        //条数
        //$count = M('producted')->where($map)->count();

        $list = M('packdata')->field('id,pid,image')->where($map1)->select();

        if(!empty($list)){
            foreach ($list as $v){
                if(!empty($v['image'])){        //删除图片
                    unlink($v['image']);
                }
            }
            M('packdata')->where($map1)->delete();
        }

        $map2['t']=I('post.t');
        $map2['mid']=I('post.mid');
        $map2['pid']=I('post.pid');
        $map2['cid']=I('post.cid');
        M('producted')->where($map2)->data('status=1')->save();
        p( M('producted')->getlastsql());die;
        $this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));
    }
    


    public function changes(){
        try{
            $col=M('column')->field('id,title')->where(array('id'=>I('post.id')))->select();
            $pro=M('product')->field('id,title')->where('type='.$col[0]['id'])->select();
            $tpro=M('product')->find($pro[0]['id']);
            $_data = $this->_merge($tpro,0);
            $this->ajaxReturn(
                array(
                    'status'=>1,
                    'plist'=>$pro,
                    'first'=>$_data
                )
            );
        }catch (\Exception $e){
            $this->ajaxReturn(
                array(
                    'status'=>0,
                    'mag'=>$e
                )
            );
        }

    }

    public function change_pro(){
        try{
            $pro=M('product')->field('id,title')->where('id='.I('post.id'))->select();
            $tpro=M('product')->find($pro[0]['id']);

            $_data = $this->_merge($tpro,0);

            //p($_data['pro_attr']);
            $this->ajaxReturn(
                array(
                    'status'=>1,
                    'first'=>$_data
                )
            );
        }catch (\Exception $e){
            $this->ajaxReturn(
                array(
                    'status'=>0,
                    'mag'=>$e
                )
            );
        }
    }

    public function paddhd(){
        if(IS_POST){
            $data1 = $this->UploadsFiles();
            $data = $this->_details($_POST,$data1);

            foreach ($data as $v){
                $d= array(
                    'mid'=>$v['mid'],
                    'cid'=>$v['cid'],
                    'pid'=>$v['ptype'],
                    'type'=>$v['t'],
                    'date'=>$v['type'],
                    'price'=>$v['price'],
                    'sh_price'=>$v['sh_price'],
                    'title'=>$v['pack_name'],
                    'resource'=>$v['pack_link'],
                    'download'=>$v['download'],
                    'des'=>$v['desc'],
                    'create_time'=>time()
                );

                M('producted')->add($d);
            }
           $this->redirect('plist?mid='.I('post.mid'));
        }
    }

    /**
     * 重置密码
     */
    public function rest_pwd(){
        $id = I('get.mid',intval);
        $member = M('member')->find($id);
        if(empty($member)){
           $this->ajaxReturn(array('status'=>0,'msg'=>'用户不存在'));
        }
        $reset=array(
            'id'=>$id,
            'password'=>md5('123456'),
            'time'=>time()
        );

        if(!M('member')->save($reset)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'用户密码重置失败'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'用户密码重置成功,重置后的密码是:123456'));
    }

    /**
     * 修改状态
     */
    public function  status(){
        $this->_status('member');
    }

    public function check(){
        $data=$this->_param();
        $this->vo=$member=M('member')->find($data['id']);
        $this->display();
    }

    /**
     *搜素方法
     */
    protected function _search(){
        //参数
        ($name = I('get.mname','','trim')) && $map['username'] = array('like', '%' . $name . '%');
        //状态（正常，禁用）
        if ($_GET['status'] == null) {
            $status = -1;
        } else {
            $status = intval($_GET['status']);
        }
        if($status!=-1){
            $map['type'] = array('eq', $status);
        }

        if(!empty($_GET['pname'])){
            $filter['title']=array('like','%'.$_GET['pname'].'%');
            if(!empty($_GET['package'])){
                $filter['cid']= $_GET['package'];
            }
            $list = M('producted')->field('mid')->where($filter)->select();
            foreach ($list as $v){
                $_result[] = $v['mid'];
            }
            $_result =  array_unique($_result);
           if(count($_result)>0){
               $map['id']=array('in',implode(',',$_result));
           }
        }

        //输出
        $this->assign('search', array(
            'name' => $name,
            'status' => $status,
            'package'=>$_GET['package'],
            'pname'=>$_GET['pname'],
        ));
        return $map;
    }

    /**
     * 重组数据
     * @param $arr
     * @param $image
     * @return array
     */
    public function _details($arr,$image){
        $arr1 = $arr['pro_attr'];

        foreach ($arr1 as $v){

            $t = $v['t'];

            if(!empty($t)){
                $_result[] =array(
                    't'=>$v['t'],
                    'price'=>$v['price'],
                    'sh_price'=>$v['sh_price'],
                    'type'=>$v['type'],
                );

                unset($v['t']);
                unset($v['price']);
                unset($v['type']);
                $_package[$t]=$v;
            }
        }

        foreach ($_result as $j){
            $package = $_package[$j['t']];
            $img =$image[$j['t']];
            for ($i=0;$i<count($package)-1;$i++){

                if(!empty($img[$i]['path'])){
                    $link =$img[$i]['path'];
                    $dl=1;
                }else{
                    $link =$package[$i]['pack']['link'];
                    $dl=0;
                }

                $packs[] =array(
                    'mid' => $arr['mid'],
                    'cid' => $arr['type'],
                    'ptype' => $arr['ptype'],
                    't'=>$j['t'],
                    'price'=>$j['price'],
                    'sh_price'=>$j['sh_price'],
                    'type'=>$j['type'],
                    'pack_name'=>$package[$i]['pack']['pack'],
                    'pack_link'=>$link,
                    'download'=>$dl,
                    'desc'=>$arr['desc'],
                );
            }
        }
        return $packs;
    }


    /**
     * 导出结算对账单
     * @param int $id
     * @param int $mid
     * @param int $pid
     */
    public function export($mid=0,$pid=0){
        if($mid!=0 && $pid!=0){
            $xlsModel = M('packdata');
            $xlsData = $xlsModel->field('time,sh_price,price,qudao,real,sh_checked,checked,sh_total,total,shouyi,status')->where('mid='.$mid.' and pid ='.$pid)->select();
            if(empty($xlsData)){
                $this->error('没有数据');
            }

            $xlsName  = "数据信息";
            $xlsCell  = array(
                array('time','日期'),
                array('sh_price','上家单价/元'),
                array('price','用户单价/元'),
                array('qudao','上家数据'),
                array('real','用户数据'),
                array('sh_checked','上家核减'),
                array('checked','用户核减'),
                array('sh_total','上家金额/元'),
                array('total','用户金额/元'),
                array('shouyi','收益金额/元'),
                array('status','结算状态'),
            );
            $pro  =M('producted')->find($pid);
            $member  =M('member')->find($mid);
            $type = $pro['cid']==1?'PC':'APP';
            $header='产品结算对账单(包流量数据)：'.$pro['title'].'/'.$type.'/'.$pro['type'].'/'.$member['username'].'        生成日期：'.date('Y-m-d',time());

            if(!empty($xlsData)){
                foreach ($xlsData as $k => $v) {
                    $xlsData[$k]['status']=($v['status']==1)?'已结算':'-';
                    $xlsData[$k]['time']=date('Y-m-d',$v['time']);
                }
                $this->exportExcel($xlsName,$xlsCell,$xlsData,$header);
            }
        }else{
            exit('参数错误');
        }
    }

    public function change_date(){
        $time = strtotime(I('post.date'));
        $_result = M('packdata')->where(array('time'=>$time,'pid'=>I('post.pid'),'mid'=>I('post.mid')))->find();
        if(!empty($_result)){
            $this->ajaxReturn(array('status'=>1,'msg'=>'查询成功','data'=>$_result));
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'查询失败'));
        }
    }

}
