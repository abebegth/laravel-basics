@extends('admin.admin')

@section('content')
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Update User Profile</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            <form method="post" action="{{ route('profile.update')}}" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput3">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $user['email'] }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
@endsection 