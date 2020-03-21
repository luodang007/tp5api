<?php
namespace app\common\exception;

use app\common\exception\BaseException;

class ErpNotAvailable extends BaseException {
	public $msg = 'ERP下单系统不可用';
	public $errorCode = '20200';
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}