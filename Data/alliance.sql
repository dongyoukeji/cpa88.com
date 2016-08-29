-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-28 08:23:32
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alliance`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_address`
--

CREATE TABLE `think_address` (
  `id` int(11) NOT NULL COMMENT '主键，自动增长',
  `mid` int(11) NOT NULL COMMENT '会员id',
  `name` varchar(50) NOT NULL COMMENT '收件人',
  `prov` varchar(150) NOT NULL COMMENT '省份',
  `city` varchar(250) NOT NULL COMMENT '城市',
  `district` varchar(500) NOT NULL COMMENT '区县',
  `address` varchar(100) NOT NULL COMMENT '详细地址',
  `zipcode` varchar(10) NOT NULL COMMENT '邮编',
  `mobile` varchar(15) NOT NULL COMMENT '手机',
  `phone` varchar(15) NOT NULL COMMENT '座机',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认地址:1默认,0不默认',
  `contact` varchar(250) NOT NULL COMMENT '联系方式'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员收货地址表';

-- --------------------------------------------------------

--
-- 表的结构 `think_admin`
--

CREATE TABLE `think_admin` (
  `id` int(11) NOT NULL COMMENT '主键,自增长',
  `gid` varchar(11) NOT NULL COMMENT '所属群组:-1为超级管理员',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `hash` varchar(50) NOT NULL COMMENT '密码校验',
  `status` tinyint(1) NOT NULL COMMENT '状态:0正常;1锁定',
  `date` int(10) NOT NULL COMMENT '添加日期',
  `last_date` int(10) NOT NULL COMMENT '最后登录时间',
  `last_ip` varchar(15) NOT NULL COMMENT '最后登录IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

--
-- 转存表中的数据 `think_admin`
--

INSERT INTO `think_admin` (`id`, `gid`, `username`, `password`, `hash`, `status`, `date`, `last_date`, `last_ip`) VALUES
(1, '-1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 0, 0, 1464404899, '0.0.0.0'),
(2, '1,2,3,4,6', '二少', 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 0, 0, 1464413693, '192.168.188.167');

-- --------------------------------------------------------

--
-- 表的结构 `think_article`
--

CREATE TABLE `think_article` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '规则id,自增主键',
  `cid` int(1) NOT NULL DEFAULT '0' COMMENT '所属栏目',
  `title` varchar(500) NOT NULL DEFAULT '' COMMENT '文章中文名称',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者:默认Admin',
  `keywords` varchar(500) NOT NULL COMMENT '关键词',
  `description` varchar(500) NOT NULL DEFAULT '' COMMENT '栏目简单介绍',
  `ico` varchar(150) NOT NULL COMMENT 'ico图标',
  `image` text NOT NULL COMMENT '文章图片',
  `file` varchar(50) NOT NULL COMMENT '文件',
  `content` text NOT NULL COMMENT '内容',
  `extend` text NOT NULL COMMENT '扩展内容',
  `hits` int(11) NOT NULL COMMENT '点击次数',
  `com` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐，0否，1是',
  `hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '最热，0否，1是',
  `new` tinyint(1) NOT NULL DEFAULT '0' COMMENT '最新，0否，1是',
  `head` tinyint(1) NOT NULL DEFAULT '0' COMMENT '头条，0否，1是',
  `top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶，0否，1是',
  `img` tinyint(1) NOT NULL DEFAULT '0' COMMENT '图文',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `time` int(11) NOT NULL COMMENT '时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序：越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';

-- --------------------------------------------------------

--
-- 表的结构 `think_china`
--
-- 使用中(#1932 - Table 'alliance.think_china' doesn't exist in engine)
-- 读取数据时发生错误: (#1932 - Table 'alliance.think_china' doesn't exist in engine)

-- --------------------------------------------------------

--
-- 表的结构 `think_column`
--

CREATE TABLE `think_column` (
  `id` int(11) NOT NULL COMMENT '规则id,自增主键',
  `fid` int(11) NOT NULL COMMENT '父节点：0,为顶级',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '栏目中文名称',
  `name` char(20) NOT NULL DEFAULT '' COMMENT '栏目英文名称',
  `keywords` varchar(250) NOT NULL COMMENT '栏目关键词',
  `description` text NOT NULL COMMENT '栏目简单介绍',
  `banner` char(250) NOT NULL DEFAULT '' COMMENT '栏目Banner',
  `iamge` varchar(250) NOT NULL DEFAULT '' COMMENT '栏目图片',
  `ico` char(250) NOT NULL DEFAULT '' COMMENT '栏目图标',
  `position` int(1) NOT NULL DEFAULT '0' COMMENT '栏目位置：1头部，2中部，3左侧，4右侧，5底部',
  `date` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `type` int(1) NOT NULL COMMENT '类型:1列表页;2下载页;3单页面;4封面页;5表单页,6跳转页',
  `uri` varchar(150) NOT NULL DEFAULT ' ' COMMENT '跳转地址',
  `isnav` int(1) NOT NULL COMMENT '是否导航显示:0显示;1不显示',
  `effective` int(11) NOT NULL DEFAULT '0' COMMENT '栏目有效时间,在有效时间内会显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序：越小越靠前',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用',
  `dates` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

--
-- 转存表中的数据 `think_column`
--

INSERT INTO `think_column` (`id`, `fid`, `title`, `name`, `keywords`, `description`, `banner`, `iamge`, `ico`, `position`, `date`, `type`, `uri`, `isnav`, `effective`, `sort`, `status`, `dates`) VALUES
(1, 0, 'pc端', 'pc', 'pc端', 'pc端', '', '', '', 0, 0, 0, ' ', 0, 0, 0, 0, 0),
(2, 0, '移动端', 'move', '移动端', '移动端', '', '', '', 0, 0, 0, ' ', 0, 0, 0, 0, 0),
(3, 0, '公告', 'notify', '公告', '公告', '', '', '', 0, 0, 0, ' ', 0, 0, 0, 0, 0),
(4, 3, '站内公告', 'site', '站内公告', '站内公告', '', '', '', 0, 0, 0, ' ', 0, 0, 0, 0, 0),
(5, 3, '常见问题', 'question', '常见问题', '常见问题', '', '', '', 0, 0, 0, ' ', 0, 0, 0, 0, 0),
(6, 3, '结算通知', 'balance', '结算通知', '结算通知', '', '', '', 0, 0, 0, ' ', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_flink`
--

CREATE TABLE `think_flink` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '规则id,自增主键',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '友情链接中文名称',
  `name` char(20) NOT NULL DEFAULT '' COMMENT '友情链接英文名称',
  `description` char(250) NOT NULL DEFAULT '' COMMENT '友情链接简单介绍',
  `ico` char(250) NOT NULL DEFAULT '' COMMENT '友情链接图标',
  `uri` char(250) NOT NULL DEFAULT '' COMMENT '友情链接链接指向,链接到的地址',
  `position` int(1) NOT NULL DEFAULT '0' COMMENT '友情链接位置：1首页，2内页',
  `date` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `effective` varchar(150) NOT NULL DEFAULT '0' COMMENT '友情链接有效时间,在有效时间内会显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序：越小越靠前',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- --------------------------------------------------------

--
-- 表的结构 `think_member`
--

CREATE TABLE `think_member` (
  `id` int(11) NOT NULL COMMENT '主键，自动增长',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `qq` varchar(20) NOT NULL COMMENT 'qq',
  `tel` varchar(50) NOT NULL COMMENT '联系方式',
  `address` varchar(150) NOT NULL COMMENT '详细地址',
  `type` int(11) NOT NULL COMMENT '用户类型:0个人1企业',
  `real_name` varchar(50) NOT NULL COMMENT '个人/企业真实名称',
  `banlace` decimal(10,0) NOT NULL COMMENT '提现总额',
  `jifen` int(11) NOT NULL COMMENT '积分',
  `pmun` int(11) NOT NULL COMMENT '产品数量',
  `create_time` int(11) NOT NULL COMMENT '注册时间',
  `time` int(11) NOT NULL COMMENT '时间戳',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：1禁用,0启用',
  `last_login_time` int(11) NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(20) NOT NULL COMMENT '最后登录ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';

--
-- 转存表中的数据 `think_member`
--

INSERT INTO `think_member` (`id`, `username`, `password`, `email`, `qq`, `tel`, `address`, `type`, `real_name`, `banlace`, `jifen`, `pmun`, `create_time`, `time`, `status`, `last_login_time`, `last_login_ip`) VALUES
(1, '陆飞', '7fa8282ad93047a4d6fe6111c93b308a', '132@163.com', '', '13222222222', '', 0, '1111111', '0', 0, 0, 1461574688, 0, 0, 0, ''),
(2, '陆少游', '7fa8282ad93047a4d6fe6111c93b308a', '132@163.com', '', '13222222222', '', 0, '11', '0', 0, 0, 1461574782, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `think_model`
--

CREATE TABLE `think_model` (
  `id` int(11) NOT NULL COMMENT '主键',
  `fid` int(11) NOT NULL COMMENT '父节点：0,为顶级',
  `title` varchar(30) NOT NULL COMMENT '英文标识',
  `name` varchar(50) NOT NULL COMMENT '中文名',
  `contr_name` varchar(50) NOT NULL COMMENT '控制器名',
  `info` varchar(250) NOT NULL COMMENT '简介',
  `url` varchar(250) NOT NULL COMMENT '地址',
  `ico` varchar(50) NOT NULL COMMENT '图标',
  `pic` varchar(500) NOT NULL COMMENT '控制器图片',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序,越小越靠前',
  `show` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示导航,0显示,1不显示',
  `status` int(10) NOT NULL COMMENT '状态:0正常,1锁定',
  `date` int(10) NOT NULL COMMENT '添加日期',
  `dates` int(10) NOT NULL COMMENT '修改日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='控制器';

--
-- 转存表中的数据 `think_model`
--

INSERT INTO `think_model` (`id`, `fid`, `title`, `name`, `contr_name`, `info`, `url`, `ico`, `pic`, `sort`, `show`, `status`, `date`, `dates`) VALUES
(1, 0, 'index', '用户管理', 'Member', '用户管理', '/Admin/Member', '', '', 100, 0, 0, 0, 0),
(2, 0, 'index', '产品管理', 'Product', '产品管理', '/Admin/Product', '', '', 100, 0, 0, 0, 0),
(3, 0, 'index', '通知管理', 'Notify', '通知管理', '/Admin/Notify', '', '', 100, 0, 0, 0, 0),
(4, 0, 'index', '结算管理', 'Balance', '结算管理', '/Admin/Balance', '', '', 100, 0, 0, 0, 0),
(5, 0, 'index', '账号管理', 'Admin', '账号管理', '/Admin/Admin', '', '', 100, 0, 0, 0, 0),
(6, 0, 'index', '友情链接', 'Flink', '友情链接', '/Admin/Flink', '', '', 100, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_packdata`
--

CREATE TABLE `think_packdata` (
  `id` int(11) NOT NULL COMMENT '主键',
  `pid` int(11) NOT NULL COMMENT '包id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `sh_price` decimal(10,2) NOT NULL COMMENT '上家单价',
  `real` int(11) NOT NULL COMMENT '上家数据',
  `qudao` int(11) NOT NULL COMMENT '用户数据',
  `checked` varchar(20) NOT NULL DEFAULT '-' COMMENT '核减数据',
  `sh_checked` varchar(20) NOT NULL DEFAULT '-' COMMENT '上家核减数据',
  `sh_choushui` decimal(10,2) NOT NULL COMMENT '上家抽税',
  `total` decimal(10,2) NOT NULL COMMENT '结算金额',
  `total1` decimal(10,2) NOT NULL COMMENT '总金额',
  `choushui` decimal(10,2) NOT NULL COMMENT '扣除金额',
  `sh_total` decimal(10,2) NOT NULL COMMENT '上家结算金额',
  `sh_type` int(11) NOT NULL COMMENT '上家结算类型:0发票,1扣税',
  `shouyi` decimal(10,2) NOT NULL COMMENT '收益金额',
  `image` varchar(250) NOT NULL COMMENT '官方截图',
  `status` int(11) NOT NULL COMMENT '结束状态0未结算1已结算',
  `pay` int(11) NOT NULL COMMENT '支付方式',
  `pay_account` varchar(250) NOT NULL,
  `file_kuan` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL COMMENT '推广地址',
  `des` text NOT NULL COMMENT '备注',
  `time` int(11) NOT NULL COMMENT '时间',
  `times` int(11) NOT NULL COMMENT '时间戳'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='包数据';

-- --------------------------------------------------------

--
-- 表的结构 `think_payway`
--

CREATE TABLE `think_payway` (
  `id` int(11) NOT NULL COMMENT '主键自增长',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `bank_type` int(11) NOT NULL COMMENT '银行类型',
  `bank_name` varchar(50) NOT NULL COMMENT '银行名称',
  `pay_account` varchar(50) NOT NULL COMMENT '支付账号',
  `pay_getname` varchar(50) NOT NULL COMMENT '收款账号',
  `pay_type` int(11) NOT NULL COMMENT '支付方式0支付宝1网银',
  `pay_default` int(11) NOT NULL COMMENT '默认支付方式',
  `create_time` int(11) NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户结算途径';

--
-- 转存表中的数据 `think_payway`
--

INSERT INTO `think_payway` (`id`, `mid`, `bank_type`, `bank_name`, `pay_account`, `pay_getname`, `pay_type`, `pay_default`, `create_time`) VALUES
(1, 1, 1, '1111', '1111 1111 1111 1111 111', '11', 1, 1, 0),
(2, 2, 1, '11', '1111 1111 1111 1111 111', '1111111111', 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_product`
--

CREATE TABLE `think_product` (
  `id` int(11) NOT NULL COMMENT '主键自增长',
  `title` varchar(50) NOT NULL COMMENT '产品名称',
  `desc` varchar(250) NOT NULL COMMENT '产品介绍',
  `image` varchar(500) NOT NULL COMMENT '产品封面',
  `content` text NOT NULL COMMENT '产品详情',
  `type` int(11) NOT NULL COMMENT '类型',
  `attr` varchar(500) NOT NULL COMMENT '产品属性',
  `price` varchar(50) NOT NULL COMMENT '价格',
  `sh_price` varchar(250) NOT NULL COMMENT '上家单价',
  `com` varchar(50) NOT NULL COMMENT '推荐',
  `top` int(11) NOT NULL COMMENT '置顶',
  `balance_time` varchar(50) NOT NULL COMMENT '结算周期:1日结2周结3月结',
  `service` varchar(50) NOT NULL COMMENT '客服',
  `sort` int(11) NOT NULL COMMENT '排序:降序数字越大越靠前',
  `status` int(11) NOT NULL COMMENT '产品状态:0正常1禁用',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `revise_time` int(11) NOT NULL COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品表';

-- --------------------------------------------------------

--
-- 表的结构 `think_producted`
--

CREATE TABLE `think_producted` (
  `id` int(11) NOT NULL COMMENT '逐渐自增长',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '栏目ID',
  `pid` int(11) NOT NULL COMMENT '开通产品',
  `title` varchar(100) NOT NULL COMMENT '包名',
  `resource` varchar(150) NOT NULL COMMENT '包资源',
  `download` int(11) NOT NULL COMMENT '下载资源',
  `type` varchar(250) NOT NULL COMMENT '包类型:0CPA 1CPS 2CPC 3CPM 4富媒体 ',
  `date` int(11) NOT NULL COMMENT '支付周期',
  `price` decimal(10,2) NOT NULL COMMENT '结算金额',
  `sh_price` decimal(10,2) NOT NULL COMMENT '上家',
  `des` varchar(500) NOT NULL COMMENT '备注',
  `pay_account` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL COMMENT '开通时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户开通产品表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_address`
--
ALTER TABLE `think_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_admin`
--
ALTER TABLE `think_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`gid`);

--
-- Indexes for table `think_article`
--
ALTER TABLE `think_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_column`
--
ALTER TABLE `think_column`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `think_flink`
--
ALTER TABLE `think_flink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_member`
--
ALTER TABLE `think_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `think_model`
--
ALTER TABLE `think_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_packdata`
--
ALTER TABLE `think_packdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_payway`
--
ALTER TABLE `think_payway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_product`
--
ALTER TABLE `think_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_producted`
--
ALTER TABLE `think_producted`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `think_address`
--
ALTER TABLE `think_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自动增长';
--
-- 使用表AUTO_INCREMENT `think_admin`
--
ALTER TABLE `think_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键,自增长', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `think_article`
--
ALTER TABLE `think_article`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键';
--
-- 使用表AUTO_INCREMENT `think_column`
--
ALTER TABLE `think_column`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `think_flink`
--
ALTER TABLE `think_flink`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键';
--
-- 使用表AUTO_INCREMENT `think_member`
--
ALTER TABLE `think_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自动增长', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `think_model`
--
ALTER TABLE `think_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `think_packdata`
--
ALTER TABLE `think_packdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键';
--
-- 使用表AUTO_INCREMENT `think_payway`
--
ALTER TABLE `think_payway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增长', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `think_product`
--
ALTER TABLE `think_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增长';
--
-- 使用表AUTO_INCREMENT `think_producted`
--
ALTER TABLE `think_producted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '逐渐自增长';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
