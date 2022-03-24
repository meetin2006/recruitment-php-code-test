<?php

namespace App\Service;
use think\LogManager;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_thinkLog = 'thinkLog';

    private $logger;
    private $logger_type;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        if ($type == self::TYPE_LOG4PHP) {
            \Logger::configure('./src/Service/log4php_config.xml');
            $this->logger = \Logger::getLogger("Log");
            $this->logger_type = 'log4php';
        }else{

            $this->logger =  new LogManager;
            $this->logger->init([
                'default'	=>	'file',
                'channels'	=>	[
                    'file'	=>	[
                        'type'	=>	'file',
                        'path'	=>	'./logs/',
                        'realtime_write' => 1,
                    ],
                ],
            ]);

            $this->logger_type = 'thinkLog';
        }
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        //當 AppLogger 以 think-log 寫入日志時，一律把日志內容改為大寫
        if($this->logger_type = self::TYPE_thinkLog){
            $message = strtoupper($message);
        }
        $this->logger->error($message);
    }
}