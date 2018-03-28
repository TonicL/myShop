<?php
/**
 * Created by PhpStorm.
 * User: Tonic
 * Date: 2018/3/12
 * Time: 下午4:08
 * 屠龙的少年仍在燃烧
 */
namespace app\admin\controller;

use app\admin\model\Auth;
use app\admin\model\Role;
use think\Controller;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!session('manager_info')){
            $this->redirect('admin/login/login');
        }
        $this->checkauth();
        $this->getnav();
    }

    //获取左侧菜单权限
    public function getnav()
    {
        $role_id=session('manager_info.role_id');
        if ($role_id==1){
            $top_nav=Auth::where(['pid'=>0,'is_nav'=>1])->select();
            $sec_nav=Auth::where(['pid'=>['>',0],'is_nav'=>1])->select();
        }else{
            $role=Role::find($role_id);
            $role_auth_ids=$role->role_auth_ids;
            $top_nav=Auth::where(['pid'=>0,'is_nav'=>1,'id'=>['in',$role_auth_ids]])->select();
            $sec_nav=Auth::where(['pid'=>['>',0],'is_nav'=>1,'id'=>['in',$role_auth_ids]])->select();
        }
        $this->assign('top_nav',$top_nav);
        $this->assign('sec_nav',$sec_nav);

        $nickname=session('manager_info.nickname');
        $this->assign('nickname',$nickname);
    }

    //检测当前访问权限
    public function checkauth()
    {
        $role_id = session('manager_info.role_id');
        if ($role_id==1){
            return;
        }
        $controller=request()->controller();
        $action=request()->action();
        $ac = $controller.'-'.$action;
        if (strtolower($ac)=='index-index'){
            return;
        }

        $role=Role::find($role_id);
        $role_auth_ac = explode(',',$role->role_auth_ac);
        if (!in_array($ac,$role_auth_ac)){
            $this->error('没有权限','admin/goods/index');
        }
    }
}