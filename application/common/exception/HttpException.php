<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class HttpException extends BaseException {
	public $msg = '请求错误';
	public $errorCode = 10001;
	public function __construct($params = []){
		if (!is_array($params)) {
            return;
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
	}
}