<?php
use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class DemoTest extends TestCase
{

    public function testDemo()
    {
        //引用类文件
        require  './src/App/Demo.php';

        //实例化类
        $AppLogger = new AppLogger();
        $HttpRequest = new HttpRequest();
        $userInfo = new Demo($AppLogger,$HttpRequest);
        //调用方法
        $userInfoData = $userInfo->get_user_info();

        //检查用户id要大于0
        $this->assertGreaterThan(0, $userInfoData['id']);
        //检查username不能为空
        $this->assertNotEmpty($userInfoData['username']);
    }
}