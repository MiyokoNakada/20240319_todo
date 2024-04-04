<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    //データベースの値を表示
    public function index()
    {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', ['todos' => $todos, 'categories'=>$categories]);
    }

    //データの追加
    //バリデーション設定
    public function store(TodoRequest $request)
    {
        $list = $request->only(['content','category_id']);
        Todo::create($list);
        return redirect('/')->with('message', 'ToDoを作成しました');
    }

    //データの更新
    public function update(TodoRequest $request){
        $form = $request ->only(['content']);
        // unset($form['_token']);
        Todo::find($request -> id) ->update($form);
        return redirect('/')->with('message', 'ToDoを更新しました');
    }

    //データの削除
    public function destroy(Request $request){
        Todo::find($request ->id) -> delete();
        return redirect('/') ->with('message', 'ToDoを削除しました');
    }

    //検索機能
    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
