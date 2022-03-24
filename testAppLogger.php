<?php
use App\Service\AppLogger;
require __DIR__ . '/vendor/autoload.php';


ini_set("display_errors", "On");


//调用log4php写入日志
$logger = new AppLogger('log4php');
$logger->info('测试LOG4PHP-info!');
$logger->debug("测试LOG4PHP-debug!");
$logger->error("测试LOG4PHP-error!");

////调用thinkLogthinkLog写入日志
$logger = new AppLogger('thinkLog');
$logger->info('测试thinkLog-info');
$logger->debug("测试thinkLog-debug");
$logger->error("测试thinkLog-error");


