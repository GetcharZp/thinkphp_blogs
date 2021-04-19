/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50728
Source Host           : localhost:3306
Source Database       : tp_blog

Target Server Type    : MYSQL
Target Server Version : 50728
File Encoding         : 65001

Date: 2021-04-20 00:38:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(110) NOT NULL COMMENT '描述',
  `content` longtext NOT NULL,
  `num` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` VALUES ('1', '1', '2', 'Java入门', 'Java入门 正文\n', '<p>Java入门 <strong>正文</strong></p>', '4', '1', '1618832260', null);
INSERT INTO `tp_article` VALUES ('2', '1', '1', 'thinkphp在模板中使用php的函数', 'thinkphp在模板中使用php的函数\nthinkphp在模板中使用php的函数\n使用 {:函数名}的', '<h1><a href=\"https://www.cnblogs.com/GetcharZp/p/11901859.html\" target=\"_blank\" style=\"color: rgb(51, 51, 51);\">thinkphp在模板中使用php的函数</a></h1><p>thinkphp在模板中使用php的函数</p><p>使用 {:函数名}的形式</p><p><br></p><p>例如：</p><pre class=\"ql-syntax\" spellcheck=\"false\">// 获取 session 中存的值\n{:session(\'admin.loginname\')}\n\n// 输出当前日期\n{:date(\'Y-m-d H:i:s\', time())}\n</pre><p>&nbsp;</p><p>Aspire to inspire until I expire</p>', '4', '1618829483', '1618829483', null);
INSERT INTO `tp_article` VALUES ('3', '1', '1', 'thinkphp在模板中使用php的函数', 'thinkphp在模板中使用php的函数\nthinkphp在模板中使用php的函数\n使用 {:函数名} 的形式\n \n例如：\n// 获取 session 中存的值\n{:session(\'admin.lo', '<h1><a href=\"https://www.cnblogs.com/GetcharZp/p/11901859.html\" target=\"_blank\" style=\"color: rgb(51, 51, 51);\">thinkphp在模板中使用php的函数</a></h1><p>thinkphp在模板中使用php的函数</p><p>使用 {:函数名} 的形式</p><p>&nbsp;</p><p>例如：</p><pre class=\"ql-syntax\" spellcheck=\"false\">// 获取 session 中存的值\n{:session(\'admin.loginname\')}\n\n// 输出当前日期\n{:date(\'Y-m-d H:i:s\', time())}\n</pre><p>&nbsp;</p><p>Aspire to inspire until I expire</p>', '3', '1618829686', '1618829686', null);
INSERT INTO `tp_article` VALUES ('4', '1', '1', 'thinkphp在模板中使用php的函数', '删除测试\n', '<p>删除测试</p>', '0', '1618830731', '1618830764', '1618830764');

-- ----------------------------
-- Table structure for tp_cate
-- ----------------------------
DROP TABLE IF EXISTS `tp_cate`;
CREATE TABLE `tp_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '使用的次数',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_cate
-- ----------------------------
INSERT INTO `tp_cate` VALUES ('1', 'php', '0', '1', '1', null);
INSERT INTO `tp_cate` VALUES ('2', 'Java', '0', '1618642566', '1618642566', null);
INSERT INTO `tp_cate` VALUES ('3', 'Python', '0', '1618642606', '1618643221', null);
INSERT INTO `tp_cate` VALUES ('4', '.Net', '0', '1618643871', '1618644182', null);

-- ----------------------------
-- Table structure for tp_conf
-- ----------------------------
DROP TABLE IF EXISTS `tp_conf`;
CREATE TABLE `tp_conf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `copyright` varchar(100) NOT NULL,
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_conf
-- ----------------------------
INSERT INTO `tp_conf` VALUES ('1', 'GetcharZp', '0');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '{0:普通用户，1:管理员}',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', 'GetcharZp', '123456', '1', '1', '1', null);
