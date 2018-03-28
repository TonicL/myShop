<?php

namespace app\admin\controller;

use app\admin\model\Manager;
use think\Controller;

class Login extends Controller
{
    public function login()
    {
        if (request()->isGet()) {
            $this->view->engine->layout(false);
            return view('1');
        }

        $data = input();
//        if (!captcha_check($data['code'])){
//            $this->error('验证码错误');
//        }

        $info = Manager::where(['username'=>$data['username'],'password'=>encrypt_password($data['password'])])->find();
        if (!$info){
            $this->error('用户名或密码错误');
        }
        session('manager_info',$info);
        $this->success('登录成功','admin/index/index');
    }

    public function logout()
    {
        session(null);
        $this->redirect('admin/login/login');
    }

    public function ajaxlogin()
    {
        $data = input();
//        if (!captcha_check($data['code'])){
//            return ['code' => 10001 ,'msg'=>'验证码错误'];
//        }

        $info = Manager::where(['username'=>$data['username'],'password'=>encrypt_password($data['password'])])->find();
        if (!$info){
            return ['code' => 10002 , 'msg'=> '用户名或密码错误'];
        }
//        var_dump($info);die;
        session('manager_info',$info);
//        $this->success('登录成功','admin/index/index');
        return ['code' => 10000, 'msg'=>'登录成功'];
    }
}
