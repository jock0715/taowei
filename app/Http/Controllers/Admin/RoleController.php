<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Role;
use App\Models\Role_node;

class RoleController extends Controller
{
    // 置换为中文
    public static function conall ()
    {
        return [
            'UserController' => '用户管理',
            'GoodsController' => '商品管理',
            'Admin_userController' => '管理员',
            'AdvertiController' => '广告管理',
            'BannerController' => '轮播管理',
            'CateController' => '分类管理',
            'CommentController' => '评价管理',
            'DoingController' => '活动管理',
            'LinkController' => '链接管理',
            'NodeController' => '权限管理',
            'OrderController' => '订单管理',
            'RoleController' => '职位管理',
            'SpikeController' => '秒杀管理',
            'index' => '查看',
            'create' => '添加',
            'destroy' => '删除',
            'edit' => '修改',
            'show' => '',
            'status' => '状态',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取数据库数据
        /*$data = new Role;
        $role_data = $data->get();*/
        $search_uname = $request->input('search_uname','');

        $role_data = Role::where('name','like','%'.$search_uname.'%')
                                ->orderBy('id','asc')
                                ->paginate(5);

        // 引入页面
        return view('/admin/role/index',
            [
                'role_data'=>$role_data,
                'params'=>$request->all(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询所有的权限
        $nodes = DB::table('nodes')
                     ->get();
        /* 转化样式
        
            [
                'UserController'='index,create,edit',
            ]

        */
        $list = [];
        foreach ($nodes as $k => $v) {
            $temp['id'] = $v->id;
            $temp['desc'] = $v->desc;
            $temp['method'] = $v->method;
            // $temp['controller'] = $v->controller;
            $list[$v->controller][] = $temp;
        }
        // dump($list,$temp);

        // 引入页面
        return view('/admin/role/create',
            [
                'list'=>$list,
                'conall'=>self::conall(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required' => '职位不能为空',
        ]);

        // 开启事务
        DB::beginTransaction();
        // 接收数据
        $name = $request->input('name');
        $nid = $request->input('nid');
        $created_at = date('Y-m-d H:i:s');
        // 获取当前操作的数据的id
        $rid = DB::table('roles')->insertGetId(['name'=>$name,'created_at'=>$created_at]);

        foreach ($nid as $k => $v) {
            // 进行数据库的添加操作
            $res = DB::table('roles_nodes')->insert(['nid'=>$v,'rid'=>$rid,'created_at'=>$created_at]);
        }
        if ($rid && $res) {
            // 提交事务
            DB::commit();
            return redirect('/admin/role')->with('success','添加成功');
        } else {
            // 事务回滚
            DB::rollBack();
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
