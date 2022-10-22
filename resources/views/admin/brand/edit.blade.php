

@extends('admin.admin')

@section('content')


    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif()

                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brandById->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brandById->brand_image}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" value="{{ $brandById->brand_name }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- For the image -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" value="{{ $brandById->brand_image }}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- to display the image -->
                                <div class="form-group">
                                    <img src="{{ asset($brandById->brand_image)}}" style="height: 200px; width: 400px" alt="">
                                </div>
                                <button type="submit" class="btn btn-success">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
