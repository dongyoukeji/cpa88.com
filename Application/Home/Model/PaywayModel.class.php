<?php

/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/4
 * Time: 15:18
 */
namespace Home\Model;
use Think\Model;

class PaywayModel extends Model{
    protected $_validate = array(
        array('bank_name','require','银行名必填！'), //默认情况下用正则进行验证
        array('pay_account','require','账户必填！'),
        array('pay_getname','require','账户名必填！'),
    );
}