<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Diary;
use App\Http\Requests\CreateDiary;
use Illuminate\Support\Facades\Auth;




class DiaryController extends Controller
{
    public function index()

    {
        $diaries = Diary::all();
        return view('diaries.index',['diaries' => $diaries]);
    }

      public function create()
    {
        // views/diaries/create.blade.phpを表示する
        return view('diaries.create');
    }

    public function store(CreateDiary $request)
{
    $diary = new Diary(); //Diaryモデルをインスタンス化

    $diary->title = $request->title; //画面で入力されたタイトルを代入
    $diary->body = $request->body; //画面で入力された本文を代入
    $diary->save(); //DBに保存

    return redirect()->route('diary.index'); //一覧ページにリダイレクト
}
public function destroy(int $id)
{
    $diary = Diary::find($id);
    dd($diary);

    return redirect()->route('diary.index'); //一覧ページにリダイレクト
}
}
