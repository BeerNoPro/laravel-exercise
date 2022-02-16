<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjaxCrudTodo;
use Illuminate\Support\Facades\DB;

class AjaxCrudTodoController extends Controller
{
    public function index(Request $request)
    {

        $posts = DB::table('ajax_crud_todos')->paginate(5);
        $page = 1;
        if (isset($request->page)) {
            $page = $request->page;
        }
        $index = ($page - 1) * 5 + 1;

        return view('ajax-crud-todo/index', [
            'posts' => $posts,
            'index' => $index
        ]);
    }

    public function store(Request $request)
    {
        $posts = AjaxCrudTodo::updateOrCreate(
            [
                'id' => $request->id
            ], 
            [
                'title' => $request->title,
                'description' => $request->description
            ]
        );

        $count = DB::table('ajax_crud_todos')->count();

        return response()->json([
            'code' => 200, 
            'message' => 'Created successfully',
            'data' => $posts,
            'count' => $count
        ], 200);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $posts = AjaxCrudTodo::where($where)->first();
        return response()->json($posts);
    }

    public function destroy(Request $request)
    {
        $post = AjaxCrudTodo::where('id', $request->id)->delete();
        // $post = AjaxCrudTodo::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
