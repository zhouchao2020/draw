<?php
/**
* @file Smarty.ini.php
* @brief smarty 配置变量
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-09
 */
define("ROOT_PATH", dirname(__FILE__));//定义smarty根目录

require ROOT_PATH . "/Smarty/Smarty.class.php";//引入smarty模板

$_smarty= new Smarty();

$_smarty->template_dir= ROOT_PATH. '/views/html/';

$_smarty->compile_dir = ROOT_PATH . '/views/html_c';

$_smarty->config_dir = ROOT_PATH . '/views/configs/';

$_smarty->cache_dir = ROOT_PATH . 'views/cache/';

$_smarty->left_delimiter = "{#" ;

$_smarty->right_delimiter = "#}";

$_smarty->caching = false;

