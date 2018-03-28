<?php

namespace app\home\controller;

use app\home\model\Cart;
use app\home\model\User;
use think\Controller;
use think\Request;
use think\Validate;

class Login extends Controller
{
    public function login()
    {
        $this->view->engine->layout(false);
        return view();
    }

    public function register()
    {
        $this->view->engine->layout(false);
        return view();
    }

    //邮箱注册
    public function email()
    {
        $data = request()->param();
        $rule = [
            'email' => 'require|email|unique:user',
            'password' => 'require|length:6,16|confirm:repassword',
        ];
        $msg = [
            'email.require' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已被注册',
            'password.require' => '密码不能为空',
            'password.length' => '密码长度必须为6--16位',
            'password.confirm' => '两次输入的密码不一致'
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data)){
            $this->error($validate->getError());
        }
        $data['email_code'] = mt_rand(1000,9999);   //生成验证码
        $data['password'] = encrypt_password($data['password']);    //加密密码
        $user = User::create($data,true);

        //发送激活邮件
        $subject = 'TP5商城注册邮件';
        $url = url('Home/login/act',['id'=>$user->id,'code' => $data['email_code']],'',true);
        $body = "欢迎激活,请点击进行邮件激活:<br><a href='$url'>$url</a>";
        //发送邮件

        $res = send_email($data['email'],$subject,$body);
        if ($res === true) {
            $this->success('注册成功,请登录邮箱进行激活','login');
        } else {

            $this->error('注册成功,邮件发送失败','login');
        }
    }

    //邮箱激活
    public function act($id,$code)
    {
        //以id和email_code两个条件查询user表
        $user = User::where(['id'=>$id,'email_code'=>$code])->find();
        if (empty($user)){
            $this->error('激活失败','register');
        }
        //激活账号
        $user->is_check = 1;
        $user->save();
        $this->success('激活成功','login');
    }


    //登录表单提交
    public function dologin()
    {
        //接受参数
        $data = request()->param();
        $password = encrypt_password($data['password']);

        //根据用户名和密码查询用户表
        $user = User::where(function($query) use ($data){
            $query->where('email',$data['username'])->whereOr('phone',$data['username']);
        })->where('password',$password)->find();
        if (!empty($user)){
            //设置登录标识
            session('user_info',$user->toArray());  //因为闭包有抛异常机制,所以将$user转换成字符串

            //将cookie中的购物车数据迁移到数据表中,调用Cart model的cookieTodb方法
            Cart::cookieTodb();
            //先取session中的跳转地址 没有的话再跳转首页
            $back_url = session('?back_url') ? session('back_url') : 'home/index/index';
            $this->success('登录成功',$back_url);
        } else {
            $this->error('用户名或密码错误');
        }
    }

    //退出登录
    public function logout()
    {
        //清空session
        session(null);
        //跳转到登录页
        $this->redirect('login');
    }
}
