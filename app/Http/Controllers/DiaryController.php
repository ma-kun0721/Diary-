<?php

namespace App\Http\Controllers;

use App\Diary; // App/Diaryクラスを使用する宣言
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiary; // 追加

class DiaryController extends Controller
{
  public function index()
  {
        //diariesテーブルのデータを全件取得
        //useしてるDiaryのallメソッドを実施
        //all()はテーブルのデータを全て取得するメソッド
    $diaries = Diary::all(); 

        // dd($diaries)  //var_dump()とdie()を合わせたメソッド。変数の確認 + 処理のストップ
        // view/diaries/index.blade.phpを表示
    return view('diaries.index',['diaries' => $diaries]);
  }

  public function create()
  {
        // views/diaries/create.blade.phpを表示する
    return view('diaries.create');
  }

public function store(CreateDiary $request) //変更
{
    $diary = new Diary(); //Diaryモデルをインスタンス化

    $diary->title = $request->title; //画面で入力されたタイトルを代入
    $diary->body = $request->body; //画面で入力された本文を代入
    $diary->save(); //DBに保存

    return redirect()->route('diary.index'); //一覧ページにリダイレクト
  }
  public function destroy(int $id)
  {
    //Diaryモデルを使用して、diariesテーブルから$idと一致するidをもつデータを取得
    $diary = Diary::find($id); 


    //取得したデータを削除
    $diary->delete();
    return redirect()->route('diary.index');


  }
  public function edit(int $id)
  {$diary = Diary::find($id); 

    return view('diaries.edit', [
        'diary' => $diary,
    ]);
  }
     //Diaryモデルを使用して、diariesテーブルから$idと一致するidをもつデータを取得
public function update(int $id, CreateDiary $request)
{
    $diary = Diary::find($id);

    $diary->title = $request->title; //画面で入力されたタイトルを代入
    $diary->body = $request->body; //画面で入力された本文を代入
    $diary->save(); //DBに保存

    return redirect()->route('diary.index'); //一覧ページにリダイレクト
}
}
