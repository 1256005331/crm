-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-05-24 13:05:22
-- 服务器版本： 5.5.58-log
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- 表的结构 `crm_activation`
--

CREATE TABLE IF NOT EXISTS `crm_activation` (
  `id` int(11) NOT NULL,
  `custom_id` int(11) NOT NULL COMMENT '客户名称',
  `plat_id` int(11) NOT NULL COMMENT '平台id',
  `activation_num` int(11) NOT NULL COMMENT '激活数量',
  `activation_time` int(11) NOT NULL COMMENT '激活日期',
  `belong` varchar(80) NOT NULL COMMENT '所属销售',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_customer`
--

CREATE TABLE IF NOT EXISTS `crm_customer` (
  `id` int(11) NOT NULL,
  `plat_id` varchar(255) DEFAULT '0' COMMENT '平台id',
  `customer_name` varchar(255) NOT NULL COMMENT '客户名称',
  `province` varchar(50) NOT NULL COMMENT '省份',
  `city` varchar(50) NOT NULL COMMENT '城市',
  `mobile` char(11) NOT NULL COMMENT '手机号码',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `belong` varchar(80) NOT NULL COMMENT '所属销售',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_loginlog`
--

CREATE TABLE IF NOT EXISTS `crm_loginlog` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL COMMENT '员工id',
  `login_time` int(11) NOT NULL COMMENT '登录时间',
  `login_ip` varchar(20) NOT NULL COMMENT '登录ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_money`
--

CREATE TABLE IF NOT EXISTS `crm_money` (
  `id` int(11) NOT NULL,
  `plat_id` int(11) NOT NULL COMMENT '平台id',
  `belong` varchar(80) NOT NULL COMMENT '所属销售',
  `bonus` varchar(10) NOT NULL DEFAULT '0' COMMENT '提成比例',
  `total_money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '总分润金额',
  `down_money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '已下发代理分润金额',
  `bonus_money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提成金额',
  `months` int(11) NOT NULL COMMENT '月份',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_platform`
--

CREATE TABLE IF NOT EXISTS `crm_platform` (
  `id` int(11) NOT NULL,
  `plat_name` varchar(255) NOT NULL COMMENT '平台名称',
  `company_name` varchar(255) NOT NULL COMMENT '公司名称',
  `telephone` varchar(20) NOT NULL COMMENT '联系电话',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_service`
--

CREATE TABLE IF NOT EXISTS `crm_service` (
  `id` int(11) NOT NULL,
  `custom_id` int(11) NOT NULL COMMENT '客户id',
  `plat_id` int(11) NOT NULL COMMENT '平台id',
  `card_id` varchar(20) NOT NULL COMMENT '序列号',
  `arrival_time` int(11) NOT NULL COMMENT '货到日期',
  `send_time` int(11) NOT NULL COMMENT '寄回日期',
  `reason` varchar(255) NOT NULL COMMENT '维修原因',
  `status` tinyint(1) NOT NULL COMMENT '处理进度/状态',
  `is_complete` tinyint(1) NOT NULL COMMENT '是否修好',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_sku`
--

CREATE TABLE IF NOT EXISTS `crm_sku` (
  `id` int(11) NOT NULL,
  `custom_id` int(11) NOT NULL COMMENT '客户id',
  `plat_id` int(11) NOT NULL COMMENT '平台名称',
  `order_num` varchar(20) NOT NULL COMMENT '采购单号',
  `card_id` varchar(20) NOT NULL COMMENT '序列号',
  `in_time` int(11) NOT NULL COMMENT '进货日期',
  `out_time` int(11) NOT NULL COMMENT '出货日期',
  `return_time` int(11) NOT NULL COMMENT '退回日期',
  `check_time` int(11) NOT NULL COMMENT '考核日期',
  `status` tinyint(1) NOT NULL COMMENT '新旧程度',
  `state` tinyint(1) NOT NULL COMMENT '数据状态 1、入库 2、出库 3、退库',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL,
  `put_operator` varchar(255) DEFAULT NULL COMMENT '入库操作人',
  `out_operator` varchar(255) DEFAULT NULL COMMENT '出库操作人'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_sku_log`
--

CREATE TABLE IF NOT EXISTS `crm_sku_log` (
  `id` int(11) NOT NULL COMMENT '主键',
  `active` tinyint(1) NOT NULL COMMENT '执行的操作',
  `card_id` text NOT NULL COMMENT '序列号',
  `username` varchar(255) NOT NULL COMMENT '是谁操作的',
  `run_type` tinyint(1) NOT NULL COMMENT '执行状态 0、执行成功 1、执行失败',
  `query_code` text NOT NULL COMMENT '执行的sql语句',
  `log_time` int(11) NOT NULL COMMENT '记录时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='库操作记录';

-- --------------------------------------------------------

--
-- 表的结构 `crm_trade`
--

CREATE TABLE IF NOT EXISTS `crm_trade` (
  `id` int(11) NOT NULL,
  `plat_id` int(11) NOT NULL COMMENT '平台id',
  `money` decimal(12,2) NOT NULL COMMENT '交易量',
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `crm_worker`
--

CREATE TABLE IF NOT EXISTS `crm_worker` (
  `id` int(11) NOT NULL,
  `account_pwd` varchar(32) NOT NULL COMMENT '账户密码',
  `realname` varchar(80) NOT NULL COMMENT '真实姓名',
  `mobile` char(11) NOT NULL COMMENT '手机号码',
  `position` tinyint(1) NOT NULL COMMENT '身份',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `account_auth` text NOT NULL COMMENT '账户权限',
  `create_time` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crm_activation`
--
ALTER TABLE `crm_activation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `plat_id` (`plat_id`);

--
-- Indexes for table `crm_customer`
--
ALTER TABLE `crm_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_name` (`customer_name`);

--
-- Indexes for table `crm_loginlog`
--
ALTER TABLE `crm_loginlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_money`
--
ALTER TABLE `crm_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_platform`
--
ALTER TABLE `crm_platform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_service`
--
ALTER TABLE `crm_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_sku`
--
ALTER TABLE `crm_sku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`card_id`),
  ADD KEY `state` (`state`),
  ADD KEY `card_id_2` (`card_id`),
  ADD KEY `state_2` (`state`),
  ADD KEY `plat_id` (`plat_id`),
  ADD KEY `custom_id` (`custom_id`),
  ADD KEY `card_id_3` (`card_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `crm_sku_log`
--
ALTER TABLE `crm_sku_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `crm_trade`
--
ALTER TABLE `crm_trade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_worker`
--
ALTER TABLE `crm_worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crm_activation`
--
ALTER TABLE `crm_activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_customer`
--
ALTER TABLE `crm_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_loginlog`
--
ALTER TABLE `crm_loginlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_money`
--
ALTER TABLE `crm_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_platform`
--
ALTER TABLE `crm_platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_service`
--
ALTER TABLE `crm_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_sku`
--
ALTER TABLE `crm_sku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_sku_log`
--
ALTER TABLE `crm_sku_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键';
--
-- AUTO_INCREMENT for table `crm_trade`
--
ALTER TABLE `crm_trade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_worker`
--
ALTER TABLE `crm_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
