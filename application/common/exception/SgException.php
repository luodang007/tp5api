<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class SGException extends BaseException {
	public $msg = '生管监控服务错误';
	public $errorCode = '10500';
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}