<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //カテゴリ一覧を表示
    public function index()
    {
        $categories = Category::all();
        return view('categories', ['categories' => $categories]);
    }

    //カテゴリの追加
    //バリデーション設定
    public function store(CategoryRequest $request)
    {
        $list = $request->only(['name']);
        Category::create($list);
        return redirect('/category')->with('message', 'カテゴリを作成しました');
    }

    //データの更新
    public function update(CategoryRequest $request)
    {
        $form = $request->only(['name']);
        // unset($form['_token']);
        Category::find($request->id)->update($form);
        return redirect('/category')->with('message', 'カテゴリを更新しました');
    }

    //データの削除
    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect('/category')->with('message', 'カテゴリを削除しました');
    }
}
