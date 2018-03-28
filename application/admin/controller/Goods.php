<?php

namespace app\admin\controller;

use app\admin\model\Attribute;
use app\admin\model\Category;
use app\admin\model\GoodsAttr;
use app\admin\model\Goodspics;
use app\admin\model\Type;
use think\Controller;
use think\Image;
use think\Request;
use think\Validate;
use think\Page;

class Goods extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list=\app\admin\model\Goods::order('id desc')->paginate(5);
        //$list=\app\admin\model\Goods::select();
        return view('goods_list',['list'=>$list]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $category = Category::select();
        //查询商品属性数据,用于商品下拉列表展示
        $type= Type::select();
        return view('goods_add',['category'=>$category,'type'=>$type]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $info=\app\admin\model\Goods::find($id);
        $category=Category::select();
        $goodspics=\app\admin\model\Goodspics::where('goods_id',$id)->select();
        return view('goods_edit',['info'=>$info,'category'=>$category,'goodspics'=>$goodspics]);

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $info=\app\admin\model\Goods::get($id);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $goods=\app\admin\model\Goods::find($id);
        $goods->delete();
        $this->success('删除成功','index');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        //验证器
        $rule=[
            'goods_name'=>'require|max:25|unique:goods',
            'goods_price'=>'require|float|gt:0',
            'goods_number'=>'require|number|gt:0',
            'cate_id'=>'require|integer|gt:0'
        ];
        $msg=[
            'goods_name.require'=>'商品名称不能为空',
            'goods_name.max'=>'商品名称长度不能超过25',
            'goods_name.unique'=>'商品名称已经存在',
            'goods_price.require'=>'商品价格不能为空',
            'goods_price.float'=>'商品价格必须为浮点数',
            'goods_price.gt'=>'商品价格必须大于0',
            'goods_number.require'=>'商品数量不能为空',
            'goods_number.number'=>'商品数量必须为整数',
            'goods_number.gt'=>'商品数量必须大于0'
        ];

        $validate=new \think\Validate($rule,$msg);
        if (!$validate->check($data)){
            $this->error($validate->getError());
        }

        $data['goods_logo'] = $this->upload_logo();
        $goods = \app\admin\model\Goods::create($data,true);

        $this->upload_pics($goods->id);

        $attrs = $data['attr_name'];
        $goodsattrs = [];
        foreach ($attrs as $k =>$v){
            foreach ($v as $value){
                $row = [
                    'goods_id' => $goods['id'],
                    'attr_id' => $k,
                    'attr_value' =>$value
                ];
                $goodsattrs[] = $row;
            }
        }
        //saveall 必须先实例化才能调用
        $goodsattrmodel = new GoodsAttr();
        $goodsattrmodel->saveAll($goodsattrs);

        $this->success('添加成功','index');
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
        $data=input();

        //验证器
        $rule=[
            'goods_name'=>'require|max:25',
            'goods_price'=>'require|float|gt:0',
            'goods_number'=>'require|number|gt:0',
            'cate_id'=>'require|integer|gt:0'
        ];
        $msg=[
            'goods_name.require'=>'商品名称不能为空',
            'goods_name.max'=>'商品名称长度不能超过25',
            'goods_price.require'=>'商品价格不能为空',
            'goods_price.float'=>'商品价格必须为浮点数',
            'goods_price.gt'=>'商品价格必须大于0',
            'goods_number.require'=>'商品数量不能为空',
            'goods_number.number'=>'商品数量必须为整数',
            'goods_number.gt'=>'商品数量必须大于0'
        ];

        $validate=new \think\Validate($rule,$msg);
        if (!$validate->check($data)){
            $this->error($validate->getError());
        }
        if (array_key_exists('goods_logo',$data)){
            $data['goods_logo'] = $this->upload_logo();
        }


        \app\admin\model\Goods::update($data,['id'=>$id],true);
        $this->success('修改成功','index');
    }

    private function upload_logo()
    {
        $file = request()->file('goods_logo');

        if (!$file){
            $this->error('请上传logo图片');
        }
        $info = $file->validate(['size'=>5*1024*1024,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH.'public'.DS.'uploads');
        if (!$info){
            $this->error($file->getError());
        }
        $logo=DS.'uploads'.DS.$info->getSaveName();
        //生成缩略图
        $image = Image::open('.'.$logo);
        $image->thumb(200,200)->save('.'.$logo);

        return $logo;
    }

    private function upload_pics($goods_id)
    {
        $files=request()->file('goods_pics');
//        if (empty($files)){
//            $this->error('没有文件上传');
//        }
        $data=[];
        foreach ($files as $file){
            $info = $file->validate(['size'=>5*1024*1024,'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
            if ($info){
                $pics = DS.'uploads'.DS.$info->getSaveName();
                //分割目录
                $temp = explode(DS,$info->getSaveName());

                $image=Image::open('.'.$pics);

                $pics_big = DS.'uploads'.DS.$temp[0].DS.'thumb_big'.$temp[1];
                $image->thumb(800,800)->save('.'.$pics_big);

                $pics_mid = DS.'uploads'.DS.$temp[0].DS.'thumb_mid'.$temp[1];
                $image->thumb(350,350)->save('.'.$pics_mid);

                $pics_small = DS.'uploads'.DS.$temp[0].DS.'thumb_small'.$temp[1];
                $image->thumb(50,50)->save('.'.$pics_small);

                $row=[
                    'goods_id'=>$goods_id,
                    'pics_big'=>$pics_big,
                    'pics_mid'=>$pics_mid,
                    'pics_sma'=>$pics_small
                ];

                $data[]=$row;
            }
        }
        $goodspics=new Goodspics();
        $goodspics->saveAll($data);
    }

    public function delpics()
    {
        $pics_id=request()->param('pics_id');
        \app\admin\model\Goods::destroy($pics_id);
        return ['code'=>10000,'msg'=>'删除成功'];
    }

    //根据类型ID获取类型下的属性民称信息
    public function getattr($type_id)
    {
        $data = Attribute::where('type_id',$type_id)->select();
        foreach ($data as &$v) {
            $v = $v->getData();
            $v['attr_values'] = explode(',',$v['attr_values']);
        }
        return ['code'=>10000,'msg'=>'success','data'=>$data];
    }
}
