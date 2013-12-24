/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : hehe

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-12-24 22:28:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tb_address`
-- ----------------------------
DROP TABLE IF EXISTS `tb_address`;
CREATE TABLE `tb_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) DEFAULT NULL,
  `type` tinyint(10) DEFAULT NULL,
  `area` int(4) DEFAULT NULL,
  `sArea` varchar(300) DEFAULT NULL,
  `community` int(11) DEFAULT NULL,
  `sCommunity` varchar(300) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `isDefault` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_address
-- ----------------------------
INSERT INTO tb_address VALUES ('1', '13688170907', '1', null, '天府软件园', null, 'E3', '地址', null, '1');

-- ----------------------------
-- Table structure for `tb_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `insertTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO tb_admin VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '管理员', '1@163.com', '2013-06-26 17:13:32', '1');

-- ----------------------------
-- Table structure for `tb_area`
-- ----------------------------
DROP TABLE IF EXISTS `tb_area`;
CREATE TABLE `tb_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_area
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_default`
-- ----------------------------
DROP TABLE IF EXISTS `tb_default`;
CREATE TABLE `tb_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_default
-- ----------------------------
INSERT INTO tb_default VALUES ('1', '外资(欧美)');
INSERT INTO tb_default VALUES ('2', '外资(非欧美)');
INSERT INTO tb_default VALUES ('3', '合资(欧美)');
INSERT INTO tb_default VALUES ('4', '合资(非欧美)');
INSERT INTO tb_default VALUES ('5', '国企');
INSERT INTO tb_default VALUES ('6', '民营公司');
INSERT INTO tb_default VALUES ('7', '外企代表处');
INSERT INTO tb_default VALUES ('8', '政府机关');
INSERT INTO tb_default VALUES ('9', '事业单位');
INSERT INTO tb_default VALUES ('10', '非盈利机构');
INSERT INTO tb_default VALUES ('11', '其它性质');

-- ----------------------------
-- Table structure for `tb_dish`
-- ----------------------------
DROP TABLE IF EXISTS `tb_dish`;
CREATE TABLE `tb_dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `price` decimal(24,4) DEFAULT NULL,
  `description` text,
  `tasteSweet` tinyint(4) DEFAULT NULL COMMENT '��ζƫ�ỹ��ƫ��',
  `tasteSpicy` tinyint(4) DEFAULT NULL COMMENT '��ζ�����ǲ���',
  `insertTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '1' COMMENT '0��ʵЧ\r\n            1������',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_dish
-- ----------------------------
INSERT INTO tb_dish VALUES ('24', 'ad', '1', '10.0000', 'asfsadfas', null, null, '2013-11-28 15:12:49', '1');
INSERT INTO tb_dish VALUES ('26', '测试', '1', '10.0000', 'description', null, null, '2013-11-28 16:42:09', '1');
INSERT INTO tb_dish VALUES ('27', 'srfesfe', '1', '15.0000', '123123', null, null, '2013-12-06 21:12:17', '1');
INSERT INTO tb_dish VALUES ('28', 'srfesfe', '1', '15.0000', '123e123', null, null, '2013-12-09 21:27:00', '1');
INSERT INTO tb_dish VALUES ('29', 'srfesfe', '1', '15.0000', '123e123', null, null, '2013-12-09 21:28:19', '1');
INSERT INTO tb_dish VALUES ('30', 'srfesfe', '1', '15.0000', '123e123', null, null, '2013-12-09 21:28:47', '1');
INSERT INTO tb_dish VALUES ('31', 'srfesfe', '1', '15.0000', '123e123', null, null, '2013-12-09 21:29:10', '1');

-- ----------------------------
-- Table structure for `tb_dishimage`
-- ----------------------------
DROP TABLE IF EXISTS `tb_dishimage`;
CREATE TABLE `tb_dishimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `imgUrl` varchar(255) DEFAULT NULL,
  `isCover` tinyint(4) DEFAULT NULL,
  `dishId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_dishimage
-- ----------------------------
INSERT INTO tb_dishimage VALUES ('3', '', '/upload/dish/529701e19f292.jpg', null, '26');
INSERT INTO tb_dishimage VALUES ('4', null, '/upload/dish/529701e19f292.jpg', null, '24');
INSERT INTO tb_dishimage VALUES ('6', '', '/upload/dish52a5c6f82e439.jpg', null, '31');

-- ----------------------------
-- Table structure for `tb_distributor`
-- ----------------------------
DROP TABLE IF EXISTS `tb_distributor`;
CREATE TABLE `tb_distributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_distributor
-- ----------------------------
INSERT INTO tb_distributor VALUES ('1', '配送1', '13588888888');
INSERT INTO tb_distributor VALUES ('2', '配送2', '13588888888');

