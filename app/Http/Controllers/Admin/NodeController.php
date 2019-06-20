<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Node;
use DB;

class NodeController extends Controller
{
    /*public function fordata()
    {
        
        // 循环数据 进行测试
        for ($i=0; $i < 30; $i++) { 
            $data = [
            'desc'  => 'admin'.rand(1234,4321),
            'controller'  => 'admin'.rand(1234,4321),
            'method'  => 'admin'.rand(1234,4321),
        ];

        $user = new Node;
        $user->desc = $data['desc'];
        $user->controller = $data['controller'];
        $user->method = $data['method'];
        $res1 = $user->save();
        }
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->fordata();
        // 获取数据库的数据
        /*$node = new Node;
        $node_data = $node->get();*/
        // 分页 搜索
        $search_uname = $request->input('search_uname','');
        $node_data = Node::where('desc','like','%'.$search_uname.'%')
                           ->orderBy('id','asc')
                           ->paginate(5);

        // 引入页面
        return view('/admin/node/index',
            [
                'params'=>$request->all(),
                'node_data'=>$node_data, 
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 引入页面
        return view('/admin/node/create');
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
            'desc' => 'required',
            'controller' => 'required|regex:/^[\w]+$/',
            'method' => 'required|regex:/^[\w]+$/',
        ],[
            'desc.required'=>'权限列表不能为空',    
            'controller.required'=>'控制器不能为空',    
            'controller.regex'=>'控制器格式不正确',    
            'method.required'=>'控制器方法不能为空',
            'method.regex'=>'控制器方法格式不正确',
        ]);

        // 限制添加的控制器跟方法名字
        $array = [
            'UserController',
            'GoodsController' ,
            'Admin_userController',
            'AdvertiController',
            'BannerController',
            'CateController',
            'CommentController',
            'DoingController',
            'LinkController',
            'NodeController',
            'OrderController',
            'RoleController',
            'SpikeController',
            'IndexController',
            'index',
            'create',
            'destroy',
            'edit',
            'show',
            'status',
        ];

        //接收数据
        $data = $request->all();
        $controller = ucwords($data['controller']).'Controller';
        $node_data = new Node;
        $node_data->desc = $data['desc'];
        if(in_array($controller,$array)) {
           $node_data->controller = $controller;  
        } else {
            return back()->with('error','不存在该控制器');
        }
        if (in_array($data['method'],$array)) {
            $node_data->method = $data['method'];
        } else {
            return back()->with('error','不存在该方法');
        }

        // 数据库查询
        // 获取所有的method数据
        $select_method = DB::table('nodes')
                                ->select('method')
                                ->get();
        $temp1 = [];
        foreach ($select_method  as $k => $v) {
            foreach ($v as $kk => $vv) {
                $temp1[] = $vv;
            }
        }
        // 获取所有的controller数据
        $select_controller = DB::table('nodes')
                                ->select('controller')
                                ->get();
        $temp2 = [];
        foreach ($select_controller  as $k => $v) {
            foreach ($v as $kk => $vv) {
                $temp2[] = $vv;
            }
        }
        
        // dd(in_array($node_data->method,$temp1),$node_data->method,$temp1);
        // 判断是否已存在该控制器跟方法
        if (in_array($node_data->method,$temp1) && in_array($node_data->controller,$temp2) ) {
            return back()->with('error','已存在该控制器跟方法');
        } else {
            // 对数据库进行添加操作
            $res = $node_data->save();
            if ($res) {
                return redirect('/admin/node')->with('success','添加成功');
            } else {
                return back()->with('error','添加失败');
            }
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
        // 通过id获取单条数据
        $data = Node::find($id);
        
        // 引入页面
        return view('/admin/node/edit',
            [
                'data'=>$data,
            ]);
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
        // 表单验证
        $this->validate($request, [
            'desc' => 'required',
            'controller' => 'required|regex:/^[\w]+$/',
            'method' => 'required|regex:/^[\w]+$/',
        ],[
            'desc.required'=>'权限列表不能为空',    
            'controller.required'=>'控制器不能为空',    
            'controller.regex'=>'控制器格式不正确',    
            'method.required'=>'控制器方法不能为空',
            'method.regex'=>'控制器方法格式不正确',
        ]);

        //接收数据
        $data['desc'] = $request->input('desc');
        $controller = $request->input('controller');
        $controllers = explode('Controller',$controller);
        $controllers_data = $controllers['0'];
        $data['controller'] = ucwords($controllers_data).('Controller');
        $data['method'] = $request->input('method');
        $data['updated_at'] = date('Y-m-d H:i:s');
        // 进行数据库修改操作
        $res = DB::table('nodes')
                       ->where('id',$id)
                       ->update($data);

        if ($res) {
            return redirect('/admin/node')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //通过id进行数据删除
        $res = Node::destroy($id);
        if ($res) {
            return redirect('/admin/node')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
}
