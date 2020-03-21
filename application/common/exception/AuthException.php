<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class AuthException extends BaseException {
	public $msg = '您没有访问权限~';
	public $errorCode = '20204';
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}