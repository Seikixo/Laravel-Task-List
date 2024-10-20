<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


//default page
Route::get('/', function () {
  return redirect()->route('task.index');
});

//home page
Route::get('/tasks', function ()  {  
  return view('index',[
      'tasks' => Task::latest()->paginate(10) // paginate 
  ]);
})->name('task.index');

//view task page
Route::view('/tasks/create', 'create')
->name('task.create');


//get one task page
Route::get('/tasks/{task}', function (Task $task) {
  return view('show',[
    'task' => $task 
  ]);
})->name('task.show');

//view edit page
Route::get('tasks/{task}/edit', function(Task $task) {

  return view('edit',[
    'task'=> $task
  ]);
})->name('task.edit');


//create task 
Route::post('/task', function (TaskRequest $request) {

  $task = Task::create($request->validated());

  return redirect()->route('task.show', ['task' => $task->id ])
  ->with('success', 'Task Created successfully');

})->name('task.store');

//edit task 
Route::put('/task/{task}', function (Task $task, TaskRequest $request) {

  $task->update($request->validated());

  return redirect()->route('task.show', ['task' => $task->id ])
  ->with('success', 'Task Updated successfully');

})->name('task.update');

//delete task
Route::delete('/task/{task}', function(Task $task){

  $task->delete();

  return redirect()->route('task.index')
  ->with('success','Task Deleted Successfully');

})->name('task.delete');

//toggle complete or not complete
Route::put('task/{task}/toggle', function(Task $task){
  $task->toggleComplete();

  return redirect()->back()->with('success', 'Task updated successfully');
})->name('task.toogle');