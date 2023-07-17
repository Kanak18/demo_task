@extends('layouts.app-master')

@section('content')
    <div class="m-5 rounded">
        @auth
        <h1 class="mb-4">Task</h1>
        <div class="card">
            <div class="card-header">Update Task</div>

            <form method="POST" action="{{ route('tasks.update', $existed_task->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                
                <label for="title"><b>Name</b></label>       
                @if(auth()->user()->roles[0]->name != "customer")             
                <input type="text" value="{{ $existed_task->title }}" name="title" id="title" class="input" required>                         
                @else
                  <span class="input">{{ $existed_task->title }}</span>    
                  <input type="hidden" value="{{ $existed_task->title }}" name="title" id="title" class="input" required>               
                @endif

                @if(auth()->user()->roles[0]->name != "customer" &&  $existed_task->added_by==auth()->user()->id)    
                <label for="username"><b>Assign To</b></label>
                <div class="form-group">
                    
                    <select name="assign_user_id" id="assign_user_id" class="input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
                        @foreach($all_users as $userobj)
                        <option value="{{ $userobj->id }}" @if($userobj->id == $existed_task->user_id) selected @endif>{{ $userobj->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
                @else
                    <input type="hidden" name="assign_user_id" id="assign_user_id" value="{{ $existed_task->user_id }}">
                @endif    

                <label for="username"><b>Is Completed</b></label>
                <div class="form-group">

                    @if($existed_task->user_id==auth()->user()->id)    
                    
                    <select name="is_completed" id="is_completed" class="input form-control{{ $errors->has('is_completed') ? ' is-invalid' : '' }}">
                        <option value="0">un-complted</option>
                        <option value="1">complted</option>
                        
                    </select>

                    @else
                        <span class="input">{{ getTaskStatus($existed_task->is_complete) }}</span> 
                        <input type="hidden" name="is_completed" id="is_completed" value="{{ intval($existed_task->is_complete) }}">                        
                    @endif
                    
                </div>
                <button type="submit" class="btn btn-primary">Update</button>

            </div>
          </form>
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
