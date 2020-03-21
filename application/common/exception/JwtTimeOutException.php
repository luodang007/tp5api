<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class JwtTimeOutException extends BaseException {
	public $msg = '令牌过期~';
	public $errorCode = 20215;
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