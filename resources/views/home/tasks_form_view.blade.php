@extends('layouts.app-master')

@section('content')
    <div class="m-5 rounded">
        @auth
        <h1 class="mb-4">Tasks</h1>
        <div class="card">
            <div class="card-header">Add Task</div>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            
            <div class="card-body">
                
                <label for="email"><b>Title</b></label>                   
                <span class="input"> {{ $task_data->title }}</span>                  

                <label for="email"><b>Assiged By</b></label>
                <span class="input">{{ getAddedUserName($task_data->added_by) }}</span>

                <label for="email"><b>Status</b></label>
                <span class="input">{{ getTaskStatus($task_data->is_complete) }}</span>


                <a href="{{ url('tasks') }}" class="btn btn-primary">Back</a>

            </div>
         
        </div>
        @endauth
    </div>
@endsection

<style>
/* Full-width input fields */
.input {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
</style>
