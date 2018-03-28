<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Manager extends Base
{
    //管理员列表
   public function index()
   {
       $list=\app\admin\model\Manager::select();
       return view('manager_list',['list'=>$list]);
   }

   //管理员新增
   public function create()
   {
       return view('manager_add');
   }

   //管理员修改
   public function edit($id)
   {
       $info=\app\admin\model\Manager::find($id);
       return view('manager_edit',['info'=>$info]);
   }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $info=\app\admin\model\Manager::get($id);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $manager=\app\admin\model\Manager::find($id);
        $manager->delete();
        $this->success('删除成功','index');
    }

    public function save(Request $request)
    {
        $data=input();
        \app\admin\model\Manager::create($data,true);
        $this->success('添加成功','index');
    }

    public function update(Request $request,$id)
    {
        $data=input();
        \app\admin\model\Manager::create($data,['id'=>$id],true);
        $this->success('修改成功','index');
    }

}
