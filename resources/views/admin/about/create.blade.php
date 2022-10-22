@extends('admin.admin')

@section('content')
<div class="col-lg-8">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.about')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">About Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title">
                    <!-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> -->
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Summary</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="summary" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">About Detail</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="detail" rows="4"></textarea>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    <!-- <button type="submit" class="btn btn-secondary btn-default">Cancel</button> -->
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection