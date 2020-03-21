<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class TokenException extends BaseException {
	public $msg = '令牌验证错误~';
	public $errorCode = 20205;
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errorCode', $params)) {
            $this->errorCode = $params['errorCode'];
        }
	}
}