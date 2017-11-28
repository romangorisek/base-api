/*
Navicat MySQL Data Transfer

Source Server         : docker-phalcon
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : ekranj

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2017-11-28 11:38:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` varchar(36) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `child_id` varchar(36) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('421ba1f2-cd04-444c-92de-64a829bfab6c', 'user', null, '', '2017-11-27 21:46:37', null, '2017-11-27 21:46:37', null);
INSERT INTO `roles` VALUES ('c570932f-d639-4f48-bfde-065eab1c30db', 'super_admin', null, '', '2017-11-27 21:46:37', null, '2017-11-27 21:46:37', null);
INSERT INTO `roles` VALUES ('cf46920e-ca20-45f9-9ffd-9bb37d310c08', 'admin', null, '421ba1f2-cd04-444c-92de-64a829bfab6c', '2017-11-27 21:46:37', null, '2017-11-27 21:46:37', null);

-- ----------------------------
-- Table structure for `user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` varchar(36) NOT NULL DEFAULT '',
  `user_id` varchar(36) NOT NULL DEFAULT '',
  `role_id` varchar(36) NOT NULL DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES ('7b042793-34bd-4474-8dfe-04079e1ea8bd', 'b71b64f4-e862-45a8-8126-1aa5164fad4e', '421ba1f2-cd04-444c-92de-64a829bfab6c', '2017-11-27 22:12:42', null, '2017-11-27 22:12:42', null);
INSERT INTO `user_roles` VALUES ('96bd01c9-8616-4260-8941-7bb4c46279ff', 'f968b32e-020f-421c-9571-cf0a328d2e42', 'c570932f-d639-4f48-bfde-065eab1c30db', '2017-11-27 22:12:42', null, '2017-11-27 22:12:42', null);
INSERT INTO `user_roles` VALUES ('ac151e0b-89f6-4bc8-8793-9e1896061a9f', '5ea80d61-8ef3-4ada-8d99-0b19d3166695', 'cf46920e-ca20-45f9-9ffd-9bb37d310c08', '2017-11-27 22:12:42', null, '2017-11-27 22:12:42', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(36) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `recovery_token` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5cc3f638-16d8-4139-83d9-178f2ebc13c8', 'test', '$2y$10$c/r8BkNU5G4E2EcX1eJZf.T4wABG4jfYi5YlfbtokeZkyznNOYjOi', '0', null, null, '2017-11-28 10:23:16', null, '2017-11-28 10:23:16', null);
INSERT INTO `users` VALUES ('5ea80d61-8ef3-4ada-8d99-0b19d3166695', 'admin', '$2y$10$Q1XpQVbjJ9dx2YxTOle6UuXiCHMxUhzptqXKR2ICNZvd5t.iqAe4W', '1', null, null, '2017-10-13 22:02:55', null, '2017-10-13 22:02:55', null);
INSERT INTO `users` VALUES ('b71b64f4-e862-45a8-8126-1aa5164fad4e', 'user', '$2y$10$qG0HVCUUN.m27fnyn6Z7SuZdFp4Wz3SUWcRJMdxK./HtPoCHIe0r.', '0', null, null, '2017-11-27 22:10:36', null, '2017-11-27 22:10:36', null);
INSERT INTO `users` VALUES ('f968b32e-020f-421c-9571-cf0a328d2e42', 'super_admin', '$2y$10$qzYQZnUUCk.wRYlFUKyG4e2SesRo3ZvrAsZF9zoadjTEbgSxGmpxe', '0', null, null, '2017-11-27 21:53:03', null, '2017-11-27 21:53:03', null);
