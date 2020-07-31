<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
class LoginController extends Controller
{
    public function regdo(Request $request)
    {
         $user_name=$request->post('user_name');
        $user_email=$request->post('user_email');
        $password=$request->post('password');
        $res=UserModel::where(['user_name'=>$user_name])->first();
        if($res){
            echo "用户名已存在";exit;

        }
        $data=[
            'user_name'=>$user_name,
            'user_email'=>$user_email,
            'password'=>$password
        ];
        $user=UserModel::insert($data);
        if($user){
            return redirect("http://www.1911.com/index/login");
        }else{
            return redirect("http://www.1911.com/index/reg");
        }

    }

//    执行登录
    public function logindo(Request $request)
    {
        $user_name=$request->post('user_name');
        $password=$request->post('password');
        $res=UserModel::where(['user_name'=>$user_name,'password'=>$password])->first();
        if($res){
            echo "登录成功";
            return redirect("http://www.1911.com/index/center");
        }else{
            echo "登录失败";
            return redirect("http://www.1911.com/index/login");
        }
    }
}
