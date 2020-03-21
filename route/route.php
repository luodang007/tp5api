<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::rule('user/:uid','api/UserController/read');
Route::rule('user','api/UserController/read');
Route::rule('gethq','api/UserController/getHQ');

Route::rule('sqltest/:cusid','api/SqlTestController/getCusomter');
Route::rule('sqltestAllCus','api/SqlTestController/getAllCusomter');
Route::rule('getjsonsql','api/SqlTestController/GetDataJson');
Route::rule('getjsonsql/:searchType&:strWhere','api/SqlTestController/GetDataJson');
Route::rule('getdemand','api/SqlTestController/GetDemand');

return [

];
