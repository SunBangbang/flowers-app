
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '商品名称',
  `counts` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `img_url` varchar(255) DEFAULT NULL COMMENT '商品头图地址',
  `ctime` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `desc` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '商品分类ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', 'ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品', '86', '10.00', '/uploads/a948f792-7183-40da-9224-c2c6b808b8d8.jpg', '0', '1648712319', 'ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品', '41');
INSERT INTO `goods` VALUES ('2', '敦煌研究院 镜梳礼盒 博物馆文创礼品古风国潮创意', '193', '8.00', '/uploads/0c1c63d7-7f27-4b3f-b94b-c95f5f84e164.jpg', '0', '1648802926', 'ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品ROKR若客地球仪视界DIY手工礼物送女友创意复古摆件儿童生日礼品', '41');
INSERT INTO `goods` VALUES ('3', '歌斐颂小黑巧克力85%礼盒装送女友纯可可脂烘焙散装网红零食生日', '10', '5.50', '/uploads/d635e321-5024-4097-b88a-4d13641b0522.jpg', '0', '1648545538', '歌斐颂小黑巧克力85%礼盒装送女友纯可可脂烘焙散装网红零食生日歌斐颂小黑巧克力85%礼盒装送女友纯可可脂烘焙散装网红零食生日歌斐颂小黑巧克力85%礼盒装送女友纯可可脂烘焙散装网红零食生日', '40');
INSERT INTO `goods` VALUES ('4', '好时KISSES巧克力500g*2袋零食结婚喜糖散装批发', '100', '11.00', '/uploads/d67ee81e-15bd-4ca6-83a8-42611d2674d0.jpg', '0', '0', '好时KISSES巧克力500g*2袋零食结婚喜糖散装批发好时KISSES巧克力500g*2袋零食结婚喜糖散装批发好时KISSES巧克力500g*2袋零食结婚喜糖散装批发', '41');
INSERT INTO `goods` VALUES ('5', '味多美 天然奶油生日蛋糕 送老人寿星 祝寿蛋糕', '200', '13.00', '/uploads/21d98132-cf88-4b25-ab97-e2874e51029e.jpg', '0', '0', '味多美 天然奶油生日蛋糕 送老人寿星 祝寿蛋糕 味多美 天然奶油生日蛋糕 送老人寿星 祝寿蛋糕 味多美 天然奶油生日蛋糕 送老人寿星 祝寿蛋糕 ', '39');
INSERT INTO `goods` VALUES ('6', '诺心LECAKE 环游世界水果奶油芝士生日蛋糕', '300', '15.20', '/uploads/62557750-606a-41ed-a605-02550a6b50ab.jpg', '0', '0', '诺心LECAKE 环游世界水果奶油芝士生日蛋糕诺心LECAKE 环游世界水果奶油芝士生日蛋糕诺心LECAKE 环游世界水果奶油芝士生日蛋糕', '39');
INSERT INTO `goods` VALUES ('7', '永生花玻璃罩rose玫瑰真花only情人节礼物生日送女友闺蜜礼盒高级', '99', '5.60', '/uploads/3ebe6f44-2f0c-4ea7-a9e3-70784cff2163.jpg', '0', '1648802138', 'WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼', '38');
INSERT INTO `goods` VALUES ('8', 'THEBEAST/野兽派玫瑰永生花 音乐水晶球高颜值结婚生日礼物送女友', '200', '7.60', '/uploads/9f762590-e84d-4905-9cd7-0be402a71a14.jpg', '0', '0', 'WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼', '38');
INSERT INTO `goods` VALUES ('9', '虹越绣球花无尽夏盆栽花手鞠大花八仙花观花盆栽植物蓝色妈妈花卉', '300', '8.40', '/uploads/0962cca0-e660-4237-971b-52b5f7ba07b1.png', '0', '0', '虹越绣球花无尽夏盆栽花手鞠大花八仙花观花盆栽植物蓝色妈妈花卉虹越绣球花无尽夏盆栽花手鞠大花八仙花观花盆栽植物蓝色妈妈花卉虹越绣球花无尽夏盆栽花手鞠大花八仙花观花盆栽植物蓝色妈妈花卉', '37');
INSERT INTO `goods` VALUES ('10', 'WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼', '97', '9.60', '/uploads/6ec5b4f7-5fbb-49a2-b563-85bd4d81a8eb.jpg', '0', '1648793272', 'WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼WILDLOVE杨帆同款卧室台灯永生花送女友闺蜜结婚圣诞节礼物生日礼', '37');

