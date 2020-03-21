<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class StockOutException extends BaseException {
	public $msg = '出库失败~';
	public $errorCode = '20290';
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}