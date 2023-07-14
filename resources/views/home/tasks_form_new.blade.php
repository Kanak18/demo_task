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

            <form method="POST" action="{{ route('tasks.store') }}">
            @csrf            
            <div class="card-body">
                
                <label for="name"><b>Name</b></label>                   
                <input type="text" value="{{ old('title') }}" name="title" id="title" class="input" required>         


                <label for="username"><b>Assign To</b></label>
                <div class="form-group">
                    
                    <select name="assign_user_id" id="assign_user_id" class="input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
                        @foreach($all_users as $userobj)
                        <option value="{{ $userobj->id }}" @if($userobj->id == $logged_user->id) selected @endif>{{ $userobj->name }}</option>
                        @endforeach
                    </select>
                    
                </div>


                <button type="submit" class="btn btn-primary">Save</button>

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