-- ----------------------------
-- Table structure for goodsimg
-- ----------------------------
DROP TABLE IF EXISTS `goodsimg`;
CREATE TABLE `goodsimg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品图片ID',
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `img_url` varchar(255) NOT NULL DEFAULT '0' COMMENT '图片路径',
  `ctime` int(10) DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsimg
-- ----------------------------
INSERT INTO `goodsimg` VALUES ('1', '1', '/uploads/0962cca0-e660-4237-971b-52b5f7ba07b1.png', '0', '0');
INSERT INTO `goodsimg` VALUES ('2', '3', '/uploads/5c9230a6-7bf6-4a9d-90da-2ac1c59bcc4f.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('3', '5', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('4', '2', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('5', '4', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('6', '6', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('7', '7', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('8', '8', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('9', '9', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');
INSERT INTO `goodsimg` VALUES ('10', '10', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', '0', '0');

-- ----------------------------
-- Table structure for goodstype
-- ----------------------------
DROP TABLE IF EXISTS `goodstype`;
CREATE TABLE `goodstype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品分类表',
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `coverImage` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `createAt` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `updateAt` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `desc` varchar(255) DEFAULT NULL COMMENT '分类介绍',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodstype
-- ----------------------------
INSERT INTO `goodstype` VALUES ('37', '鲜花', '/uploads/8f9d0565-f117-4aeb-8164-8432ea176464.jpg', null, null, '鲜花APP');
INSERT INTO `goodstype` VALUES ('38', '永生花', '/uploads/79942b4f-fde4-4adc-a6b0-889a1df7be7d.jpg', null, null, '鲜花APP');
INSERT INTO `goodstype` VALUES ('39', '蛋糕', '/uploads/69d17017-fc89-46c7-919a-cca58662de47.jpg', null, null, '鲜花APP');
INSERT INTO `goodstype` VALUES ('40', '巧克力', '/uploads/5c9230a6-7bf6-4a9d-90da-2ac1c59bcc4f.jpg', null, null, '鲜花APP');
INSERT INTO `goodstype` VALUES ('41', '礼品', '/uploads/0c1c63d7-7f27-4b3f-b94b-c95f5f84e164.jpg', null, null, '鲜花APP');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `ctime` int(10) unsigned DEFAULT NULL,
  `mtime` int(10) unsigned DEFAULT NULL,
  `price` decimal(10,2) unsigned DEFAULT NULL COMMENT '订单总金额',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '1 正常订单 0 删除订单',
  `pay_status` tinyint(1) unsigned DEFAULT NULL COMMENT '1 支付成功 0  未支付',
  `address` varchar(255) DEFAULT '0',
  `phone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pay_type` varchar(255) DEFAULT NULL,
  `send_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('2', '3', '1648712186', '1648718636', '1118.00', '1', '1', '\'地址addresss\'', null, null, null, null);
INSERT INTO `order` VALUES ('3', '3', '1648712319', '1648713342', '10.00', '1', '1', '0', null, null, null, null);
INSERT INTO `order` VALUES ('4', '5', '1648714138', '1648795140', '90.00', '1', '1', '浙江省杭州市西湖区文三路 138 号东方通信大厦 7 楼 501 室', '13179865499', '张三', '微信支付', '快递配送(免运费)');
INSERT INTO `order` VALUES ('5', '5', '1648793048', '1648802969', '9.60', '0', '0', '', '', '', '', '');
INSERT INTO `order` VALUES ('6', '5', '1648793272', '1648795996', '9.60', '0', '0', '', '', '', '', '');
INSERT INTO `order` VALUES ('7', '5', '1648802151', '1648802211', '15.20', '1', '1', '北京市北京市朝阳区三里屯街道', '18515606659', 'sun ', '支付宝支付', '快递配送(免运费)');
INSERT INTO `order` VALUES ('8', '5', '1648802926', '1648802949', '8.00', '1', '1', '浙江省杭州市拱墅区莫干山路 50 号', '13189124863', '李四', '支付宝支付', '快递配送(免运费)');

-- ----------------------------
-- Table structure for ordersub
-- ----------------------------
DROP TABLE IF EXISTS `ordersub`;
CREATE TABLE `ordersub` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `counts` int(10) unsigned NOT NULL COMMENT '数量',
  `ctime` int(10) unsigned DEFAULT NULL COMMENT '加入时间',
  `mtime` int(10) DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '用户Id',
  `price` decimal(10,2) DEFAULT NULL,
  `order_id` int(10) unsigned NOT NULL COMMENT '订单id',
  `total_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordersub
