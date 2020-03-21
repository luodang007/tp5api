<?php
namespace app\api\controller;//注意写准确命名空间
use think\Controller;

//这个还是得要，客户端代理模式只能开发的时候用，需用用服务器去访问第三方接口
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');   


class UserController extends Controller //类名字 和控制器名字一样
{

    public function characet($data){
        
        if( !empty($data) ){
            $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
            
            if( $fileType != 'UTF-8'){
                
                $data = mb_convert_encoding($data ,'utf-8' , $fileType);
            }
        }
      return $data;
    }

    public function http_request($url, $data = null)  
    {  
        $curl = curl_init();  
        curl_setopt($curl, CURLOPT_URL, $url);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
        if (! empty($data)) {  
            curl_setopt($curl, CURLOPT_POST, 1);  
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  
        }  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);  
        $output = curl_exec($curl);  
        curl_close($curl);  
        return ($output);  
    }   

      /**
     * 发送HTTP请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    public function http_request2($url, $params = null, $method = 'GET', $header = array(), $multi = false)
    {        
        $opts = array(
                CURLOPT_TIMEOUT        => 60,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER     => $header
        );


        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                if ($params!=null) {
                    $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);    # code...
                } else {
                    $opts[CURLOPT_URL] = $url;# code...
                }                                
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error) throw new Exception('请求发生错误：' . $error);       
        //这里如何判断字符集自动转换？
        $data = mb_convert_encoding($data, 'utf-8','GB18030');
        return  $data;
    }

    public function read()
    {
        $uid = input('uid');
        //print_r($uid);
        $model = model('user');
        $data = $model->getUsers($uid);// 查询数据---模型下的方法
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

    public function getHQ()
    {
        //return '12222222222222222222222222222222222222222'        
        // $data = [
        //     'code' => 100,
        //     'data' => 123
        // ];
        //return json($data);
        //$data =  json_encode($obj);  
        //print_r('12222222222222222222222222222222222222222');
        $data = [];  
        $url = "http://hq.sinajs.cn/api/list=sz000876,sz127015,sz002157,sz300498";  
          
        //$res = $this->http_request($url, $data);  
        
        //定义一个要发送的目标URL；        
        //定义传递的参数数组；
        
        //定义返回值接收变量；
        $res = $this->http_request2($url, $data, 'GET', array("Content-Type:application/javascript; charset=utf-8","Content-Encoding:gzip"));
          
        print_r($res);
        //echo $res;  
    }
}