<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class ExecException extends BaseException {
	public $msg = '存储过程执行失败';
	public $errorCode = '10210';
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