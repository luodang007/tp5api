<?php
namespace app\api\controller;//注意写准确命名空间
use think\Controller;


header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');   
//header('Content-Type:text/html; charset=utf-8');


class SqlTestController extends Controller //类名字 和控制器名字一样
{
    public function getCusomter()
    {
        $cusid = input('cusid');
        //print_r($uid);
        $model = model('SqlTest');
        $data = $model->getCusomter($cusid);// 查询数据---模型下的方法
        //print_r($data);
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data
        ];
        return json($data);
    }

    public function getAllCusomter()
    {        
        $strwhere = input('strwhere');
        $model = model('SqlTest');
        $data = $model->getAllCusomter($strwhere);// 查询数据---模型下的方法
        //print_r($data);
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data
        ];
        return json($data);
    }    

    public function GetDataJson()
    {        
        //$strsql = input('strsql');
        $searchType = input('searchType');
        $strWhere = input('strWhere');
        $model = model('SqlTest');
        $data = $model->GetDataJson($searchType,$strWhere);// 查询数据---模型下的方法
        //print_r($data);
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data
        ];
        return json($data);
    }  

    public function GetDemand()
    {        
        //$strsql = input('strsql');
        $iPageSize = input('iPageSize');
        $iCurPage = input('iCurPage');
        $strWhere = input('strWhere');
        $model = model('SqlTest');
        $data = $model->GetDemand($iPageSize,$iCurPage,$strWhere);// 查询数据---模型下的方法
        //print_r($data);
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'iTotalCount' => $data['iTotalCount'],
            'data' => $data['res']
        ];
        return json($data);
    }       
}