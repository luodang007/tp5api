<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class DataBaseException extends BaseException {
	public $msg = '数据插入失败~';
	public $errorCode = '20220';
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