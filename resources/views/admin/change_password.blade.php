@extends('admin.admin')

@section('content')
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            @if(session('error'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('error')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif()
            <form method="post" action="{{ route('password.update')}}" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput3">Current Password</label>
                    <input type="password" id="current_password" name="oldPassword" class="form-control" placeholder="Current Password">
                    @error('oldPassword')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                    @error('confirmPassword')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection 