<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class TestController extends Controller
{
    public function test1()
    {
        echo 1234;
    }

    public function info()
    {
        $url = "http://www.1911.com/info";
        $response = file_get_contents($url);
        echo $response;
    }


//    解密
    public function dec(Request $request)
    {
        $method = 'AES-256-CBC';   //加密算法
        $key = '1911api';  //加密的key
        $iv = 'aaabbbcc/0/0/0//';
        $data = $request->get('data');
//    dd($data);die;
        $dec_data = base64_decode($data);
        $dec = openssl_decrypt($dec_data, $method, $key, OPENSSL_RAW_DATA, $iv);
        echo "解密的数据:" . $dec;
    }


    public function dec2()
    {
        $data = request()->post('data');
        $content = file_get_contents(storage_path('keys/priv.key'));
        $priv_key = openssl_get_privatekey($content);  //获取私钥内容
        $enc_data = base64_decode($data);
        openssl_private_decrypt($enc_data, $dec_data, $priv_key);
//        echo $dec_data;


//        回复
        $data = '你是谁，你是大傻';  //回复内容
        $key_content = file_get_contents(storage_path('keys/www_pub.key'));  //获取www的公钥
        $pub_key = openssl_get_publickey($key_content);  //获取公钥
        openssl_public_encrypt($data, $ad_data, $pub_key);
        $client = new Client();
        $response = base64_encode($ad_data);
        return $response;
    }


    public function sign()
    {
        $data = request()->get('data');
        $key = '1911api';
        $sign = request()->get('sign');
        $sign_in = md5($key . $data);
        if ($sign == $sign_in) {
            echo "验签通过";
        } else {
            echo "验签失败";
        }
    }

    public function sign2()
    {
//        接收数据
        $data = request()->get('data');
        $sign = request()->get('sign');
        $sign = base64_decode($sign);  //对数据进行解码
        $data = base64_decode($data);  //对数据进行解码
//        dd($data);
        $pub_key = file_get_contents(storage_path('keys/www_pub.key'));   //获取www的公钥
        $pub_content = openssl_get_publickey($pub_key);   //解析公钥
        $vertrue = openssl_verify($data,$sign,$pub_content);  //验证签名
        echo $vertrue;
    }

    public function header1()
    {
    if(isset($_SERVER['HTTP_TOKEN'])){
        $token=$_SERVER['HTTP_TOKEN'];
        $uid = $_SERVER['HTTP_UID'];
    }else{
        echo "授权失败";die;
    }
        echo $token;
        echo "<br>";
        echo $uid;
    }
}
