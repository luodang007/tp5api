<?php
namespace app\common\exception;
use app\common\exception\BaseException;
class GroupBuyException extends BaseException {
	public $msg = '团购失败';
	public $errorCode = 20260;//20260-20269
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