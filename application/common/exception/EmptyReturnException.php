<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class EmptyReturnException extends BaseException {
	public $msg = '没有更多数据了~';
	public $errorCode = '20250';
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