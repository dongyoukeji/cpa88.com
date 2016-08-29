<?php

/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/4
 * Time: 15:18
 */
namespace Admin\Model;
use Think\Model;

class PackdataModel extends Model{
    protected $_validate = array(
        array('price','require','用户单价必填！'), //默认情况下用正则进行验证
        array('sh_price','require','上家单价必填！'),
        array('real','require','上家数据必填'),
        array('qudao','require','用户数据必填'),
    );
}