@extends('layouts.app-master')

@section('content')
    <div class="m-5 rounded">
        @auth
        <h1 class="mb-4">User</h1>
        <div class="card">
            <div class="card-header">Edit User</div>

            <form method="POST" action="{{ route('users.update', $logged_user->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                
                <label for="email"><b>Name</b></label>                   
                <input type="text" value="{{ $user_obj->name }}" name="name" id="name" class="input">         

                <label for="email"><b>Email</b></label>
                <span class="input">{{ $user_obj->email }}</span>


                <label for="email"><b>Username</b></label>
                <input type="text" name="username" id="username" value="{{ $user_obj->username }}" class="input">

                <label for="email"><b>No. of Tasks</b></label>
                <span class="input">{{ $user_obj->tasks->count() }}</span>

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
