<?php

/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/4
 * Time: 15:18
 */
namespace Admin\Model;
use Think\Model;

class ArticleModel extends Model{
    protected $_validate = array(
        array('title','require','标题不能为空！'), //默认情况下用正则进行验证
        array('content','require','标题不能为空！')
    );
}