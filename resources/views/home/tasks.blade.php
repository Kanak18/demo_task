@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card card-new-task">
                    @if(!empty($existed_task))

                        <div class="card-header">Update Task</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tasks.update', $existed_task->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ $existed_task->title }}" />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div><br />

                                <div class="form-group">
                                    <label for="title">Assign User</label>
                                    <select name="assign_user_id" id="assign_user_id" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
                                        @foreach($all_users as $userobj)
                                        <option value="{{ $userobj->id }}" @if($userobj->id == $logged_user->id) selected @endif>{{ $userobj->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div><br />

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    @else
                        <div class="card-header">New Task</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div><br />

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    @endif

                </div>
                <br />
                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            @if(count($tasks) > 0)
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="col-md-8">
                                            @if ($task->is_complete)
                                                <s>{{ $task->title }}</s>
                                            @else
                                                {{ $task->title }}
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if (! $task->is_complete)
                                                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary">Complete</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if (! $task->is_complete)
                                                <a href="{{ url('tasks/'.$task->id.'/edit') }}" class="btn btn-primary">Update</a>
                                            @endif
                                        </td>                                    
                                        <td class="text-right">
                                            @if (! $task->is_complete)
                                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary" onclick="if (!confirm('Are you sure want to delete task?')) { return false }">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                                <tr><td class="form-group" colspan="4">No Tasks Found!</td></tr>

                            @endif
                        </table>

                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
