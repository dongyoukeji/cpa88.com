<?php
namespace Admin\Controller;
use Think\Controller;
/**
 *基类 
 */
class BaseController extends Controller {
	protected function _initialize(){
		header('Content-type:text/html;charset=utf-8;');
		set_time_limit(0);
		$this->check_priv();        //判断是否登录
		$nav = $this->auth_list();	//导航
        $this->time = date('Y-m-d',time());
		$this->assign('nav', $nav);
	}

    /**
     * 获取当前操作模块
     * @param $control          控制器
     * @param $action           方法
     * @param string $lang      语言
     */
    protected function _model_name($control,$action,$lang=''){
        $controls=M('model')->where('title="'.$control)->find();
        $this->model=$model=M('model')->where('fid='.$controls["id"].' and title="'.$action)->find();
    }
    /**
     * @param $control 控制器
     * @param $action  操作
     */
    protected function _breadcrumb($control,$action){
        $map['title']=$control;
        $c =  M('model')->where($map)->find();
        $a =  M('model')->where('fid='.$c['id'].' and title="'.$action)->find();
        $rd =__ROOT__.'/'.MODULE_NAME.'/'.$control;
        $uri="<a href=\"$rd".'/'.$a['title']."\">".$a['name']."</a>";
        return $uri;
    }

