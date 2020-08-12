@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
 $task = Task::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);

@endsection