-- ----------------------------
-- Table structure for `tb_distributorarea`
-- ----------------------------
DROP TABLE IF EXISTS `tb_distributorarea`;
CREATE TABLE `tb_distributorarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distributorId` int(11) NOT NULL,
  `areaId` int(11) NOT NULL,
  `communityId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_distributorarea
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datename` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_menu
-- ----------------------------
INSERT INTO tb_menu VALUES ('1', '2013-12-02 00:00:00', '1');
INSERT INTO tb_menu VALUES ('2', '2013-12-04 00:00:00', '1');
INSERT INTO tb_menu VALUES ('3', '2013-12-15 00:00:00', '1');
INSERT INTO tb_menu VALUES ('4', '2013-12-18 00:00:00', '1');
INSERT INTO tb_menu VALUES ('5', '2013-12-19 00:00:00', '1');
INSERT INTO tb_menu VALUES ('6', '2013-12-20 00:00:00', '1');
INSERT INTO tb_menu VALUES ('7', '2013-12-21 00:00:00', '1');
INSERT INTO tb_menu VALUES ('8', '2013-12-22 00:00:00', '1');
INSERT INTO tb_menu VALUES ('9', '2013-12-23 00:00:00', '1');
INSERT INTO tb_menu VALUES ('10', '2013-12-24 00:00:00', '1');
INSERT INTO tb_menu VALUES ('15', '2013-12-01 00:00:00', '1');

