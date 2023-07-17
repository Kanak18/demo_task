@extends('layouts.app-master')

@section('content')
    <div class="m-5 rounded">
        @auth
        <h1 class="mb-4">User</h1>
        <div class="card">
            <div class="card-header">User Info</div>

            <div class="card-body">
                
                <label for="email"><b>Name</b></label>                   
                <span class="input"> {{ $user_info->name }}</span>                  

                <label for="email"><b>Email</b></label>
                <span class="input">{{ $user_info->email }}</span>


                <label for="email"><b>Username</b></label>
                 <span class="input">{{ $user_info->username }}</span>

                <label for="email"><b>No. of Tasks</b></label>
                <span class="input">{{ $user_info->tasks->count() }}</span>


                <a href="{{ url('users') }}" class="btn btn-primary">Back</a>

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
