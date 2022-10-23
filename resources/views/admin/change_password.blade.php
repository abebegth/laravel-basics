@extends('admin.admin')

@section('content')
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            <form class="form-pill">

                <div class="form-group">
                    <label for="exampleFormControlInput3">Current Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput3" placeholder="Current Password">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">New Password</label>
                    <input type="password" class="form-control" id="exampleFormControlPassword3" placeholder="New Password">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleFormControlPassword3" placeholder="Confirm Password">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection 