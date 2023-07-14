@extends('layouts.app-master')

@section('content')
    <div class="m-5 rounded">
        @auth
        <h1 class="mb-4">User</h1>
        <div class="card">
            <div class="card-header">Add User</div>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form method="POST" action="{{ route('users.store') }}">
            @csrf            
            <div class="card-body">
                
                <label for="name"><b>Name</b></label>                   
                <input type="text" value="{{ old('name') }}" name="name" id="name" class="input" required>         

                <label for="email"><b>Email</b></label>
                <input type="email" value="{{ old('email') }}" name="email" id="email" class="input" required>       

                <label for="username"><b>Username</b></label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="input" required>

                <label for="email"><b>Password</b></label>
                <input type="password" value="" name="password" id="password" class="input" required>     
                

                <label for="email"><b>Confirm Password</b></label>
                <input type="password" value="" name="password_confirmation" id="password_confirmation" class="input" required>     
                

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
