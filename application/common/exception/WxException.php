<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class WxException extends BaseException {
	public $msg = '微信回调错误~';
	public $errorCode = '10200';
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