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
            </div>
        </div>

          <div class="row">
            <div class="col-12">
                @if(auth()->user()->roles[0]->name!="customer")
                <a href="{{ url('tasks/create') }}" class="btn btn-danger float-right mb-3"><i class="fa fa-plus"></i></a>
                @endif
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Task No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Assign By</th>
                    <th scope="col">Assign To</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                 @if(count($tasks) > 0)
                                @foreach ($tasks as $task)
                  <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->title }}</td>                    
                    <td>{{ getAddedUserName($task->added_by) }}</td>
                     <td>{{ $task->user->name }}</td>         
                    <td>{{ getTaskStatus($task->is_complete==1)  }}</td>
                    <td>
                      
                      <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                      
                      @if($task->is_complete==0)    
                      <a href="{{ url('tasks/'.$task->id.'/edit') }}" class="btn btn-success"><i class="fas fa-edit"></i></a>

                      
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" onclick="if (!confirm('Are you sure want to delete task?')) { return false }"><i class="far fa-trash-alt"></i></button>
                        </form>
                      @endif  


                    </td>
                  </tr>

                 @endforeach
                 @else

                    <tr><td colspan="5" class="text-center" > <strong>No tasks found(s).</strong></td></tr>
                 @endif
                   
                 
                </tbody>

              </table>
              
            </div>
          </div>
    </div>
@endsection
