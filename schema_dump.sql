-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Aug 19, 2010, 04:37 PM
-- 伺服器版本: 6.0.4
-- PHP 版本: 6.0.0-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `eebook`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `book`
-- 

CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '課程名稱',
  `title` text COLLATE utf8_unicode_ci NOT NULL COMMENT '書名',
  `author` text COLLATE utf8_unicode_ci NOT NULL COMMENT '作者',
  `original_cost` int(11) NOT NULL COMMENT '非會員售價',
  `cost` int(11) NOT NULL COMMENT '會員價',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `book`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `order`
-- 

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1' COMMENT '數量',
  `paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '付款狀況',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='訂單。一本書一個訂單。一個使用者可以有很多訂單，一個訂單訂(一本或多本的)單一科教科書。';

-- 
-- 列出以下資料庫的數據： `order`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '給無法登入系計中的人',
  `is_member` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_id` (`school_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `user`
-- 

