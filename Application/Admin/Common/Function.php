<?php
/**
 * Created by PhpStorm.
 * User: dongyou02
 * Date: 2016/4/29
 * Time: 15:08
 */


function get_pro($id){
    $pro = M('product')->find($id);
    return !empty($pro['title'])?$pro['title']:'/';
}
function get_pro_name($id){
    $pro = M('producted')->find($id);
    return !empty($pro['title'])?$pro['title']:'/';
}
function get_col($id){
    $pro = M('column')->find($id);
    return !empty($pro['title'])?$pro['title']:'/';
}

function get_pack_name($id){
    $pack = M('producted')->find($id);
    $pa = M('product')->find($pack['pid']);
    return !empty($pa['title'])?$pa['title']:'/';
}

function get_pronum($id){
    $pa = M('producted')->where(array('mid'=>$id,'status'=>0))->count('*');
    return $pa;
}

function get_pack_jiesuan($id){
    $pack = M('producted')->find($id);
    if($pack['date']==1){
        $_str="日结";
    }elseif ($pack['date']==2){
        $_str="周结";
    }else{
        $_str="月结";
    }
    return $_str;
}

function get_pack_id($id){
    $pack = M('producted')->find($id);
    return $pack['id'];
}

function get_pack_t($id){
    $pack = M('producted')->find($id);

    $pa = M('product')->find($pack['pid']);
    if(empty($pa)){
        $_result =  '/';
    }
    $t = $pa['type'];
    $col=M('column')->field('id,title')->where('fid=0 and id!=3')->select();

    foreach ($col as $v){
        if ($v['id'] == $t){
            $_result =  $v['title'];
        }
    }
    return $_result;
}


function get_group($id){
    $group =  M('model')->where(array('id'=>array('in',$id)))->select();
    $str = "";
    foreach ($group as $v){
        $str.=$v['name'].'/';
    }
    return substr($str,0,-1);
}


function get_pack_type($id){
    $pack = M('producted')->find($id);

    if(empty($pack)){
        return '/';
    }
    return $pack['type']=='meiti'?'富媒体':$pack['type'];
}

function get_member($mid){
    $member = M('member')->find($mid);
    $type = ($member['type']==0)?'个人用户':'企业用户';
    return $member['username'].'/'.$type.'/'.$member['real_name'];
}


/**
 * 替换分隔符
 * @param $str
 * @return mixed
 */
function replace_di($str){
     //$str1 = str_replace(',','/',$str);
    $_result="";
    foreach (explode(',',$str) as $v){
       $temp = explode('_',$v);
        $_result.=$temp[1]."/";
    }
    return substr($_result,0,-1);
}

/**
 * 组合推荐样式
 * @param $str   string   类型
 * @param $str1  string   推荐
 * @return string
 */
function attr_com($str,$str1){

    $arr = explode(',',$str);
    $arr1 = explode(',',$str1);
    $_result="";

    for($i=0;$i<count($arr);$i++){
        if($arr[$i]=='meiti'){
            $arr[$i]="富媒体";
        }
        $arr2 = explode('_',$arr1[$i]);
        if($arr2[1]==1){
            $_result.="<i class=\"admin_cptj\">".$arr[$i]."</i> ";
        }else{
            $_result.="<i>".$arr[$i]."</i> ";
        }
    }
    return $_result;
}

function jiesuan($str){
    $str = str_replace(',','/',$str);
    $arr =explode('/',$str);
    $_str="";

    if(count($arr)>1){
        foreach ($arr as  $v){
            $v = explode('_', $v);

            if($v[1]==1){
                $_str.="日结/";
            }elseif ($v[1]==2){
                $_str.="周结/";
            }else{
                $_str.="月结/";
            }
        }
        return substr( $_str,0,-1);
    }else{
        if($str==1){
            $_str.="日结";
        }elseif ($str==2){
            $_str.="周结";
        }else{
            $_str.="月结";
        }
        return  $_str;
    }

}

function jiesuan1($str){

    $arr =explode('/',$str);

    $_str="";
    foreach ($arr as  $v){
        if($v==1){
            $_str.="日结/";
        }elseif ($v==2){
            $_str.="周结/";
        }else{
            $_str.="月结/";
        }
    }
    return substr( $_str,0,-1);
}