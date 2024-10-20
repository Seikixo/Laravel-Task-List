@extends('layouts.app')


@section('title', 'List of Task')

@section('content')
    <div>

        <nav class="mb-4">
            <a class="link" href="{{ route('task.create')}}" >Create Task</a>
        </nav>

        @forelse ($tasks as $task)
            <div>
                <!--Passing the Route name and Route parameter-->
                <a href="{{ route('task.show', ['task' => $task]) }}"
                @class([ 'line-through' => $task->completed])> {{ $task->title}} </a>
            </div>
        @empty
            <div>There are no task!</div>
        @endforelse ($tasks as $task)


        @if ($tasks->count())
            <nav class="mt-4">
                {{$tasks->links()}}
            </nav>
            
        @endif
            
    </div>
@endsection

