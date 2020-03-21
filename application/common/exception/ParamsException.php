<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class ParamsException extends BaseException {
	public $msg = '参数错误~';
	public $errorCode = 20201;
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}