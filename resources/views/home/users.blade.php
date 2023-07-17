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
                

                <a href="{{ url('users/create') }}" class="btn btn-danger float-right mb-3"><i class="fa fa-plus"></i></a>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Reg. Date</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @if(count($all_users) > 0)    

                 @foreach($all_users as $userobj)
                  <tr>
                    <th scope="row">{{ $userobj->id }}</th>
                    <td>{{ $userobj->name }}</td>
                    <td>{{ $userobj->email }}<br>
                    {{ $userobj->roles[0]->name }}</td>
                    <td>{{ date("m/d/Y",strtotime($userobj->created_at)) }}</td>
                    <td>
                      

                      <a href="{{ route('users.show', $userobj->id) }}" class="btn btn-success"><i class="far fa-eye"></i></a>

                      <a href="{{ url('users/'.$userobj->id.'/edit') }}" class="btn btn-success"><i class="fas fa-edit"></i></a>

                    <form method="POST" action="{{ route('users.destroy', $userobj->id) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" onclick="if (!confirm('Are you sure want to delete user?')) { return false }"><i class="far fa-trash-alt"></i></button>
                    </form>


                    </td>
                  </tr>

                 @endforeach
                 @else

                    <tr><td colspan="5" class="text-center" > <strong>No users found(s).</strong></td></tr>
                 @endif
                   
                 
                </tbody>

              </table>
              
            </div>
          </div>
    </div>
@endsection
