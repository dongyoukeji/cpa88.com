<?php

/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/4
 * Time: 15:18
 */
namespace Home\Model;
use Think\Model;

class MemberModel extends Model{
    protected $_validate = array(
        array('username','require','用户名必填！'), //默认情况下用正则进行验证
        array('password','require','用户密码必填！'),
        array('real_name','require','用户密码必填！'),
        array('tel','require','用户密码必填！'),
    );
}