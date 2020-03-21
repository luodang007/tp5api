<?php
namespace app\api\model;

use think\Model;
use think\Db;
use PDO;
class SqlTest extends Model{
    public function getCusomter($uid = 1){
        $res = Db::table('Customer')->where('CusId', $uid)->findOrFail();
        // echo $this->getLastSql();
        return $res;
    } 

    public function getAllCusomter($strWhere){
        //$res = Db::query("select top 10 CusId,CusShortName from Customer where Stopped=0");
    	//$strWhere = '  and CusId like \'\'D%\'\'';    	    	
      try {
          $res = Db::query('EXEC GetCustomer \''.$strWhere.'\''); 
      } catch(\Exception $e){
      	//echo $e->getMessage();
      	//return $e->getMessage();
      	//throw new \app\common\exception\EmptyReturnException();
      	//die();          
      }             
			if( [] === $res || is_null($res)){
				throw new \app\common\exception\EmptyReturnException();
			}      	

      return $res[0];    
    } 

    public function GetDataJson($searchType,$strWhere){
        //$res = Db::query("select top 10 CusId,CusShortName from Customer where Stopped=0");
      //$strWhere = '  and CusId like \'\'D%\'\'';   
      $strSql = '';
      if ($searchType==='Top10') {
        $strSql = 'SELECT  top 10 * FROM ( SELECT ProposeCus \'客户\',COUNT(1) \'总需求数\',sum(CASE WHEN IsMajorMod=\'是\' THEN 1 ELSE 0 end) \'重大需求\' FROM dbo.DemandTable where 1=1 GROUP BY ProposeCus) a ORDER BY \'总需求数\' DESC';
      }   
      $fileType = mb_detect_encoding($strSql , array('UTF-8','GBK','LATIN1','BIG5')) ;     
      $res = [];
      try {
          //$res = Db::query(urldecode($strSql));           //好奇怪，前台转成utf8再转回来，还是会报错
        //$res = Db::query($strSql);   //后台直接赋值也会报错，现在改成存储过程试试 
        //print_r('EXEC GetTopDemand \''.$searchType.'\',\''.$strWhere.'\'') ;
        //die;

        $res = Db::query('EXEC GetTopDemand \''.$searchType.'\',\''.$strWhere.'\'');
      } catch(\Exception $e){
        //echo $e->getMessage();
        return $e->getMessage();
        //throw new \app\common\exception\EmptyReturnException();
        //die();          
      }             
      if( [] === $res || is_null($res)){
        throw new \app\common\exception\EmptyReturnException();
      }      


      //print_r($searchType);
      //存储过程也不行，现在是循环转换的，好奇怪
      //print_r($res[0]);

      $myArr = [];
      foreach ($res[0] as $k => $v) {
        //print_r($v);
        $subArr = [];
        foreach ($res[0][$k] as $k2 => $v2) {
          //print_r($k2.' '.$v2);
          $column='';
          if ($k2==='CusName') {
            $column='客户';
          } else if ($k2==='ReqCount') {
            $column='总需求数';
          } else if ($k2==='BigReqC') {
            $column='重大需求';            
          } else if ($k2==='MM') {
            $column='时间';            
          } else {
            $column=$k2;
          }
          
          $subArr[$column]=$v2;
        }
        $myArr[$k]=$subArr;
      }
      //print_r($myArr);
      
      return $myArr;    
    }

    public function GetDemand($iPageSize,$iCurPage,$strWhere){
        //$res = Db::query("select top 10 CusId,CusShortName from Customer where Stopped=0");
      //$strWhere = '  and CusId like \'\'D%\'\'';      
      $res = [];      
      try {
        $iTotalCount         = 0;
        $res=Db::query('exec GetDemand ?, ?, ?, ?',[
          $iPageSize,$iCurPage,$strWhere,        
          [&$iTotalCount, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT,2],
        ]);
      
      } catch(\Exception $e){
        //echo $e->getMessage();
        //return $e->getMessage();
        //throw new \app\common\exception\EmptyReturnException();
        //die();          
      }   
      
      if( [] === $res || is_null($res)){
        //throw new \app\common\exception\EmptyReturnException();
        $res[0] = [];
      }       
      $data = [];
      $data['iTotalCount']= $iTotalCount;
      $data['res'] = $res[0];
      
      return $data;    
    } 

}