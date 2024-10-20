@extends('layouts.app')  <!--inherit layouts-->

@section('title', $task->title)

@section('content')

    <div class="mb-4">
        <a class="link" href="{{ route('task.index')}}" >Task List</a>
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description}}</p>

    @if( $task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">
        Created {{ $task->created_at->diffForHumans() }} - Updated {{ $task->updated_at->diffForHumans() }}
    </p>

    <p class="mb-5">
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
        <span class="font-medium text-red-500">Not Completed</span>
        @endif
    </p>

    <div class="flex gap-3">
        <a href="{{ route('task.edit', ['task' => $task]) }}"
        class="btn">Edit</a>

        <form method="POST" action="{{ route('task.toogle', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button class="btn" type="submit">
                Mark as {{ $task->completed ? 'not complete' : 'complete'}}
            </button>
        </form>

        <form action="{{ route('task.delete', ['task' => $task->id]) }}" method="POST"> <!--delete a specific task by passing the route name and id-->
            @csrf
            @method('DELETE')

            <button class="btn" type="submit">Delete</button>
        </form>
    </div>

@endsection