    /**
     * 重置上传参数
     * @param $image    上传的图片
     * @param $data     上传的数据
     * @return mixed
     */
    protected function _data($image,$data){
        //获取旧图片参数
        foreach($data as $j=>$i){
            if(strpos($j,'old_')!==false){
                $old[str_replace('old_','',$j)]=$i;
                unset($data[$j]);
            }
        }
        //替换图片
        if(!empty($image)){     //有上传图片
            foreach($image as $k=>$v){
                $data[$k]=$v;
                if($image[$k]){ //删除旧图片
                    unlink(C('DEFAULT_UPLOAD_CONFIG.IMAGES').I('old_'.$k));
                }
            }
        }else{  //无上传图片,使用旧图片
            foreach($old as $o=>$q){
                $data[$o]=$q;
            }
        }
        return $data;
    }

	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
    	$this->list=$this->getlist();
    	$this->display();
    }

    /**
	 * [get_column 得到导航栏目栏目]
	 * @return [type]
	 */
	protected function get_column(){
		$where=array('status'=>0,'type'=>array('lt',3));
		$column=M("column")->where($where)->order('id asc')->select();
		$column= \Tool\Category::unlimitedForLevel($column);
		return $column;
	}
	/**
     * 获取排序
     * @param type $field排序的字段名（支持数组）
     * @param type $range排序方法
     * @return string
    */
    protected function ordermap($field = '', $range = '') {
        if ($field && $range) {
            if (is_array($field)) {
                for ($i = 0; $i < count($field); $i++) {
                    $arr[] = $field[$i] . " " . $range;
                }
                $ordermap = implode(',', $arr);
            } else {
                $ordermap = $field . " " . $range;
            }
        } else {
            $ordermap = null;
        }
        return $ordermap;
    }

    /**
     * @return mixed 得到单页面
     */
    protected function getsingle(){
     
        return M('column')->where('type=3')->select();
    }

    /**
     * 是否登录
     */
	protected function check_priv() {
		if(!isset($_SESSION[C('SESSION_PREFIX')]) || empty($_SESSION[C('SESSION_PREFIX')]['login'])){
			$this->redirect('Login/index');
		}else{
            if($_SESSION[C('SESSION_PREFIX')]){
                $user = $_SESSION[C('SESSION_PREFIX')]['login'];
                $user['username']=ucfirst($user['username']);
                $this->user =$user;
            }
        }
	}

    /**
     * @return array
     */
	protected function auth_list(){
        $user = $_SESSION[C('SESSION_PREFIX')]['login'];
        $gid = $user['gid'];
        $this->gid =$gid; 

        $nav=array();
        if($gid!=-1 && !empty($gid)){
            $model = M('model')->where('fid=0 and "show"=0 and status=0 and id in('.$gid.')')->select();
        }else{
            $model = M('model')->where('fid=0 and "show"=0 and status=0')->select();
        }

		foreach ($model as  $v) {
			$map['fid']=$v['id'];
			$map['status']=0;
            $map['show']=0;
			$child=M('model')->where($map)->order('sort asc')->select();
			$v['child']=$child;
			$nav[]=$v;
		}
		return $nav;
	}

    /**
     * @param $model 更改状态
     */
    protected function _status($model=''){
        
        $m=!empty($model)?M($model):M(CONTROLLER_NAME);
        $where['id']=array('in',I('k'));
        if(IS_POST){
            $where['id']=array('in',I('k'));
        }else{
            $where['id']=array('in',I('id'));
        }

        $p=!empty($_GET['p'])?'?p='.I('p'):'';
        $ajax=I('ajax','',intval);
        $ajax=($ajax==1)?1:0;
        switch(I('t')){
            case 'enable':            //启用
                $result = $m->where($where)->save(array('status'=>0));
                if(!$result){
                    if($ajax){
                        $this->ajaxReturn(array(
                            'status'=>1,
                            'message'=>L('enable').L('fail')
                        ));
                    }else{
                        $this->error(L('enable').L('fail'));
                    }

                }else{
                   if($ajax){
                       $this->ajaxReturn(array(
                           'status'=>0,
                           'message'=>L('enable').L('success')
                       ));
                   }else{
                       $this->redirect('index'.$p);
                   }
                }
                break;
            case 'forbidden':        //禁用
                $result = $m->where($where)->save(array('status'=>1));
                if(!$result){
                   if($ajax){
                       $this->ajaxReturn(array(
                           'status'=>1,
                           'message'=>L('forbidden').L('fail')
                       ));
                   }else{
                       $this->error(L('forbidden').L('fail'));
                   }
                }else{
                   if($ajax){
                       $this->ajaxReturn(array(
                           'status'=>0,
                           'message'=>L('forbidden').L('success')
                       ));
                   }else{
                       $this->redirect('index'.$p);
                   }
                }
                break;
            case 'delete':           //删除
                $result = $m->where($where)->delete();
                if(!$result){
                    if($ajax){
                        $this->ajaxReturn(array(
                            'status'=>1,
                            'message'=>L('delete').L('fail')
                        ));
                    }else{
                        $this->error(L('delete').L('fail'));
                    }
                }else{
                   if($ajax){
                       $this->ajaxReturn(array(
                           'status'=>0,
                           'message'=>L('forbidden').L('success')
                       ));
                   }else{
                       $this->redirect('index'.$p);
                   }
                }
                break;
        }
    }

    /**
     * @return array
     */
	protected function _search() {
        $map = array();
        //控制器名称
        ($title = I('get.title','', 'trim')) && $map['title'] = array('like', '%' . $title . '%');
        //控制器中文名
        ($name = I('get.name ','','trim')) && $map['name'] = array('like', '%' . $name . '%');
        //
        ($title = I('get.k','', 'trim')) && $map['title'] = array('like', '%' . $title . '%');
        ($name = I('get.k', '','trim')) && $map['name'] = array('like', '%' . $title . '%');
        //状态（正常，禁用）
        if ($_GET['status'] == null) {
            $status = -1;
        } else {
            $status = intval($_GET['status']);
        }
        $status >= 0 && $map['status'] = array('eq', $status);
       
        //输出
        $this->assign('search', array(
            'title' => $title,
            'name' => $name,
            'k' => I('k'),
            'status' => $status,
        ));
        return $map;
    }
    /**
	 * [uploadUEditor 上传图片]
	 * @return [type]
	 */
	protected function UploadsFiles(){
        $msg  = "";
        $size = C('DEFAULT_UPLOAD_CONFIG.IMAGE_SIZE');
        $path = C('DEFAULT_UPLOAD_CONFIG.FILES').date('Ymd');
        $ext = C('DEFAULT_UPLOAD_CONFIG.FILES_EXT');

        $_file = $_FILES['pro_attr']['name'];
        $_tmp_name = $_FILES['pro_attr']['tmp_name'];
        $_type = $_FILES['pro_attr']['type'];
        $_size = $_FILES['pro_attr']['size'];

        if(!file_exists($path)){
            mkdir($path, 0777,true);
        }

        for ($i=1;$i<=count($_file);$i++){
            for ($j=0;$j<count($_file[$i]);$j++){
                $tp = array_keys($_file[$i][$j]);
                $tp = explode('_',$tp[0]);
                $file_name = $_file[$i][$j]['pack_'.$tp[1]];
                $file_temp = $_tmp_name[$i][$j]['pack_'.$tp[1]];
                $file_size = $_size[$i][$j]['pack_'.$tp[1]];
                $file_type = $_type[$i][$j]['pack_'.$tp[1]];
                $file_type = explode('/',$file_type['file']);

                 if(!empty($file_name['file'])){

                     if(!in_array($file_type[1],$ext)){
                        $msg .= $file_name.' 上传类型错误';
                        continue;
                    }

                    if($file_size['file']>$size){
                        $msg .= $file_size['file'].' 上传尺寸过大';
                        continue;
                    }

                    $_file_name = $tp[1]."_".time().$i.$j;

                    if($file_type[1]=='jpeg'){
                        $full_path = $path.'/'.$_file_name.'.jpg';
                    }else{
                        $full_path = $path.'/'.$_file_name.$file_type[1];
                    }
                     if($file_type[1]=='octet-stream'){
                         $full_path = $path.'/'.$_file_name.'.rar';
                     }
                     if($file_type[1]=='x-zip-compressed'){
                         $full_path = $path.'/'.$_file_name.'.zip';
                     }
                     $_result[$tp[1]][]=array(
                         'type'=>$tp[1],
                         'name'=>$_file_name,
                         'path'=>$full_path,
                         'size'=>$file_size['file']
                     );

                     if(!move_uploaded_file($file_temp['file'],$full_path)){
                         $msg .= "请检查路径 ".$full_path." 是否可用";
                     }
                }


            }

        }

        if(!empty($_result)){
            return $_result;
        }else{
            return $msg;
        }
     }

    /**
     * [makeAttr 重置文章属性]
     * @param  [array] $resetAttr 重置的属性
     * @return [array] 返回重置的属性	
     */
    protected function makeAttr($resetAttr){
    	$attr=array('com'=>0,'new'=>0,'head'=>0,'top'=>0,'img'=>0,'hot'=>0);
    	foreach ($resetAttr as $k => $v) {
    		$attr[$k]=1;
    	}
    	return $attr;
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
    protected function getlist($model = '', $map = '', $order = '', $pagination = '', $field = '*') {

        $model=!empty($model)?$model:M(CONTROLLER_NAME);
       
        $count = $model->where($map)->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');

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
        $res = $model->where($map)->field($field)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();

        return $res;
    }


    protected function get_ajax_list($model = '', $map = '', $order = '', $pagination = '', $field = '*') {

        $model=!empty($model)?$model:M(CONTROLLER_NAME);

        $count = $model->where($map)->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');

        $p = new \Think\Page($count, $pagination);
        $p->setConfig('header', '<li class="rows">共%TOTAL_ROW%条记录&nbsp;当前%NOW_PAGE%页/共%TOTAL_PAGE%页</li>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last', '最后一页');
        $p->setConfig('first','第一页');
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $res = $model->where($map)->field($field)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();

        return array(
            'status'=>1,
            'count'=>$count,
            'list'=>$res,
            'page'=>$show
        );
    }


    /**
    * [delArticleImage 删文章除图片]
    * @param  [string] $path 图片路径
    * @return [string] 删除结果
    */
    protected function delArticleImage($path){
    	$path=!empty($path)?$path:I('path');
    	if(!empty($path)){
    		$id=I('id','',intval);
            $index=I('index','',intval);
            $result=M('Article')->find($id);

            $image=array_filter(explode(',', $result['image']));	
            unset($image[$index]); //截取数组，去除空数组
            $image=implode(',', $image);
         
    		$data=array('id'=>$id,'image'=>$image);
    		M('Article')->save($data);

    		if(!unlink(C('DEFAULT_UPLOAD_CONFIG.IMAGES').$path)){
    			$this->ajaxReturn(
                    array(
                        'status'=>0,
                        'msg'=>L('delete').L('fail')
                    )
                );
    		}else{
                $this->ajaxReturn(
                    array(
                        'status'=>1,
                        'msg'=>L('delete').L('success')
                    )
                );
    		}
    	}
    }
    /**
     * [delFile 删除文件]
     * @return [int] [返回结果]
     */
    public function delFile($id=0){
        $id=$id?$id:I('id','',intval);
        $file=!empty($_POST['file'])?$_POST['file']:'';
        if(emnpty($file)){
            $f =M('file')->find($id);
            $file=$f['path'];
        }
        if(!unlink(C('DEFAULT_UPLOAD_CONFIG.FILES').$file)){
            $this->ajaxReturn(array(
                'status'=>0,
                'msg'=>L('delete').L('fail')
            ));
        }else{
            $data=array('id'=>$id,'file'=>'');
            M('file')->save($data);
            $this->ajaxReturn(array(
                'status'=>1,
                'msg'=>L('delete').L('success')
            ));
        }
    }
  	/**
  	* [_setDel 定时删除]
    * @param integer $time [间隔]
    * @param string  $model [模型]
    * @param string  $type [跨度]
  	*/
    protected function _setDel($time=1,$model='',$type='day'){
        switch ($type) {
        	case 'day':
        		$after=time()- $time*24*60*60;
        		break;
        	case 'week':
        		$after=time()- $time*24*60*60*7;
        		break;
        	case 'hour':
        		$after=time()- $time*60*60;
        		break;
        	default:
        		$after=time()- $time*24*60*60;
        		break;
        }
        
        $name=!empty($model)?$model:CONTROLLER_NAME;
        $model=M($name);
        $where['date']=array('lt',$after);
        $result=$model->where($where)->delete(); 
        return $result;
    }
    /**
    * [_param 获取参数信息]
    * @param  string $param [参数]
    * @return [type]        [description]
    */
    protected function _param($param=''){
        if(empty($param)){
            foreach ($_REQUEST as $k => $v) {
                if($k!='_URL_'){
                    $param[$k]=htmlspecialchars($v);
                }
            }
        }
        return $param;
    }
    /**
     * 分拆属性
     * @param $attr
     * @return array
     */
    protected function _details($attr){

        $array= array(
            'CPA','CPS','CPC','CPM','meiti'
        );
        foreach ($attr as $k => $v){;
            if(in_array($v['t'],$array)){
                $attr1[]=$v['t'];
                $price[]=$v['t'].'_'.$v['price'];
                $sh_price[]=$v['t'].'_'.$v['sh_price'];
                $type[]=$v['t'].'_'.$v['type'];
                $com[]=$v['com']?$v['t'].'_'.$v['com']:$v['t'].'_0';
            }
        }
        return array(
            'attr'=>$attr1,
            'price'=>$price,
            'sh_price'=>$sh_price,
            'time'=>$type,
            'com'=>$com,
        );
    }

    /**
     * 组合属性
     * @param $arr
     * @return array
     */
    protected function _merge($arr,$t=1){
        $a = explode(',',$arr['attr']);
        $b = explode(',',$arr['price']);
        $p = explode(',',$arr['sh_price']);
        $c = explode(',',$arr['com']);
        $d = explode(',',$arr['balance_time']);

        for($i=0;$i<count($a);$i++){

            $b1 = explode('_',$b[$i]);
            $c1 = explode('_',$c[$i]);
            $d1 = explode('_',$d[$i]);
            $p1 =explode('_',$p[$i]);
            if($t){
                $temp[$a[$i]]=array(
                    't'=>   $a[$i],
                    'price'=>$b1[1],
                    'sh_price'=>$p1[1],
                    'com'=>$c1[1],
                    'type'=>$d1[1]
                );
            }else{
                $temp[]=array(
                    't'=>   $a[$i],
                    'price'=>$b1[1],
                    'sh_price'=>$p1[1],
                    'com'=>$c1[1],
                    'type'=>$d1[1]
                );
            }

        }

        $arr['service']=explode(',',$arr['service']);
        $arr['pro_attr']=$temp;

        return  $arr;
    }

    /**
     * 导出Excel
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     * @param $header
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    protected function exportExcel($expTitle,$expCellName,$expTableData,$header){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['mname'].date('_YmdHis_').'对账单';//or $xlsTitle 文件名称可根据自己情况设定

        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");

        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $header);
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    
    
    /**
     * 上传文件
     * @return array|bool
     */
    protected function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     1024*1024*500 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','zip','rar','txt');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'files/'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        return $info;
    }
}