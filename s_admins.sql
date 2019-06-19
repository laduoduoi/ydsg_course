/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 127.0.0.1:3306
 Source Schema         : ydsg_course

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 17/06/2019 11:39:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for s_admins
-- ----------------------------
DROP TABLE IF EXISTS `s_admins`;
CREATE TABLE `s_admins`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户姓名',
  `user_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '登录密码',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 103 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of s_admins
-- ----------------------------
INSERT INTO `s_admins` VALUES (1, 'root', 'root', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `s_admins` VALUES (102, '222', '$2y$10$/bLaXE1jF7xLhR4rMIn9uOLI7lPAI.uZ2PACxbmHStNLQB9RWLH5q', '2019-06-13 17:28:54', '2019-06-13 09:28:54');

-- ----------------------------
-- Table structure for s_banner_records
-- ----------------------------
DROP TABLE IF EXISTS `s_banner_records`;
CREATE TABLE `s_banner_records`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'banner地址',
  `sort` int(5) NOT NULL COMMENT '排序',
  `banner_id` int(10) NOT NULL COMMENT '广告位id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of s_banner_records
-- ----------------------------
INSERT INTO `s_banner_records` VALUES (1, '首页12', 'storage/banner/GTezA0Lc6z9tkY8ngikfHM0sM53l1QRx7Uai7iyZ.jpeg', 12, 2, '2019-06-14 16:35:59', '2019-06-14 08:35:59');
INSERT INTO `s_banner_records` VALUES (6, '2222', 'storage/banner/P3pJB6BnKl8mC3URWujx9rQD78RO3WwftooJv8Ll.png', 2, 3, '2019-06-13 17:59:38', '2019-06-13 08:41:19');
INSERT INTO `s_banner_records` VALUES (7, '33', 'storage/banner/iIT5iHqtAOCJIKYIUC6LSFEPDzDgs3zhvsL0L0hv.jpeg', 33, 2, '2019-06-13 10:11:00', '2019-06-13 10:11:00');

-- ----------------------------
-- Table structure for s_banners
-- ----------------------------
DROP TABLE IF EXISTS `s_banners`;
CREATE TABLE `s_banners`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标识',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of s_banners
-- ----------------------------
INSERT INTO `s_banners` VALUES (2, '首页', 'index', '2019-06-13 05:12:54', '2019-06-13 05:12:54');
INSERT INTO `s_banners` VALUES (3, '美食新闻', '22', '2019-06-13 05:29:30', '2019-06-13 05:29:30');
INSERT INTO `s_banners` VALUES (4, '文化新闻', '2', '2019-06-13 05:30:34', '2019-06-13 05:30:34');
INSERT INTO `s_banners` VALUES (6, '文化新闻4`', '1', '2019-06-13 14:33:25', '2019-06-13 06:33:25');

-- ----------------------------
-- Table structure for s_course_period_question_answers
-- ----------------------------
DROP TABLE IF EXISTS `s_course_period_question_answers`;
CREATE TABLE `s_course_period_question_answers`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '课时-问题-答案记录',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `question_id` int(10) NOT NULL COMMENT '问题id',
  `status` tinyint(1) NOT NULL COMMENT '1正确答案',
  `sort` int(5) NOT NULL COMMENT '排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of s_course_period_question_answers
-- ----------------------------
INSERT INTO `s_course_period_question_answers` VALUES (1, '11', 1, 1, 2, '2019-06-17 11:03:43', '2019-06-17 03:03:43');
INSERT INTO `s_course_period_question_answers` VALUES (2, '2', 1, 0, 0, '2019-06-14 09:40:01', '2019-06-14 09:40:01');
INSERT INTO `s_course_period_question_answers` VALUES (3, 'A、外面的', 1, 0, 0, '2019-06-17 02:39:21', '2019-06-17 02:39:21');

