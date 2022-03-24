<?php
class HttpRequest {
    function get($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
class Demo {
    private $_logger;
    private $_req;
    function __construct($logger, HttpRequest $req) {
        $this->_logger = $logger;
        $this->_req = $req;
    }
    function set_req(HttpRequest $req) {
        $this->_req = $req;
    }
    function foo() {
        return "bar";
    }
    function get_user_info() {
        //$url = "http://some-api.com/user_info";
        //$result = $this->_req->get($url);

        //上面接口不能访问，所以模拟数据
        $result = '{"error": 0,
                    "data": {  "id": 1,
                                "username": "hello world"
                                }
                    }';
        $result_arr = json_decode($result, true);

        if (is_array($result_arr) && array_key_exists('error', $result_arr) && $result_arr['error'] == 0) {
            if (array_key_exists('data', $result_arr)) {
                return $result_arr['data'];
            }
        } else {
            $this->_logger->error("fetch data error.");
        }
        return null;
    }
}
