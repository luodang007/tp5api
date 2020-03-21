<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class PayException extends BaseException {
	public $msg = '支付失败';
	public $errorCode = 20270;
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