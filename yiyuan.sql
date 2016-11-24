-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-11-25 02:26:30
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yiyuan`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE `tp_admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(120) NOT NULL,
  `ctime` varchar(120) NOT NULL,
  `sort` tinyint(4) DEFAULT '0',
  `name` varchar(120) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `uniqid` varchar(200) NOT NULL,
  `ys_id` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) NOT NULL,
  `groupid` varchar(255) NOT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `tel` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `age` varchar(120) DEFAULT NULL,
  `sex` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`id`, `uuid`, `ctime`, `sort`, `name`, `pwd`, `uniqid`, `ys_id`, `checked`, `groupid`, `realname`, `tel`, `phone`, `picurl`, `age`, `sex`) VALUES
(7, 'a41d742a96adf993aec2aabfeecd88fe', '1461597945', 0, 'admin', '7c222fb2927d828af22f592134e8932480637c0d', '8d13c8774c4688d649e1079f9c85df71b507a29a', NULL, 1, '1', '超级管理员', '', '', NULL, NULL, NULL),
(8, 'bec26d4f9ab501fa3240d6f7196135fa', '1461598202', 0, 'kongqi', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'bdb0e778d44d945729a0bcdf450e748d5e2c6f34', NULL, 1, '8', '空气', '', '', NULL, NULL, NULL),
(16, 'd41a4663f45a6c2fb3a942b6d21995b5', '1477028144', 0, 'zixun2', '7c4a8d09ca3762af61e59520943dc26494f8941b', '695b7cc8ab7b83d3b4153e6992a0e64d2a8d9669', NULL, 1, '8', '咨询人员2', NULL, NULL, NULL, NULL, NULL),
(17, 'c7bfbf848eaf02cc6b2585055cf1712a', '1478092891', 0, 'bbb', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'f3819fd17fc395053bcf8b3d75611a246d5d96bb', NULL, 1, '12', '123456', NULL, NULL, NULL, NULL, NULL),
(18, 'a4aee3b8f5e92f2c0f803cdac953edec', '1478092920', 0, 'aaa', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'e75a6cb60d2ec68de87ba884dc267348bca46f72', NULL, 1, '1', 'aaa', NULL, NULL, NULL, NULL, NULL),
(19, 'd96dc82a10c12b82866f236796d6032e', '1478145516', 0, 'huifang', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ff28d0a1783936854e75acbbe50cfedab01bb65f', NULL, 1, '9', 'huifang', NULL, NULL, NULL, NULL, NULL),
(20, '593d183850af7a4fa58f3327e68d9181', '1478158881', 0, 'shichang', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'd4d98dfa7340b5a15ad1cb2b7d5b32ea720bb623', NULL, 1, '10', '市场老大', NULL, NULL, NULL, NULL, NULL),
(21, '82cf7b12050ac9a1360b9263bbec26ed', '1478247433', 0, 'niuniu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '6c9268ddca2c28d049258ef44656b0cfd650aeba', NULL, 1, '12', '刘晓峰', NULL, NULL, NULL, NULL, NULL),
(22, 'aefcc60cd19c5998da9389346d2593f9', '1478328104', 0, 'jj', '7c4a8d09ca3762af61e59520943dc26494f8941b', '05cc8729dcb7e7f505aca0d549dfc9cea7427c0b', NULL, 1, '7', '推广', NULL, NULL, NULL, NULL, NULL),
(23, '713f7164eed3b315680e45f721a80cfe', '1478329654', 0, 'jiedai', '7c4a8d09ca3762af61e59520943dc26494f8941b', '5155cc604952f4ccc8eddd8c08ec4a6325ec323d', NULL, 1, '11', '接待', NULL, NULL, NULL, NULL, NULL),
(24, '678d917831ea5502e1e8caffe890826c', '1478330113', 0, 'doc', '7c4a8d09ca3762af61e59520943dc26494f8941b', '9ef3136157cbace48cd3f55e2a968e3b10cd19cb', NULL, 1, '12', 'doc', NULL, NULL, NULL, NULL, NULL),
(25, 'd4a9275e14ab3c8a625cce2620c8a2fa', '1478421181', 0, 'kefu', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'cc235163cac96a633bc179fe1478d767ab832edd', NULL, 1, '15', 'kefu', NULL, NULL, NULL, NULL, NULL),
(26, 'c6b1d9a5fab110b77ca4c4309e981b1a', '1479025147', 0, 'sf', '7c4a8d09ca3762af61e59520943dc26494f8941b', '638f677699f6ab0eae2656102824876e12e2afef', NULL, 1, '14', 'sf', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin_group`
--

CREATE TABLE `tp_admin_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(120) NOT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `name` varchar(120) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT '1',
  `intro` varchar(255) DEFAULT NULL,
  `ruleid` text,
  `brly_id` varchar(255) DEFAULT NULL,
  `is_zixun` tinyint(4) DEFAULT '0',
  `is_hf` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_admin_group`
--

INSERT INTO `tp_admin_group` (`id`, `uuid`, `ctime`, `sort`, `name`, `checked`, `intro`, `ruleid`, `brly_id`, `is_zixun`, `is_hf`) VALUES
(1, 'c2636a42c5fd997e7cfeb1e62d317068', '1461597324', 0, '超级管理员', 1, NULL, 'root', NULL, 0, 0),
(7, '4e5fd97a361bcfdf56509409866601e4', '1476431332', 0, '竞价人员', 1, NULL, 'yuyue_show,yuyue_seven_show,days_price,days_price_add,days_price_edit,days_price_del,days_price_only', '69', 0, 0),
(8, '776e506b219fcf1f1ba1072fd4606d9d', '1476581963', 0, '网电咨询员', 1, NULL, 'yuyue,yuyue_add,zixun_show,yuyue_show,yuyue_only,huifangset,huifangset_add,huifangset_edit,huifangset_list,hfrenwu,hfrenwu_add,hfrenwu_edit,hfrenwu_del,huihfrenwu_list,gongzuoliang,gongzuoliang_add,gongzuoliang_edit,gongzuoliang_del,gongzuoliang_only,qiantaijz_del,login_website_zixun,btn,btn_huifang,btn_huifang_add,btn_sms,btn_renwu_add', '69', 1, 1),
(9, '14c5163970529eec899679d61515b5d6', '1476852990', 0, '客服人员', 1, NULL, 'zixun_show,yuyue_show,huifangset,huifangset_add,huifangset_edit,huifangset_del,huifangset_list,hfrenwu,hfrenwu_add,hfrenwu_edit,hfrenwu_del,huihfrenwu_list,btn,btn_huifang,btn_huifang_add,btn_sms,btn_renwu_add', NULL, 0, 1),
(10, '73e82e3e67dbea44122808130c5adc4b', '1476855611', 0, '市场渠道人员', 1, NULL, 'yuyue_add,zixun_show,yuyue_show,yuyue_only,yuyue_other,huifangset,huifangset_add,huifangset_edit,huifangset_only,huifangset_list,hfrenwu,hfrenwu_add,hfrenwu_edit,huihfrenwu_list,hfrenwu_only,hfrenwu_only_handle,jiugouset,jiugouset_add,jiugouset_edit,login_website_shichang,btn,btn_huifang,btn_huifang_add,btn_sms,btn_renwu_add', '68', 1, 1),
(11, '5c80adb2812c097fca6f2e90d966e8fb', '1476962575', 0, '前台接诊咨询人员', 1, NULL, 'yuyue_add,yuyue_show,huifangset,huifangset_edit,huifangset_del,huifangset_list,hfrenwu,hfrenwu_add,hfrenwu_edit,hfrenwu_del,huihfrenwu_list,qiantaijz,qiantaijz_add,qiantaijz_edit,qiantaijz_del,login_website_jiezhen,btn_huifang', NULL, 0, 0),
(12, '0aaf0f2040429c5d177394d4ed7d666f', '1476962610', 0, '医生人员', 1, NULL, 'yuyue_show,huifangset,huifangset_add,huifangset_edit,huifangset_only,huifangset_list,hfrenwu,hfrenwu_add,hfrenwu_edit,huihfrenwu_list,yishenjz,yishenjz_add,yishenjz_edit,yishenjz_del,yishenjz_only,yishenjz_only_list,kaidan,kaidan_add,kaidan_edit,kaidan_del,login_website_doc', NULL, 0, 1),
(13, '2d729989c513f714e4ba3d09e2885f9a', '1477053156', 0, 'aa', 1, NULL, 'yuyue_show,yishenjz,yishenjz_add,yishenjz_edit,yishenjz_del,dingjing', '68,69,70,71', 1, 1),
(14, '292eb4648bef8a0f701a528c4086f699', '1477067826', 0, '收费员', 1, NULL, 'shouyin,shouyin_check,shouyin_jiesuan,dingjing,login_website_caiwu', NULL, 0, 0),
(15, 'eefc34e527b0b2b5ad0777b6e4101114', '1478421162', 0, '客服部', 1, NULL, 'yuyue_show,huifangset,huifangset_add,huifangset_edit,huifangset_del,huifangset_list,hfrenwu,hfrenwu_add,hfrenwu_edit,hfrenwu_del,huihfrenwu_list,login_website_kefu,btn,btn_huifang_add,btn_sms,btn_renwu_add,kefu', NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin_rule`
--

CREATE TABLE `tp_admin_rule` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(120) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `sort` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_admin_rule`
--

INSERT INTO `tp_admin_rule` (`id`, `fid`, `name`, `path`, `ename`, `mark`, `uuid`, `sort`) VALUES
(1, 0, '权限规则', NULL, 'rule', '', '73955b23f2cfd70cb6f846132ac206dd', 0),
(2, 0, '管理员', NULL, 'admin', '', 'ed4b21e312a624ffcae728b6aff78d82', 0),
(3, 1, '添加权限规则', '1', 'rule_add', '', '9f558cfdde08fb1b88c8d8917e668d7d', 0),
(4, 1, '编辑权限规则', '1', 'rule_edit', '', 'bff3079843a3fddd4ce5e4e3f4be1111', 0),
(5, 1, '删除权限规则', '1', 'rule_del', '', '5f98aaee3d4a22133bf9cb853e475cf8', 0),
(6, 2, '添加管理员', '2', 'admin_add', '', '048cfd73ad0bd49e97a1ace8c83f003f', 0),
(7, 2, '编辑管理员', '2', 'admin_edit', '', '6e6c0bade8905113aa5841efe332d3b3', 0),
(8, 2, '删除管理员', '2', 'admin_del', '', '43b747f5f00ac2001d9510c0a6a315e1', 0),
(9, 0, '管理组', '', 'group', '', 'e871088ad9c1fd922dfb4931b3d4578f', 0),
(16, 9, '添加管理组', '', 'group_add', '', '9cb60e82f14c80ec942804acb59ea32f', 0),
(17, 9, '编辑管理组', '', 'group_edit', '', 'ce02522c75b41a5ff5a500286136bb95', 0),
(18, 9, '删除管理组', '', 'group_del', '', 'bf8b78a8079b56abd68ec8978cadbd45', 0),
(19, 0, '进入咨询预约', '', 'yuyue', '', '628138da62007a332768336aa5cc53a5', 29),
(20, 19, '添加咨询预约', '', 'yuyue_add', '', 'b99c0cc115b3d0ff4e231075f64fdeae', 0),
(21, 19, '编辑预约', '', 'yuyue_edit', '', '944bea955c7a81f6d6a803e1027d9f03', 0),
(22, 19, '删除预约', '', 'yuyue_del', '', '292479c81363b7aa6f30bfa8f48551ec', 0),
(48, 0, '字典设置', '', 'zidian', '', 'df2e65d411e4b80bba81c67778fd0928', 0),
(49, 48, '科室字典', '', 'keshi', '', '40164fb4351e9d41f9cdb6e183f5945b', 0),
(50, 48, '病人来源字典', '', 'bingren', '', '83b4697746ced10abbe5d9b44a39a735', 0),
(51, 48, '咨询工具', '', 'zixun', '', 'cec69633cb295df343c5ede62cbabccb', 0),
(52, 48, '区域字典', '', 'area', '', '8b81d31052a8db09e21b5aeea5f8599a', 0),
(53, 48, '预约评定字典', '', 'yuyuezl', '', 'c8d94dff2f33a61d800efe80628e6682', 0),
(57, 48, '医生字典', '', 'yushen', '', '0b06142287871723505f402fd25a54aa', 0),
(58, 48, '到诊评定', '', 'daozhen', '', 'e5e99976f33b57f9ad1d73abfa9fc54f', 0),
(59, 48, '收费字典', '', 'shoufei', '', '6fc8c73fd5ca0716ec08de08a5628bfb', 0),
(60, 48, '回访字典', '', 'huifang', '', 'f35aa6b0453ca9f4301a85af202bb9d2', 0),
(61, 48, '结算字典', '', 'jiesuan', '', 'bb8f258e45fa0e9568265e539624e6a3', 0),
(62, 48, '机构类别', '', 'jigou', '', 'd8c4828bd43b2acebffd234d1ea00d39', 0),
(63, 48, '网站字典', '', 'website', '', '54cb011c674ea7c373b87fcbc8a5529c', 0),
(64, 0, '操作日志', '', 'log', '', 'c562b79b86d4a566375086feab8e3323', 0),
(65, 48, '收费项目', '', 'pricezd', '', '82332d5849caeb9bcdd3e55b1e74f181', 0),
(66, 0, '短信模版', '', 'sms', '', '6ed105eb0bf65ec640f6cab5e4c0bcea', 18),
(67, 19, '编辑咨询', '', 'zixun_edit', '', 'd1d51d77ef6dfc4fdbdcac711cf9db4c', 0),
(68, 0, '回访记录', '', 'huifangset', '', 'f4ed76c894b084fc410c96b6975da1da', 21),
(69, 68, '添加回访记录', '', 'huifangset_add', '', 'aa0e1eb8895d6292924ede6188249af8', 0),
(70, 68, '编辑回访', '', 'huifangset_edit', '', 'c6dad80b69172a2906d96904645c952a', 0),
(71, 68, '删除回访', '', 'huifangset_del', '', '857997511c38f2d6d4560b3b8988c4c4', 0),
(74, 0, '回访任务', '', 'hfrenwu', '', 'fdcca1015ec20dcd0382dd159b27d37f', 22),
(75, 74, '添加回访任务', '', 'hfrenwu_add', '', '4d0b2ad0acbbab5ae8f217e6747fefc7', 0),
(76, 74, '编辑回访任务', '', 'hfrenwu_edit', '', 'd7efddd96f95fa738f1db86930c88523', 0),
(77, 74, '删除回访任务', '', 'hfrenwu_del', '', 'f6a9b55c841d0dcb3097a65a2aef660f', 0),
(79, 19, '查看咨询', '', 'zixun_show', '', '5fcdaa61b8e6b47633ebdba69820ba62', 0),
(80, 19, '删除咨询', '', 'zixun_del', '', '2a156d45bcf3af43907740511cbe3012', 0),
(81, 0, '工作量录入', '', 'gongzuoliang', '', 'b88ddee98618b11e63b7bd0d20d6d809', 28),
(82, 81, '添加工作量录入', '', 'gongzuoliang_add', '', 'a5122297bf9b29096173f1a686b3a184', 0),
(83, 81, '编辑工作量录入', '', 'gongzuoliang_edit', '', '795cfee18cf9be0f4529b61044a431f9', 0),
(84, 81, '删除工作量录入', '', 'gongzuoliang_del', '', 'bc5d47460ea90541a4bd3ed370906d67', 0),
(85, 0, '机构', '', 'jiugouset', '', 'da87382249567d14b54bd09466f9700d', 27),
(86, 85, '添加机构', '', 'jiugouset_add', '', 'aa224e13a6e4b0e036095749cceea49e', 0),
(87, 85, '编辑机构', '', 'jiugouset_edit', '', 'e17ef7e1a8769cf33b7dd3039f3ad64e', 0),
(88, 85, '删除机构', '', 'jiugouset_del', '', 'a00ededebaacbe4966206b0fb4d49a3f', 0),
(89, 0, '每日消费', '', 'days_price', '', 'dc2b49511406745352c96088a1dd0293', 26),
(90, 89, '添加每日消费', '', 'days_price_add', '', '3c1accfd76c891f8e689f21481aa55d7', 0),
(91, 89, '编辑每日消费', '', 'days_price_edit', '', '2c1b3bfd9131db3cf7525029f5b823e4', 0),
(92, 89, '删除每日消费', '', 'days_price_del', '', '9c3728c10b26d07e4e48f8e34dbc9f9e', 0),
(93, 19, '查看预约', '', 'yuyue_show', '', '6e87e3815c67a2c1729a3cb90bf89ad2', 0),
(94, 0, '前台咨询接诊', '', 'qiantaijz', '', '3d63fb2aa0a432bb086874be5aed5cbb', 25),
(95, 94, '添加前台咨询接诊', '', 'qiantaijz_add', '', '26c19c6ac6ef61d3dd737427cce7e6e1', 0),
(96, 94, '编辑前台咨询接诊', '', 'qiantaijz_edit', '', '5d3a409bf56628a9d6977f3907f5ce7c', 0),
(97, 94, '删除前台咨询接诊', '', 'qiantaijz_del', '', '15584b9cd4d959273ad1926af3eb8a85', 0),
(98, 0, '医生接诊', '', 'yishenjz', '', '81c9b39d2a4be280480a48cdd24d085c', 24),
(99, 98, '医生接诊权限', '', 'yishenjz_add', '', '9f90fd47f20f85c3e5ef7e998aecd292', 0),
(100, 98, '编辑医生接诊', '', 'yishenjz_edit', '', '6f3626829267abf5ca68caa2f3f1ab49', 0),
(101, 98, '删除医生接诊', '', 'yishenjz_del', '', '4227c2b9349f0ffcdeedd60e7b3536cf', 0),
(102, 0, '收银权限', '', 'shouyin', '', '168b4c9a2b9cd87b1bf9fa37e26477f4', 23),
(103, 102, '收费', '', 'shouyin_check', '', 'c48f4e504ef48dbcc8844e6c125e9ed3', 0),
(104, 102, '结算收银', '', 'shouyin_jiesuan', '', '9dcf926672cbbce1ca47a8eff1b169d3', 0),
(106, 102, '退定金', '', 'dingjing', '', '0311a758fff03e8259eec86d44583551', 0),
(107, 0, '统计', '', 'tongji', '', '2aaa4209dadc2f87615094ac7b2ceee5', 0),
(108, 0, '开单操作', '', 'kaidan', '', 'd8435154fada668f71c608b57669370e', 24),
(109, 108, '添加开单操作', '', 'kaidan_add', '', '2e6bf2613a3f5689ecb78a1506519c09', 0),
(110, 108, '编辑开单操作', '', 'kaidan_edit', '', '23c757fd4d89ea1c0786cb75519827c6', 0),
(111, 108, '删除开单操作', '', 'kaidan_del', '', '3f0681545682f694978e669822ba4ddb', 0),
(113, 0, '进入网站首页界面', '', 'login_website', '', 'e3ca091e26acca5757d8ac6f038399ec', 30),
(114, 113, '咨询为首页入口', '', 'login_website_zixun', '', 'a95a9d8a59e987f13bf83e50e916781f', 0),
(115, 113, '市场机构为首页入口', '', 'login_website_shichang', '', 'd7bea18f87316c55faa2c151c4a88bed', 0),
(116, 113, '前台咨询接诊为首页入口', '', 'login_website_jiezhen', '', 'efb30982d424791ec435a37b71f99fd7', 0),
(117, 113, '医生为首页入口', '', 'login_website_doc', '', 'f1306cc32f4573712f5a97c5e67f2929', 0),
(118, 113, '客服回访为首页入口', '', 'login_website_kefu', '', 'af9feb4e2d30715a1680362605a64639', 0),
(119, 113, '财务帐单为首页入口', '', 'login_website_caiwu', '', 'f37829c6bb12921b4c99a7c16388dcd2', 0),
(120, 19, '只显示自己的信息', '', 'yuyue_only', '', 'e5006bfb2cabb858106791424f9acfc5', 0),
(121, 48, '消费类别字典', '', 'xiaofei_type', '', '2025bb3a1c08795b98c99abe807389c5', 0),
(122, 0, '翻译语言', '', 'lang', '', '952f50a6751c14d61cd0c3373070d95d', 0),
(123, 0, '优惠券', '', 'card', '', 'a57f14c4b222d5556d4ebbe9562d7522', 3),
(124, 108, '开单选择医生', '', 'kaidan_yishen', '', 'a6bd32070d5a473e158f9ce782bdd202', 0),
(125, 48, '个人属性', '', 'userzd', '', '5067186265b1cbc90c7ec1866af480c3', 0),
(126, 0, '操作按钮权限', '', 'btn', '', 'e729589c357ff57e7852b7c9587d912a', 21),
(127, 126, '回访', '', 'btn_huifang', '', '15942657d6c7fc7641233cdb2fb59855', 0),
(128, 126, '按钮添加回访', '', 'btn_huifang_add', '', '8b21514a90704824c7984268044a2a03', 0),
(129, 126, '按钮短信发送', '', 'btn_sms', '', 'c0e85c5585b274dc21db274d5ae6a8ff', 0),
(130, 74, '回访任务列表', '', 'huihfrenwu_list', '', '74f7c828d5cfdfcca59bc0c7c468bf1a', 0),
(131, 74, '只能操作自己回访任务', '', 'hfrenwu_only', '', 'fdd5ad3e0b721a395fb15bd9ef65c7fb', 0),
(132, 68, '只能操作自己回访记录', '', 'huifangset_only', '', '84d29629899193721dec161c48022c77', 0),
(133, 68, '回访记录列表', '', 'huifangset_list', '', '5febb1511184c47bcf3289d8ad4953cb', 0),
(134, 126, '按钮添加回访任务', '', 'btn_renwu_add', '', '38c4209c6b75d5029e19f5e8c8a079ed', 0),
(135, 74, '回访任务只查看被分配的', '', 'hfrenwu_only_handle', '', 'cd15c7d798c97cd16e9e6b948e31ec6c', 0),
(136, 19, '其他查询预约条件', '', 'yuyue_other', '', '3e0bf6e21fd5552a742537a6983ac50a', 0),
(137, 19, '查看7天预约信息', '', 'yuyue_seven_show', '', 'bd77e14dab8a98c797adb40b14b486ae', 0),
(138, 98, '只能操作自己的接诊', '', 'yishenjz_only', '', 'a305078aaea6be8cb3715f660b225233', 0),
(139, 98, '只列出分配给自己的', '', 'yishenjz_only_list', '', 'c3f262a415fbb70212d5387803e28303', 0),
(140, 81, '只能操作自己的', '', 'gongzuoliang_only', '', 'bb9542d68d8acb0270dde9537b12188c', 0),
(141, 89, '只能操作自己的', '', 'days_price_only', '', 'cdfe971df800e3d04a55d486c5c9b457', 0),
(142, 108, '只能操作自己的', '', 'kaidan_only', '', '2da7ab0701984e573e434f907c128788', 0),
(143, 0, '客服人员', '', 'kefu', '', '21a0f1bb27d80240aaead7b680a4cf8f', 0),
(144, 102, '退费', '', 'shouyin_rollback', '', '01f8abee1a1070baf5f9a6e95ac2b733', 0),
(145, 113, '广告部入口', '', 'login_adv_shichang', '', 'a442b7d265defd72903cc07c21934122', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_area`
--

CREATE TABLE `tp_area` (
  `id` int(11) UNSIGNED NOT NULL,
  `areaid` int(10) UNSIGNED DEFAULT NULL,
  `fid` int(11) DEFAULT '0',
  `uuid` varchar(120) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `subtype` varchar(120) DEFAULT NULL,
  `webname` varchar(255) DEFAULT NULL,
  `card` varchar(120) DEFAULT NULL,
  `is_price` tinyint(1) DEFAULT '0',
  `is_jigou` tinyint(1) DEFAULT '0',
  `ename` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_area`
--

INSERT INTO `tp_area` (`id`, `areaid`, `fid`, `uuid`, `sort`, `ctime`, `checked`, `name`, `subtype`, `webname`, `card`, `is_price`, `is_jigou`, `ename`, `type`, `url`, `admin_id`) VALUES
(1, NULL, 0, 'f11474b91951eb63930c2276e5f6d649', 0, '1476519981', 0, 'Hà Nội', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(2, NULL, 0, 'cdf41b42b727fc4dc1ec0ab505cebc07', 0, '1476519981', 1, 'Hà Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(3, NULL, 0, '09a19e04381fc69a79000da4591bb36e', 0, '1476519981', 1, 'Cao Bằng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(4, NULL, 0, 'cab0ab3685f4efc277d9fbedd9755244', 0, '1476519981', 1, 'Bắc Kạn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(5, NULL, 0, '32596064e69cc5bfc5377c75abdc6211', 0, '1476519981', 1, 'Tuyên Quang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(6, NULL, 0, '9709c5ff0a7483a92d4da5081e988e79', 0, '1476519981', 1, 'Lào Cai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(7, NULL, 0, '5e55d5e5f8e227bf7a671290c0c355dc', 0, '1476519981', 1, 'Điện Biên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(8, NULL, 0, '5451c147b99bf989b2df686f4fd08e66', 0, '1476519981', 1, 'Lai Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(9, NULL, 0, '452afe61f32044fb2c3df1b389554769', 0, '1476519981', 1, 'Sơn La', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(10, NULL, 0, '835142faa11f28089fa8f88083547b05', 0, '1476519981', 1, 'Yên Bái', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(11, NULL, 0, 'c2ecdd7cb6014e0946dee4fad23b0a62', 0, '1476519981', 1, 'Hòa Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(12, NULL, 0, '5350dc48df397fa935026b8c8067a5eb', 0, '1476519981', 1, 'Thái Nguyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(13, NULL, 0, 'c88ee6e23d455ce07ed92fd89d38ea27', 0, '1476519981', 1, 'Lạng Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(14, NULL, 0, 'd589fefa74dc076678607f60bf42c4af', 0, '1476519981', 1, 'Quảng Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(15, NULL, 0, '53fec5b46e29094b8a4156ceec120b50', 0, '1476519981', 1, 'Bắc Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(16, NULL, 0, '74d008ab6e132f2ec650b432ba312a9f', 0, '1476519981', 1, 'Phú Thọ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(17, NULL, 0, '0e1b40c34ec6ef119963301da5d14825', 0, '1476519981', 1, 'Vĩnh Phúc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(18, NULL, 0, '247f85177ae0432b3ea3723e1555d79a', 0, '1476519981', 1, 'Bắc Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(19, NULL, 0, 'ab1edd9e9e29c3a7ad4bf012e0b4e7da', 0, '1476519981', 1, 'Hải Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(20, NULL, 0, '9d686bb7e4df7e331df077beb22bc63f', 0, '1476519981', 1, 'Hải Phòng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(21, NULL, 0, '42ced06274f596900d3c11399b8c222a', 0, '1476519981', 1, 'Hưng Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(22, NULL, 0, '56f08746d24b86a43e1c2a293e9cae46', 0, '1476519981', 1, 'Thái Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(23, NULL, 0, '92308c0ea3397c163a5163d81d36d462', 0, '1476519981', 1, 'Hà Nam', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(24, NULL, 0, 'e0872027f424c8cd8de1b3d2a970219c', 0, '1476519981', 1, 'Nam Định', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(25, NULL, 0, '9feca2ba190a0febba49f7f0f521d1e8', 0, '1476519981', 1, 'Ninh Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(26, NULL, 0, 'd7356c2f31c5b35fc3acf68e9249b34a', 0, '1476519981', 1, 'Thanh Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(27, NULL, 0, '012d26a2c6188a4a42e80d5d841983c5', 0, '1476519981', 1, 'Nghệ An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(28, NULL, 0, '7fd574719bf34e03e416f79ace30220a', 0, '1476519981', 1, 'Hà Tĩnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(29, NULL, 0, 'a8203f8fec39a35fc21c7f72af195073', 0, '1476519981', 1, 'Quảng Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(30, NULL, 0, '06968d97c4f600beb710dc45b887d89d', 0, '1476519981', 1, 'Quảng Trị', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(31, NULL, 0, 'cf0f7e13a33e5d7f874f3bad302aea31', 0, '1476519981', 1, 'Thừa Thiên Huế', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(32, NULL, 0, '68c8cdd2c1e473211f583a8423bfeb27', 0, '1476519981', 1, 'Đà Nẵng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(33, NULL, 0, '0c0f0272b08d0f9a778a31d4edf46a92', 0, '1476519981', 1, 'Quảng Nam', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(34, NULL, 0, 'afe40637749326b2587e9600ac8ff7d0', 0, '1476519981', 1, 'Quảng Ngãi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(35, NULL, 0, '5b2fd7f49774548663312a54efb66b91', 0, '1476519981', 1, 'Bình Định', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(36, NULL, 0, 'd898d565d442bb43c3627eae62aebaaf', 0, '1476519981', 1, 'Phú Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(37, NULL, 0, '214558aeef940f18feb3bfbcb1e406e0', 0, '1476519981', 1, 'Khánh Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(38, NULL, 0, 'af95ae1f55ef4263b5d47544f60cdbcb', 0, '1476519981', 1, 'Ninh Thuận', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(39, NULL, 0, '53c8f1a7a873c74c6e8301165c656041', 0, '1476519981', 1, 'Bình Thuận', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(40, NULL, 0, '7d491e311a36c1eb818c51e490615876', 0, '1476519981', 1, 'Kon Tum', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(41, NULL, 0, '486f49850d73a587e45a596618d3b963', 0, '1476519981', 1, 'Gia Lai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(42, NULL, 0, '2a2e9b181c415e3f485346b5bcf017dd', 0, '1476519981', 1, 'Đắk Lắk', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(43, NULL, 0, '60e7a1b9289af65cb94ae3a9ca2f1995', 0, '1476519981', 1, 'Đắk Nông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(44, NULL, 0, '641661cae2bfc22b331b14cd99317e76', 0, '1476519981', 1, 'Lâm Đồng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(45, NULL, 0, 'e0625f1920d532792b043f81e9f00d32', 0, '1476519981', 1, 'Bình Phước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(46, NULL, 0, 'bc3e5d8e39acfe77788860d4e654ffd7', 0, '1476519981', 1, 'Tây Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(47, NULL, 0, '8e9c78482fa529260fa3be1e87fb66cb', 0, '1476519981', 1, 'Bình Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(48, NULL, 0, 'b18222c082df6e616fc73e7eb9c509fa', 0, '1476519981', 1, 'Đồng Nai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(49, NULL, 0, '68bfd4c9bfb4c44688a11bbd06820022', 0, '1476519981', 1, 'Bà Rịa - Vũng Tàu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(50, NULL, 0, 'e88d150aa923f97136d7fb8e35b6b2b9', 0, '1476519981', 1, 'Hồ Chí Minh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(51, NULL, 0, '2168c01de67eaa1c0773d9127d15490a', 0, '1476519981', 1, 'Long An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(52, NULL, 0, '7901233839d17bb1b4252688910d1f74', 0, '1476519981', 1, 'Tiền Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(53, NULL, 0, 'e9c04ffe74bcc784b95638b96e1c497d', 0, '1476519981', 1, 'Bến Tre', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(54, NULL, 0, '0048eb1db3940e7789c0cdd1d4d6ca19', 0, '1476519981', 1, 'Trà Vinh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(55, NULL, 0, '3e07d613415ef36892c315d1e40a24cd', 0, '1476519981', 1, 'Vĩnh Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(56, NULL, 0, 'c0f98b37e72d02e919901379db6cb788', 0, '1476519981', 1, 'Đồng Tháp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(57, NULL, 0, 'f84baedaee17bf8cb3918031202ca047', 0, '1476519981', 1, 'An Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(58, NULL, 0, '3cbf46f30b710e77e90192c53d8ff073', 0, '1476519981', 1, 'Kiên Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(59, NULL, 0, '9d84ef95641b84bfcb0fbf7696bd95bc', 0, '1476519981', 1, 'Cần Thơ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(60, NULL, 0, '05c8eb41de5a691d8df5f4f5be917766', 0, '1476519981', 1, 'Hậu Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(61, NULL, 0, 'a9c1d312189dac425cabe09af33b3032', 0, '1476519981', 1, 'Sóc Trăng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(62, NULL, 0, '737c3ec5cc336a28adfd5fbcb7f7812b', 0, '1476519981', 1, 'Bạc Liêu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(63, NULL, 0, 'f64fd7fece74c791a28fa2f0b5f3cf10', 0, '1476519981', 1, 'Cà Mau', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(64, NULL, 1, 'f167ce991c24fdff50b3e50cf64e1b7d', 0, '1476520268', 1, 'Ba Đình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(65, NULL, 1, 'a1ecd65491b3a5fef0e7030c45c72576', 0, '1476520268', 1, 'Hoàn Kiếm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(66, NULL, 1, '41a08671dfe83596c1d69dc611284696', 0, '1476520268', 1, 'Tây Hồ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(67, NULL, 1, 'd4c1d9e3884f8b6d468167954749a2f7', 0, '1476520268', 1, 'Long Biên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(68, NULL, 1, '85b553c5b6b99ac28a37ee7d5ac4ff1b', 0, '1476520268', 1, 'Cầu Giấy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(69, NULL, 1, '723a552578cef966cd910ba2311d7b27', 0, '1476520268', 1, 'Đống Đa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(70, NULL, 1, '291fbd3a801082e8befdb01af9460d88', 0, '1476520268', 1, 'Hai Bà Trưng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(71, NULL, 1, '099b9493aeed5cf8e68e4780f7f3a827', 0, '1476520268', 1, 'Hoàng Mai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(72, NULL, 1, 'be47239bd051be3182d3931e08d32a20', 0, '1476520268', 1, 'Thanh Xuân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(73, NULL, 1, '11bcd0e4323d070fff29fef598451d5f', 0, '1476520268', 1, 'Hà Đông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(74, NULL, 1, '904b22f3501b07cd7797d36fc01d5817', 0, '1476520268', 1, 'Sơn Tây', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(75, NULL, 1, '2bb0fcbc8fa03c861696b40ad0be0b57', 0, '1476520268', 1, 'Sóc Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(76, NULL, 1, '658e2d30a9ba438cc68476ab0496c02f', 0, '1476520268', 1, 'Đông Anh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(77, NULL, 1, '67c6eaf02eb96de13bd9be358a2c1207', 0, '1476520268', 1, 'Gia Lâm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(78, NULL, 1, '0bcdb288e649d8af0800acf9268bd454', 0, '1476520268', 1, 'Từ Liêm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(79, NULL, 1, '069f4acc4f35ac782e9ffb09091f9245', 0, '1476520268', 1, 'Thanh Trì', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(80, NULL, 1, '01a913557d5a04677ff01ca1d055df1a', 0, '1476520268', 1, 'Mê Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(81, NULL, 1, 'e4fed6e454fe7315a66176f84db93ef5', 0, '1476520268', 1, 'Ba Vì', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(82, NULL, 1, '66d84c4aa3ca0dfb9d46824e595efaea', 0, '1476520268', 1, 'Phúc Thọ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(83, NULL, 1, 'dbd47eb2131f4cee10e3f2ab9643384c', 0, '1476520268', 1, 'Đan Phượng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(84, NULL, 1, '329f2e1df655fbf96b960824145b9767', 0, '1476520268', 1, 'Hoài Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(85, NULL, 1, '9045a3f597c89303e55e3596e8d8f662', 0, '1476520268', 1, 'Quốc Oai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(86, NULL, 1, 'e10a462c7c8d17d41f178f26389e11f7', 0, '1476520268', 1, 'Thạch Thất', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(87, NULL, 1, '8de9bf424c76c40a5bd3f1ed578928ba', 0, '1476520268', 1, 'Chương Mỹ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(88, NULL, 1, 'bf3a5cc6f264c7883523ac71556195a1', 0, '1476520268', 1, 'Thanh Oai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(89, NULL, 1, '154a7cbe54fc2210993927291d2fcff1', 0, '1476520268', 1, 'Thường Tín', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(90, NULL, 1, '7e8cb056da9f2af521ba5bb60ea2edec', 0, '1476520268', 1, 'Phú Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(91, NULL, 1, '5458d1a6545f248fc9c1cdfc83342039', 0, '1476520268', 1, 'Ứng Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(92, NULL, 1, '8b4d38cd87183069dba92f8904f191f1', 0, '1476520268', 1, 'Mỹ Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(93, NULL, 2, '3f6c6831fbf18339af399cf430fa328b', 0, '1476520268', 1, 'Hà Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(94, NULL, 2, '83a57178d2fc0e34a3e879e1297f9970', 0, '1476520268', 1, 'Đồng Văn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(95, NULL, 2, '5170196646a5840ee61b42397111c32e', 0, '1476520268', 1, 'Mèo Vạc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(96, NULL, 2, '52c39520de907a90f0cc5f5cf62bc4be', 0, '1476520268', 1, 'Yên Minh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(97, NULL, 2, '2a43f607b8448d0ecb0aa49f27f9870c', 0, '1476520268', 1, 'Quản Bạ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(98, NULL, 2, 'e22f16b57fe233e6dbb938b1b56268e5', 0, '1476520268', 1, 'Vị Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(99, NULL, 2, 'ce1a6125e28c52717ced6223322d1cc4', 0, '1476520268', 1, 'Bắc Mê', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(100, NULL, 2, '51b1cdaac6cc28e02a434b0daf38cfdc', 0, '1476520268', 1, 'Hoàng Su Phì', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(101, NULL, 2, '5e97bbabb3ae636e702b49815f16620f', 0, '1476520268', 1, 'Xín Mần', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(102, NULL, 2, '7e71d2fd4ed0f90a64e18f28cb261952', 0, '1476520268', 1, 'Bắc Quang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(103, NULL, 2, '09a66dc09d716943ac741a9adcdd95eb', 0, '1476520268', 1, 'Quang Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(104, NULL, 3, 'c17c7617ae1b3e686d78af6ada26dcc5', 0, '1476520268', 1, 'Cao Bằng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(105, NULL, 3, '869db56c27ceb7de8149cc4f15db1a05', 0, '1476520268', 1, 'Bảo Lâm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(106, NULL, 3, 'f43d70d054d1ce49ac59268d9b86cf44', 0, '1476520268', 1, 'Bảo Lạc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(107, NULL, 3, '77fa761dc620bbf677b3297ffbe2bfed', 0, '1476520268', 1, 'Thông Nông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(108, NULL, 3, '92810b115a163a2a84543b7dc97e8269', 0, '1476520268', 1, 'Hà Quảng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(109, NULL, 3, '1cd076ea6351473c775edecbe0be85f1', 0, '1476520268', 1, 'Trà Lĩnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(110, NULL, 3, '1c365810f205290c7334619cf0bc5435', 0, '1476520268', 1, 'Trùng Khánh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(111, NULL, 3, 'abd7e581c420721291a5ef994668fb77', 0, '1476520268', 1, 'Hạ Lang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(112, NULL, 3, '94ca8c9cd90434ae86f557d5f4539f67', 0, '1476520268', 1, 'Quảng Uyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(113, NULL, 3, '1d13a6dc6dde12ffe1d77151a6ca6c1d', 0, '1476520268', 1, 'Phục Hoà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(114, NULL, 3, '1d5415f2c5626d093bacc523c87d05b4', 0, '1476520268', 1, 'Hoà An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(115, NULL, 3, 'c155f6853015085a68108c8581e768fd', 0, '1476520268', 1, 'Nguyên Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(116, NULL, 3, '6e43438ceaea597f55a26a6e56b851e8', 0, '1476520268', 1, 'Thạch An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(117, NULL, 4, 'd2257b1d011f6d29fd99743d1b26f2b2', 0, '1476520268', 1, 'Bắc Kạn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(118, NULL, 4, '1f98170a0da4c810f7599585b2e52dc6', 0, '1476520268', 1, 'Pác Nặm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(119, NULL, 4, 'fa160c11f82ff6def6ca6b2f09837d30', 0, '1476520268', 1, 'Ba Bể', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(120, NULL, 4, 'b09b39d12442e4c32e96939c9b8710a6', 0, '1476520268', 1, 'Ngân Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(121, NULL, 4, '02ff9b1b302e54ee35fdedc4221b1130', 0, '1476520268', 1, 'Bạch Thông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(122, NULL, 4, '9100951f429b6e59daa4b3c6fe158e99', 0, '1476520268', 1, 'Chợ Đồn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(123, NULL, 4, 'cd284332678b3f8ec58ba38c873a448d', 0, '1476520268', 1, 'Chợ Mới', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(124, NULL, 4, '298f212aa8d1b478fec14afd469fec85', 0, '1476520268', 1, 'Na Rì', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(125, NULL, 5, '9ab9ddbfeb73b8572eb3647400ce59f3', 0, '1476520268', 1, 'Tuyên Quang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(126, NULL, 5, '734c509c6192d0a9d4366477ff460833', 0, '1476520268', 1, 'Nà Hang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(127, NULL, 5, '86fe33c954735544c4e0022e195ac2a1', 0, '1476520268', 1, 'Chiêm Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(128, NULL, 5, '43d98f5aa89ec6fdccf455590f97fa04', 0, '1476520268', 1, 'Hàm Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(129, NULL, 5, 'c31f6ad11cb76d3f6b113c926192fe0d', 0, '1476520268', 1, 'Yên Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(130, NULL, 5, 'c8bb3160cc43f31f8319ce9c9d27c83c', 0, '1476520268', 1, 'Sơn Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(131, NULL, 6, 'fedb397f7f3824e671e7f63222f61a23', 0, '1476520268', 1, 'Lào Cai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(132, NULL, 6, '74b7c052b831178b2e8e34679fc45367', 0, '1476520268', 1, 'Bát Xát', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(133, NULL, 6, 'ff57c59d1eb971ba8621fc0cca00d8c2', 0, '1476520268', 1, 'Mường Khương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(134, NULL, 6, '1f5d31fe3c176d44964fcf4d2628f369', 0, '1476520268', 1, 'Si Ma Cai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(135, NULL, 6, 'eb9d275956d8a81dd08a177bf63db66a', 0, '1476520268', 1, 'Bắc Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(136, NULL, 6, '6600a6374ee852cdd8692598ab2835fb', 0, '1476520268', 1, 'Bảo Thắng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(137, NULL, 6, '1590aa73f4ca5535323367d657e5b84b', 0, '1476520268', 1, 'Bảo Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(138, NULL, 6, '590cee602122cd87b169ce8e2316d80a', 0, '1476520268', 1, 'Sa Pa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(139, NULL, 6, '386eae13dc9fc173c0850859dab4430f', 0, '1476520268', 1, 'Văn Bàn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(140, NULL, 7, 'f9f1519e7fb97e39d84002aad2ec5c48', 0, '1476520268', 1, 'Điện Biên Phủ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(141, NULL, 7, 'ea82d8d492d4d1e323489d9e59e6e797', 0, '1476520268', 1, 'Mường Lay', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(142, NULL, 7, '304869bde614087cccd48662fb33f4ba', 0, '1476520268', 1, 'Mường Nhé', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(143, NULL, 7, '17932da3a2dca0fa3b21a198e5b7edcc', 0, '1476520268', 1, 'Mường Chà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(144, NULL, 7, '002d7ad3fe356f3129f3cfe5f5903b0c', 0, '1476520268', 1, 'Tủa Chùa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(145, NULL, 7, '4eea50e8d8fe453d7405ec2202fce0f0', 0, '1476520268', 1, 'Tuần Giáo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(146, NULL, 7, 'be7767649ba7f8b968b008b2c082b91a', 0, '1476520268', 1, 'Điện Biên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(147, NULL, 7, '5556607f5f9d568f7184cbf904fb2845', 0, '1476520268', 1, 'Điện Biên Đông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(148, NULL, 7, '171afe9d4f1e4cd942c3778a26d20244', 0, '1476520268', 1, 'Mường Ảng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(149, NULL, 8, 'b7eeb19e1c0a78e55da674101f9d9644', 0, '1476520268', 1, 'Lai Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(150, NULL, 8, 'b915ee2325c879dcee3fc3a60e94350f', 0, '1476520268', 1, 'Tam Đường', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(151, NULL, 8, '63382016e8af4455a515a1ac76821181', 0, '1476520268', 1, 'Mường Tè', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(152, NULL, 8, 'e212632eb54195a21936d478123f9e1b', 0, '1476520268', 1, 'Sìn Hồ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(153, NULL, 8, 'a40db2e48d808c8a08d4a08d00db29b8', 0, '1476520268', 1, 'Phong Thổ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(154, NULL, 8, '1785880c87e7eed9dc4bc50aea65e8d9', 0, '1476520268', 1, 'Than Uyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(155, NULL, 8, '66c410647a7ca925607e35a4d0508d2f', 0, '1476520268', 1, 'Tân Uyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(156, NULL, 9, 'c5904c354d81e967046c4819d2227926', 0, '1476520268', 1, 'Sơn La', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(157, NULL, 9, 'ea4b97c832c5e0e9350eaffcc0fd7b11', 0, '1476520268', 1, 'Quỳnh Nhai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(158, NULL, 9, '0939c734e0b520f38c8a57542bb5da83', 0, '1476520268', 1, 'Thuận Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(159, NULL, 9, '652a84963079cde7075cddeda080d6cb', 0, '1476520268', 1, 'Mường La', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(160, NULL, 9, '9ceff31894d76ec4bbaac688721b76c8', 0, '1476520268', 1, 'Bắc Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(161, NULL, 9, '6c56b384f93a0fbdbd34098f8e49fc0b', 0, '1476520268', 1, 'Phù Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(162, NULL, 9, 'f36f452451b86916e01eea3d71e3ca8b', 0, '1476520268', 1, 'Mộc Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(163, NULL, 9, '235ab156d125b83868a925e722bf390b', 0, '1476520268', 1, 'Yên Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(164, NULL, 9, '168370270007f07a511feedff17275f2', 0, '1476520268', 1, 'Mai Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(165, NULL, 9, '6eb8c8354fce428b6c0ad36e7e36ccd7', 0, '1476520268', 1, 'Sông Mã', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(166, NULL, 9, 'a06a2468f53a26f6a24a1ec5f336180f', 0, '1476520268', 1, 'Sốp Cộp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(167, NULL, 10, 'c3ab6aae3dd8cbc0b65a1c76e58fb623', 0, '1476520268', 1, 'Yên Bái', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(168, NULL, 10, 'a2ef06d2e0eb00d8361e4b6fd2e7a5c1', 0, '1476520268', 1, 'Nghĩa Lộ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(169, NULL, 10, '656c9d3bda7592b3883004bd9af32ef0', 0, '1476520268', 1, 'Lục Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(170, NULL, 10, 'e5bb6bf3f38969e592c86defa623ac35', 0, '1476520268', 1, 'Văn Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(171, NULL, 10, '69e8f94592cc34e67d5bf577e6fcc1af', 0, '1476520268', 1, 'Mù Cang Chải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(172, NULL, 10, 'b0040730b2d9c222c19bbca3b1f0ae5f', 0, '1476520268', 1, 'Trấn Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(173, NULL, 10, '2467dc8ebdd58211e1660612c1a6106f', 0, '1476520268', 1, 'Trạm Tấu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(174, NULL, 10, '2887eec534cc44b1060117af95710299', 0, '1476520268', 1, 'Văn Chấn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(175, NULL, 10, '47f5672761df1544af8aff6886a55070', 0, '1476520268', 1, 'Yên Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(176, NULL, 11, 'a1fcb8daeb64db55d2ae9598f8c84989', 0, '1476520268', 1, 'Hòa Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(177, NULL, 11, '075460889488bbd07e1a60041ea0d7c3', 0, '1476520268', 1, 'Đà Bắc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(178, NULL, 11, 'b69697caef21ea365fb958a2b40d6c17', 0, '1476520268', 1, 'Kỳ Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(179, NULL, 11, '95b2ae69c468a42b1df3541acede4015', 0, '1476520268', 1, 'Lương Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(180, NULL, 11, '4de30a871310955028641a133bce6a11', 0, '1476520268', 1, 'Kim Bôi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(181, NULL, 11, '849da5e968d072cbe5179c08e2a1918b', 0, '1476520268', 1, 'Cao Phong', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(182, NULL, 11, '618c5959f0cd5532c06e0603050302a1', 0, '1476520268', 1, 'Tân Lạc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(183, NULL, 11, '5d466d0f9859440966cfe35718affbc3', 0, '1476520268', 1, 'Mai Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(184, NULL, 11, '29af528dc9005baa61faa356741d962b', 0, '1476520268', 1, 'Lạc Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(185, NULL, 11, '764a0f4630e9ae23d6c0ea82891c6ae8', 0, '1476520268', 1, 'Yên Thủy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(186, NULL, 11, '9e3ffcec5f696514ff4c1dfb614fc350', 0, '1476520268', 1, 'Lạc Thủy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(187, NULL, 12, '993661189c7f6decb956d0c1dea7d51a', 0, '1476520268', 1, 'Thái Nguyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(188, NULL, 12, 'b634abb051c94e31f3f1e8fee0d22cd8', 0, '1476520268', 1, 'Sông Công', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(189, NULL, 12, '133649b5b6874d18a1b41776f7e21603', 0, '1476520268', 1, 'Định Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(190, NULL, 12, 'beb643f698b10cd6d5a4de87502633ce', 0, '1476520268', 1, 'Phú Lương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(191, NULL, 12, '795b8bff0767de0bac0fc5c4383192ef', 0, '1476520268', 1, 'Đồng Hỷ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(192, NULL, 12, 'ac787f5babe187b5228417f64882a461', 0, '1476520268', 1, 'Võ Nhai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(193, NULL, 12, 'f86f21dc447506147d9d53d7e3752aed', 0, '1476520268', 1, 'Đại Từ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(194, NULL, 12, 'cd1f95efd2003bfe2aff6c8dd7aabdee', 0, '1476520268', 1, 'Phổ Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(195, NULL, 12, '11678c33d28c8e6a60ee94203452e45b', 0, '1476520268', 1, 'Phú Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(196, NULL, 13, '240b219cb4253fd5eced1c3a1d09a65a', 0, '1476520268', 1, 'Lạng Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(197, NULL, 13, 'f90fbceedcac1162e6e33deafc6b739a', 0, '1476520268', 1, 'Tràng Định', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(198, NULL, 13, '87d8a0906dcea5caf22480b37ceade75', 0, '1476520268', 1, 'Bình Gia', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(199, NULL, 13, '621f5d197e734a73902677f1710f7d9c', 0, '1476520268', 1, 'Văn Lãng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(200, NULL, 13, '8ac87be30f2b6fa19e5f2b81d418124a', 0, '1476520268', 1, 'Cao Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(201, NULL, 13, '8e60d3b7145d2cff5fe735ac4f77c9fc', 0, '1476520268', 1, 'Văn Quan', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(202, NULL, 13, 'a2d8ed4d4bb25f0a72e3ebac6cd12e8b', 0, '1476520268', 1, 'Bắc Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(203, NULL, 13, '1a6c176ea155c02f65dd0283332ff5f9', 0, '1476520268', 1, 'Hữu Lũng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(204, NULL, 13, '11dc23315c4e1f731b32021a0baef689', 0, '1476520268', 1, 'Chi Lăng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(205, NULL, 13, '12817cf503c12ad39f22df5198430d85', 0, '1476520268', 1, 'Lộc Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(206, NULL, 13, '93838975a289f80dda94239e5c491cd9', 0, '1476520268', 1, 'Đình Lập', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(207, NULL, 14, 'fc9eda5e92b0f384a8e8ea1797f7bfa0', 0, '1476520268', 1, 'Hạ Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(208, NULL, 14, '586d88cf8762e0ee9f41b663155cfb1c', 0, '1476520268', 1, 'Móng Cái', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(209, NULL, 14, 'fdd1d5b91d1ed64c8ebe764cd0568887', 0, '1476520268', 1, 'Cẩm Phả', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(210, NULL, 14, 'ef5d46604a8c16d360fd7cfde6241d00', 0, '1476520268', 1, 'Uông Bí', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(211, NULL, 14, '2d7ded0883ba8e179d3325228e941049', 0, '1476520268', 1, 'Bình Liêu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(212, NULL, 14, '657d2fcf9bb8d99586dd4ffa0ebdd6c5', 0, '1476520268', 1, 'Tiên Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(213, NULL, 14, 'dc2e5c1e084c7e2fcb1e40740b3af56b', 0, '1476520268', 1, 'Đầm Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(214, NULL, 14, 'bdfbd25335801a677798f59261c06380', 0, '1476520268', 1, 'Hải Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(215, NULL, 14, '702557005cf1407861cc8414d49f2693', 0, '1476520268', 1, 'Ba Chẽ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(216, NULL, 14, '7e88892ba5fa567b3e0fec7c75e29837', 0, '1476520268', 1, 'Vân Đồn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(217, NULL, 14, '428e8007c6469c3006b9e7ba2fb248c7', 0, '1476520268', 1, 'Hoành Bồ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(218, NULL, 14, '8db35770c86eeedeb63e4f52fe97a1b1', 0, '1476520268', 1, 'Đông Triều', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(219, NULL, 14, '68dbc2b38efee9ce52de3fb0b2d2d096', 0, '1476520268', 1, 'Yên Hưng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(220, NULL, 14, '68e7dbd728f6bc92b4587cad7cfff661', 0, '1476520268', 1, 'Cô Tô', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(221, NULL, 15, 'fe7a1979817401fe1679f6157c6f1b56', 0, '1476520268', 1, 'Bắc Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(222, NULL, 15, 'ee7a709bdbb80b1b0c54f1aa395a5a40', 0, '1476520268', 1, 'Yên Thế', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(223, NULL, 15, 'be2487c29cd9e1ea77a9359f5ddaed61', 0, '1476520268', 1, 'Tân Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(224, NULL, 15, 'fda2ee6a5bec81167a5f6c85b67452e5', 0, '1476520268', 1, 'Lạng Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(225, NULL, 15, '59eb771b21de3de07940350f9ca1b873', 0, '1476520268', 1, 'Lục Nam', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(226, NULL, 15, '37ae92fbfd9f1ffb97c0cc1a0c2a90ab', 0, '1476520268', 1, 'Lục Ngạn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(227, NULL, 15, 'c2ea07009fe67c9ca07d517becb153d2', 0, '1476520268', 1, 'Sơn Động', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(228, NULL, 15, '287416a8ea1fb1f73ac55e7775f2d1d3', 0, '1476520268', 1, 'Yên Dũng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(229, NULL, 15, 'f18180434eae8a4854f8655d4c92a87d', 0, '1476520268', 1, 'Việt Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(230, NULL, 15, 'e48b30ede440dd5ff2892040d5d693bc', 0, '1476520268', 1, 'Hiệp Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(231, NULL, 16, '56164932f635a482f0c0f3dbf85ffa5e', 0, '1476520268', 1, 'Việt Trì', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(232, NULL, 16, 'b3387b6c78e178f3b42c819b63b0950e', 0, '1476520268', 1, 'Phú Thọ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(233, NULL, 16, '6f19da404ff16e473771c2f40eabf01d', 0, '1476520268', 1, 'Đoan Hùng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(234, NULL, 16, '05f2fff89acb5accbd714878c85400c9', 0, '1476520268', 1, 'Hạ Hoà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(235, NULL, 16, '0d2019ffb70720eb77b03e240250f0e7', 0, '1476520268', 1, 'Thanh Ba', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(236, NULL, 16, '4d168c7641c56d4abcb44646d86399f2', 0, '1476520268', 1, 'Phù Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(237, NULL, 16, '319b10e0cb31934e4fbe3c7df8a55ced', 0, '1476520268', 1, 'Yên Lập', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(238, NULL, 16, 'dc7db07f4271b847de0f8cc87bb006ff', 0, '1476520268', 1, 'Cẩm Khê', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(239, NULL, 16, '03afcfcd97d2cd645ac6cb6635f7f90f', 0, '1476520268', 1, 'Tam Nông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(240, NULL, 16, '1dc399c8d7ec305e51d4618f7a478761', 0, '1476520268', 1, 'Lâm Thao', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(241, NULL, 16, '5e99efc75d86342f5ab7ea2bfbd25468', 0, '1476520268', 1, 'Thanh Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(242, NULL, 16, '2147736c2d6e22b471d90bc5eb9963de', 0, '1476520268', 1, 'Thanh Thuỷ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(243, NULL, 16, 'ed1e45c7eff6d7d937ba7e76b4b11667', 0, '1476520268', 1, 'Tân Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(244, NULL, 17, '47969d8d38d6f1b7f86e2266923a7a1a', 0, '1476520268', 1, 'Vĩnh Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(245, NULL, 17, '95529a73fcdf8bdf8d7804e99d7c61b2', 0, '1476520268', 1, 'Phúc Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(246, NULL, 17, 'ce4e750d865aadfa634103520d23e816', 0, '1476520268', 1, 'Lập Thạch', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(247, NULL, 17, '3983dde57670eb320f3b12ad2d66946c', 0, '1476520268', 1, 'Tam Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(248, NULL, 17, '0b2e006f13353342141f942e99ddcf76', 0, '1476520268', 1, 'Tam Đảo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(249, NULL, 17, '6f6b8db69d9b3a8138572b2611df7c9b', 0, '1476520268', 1, 'Bình Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(250, NULL, 17, '9d0c8794c28f0caf21bc188340e85a85', 0, '1476520268', 1, 'Yên Lạc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(251, NULL, 17, '0428214200c64acb44b5163ab65aeeb0', 0, '1476520268', 1, 'Vĩnh Tường', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(252, NULL, 17, '8b8b19ee32e4da4573fe52b9bac7f007', 0, '1476520268', 1, 'Sông Lô', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(253, NULL, 18, '7200e603775e7c3daf6e32ac7503e502', 0, '1476520268', 1, 'Bắc Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(254, NULL, 18, '399e0ee9555929fb4557fbd2bf4b7468', 0, '1476520268', 1, 'Từ Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(255, NULL, 18, 'd4a4fc1b79c26b528fda16df91865046', 0, '1476520268', 1, 'Yên Phong', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(256, NULL, 18, 'b9c375b071fed58988cf9e1885d39d2e', 0, '1476520268', 1, 'Quế Võ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(257, NULL, 18, '638547052193a0b24ac7a48ab9d43841', 0, '1476520268', 1, 'Tiên Du', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(258, NULL, 18, '3c66da141020850580e41699e9be6896', 0, '1476520268', 1, 'Thuận Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(259, NULL, 18, '8913d0ccfa6d7d518ba0c05d469b31c2', 0, '1476520268', 1, 'Gia Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(260, NULL, 18, 'fd15967d7614ddb9035089fe1db440f9', 0, '1476520268', 1, 'Lương Tài', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(261, NULL, 19, '0c3e68c4d27f2f2ae31d51f08dde9231', 0, '1476520268', 1, 'Hải Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(262, NULL, 19, '65b2273190397fe18253154bcfa3198b', 0, '1476520268', 1, 'Chí Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(263, NULL, 19, '33a8b0b98fe72f9215eb3e0ffd91f654', 0, '1476520268', 1, 'Nam Sách', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(264, NULL, 19, 'f30b0ab8cb25ac652c38c3cadf34997f', 0, '1476520268', 1, 'Kinh Môn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(265, NULL, 19, '92198d271f8a0804add1f78f3fec6feb', 0, '1476520268', 1, 'Kim Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(266, NULL, 19, '29406dad82d330f2d4eaef220c6a1a32', 0, '1476520268', 1, 'Thanh Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(267, NULL, 19, 'a3648d6c03ca036f99f48381acb1f5d3', 0, '1476520268', 1, 'Cẩm Giàng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(268, NULL, 19, '43d632b26268a2594dffedc37b946729', 0, '1476520268', 1, 'Bình Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(269, NULL, 19, '9daf6fca5fac681ccf4735bb73e53d4b', 0, '1476520268', 1, 'Gia Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(270, NULL, 19, 'b49a2a3883965f7ae68616056038000c', 0, '1476520268', 1, 'Tứ Kỳ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(271, NULL, 19, '37e66668133c5d9cd2ebeb5306c9a8d1', 0, '1476520268', 1, 'Ninh Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(272, NULL, 19, 'c934cce6073a83ea4276d9b86c1d1475', 0, '1476520268', 1, 'Thanh Miện', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(273, NULL, 20, '4f606cdff76d0b5c6ad5bb1951ae745c', 0, '1476520268', 1, 'Hồng Bàng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(274, NULL, 20, '45bf1830e99f4148c99f22fbf531460d', 0, '1476520268', 1, 'Ngô Quyền', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(275, NULL, 20, 'f337ce655a2afe22f45a19f745f94e12', 0, '1476520268', 1, 'Lê Chân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(276, NULL, 20, '7799550828cfb4edd8249a70a1c1389c', 0, '1476520268', 1, 'Hải An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(277, NULL, 20, '9245580be4c5794539bc4ecf65288cb2', 0, '1476520268', 1, 'Kiến An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(278, NULL, 20, '9766db0462556d295f807ac43d0e55dc', 0, '1476520268', 1, 'Đồ Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(279, NULL, 20, 'c92bc8e3076e2030b53f64d48bb70320', 0, '1476520268', 1, 'Kinh Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(280, NULL, 20, '12e6cb7615947e054cd5bbf544889672', 0, '1476520268', 1, 'Thuỷ Nguyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(281, NULL, 20, '799c157a4e564cabe03b922cedb93a0e', 0, '1476520268', 1, 'An Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(282, NULL, 20, '88d4fb7cd6b792aaa7c8d6547d22567a', 0, '1476520268', 1, 'An Lão', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(283, NULL, 20, '2cb23e3bc1d7382c0ac6db977d5182e2', 0, '1476520268', 1, 'Kiến Thụy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(284, NULL, 20, '63323eeeaaaec56787f1eb180ed1f797', 0, '1476520268', 1, 'Tiên Lãng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(285, NULL, 20, 'bd0499597299711d07869f87b491d5fd', 0, '1476520268', 1, 'Vĩnh Bảo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(286, NULL, 20, '11fa550436e2e089dd88a7154c701daf', 0, '1476520268', 1, 'Cát Hải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(287, NULL, 20, '63131eb7fccb51c6cf040479846fe4cf', 0, '1476520268', 1, 'Bạch Long Vĩ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(288, NULL, 21, '14853f05f72afd67ade399e7b174801d', 0, '1476520268', 1, 'Hưng Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(289, NULL, 21, 'aefbccb70be16ca625d6c16b8dc8450b', 0, '1476520268', 1, 'Văn Lâm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(290, NULL, 21, '788484d29847c0a0afa6f82bc4199997', 0, '1476520268', 1, 'Văn Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(291, NULL, 21, '2cd9000197d0a4296cb7696882380b2e', 0, '1476520268', 1, 'Yên Mỹ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(292, NULL, 21, '6cc9270e0b249ead3251ae6e21f48166', 0, '1476520268', 1, 'Mỹ Hào', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(293, NULL, 21, '857a84ce8467e783d7ecf708b114701c', 0, '1476520268', 1, 'Ân Thi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(294, NULL, 21, '70a79fa33b09fb2282259f68f6579d20', 0, '1476520268', 1, 'Khoái Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(295, NULL, 21, 'ca5ee0b4b070e8b9e935fe9ab572d165', 0, '1476520268', 1, 'Kim Động', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(296, NULL, 21, '4bb94126fa015e7a458f8634dbbe751a', 0, '1476520268', 1, 'Tiên Lữ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(297, NULL, 21, '5dc159c97c5ecd99d2a37ed26ce4f663', 0, '1476520268', 1, 'Phù Cừ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(298, NULL, 22, '1493d5d9fec66386e401c15a7515a013', 0, '1476520268', 1, 'Thái Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(299, NULL, 22, 'befff3fd636287e07a8777ae4cfd0708', 0, '1476520268', 1, 'Quỳnh Phụ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(300, NULL, 22, 'f621c7cb19ac2ec9b5516d49e5fe8737', 0, '1476520268', 1, 'Hưng Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(301, NULL, 22, '5d1e0035d86505c78b053977e2b7a287', 0, '1476520268', 1, 'Đông Hưng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(302, NULL, 22, '4ee7ae818b56c099cd5f0b54bc3bb2ab', 0, '1476520268', 1, 'Thái Thụy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(303, NULL, 22, '334d9c556b01264b0953866c2b673d0d', 0, '1476520268', 1, 'Tiền Hải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(304, NULL, 22, '4be473acfcde412ac233337a5c7ceff8', 0, '1476520268', 1, 'Kiến Xương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(305, NULL, 22, '0c3e5bc6fda49ab6c1a656590e6d2620', 0, '1476520268', 1, 'Vũ Thư', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(306, NULL, 23, 'b11afafc8462c59e3eeb6eff5a5018bb', 0, '1476520268', 1, 'Phủ Lý', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(307, NULL, 23, 'b2acdae246473f6614e2fe87fbd3b290', 0, '1476520268', 1, 'Duy Tiên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(308, NULL, 23, '73ddd597943d6aee45103be8bc412dfb', 0, '1476520268', 1, 'Kim Bảng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(309, NULL, 23, '4bf0dfd91cb004905487adf9a5384bc2', 0, '1476520268', 1, 'Thanh Liêm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(310, NULL, 23, 'f4c60524355a3a1069d31359ea4953ea', 0, '1476520268', 1, 'Bình Lục', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(311, NULL, 23, '96915a547c3d62ce98b26d60a61a72a9', 0, '1476520268', 1, 'Lý Nhân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(312, NULL, 24, '5e58accdd4ca5b90c5702d4ed8f21d22', 0, '1476520268', 1, 'Nam Định', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(313, NULL, 24, '97334ec47ad214731420e1cfe4b9c4a1', 0, '1476520268', 1, 'Mỹ Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(314, NULL, 24, '177dfe9f292ef9495c69b5aad25f2932', 0, '1476520268', 1, 'Vụ Bản', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(315, NULL, 24, '574f01bb0df85a86018e61ba89f56ba0', 0, '1476520268', 1, 'Ý Yên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(316, NULL, 24, '0dc310e09dc1dffe144e347f34c97aa1', 0, '1476520268', 1, 'Nghĩa Hưng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(317, NULL, 24, '71007c62db717f0bd02d343029ed18d6', 0, '1476520268', 1, 'Nam Trực', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(318, NULL, 24, 'f459c94940f3c5958f306e081eafed2a', 0, '1476520268', 1, 'Trực Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(319, NULL, 24, 'f0aa20ef07c6247118a1bdbaf5013b13', 0, '1476520268', 1, 'Xuân Trường', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(320, NULL, 24, 'bd58244940c5f0c230cb5778b206c564', 0, '1476520268', 1, 'Giao Thủy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(321, NULL, 24, '6ef1e12afb6b5ca39601680ac188d56f', 0, '1476520268', 1, 'Hải Hậu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(322, NULL, 25, 'c84425ff5f337f7ccf4e3d63652d14d8', 0, '1476520268', 1, 'Ninh Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(323, NULL, 25, '8c19ba530cc2c3704887c7902f66527e', 0, '1476520268', 1, 'Tam Điệp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(324, NULL, 25, 'a965123fa8ce88ebddf486e83aa0a06a', 0, '1476520268', 1, 'Nho Quan', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(325, NULL, 25, '7a7a44ba84af46e18a718edd97f3971e', 0, '1476520268', 1, 'Gia Viễn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(326, NULL, 25, '1c14066f7b8900e1bc5b0f7fe2668ece', 0, '1476520268', 1, 'Hoa Lư', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(327, NULL, 25, '5c3d8bcb3288422d8da6faf3b2004252', 0, '1476520268', 1, 'Yên Khánh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(328, NULL, 25, '964f868ce719a22a4bd2abd1fcf0ee1e', 0, '1476520268', 1, 'Kim Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(329, NULL, 25, 'ec5ddaf2a0efeccb965d78793642173e', 0, '1476520268', 1, 'Yên Mô', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(330, NULL, 26, 'dbd5b1ff4318c9e169f657872d346268', 0, '1476520268', 1, 'Thanh Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(331, NULL, 26, '95dbadfe178494807428a6de37e2f9c4', 0, '1476520268', 1, 'Bỉm Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(332, NULL, 26, 'a739ce517e59283abb600e4fb9a0cf45', 0, '1476520268', 1, 'Sầm Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(333, NULL, 26, '445b76c8da110f715f213499431cdd4f', 0, '1476520268', 1, 'Mường Lát', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(334, NULL, 26, 'e6303eecc44ef5052bb1918db7f41911', 0, '1476520268', 1, 'Quan Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(335, NULL, 26, '27aa10963805e90bb37e7ed925accc41', 0, '1476520268', 1, 'Bá Thước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(336, NULL, 26, 'cf028dbb189714bd13abfff729d54ef6', 0, '1476520268', 1, 'Quan Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(337, NULL, 26, '4c4ea67b1bc4844c69037164192032c5', 0, '1476520268', 1, 'Lang Chánh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(338, NULL, 26, '63033b51000b69d831c47277443a49dd', 0, '1476520268', 1, 'Ngọc Lặc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(339, NULL, 26, '6534be0bbc2368458c060b30e4a085b7', 0, '1476520268', 1, 'Cẩm Thủy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(340, NULL, 26, 'eabbb7c7e89da42019712d8fda11c5ad', 0, '1476520268', 1, 'Thạch Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(341, NULL, 26, 'f565e63b2605285a0d168a1fec5879da', 0, '1476520268', 1, 'Hà Trung', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(342, NULL, 26, 'c9674bb8659a397d022f4d6676f5df97', 0, '1476520268', 1, 'Vĩnh Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(343, NULL, 26, '0f680ad87a02ae239adba6e0bfeab26a', 0, '1476520268', 1, 'Yên Định', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(344, NULL, 26, 'cb0557199e98e82bdc79f2a8afa9b480', 0, '1476520268', 1, 'Thọ Xuân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(345, NULL, 26, 'e69714b31a52178d0df395fde94fb377', 0, '1476520268', 1, 'Thường Xuân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(346, NULL, 26, '699a58be56e239a1078d8f5a7028eebf', 0, '1476520268', 1, 'Triệu Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(347, NULL, 26, 'bc9c7b926e22c0211a475416352e379b', 0, '1476520268', 1, 'Thiệu Hoá', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(348, NULL, 26, '77d101fddafb4453ac423a3f90cff845', 0, '1476520268', 1, 'Hoằng Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(349, NULL, 26, 'd15902cd6e2d7ed2df498fb3fb8ca403', 0, '1476520268', 1, 'Hậu Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(350, NULL, 26, 'c18393118cfa13add24236dea4b7931a', 0, '1476520268', 1, 'Nga Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(351, NULL, 26, '0ec9301d88e74fe295c2fa9777cca491', 0, '1476520268', 1, 'Như Xuân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(352, NULL, 26, 'bd08fb1092dfb48964db4fd42f28cb21', 0, '1476520268', 1, 'Như Thanh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(353, NULL, 26, '7c61bc80220e1138c3704617a76f2b2c', 0, '1476520268', 1, 'Nông Cống', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(354, NULL, 26, '9e065b956472ff566619b9354578392e', 0, '1476520268', 1, 'Đông Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(355, NULL, 26, 'e731205a61f13f59004d2e5c5c74c61a', 0, '1476520268', 1, 'Quảng Xương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(356, NULL, 26, '0887d5291070e7a4d01da8133d5558ab', 0, '1476520268', 1, 'Tĩnh Gia', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(357, NULL, 27, '12ad450fe466597db07fc458f371f78e', 0, '1476520268', 1, 'Vinh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(358, NULL, 27, '5d206fb06e636e8acffb2e926bf4aab9', 0, '1476520268', 1, 'Cửa Lò', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(359, NULL, 27, 'f97e98172fbb4f71b24f38b83d949541', 0, '1476520268', 1, 'Thái Hoà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(360, NULL, 27, '14c278e5d27a261731ff261de99c0bde', 0, '1476520268', 1, 'Quế Phong', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(361, NULL, 27, '4dc7806ec1723d85ef6c4f29b554528d', 0, '1476520268', 1, 'Quỳ Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(362, NULL, 27, 'b182cfc47ba45f54865ea5e0149f2d4c', 0, '1476520268', 1, 'Kỳ Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(363, NULL, 27, 'c348cbec98b0b4a0d88b2e9a7a44cab9', 0, '1476520268', 1, 'Tương Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(364, NULL, 27, 'c8d06b6cb24f792cafba3f789e128e9c', 0, '1476520268', 1, 'Nghĩa Đàn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(365, NULL, 27, 'da3b08f504f5656f874c64a684d7ac86', 0, '1476520268', 1, 'Quỳ Hợp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(366, NULL, 27, '43fe21716804cd00935092d8e9c64d31', 0, '1476520268', 1, 'Quỳnh Lưu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(367, NULL, 27, '2ef61dbee6e4eb6241214f5a064b0867', 0, '1476520268', 1, 'Con Cuông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(368, NULL, 27, '0f5f7dfeb469404e2668414c10b163c9', 0, '1476520268', 1, 'Tân Kỳ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(369, NULL, 27, 'c52ee0e0324357423185c93e0dfe34b1', 0, '1476520268', 1, 'Anh Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(370, NULL, 27, '60dbc099beeb07926ccfd5e7f0c647e5', 0, '1476520268', 1, 'Diễn Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(371, NULL, 27, '0418cbbc4dfdd7fe776f144cdf151dce', 0, '1476520268', 1, 'Yên Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(372, NULL, 27, '3d80664fcc60778f0ca157219765abab', 0, '1476520268', 1, 'Đô Lương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(373, NULL, 27, '3f30edb3f4eaf9380053afc3e148db54', 0, '1476520268', 1, 'Thanh Chương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(374, NULL, 27, '6dfbf112b5e086a89ae246e6571784e9', 0, '1476520268', 1, 'Nghi Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(375, NULL, 27, 'e8c738a63848bc4a5e9453441282d0dd', 0, '1476520268', 1, 'Nam Đàn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(376, NULL, 27, '4d44b2c6480ae2a44c8e7fe6364931f2', 0, '1476520268', 1, 'Hưng Nguyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(377, NULL, 28, '3995659abd63e623006ce337c53a6d12', 0, '1476520268', 1, 'Hà Tĩnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(378, NULL, 28, '1456fe5e17c9166b5bf87ccab6a54730', 0, '1476520268', 1, 'Hồng Lĩnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(379, NULL, 28, '01a55952380b78da93011ae65d460e87', 0, '1476520268', 1, 'Hương Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(380, NULL, 28, 'f26a620c2c804b6383856254921f0c2a', 0, '1476520268', 1, 'Đức Thọ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(381, NULL, 28, '825e1592681a1f100a11ececa6532f34', 0, '1476520268', 1, 'Vũ Quang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(382, NULL, 28, '6d81cf75eb34034e1c08903ee459695d', 0, '1476520268', 1, 'Nghi Xuân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(383, NULL, 28, '209214a2b87bebc895f9a4c9200f5bed', 0, '1476520268', 1, 'Can Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(384, NULL, 28, 'ec8d8ce70178edf9712913ddd4ff6037', 0, '1476520268', 1, 'Hương Khê', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7);
INSERT INTO `tp_area` (`id`, `areaid`, `fid`, `uuid`, `sort`, `ctime`, `checked`, `name`, `subtype`, `webname`, `card`, `is_price`, `is_jigou`, `ename`, `type`, `url`, `admin_id`) VALUES
(385, NULL, 28, 'f3d47c8f47eda5d191da86dd9c0a3014', 0, '1476520268', 1, 'Thạch Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(386, NULL, 28, 'dde50ce5f99cc62d973ee898f04cdc54', 0, '1476520268', 1, 'Cẩm Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(387, NULL, 28, '48915fee8f54afc5529cddd6da1eb7fc', 0, '1476520268', 1, 'Kỳ Anh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(388, NULL, 28, 'fd51ce8a45cad8967855afb7e1d3ed6d', 0, '1476520268', 1, 'Lộc Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(389, NULL, 29, '97c98813f4730ad842ec67522dd358b3', 0, '1476520268', 1, 'Đồng Hới', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(390, NULL, 29, '76655aab276e5e0a66ea93b72d20c3b0', 0, '1476520268', 1, 'Minh Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(391, NULL, 29, '66d7809adc5ac8681c73b7480e158f39', 0, '1476520268', 1, 'Tuyên Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(392, NULL, 29, 'f105eb1a72fc7f960be6f514676ae06f', 0, '1476520268', 1, 'Quảng Trạch', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(393, NULL, 29, '39b4e42b53b768bbf5e7caf2df18ec33', 0, '1476520268', 1, 'Bố Trạch', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(394, NULL, 29, '45d6732b7910986882f7cd1be4d74581', 0, '1476520268', 1, 'Quảng Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(395, NULL, 29, 'bf1289970d047f005fc205d88138934f', 0, '1476520268', 1, 'Lệ Thủy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(396, NULL, 30, '26971a97a0c21cf1f39ba1c55125cbd9', 0, '1476520268', 1, 'Đông Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(397, NULL, 30, '1bdba7a169b96d2464a6865617a33f13', 0, '1476520268', 1, 'Quảng Trị', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(398, NULL, 30, '6f85c3f9b64d3fd68cb6604d8528ff69', 0, '1476520268', 1, 'Vĩnh Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(399, NULL, 30, 'cf736d4cb264634635f79b5874a42ae5', 0, '1476520268', 1, 'Hướng Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(400, NULL, 30, '36f9f1bac2b65316f351e746f8ce0688', 0, '1476520268', 1, 'Gio Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(401, NULL, 30, 'c20835c80974cc3c821cd4d979981ec7', 0, '1476520268', 1, 'Đa Krông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(402, NULL, 30, 'ed63c28ac5db30d53848f8110b6f9e29', 0, '1476520268', 1, 'Cam Lộ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(403, NULL, 30, 'e9c65f41a3daf2886f3667ca7ec0b7d3', 0, '1476520268', 1, 'Triệu Phong', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(404, NULL, 30, '0767216d7cb61343900894506965554e', 0, '1476520268', 1, 'Hải Lăng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(405, NULL, 30, '4ad1e105ae0f51f2d2f632c266eb2763', 0, '1476520268', 1, 'Cồn Cỏ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(406, NULL, 31, 'ddf518f44bdaca8e4e448e44e5aec3d1', 0, '1476520268', 1, 'Huế', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(407, NULL, 31, '7ee9d40af31e3f579052cf5292cbc0f2', 0, '1476520268', 1, 'Phong Điền', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(408, NULL, 31, '2d50102dcb5f81295a00af3e9f25770e', 0, '1476520268', 1, 'Quảng Điền', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(409, NULL, 31, '10fdc290b71fbabc439470fcce8adcd5', 0, '1476520268', 1, 'Phú Vang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(410, NULL, 31, 'dec86314b33768e1984b1c6b01071bfa', 0, '1476520268', 1, 'Hương Thủy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(411, NULL, 31, '71c96414f0ce01397bb25c1cbddb4477', 0, '1476520268', 1, 'Hương Trà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(412, NULL, 31, '1bec646401fc27bef88659f312fa415d', 0, '1476520268', 1, 'A Lưới', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(413, NULL, 31, 'e88e767a15368312fe6906c345c330f1', 0, '1476520268', 1, 'Phú Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(414, NULL, 31, '0e3dfe15f283de42a64087b73b6b17e3', 0, '1476520268', 1, 'Nam Đông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(415, NULL, 32, '836338aa53ff43d37130854d6322588f', 0, '1476520268', 1, 'Liên Chiểu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(416, NULL, 32, 'f4063d76450a2540f41602c43d919c9c', 0, '1476520268', 1, 'Thanh Khê', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(417, NULL, 32, '9f16173f103b97a924d955fd0756e1ad', 0, '1476520268', 1, 'Hải Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(418, NULL, 32, 'f10b63d311476575dfadc50bd196bc6d', 0, '1476520268', 1, 'Sơn Trà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(419, NULL, 32, 'f70b7efdc90068258f31a70efdc79143', 0, '1476520268', 1, 'Ngũ Hành Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(420, NULL, 32, '8fc5d50859af50d9cab4225b4b375c99', 0, '1476520268', 1, 'Cẩm Lệ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(421, NULL, 32, 'c78ba72687c52fcf8a925197c5f97dfe', 0, '1476520268', 1, 'Hoà Vang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(422, NULL, 32, '75e5859a8b34754791f019daa32fd429', 0, '1476520268', 1, 'Hoàng Sa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(423, NULL, 33, '25d9e86b7d63c6ac684b3f5069644269', 0, '1476520268', 1, 'Tam Kỳ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(424, NULL, 33, '0bbac087b1a83f69c3539fb79d496179', 0, '1476520268', 1, 'Hội An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(425, NULL, 33, 'f0dd6cae51dbda87587f3894a6ce9e8e', 0, '1476520268', 1, 'Tây Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(426, NULL, 33, 'b80e7101d99b4339babed1f9cc810468', 0, '1476520268', 1, 'Đông Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(427, NULL, 33, 'f423f798f9fa604e4ed64c9aa2213781', 0, '1476520268', 1, 'Đại Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(428, NULL, 33, 'd04058ba39dc229e90037a420623541f', 0, '1476520268', 1, 'Điện Bàn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(429, NULL, 33, '6d2fa0448d05b19007b6626739df34e7', 0, '1476520268', 1, 'Duy Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(430, NULL, 33, '58e988734886641e3673f478868a7b7e', 0, '1476520268', 1, 'Quế Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(431, NULL, 33, 'd1080783b424cb3ba3ea5377e247c0ee', 0, '1476520268', 1, 'Nam Giang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(432, NULL, 33, '64221c0225d1ea02c339bad9acfddc9a', 0, '1476520268', 1, 'Phước Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(433, NULL, 33, '91e99b4b2f1fdadf4f3e3c290890d4d4', 0, '1476520268', 1, 'Hiệp Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(434, NULL, 33, 'fc8aaafa12779bd20156c265afdfb29c', 0, '1476520268', 1, 'Thăng Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(435, NULL, 33, '9aceef50dcfe88b247efb81cde010e5a', 0, '1476520268', 1, 'Tiên Phước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(436, NULL, 33, 'cd565748363a7fe7c18332ff706d1d63', 0, '1476520268', 1, 'Bắc Trà My', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(437, NULL, 33, '358864e0c815d46aa5fc02bfa6fedfcf', 0, '1476520268', 1, 'Nam Trà My', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(438, NULL, 33, 'f26ae30d6be1af8ca044e3b5d7b23768', 0, '1476520268', 1, 'Núi Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(439, NULL, 33, '7e159e092a84c8071204e89151c14f05', 0, '1476520268', 1, 'Phú Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(440, NULL, 33, '2df215d6a48b729d0bc278446874325a', 0, '1476520268', 1, 'Nông Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(441, NULL, 34, '62ece425e439c27cf5f538d4ff13e161', 0, '1476520268', 1, 'Quảng Ngãi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(442, NULL, 34, '38c08dce0bb8106d873e488ccbdf9eb7', 0, '1476520268', 1, 'Bình Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(443, NULL, 34, '6b45e733917150c90ae4f08b1e246486', 0, '1476520268', 1, 'Trà Bồng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(444, NULL, 34, '5184196a5538333c06b8e6630458270d', 0, '1476520268', 1, 'Tây Trà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(445, NULL, 34, 'b02d7858f512d3e7a0d2313002262cb3', 0, '1476520268', 1, 'Sơn Tịnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(446, NULL, 34, '6615c385e72c5e9349885f26bb58f91f', 0, '1476520268', 1, 'Tư Nghĩa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(447, NULL, 34, '86cb8ca7a4af5043c39e2d47c373b794', 0, '1476520268', 1, 'Sơn Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(448, NULL, 34, 'f5915880b95ec944fa4dcac8ee0e1c9e', 0, '1476520268', 1, 'Sơn Tây', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(449, NULL, 34, 'ab647318250a5f3cf3fdf0e90b3cd138', 0, '1476520268', 1, 'Minh Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(450, NULL, 34, 'd2f0510c99c3a081ffc109c800684283', 0, '1476520268', 1, 'Nghĩa Hành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(451, NULL, 34, '20b41991a8a3743524869f421dc7e56e', 0, '1476520268', 1, 'Mộ Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(452, NULL, 34, 'ae2edf89bd85811d5990f48018942a99', 0, '1476520268', 1, 'Đức Phổ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(453, NULL, 34, '9bba7bdd2756f6c1ddf34253c6295482', 0, '1476520268', 1, 'Ba Tơ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(454, NULL, 34, '6d6539d347c47f33744bfcb26215cba7', 0, '1476520268', 1, 'Lý Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(455, NULL, 35, 'e04a27db63fafcfaad082c0c50231c42', 0, '1476520268', 1, 'Qui Nhơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(456, NULL, 35, 'adf6f8a502d4f69835ab6e007eb35b40', 0, '1476520268', 1, 'An Lão', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(457, NULL, 35, 'e28372e755e9214b6efa76bb38e4bdbc', 0, '1476520268', 1, 'Hoài Nhơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(458, NULL, 35, '19d38fadeb214b01bf531a90a576bf9e', 0, '1476520268', 1, 'Hoài Ân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(459, NULL, 35, '6b6181ea2b1ee00078bad708137222cc', 0, '1476520268', 1, 'Phù Mỹ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(460, NULL, 35, '0bcd8d463634d9b51dd829c3eea6ee78', 0, '1476520268', 1, 'Vĩnh Thạnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(461, NULL, 35, '1e63b2d69735a7972bff99ee735cfaa7', 0, '1476520268', 1, 'Tây Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(462, NULL, 35, '0d5941aa7d804850dbd6ac95e5213665', 0, '1476520268', 1, 'Phù Cát', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(463, NULL, 35, '844458bc0418a230e4f79dc2aa9314f2', 0, '1476520268', 1, 'An Nhơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(464, NULL, 35, '55e03cdcf45dcb5e070307e3b58cc2b2', 0, '1476520268', 1, 'Tuy Phước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(465, NULL, 35, 'de02699f22fa2087272ebf0ae5aa71a5', 0, '1476520268', 1, 'Vân Canh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(466, NULL, 36, '1fe92f3e667c645c2fd9cfcccd3d3849', 0, '1476520268', 1, 'Tuy Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(467, NULL, 36, '519aeec88115df70c7751390512ba439', 0, '1476520268', 1, 'Sông Cầu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(468, NULL, 36, '27ba9f26b86b46ef7c0530fa18bc04bc', 0, '1476520268', 1, 'Đồng Xuân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(469, NULL, 36, '7d1c4beab81a79ded8fa36d432ecc837', 0, '1476520268', 1, 'Tuy An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(470, NULL, 36, 'c7cc393e3744d1f8092ee471bb286131', 0, '1476520268', 1, 'Sơn Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(471, NULL, 36, 'c3c395e1ca05f1747b2682d7bd33aa64', 0, '1476520268', 1, 'Sông Hinh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(472, NULL, 36, '576ca3b05e246683c90a1ad0bd055b41', 0, '1476520268', 1, 'Tây Hoà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(473, NULL, 36, '0bcf3a07915e1d8c12f124bc2e275f2c', 0, '1476520268', 1, 'Phú Hoà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(474, NULL, 36, 'b32f84eff75f359130a6cc584e02e48a', 0, '1476520268', 1, 'Đông Hoà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(475, NULL, 37, 'ef25cfb99067bacc7ab047e21c8941f0', 0, '1476520268', 1, 'Nha Trang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(476, NULL, 37, 'e4b53709ca094dceaad798267a33b90f', 0, '1476520268', 1, 'Cam Ranh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(477, NULL, 37, 'f6436339b636e94127f7671d35ee45fe', 0, '1476520268', 1, 'Cam Lâm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(478, NULL, 37, '31fb31a551281d0caede0b342c8e81c8', 0, '1476520268', 1, 'Vạn Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(479, NULL, 37, '2fe12879769b4583120cd33653232e1d', 0, '1476520268', 1, 'Ninh Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(480, NULL, 37, '793bbf270927635564b1cb5a203f7230', 0, '1476520268', 1, 'Khánh Vĩnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(481, NULL, 37, 'fd7cfb07eacd87307ce86ec9b6e83e3e', 0, '1476520268', 1, 'Diên Khánh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(482, NULL, 37, '78a85996a62c63d47b913f9075c219aa', 0, '1476520268', 1, 'Khánh Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(483, NULL, 37, '5f076fcbdcb87bcc13d9836fec11332c', 0, '1476520268', 1, 'Trường Sa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(484, NULL, 38, '412049f79aa0b9b72740052072ad80f6', 0, '1476520268', 1, 'Phan Rang-Tháp Chàm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(485, NULL, 38, 'dfcfa1b343a7d47b1446ee7a22c52ada', 0, '1476520268', 1, 'Bác Ái', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(486, NULL, 38, '25b987f4f33d44e851cb9eece00360b2', 0, '1476520268', 1, 'Ninh Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(487, NULL, 38, 'fa64f5292e2f13aeac7fe2261eeb6595', 0, '1476520268', 1, 'Ninh Hải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(488, NULL, 38, 'bb060c164ff3e589eb924aa6fe62426e', 0, '1476520268', 1, 'Ninh Phước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(489, NULL, 38, 'e6a62e84b750656d5c8c7fc3f5dc1c7a', 0, '1476520268', 1, 'Thuận Bắc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(490, NULL, 38, '7d92af2f015367f25b4692df235770fe', 0, '1476520268', 1, 'Thuận Nam', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(491, NULL, 39, '0d97ed5ebb25a95895aaa59bf56f7a8e', 0, '1476520268', 1, 'Phan Thiết', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(492, NULL, 39, '4d53f4b72f02f069656a402c7034acf9', 0, '1476520268', 1, 'La Gi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(493, NULL, 39, 'a6cbe445ed6fc5a3a0753568f16ffc14', 0, '1476520268', 1, 'Tuy Phong', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(494, NULL, 39, 'e94172ffaea27b04da87cd55eeb6406d', 0, '1476520268', 1, 'Bắc Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(495, NULL, 39, '48ebca8d64fcd225d923ae3f926628c5', 0, '1476520268', 1, 'Hàm Thuận Bắc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(496, NULL, 39, 'c06ff9beeda2b3ce72e7f11765ec1aab', 0, '1476520268', 1, 'Hàm Thuận Nam', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(497, NULL, 39, '1474433b5077a0cc52a52fb8051555b8', 0, '1476520268', 1, 'Tánh Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(498, NULL, 39, '8979d83ebf257ce39ce4e5400877f5a6', 0, '1476520268', 1, 'Đức Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(499, NULL, 39, '78f562429668fc77617cb25bcabf1307', 0, '1476520268', 1, 'Hàm Tân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(500, NULL, 39, '64e9347c2aa77c60ff4451f9de3f7752', 0, '1476520268', 1, 'Phú Quí', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(501, NULL, 40, 'b2a45347c52c8f051316bf4f900f94a3', 0, '1476520268', 1, 'Kon Tum', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(502, NULL, 40, 'c13a109b944f56f13a04f5ec39c07d54', 0, '1476520268', 1, 'Đắk Glei', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(503, NULL, 40, 'ca0e7f3f2e025193848ee6142fcce2c6', 0, '1476520268', 1, 'Ngọc Hồi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(504, NULL, 40, 'e75d7f68cd93d6149f4d090c8e43fe50', 0, '1476520268', 1, 'Đắk Tô', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(505, NULL, 40, '764e1daebe2245b56f2c80847884b996', 0, '1476520268', 1, 'Kon Plông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(506, NULL, 40, 'ccb46d16977f9de3d45fc697a5038701', 0, '1476520268', 1, 'Kon Rẫy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(507, NULL, 40, '0a029e3253a8b9552e976c9dfc8c5e70', 0, '1476520268', 1, 'Đắk Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(508, NULL, 40, '03e1f2283f8eeacd9829243f69105042', 0, '1476520268', 1, 'Sa Thầy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(509, NULL, 40, 'bd18cbded693fcd0f6ae24ad25754428', 0, '1476520268', 1, 'Tu Mơ Rông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(510, NULL, 41, 'd5ba0e6112a0c8f1726b331ba9e5425c', 0, '1476520268', 1, 'Pleiku', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(511, NULL, 41, '746fa6461e154787a7665b0eea8f5d2a', 0, '1476520268', 1, 'An Khê', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(512, NULL, 41, '166133d311e73772012b75ffb5a3d6b7', 0, '1476520268', 1, 'Ayun Pa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(513, NULL, 41, '1b69a64d4b182d4287c92b3506a30cc0', 0, '1476520268', 1, 'Kbang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(514, NULL, 41, '6cffd81721f34051d5883fc6cb69b4e7', 0, '1476520268', 1, 'Đăk Đoa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(515, NULL, 41, '8b0ffdaf0207d6e949ee72cd686bff9f', 0, '1476520268', 1, 'Chư Păh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(516, NULL, 41, '996c07ba271f8608c4d032aaf1a2c2f0', 0, '1476520268', 1, 'Ia Grai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(517, NULL, 41, '8c3d4b553fe66b122c63d8bc7cb67bd0', 0, '1476520268', 1, 'Mang Yang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(518, NULL, 41, 'a48ada3707009a36a13c2fda8661cde2', 0, '1476520268', 1, 'Kông Chro', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(519, NULL, 41, 'ccce9556fe2c50e989194ad041f660c9', 0, '1476520268', 1, 'Đức Cơ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(520, NULL, 41, '7b937d424f4af0fc7434d676cf5585c9', 0, '1476520268', 1, 'Chư Prông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(521, NULL, 41, '6a6efc49cc64e1a65f5b7e2ce5285d84', 0, '1476520268', 1, 'Chư Sê', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(522, NULL, 41, '738b8c2754f40a5f5b32a560497fac61', 0, '1476520268', 1, 'Đăk Pơ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(523, NULL, 41, '4b3f25b6fc56d33b020c7a6081ba70f3', 0, '1476520268', 1, 'Ia Pa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(524, NULL, 41, '061f2a64b719d2f6f56b37b5a7792cf7', 0, '1476520268', 1, 'Krông Pa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(525, NULL, 41, '40c664d3da6b0531740e8a449cd2b79d', 0, '1476520268', 1, 'Phú Thiện', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(526, NULL, 41, '5cafc916d4c9751f837316550cd0fb8e', 0, '1476520268', 1, 'Chư Pưh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(527, NULL, 42, 'db071f0ad0337c55252fd8b2a9f33968', 0, '1476520268', 1, 'Buôn Ma Thuột', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(528, NULL, 42, '4fc38a09cd0c27c58fe9022e04847945', 0, '1476520268', 1, 'Buôn Hồ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(529, NULL, 42, '6073d587fee77ac5e59bafba65a22039', 0, '1476520268', 1, 'Ea H\'leo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(530, NULL, 42, '03eeca3dff5bd6dca550b0d8896b0a32', 0, '1476520268', 1, 'Ea Súp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(531, NULL, 42, '0ec16f2063a3bfb24ec24bb819ed5a84', 0, '1476520268', 1, 'Buôn Đôn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(532, NULL, 42, '3d6416737d4fcc4bf4f2919324bebdc7', 0, '1476520268', 1, 'Cư M\'gar', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(533, NULL, 42, '40e1bebaa379d6a4ad2fed72f303fba8', 0, '1476520268', 1, 'Krông Búk', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(534, NULL, 42, 'd2e823b80146b815b00b27b59e8e6af1', 0, '1476520268', 1, 'Krông Năng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(535, NULL, 42, '965aee19fde9473b40da830f4adc38cd', 0, '1476520268', 1, 'Ea Kar', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(536, NULL, 42, 'c12d8e88df3794633e269e1508667999', 0, '1476520268', 1, 'M\'đrắk', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(537, NULL, 42, 'cf237a88903e7bf9e47fcb9ec80d8cbe', 0, '1476520268', 1, 'Krông Bông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(538, NULL, 42, '03486b95cc67b140ed336aaeb6a30065', 0, '1476520268', 1, 'Krông Pắc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(539, NULL, 42, '6db68241083bb5b9c43f3f71704513ad', 0, '1476520268', 1, 'Krông A Na', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(540, NULL, 42, '8b5140627a2682b0f64b026f52b2d053', 0, '1476520268', 1, 'Lắk', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(541, NULL, 42, 'c05ad86f1fbea01ef4a845a3ad7459a5', 0, '1476520268', 1, 'Cư Kuin', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(542, NULL, 43, '6877e932490eca9ea7b052d2a76ebc62', 0, '1476520268', 1, 'Gia Nghĩa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(543, NULL, 43, '43c06ce035e4b3508acc0958e9926c52', 0, '1476520268', 1, 'Đắk Glong', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(544, NULL, 43, 'ace23d360e87e7d6929516a8355aa4a1', 0, '1476520268', 1, 'Cư Jút', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(545, NULL, 43, 'd9d6118be14bcb0bee398c50257d8e7a', 0, '1476520268', 1, 'Đắk Mil', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(546, NULL, 43, '0147229080557ce88a9ddaeef249c3c0', 0, '1476520268', 1, 'Krông Nô', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(547, NULL, 43, 'b508659f2b7109aa506c4877c1a4c50a', 0, '1476520268', 1, 'Đắk Song', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(548, NULL, 43, '0f85768944081df2d90a4fe1409bbc36', 0, '1476520268', 1, 'Đắk R\'lấp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(549, NULL, 43, '29db72c9f4b5d8d1d4517afbaafe371a', 0, '1476520268', 1, 'Tuy Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(550, NULL, 44, '94af8306ae9f45df09a07fa1aeac058b', 0, '1476520268', 1, 'Đà Lạt', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(551, NULL, 44, '9dd77852199a38b6563d4dfa79b6c9e3', 0, '1476520268', 1, 'Bảo Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(552, NULL, 44, 'fa297ce0aad4ad1671ac93d5e47feca7', 0, '1476520268', 1, 'Đam Rông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(553, NULL, 44, '43709b46010ae0875337914a554ee0a1', 0, '1476520268', 1, 'Lạc Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(554, NULL, 44, 'd6a380bc6c9ac5d34bab48b47bea64ac', 0, '1476520268', 1, 'Lâm Hà', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(555, NULL, 44, '75a8ef0646a9253cc07dbd1284e8f876', 0, '1476520268', 1, 'Đơn Dương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(556, NULL, 44, '8184ad4642a1d57b26de4af11ff19fc9', 0, '1476520268', 1, 'Đức Trọng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(557, NULL, 44, '465687475259215ca49cbc18818de72a', 0, '1476520268', 1, 'Di Linh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(558, NULL, 44, 'd27809d31205a96daa18a06b9018fc08', 0, '1476520268', 1, 'Bảo Lâm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(559, NULL, 44, '8d63c8a922f9bda6f4b4d7e05f9c2c4c', 0, '1476520268', 1, 'Đạ Huoai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(560, NULL, 44, 'dbf9473c199d5fb05fc9a05f990a1c79', 0, '1476520268', 1, 'Đạ Tẻh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(561, NULL, 44, '666f79ea5f30cfeb93f2e6346b20e55e', 0, '1476520268', 1, 'Cát Tiên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(562, NULL, 45, 'c146c632180e992a25556df10b190b78', 0, '1476520268', 1, 'Đồng Xoài', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(563, NULL, 45, 'f986a5961cc4f8b8c399d58952cacb6c', 0, '1476520268', 1, 'Phước Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(564, NULL, 45, '67e0f8bccc5de244c385e573779f154a', 0, '1476520268', 1, 'Bình Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(565, NULL, 45, '0951064b10d930a6743f9c89b5e50d04', 0, '1476520268', 1, 'Bù Gia Mập', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(566, NULL, 45, '03507e6dcfd19e314fcab469e4d35d22', 0, '1476520268', 1, 'Lộc Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(567, NULL, 45, '49cab6ce4ef94bd25bd73d28e657b753', 0, '1476520268', 1, 'Bù Đốp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(568, NULL, 45, 'b3b4a3015ad91747210fa3dc0be2fd73', 0, '1476520268', 1, 'Hớn Quản', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(569, NULL, 45, '348ad8422f0e8bb8dd0fcc94a303c698', 0, '1476520268', 1, 'Đồng Phù', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(570, NULL, 45, '58349aef6193fc2eff387cb7dd98bb20', 0, '1476520268', 1, 'Bù Đăng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(571, NULL, 45, 'cf6cdd5910892ce2c99cc5223a31ec9d', 0, '1476520268', 1, 'Chơn Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(572, NULL, 46, 'ba7c38607fa86f7e90944a163e02976e', 0, '1476520268', 1, 'Tây Ninh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(573, NULL, 46, 'e28374cc321be959244fa07e8423df34', 0, '1476520268', 1, 'Tân Biên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(574, NULL, 46, 'cf62f12121dede47d6249ce97f706284', 0, '1476520268', 1, 'Tân Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(575, NULL, 46, '039651d224af66ae1736f0e43859bc82', 0, '1476520268', 1, 'Dương Minh Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(576, NULL, 46, '0efd29fdf04ddd6dc5500551384c1aab', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(577, NULL, 46, 'c883ae5d6f0ecf01fb557278b23fd498', 0, '1476520268', 1, 'Hòa Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(578, NULL, 46, '7801f90b4c30341787c9842007eb1cfc', 0, '1476520268', 1, 'Gò Dầu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(579, NULL, 46, '570fe5a6ad06282b10eb32983d882466', 0, '1476520268', 1, 'Bến Cầu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(580, NULL, 46, 'd380bf4ae6deb8ff754453466b76a278', 0, '1476520268', 1, 'Trảng Bàng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(581, NULL, 47, 'b02af288cc48dc4e00a37ca3c8a57558', 0, '1476520268', 1, 'Thủ Dầu Một', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(582, NULL, 47, 'eb5ee0284b2bfb11da6e437017aa2e63', 0, '1476520268', 1, 'Dầu Tiếng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(583, NULL, 47, '0873977fadd56ad4bc8c0a7a059521bc', 0, '1476520268', 1, 'Bến Cát', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(584, NULL, 47, '20b7b24a0d56266f9d92a18907f2d5bd', 0, '1476520268', 1, 'Phú Giáo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(585, NULL, 47, 'c5d3f896ba333774b59291cf8aa5cfa2', 0, '1476520268', 1, 'Tân Uyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(586, NULL, 47, 'c99a38133f680a5501681638fb8eebdf', 0, '1476520268', 1, 'Dĩ An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(587, NULL, 47, 'ceac93efe4a142dd1786e9112fbd60e3', 0, '1476520268', 1, 'Thuận An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(588, NULL, 48, '736cd6ca4daf309b2f5ed28cec3f9a92', 0, '1476520268', 1, 'Biên Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(589, NULL, 48, '27718c8835b5fd261454c2e6a4e68c17', 0, '1476520268', 1, 'Long Khánh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(590, NULL, 48, 'b55c22bc61f9436a80c94b7902fd91a3', 0, '1476520268', 1, 'Tân Phú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(591, NULL, 48, '41e57fad751083d8e98594640a894220', 0, '1476520268', 1, 'Vĩnh Cửu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(592, NULL, 48, '358ba16fb8e3bd20580ff4fc32bcaebc', 0, '1476520268', 1, 'Định Quán', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(593, NULL, 48, 'a8f1738fe110f0404f16ee96ac52a9de', 0, '1476520268', 1, 'Trảng Bom', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(594, NULL, 48, '4997325de760457106e8c06e8d24268f', 0, '1476520268', 1, 'Thống Nhất', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(595, NULL, 48, '31c744ecf4b4cdde955ed69905d95cc3', 0, '1476520268', 1, 'Cẩm Mỹ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(596, NULL, 48, '886d7496e35c020f8d651434fcb0ec63', 0, '1476520268', 1, 'Long Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(597, NULL, 48, 'e11c9b11fa1b745e8205fdde8f74e8d5', 0, '1476520268', 1, 'Xuân Lộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(598, NULL, 48, '8c5cfc4914b4f0be7cabbfc05203dd6e', 0, '1476520268', 1, 'Nhơn Trạch', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(599, NULL, 49, '5b76c56742acafd7daffe331551fdfb9', 0, '1476520268', 1, 'Vũng Tầu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(600, NULL, 49, 'bdb6d395c39fb5fac2ad0f1b17f0b0c1', 0, '1476520268', 1, 'Bà Rịa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(601, NULL, 49, '96c4c77b19e5d43df147244224422c55', 0, '1476520268', 1, 'Châu Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(602, NULL, 49, '4c5b75e3d293259104a2f40e527b71e7', 0, '1476520268', 1, 'Xuyên Mộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(603, NULL, 49, '7832836bd2ec018e05879b30ec6b512d', 0, '1476520268', 1, 'Long Điền', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(604, NULL, 49, '779abf82b9d8ced5e7d1c1379ae11e16', 0, '1476520268', 1, 'Đất Đỏ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(605, NULL, 49, '055ca1cded5e491ba533f807254b790f', 0, '1476520268', 1, 'Tân Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(606, NULL, 49, '84dfba54493ad471b293b6a6d3c6c340', 0, '1476520268', 1, 'Côn Đảo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(607, NULL, 50, 'e62b634af249f476c406b233e47260f6', 0, '1476520268', 1, '1', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(608, NULL, 50, 'ba8db9843a4e2a04ce24e6246be83179', 0, '1476520268', 1, '8', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(609, NULL, 50, '75b9551e126c00615803a7bd0f3e3ab5', 0, '1476520268', 1, 'Thủ Đức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(610, NULL, 50, '3eae11b9b7efa64a9743df4949700577', 0, '1476520268', 1, '9', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(611, NULL, 50, '45970066bc0d91393102950c2db57699', 0, '1476520268', 1, 'Gò Vấp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(612, NULL, 50, 'bd000fd8aa96f25ede8414fefdd28487', 0, '1476520268', 1, 'Bình Thạnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(613, NULL, 50, '18d593a38584c1e4faf1c7803a8c9afc', 0, '1476520268', 1, 'Tân Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(614, NULL, 50, 'e69a1fdd83cba71dcebff323bd641590', 0, '1476520268', 1, 'Tân Phú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(615, NULL, 50, 'e97ca501d670162ad3292c233bfa6091', 0, '1476520268', 1, 'Phú Nhuận', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(616, NULL, 50, 'fcc953d9b83ca9207181f65ad06c013d', 0, '1476520268', 1, '2', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(617, NULL, 50, 'cde69256a051845f4d40e910b74a56ba', 0, '1476520268', 1, '3', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(618, NULL, 50, 'df2d9ffc0e094cdb756b64887b5adca0', 0, '1476520268', 1, '10', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(619, NULL, 50, 'ca32405d0ec598742c04191f7d954922', 0, '1476520268', 1, '11', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(620, NULL, 50, 'b360b84c7fd4bd2af32eb9f104072763', 0, '1476520268', 1, '4', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(621, NULL, 50, 'daf3c5afb241a7446fc8af9e002d622f', 0, '1476520268', 1, '5', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(622, NULL, 50, '55fb4f2c0c6e0fb6400d0b810bd054be', 0, '1476520268', 1, '6', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(623, NULL, 50, '68660009bb451aecb080c3147de0cbc0', 0, '1476520268', 1, '8', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(624, NULL, 50, '6404dfc068fac2295c8ab6a72933779f', 0, '1476520268', 1, 'Bình Tân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(625, NULL, 50, 'd782a5e18872bdd19fb4bb54b555330c', 0, '1476520268', 1, '7', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(626, NULL, 50, '055289c5c8b1a74640645832d0ae1fa3', 0, '1476520268', 1, 'Củ Chi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(627, NULL, 50, 'f0e3533274c2849435f755342afdaeeb', 0, '1476520268', 1, 'Hóc Môn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(628, NULL, 50, '36ebe4e2d9028d43ec8e3e8a316e137e', 0, '1476520268', 1, 'Bình Chánh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(629, NULL, 50, 'e38790820e44192d19c6f1606d98db65', 0, '1476520268', 1, 'Nhà Bè', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(630, NULL, 50, '36ac0c37e943c72aebc310ee20c874ca', 0, '1476520268', 1, 'Cần Giờ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(631, NULL, 51, 'a5a1b152e390b1eaea73a3c8ab6f4dbc', 0, '1476520268', 1, 'Tân An', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(632, NULL, 51, '0bf86ea79762e7186f1fa1c5ab776c5b', 0, '1476520268', 1, 'Tân Hưng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(633, NULL, 51, '66b16e9e46c489e3835e1f34d58b7eab', 0, '1476520268', 1, 'Vĩnh Hưng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(634, NULL, 51, 'c9e3753cd694b860101a6ca233728575', 0, '1476520268', 1, 'Mộc Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(635, NULL, 51, '5ddac1bd01a6b8321165f2a25903897c', 0, '1476520268', 1, 'Tân Thạnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(636, NULL, 51, '5860e0e9ef6f25e1d9985245e85d23a9', 0, '1476520268', 1, 'Thạnh Hóa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(637, NULL, 51, '8a80c02f9ad0c6b342d5972db730ff15', 0, '1476520268', 1, 'Đức Huệ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(638, NULL, 51, '20b579334e4f69fbbe4cb1e5ab2d9e71', 0, '1476520268', 1, 'Đức Hòa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(639, NULL, 51, 'd857d8ad644a59a8507a2eb9abdb97d0', 0, '1476520268', 1, 'Bến Lức', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(640, NULL, 51, 'cf3bd383e1505eb0c987dec40d18a32f', 0, '1476520268', 1, 'Thủ Thừa', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(641, NULL, 51, 'f71eb35e4a8fe548e5213819d8213abf', 0, '1476520268', 1, 'Tân Trụ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(642, NULL, 51, '6db86da56d265f72f8895b7a546b0039', 0, '1476520268', 1, 'Cần Đước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(643, NULL, 51, '66084c6d7c20c48c7df397be48adcd79', 0, '1476520268', 1, 'Cần Giuộc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(644, NULL, 51, '49bb2849eb42dfd6bc3669b3266f3ea8', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(645, NULL, 52, '6fa9a14ae53b33408444ebc1fdd125c1', 0, '1476520268', 1, 'Mỹ Tho', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(646, NULL, 52, 'a1d3259449066992afca84e64e30f7af', 0, '1476520268', 1, 'Gò Công', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(647, NULL, 52, '0d822cbeb42771b668e8f240ec1b6bce', 0, '1476520268', 1, 'Tân Phước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(648, NULL, 52, '23ed024b04430b32d34909644c046cd7', 0, '1476520268', 1, 'Cái Bè', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(649, NULL, 52, '0f9825c6ae4aaeb6626f85df5167cb68', 0, '1476520268', 1, 'Cai Lậy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(650, NULL, 52, '88df632ed94fa40f49c6935fb90e5e2e', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(651, NULL, 52, '91e089bd3fb7eb5dd2102187c60550d0', 0, '1476520268', 1, 'Chợ Gạo', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(652, NULL, 52, '9ce66829373c50769cfa3c7b8dc0b55e', 0, '1476520268', 1, 'Gò Công Tây', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(653, NULL, 52, '7824e70c26a87e5af22b01731cdb4c59', 0, '1476520268', 1, 'Gò Công Đông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(654, NULL, 52, '253973d0755529675ffcc117643214cf', 0, '1476520268', 1, 'Tân Phú Đông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(655, NULL, 53, 'eb1044c522a60261fd676230305a4fba', 0, '1476520268', 1, 'Bến Tre', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(656, NULL, 53, '2284f78aa9843ab6ab668c83ff3293b0', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(657, NULL, 53, '13025ad8cc818b70388b5b52487ac64d', 0, '1476520268', 1, 'Chợ Lách', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(658, NULL, 53, '15aa5cf7d35ea0920798d87b31b7dd3c', 0, '1476520268', 1, 'Mỏ Cày Nam', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(659, NULL, 53, 'e7b0d87b3f6d0bf18c139fae111b91e7', 0, '1476520268', 1, 'Giồng Trôm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(660, NULL, 53, '87eec902ea6be3fcd42f614032420f0d', 0, '1476520268', 1, 'Bình Đại', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(661, NULL, 53, 'eab8b81efee845ac410a6cb1134aacf8', 0, '1476520268', 1, 'Ba Tri', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(662, NULL, 53, 'b2a652d1cae367891b019e36e592a633', 0, '1476520268', 1, 'Thạnh Phú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(663, NULL, 53, 'da24b34f7de13ff9b689f06d5a1e12f7', 0, '1476520268', 1, 'Mỏ Cày Bắc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(664, NULL, 54, '614037fb73d4fd4b39211ce4aec34b75', 0, '1476520268', 1, 'Trà Vinh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(665, NULL, 54, 'be3ee174100a80ed5676b8da43a9b7cf', 0, '1476520268', 1, 'Càng Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(666, NULL, 54, '0c6c8fbe86ded81abd62e8dd4759719a', 0, '1476520268', 1, 'Cầu Kè', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(667, NULL, 54, 'c90c2bb6977b5953628a4fc1a5b9abd3', 0, '1476520268', 1, 'Tiểu Cần', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(668, NULL, 54, 'b60f65c294a2a72cd8f2b81bf4835044', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(669, NULL, 54, 'eba2f416f39db92fa852e6c64c2c030c', 0, '1476520268', 1, 'Cầu Ngang', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(670, NULL, 54, '07772ebc591ac34c68493d1d7b7f5be6', 0, '1476520268', 1, 'Trà Cú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(671, NULL, 54, '27b126c4dbdac1e392f3d6f395dc0f71', 0, '1476520268', 1, 'Duyên Hải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(672, NULL, 55, '4bddf9dd6123b328d601e8eebbb2b328', 0, '1476520268', 1, 'Vĩnh Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(673, NULL, 55, 'fccea7ff0fa19c485315c2f6fef39272', 0, '1476520268', 1, 'Long Hồ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(674, NULL, 55, '6df39d9d16db635f705a17bf3d0cb754', 0, '1476520268', 1, 'Mang Thít', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(675, NULL, 55, '2a11a8fc7984af515cf26c7fd96ee0eb', 0, '1476520268', 1, 'Vũng Liêm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(676, NULL, 55, '17aafbf3e896a75b81919636f27c4822', 0, '1476520268', 1, 'Tam Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(677, NULL, 55, '57685f73376df183ef59860924931d67', 0, '1476520268', 1, 'Bình Minh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(678, NULL, 55, 'c82b7449e83e22f9511895aaa4659e0b', 0, '1476520268', 1, 'Trà Ôn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(679, NULL, 55, '6a39a2d945ffd0796c3adb296e64af39', 0, '1476520268', 1, 'Bình Tân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(680, NULL, 56, 'fda10a38dc96c080cc9c785dcf580ab7', 0, '1476520268', 1, 'Cao Lãnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(681, NULL, 56, '2da15fb014bda09a1f62005df61950f6', 0, '1476520268', 1, 'Sa Đéc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(682, NULL, 56, '0f1c1ff90f33163eeab70e27d1c5946e', 0, '1476520268', 1, 'Hồng Ngự', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(683, NULL, 56, 'efc30e344c6ffda22ac04ca5173f6172', 0, '1476520268', 1, 'Tân Hồng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(684, NULL, 56, 'f543da80f11b2671ef30c93389cbda05', 0, '1476520268', 1, 'Hồng Ngự', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(685, NULL, 56, '7a6806d0741738d8b4e064dad8c2dc90', 0, '1476520268', 1, 'Tam Nông', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(686, NULL, 56, 'cc602977e11bfc50e941afeb64a9db5b', 0, '1476520268', 1, 'Tháp Mười', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(687, NULL, 56, '3b587ba5ce9f9372aa5083b9a4339517', 0, '1476520268', 1, 'Cao Lãnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(688, NULL, 56, 'aab735b1e726c6ad580704093b7c4043', 0, '1476520268', 1, 'Thanh Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(689, NULL, 56, '5244292cfbd0d2c485242aeee5b2eb20', 0, '1476520268', 1, 'Lấp Vò', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(690, NULL, 56, '44f6a400a601192eab704e42a632b4ef', 0, '1476520268', 1, 'Lai Vung', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(691, NULL, 56, '82827bf076b60194ffe235ed8a984294', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(692, NULL, 57, '71521cecafae16d65003dcfd281350e6', 0, '1476520268', 1, 'Long Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(693, NULL, 57, '64b18242f0d735bfe95196fe666bb648', 0, '1476520268', 1, 'Châu Đốc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(694, NULL, 57, '674082a7835a5c2a2427f948d7f22dc3', 0, '1476520268', 1, 'An Phú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(695, NULL, 57, '7573b56290119cd34650493286357329', 0, '1476520268', 1, 'Tân Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(696, NULL, 57, '6a73568213a305c2231e8298cfa7f1e4', 0, '1476520268', 1, 'Phú Tân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(697, NULL, 57, 'df3f136272cb3a5fba424af32e5fa71b', 0, '1476520268', 1, 'Châu Phú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(698, NULL, 57, '0d49fb602d3ffd050b8993a1696c4701', 0, '1476520268', 1, 'Tịnh Biên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(699, NULL, 57, '4ad5088f5cfc90cc8f6837c2ffd8f54d', 0, '1476520268', 1, 'Tri Tôn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(700, NULL, 57, '92a211c1b5fe6f1a02662e598c5a0b1e', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(701, NULL, 57, '49b498916b2f19a395184aabb6acd562', 0, '1476520268', 1, 'Chợ Mới', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(702, NULL, 57, 'd8017330a295472599f2fba11e925b15', 0, '1476520268', 1, 'Thoại Sơn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(703, NULL, 58, 'e573813596d54f65a4eae51ddda69f80', 0, '1476520268', 1, 'Rạch Giá', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(704, NULL, 58, 'b7ceed25a3e8313523e934aea8ef97c2', 0, '1476520268', 1, 'Hà Tiên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(705, NULL, 58, '657116cfdd39825f493e9c4523a0a83f', 0, '1476520268', 1, 'Kiên Lương', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(706, NULL, 58, '413b5a0093d531f92a00c4a585365d6b', 0, '1476520268', 1, 'Hòn Đất', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(707, NULL, 58, 'e9137bb089c3bb8358148c2fc6d92ca5', 0, '1476520268', 1, 'Tân Hiệp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(708, NULL, 58, '918726f07a6e7689b9b7310f0e138eaf', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(709, NULL, 58, '219363fd069e930835499c0793e90122', 0, '1476520268', 1, 'Giồng Giềng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(710, NULL, 58, '04f116cfc46e9f32bd0dee739b2b2f58', 0, '1476520268', 1, 'Gò Quao', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(711, NULL, 58, 'fc6aeabd705b9f7a94478d893b7562b1', 0, '1476520268', 1, 'An Biên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(712, NULL, 58, '234c1f03ac70fe7ef3a91de5fa60bd29', 0, '1476520268', 1, 'An Minh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(713, NULL, 58, 'd33e32c4d65fe1a688bb007f46cb0111', 0, '1476520268', 1, 'Vĩnh Thuận', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(714, NULL, 58, 'c835e22866ba584adf98d3bddb734fac', 0, '1476520268', 1, 'Phú Quốc', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(715, NULL, 58, '5830d1bc525617529a16a9531fff499e', 0, '1476520268', 1, 'Kiên Hải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(716, NULL, 58, '57535aeb7733ed4e4e8b3dd1d170e935', 0, '1476520268', 1, 'U Minh Thượng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(717, NULL, 58, '0cf51a0ae775f2bde974d6c1b01c967d', 0, '1476520268', 1, 'Giang Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(718, NULL, 59, '8d4250dcfbc27a4f3da8d6bce27a1ba2', 0, '1476520268', 1, 'Ninh Kiều', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(719, NULL, 59, '03416edec446762a660cd6ea75040da0', 0, '1476520268', 1, 'Ô Môn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(720, NULL, 59, '8d2981194a57576d6550a729cae16c50', 0, '1476520268', 1, 'Bình Thuỷ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(721, NULL, 59, 'aa8c8e7db0fc9414cb89d78b7795975b', 0, '1476520268', 1, 'Cái Răng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(722, NULL, 59, '751157fda646703befe2db459e11cc1e', 0, '1476520268', 1, 'Thốt Nốt', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(723, NULL, 59, '210cc3c398b412abd1d7d8ba455dc9ab', 0, '1476520268', 1, 'Vĩnh Thạnh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(724, NULL, 59, '09feb28f7389df22e4a76b43f1923e74', 0, '1476520268', 1, 'Cờ Đỏ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(725, NULL, 59, '1f840add64aaec4288856f2da488646c', 0, '1476520268', 1, 'Phong Điền', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(726, NULL, 59, 'ba2ec2f442669b7623b9f8acbb8951f0', 0, '1476520268', 1, 'Thới Lai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(727, NULL, 60, '1a8543ab71a9f05ab56917eb57e62e79', 0, '1476520268', 1, 'Vị Thanh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(728, NULL, 60, '4632d988168b50ae75492301c8d3c399', 0, '1476520268', 1, 'Ngã Bảy', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(729, NULL, 60, '2523556908f88eef869eaec77df596fc', 0, '1476520268', 1, 'Châu Thành A', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(730, NULL, 60, '6225b373faede8ac22a852aa0e92c7b8', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(731, NULL, 60, 'f0e1a8d47bc7fac94291e5aca0dda712', 0, '1476520268', 1, 'Phụng Hiệp', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(732, NULL, 60, 'c3b218e056d1cb6fe73be879c117950f', 0, '1476520268', 1, 'Vị Thuỷ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(733, NULL, 60, '90de7a0c2fa0d45fe238ce8eb19d1a85', 0, '1476520268', 1, 'Long Mỹ', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(734, NULL, 61, '3eac82992100110c85d191d1ae297050', 0, '1476520268', 1, 'Sóc Trăng', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(735, NULL, 61, 'a751886e8dd94320357a2ebc1eafaf7b', 0, '1476520268', 1, 'Châu Thành', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(736, NULL, 61, '75cc2618e0bdeff72a300f5a3b84dc07', 0, '1476520268', 1, 'Kế Sách', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(737, NULL, 61, '53e9158c8d7c7a865d4cc14ee06d2b76', 0, '1476520268', 1, 'Mỹ Tú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(738, NULL, 61, '0a1bbd561a7bc5d65d0ef2cfab1f0637', 0, '1476520268', 1, 'Cù Lao Dung', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(739, NULL, 61, '94287f3d53166329563b16a00e54fb49', 0, '1476520268', 1, 'Long Phú', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(740, NULL, 61, '9efcd17230882f39b4df189375b06288', 0, '1476520268', 1, 'Mỹ Xuyên', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(741, NULL, 61, 'ab0416b55635796ca4e64ec2d02d5d16', 0, '1476520268', 1, 'Ngã Năm', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(742, NULL, 61, '19e2ead56b3a8bd4cd2330375ec020f6', 0, '1476520268', 1, 'Thạnh Trị', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(743, NULL, 61, 'e8b8a66b7292c749840c6daf86324185', 0, '1476520268', 1, 'Vĩnh Châu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(744, NULL, 61, 'fd072d7f307ecafa9acb4f4787f32f8b', 0, '1476520268', 1, 'Trần Đề', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(745, NULL, 62, '3b3feecb39a695cb93ece16a2dff8b6c', 0, '1476520268', 1, 'Bạc Liêu', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(746, NULL, 62, '3f1feb8cff4331dea604a7d710f38e20', 0, '1476520268', 1, 'Hồng Dân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(747, NULL, 62, '51fc6b26390172260a16ea1429240642', 0, '1476520268', 1, 'Phước Long', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(748, NULL, 62, '0bed950bb479ceaa19916df5bfa94449', 0, '1476520268', 1, 'Vĩnh Lợi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(749, NULL, 62, '9e020a1daa998da972660896d1bb6e24', 0, '1476520268', 1, 'Giá Rai', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(750, NULL, 62, 'f12061f86044bba6d2faa8d41c342d29', 0, '1476520268', 1, 'Đông Hải', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(751, NULL, 62, 'f1a327d83706161b60c4951b9f702811', 0, '1476520268', 1, 'Hoà Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(752, NULL, 63, '280b22b17c01fa97ff5bc53a60445614', 0, '1476520268', 1, 'Cà Mau', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(753, NULL, 63, '59f452b096bf1bccca3e40cc71143632', 0, '1476520268', 1, 'U Minh', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(754, NULL, 63, '18e749e3501bc244516aee814b224807', 0, '1476520268', 1, 'Thới Bình', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(755, NULL, 63, '6d7d0236d96d571ad58f22619b41f4ba', 0, '1476520268', 1, 'Trần Văn Thời', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(756, NULL, 63, 'ce62db3760c995c6e7576f0221e6f870', 0, '1476520268', 1, 'Cái Nước', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(757, NULL, 63, '96a43db85901567aafce200a5afb76c9', 0, '1476520268', 1, 'Đầm Dơi', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(758, NULL, 63, 'b69861431259cb4855240ac811dedd9a', 0, '1476520268', 1, 'Năm Căn', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(759, NULL, 63, '8f878574e7cb0d8ca0c254f16cf8ec86', 0, '1476520268', 1, 'Phú Tân', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(760, NULL, 63, 'a3eb75453db7d48bc77bc81093930b7e', 0, '1476520268', 0, 'Ngọc Hiển', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7),
(761, NULL, 0, '312217770aa01d30caf102f2ae8b4a7a', 0, '1477322222', 1, '1', NULL, NULL, NULL, 0, 0, NULL, 'area', NULL, 7);

-- --------------------------------------------------------

--
-- 表的结构 `tp_cai_wu`
--

CREATE TABLE `tp_cai_wu` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `yy_id` varchar(120) DEFAULT NULL,
  `price_show` text,
  `total` bigint(20) UNSIGNED DEFAULT NULL,
  `youhui_total` bigint(20) UNSIGNED DEFAULT NULL,
  `yingshou_price` bigint(20) UNSIGNED DEFAULT NULL,
  `youhui_code` varchar(255) DEFAULT NULL,
  `youhui_price` varchar(120) DEFAULT NULL,
  `shishou_xjprice` varchar(120) DEFAULT NULL,
  `shishou_skprice` varchar(120) DEFAULT NULL,
  `shishou_otprice` varchar(120) DEFAULT NULL,
  `kaidan_id` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_card`
--

CREATE TABLE `tp_card` (
  `id` bigint(20) NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `xf_id` varchar(120) DEFAULT NULL,
  `kd_id` varchar(120) DEFAULT NULL,
  `yy_id` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `code` varchar(255) DEFAULT NULL,
  `code_pwd` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `price` varchar(120) DEFAULT NULL,
  `type` varchar(120) DEFAULT NULL,
  `ftime` varchar(120) DEFAULT NULL,
  `ltime` varchar(120) DEFAULT NULL,
  `utime` varchar(120) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_card`
--

INSERT INTO `tp_card` (`id`, `uuid`, `xf_id`, `kd_id`, `yy_id`, `checked`, `code`, `code_pwd`, `ctime`, `admin_id`, `user_id`, `price`, `type`, `ftime`, `ltime`, `utime`, `status`) VALUES
(7, '87ee86c07497266cd581f337903c63b5', NULL, NULL, NULL, 1, '1000007114', '903663496', '1478619028', '7', '2', '1000', NULL, NULL, '1478620800', '1478619043', NULL),
(8, 'a77704f5a6943b1e3d1f4748c3877a19', NULL, NULL, NULL, 1, '1000011388', '1206929141', '1478619028', '7', '2', '1000', NULL, NULL, '1478620800', '1478645232', NULL),
(9, 'a26f74c09d419960ec0abc163fb173c7', NULL, NULL, NULL, 1, '1000019508', '96147832', '1478645287', '7', '2', '77', NULL, NULL, '1478880000', '1478645299', NULL),
(10, 'f2f16f2e0a37a5e3ab72fb0ce8911c20', NULL, '2', NULL, 1, '1000029182', '733459454', '1478645287', '7', '2', '77', NULL, '1478647616', '1478880000', '1478647701', NULL),
(11, 'd67091ea2555af8893a6464125c762b4', NULL, NULL, NULL, 1, '1000035462', '299608878', '1478645287', '7', '2', '77', NULL, '1478712346', '1478880000', NULL, NULL),
(12, '9ded776383b1bfb37d5c63adf2889a6b', NULL, NULL, NULL, 1, '1000046979', '1347940579', '1478645287', '7', '7', '77', NULL, '1478715464', '1478880000', NULL, NULL),
(13, '6ad7f7548ccd9b8ecba4763d2854d3fb', NULL, NULL, NULL, 1, '1000054726', '1232481536', '1478645287', '7', '1', '77', NULL, '1478821221', '1478880000', NULL, NULL),
(14, '9ad68745cee4081962030a12247b0024', NULL, NULL, NULL, 1, '1000060151', '142683034', '1478645287', '7', NULL, '77', NULL, NULL, '1478880000', NULL, NULL),
(15, 'ed743a47de6d49fc57681984568638d7', NULL, NULL, NULL, 1, '1000064459', '603893514', '1478821404', '7', '1', '600', NULL, '1478821410', '1480435200', NULL, 0),
(16, '286548149a50d65f84e024b80a83d9d4', NULL, NULL, NULL, 1, '1000072811', '870399563', '1478821404', '7', NULL, '600', NULL, NULL, '1480435200', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_file`
--

CREATE TABLE `tp_file` (
  `id` int(11) NOT NULL,
  `uuid` varchar(120) NOT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(250) DEFAULT 'image',
  `url` text,
  `aburl` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_file`
--

INSERT INTO `tp_file` (`id`, `uuid`, `ctime`, `sort`, `name`, `type`, `url`, `aburl`) VALUES
(1, 'f5470b21b2b33c77473e61a8f6398880', '1476514463', 0, '147651446323.jpg', 'images', '/upload/images/147651446323.jpg', 'F:/server/yiyuan//upload/images/147651446323.jpg'),
(2, '0484f98d4bf1856d74e5490b7bd5d5cc', '1476514507', 0, '1476514507200.xls', 'file', '/upload/images/1476514507200.xls', 'F:/server/yiyuan//upload/images/1476514507200.xls'),
(3, '549ce30db6eec84197cbae5c8f8291e0', '1476514996', 0, '1476514996105.xls', 'file', '/upload/images/1476514996105.xls', 'F:/server/yiyuan//upload/images/1476514996105.xls'),
(4, '3d97c87dcf4933415e3b62b1f6b1d533', '1476515109', 0, '147651510941.xls', 'file', '/upload/file/147651510941.xls', 'F:/server/yiyuan//upload/file/147651510941.xls'),
(5, 'c8866aa7476262e6066d97bf2ed84c69', '1476515858', 0, '1476515858231.xlsx', 'file', '/upload/file/1476515858231.xlsx', 'F:/server/yiyuan//upload/file/1476515858231.xlsx'),
(6, 'bac04768d0f06c03cd4518e4f3268ada', '1476517973', 0, '1476517973142.xlsx', 'file', '/upload/file/1476517973142.xlsx', 'F:/server/yiyuan//upload/file/1476517973142.xlsx'),
(7, 'beedc4e7d3d8dfefb6363018cfa440eb', '1476519977', 0, '1476519977120.xlsx', 'file', '/upload/file/1476519977120.xlsx', 'F:/server/yiyuan//upload/file/1476519977120.xlsx'),
(8, 'd59774e3098ed0380495235a7845befc', '1476520264', 0, '14765202647.xlsx', 'file', '/upload/file/14765202647.xlsx', 'F:/server/yiyuan//upload/file/14765202647.xlsx'),
(9, '20e440c8559e76af215ade0778b85539', '1476541257', 0, '1476541257289.xlsx', 'file', '/upload/file/1476541257289.xlsx', 'F:/server/yiyuan//upload/file/1476541257289.xlsx'),
(10, '226d287d71bb2e1c2085eb607c1dc6fb', '1476542369', 0, '1476542369197.xlsx', 'file', '/upload/file/1476542369197.xlsx', 'F:/server/yiyuan//upload/file/1476542369197.xlsx'),
(11, '7cbd660bfa356c8b7b49662add5b109a', '1476859527', 0, '1476859527249.jpg', 'images', '/upload/images/1476859527249.jpg', 'E:/website/ertongjie//upload/images/1476859527249.jpg'),
(12, 'eecfa850f8912fdd353df504873aea12', '1476859528', 0, '147685952778.png', 'images', '/upload/images/147685952778.png', 'E:/website/ertongjie//upload/images/147685952778.png'),
(13, 'd06d5c5f87fa0c6aa688591ee7266eb6', '1476867720', 0, '1476867719131.png', 'images', '/upload/images/1476867719131.png', '/alidata/www/crm//upload/images/1476867719131.png'),
(14, '8a72b52d71a3c9fd13d7f8ddbbe7251c', '1476963998', 0, '1476963997115.png', 'images', '/upload/images/1476963997115.png', 'F:/server/yiyuan//upload/images/1476963997115.png'),
(15, '7a89cb8574f23b14f1db2118575ab845', '1476978557', 0, '1476978557281.jpg', 'images', '/upload/images/1476978557281.jpg', 'F:/server/yiyuan//upload/images/1476978557281.jpg'),
(16, 'e3d0e95a03e3b6ccc8a21e23ccfc945b', '1476988776', 0, '1476988776159.png', 'images', '/upload/images/1476988776159.png', 'F:/server/yiyuan//upload/images/1476988776159.png'),
(17, 'a065980a3e0b9c2b26ebc2927182ffff', '1477043247', 0, '147704324729.jpg', 'images', '/upload/images/147704324729.jpg', 'F:/server/yiyuan//upload/images/147704324729.jpg'),
(18, 'a6b592cae4d3b584f725a42bcc453bcd', '1477057514', 0, '1477057514172.jpg', 'images', '/upload/images/1477057514172.jpg', 'F:/server/yiyuan//upload/images/1477057514172.jpg'),
(19, 'c0f5152ca0d779d5abaac9b3c90021b2', '1477057514', 0, '1477057514107.jpg', 'images', '/upload/images/1477057514107.jpg', 'F:/server/yiyuan//upload/images/1477057514107.jpg'),
(20, '3afb0b545059bdc2c49f523ce8df1d7d', '1477062810', 0, '1477062810246.xlsx', 'file', '/upload/file/1477062810246.xlsx', 'F:/server/yiyuan//upload/file/1477062810246.xlsx'),
(21, 'ee55653e75f0921be8c7cc9a83ee2645', '1477063230', 0, '1477063229219.xlsx', 'file', '/upload/file/1477063229219.xlsx', 'F:/server/yiyuan//upload/file/1477063229219.xlsx'),
(22, '9c96225d60b17993b2eb15211ec5a54b', '1477074148', 0, '147707414822.xlsx', 'file', '/upload/file/147707414822.xlsx', 'F:/server/yiyuan//upload/file/147707414822.xlsx'),
(23, '822837cdf8ea694657e3912afe065ff3', '1477074408', 0, '147707440896.xlsx', 'file', '/upload/file/147707440896.xlsx', 'F:/server/yiyuan//upload/file/147707440896.xlsx'),
(24, 'ee7c70b8f3054f95fe19642d32db50da', '1477074555', 0, '147707455570.xlsx', 'file', '/upload/file/147707455570.xlsx', 'F:/server/yiyuan//upload/file/147707455570.xlsx'),
(25, 'a2c76ad6f5284361de136d5901f5bbe2', '1477193903', 0, '1477193903293.jpg', 'images', '/upload/images/1477193903293.jpg', 'F:/server/yiyuan//upload/images/1477193903293.jpg'),
(26, '35b5de3dbc994cac27965bf656a66c19', '1477197600', 0, '1477197600122.jpg', 'images', '/upload/images/1477197600122.jpg', 'F:/server/yiyuan//upload/images/1477197600122.jpg'),
(27, '1e483bc67df4b5b6a16504579c747782', '1477197600', 0, '1477197600254.jpg', 'images', '/upload/images/1477197600254.jpg', 'F:/server/yiyuan//upload/images/1477197600254.jpg'),
(28, '858c43de0b642aa9f1fe5b61ae5923c0', '1477197600', 0, '1477197600154.jpg', 'images', '/upload/images/1477197600154.jpg', 'F:/server/yiyuan//upload/images/1477197600154.jpg'),
(29, '7ba2292b4a286c409362bda92762c52d', '1477323538', 0, '1477323538282.xlsx', 'file', '/upload/file/1477323538282.xlsx', 'F:/server/yiyuan//upload/file/1477323538282.xlsx'),
(30, '1a39987cc73aba61bd702201c0ac2346', '1477323578', 0, '1477323578186.xlsx', 'file', '/upload/file/1477323578186.xlsx', 'F:/server/yiyuan//upload/file/1477323578186.xlsx'),
(31, '648aa1785e8da313e0359afc0ddfb47e', '1477323715', 0, '1477323715223.xlsx', 'file', '/upload/file/1477323715223.xlsx', 'F:/server/yiyuan//upload/file/1477323715223.xlsx'),
(32, '71850573840cc9a621eefdbcb2ff16a1', '1477324343', 0, '1477324343176.xlsx', 'file', '/upload/file/1477324343176.xlsx', 'F:/server/yiyuan//upload/file/1477324343176.xlsx'),
(33, '50fe04ecc1191b7724ed82115fffb381', '1478281471', 0, '1478281471248.jpg', 'images', '/upload/images/1478281471248.jpg', 'F:/server/yiyuan//upload/images/1478281471248.jpg'),
(34, '50b457a9466f37e631c386b34ff000f2', '1478281471', 0, '1478281471142.jpg', 'images', '/upload/images/1478281471142.jpg', 'F:/server/yiyuan//upload/images/1478281471142.jpg'),
(35, 'd4ae2733b2d63cda69d75c1af9fe6ad9', '1478281532', 0, '1478281532207.jpg', 'images', '/upload/images/1478281532207.jpg', 'F:/server/yiyuan//upload/images/1478281532207.jpg'),
(36, 'bf6cebb69007e32ca76977d01adafb3a', '1478281533', 0, '1478281532201.jpg', 'images', '/upload/images/1478281532201.jpg', 'F:/server/yiyuan//upload/images/1478281532201.jpg'),
(37, '8ea38f5c580d410933d063f76cf18cde', '1478282635', 0, '1478282634271.jpg', 'images', '/upload/images/1478282634271.jpg', 'F:/server/yiyuan//upload/images/1478282634271.jpg'),
(38, '401acdfefa8b05b0ef3a66835e35189f', '1478282635', 0, '147828263540.jpg', 'images', '/upload/images/147828263540.jpg', 'F:/server/yiyuan//upload/images/147828263540.jpg'),
(39, 'c0f469a5e86c00761efa62bae02f9d83', '1478287697', 0, '147828769747.jpg', 'images', '/upload/images/147828769747.jpg', 'F:/server/yiyuan//upload/images/147828769747.jpg'),
(40, '76d49be8e98a83f2099a7cccda77971c', '1478287698', 0, '1478287697124.jpg', 'images', '/upload/images/1478287697124.jpg', 'F:/server/yiyuan//upload/images/1478287697124.jpg'),
(41, 'dc74f1dc72a665002349cee83b462855', '1478310150', 0, '1478310150111.jpg', 'images', '/upload/images/1478310150111.jpg', 'F:/server/yiyuan//upload/images/1478310150111.jpg'),
(42, 'aeb8791acdb4d7c9e81932e3ffd536ff', '1478327829', 0, '147832782910.gif', 'images', '/upload/images/147832782910.gif', 'F:/server/yiyuan//upload/images/147832782910.gif'),
(43, 'bdb2f9162223090073bfdd30f5157a83', '1478327830', 0, '1478327829187.png', 'images', '/upload/images/1478327829187.png', 'F:/server/yiyuan//upload/images/1478327829187.png'),
(44, 'ba0eaea167be2ef2a624c68135bbc3af', '1478327874', 0, '1478327874279.jpg', 'images', '/upload/images/1478327874279.jpg', 'F:/server/yiyuan//upload/images/1478327874279.jpg'),
(45, '368cf42e30d2b7b627f470b6395ceff3', '1478327931', 0, '1478327931115.jpg', 'images', '/upload/images/1478327931115.jpg', 'F:/server/yiyuan//upload/images/1478327931115.jpg'),
(46, '3ee49a67bfa9907666130a59ae24111b', '1478327932', 0, '1478327931132.png', 'images', '/upload/images/1478327931132.png', 'F:/server/yiyuan//upload/images/1478327931132.png'),
(47, 'bc1da616e3dabc1617dd0552339779c3', '1478327932', 0, '147832793239.png', 'images', '/upload/images/147832793239.png', 'F:/server/yiyuan//upload/images/147832793239.png'),
(48, 'e79e23bf2d52443a91b311927128cd63', '1478327934', 0, '1478327932167.png', 'images', '/upload/images/1478327932167.png', 'F:/server/yiyuan//upload/images/1478327932167.png'),
(49, '18ffba45b43a4109ed6724cbb364e540', '1478330194', 0, '147833019485.png', 'images', '/upload/images/147833019485.png', 'F:/server/yiyuan//upload/images/147833019485.png'),
(50, '774cae88781941aad72ac87a4f799a1b', '1478330223', 0, '147833022373.jpg', 'images', '/upload/images/147833022373.jpg', 'F:/server/yiyuan//upload/images/147833022373.jpg'),
(51, '4d87aae123fc0a440fcc01921619897a', '1478424033', 0, '1478424033139.png', 'images', '/upload/images/1478424033139.png', 'F:/server/yiyuan//upload/images/1478424033139.png'),
(52, '2f9942300043a42ddf9de41057d1ad49', '1478453302', 0, '147845330277.xlsx', 'file', '/upload/file/147845330277.xlsx', 'F:/server/yiyuan//upload/file/147845330277.xlsx'),
(53, '9748698264be3d0f208c8de8f17937cc', '1478456528', 0, '1478456528216.xlsx', 'file', '/upload/file/1478456528216.xlsx', 'F:/server/yiyuan//upload/file/1478456528216.xlsx');

-- --------------------------------------------------------

--
-- 表的结构 `tp_gzl`
--

CREATE TABLE `tp_gzl` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `ctime` varchar(200) DEFAULT NULL,
  `duihualiang` int(10) UNSIGNED DEFAULT NULL,
  `aduihua` int(10) UNSIGNED DEFAULT NULL,
  `bduihua` int(10) UNSIGNED DEFAULT NULL,
  `cduihua` int(10) UNSIGNED DEFAULT NULL,
  `dduihua` int(10) UNSIGNED DEFAULT NULL,
  `gj_id` int(10) UNSIGNED DEFAULT NULL,
  `zixunliang` int(10) UNSIGNED DEFAULT NULL,
  `cdate` varchar(120) DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_gzl`
--

INSERT INTO `tp_gzl` (`id`, `uuid`, `ctime`, `duihualiang`, `aduihua`, `bduihua`, `cduihua`, `dduihua`, `gj_id`, `zixunliang`, `cdate`, `admin_id`) VALUES
(1, '6a307ac045fb03e1a66805bec7ad26b5', '1477053274', NULL, 33, 5, 4, NULL, 12, NULL, '1476979200', 7),
(2, 'c8202f4f7b96a3ff7bf6237dce3f6939', '1477053291', NULL, 21, 3, 4, NULL, 12, NULL, '1477152000', 17),
(3, 'fadbb696f36fa37c73805ff06d094b25', '1478043507', NULL, 4, 5, 6, NULL, 11, NULL, '1162396800', 8),
(4, 'b845c4de9993dbb3c5ae534d95aa5f58', '1478043528', NULL, 10, 10, 10, NULL, 12, NULL, '1478016000', 8),
(5, '484f6dd57944893b204c908429171fd2', '1478043553', NULL, 10, 10, 10, NULL, 13, NULL, '1478016000', 8),
(6, '7147b16388b44c4c35761bacedb07709', '1478044561', NULL, 60, 45, 69, 99, 11, NULL, '1478275200', 7),
(7, '2f23d1465541366531088527571d6d3a', '1478165443', NULL, 0, 10, 40, 4, 12, NULL, '1478102400', 7),
(8, '1b164faf34f2b4180d069d582b0ae4b9', '1478165604', NULL, 1, 2, 4, 4, 12, NULL, '1477929600', 7),
(9, 'a658f801720c1f71c58215e49820d374', '1478166181', NULL, 3, 1, 10, 10, 12, NULL, '1478102400', 7),
(10, '168055a35e8b57020f8e5632a0dc283c', '1478166203', NULL, 3, 1, 10, 15, 13, NULL, '1478102400', 7),
(11, 'f7841a883c50d1d9421df11f73141100', '1478166224', NULL, 3, 1, 4, 3, 12, NULL, '1478102400', 7),
(13, '003a93cf008406c8959fe159cc8e601f', '1478947446', NULL, 1, 0, 10, 10, 11, NULL, '1478880000', 8),
(14, '775ebdd2d2f5e9fa67529669f7a59f26', '1478950173', NULL, 0, 0, 10, 0, 13, NULL, '1478880000', 7),
(15, '5ee8bee932974b3358e2f9a0e031609f', '1478950230', NULL, 1, 1, 0, 0, 12, NULL, '1478880000', 8),
(16, '5f48f778b5fdbe809d037f30b62f8260', '1478950605', NULL, 0, 0, 10, 0, 13, NULL, '1476201600', 8),
(17, 'af71a3ac8a3ab1008e437272a2766d8f', '1478950626', NULL, 0, 0, 20, 2, 14, NULL, '1475596800', 7),
(18, '8e14d591b289ff72ce29c63d2a32cb25', '1478972756', NULL, 3, 0, 4, 5, 11, NULL, '1478966400', 8),
(19, '37b084bd67680590654a814aec68686f', '1478972778', NULL, 3, 0, 34, 4, 11, NULL, '1478966400', 8);

-- --------------------------------------------------------

--
-- 表的结构 `tp_hui_fang`
--

CREATE TABLE `tp_hui_fang` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `sort` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `renwu_id` varchar(120) DEFAULT NULL,
  `name` text,
  `type` varchar(255) DEFAULT NULL,
  `ways` varchar(255) DEFAULT NULL,
  `result_cont` text,
  `status` tinyint(1) DEFAULT NULL,
  `goplace` varchar(255) DEFAULT NULL,
  `ntime` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `admin_id` tinyint(11) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_hui_fang`
--

INSERT INTO `tp_hui_fang` (`id`, `uuid`, `sort`, `user_id`, `renwu_id`, `name`, `type`, `ways`, `result_cont`, `status`, `goplace`, `ntime`, `ctime`, `admin_id`, `content`) VALUES
(1, '8a90415f05de63332378dc0d18633385', NULL, 11, '', '确定预约时间', '44', '36', '127', 1, '61', '1480010745', '1480010745', 7, '&lt;p&gt;dfdsff&lt;/p&gt;'),
(2, '43386fdea28e3f265afcf90d31cfb968', NULL, 11, '', '去电详细咨询沟通', '44', '36', '127', 1, '61', '1480010894', '1480010894', 7, '');

-- --------------------------------------------------------

--
-- 表的结构 `tp_jie_zhen`
--

CREATE TABLE `tp_jie_zhen` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT NULL,
  `yy_id` varchar(120) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `jztime` varchar(120) DEFAULT NULL,
  `jzedtime` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `jz_content` text COMMENT '小结',
  `jz_smcontent` text,
  `edit_content` text,
  `thumbs` text COMMENT '图片',
  `zl_id` varchar(120) DEFAULT NULL,
  `ks_id` varchar(120) DEFAULT NULL,
  `kst_id` varchar(120) DEFAULT NULL,
  `kstt_id` varchar(120) DEFAULT NULL,
  `jzks_id` varchar(120) DEFAULT NULL,
  `ysz_id` varchar(120) DEFAULT NULL,
  `ys_id` varchar(120) DEFAULT NULL,
  `kd_total` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_jie_zhen`
--

INSERT INTO `tp_jie_zhen` (`id`, `uuid`, `sort`, `checked`, `yy_id`, `user_id`, `admin_id`, `jztime`, `jzedtime`, `ctime`, `jz_content`, `jz_smcontent`, `edit_content`, `thumbs`, `zl_id`, `ks_id`, `kst_id`, `kstt_id`, `jzks_id`, `ysz_id`, `ys_id`, `kd_total`) VALUES
(2, 'fb73225fb91342118f6b024ad305c96b', NULL, 1, '1', '1', '7', '1479912500', NULL, '1479912500', '', '瓜子脸', NULL, '[]', '15', '1', '4', '12', NULL, '22', '24', 4),
(4, 'abedc9243aad9d598ef110471c16cba1', NULL, 1, '2', '2', '7', '1479983676', NULL, '1479983676', '&lt;p&gt;klkkkl;;k&lt;/p&gt;', '瓜子脸', NULL, '[]', '15', '1', '4', '12', NULL, '21', '17', 9),
(5, 'ad48b903c8759568fd871a5decbf7143', NULL, 1, '3', '3', '7', '1479999390', NULL, '1479999390', '', '瓜子脸', NULL, '[]', '15', '1', '4', '12', NULL, '23', '17', 4),
(6, 'de61f79a23016ec27d5a419a935cc73c', NULL, 1, '10', '11', '7', '1480009775', NULL, '1480009775', '', '假体隆胸', NULL, '[]', '16', '1', '5', '14', NULL, '21', '17', 2);

-- --------------------------------------------------------

--
-- 表的结构 `tp_ji_gou`
--

CREATE TABLE `tp_ji_gou` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `ly_id` varchar(120) NOT NULL,
  `pj_id` varchar(120) DEFAULT NULL,
  `area_id` varchar(120) DEFAULT NULL,
  `areat_id` varchar(120) DEFAULT NULL,
  `address` text,
  `funame` varchar(255) DEFAULT NULL,
  `futel` varchar(255) DEFAULT NULL,
  `ywname` varchar(255) DEFAULT NULL,
  `thumbs` text,
  `content` text,
  `buname` varchar(255) DEFAULT NULL,
  `quyue_time` varchar(120) DEFAULT NULL,
  `hetong` varchar(255) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `join_id` varchar(120) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT NULL,
  `mark` text,
  `code` varchar(120) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_kai_dan`
--

CREATE TABLE `tp_kai_dan` (
  `id` int(10) UNSIGNED NOT NULL,
  `kd_number` varchar(120) DEFAULT NULL COMMENT '开单号',
  `kd_id_sort` int(11) DEFAULT '1' COMMENT '开单自增自减',
  `uuid` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `yy_id` varchar(120) DEFAULT NULL COMMENT '预约id',
  `jz_id` varchar(120) DEFAULT NULL COMMENT '接诊id',
  `ysz_id` varchar(120) DEFAULT NULL,
  `price_show` text,
  `price_type` text COMMENT '价格科室类别信息',
  `price_total` bigint(30) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `sf_admin_id` varchar(120) DEFAULT NULL COMMENT '收费员id',
  `sf_status` tinyint(4) DEFAULT '0' COMMENT '收费状态',
  `js_status` tinyint(4) DEFAULT '0' COMMENT '结算状态',
  `pay_ways` tinyint(4) DEFAULT NULL COMMENT '付款类型',
  `sf_time` varchar(120) DEFAULT NULL,
  `js_time` varchar(120) DEFAULT NULL,
  `ys_id` varchar(120) DEFAULT NULL COMMENT '接诊医生ID',
  `kd_time` varchar(120) DEFAULT NULL COMMENT '开单时间',
  `kdys_id` varchar(120) DEFAULT NULL COMMENT '开单医生id',
  `kd_kstid` varchar(120) DEFAULT NULL COMMENT '开单医生科室id',
  `yf_money` varchar(120) DEFAULT NULL COMMENT '预付金额',
  `bq_money` varchar(120) DEFAULT NULL COMMENT '补齐金额',
  `edit_admin_id` varchar(120) DEFAULT NULL COMMENT '修改者ID',
  `edit_time` varchar(120) DEFAULT NULL COMMENT '修改时间',
  `youhui_code` varchar(120) DEFAULT NULL COMMENT '优惠码',
  `youhui_price` varchar(120) DEFAULT NULL COMMENT '优惠价格',
  `youhui_id` varchar(120) DEFAULT NULL,
  `shuaka_price` varchar(120) DEFAULT NULL,
  `other_price` varchar(120) DEFAULT NULL,
  `cash_price` bigint(20) UNSIGNED DEFAULT NULL,
  `pay_price` bigint(20) UNSIGNED DEFAULT NULL,
  `true_price` bigint(20) DEFAULT NULL,
  `price_zhekou` varchar(20) DEFAULT NULL COMMENT '折扣比例',
  `price_oktotal` bigint(20) DEFAULT NULL,
  `pay_mehtod` varchar(120) DEFAULT NULL COMMENT '付款方式'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_kai_dan`
--

INSERT INTO `tp_kai_dan` (`id`, `kd_number`, `kd_id_sort`, `uuid`, `ctime`, `sort`, `user_id`, `yy_id`, `jz_id`, `ysz_id`, `price_show`, `price_type`, `price_total`, `admin_id`, `sf_admin_id`, `sf_status`, `js_status`, `pay_ways`, `sf_time`, `js_time`, `ys_id`, `kd_time`, `kdys_id`, `kd_kstid`, `yf_money`, `bq_money`, `edit_admin_id`, `edit_time`, `youhui_code`, `youhui_price`, `youhui_id`, `shuaka_price`, `other_price`, `cash_price`, `pay_price`, `true_price`, `price_zhekou`, `price_oktotal`, `pay_mehtod`) VALUES
(13, 'WL120001-1', 1, '9dfeb7d633af063ef91b818e6eb67fa7', '1479985779', NULL, '2', '2', '4', '21', '[{&quot;title&quot;:&quot;%E9%A2%9D%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;21&quot;},{&quot;title&quot;:&quot;%E4%BA%8C%E6%81%B6%E7%83%B7&quot;,&quot;title2&quot;:&quot;4454&quot;,&quot;price&quot;:12,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:12,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;20&quot;},{&quot;title&quot;:&quot;%E5%90%8C%E6%A0%B7%E5%AE%B9%E6%98%93&quot;,&quot;title2&quot;:&quot;tertiary&quot;,&quot;price&quot;:500,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:500,&quot;danwei&quot;:&quot;10&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;19&quot;}]', '[{"fid":90,"total":530}]', 530, '7', NULL, 0, 0, 1, NULL, NULL, '17', '1479985771', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 530, NULL, '', 530, NULL),
(14, 'WL120001-2', 2, '889460d5a7e1bcfd4a419ffeb5f56cfb', '1479986279', NULL, '2', '2', '4', '21', '[{&quot;title&quot;:&quot;44&quot;,&quot;title2&quot;:&quot;55&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;6&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;32&quot;},{&quot;title&quot;:&quot;%E9%A2%9Dfgg%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;89&quot;,&quot;xfname&quot;:&quot;手术费&quot;,&quot;id&quot;:&quot;29&quot;},{&quot;title&quot;:&quot;uuic&quot;,&quot;title2&quot;:&quot;4454&quot;,&quot;price&quot;:12,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:12,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;28&quot;}]', '[{"fid":88,"total":0},{"fid":89,"total":18},{"fid":90,"total":12}]', 30, '7', '7', 1, 0, 1, '1480005076', NULL, '17', '1479986272', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 30, 30, 30, '', 30, '1'),
(15, '120002-1', 1, '3f7d7580401ed67511ec9002f10f3a36', '1479999482', NULL, '3', '3', '5', '23', '[{&quot;title&quot;:&quot;44&quot;,&quot;title2&quot;:&quot;55&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;6&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;32&quot;},{&quot;title&quot;:&quot;%E9%A2%9Dfgg%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;89&quot;,&quot;xfname&quot;:&quot;手术费&quot;,&quot;id&quot;:&quot;29&quot;},{&quot;title&quot;:&quot;uuic&quot;,&quot;title2&quot;:&quot;4454&quot;,&quot;price&quot;:12,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:12,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;28&quot;}]', '[{"fid":88,"total":0},{"fid":89,"total":18},{"fid":90,"total":12}]', 30, '7', '7', 1, 0, 1, '1480004483', NULL, '17', '1479999473', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 27, 27, 27, '10', 27, '1'),
(19, '120002-2', 2, 'b74db074882ab2d98ada3b8f1ac1be63', '1480006899', NULL, '3', '3', '5', '23', '[{&quot;title&quot;:&quot;pp&quot;,&quot;title2&quot;:&quot;56&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;66q&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;22&quot;},{&quot;title&quot;:&quot;%E9%A2%9D%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;21&quot;},{&quot;title&quot;:&quot;%E4%BA%8C%E6%81%B6%E7%83%B7&quot;,&quot;title2&quot;:&quot;4454&quot;,&quot;price&quot;:12,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:12,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;20&quot;}]', '[{"fid":88,"total":0},{"fid":90,"total":30}]', 30, '7', '7', 1, 0, 1, '1480006889', NULL, '17', '1480006889', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 30, 30, 30, NULL, 30, NULL),
(20, '120002-2', 2, 'fa412c737f2ea182a90f064f2466ca25', '1480007498', NULL, '3', '3', '5', '23', '[{&quot;title&quot;:&quot;%E4%BA%8C%E6%81%B6%E7%83%B7&quot;,&quot;title2&quot;:&quot;4454&quot;,&quot;price&quot;:12,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:12,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;20&quot;},{&quot;title&quot;:&quot;%E5%90%8C%E6%A0%B7%E5%AE%B9%E6%98%93&quot;,&quot;title2&quot;:&quot;tertiary&quot;,&quot;price&quot;:500,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:500,&quot;danwei&quot;:&quot;10&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;19&quot;}]', '[{"fid":90,"total":512}]', 512, '7', '7', 1, 0, 1, '1480007487', NULL, '17', '1480007487', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 512, 512, 512, NULL, 512, NULL),
(21, '120002-2', 2, '60cd5ad2124cd0f381cb9915c923690f', '1480007722', NULL, '3', '3', '5', '23', '[{&quot;title&quot;:&quot;pp&quot;,&quot;title2&quot;:&quot;56&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;66q&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;22&quot;},{&quot;title&quot;:&quot;%E9%A2%9D%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;21&quot;}]', '[{"fid":88,"total":0},{"fid":90,"total":18}]', 18, '7', NULL, 0, 0, 1, NULL, NULL, '17', '1480007716', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '80', 4, NULL),
(22, 'WL120001-2', 2, '7e2638cc53fc9bf04ec1542b6451ef62', '1480007786', NULL, '2', '2', '4', '21', '[{&quot;title&quot;:&quot;333&quot;,&quot;title2&quot;:&quot;22&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;44&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;24&quot;},{&quot;title&quot;:&quot;444&quot;,&quot;title2&quot;:&quot;5&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;6&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;33&quot;},{&quot;title&quot;:&quot;ii&quot;,&quot;title2&quot;:&quot;op&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;p&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;23&quot;},{&quot;title&quot;:&quot;%E9%A2%9Dfgg%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;89&quot;,&quot;xfname&quot;:&quot;手术费&quot;,&quot;id&quot;:&quot;29&quot;}]', '[{"fid":88,"total":0},{"fid":89,"total":18}]', 18, '7', '7', 1, 0, 1, '1480007773', NULL, '17', '1480007773', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 18, 18, 18, NULL, 18, NULL),
(23, 'WL120001-2', 2, 'ac112a99e0394d0771e6a6498030891a', '1480007833', NULL, '2', '2', '4', '21', '[{&quot;title&quot;:&quot;%E5%90%8C%E6%A0%B7%E5%AE%B9%E6%98%93&quot;,&quot;title2&quot;:&quot;tertiary&quot;,&quot;price&quot;:500,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:500,&quot;danwei&quot;:&quot;10&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;19&quot;}]', '[{"fid":90,"total":500}]', 500, '7', '7', 1, 0, 1, '1480007824', NULL, '17', '1480007824', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 500, 500, 500, NULL, 500, NULL),
(24, '120009-1', 1, '09ce9cfff996c7fc5d19c19ecc05b758', '1480010488', NULL, '11', '10', '6', '21', '[{&quot;title&quot;:&quot;uq&quot;,&quot;title2&quot;:&quot;y&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;oo&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;25&quot;},{&quot;title&quot;:&quot;333&quot;,&quot;title2&quot;:&quot;22&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;44&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;24&quot;},{&quot;title&quot;:&quot;pp&quot;,&quot;title2&quot;:&quot;56&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;66q&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;22&quot;},{&quot;title&quot;:&quot;%E9%A2%9Dfgg%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;89&quot;,&quot;xfname&quot;:&quot;手术费&quot;,&quot;id&quot;:&quot;29&quot;}]', '[{"fid":88,"total":0},{"fid":89,"total":18}]', 18, '7', NULL, 0, 0, 1, NULL, NULL, '17', '1480010456', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, '', 18, NULL),
(25, '120009-2', 2, 'ad14163548cc8c6851edaf180fb2caf3', '1480010603', NULL, '11', '10', '6', '21', '[{&quot;title&quot;:&quot;pp&quot;,&quot;title2&quot;:&quot;56&quot;,&quot;price&quot;:0,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:0,&quot;danwei&quot;:&quot;66q&quot;,&quot;fid&quot;:&quot;88&quot;,&quot;xfname&quot;:&quot;治疗费&quot;,&quot;id&quot;:&quot;22&quot;},{&quot;title&quot;:&quot;%E9%A2%9D%E5%A4%96%E4%BB%8D%E7%84%B6&quot;,&quot;title2&quot;:&quot;%E6%8A%BC%E5%A4%B4%E9%9F%B5&quot;,&quot;price&quot;:18,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:18,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;21&quot;},{&quot;title&quot;:&quot;%E4%BA%8C%E6%81%B6%E7%83%B7&quot;,&quot;title2&quot;:&quot;4454&quot;,&quot;price&quot;:12,&quot;num&quot;:&quot;1&quot;,&quot;total&quot;:12,&quot;danwei&quot;:&quot;元&quot;,&quot;fid&quot;:&quot;90&quot;,&quot;xfname&quot;:&quot;产品费&quot;,&quot;id&quot;:&quot;20&quot;}]', '[{"fid":88,"total":0},{"fid":90,"total":30}]', 30, '7', '7', 1, 0, 1, '1480010502', NULL, '17', '1480010502', '17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '0', 30, 30, 30, NULL, 30, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_ke_shi`
--

CREATE TABLE `tp_ke_shi` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid` int(11) DEFAULT '0',
  `uuid` varchar(120) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `subtype` varchar(120) DEFAULT NULL,
  `webname` varchar(255) DEFAULT NULL,
  `is_price` tinyint(1) DEFAULT '0',
  `ename` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_ke_shi`
--

INSERT INTO `tp_ke_shi` (`id`, `fid`, `uuid`, `sort`, `ctime`, `checked`, `name`, `subtype`, `webname`, `is_price`, `ename`, `type`, `url`, `admin_id`) VALUES
(1, 0, 'c5ee6c2b3b395879113514940f18eb6a', 0, '1476499575', 1, '整形外形', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(2, 0, 'e9c303c1c835cc2e1f1fdba550038952', 0, '1476499575', 1, '皮肤美容科12', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(3, 1, '8d35056099434cceecea47e52fd8f09f', 0, '1476499586', 0, '鼻子整形', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(4, 1, '82860023b0ddc18bb849f6ade958bd75', 0, '1476499586', 1, '脸部整形', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(5, 1, 'daa5b8caf5650b1647d2e293bf59f3cd', 0, '1476499586', 1, '胸部整形', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(7, 2, '8e43d512ea6e53b3dd1f2abfd671ba10', 0, '1476499754', 1, '美白', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(10, 3, 'dac3e0f8ecafb9f00e695388ca28ed54', 0, '1476500626', 1, '局部手术', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(11, 3, '128aadadc6931afef59d96d58f8d1cd7', 0, '1476500626', 1, '全部手术', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(12, 4, '544a042a3f026798b89ece5b098c8faf', 0, '1476501513', 1, '瓜子脸', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(13, 4, '2b324cfec2ea63eda03efbe3330a5c7d', 0, '1476501513', 1, '圆脸', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(14, 5, '00663d01b8335c0b39c81799ca92d0b0', 3, '1476501533', 1, '假体隆胸', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(16, 5, 'ecde4ddfbb234619744bb80ddd4b6a4c', 2, '1476501533', 1, '自体脂肪移植丰胸', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(21, 1, 'a15bda9e9569e6e87304dc135cfd43ea', 0, '1476502400', 1, '王小飞', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(22, 1, '75eb207b15e34531a458ae1bcb783eea', 0, '1476502400', 1, '张国志', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(23, 1, '570ddecdee1ecbb60e5450ddd7ecad52', 0, '1476502400', 1, '赵云', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(24, 1, '25565729e515ff271436d6c1ec2ea0d2', 0, '1476502400', 1, '码云', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(25, 2, '7d4f96a5a071b08b350241b9c429362b', 0, '1476503094', 1, '赵国玉', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(26, 2, 'eb9198bfbc0ffde827ec3e6f69079e30', 0, '1476503094', 1, '左晓明', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(27, 2, 'b925e58a010667b0121e3df58a8d42d8', 0, '1476503094', 1, '大军', NULL, NULL, 0, NULL, 'yushen', NULL, 7),
(28, 2, '1e79f3c1a8ff96866ddc06018f593654', 0, '1476759720', 1, '祛斑', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(29, 2, '01545c50408283dba41c45244c32e93d', 0, '1476759720', 1, '祛痘', NULL, NULL, 0, NULL, 'keshi', NULL, 7),
(30, 2, '5474f47a6ad5c6cc2e66cf4feb3d1554', 0, '1476759720', 1, '除皱', NULL, NULL, 0, NULL, 'keshi', NULL, 7);

-- --------------------------------------------------------

--
-- 表的结构 `tp_lang`
--

CREATE TABLE `tp_lang` (
  `id` bigint(20) NOT NULL,
  `name` text,
  `sort` int(10) UNSIGNED DEFAULT '0',
  `ename` text,
  `type` varchar(120) DEFAULT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `admin_id` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_lang`
--

INSERT INTO `tp_lang` (`id`, `name`, `sort`, `ename`, `type`, `uuid`, `ctime`, `checked`, `admin_id`) VALUES
(1, '添加预约', 0, 'Điền đăng ký', 'vn', 'b9a774b3f84706cd07e575e2939af0c6', '1477074923', 1, '7'),
(2, '基本信息', 0, 'Thông tin cơ bản', 'vn', '47626708bf3cc6796a97fc1584312c2d', '1477074923', 1, '7'),
(3, '保存内容', 0, 'Lưu lại nội dung', 'vn', '6a2698c7c7274d288dacb9c1ae4203d6', '1477074923', 1, '7'),
(4, '重置', 0, 'Xóa', 'vn', '3f59645c71e8d20ba18567b6b9008605', '1477074923', 1, '7'),
(5, '客户姓名', 0, 'Tên', 'vn', '7ba2edf453a07b6d0bcd9036fb857775', '1477074923', 1, '7'),
(6, '联系手机', 0, 'Số điện thoại ', 'vn', 'b3ed66b2ce263e5726e621b79e514be4', '1477074923', 1, '7'),
(7, '科室', 0, 'phòng khoa', 'vn', '78a21e22275f0f5116dadf8c24182523', '1477074923', 1, '7'),
(8, '请选择科室', 0, 'mời chon phòng khoa,', 'vn', '20c0d41f6aed77862b86a66b9069dc5b', '1477074923', 1, '7'),
(9, '请选择二级科室', 0, 'mời chọn phòng khoa cấp 2', 'vn', '08047bb79b1bc5516b12a2af984c9aa0', '1477074923', 1, '7'),
(10, '请选择具体病种', 0, 'mời chọn bệnh cụ thể', 'vn', 'd7b1c8cf178b4edd026a9e919a4805e9', '1477074923', 1, '7'),
(11, '病人来源', 0, 'nguồn bệnh nhân', 'vn', '9ecb0ed3427cb52cb62b9009a2ba56ed', '1477074923', 1, '7'),
(12, '请选择', 0, 'mời chọn lựa', 'vn', '66214fe4210281a874d50c663beae912', '1477074923', 1, '7'),
(13, '无', 0, 'không', 'vn', '0ce77bd6c9ae99590bd084d59020792c', '1477074923', 1, '7'),
(14, '区域来源', 0, 'nguồn địa lý ', 'vn', 'c1e68a55c5481c34eec462f572b4d363', '1477074923', 1, '7'),
(15, '咨询方式', 0, 'hình thức tư vấn', 'vn', '0fd8f34d4dddacda5393d1e7416df626', '1477074923', 1, '7'),
(16, '咨询客服', 0, 'tư vấn khách hàng', 'vn', '0f3e39ef0d2a89226aae1f869d4b2981', '1477074923', 1, '7'),
(17, '初复诊', 0, 'khám bệnh và tái khám', 'vn', '9bd552bf245fd74dd13966d6430cd66e', '1477074923', 1, '7'),
(18, '初诊', 0, 'lần đầu khám bệnh', 'vn', '71b8e9c6583b85970240719560439151', '1477074923', 1, '7'),
(19, '复诊', 0, 'tái khám ', 'vn', '707d2490e0aa9c3e531d834984badf90', '1477074923', 1, '7'),
(20, '意向评定', 0, 'cấp bậc đăng ký ', 'vn', '5c07a164ac18d0783c762fa58aa4d415', '1477074923', 1, '7'),
(21, '咨询总结', 0, 'tổng kết tư vấn', 'vn', 'e572afe24cd0a48b3a7ddfe4f3628c6e', '1477074923', 1, '7'),
(22, '其他联系方式', 0, 'hình thứ liên lạc khác', 'vn', '62c577f8c56ec0cb40a38aa8a0165b15', '1477074923', 1, '7'),
(23, '详细聊天', 0, 'ghi chép đối thoại cụ thể  ', 'vn', '3d5917a5bcebc0e4a11e244da9f89c43', '1477074923', 1, '7'),
(24, '预约信息', 0, 'thông tin đăng ký', 'vn', '0527094e14c553b42e5b980459d859b2', '1477074923', 1, '7'),
(25, '预约日期', 0, 'ngày tháng đăng ký ', 'vn', '37b1cc56b11a76500e8b80406063bf43', '1477074923', 1, '7'),
(26, '今天', 0, 'hôm nay', 'vn', '4006aa13e9f46a246f9f555225c17e24', '1477074923', 1, '7'),
(27, '明天', 0, 'ngày mai', 'vn', '3679a0798d018d3185d5827a14e7933a', '1477074923', 1, '7'),
(28, '后天', 0, 'ngày mốt', 'vn', '73b6b7dac3da0256a93d12ca24b518f9', '1477074923', 1, '7'),
(29, '下星期', 0, 'tuần sau', 'vn', '8667d02f0a6d0bd6e6f1ced77a3fb265', '1477074923', 1, '7'),
(30, '下个月', 0, 'tháng sau  ', 'vn', '11d87c4f989bfc4fc5e9e7fba370b504', '1477074923', 1, '7'),
(31, '不确定', 0, 'không chắc chắn', 'vn', 'd2c99bc0af452ccefe0c4571eabeb21e', '1477074923', 1, '7'),
(32, '9时', 0, '9h ', 'vn', 'e6743d845535d731c69ce42084c94d30', '1477074923', 1, '7'),
(33, '详细信息', 0, 'thông tin cụ thể', 'vn', 'f2ba0522e3a4e620489bbe8e55da6c78', '1477074923', 1, '7'),
(34, 'Zalo', 0, 'Zalo', 'vn', '539aa9aab1c2ec13c3d7e1ddc92d4864', '1477074923', 1, '7'),
(35, '性别', 0, 'giới tính', 'vn', 'aa17b06a0f2ea98fb0b3461cc42ed008', '1477074923', 1, '7'),
(36, '男', 0, 'nam', 'vn', '6d54750f5bc79ebb8b7344d850ca2fb7', '1477074923', 1, '7'),
(37, '女', 0, 'nữ  ', 'vn', 'e4cbfbc85f0d5cab26538eeca9d0cdbd', '1477074923', 1, '7'),
(38, '婚姻', 0, 'hôn nhân ', 'vn', '7e14147210c0ed2099991b83fd4f6c43', '1477074923', 1, '7'),
(39, '不清楚', 0, 'không rõ', 'vn', '636d0a86fe8e33ac8ed43e59db6c143f', '1477074923', 1, '7'),
(40, '未婚', 0, 'chưa kết hôn', 'vn', '3c7b8ea72e191903a2587622a8de0279', '1477074923', 1, '7'),
(41, '已婚', 0, 'đã kết hôn', 'vn', '7fd7a43e55ccd664c9277e232d68efbd', '1477074923', 1, '7'),
(42, '年龄', 0, 'tuổi', 'vn', 'a5c967b35875a7e62bae0e5666b830a0', '1477074923', 1, '7'),
(43, '生日', 0, 'ngày tháng năm sinh ', 'vn', 'ca519bffc4cdedf70503c2046c2bc424', '1477074923', 1, '7'),
(44, '来源信息', 0, 'nguồn thông tin ', 'vn', 'b2e4885678836d58880e7d2f7e19d13c', '1477074923', 1, '7'),
(45, '网站来源', 0, 'nguồn trang mạng ', 'vn', '30b0a4d25d0020844c73435530bc34a2', '1477074923', 1, '7'),
(46, '访问入口', 0, 'trang lần đầu truy cập ', 'vn', 'cf51187f68fc48768c65810bc4cb1751', '1477074923', 1, '7'),
(47, '咨询页面', 0, 'trang bắt đầu đối thoại ', 'vn', 'ba89afd1d554d65a10ebbd5c00c2c77f', '1477074923', 1, '7'),
(48, '搜索关键词', 0, 'tìm từ khóa ', 'vn', '7bd14119637322efdb1aeb115bb6f57a', '1477074923', 1, '7');

-- --------------------------------------------------------

--
-- 表的结构 `tp_lan_mu`
--

CREATE TABLE `tp_lan_mu` (
  `id` int(11) UNSIGNED NOT NULL,
  `pice_type_code` varchar(11) DEFAULT NULL,
  `pice_code` varchar(120) DEFAULT NULL,
  `fid` int(11) DEFAULT '0',
  `areaid` int(11) UNSIGNED DEFAULT NULL,
  `uuid` varchar(120) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `name` varchar(1000) DEFAULT NULL,
  `subtype` varchar(120) DEFAULT NULL,
  `webname` varchar(255) DEFAULT NULL,
  `card` varchar(120) DEFAULT NULL,
  `is_price` tinyint(1) DEFAULT '0',
  `is_website` int(11) DEFAULT NULL,
  `is_tongji` tinyint(4) DEFAULT '1',
  `is_jigou` tinyint(1) DEFAULT '0',
  `ename` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `pj_id` varchar(120) DEFAULT NULL,
  `area_id` varchar(120) DEFAULT NULL,
  `areat_id` varchar(120) DEFAULT NULL,
  `areaall_id` varchar(120) DEFAULT NULL,
  `address` text,
  `funame` varchar(22) DEFAULT NULL,
  `futel` varchar(120) DEFAULT NULL,
  `ywname` varchar(120) DEFAULT NULL,
  `thumbs` text,
  `content` text,
  `buname` varchar(255) DEFAULT NULL,
  `quyue_time` varchar(255) DEFAULT NULL,
  `hetong` varchar(255) DEFAULT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `join_id` varchar(120) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_lan_mu`
--

INSERT INTO `tp_lan_mu` (`id`, `pice_type_code`, `pice_code`, `fid`, `areaid`, `uuid`, `sort`, `ctime`, `checked`, `name`, `subtype`, `webname`, `card`, `is_price`, `is_website`, `is_tongji`, `is_jigou`, `ename`, `type`, `url`, `pj_id`, `area_id`, `areat_id`, `areaall_id`, `address`, `funame`, `futel`, `ywname`, `thumbs`, `content`, `buname`, `quyue_time`, `hetong`, `mark`, `code`, `join_id`, `admin_id`) VALUES
(11, NULL, NULL, 0, NULL, 'a109e25374f04c3877317f2d7c7b6d81', 1, '1476440808', 1, 'D.T777', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'zixun', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(12, NULL, NULL, 0, NULL, '5455730fc9714914d38897701df29f10', 6, '1476440808', 1, 'Zalo', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'zixun', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(13, NULL, NULL, 0, NULL, 'a3b71f3c34e5f585e6b25354a238f2e0', 4, '1476440808', 1, 'livechat', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'zixun', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(14, NULL, NULL, 0, NULL, 'fe3c620855f570e1294c28389b7c8908', 5, '1476440808', 1, 'Facebook', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'zixun', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(15, NULL, NULL, 0, NULL, 'b90dff66a17ffeb3de94c013955d2aa3', 0, '1476452657', 1, 'A', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'daozhen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(16, NULL, NULL, 0, NULL, '76cec31fc13c30141de7f4fd4d21ca86', 0, '1476452657', 1, 'B', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'daozhen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(17, NULL, NULL, 0, NULL, 'd2e0baadcd32e270f77645fa49aa80a5', 0, '1476452657', 1, 'C', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'daozhen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(21, NULL, NULL, 0, NULL, 'f6c63726c77af935f7ff4f3f0f45849c', 0, '1476453393', 1, '未收费', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'shuofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(22, NULL, NULL, 0, NULL, '2563dc7b9756bad881e568a9dfac1758', 0, '1476453393', 1, '已收费', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'shuofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(23, NULL, NULL, 0, NULL, '08aa4a8bea71559495f95ec1ab68ba79', 0, '1476453393', 1, '收订金', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'shuofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(24, NULL, NULL, 0, NULL, '6df69873c402ead43c67cc97cf957629', 0, '1476454641', 1, '已结算', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'jiesuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(25, NULL, NULL, 0, NULL, '70c39dc06970ecc8c8300e0d04b79658', 0, '1476454641', 1, '未结算', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'jiesuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(26, NULL, NULL, 0, NULL, 'f912c1f2ab181120923aaf05ef0c9231', 0, '1476455798', 1, '空气工作室', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'website', 'www.kong-qi.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(27, NULL, NULL, 0, NULL, '88470ecebbced016a684e5cf59d42563', 0, '1476455914', 1, '百度', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'website', 'www.baidu.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(28, NULL, NULL, 0, NULL, '34dcb4d4793f115fd4b4287666f37c24', 0, '1476455914', 0, 'D.T 8882', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'zixun', 'www.taobao.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(31, NULL, NULL, 0, NULL, '0e841f3917ab6ac548d06bd30a5783c3', 0, '1476458943', 1, 'A', 'mete', NULL, NULL, 0, NULL, 1, 0, NULL, 'jigou', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(32, NULL, NULL, 0, NULL, '891b41eae6b084243fa4de7f709c5964', 0, '1476458943', 1, 'B', 'mete', NULL, NULL, 0, NULL, 1, 0, NULL, 'jigou', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(33, NULL, NULL, 0, NULL, '744a56d92909b64b01e043a609f2f324', 0, '1476458943', 1, 'C', 'mete', NULL, NULL, 0, NULL, 1, 0, NULL, 'jigou', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(34, NULL, NULL, 0, NULL, '758718b6098b36555414801a8d383b9a', 0, '1476458998', 1, '合作中', 'join', NULL, NULL, 0, NULL, 1, 0, NULL, 'jigou', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(35, NULL, NULL, 0, NULL, '935f8859fe7f3950fc7344fd8ca1a2c0', 0, '1476458998', 1, '停止合作', 'join', NULL, NULL, 0, NULL, 1, 0, NULL, 'jigou', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(36, NULL, NULL, 0, NULL, '6d97452e1cbf522b8f0fd9f922b04f22', 0, '1476459453', 1, '电话', 'hf_way', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(37, NULL, NULL, 0, NULL, 'd55226c48adcc290aaeb6dc776b35aca', 0, '1476459453', 1, '微信', 'hf_way', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(44, NULL, NULL, 0, NULL, 'e7dd1fc4d83c441ccfe8d98ba2ce9fa0', 0, '1476459643', 1, '未预约回访', 'hf_type', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(45, NULL, NULL, 0, NULL, '66fe789da9990ca3e8e5e8e4adbdbcd5', 0, '1476459643', 1, '未到诊回访', 'hf_type', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(46, NULL, NULL, 0, NULL, '1dc3818c385591c6285f7b2f6a39166a', 0, '1476459643', 1, '未消费回访', 'hf_type', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(47, NULL, NULL, 0, NULL, 'baf114d6e327827a851717eb2e3de0a9', 0, '1476459643', 0, '到诊前回访', 'hf_type', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(48, NULL, NULL, 0, NULL, 'c901ac20afb010c38deaf71d5cd46326', 0, '1476459643', 1, '到诊后回访', 'hf_type', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(49, NULL, NULL, 0, NULL, '6b317472f4bf42f5edbebd1fe8c87d25', 0, '1476459643', 1, '手术前回访', 'hf_type', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(50, NULL, NULL, 0, NULL, '4b6ea4e7a16de1233338b5509b8d4171', 0, '1476459699', 1, '确定预约时间', 'hf_theme', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(51, NULL, NULL, 0, NULL, '9ea18d7a2a38ecee516a4af8d1a20ab6', 0, '1476459699', 1, '了解未到诊原因', 'hf_theme', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(52, NULL, NULL, 0, NULL, 'f1adc0bc8888bab5aece37ed80b78579', 0, '1476459699', 1, '了解未消费原因', 'hf_theme', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(53, NULL, NULL, 0, NULL, '54195af7644016482a166a972c098c23', 0, '1476459699', 1, '去电详细咨询沟通', 'hf_theme', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(54, NULL, NULL, 0, NULL, 'f02784968e2785b03e0b01fe6996cec2', 0, '1476459699', 1, '优惠活动推荐', 'hf_theme', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(55, NULL, NULL, 0, NULL, '001bd90971d5a50ff0a777a3bf8f4e4a', 0, '1476459851', 1, '接通（已联系上）', 'hf_status', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(56, NULL, NULL, 0, NULL, '3d73db075f9a0bcef25e151c9eff0614', 0, '1476459851', 1, '关机', 'hf_status', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(57, NULL, NULL, 0, NULL, '6af88ec687031c9ec1b85c96cfeccbee', 0, '1476459851', 1, '无人接听', 'hf_status', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(58, NULL, NULL, 0, NULL, '7590ff6036381b21f5beec6f3d653111', 0, '1476459851', 1, '拒接', 'hf_status', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(59, NULL, NULL, 0, NULL, '76592231d583ea2762b25c52c0b2fc4a', 0, '1476459851', 1, '停机或无法接通', 'hf_status', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(60, NULL, NULL, 0, NULL, '33960fdd6e1a713a2e6916e0739ac400', 0, '1476459851', 1, '空号/错号', 'hf_status', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(61, NULL, NULL, 0, NULL, '8974d1c8a5f42bd76fd924b352bcea2a', 0, '1476459871', 1, '无', 'hf_go', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(62, NULL, NULL, 0, NULL, '6f337f18bd6a782c9dbf1c7caf2a5b63', 0, '1476459871', 1, '竞争对手', 'hf_go', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(63, NULL, NULL, 0, NULL, '850fdfe879557ad9663b5c397940c948', 0, '1476459871', 1, '公立医院', 'hf_go', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(64, NULL, NULL, 0, NULL, '5f284463c540fbd4155cdd649d41a24e', 0, '1476459871', 1, '自然流失', 'hf_go', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(65, NULL, NULL, 0, NULL, '7a515d257cb241162f80274faea39609', 0, '1476495885', 1, 'A', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'yuyuezl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(66, NULL, NULL, 0, NULL, '905a222fdca47cf8643f2b63da13deaa', 0, '1476495885', 1, 'B', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'yuyuezl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(67, NULL, NULL, 0, NULL, 'c734d9b41a1e48c1885ec5d8d37d6dc9', 0, '1476495885', 1, 'C1', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'yuyuezl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(68, NULL, NULL, 0, NULL, '46df09fdb9c5ce8557287f55d8cb9be4', 3, '1476506694', 1, '市场部', NULL, NULL, '', 0, 0, 1, 1, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(69, NULL, NULL, 0, NULL, '483a02495d8434ee235cf5ec43ebba9d', 4, '1476506694', 1, '网络营销部', NULL, NULL, 'WL', 0, 1, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(70, NULL, NULL, 0, NULL, '352f1a1af6f034fd63f7b919c97ee2a5', 2, '1476506694', 1, '杂志派发', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(71, NULL, NULL, 0, NULL, 'fa9e37b8fb18267c364f1189e4fdaec6', 1, '1476506694', 1, '自来3', NULL, NULL, '', 0, 0, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(72, NULL, NULL, 68, NULL, '1e371a841475f3efb64f92d584837345', 0, '1476507417', 1, '美容机构', NULL, NULL, '', 0, 0, 1, 1, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(73, NULL, NULL, 68, NULL, 'a7107cd1f0d65ee0a24a6e6a9085ff2b', 0, '1476507477', 1, '美发机构', NULL, NULL, '', 0, 0, 1, 1, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(74, NULL, NULL, 69, NULL, '13506eba73724d29030aaab0d733ec13', 0, '1476507737', 1, 'Facebook', NULL, NULL, '', 1, NULL, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(75, NULL, NULL, 69, NULL, '024ab66fe7dc671a5cf1792600070f3f', 0, '1476507774', 1, 'Google-Adwords', NULL, NULL, '', 1, 1, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(76, NULL, NULL, 69, NULL, 'd1ae56301d2e232ce5875f1c8bcb2e24', 0, '1476507802', 1, '官网', NULL, NULL, 'WS', 0, 1, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(86, NULL, NULL, 72, NULL, 'e407300722c33b6f561d1abb3df37741', 0, '1476867559', 1, '安妮美容院', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '50', '607', '', '33344', 'xiao', '8987897987', 'tran', '[]', '44444', 'admin', '2016-10-19 00:00:00', 'A969', '444444', '33', '34', 7),
(88, '1', NULL, 0, NULL, '0f0e6b1384a7ee4f919ff6368f0d4461', 0, '1477062204', 1, '治疗费', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, 7),
(89, '2', NULL, 0, NULL, '037ec1885041b17113590478d26c51b5', 0, '1477062204', 1, '手术费', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, 7),
(90, '3', NULL, 0, NULL, 'ec875be1895696a4a2ed4e3c792c4379', 0, '1477062204', 1, '产品费', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 7),
(91, NULL, NULL, 72, NULL, '09878f61fefe8646c618fa9603265705', 0, '1477196748', 1, '111', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '3', '105', '105', '0', '', '123456', '77', '[]', '', 'admin', '2016-10-27 00:00:00', '3223', '', 'ccd', '34', 7),
(92, NULL, NULL, 0, NULL, '06cc84f35026fb9873fa9a6a0aaa1007', 0, '1477322174', 1, '2', NULL, NULL, '22', 0, NULL, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(95, NULL, NULL, 0, NULL, '2c38ff6c7f58fd073ec25b25be4351c9', 0, '1477322519', 1, '1', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'zixun', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, 0, NULL, '89896e8296d06970df64ee1ad9137ccb', 0, '1477842434', 1, '未填写', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(97, NULL, NULL, 0, NULL, '04fcf94f1282408423671c2161fc87c8', 0, '1477842434', 1, '销售', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(98, NULL, NULL, 0, NULL, 'df41e08b087d0d40dbc420dcc2e9acf2', 0, '1477842434', 1, '管理', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(99, NULL, NULL, 0, NULL, '2e935dbd2ca31d0634669d125618f8a4', 0, '1477842434', 1, '财务', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(100, NULL, NULL, 0, NULL, 'ea6d7af3a122330323b7650114da14c6', 0, '1477842434', 1, '老师', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(101, NULL, NULL, 0, NULL, '647c5d0fbd15d366332bf84313e72e3b', 0, '1477842434', 1, '医生', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(102, NULL, NULL, 0, NULL, 'e995a770c3c35071803b64670dfd453d', 0, '1477842434', 1, 'IT', 'zhiye', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(103, NULL, NULL, 0, NULL, '338ff798efffde0f21de457cbc40ec1e', 0, '1477842445', 1, '未填写', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(104, NULL, NULL, 0, NULL, 'd0c2a62d95086b505beaf526355655c6', 0, '1477842445', 1, '小学', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(105, NULL, NULL, 0, NULL, 'b32520784371dff6d8344310891db9ac', 0, '1477842445', 1, '初中', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(106, NULL, NULL, 0, NULL, '90d55e07c88e9a605de1b86f515d99d4', 0, '1477842445', 1, '高中', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(107, NULL, NULL, 0, NULL, 'a3e340693b8f133f9e42410c58e8d4ca', 0, '1477842445', 1, '大专', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(108, NULL, NULL, 0, NULL, '19047c55523b451c7a3ae0d3323ec7eb', 0, '1477842445', 1, '大学', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(109, NULL, NULL, 0, NULL, '8654200cb32764d28dcfad470b477c4d', 0, '1477842445', 1, '硕士', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(110, NULL, NULL, 0, NULL, '99972711f41702731f774d3ae92c69a1', 0, '1477842445', 1, '博士', 'xueli', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(111, NULL, NULL, 0, NULL, '06c50d521459e51ac060b411c0933d9b', 0, '1477842456', 1, '未填写', 'hunyun', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(112, NULL, NULL, 0, NULL, '86d25d6cf73288ab10f9b1f652b9a268', 0, '1477842456', 1, '已婚', 'hunyun', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(113, NULL, NULL, 0, NULL, 'b44e9940f3a3e22b55406038ce8d2bff', 0, '1477842456', 1, '未婚', 'hunyun', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(114, NULL, NULL, 0, NULL, '33fe49a65d9e137e2d82774cc89d5fdf', 0, '1477842465', 1, 'VIP-1', 'level', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(115, NULL, NULL, 0, NULL, '79d585c2b0d6f07bb5b096247adaaccf', 0, '1477842465', 1, 'VIP-2', 'level', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(116, NULL, NULL, 0, NULL, '777178b7ca5569ba944b4fa933529bd9', 0, '1477842465', 1, 'VIP-3', 'level', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(117, NULL, NULL, 0, NULL, 'd8ef819c8c536153e2523f2406490537', 0, '1477842465', 1, 'S-VIP', 'level', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(118, NULL, NULL, 0, NULL, 'd3e6ee6ee07863bb0eff8b9fe574ca97', 0, '1477842473', 1, 'iPhone7', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(119, NULL, NULL, 0, NULL, '57a08ac2fab24ab279c8b6e12d71c1c7', 0, '1477842473', 1, 'iPhone6', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(120, NULL, NULL, 0, NULL, 'ae0ff33df77f70c26dcfa70822bf18e8', 0, '1477842473', 1, 'iPhone5', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(121, NULL, NULL, 0, NULL, '098ac338d47782ffcda75675cd284430', 0, '1477842473', 1, 'Sansung', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(122, NULL, NULL, 0, NULL, 'f3663aa95dc3ddfadcf3d0fc3dc4d1c4', 0, '1477842473', 1, 'Huawei', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(123, NULL, NULL, 0, NULL, '3250c89fd897643c3498ea974aa6b192', 0, '1477842473', 1, 'OPPO', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(124, NULL, NULL, 0, NULL, '4a0937252b6cc689a172831f63ba786f', 0, '1477842473', 1, 'VIVO', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(125, NULL, NULL, 0, NULL, 'fe98f803d52f9bf715a2b0d37fd224a9', 0, '1477842473', 1, 'SONY', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(126, NULL, NULL, 0, NULL, 'ebd752eb33a304d3594066ac2094ba5a', 0, '1477842473', 1, 'ASUS', 'bank', NULL, NULL, 0, NULL, 1, 0, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(127, NULL, NULL, 0, NULL, '40348ae0be230695d9b7f92de4597b53', 0, '1478113160', 1, '没有解决了', 'hf_result', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(128, NULL, NULL, 0, NULL, 'ccbf56de1791abafc21f5dcdc645b8ce', 0, '1478113170', 1, '来的是', 'hf_result', NULL, NULL, 0, NULL, 1, 0, NULL, 'huifang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(129, NULL, NULL, 72, NULL, '67a48d65b504bb98c1c986eaeb5b840e', 0, '1478158965', 1, '大美女', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '6', '132', '132', '', '', '', '', '[{&quot;path&quot;:&quot;147651446323.jpg&quot;},{&quot;path&quot;:&quot;1476859527249.jpg&quot;}]', '77', 'shichang', '2016-11-26 00:00:00', '8787', '777', '6776', '34', 20),
(130, NULL, NULL, 72, NULL, '1969b4b63f0297e3f960b44b898524bc', 0, '1478160138', 1, '44', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '2', '94', '94', '的', '', '', '', '[]', '3444', 'shichang', '2016-11-26 00:00:00', '6', '44', '666', '34', 20),
(131, NULL, NULL, 72, NULL, 'aaa5b4d1e4b7584c064eb41f48c16505', 0, '1478327556', 1, '444666', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '19', '261', '', '', '', '', '', '[{&quot;path&quot;:&quot;1478327931132.png&quot;},{&quot;path&quot;:&quot;1478327931115.jpg&quot;}]', '444', 'shichang', '2016-11-18 00:00:00', '55', '', '66', '34', 20),
(140, '4', NULL, 0, NULL, '716b4ec1c23b469cb3832071c1f47086', 0, '1478454509', 1, 'rrr', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(141, '5', NULL, 0, NULL, '023185f2ecd8e82b5cea095ed3e288d5', 0, '1478454509', 1, 'gg', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(145, '6', NULL, 0, NULL, '7f700a53eaf2801219956156a52c3987', 0, '1478455784', 1, '4', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(146, '7', NULL, 0, NULL, 'a3adf8a8bb99f72df6f4c8719038f38e', 0, '1478455784', 1, '777', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(147, '8', NULL, 0, NULL, '143401e7ac176ca20862adb18390a7a3', 0, '1478456200', 1, '5', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(148, '9', NULL, 0, NULL, '776586e52acfb643516a0074c90d215d', 0, '1478456200', 1, '9', NULL, NULL, NULL, 0, NULL, 1, 0, NULL, 'xiaofei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(149, NULL, NULL, 72, NULL, '3f853cef08b9451cdcc184a40ec3e126', 0, '1478726969', 1, '7777', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '2', '93', '', '', '', '', '', '[]', '6', 'admin', '2016-11-12 00:00:00', '', '6', '', '34', 7),
(150, NULL, NULL, 72, NULL, '4f731e634d4dfbed1184840f61aba68b', 0, '1478969979', 1, '4444', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'bingren', NULL, '31', '3', '105', '105', '', '', '', '', '[]', '', 'shichang', '2016-11-25 00:00:00', '', '', '', '34', 20),
(151, NULL, NULL, 72, NULL, 'a421768d485c8ea730cf1810e351e1e9', 0, '1478970007', 1, 'ee3二恶', NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'bingren', NULL, '31', '4', '120', '120', '', '', '', '', '[]', 'dd', 'admin', '2016-11-18 00:00:00', '', '点点滴滴', '', '34', 7),
(152, NULL, NULL, 0, NULL, '88627e7cff013ed80d50c7dfcb7e016a', 0, '1478970184', 1, '55', NULL, NULL, '55', 0, NULL, 1, 0, NULL, 'bingren', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7);

-- --------------------------------------------------------

--
-- 表的结构 `tp_lan_mu_extends`
--

CREATE TABLE `tp_lan_mu_extends` (
  `id` int(11) NOT NULL,
  `fid` int(11) DEFAULT '0',
  `uuid` varchar(120) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `list` tinyint(4) DEFAULT '1',
  `model` text,
  `html` text,
  `title` varchar(200) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `entitle` varchar(255) DEFAULT NULL,
  `enkeyword` varchar(255) DEFAULT NULL,
  `endescription` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `aburl` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `enbanner` varchar(255) DEFAULT NULL,
  `ico` varchar(255) DEFAULT NULL,
  `enico` varchar(255) DEFAULT NULL,
  `last` varchar(255) DEFAULT NULL,
  `add_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_log`
--

CREATE TABLE `tp_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `encontent` varchar(255) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_log`
--

INSERT INTO `tp_log` (`id`, `admin_id`, `user_id`, `name`, `content`, `encontent`, `ctime`) VALUES
(31, 7, NULL, NULL, '回访记录：更新成功', NULL, '1480010775'),
(32, 7, '11', NULL, '回访记录：更新成功', NULL, '1480010881'),
(33, 7, '11', NULL, '回访记录：添加成功', NULL, '1480010894'),
(34, 7, '', NULL, '回访任务：删除成功', NULL, '1480010909'),
(35, 7, '11', NULL, '回访任务：添加成功', NULL, '1480011049'),
(36, 7, NULL, NULL, '回访任务：更新成功', NULL, '1480011068'),
(37, 7, '11', NULL, '回访任务：更新成功', NULL, '1480011102'),
(38, 7, '11', NULL, '回访任务：删除成功', NULL, '1480011124');

-- --------------------------------------------------------

--
-- 表的结构 `tp_man_ban`
--

CREATE TABLE `tp_man_ban` (
  `id` int(11) NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ename` varchar(200) DEFAULT NULL,
  `type` varchar(120) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_nav`
--

CREATE TABLE `tp_nav` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid` int(11) DEFAULT NULL,
  `uuid` varchar(120) NOT NULL,
  `sort` tinyint(4) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `ename` varchar(120) DEFAULT NULL,
  `picurl` text,
  `url` varchar(255) DEFAULT NULL,
  `wburl` varchar(255) DEFAULT NULL,
  `type` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_price`
--

CREATE TABLE `tp_price` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid` int(11) DEFAULT '0',
  `price_code` int(11) DEFAULT NULL,
  `base_code` int(120) DEFAULT NULL,
  `is_update` tinyint(1) DEFAULT '0',
  `uuid` varchar(120) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `price` bigint(40) UNSIGNED DEFAULT NULL,
  `price_name` varchar(255) DEFAULT NULL,
  `ticket_name` varchar(255) DEFAULT NULL,
  `danwei` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `tfid` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_price`
--

INSERT INTO `tp_price` (`id`, `fid`, `price_code`, `base_code`, `is_update`, `uuid`, `sort`, `ctime`, `checked`, `name`, `price`, `price_name`, `ticket_name`, `danwei`, `code`, `tfid`, `type`, `url`, `admin_id`) VALUES
(5, 89, 2001, 1, 0, '29385059a9ad908b73d77016748ab345', 0, '1477062465', 1, '避孕手术', 1000, NULL, '避孕手术', '元', 'BIXY', NULL, NULL, NULL, NULL),
(6, 89, 2002, 2, 0, '2fa75ed706eab0160257e0587018806a', 0, '1477062499', 1, '开刀费', 150, NULL, '开刀费', '次数', 'XLDL', NULL, NULL, NULL, NULL),
(7, 90, 3003, 3, 1, '80e74d5fbdb267f16c389c18adce6c52', 0, '1477062607', 1, '傻从今', 500000, NULL, '傻从今', '件', 'SX', NULL, NULL, NULL, NULL),
(14, 90, 3004, 4, 1, 'b93291ecfd1ebbedfaa142a440cc64fb', 0, '1477063449', 1, '白克力', 500, NULL, '白克力票据', '10', 'BKL', NULL, NULL, NULL, 7),
(15, 90, 3005, 5, 0, 'bcfd5a12b31bc2da484941a9e8282277', 0, '1477063449', 1, '仁和可立克', 12, NULL, '仁和可立克', '元', 'ERE', NULL, NULL, NULL, 7),
(16, 90, 3006, 6, 1, '68ea3f2d94dfdf3f6f406fdb8f4ae518', 0, '1477063449', 1, '幸福科达琳', 18, NULL, '幸福科达琳DD', '元', 'D', NULL, NULL, NULL, 7),
(17, 89, 2007, 7, 0, '0e66f686d3af87757c3cba2a29f1c6f1', 0, '1478452631', 1, 'rrrre', 0, NULL, 'eew', 'wwe', 'tyty', NULL, NULL, NULL, NULL),
(18, 89, 2008, 8, 0, '7109da4ef8436d84200bad3186552a7e', 0, '1478452825', 1, '55', 0, NULL, '44', '44', 'ttt', NULL, NULL, NULL, NULL),
(19, 90, 3009, 9, 0, '047feb0374249f0cfd813ca222240767', 0, '1478453307', 1, '同样容易', 500, NULL, 'tertiary', '10', 'BKL', NULL, NULL, NULL, 7),
(20, 90, 3010, 10, 0, '26a35b45f8483f4f874cad1995d439c8', 0, '1478453307', 1, '二恶烷', 12, NULL, '4454', '元', 'ERE', NULL, NULL, NULL, 7),
(21, 90, 3011, 11, 0, '1cc25266e31b6698350d8baddb337ab6', 0, '1478453307', 1, '额外仍然', 18, NULL, '押头韵', '元', 'D', NULL, NULL, NULL, 7),
(22, 88, 1012, 12, 0, 'e03c7cf5fc3987af91cf87b581953ab1', 0, '1478455153', 1, 'pp', 0, NULL, '56', '66q', '88', NULL, NULL, NULL, NULL),
(23, 88, 1013, 13, 0, 'fd6b34c135a2ac545c8fa4569fd35dde', 0, '1478455226', 1, 'ii', 0, NULL, 'op', 'p', 'ppp', NULL, NULL, NULL, NULL),
(24, 88, 1014, 14, 0, 'e3fc14f17febe14b21fb13318c558e49', 0, '1478455343', 1, '333', 0, NULL, '22', '44', '55', NULL, NULL, NULL, NULL),
(25, 88, 1015, 15, 0, '73bb0faaae2d8f61f590f129f6e0fbef', 0, '1478455441', 1, 'uq', 0, NULL, 'y', 'oo', '[', NULL, NULL, NULL, NULL),
(27, 90, 3016, 16, 0, 'd5ea4af205df0fee0650954e2be20cde', 0, '1478456535', 1, '同rtt', 500, NULL, 'tertiary', '10', 'BKL', NULL, NULL, NULL, 7),
(28, 90, 3017, 17, 1, '1ff69610fcd9a0f3476cffa735a0f95a', 0, '1478456535', 1, 'uuic', 12, NULL, '4454', '元', 'ERE', NULL, NULL, NULL, 7),
(29, 89, 2018, 18, 1, '71d533a570c7b6c12b6ea90a3f01eb1a', 0, '1478456535', 1, '额fgg外仍然', 18, NULL, '押头韵', '元', 'D', NULL, NULL, NULL, 7),
(32, 88, 1019, 19, 0, 'fe95383df5d523763876987323eef9bf', 0, '1479385926', 1, '44', 0, NULL, '55', '6', '5', NULL, NULL, NULL, NULL),
(33, 88, 1020, 20, 1, '312494cd72cd3e0c040dcd980e94eba7', 0, '1479385942', 1, '444', 0, NULL, '5', '6', '77', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_ren_wu`
--

CREATE TABLE `tp_ren_wu` (
  `id` int(11) NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `sort` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text,
  `type_text` text,
  `type_id` varchar(120) DEFAULT NULL,
  `handle_id` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `rtime` varchar(120) DEFAULT NULL,
  `hftime` varchar(120) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `admin_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_show_price`
--

CREATE TABLE `tp_show_price` (
  `id` bigint(20) NOT NULL,
  `yy_id` varchar(120) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `jz_id` varchar(120) DEFAULT NULL COMMENT 'jiezhen_id',
  `kdys_id` varchar(120) DEFAULT NULL COMMENT 'kaidan_id',
  `price` varchar(120) DEFAULT NULL COMMENT 'jiage',
  `num` varchar(120) DEFAULT NULL COMMENT 'shuliang',
  `total` varchar(120) DEFAULT NULL COMMENT 'xiaoji',
  `fid` varchar(120) DEFAULT NULL COMMENT 'leibie',
  `xf_name` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `price_id` varchar(120) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ticket_name` varchar(255) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `kd_id` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_show_price`
--

INSERT INTO `tp_show_price` (`id`, `yy_id`, `user_id`, `jz_id`, `kdys_id`, `price`, `num`, `total`, `fid`, `xf_name`, `admin_id`, `price_id`, `name`, `ticket_name`, `ctime`, `kd_id`) VALUES
(75, '10', '9', NULL, '1', '18', '10', '180', '90', '产品费', '7', '18', '幸福科达琳', '幸福科达琳DD', NULL, NULL),
(76, '10', '9', NULL, '1', '12', '10', '120', '90', '产品费', '7', '12', '仁和可立克', '仁和可立克', NULL, NULL),
(77, '10', '9', NULL, '1', '500', '10', '5000', '90', '产品费', '7', '500', '白克力', '白克力票据', NULL, NULL),
(78, '10', '9', NULL, '1', '50', '10', '500', '90', '产品费', '7', '50', '傻从今', '傻从今', NULL, NULL),
(79, '10', '9', NULL, '1', '150', '10', '1500', '89', '手术费', '7', '150', '开刀费', '开刀费', NULL, NULL),
(80, '10', '9', NULL, '1', '1000', '10', '10000', '89', '手术费', '7', '1000', '避孕手术', '避孕手术', NULL, NULL),
(81, '10', '9', '10', '1', '12', '2', '24', '90', '产品费', '7', '12', '仁和可立克', '仁和可立克', '1477232247', '30');

-- --------------------------------------------------------

--
-- 表的结构 `tp_sms`
--

CREATE TABLE `tp_sms` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid` int(11) DEFAULT '0',
  `uuid` varchar(120) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `ctime` varchar(120) DEFAULT NULL,
  `checked` tinyint(4) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `subtype` varchar(120) DEFAULT NULL,
  `content` text,
  `is_price` tinyint(1) DEFAULT '0',
  `ename` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_sms`
--

INSERT INTO `tp_sms` (`id`, `fid`, `uuid`, `sort`, `ctime`, `checked`, `name`, `subtype`, `content`, `is_price`, `ename`, `type`, `url`, `admin_id`) VALUES
(1, 0, '34201e5956b7b40d92896552ac4d30e2', 0, '1476522324', 0, '	妇科体检', NULL, '温馨提示：[姓名]女士，您好，已经成功帮您预约我院[预约日期]的妇科体检[预约号]，来院后在一楼导诊台登记核对，免专家挂号费。', 0, NULL, NULL, NULL, NULL),
(2, 0, '95c72ce9d07d54db3f22c7abf674063d', 0, '1476522370', 1, '预约短信', NULL, '温馨提示[姓名]女士,您好,您已经成功预约我院[预约日期](时间精确到几点)的四维彩超[预约号]。请您保留好预约短信,来院请您到一楼导医台登记核对,免挂号费,请您缴费后提前15分钟在四维室等候', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_sms_log`
--

CREATE TABLE `tp_sms_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_sms_log`
--

INSERT INTO `tp_sms_log` (`id`, `admin_id`, `uid`, `ctime`, `content`) VALUES
(10, 7, 3, '1478112625', '查看手机'),
(11, 7, 2, '1478114086', '查看手机'),
(12, 7, 2, '1478114123', '查看手机'),
(13, 7, 5, '1478142077', '查看手机'),
(14, 7, 7, '1478329823', '查看手机'),
(15, 19, 6, '1478330559', '查看手机'),
(16, 7, 6, '1478429825', '查看手机');

-- --------------------------------------------------------

--
-- 表的结构 `tp_user`
--

CREATE TABLE `tp_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `sort` int(4) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL COMMENT '名字',
  `true_name` varchar(255) DEFAULT NULL,
  `ytimes` varchar(120) DEFAULT '1' COMMENT '建档时间',
  `nickname` varchar(120) DEFAULT NULL COMMENT '昵称',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `sex` varchar(120) DEFAULT NULL COMMENT '性别',
  `age` varchar(120) DEFAULT NULL COMMENT '年龄',
  `is_jiehun` varchar(120) DEFAULT NULL COMMENT '是否结婚',
  `birthday` varchar(120) DEFAULT NULL COMMENT '生日',
  `zhiye` varchar(255) DEFAULT NULL COMMENT '职业',
  `xueli` varchar(255) DEFAULT NULL COMMENT '学历',
  `tel2` varchar(255) DEFAULT NULL COMMENT '电话2',
  `sfcard` varchar(255) DEFAULT NULL COMMENT '身份证',
  `othetel` varchar(500) DEFAULT NULL COMMENT '其他联系方式',
  `tel` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `qq` varchar(25) DEFAULT NULL,
  `weixin` varchar(25) DEFAULT NULL,
  `address` text,
  `checked` tinyint(4) DEFAULT '1',
  `pwd` varchar(120) DEFAULT NULL,
  `uniqueid` varchar(120) DEFAULT NULL,
  `type` varchar(60) DEFAULT NULL,
  `openid` varchar(120) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `picurl` text,
  `level` varchar(120) DEFAULT NULL COMMENT '会员等级',
  `level_card` varchar(255) DEFAULT NULL COMMENT '会员卡号',
  `facebook` varchar(255) DEFAULT NULL,
  `phone_bank` varchar(255) DEFAULT NULL COMMENT '手机品牌',
  `bingshi` text COMMENT '病史',
  `intro_name` varchar(255) DEFAULT NULL,
  `zalo` varchar(255) DEFAULT NULL,
  `hf_total` int(10) UNSIGNED DEFAULT NULL,
  `rw_total` int(10) UNSIGNED DEFAULT NULL,
  `jz_total` int(10) UNSIGNED DEFAULT NULL,
  `kd_total` int(10) UNSIGNED DEFAULT NULL,
  `yy_total` int(11) DEFAULT '0',
  `zx_total` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_user`
--

INSERT INTO `tp_user` (`id`, `uuid`, `admin_id`, `ctime`, `sort`, `name`, `true_name`, `ytimes`, `nickname`, `email`, `sex`, `age`, `is_jiehun`, `birthday`, `zhiye`, `xueli`, `tel2`, `sfcard`, `othetel`, `tel`, `phone`, `qq`, `weixin`, `address`, `checked`, `pwd`, `uniqueid`, `type`, `openid`, `token`, `picurl`, `level`, `level_card`, `facebook`, `phone_bank`, `bingshi`, `intro_name`, `zalo`, `hf_total`, `rw_total`, `jz_total`, `kd_total`, `yy_total`, `zx_total`) VALUES
(1, '7472341b975de2e46232ae195da813d9', 7, '1479912292', 0, '5656', NULL, '1', NULL, NULL, '男', '17', NULL, '1999-11-05', NULL, NULL, NULL, NULL, NULL, '546546', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '938daa69b8c87e6a20080de7d4ef8db9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, 1, NULL),
(2, '7d9b7a3897c04cc24c036c865d7ead0e', 7, '1479983479', 0, '李四', NULL, '1', NULL, NULL, '女', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89498498', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0, NULL),
(3, '09b2ebee06f61e901d43e54061c4d048', 7, '1479999345', 0, 'ee', NULL, '1', NULL, NULL, '女', '10', '112', '2006-11-14', '96', '104', NULL, NULL, NULL, '4543535', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'd298dc33d38fa7b1ca7d3ab39a345b03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, 1, NULL),
(4, '032655007415fb202220c8dff7f6d2e1', 7, '1480008164', 0, '666', NULL, '1', NULL, NULL, '女', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'a1919a583c1acbdf9fa66e8f1dd28afb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(5, 'f134d7924dcc1dc6308b2516c4f07678', 7, '1480009118', 0, '777777', NULL, '1', NULL, NULL, '男', '18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '777', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'd63a0d6dff567a8e5670c91d97a2c407', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 5),
(6, '8edcce702c69eaa44899f8cb9e3b6adb', 7, '1480008465', 0, '666', NULL, '1', NULL, NULL, '女', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '666', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '02cf3f97bd09c58136c5b345573512c8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(7, '95fb3e6b2de416136ab7691f558e2104', 7, '1480008602', 0, '555', NULL, '1', NULL, NULL, '女', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '555', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '47dfbc9199d37771092f4bc86a6539af', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(8, '5d98e31b55b8d579b7db9c7d92be17ae', 7, '1480009096', 0, '55', NULL, '1', NULL, NULL, '女', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '5bf0f4b2db30ea49d67815464b13f1ff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(9, 'e55213449ee080646060621b76e0e710', 7, '1480009153', 0, '888', NULL, '1', NULL, NULL, '女', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0009', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '03c9a8dff558313dd913363ba7623c9f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(10, '17da4957873d0d44be9a1739558e8ae2', 7, '1480009282', 0, '55', NULL, '1', NULL, NULL, '女', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL),
(11, 'd5d8679e6770736ed89f2408dee66a2d', 7, '1480009534', 0, '5656546', NULL, '1', NULL, NULL, '女', '10', NULL, '2006-11-28', NULL, NULL, NULL, NULL, NULL, '7878', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_xiao_fei`
--

CREATE TABLE `tp_xiao_fei` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `ctime` varchar(200) DEFAULT NULL,
  `cdate` varchar(120) DEFAULT NULL,
  `prices` int(11) DEFAULT NULL,
  `xf_id` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `shows` int(11) DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tp_xiao_fei';

--
-- 转存表中的数据 `tp_xiao_fei`
--

INSERT INTO `tp_xiao_fei` (`id`, `uuid`, `ctime`, `cdate`, `prices`, `xf_id`, `clicks`, `shows`, `admin_id`) VALUES
(1, 'acb5856f4d147e3dca4b116eff806965', '1478974156', '1478880000', 100, 74, 10, 10, 7),
(2, 'e9589f97a75df2fb7fa152316104c0b9', '1478974184', '1478880000', 1000, 74, 10, 10, 7),
(3, 'b1e2a45e7954d98795b84caa6ef06da1', '1478974247', '1478966400', 10, 75, 10, 10, 7),
(4, 'bfdcdf0047f7a4d733c6dd99856d25e0', '1478974300', '1478620800', 500, 74, 50, 50, 7),
(5, '36550ace297c95e6119a0dd56bf872fc', '1478974483', '1478620800', 20, 75, 20, 20, 7),
(6, '10488ad966d6e4321129714f4a03a367', '1478975503', '1478620800', 500, 75, 12, 500, 7),
(7, '11f2c3128baadc3893ba522c1a449fc9', '1478975568', '1478880000', 1600, 75, 15, 10, 7),
(8, 'e56f7b861100d6eb96e1ae91e8b3ed81', '1478979825', '1478880000', 88, 151, 6, 6, 7);

-- --------------------------------------------------------

--
-- 表的结构 `tp_yu_yue`
--

CREATE TABLE `tp_yu_yue` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `sort` int(10) UNSIGNED DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ks_id` varchar(120) DEFAULT NULL,
  `kst_id` varchar(120) DEFAULT NULL,
  `kstt_id` varchar(120) DEFAULT NULL,
  `ksall_id` varchar(120) DEFAULT NULL,
  `zx_id` varchar(120) DEFAULT NULL,
  `ly_id` varchar(120) DEFAULT NULL,
  `lyt_id` varchar(120) DEFAULT NULL,
  `lyall_id` varchar(120) DEFAULT NULL,
  `lytt_id` varchar(120) DEFAULT NULL,
  `is_fz` tinyint(1) DEFAULT NULL,
  `zx_mark` text,
  `fz_mark` text,
  `fz_id` varchar(120) DEFAULT NULL COMMENT '前台分配人员ID',
  `zx_content` text,
  `jz_content` text,
  `area_id` varchar(120) DEFAULT NULL,
  `areaall_id` varchar(120) DEFAULT NULL,
  `areat_id` varchar(120) DEFAULT NULL,
  `mark` text,
  `ytime` varchar(120) DEFAULT NULL,
  `ydate` varchar(120) DEFAULT NULL,
  `ycode_qz` varchar(120) DEFAULT NULL,
  `ydatetime` varchar(120) DEFAULT NULL,
  `ynumber` varchar(120) DEFAULT NULL,
  `web_id` varchar(120) DEFAULT NULL,
  `web_url` varchar(255) DEFAULT NULL,
  `web_key` varchar(255) DEFAULT NULL,
  `web_name` varchar(255) DEFAULT NULL,
  `web_onname` varchar(255) DEFAULT NULL,
  `ys_id` varchar(120) DEFAULT NULL,
  `ysz_id` varchar(120) DEFAULT NULL,
  `jzks_id` varchar(120) DEFAULT NULL,
  `yx_id` varchar(120) DEFAULT NULL,
  `dz_id` varchar(120) DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `gqctime` varchar(120) DEFAULT NULL,
  `jztime` varchar(120) DEFAULT NULL,
  `dztime` varchar(120) DEFAULT NULL,
  `kdtime` varchar(120) DEFAULT NULL,
  `is_kd` tinyint(2) DEFAULT NULL,
  `qz_id` varchar(120) DEFAULT NULL,
  `kd_id` varchar(120) DEFAULT NULL,
  `sf_status` tinyint(2) DEFAULT NULL,
  `leibie` varchar(120) DEFAULT NULL COMMENT '来院类别',
  `is_qtadd` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_yu_yue`
--

INSERT INTO `tp_yu_yue` (`id`, `uuid`, `sort`, `ctime`, `admin_id`, `user_id`, `name`, `ks_id`, `kst_id`, `kstt_id`, `ksall_id`, `zx_id`, `ly_id`, `lyt_id`, `lyall_id`, `lytt_id`, `is_fz`, `zx_mark`, `fz_mark`, `fz_id`, `zx_content`, `jz_content`, `area_id`, `areaall_id`, `areat_id`, `mark`, `ytime`, `ydate`, `ycode_qz`, `ydatetime`, `ynumber`, `web_id`, `web_url`, `web_key`, `web_name`, `web_onname`, `ys_id`, `ysz_id`, `jzks_id`, `yx_id`, `dz_id`, `status`, `gqctime`, `jztime`, `dztime`, `kdtime`, `is_kd`, `qz_id`, `kd_id`, `sf_status`, `leibie`, `is_qtadd`) VALUES
(1, '2a51cb97ab25b201957097ffd4c1e2b4', NULL, '1479912292', '16', '1', '5656', '1', '4', '12', NULL, '11', '69', '75', '75', '', NULL, NULL, NULL, '7', NULL, NULL, '3', '105', '105', '', '09:00:00', '2016-11-24', NULL, '1479952800', 'WL120000', NULL, NULL, NULL, NULL, NULL, '24', '22', NULL, '65', '15', '4', NULL, '1479912500', '1479912405', '1479912505', NULL, '2', NULL, NULL, '1', 0),
(2, '35af8735b8eb7beac89fbb4d91b643b6', NULL, '1479983479', '16', '2', '李四', '1', '4', '12', '12', '13', '69', '74', '74', NULL, NULL, NULL, NULL, '7', NULL, NULL, '3', '106', '106', NULL, '17:29:54', '2016-11-24', NULL, '1479983394', 'WL120001', NULL, NULL, NULL, NULL, NULL, '17', '21', NULL, '65', '15', '4', NULL, '1479983676', '1479983394', '1479983687', NULL, '4', NULL, NULL, '1', 1),
(3, 'c24a6df6bef9a68c3e552d5e481a60ee', NULL, '1479999345', '16', '3', 'ee', '1', '4', '12', '12', '13', '70', NULL, '', '', NULL, NULL, NULL, '7', NULL, NULL, '7', '142', '142', '', '00:00:00', '2016-11-25', NULL, '1480006800', '120002', NULL, NULL, NULL, NULL, NULL, '17', '23', NULL, '65', '15', '4', NULL, '1479999390', '1479999361', '1479999473', NULL, '5', NULL, NULL, '1', 0),
(4, '91a4739c45162ebe81142456dba06eef', NULL, '1480008164', '16', '4', '666', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:00', '2016-11-25', NULL, '1480006800', '120003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 0),
(5, '755144b08c00467f80d758a9e4950786', NULL, '1480008205', '8', '5', '777', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:00', '2016-11-25', NULL, '1480006800', '120004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 0),
(6, 'ac8a54fcb6bae2bf913bfa14c32c5ca8', NULL, '1480008503', '16', '5', '777777', '1', '4', '12', '12', '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '09:00:00', '2016-11-26', NULL, '1480125600', '120005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 0),
(7, 'd3df4520400b481e4aa112c4a987eae7', NULL, '1480009118', '20', '5', '777777', NULL, NULL, NULL, NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:00', '2016-11-26', NULL, '1480093200', '120006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 0),
(9, 'e4ea225c0ae68e072051dad33aa0ee13', NULL, '1480009282', '8', '10', '55', '1', '4', '12', '4', '11', '68', NULL, '68', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, '00:39:33', '2016-11-25', NULL, '1480009173', '120008', NULL, NULL, NULL, NULL, NULL, '17', '24', NULL, '65', '15', '2', NULL, '1480010152', '1480009173', NULL, NULL, '', NULL, NULL, '1', 1),
(10, 'd25d3b713512d53cf7b9e0dcb7cf719a', NULL, '1480009534', '16', '11', '5656546', '1', '5', '14', '14', '12', '68', '72', '86', '86', NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, '', '00:42:10', '2016-11-25', NULL, '1480009330', '120009', NULL, NULL, NULL, NULL, NULL, '17', '21', NULL, '65', '16', '4', NULL, '1480009775', '1480009330', '1480010456', NULL, '6', NULL, NULL, '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_yu_yue_number`
--

CREATE TABLE `tp_yu_yue_number` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_yu_yue_number`
--

INSERT INTO `tp_yu_yue_number` (`id`, `ctime`, `admin_id`) VALUES
(120000, '1479912292', '7'),
(120001, '1479983479', '7'),
(120002, '1479999345', '7'),
(120003, '1480008165', '7'),
(120004, '1480008205', '7'),
(120005, '1480008503', '7'),
(120006, '1480009118', '7'),
(120007, '1480009153', '7'),
(120008, '1480009282', '7'),
(120009, '1480009535', '7');

-- --------------------------------------------------------

--
-- 表的结构 `tp_zi_xun`
--

CREATE TABLE `tp_zi_xun` (
  `id` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(120) DEFAULT NULL,
  `ctime` varchar(120) DEFAULT NULL,
  `admin_id` varchar(120) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `user_id` varchar(120) DEFAULT NULL,
  `ks_id` varchar(120) DEFAULT NULL,
  `kst_id` varchar(120) DEFAULT NULL,
  `kstt_id` varchar(120) DEFAULT NULL,
  `zx_id` varchar(120) DEFAULT NULL,
  `ly_id` varchar(120) DEFAULT NULL,
  `lyt_id` varchar(120) DEFAULT NULL,
  `lyall_id` varchar(120) DEFAULT NULL,
  `lytt_id` varchar(120) DEFAULT NULL,
  `is_fz` tinyint(1) DEFAULT NULL,
  `zx_mark` text,
  `zx_content` text,
  `jz_content` text,
  `area_id` varchar(120) DEFAULT NULL,
  `areaall_id` varchar(120) DEFAULT NULL,
  `areat_id` varchar(120) DEFAULT NULL,
  `mark` text,
  `web_id` varchar(120) DEFAULT NULL,
  `web_url` varchar(255) DEFAULT NULL,
  `web_key` varchar(255) DEFAULT NULL,
  `web_name` varchar(255) DEFAULT NULL,
  `web_onname` varchar(255) DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `leibie` varchar(120) DEFAULT NULL COMMENT '来院类别',
  `yx_id` varchar(120) DEFAULT NULL COMMENT '意向ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_zi_xun`
--

INSERT INTO `tp_zi_xun` (`id`, `uuid`, `ctime`, `admin_id`, `name`, `user_id`, `ks_id`, `kst_id`, `kstt_id`, `zx_id`, `ly_id`, `lyt_id`, `lyall_id`, `lytt_id`, `is_fz`, `zx_mark`, `zx_content`, `jz_content`, `area_id`, `areaall_id`, `areat_id`, `mark`, `web_id`, `web_url`, `web_key`, `web_name`, `web_onname`, `status`, `leibie`, `yx_id`) VALUES
(1, '38a81e46d2ce6d16a7f70d5ea3cde5e5', '1480008465', '16', '666', '6', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '6bbee0b139e194ce900fe3a8a31d9bd0', '1480008602', '8', '555', '7', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'ee1fceed57160e6042ed0e195d2bdf4d', '1480008622', '20', '777777', '5', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '27938247896d30f489fa3040c2d90a0f', '1480008693', '8', '777777', '5', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'f9abba0550b347375796f69cec39e546', '1480008740', '16', '777777', '5', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'df727b69d1939d5bee45d284e322a905', '1480008766', '16', '777777', '5', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '14e142218de8cbe2bbd4d10399b9e5fb', '1480008896', '8', '777777', '5', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'd47814119d035edf637ff86cce849b97', '1480009096', '8', '55', '8', NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_zxfs`
--

CREATE TABLE `tp_zxfs` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `ctime` varchar(200) DEFAULT NULL,
  `a_ji` int(10) UNSIGNED DEFAULT NULL,
  `gj_id` int(10) UNSIGNED DEFAULT NULL,
  `b_ji` int(10) UNSIGNED DEFAULT NULL,
  `c_ji` int(10) UNSIGNED DEFAULT NULL,
  `total` int(10) UNSIGNED DEFAULT NULL,
  `cdate` varchar(120) DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tp_admin`
--
ALTER TABLE `tp_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ys_id` (`ys_id`);

--
-- Indexes for table `tp_admin_group`
--
ALTER TABLE `tp_admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_admin_rule`
--
ALTER TABLE `tp_admin_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_area`
--
ALTER TABLE `tp_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card` (`card`),
  ADD KEY `areaid` (`areaid`);

--
-- Indexes for table `tp_cai_wu`
--
ALTER TABLE `tp_cai_wu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_card`
--
ALTER TABLE `tp_card`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `tp_file`
--
ALTER TABLE `tp_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_gzl`
--
ALTER TABLE `tp_gzl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gj_id` (`gj_id`,`admin_id`);

--
-- Indexes for table `tp_hui_fang`
--
ALTER TABLE `tp_hui_fang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_jie_zhen`
--
ALTER TABLE `tp_jie_zhen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_ji_gou`
--
ALTER TABLE `tp_ji_gou`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_kai_dan`
--
ALTER TABLE `tp_kai_dan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_ke_shi`
--
ALTER TABLE `tp_ke_shi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_lang`
--
ALTER TABLE `tp_lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_lan_mu`
--
ALTER TABLE `tp_lan_mu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card` (`card`),
  ADD KEY `areaid` (`areaid`);

--
-- Indexes for table `tp_lan_mu_extends`
--
ALTER TABLE `tp_lan_mu_extends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_log`
--
ALTER TABLE `tp_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_man_ban`
--
ALTER TABLE `tp_man_ban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_nav`
--
ALTER TABLE `tp_nav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_price`
--
ALTER TABLE `tp_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_ren_wu`
--
ALTER TABLE `tp_ren_wu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tp_show_price`
--
ALTER TABLE `tp_show_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_sms`
--
ALTER TABLE `tp_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_sms_log`
--
ALTER TABLE `tp_sms_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `tp_user`
--
ALTER TABLE `tp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_xiao_fei`
--
ALTER TABLE `tp_xiao_fei`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gj_id` (`admin_id`);

--
-- Indexes for table `tp_yu_yue`
--
ALTER TABLE `tp_yu_yue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_yu_yue_number`
--
ALTER TABLE `tp_yu_yue_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_zi_xun`
--
ALTER TABLE `tp_zi_xun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_zxfs`
--
ALTER TABLE `tp_zxfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gj_id` (`gj_id`,`admin_id`),
  ADD KEY `c_ji` (`c_ji`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tp_admin`
--
ALTER TABLE `tp_admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用表AUTO_INCREMENT `tp_admin_group`
--
ALTER TABLE `tp_admin_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `tp_admin_rule`
--
ALTER TABLE `tp_admin_rule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- 使用表AUTO_INCREMENT `tp_area`
--
ALTER TABLE `tp_area`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=762;
--
-- 使用表AUTO_INCREMENT `tp_cai_wu`
--
ALTER TABLE `tp_cai_wu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tp_card`
--
ALTER TABLE `tp_card`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `tp_file`
--
ALTER TABLE `tp_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- 使用表AUTO_INCREMENT `tp_gzl`
--
ALTER TABLE `tp_gzl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `tp_hui_fang`
--
ALTER TABLE `tp_hui_fang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `tp_jie_zhen`
--
ALTER TABLE `tp_jie_zhen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `tp_ji_gou`
--
ALTER TABLE `tp_ji_gou`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tp_kai_dan`
--
ALTER TABLE `tp_kai_dan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `tp_ke_shi`
--
ALTER TABLE `tp_ke_shi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- 使用表AUTO_INCREMENT `tp_lang`
--
ALTER TABLE `tp_lang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- 使用表AUTO_INCREMENT `tp_lan_mu`
--
ALTER TABLE `tp_lan_mu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- 使用表AUTO_INCREMENT `tp_lan_mu_extends`
--
ALTER TABLE `tp_lan_mu_extends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tp_log`
--
ALTER TABLE `tp_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `tp_man_ban`
--
ALTER TABLE `tp_man_ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tp_nav`
--
ALTER TABLE `tp_nav`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tp_price`
--
ALTER TABLE `tp_price`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- 使用表AUTO_INCREMENT `tp_ren_wu`
--
ALTER TABLE `tp_ren_wu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `tp_show_price`
--
ALTER TABLE `tp_show_price`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- 使用表AUTO_INCREMENT `tp_sms`
--
ALTER TABLE `tp_sms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `tp_sms_log`
--
ALTER TABLE `tp_sms_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `tp_user`
--
ALTER TABLE `tp_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `tp_xiao_fei`
--
ALTER TABLE `tp_xiao_fei`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `tp_yu_yue`
--
ALTER TABLE `tp_yu_yue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `tp_yu_yue_number`
--
ALTER TABLE `tp_yu_yue_number`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120010;
--
-- 使用表AUTO_INCREMENT `tp_zi_xun`
--
ALTER TABLE `tp_zi_xun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `tp_zxfs`
--
ALTER TABLE `tp_zxfs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