-- ----------------------------
-- Table structure for `tb_menudish`
-- ----------------------------
DROP TABLE IF EXISTS `tb_menudish`;
CREATE TABLE `tb_menudish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuId` int(11) DEFAULT NULL,
  `dishId` int(11) DEFAULT NULL,
  `dishName` varchar(255) DEFAULT NULL,
  `price` decimal(24,4) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT '0',
  `orderBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_menudish
-- ----------------------------
INSERT INTO tb_menudish VALUES ('1', '1', '26', '测试', '10.0000', '100', '0', '1');
INSERT INTO tb_menudish VALUES ('2', '1', '25', 'ad', '10.0000', '200', '0', '2');
INSERT INTO tb_menudish VALUES ('3', '1', '24', 'ad', '10.0000', '300', '0', '3');
INSERT INTO tb_menudish VALUES ('4', '2', '26', '测试', '10.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('5', '2', '25', 'ad', '10.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('6', '2', '24', 'ad', '10.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('7', '3', '24', 'ad', '10.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('8', '4', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('9', '4', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('10', '4', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('11', '4', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('12', '4', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('13', '4', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('14', '4', '24', 'ad', '10.0000', '20', '0', '7');
INSERT INTO tb_menudish VALUES ('15', '5', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('16', '5', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('17', '5', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('18', '5', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('19', '5', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('20', '5', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('21', '5', '24', 'ad', '10.0000', '20', '0', '7');
INSERT INTO tb_menudish VALUES ('22', '6', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('23', '6', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('24', '6', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('25', '6', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('26', '6', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('27', '6', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('28', '6', '24', 'ad', '10.0000', '20', '0', '7');
INSERT INTO tb_menudish VALUES ('29', '7', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('30', '7', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('31', '7', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('32', '7', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('33', '7', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('34', '7', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('35', '7', '24', 'ad', '10.0000', '20', '0', '7');
INSERT INTO tb_menudish VALUES ('36', '8', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('37', '8', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('38', '8', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('39', '8', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('40', '8', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('41', '8', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('42', '8', '24', 'ad', '10.0000', '20', '0', '7');
INSERT INTO tb_menudish VALUES ('43', '9', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('44', '9', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('45', '9', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('46', '9', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('47', '9', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('48', '9', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('49', '9', '24', 'ad', '10.0000', '20', '0', '7');
INSERT INTO tb_menudish VALUES ('50', '10', '31', 'srfesfe', '15.0000', '20', '0', '1');
INSERT INTO tb_menudish VALUES ('51', '10', '30', 'srfesfe', '15.0000', '20', '0', '2');
INSERT INTO tb_menudish VALUES ('52', '10', '29', 'srfesfe', '15.0000', '20', '0', '3');
INSERT INTO tb_menudish VALUES ('53', '10', '28', 'srfesfe', '15.0000', '20', '0', '4');
INSERT INTO tb_menudish VALUES ('54', '10', '27', 'srfesfe', '15.0000', '20', '0', '5');
INSERT INTO tb_menudish VALUES ('55', '10', '26', '测试', '10.0000', '20', '0', '6');
INSERT INTO tb_menudish VALUES ('56', '10', '24', 'ad', '10.0000', '20', '0', '7');

-- ----------------------------
-- Table structure for `tb_order`
-- ----------------------------
DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(32) NOT NULL,
  `source` tinyint(4) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `account` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company` varchar(300) DEFAULT NULL,
  `address` varchar(600) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `totalNumber` int(11) DEFAULT NULL,
  `totalPrice` decimal(24,4) DEFAULT NULL,
  `insertTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deliveryTime` datetime DEFAULT NULL,
  `successTime` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `distributorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IX_Order_sn` (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_order
-- ----------------------------
INSERT INTO tb_order VALUES ('1', '201312020001', '2', '2013-12-02 00:00:00', '13688170907', 'seven', null, '地址', '1368817090', '3', '30.0000', '2013-12-02 21:51:45', null, null, '3', '1');
INSERT INTO tb_order VALUES ('2', '201312020002', '3', '2013-12-04 00:00:00', '13688170907', 'seven', null, '地址', '1368817090', '3', '30.0000', '2013-12-04 21:54:04', null, null, '3', '1');
INSERT INTO tb_order VALUES ('3', '201312020003', '4', '2013-12-06 00:00:00', '13688170907', 'seven', null, '地址', '1368817090', '2', '20.0000', '2013-12-06 21:13:09', null, null, '3', '2');
INSERT INTO tb_order VALUES ('4', '2013-12-1500100004', '1', '2013-12-15 00:00:00', '13688170907', 'seven', null, '地址', '1368817090', '2', '20.0000', '2013-12-15 17:50:50', null, null, '5', null);

-- ----------------------------
-- Table structure for `tb_orderdish`
-- ----------------------------
DROP TABLE IF EXISTS `tb_orderdish`;
CREATE TABLE `tb_orderdish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `dishId` int(11) DEFAULT NULL,
  `dishName` varchar(255) DEFAULT NULL,
  `price` decimal(24,4) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_orderdish
-- ----------------------------
INSERT INTO tb_orderdish VALUES ('1', '1', '24', 'ad', '10.0000', '1');
INSERT INTO tb_orderdish VALUES ('2', '1', '25', 'ad', '10.0000', '1');
INSERT INTO tb_orderdish VALUES ('3', '1', '26', '测试', '10.0000', '1');
INSERT INTO tb_orderdish VALUES ('4', '2', '24', 'ad', '10.0000', '1');
INSERT INTO tb_orderdish VALUES ('5', '2', '25', 'ad', '10.0000', '1');
INSERT INTO tb_orderdish VALUES ('6', '2', '26', '测试', '10.0000', '1');
INSERT INTO tb_orderdish VALUES ('7', '3', '24', 'ad', '10.0000', '2');
INSERT INTO tb_orderdish VALUES ('8', '4', '24', 'ad', '10.0000', '2');

-- ----------------------------
-- Table structure for `tb_orderlog`
-- ----------------------------
DROP TABLE IF EXISTS `tb_orderlog`;
CREATE TABLE `tb_orderlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `remark` varchar(300) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `insertTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_orderlog
-- ----------------------------
INSERT INTO tb_orderlog VALUES ('1', '3', '3', '订单配送成功', 'admin', '2013-12-15 22:14:34');

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `insertTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT NULL,
  `integral` decimal(24,4) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `QQ` varchar(20) DEFAULT NULL,
  `weiboAccount` varchar(200) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `lastLoginTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO tb_user VALUES ('1', '13688170907', null, '13688170907', '2013-12-24 21:18:41', '-1', '0.0000', '姓名', null, '12312312321', 'weibo', '2012-12-12 00:00:00', null);

-- ----------------------------
-- Table structure for `tb_userlog`
-- ----------------------------
DROP TABLE IF EXISTS `tb_userlog`;
CREATE TABLE `tb_userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(200) DEFAULT NULL,
  `operation` tinyint(4) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `insertTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_userlog
-- ----------------------------
