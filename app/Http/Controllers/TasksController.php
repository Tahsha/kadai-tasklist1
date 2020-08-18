<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
class TasksController extends Controller
{
       public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('id', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,  
                // 'status' => $status,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    } 

    
        public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
            
        ]);

        return redirect('/');
   
    }
    
       public function create()
    {
        $task = new Task;

        // メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }
    
        public function show($id)
    {
   
        $task = Task::findOrFail($id);
        // $tasks = Task::findOrFail($id);

     
        // $tasks = Task->orderBy('id', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('tasks.show' ,[
            'task'=>$task,]);
    }
        public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }
      public function update(Request $request, $id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        // メッセージを更新
        $task->content = $request->content;
        $task ->status =$request ->status;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
       public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        // メッセージを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
