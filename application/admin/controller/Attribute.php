<?php

namespace app\admin\controller;

use app\admin\model\Type;
use think\Controller;
use think\Request;

class Attribute extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        $list = \app\admin\model\Attribute::select();
        $list = \app\admin\model\Attribute::alias('a')->field('a.*,t.type_name')->join('tpshop_type t','a.type_id = t.id','left')->select();
        return view('index',['list'=>$list]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        
        $type = Type::select();
        return view('create',['type'=>$type]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data=$request->param();
        \app\admin\model\Attribute::create($data,true);
        $this->success('添加成功','index');
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
        $info = \app\admin\model\Attribute::find($id);

        $type = Type::select();
        return view('edit',['info'=>$info,'type'=>$type]);
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
        $data=$request->param();
        \app\admin\model\Attribute::update($data,['id'=>$id],true);
        $this->success('修改成功','index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        \app\admin\model\Attribute::find($id)->delete();
        $this->success('删除成功','index');
    }
}
