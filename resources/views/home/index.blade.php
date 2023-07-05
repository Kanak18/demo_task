@extends('layouts.app-master')

@section('content')
    <div class="m-5 rounded">
        @auth
        <h1 class="mb-4">Dashboard</h1>
        <div class="card">
            <div class="card-header">Profile Information</div>

            <div class="card-body">
                
                <label for="email"><b>Name</b></label>
                <span class="input">{{ $logged_user->name }}</span>                

                <label for="email"><b>Email</b></label>
                <span class="input">{{ $logged_user->email }}</span>

                <label for="email"><b>No. of Tasks</b></label>
                <span class="input">{{ $logged_user->tasks->count() }}</span>

            </div>

        </div>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Please login to manage Task.</p>
        @endguest
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
