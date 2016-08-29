<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/11
 * Time: 14:46
 */

function get_image($id){
    $pro = M('product')->find($id);
    return $pro['image'];
}
function get_pro($id){
    $pro = M('product')->find($id);
    return $pro['title'];
}

function get_fangshi($id){
    $_str="";
    if($id==1){
        $_str.="日结/";
    }elseif ($id==2){
        $_str.="周结/";
    }else{
        $_str.="月结/";
    }
    return substr( $_str,0,-1);
}
function get_fangshi1($id){
    $_str="";
    if($id==1){
        $_str="日结";
    }elseif ($id==2){
        $_str="周结";
    }else{
        $_str="月结";
    }
    return $_str;
}