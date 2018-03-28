<?php

namespace app\admin\controller;

use app\admin\model\Auth;
use think\Controller;
use think\Request;

class Role extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list=\app\admin\model\Role::select();

        return view('index',['list'=>$list]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    public function setauth($role_id)
    {
        $info=\app\admin\model\Role::find($role_id);
        $top_auth=Auth::where('pid',0)->select();
        $sec_auth=Auth::where('pid','gt',0)->select();
        return view('setauth',['info'=>$info,'top_auth'=>$top_auth,'sec_auth'=>$sec_auth]);

    }

    public function saveauth($role_id)
    {
        $id=request()->param('id/a');
        $role_auth_ids=implode(',',$id);
        $auth=Auth::where('id','in',$id)->select();
        $role_auth_ac='';
        foreach ($auth as $v){
            if ($v->pid>0)
            $role_auth_ac .= $v->auth_c.'-'.$v->auth_a.',';
        }
        $role_auth_ac= rtrim($role_auth_ac,',');

        \app\admin\model\Role::update(['id'=>$role_id,'role_auth_ids'=>$role_auth_ids,'role_auth_ac'=>$role_auth_ac]);
        $this->success('操作成功','admin/role/setauth?role_id='.$role_id);
    }

}