-- ----------------------------
-- Table structure for s_course_period_questions
-- ----------------------------
DROP TABLE IF EXISTS `s_course_period_questions`;
CREATE TABLE `s_course_period_questions`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '课时-问题记录',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '封面图',
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '视频',
  `audio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '音频',
  `period_id` int(10) NOT NULL COMMENT '课时id',
  `sort` int(5) NOT NULL COMMENT '排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of s_course_period_questions
-- ----------------------------
INSERT INTO `s_course_period_questions` VALUES (1, '问题1', 'storage/course/period/cover/BGhUaEJaCiFaJ0e3x6orfYsE2kWJBKeYNTWZu0U9.jpeg', 'storage/course/period/video/ox69HZ96KHRTpTwIBmZ7Kl3K2E0Tcu99FKNi1D6S.jpeg', 'storage/course/period/video/ox69HZ96KHRTpTwIBmZ7Kl3K2E0Tcu99FKNi1D6S.jpeg', 4, 10, '2019-06-14 17:12:57', '2019-06-14 09:09:41');
INSERT INTO `s_course_period_questions` VALUES (2, '问题1', 'storage/course/period/cover/oWUEV3tenbg8Bo78h3s2Ile93BWo1vpKdy3At86Q.jpeg', 'storage/course/period/video/OffJNaoi0uqS41wMLpt5hSpKvpsQaUzQyiEVsDLq.jpeg', 'C:\\Users\\Administrator\\AppData\\Local\\Temp\\php3B7C.tmp', 4, 10, '2019-06-14 09:10:19', '2019-06-14 09:10:19');

-- ----------------------------
-- Table structure for s_course_periods
-- ----------------------------
DROP TABLE IF EXISTS `s_course_periods`;
CREATE TABLE `s_course_periods`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '课时记录id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '视频',
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '封面图',
  `summary_video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '总结视频',
  `lyric` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '歌词',
  `read_number` int(10) NOT NULL DEFAULT 0 COMMENT 'l浏览次数',
  `status` tinyint(1) NOT NULL COMMENT '试用0，锁定1',
  `course_id` int(10) NOT NULL COMMENT '课程ID',
  `sort` int(5) NOT NULL COMMENT '排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of s_course_periods
-- ----------------------------
INSERT INTO `s_course_periods` VALUES (4, '文化新闻', 'http://127.0.0.1:8000/storage/course/period/cover/SJ6mkIfqgcFrhfpgdbDWYo0CjJ5Ae6wHx7cq3QLF.jpeg', 'http://127.0.0.1:8000/storage/course/period/cover/SJ6mkIfqgcFrhfpgdbDWYo0CjJ5Ae6wHx7cq3QLF.jpeg', 'http://127.0.0.1:8000/storage/course/period/cover/SJ6mkIfqgcFrhfpgdbDWYo0CjJ5Ae6wHx7cq3QLF.jpeg', '', 0, 0, 1, 0, '2019-06-14 16:55:08', '2019-06-14 08:55:08');

-- ----------------------------
-- Table structure for s_courses
-- ----------------------------
DROP TABLE IF EXISTS `s_courses`;
CREATE TABLE `s_courses`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '课程id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `introduce` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '介绍',
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '视频',
  `purchase_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '购买须知',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of s_courses
-- ----------------------------
INSERT INTO `s_courses` VALUES (1, '333222', '33111', 'storage/course/video/yZVGf7ZeFZ9IvutaZeuriO02RyvSyi3cHRlLWyWO.jpeg', '3311', 3311.00, '2019-06-14 16:29:19', '2019-06-14 08:29:19');
INSERT INTO `s_courses` VALUES (4, '66', '66', 'storage/course/video/dVUHfebW1gIxu7vUyb6ch0Ia3nsxPiPB589ruoQq.jpeg', '66', 66.00, '2019-06-14 05:43:41', '2019-06-14 05:43:41');
INSERT INTO `s_courses` VALUES (5, '44', '44', 'storage/course/video/DvNXNtEiJi2vKDOKvcOuTD78tRnOjI56DMtyV7dD.mp4', '44', 44.00, '2019-06-14 05:46:44', '2019-06-14 05:46:44');

-- ----------------------------
-- Table structure for s_migrations
-- ----------------------------
DROP TABLE IF EXISTS `s_migrations`;
CREATE TABLE `s_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for s_users
-- ----------------------------
DROP TABLE IF EXISTS `s_users`;
CREATE TABLE `s_users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
