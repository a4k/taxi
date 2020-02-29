/*
Navicat MySQL Data Transfer

Source Server         : 176.57.214.195
Source Server Version : 50729
Source Host           : localhost:3306
Source Database       : taxi

Target Server Type    : MYSQL
Target Server Version : 50729
File Encoding         : 65001

Date: 2020-02-29 19:52:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1582444814');
INSERT INTO `migration` VALUES ('m200222_152300_users', '1582444816');
INSERT INTO `migration` VALUES ('m200222_152311_orders', '1582533703');

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `drive_class` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'FREE',
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', 'sdfsdf', 'xcvsdfs', null, 'ECONOM', 'FINISH', '2', 'test', '3', '1582535265', '1582547480', null);
INSERT INTO `orders` VALUES ('2', 'ул. Кирова', 'ул. Ленина', null, 'ECONOM', 'FINISH', '2', '+7923942934', '3', '1582547692', '1582806074', null);
INSERT INTO `orders` VALUES ('3', 'Удмуртская 208', 'Пушкинская 48', null, 'ECONOM', 'FINISH', '2', 'test', '3', '1582556532', '1582806411', null);
INSERT INTO `orders` VALUES ('4', 'Советская 40', 'Майская 12', null, 'COMFORT', 'FINISH', '2', 'test', '3', '1582556654', '1582968264', null);
INSERT INTO `orders` VALUES ('5', 'Ааа', 'Ббб', null, 'CHILDREN', 'FINISH', '2', 'test', '3', '1582806011', '1582806480', null);
INSERT INTO `orders` VALUES ('6', 'vfqcrfz 0', 'cjdtncrfz 2', null, 'ECONOM', 'FREE', '4', '51515151', null, '1582806201', '1582806201', null);
INSERT INTO `orders` VALUES ('7', 'Ппп', 'Ввв', null, 'ECONOM', 'FINISH', '6', '89641842444', '7', '1582806683', '1582807122', null);
INSERT INTO `orders` VALUES ('8', 'Ааа', 'Ввв', null, 'COMFORT', 'FINISH', '6', '89641842444', '7', '1582807020', '1582807127', null);
INSERT INTO `orders` VALUES ('9', 'Ппп', 'Ббб', null, 'ECONOM', 'PASSENGER_WAITING', '6', '89641842444', '7', '1582807249', '1582807270', null);
INSERT INTO `orders` VALUES ('10', 'Ппп', 'Ввв', null, 'ECONOM', 'PASSENGER_WAITING', '6', '89641842444', '7', '1582807298', '1582807318', null);
INSERT INTO `orders` VALUES ('11', 'ои', 'аи', null, 'COMFORT', 'PASSENGER_WAITING', '2', '99999', '3', '1582969948', '1582969981', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT 'CLIENT',
  `access_token` varchar(255) DEFAULT NULL,
  `car_name` varchar(64) DEFAULT 'Toyota',
  `car_color` varchar(64) DEFAULT 'Черный',
  `car_number` varchar(64) DEFAULT 'A304BC',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin', 'admin', null, 'ADMIN', null, 'Toyota', 'Черный', 'A304BC');
INSERT INTO `users` VALUES ('2', 'test', 'test', 'testtest', null, 'CLIENT', null, 'Toyota', 'Черный', 'A304BC');
INSERT INTO `users` VALUES ('3', '+79999999', 'driver', 'testtest', null, 'DRIVER', null, 'Toyota', 'Черный', 'A304BC');
INSERT INTO `users` VALUES ('4', '51515151', 'кристина', 'qwerty', null, 'CLIENT', null, 'Toyota', 'Черный', 'A304BC');
INSERT INTO `users` VALUES ('5', '515151511', 'qwerty', 'asdfg1', null, 'DRIVER', null, 'Toyota', 'Черный', 'A304BC');
INSERT INTO `users` VALUES ('6', '89641842444', 'Тест', 'testtest', null, 'CLIENT', null, 'Toyota', 'Черный', 'A304BC');
INSERT INTO `users` VALUES ('7', '89508233785', 'Вод', 'testtest', null, 'DRIVER', null, 'Toyota', 'Черный', 'A304BC');
