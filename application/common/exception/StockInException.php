<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class StockInException extends BaseException {
	public $msg = '入库失败~';
	public $errorCode = '20291';
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}