-- ----------------------------
INSERT INTO `ordersub` VALUES ('6', '1', '100', '1648712186', '1648712186', '3', '10.00', '2', '1000.00');
INSERT INTO `ordersub` VALUES ('7', '2', '12', '1648712186', '1648712186', '3', '8.00', '2', '96.00');
INSERT INTO `ordersub` VALUES ('8', '3', '4', '1648712186', '1648712186', '3', '5.50', '2', '22.00');
INSERT INTO `ordersub` VALUES ('9', '1', '1', '1648712319', '1648712319', '3', '10.00', '3', '10.00');
INSERT INTO `ordersub` VALUES ('10', '1', '9', '1648714138', '1648714138', '5', '10.00', '4', '90.00');
INSERT INTO `ordersub` VALUES ('11', '10', '1', '1648793048', '1648793048', '5', '9.60', '5', '9.60');
INSERT INTO `ordersub` VALUES ('12', '10', '1', '1648793272', '1648793272', '5', '9.60', '6', '9.60');
INSERT INTO `ordersub` VALUES ('13', '10', '1', '1648802151', '1648802151', '5', '9.60', '7', '9.60');
INSERT INTO `ordersub` VALUES ('14', '7', '1', '1648802151', '1648802151', '5', '5.60', '7', '5.60');
INSERT INTO `ordersub` VALUES ('15', '2', '1', '1648802926', '1648802926', '5', '8.00', '8', '8.00');

-- ----------------------------
-- Table structure for shoppingcart
-- ----------------------------
DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `counts` int(10) unsigned NOT NULL COMMENT '数量',
  `ctime` int(10) unsigned DEFAULT NULL COMMENT '加入时间',
  `mtime` int(10) DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '用户Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shoppingcart
-- ----------------------------
INSERT INTO `shoppingcart` VALUES ('2', '2', '2', null, null, '3');
INSERT INTO `shoppingcart` VALUES ('7', '2', '1', '1648802921', '1648802921', '5');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userName` varchar(255) NOT NULL DEFAULT '0' COMMENT '账号',
  `nickName` varchar(36) DEFAULT NULL COMMENT '昵称',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `ctime` int(10) DEFAULT '0',
  `mtime` int(10) DEFAULT '0',
  `token` varchar(255) DEFAULT '0' COMMENT '登录验证字段 存在即为已登录 不存在为登出',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像地址',
  `age` int(10) unsigned DEFAULT '0' COMMENT '年龄',
  `area` varchar(255) DEFAULT NULL COMMENT '地区',
  `isLocked` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `createdAt` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `updatedAt` varchar(0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '测试1', '昵称1', '111', '0', '0', null, '', null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('2', '测试2', '昵称2', '111', '0', '0', null, '', null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('3', 'l1', '昵称3', '123', '1648446682', '1648448756', '63d0810c99f43ed859ec9d0f849ac3fc', 'https://img2.baidu.com/it/u=289538718,2137491427&fm=26&fmt=auto', null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('4', 'l2', '昵称4', '456', '1648452534', '1648452534', '', '', null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('5', '孙', '昵称5', '123456', '1648456551', '1648802906', '0493d39ef38e6eb226ccdbd598ba8369', '', null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('6', 'sun', '昵称6', '123456', '1648456727', '1648456727', '', '', null, null, null, null, null, null, null, null);
