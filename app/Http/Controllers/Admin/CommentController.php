<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Order;

class CommentController extends Controller
{
    /**
     * 显示用户评价.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取搜索的数据
        $search = $request->input('search','');

        // 实例化 评价表 comments
        $comment = new Comment;
        $data = $comment->paginate(5);

        return view('admin/comment/index',['data'=>$data]);
    }

    /**
     * 显示修改评价表.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取对应id的信息
        $data = Comment::find($id);

        return view('admin/comment/edit',['data'=>$data]);
    }

    /**
     * 执行更新评论.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 接收数据
        $data = $request->all();
        $comment = Comment::find($id);
        $comment->content = $data['content']?$data['content']:'该用户未评价!';
        $comment->comment = $data['comment']?$data['comment']:'0';

        // 执行SQL语句修改
        $res = $comment->save();
        if($res){
            return redirect('/admin/comment')->with('success','修改成功 !');
        }else{
            return back()->with('error','修改失败 !');
        }
    }

    /**
     * 执行评论删除.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 获取对应id的信息
        $comment = Comment::find($id);

        // 执行SQL语句删除
        $res = $comment->delete();
        if($res){
            return redirect('/admin/comment')->with('success','删除成功 !');
        }else{
            return back()->with('error','删除失败 !');
        }

    }
}
