@extends('admin.admin')

@section('content')

    <div class="py-12">
        <div class="container">
            <div class="row">

                <!-- Display all the Sliders -->
                <h4>About</h4>
                <a href="{{ route('add.about') }}"><button class="btn btn-success">Add About</button></a>

                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif()
                        <div class="card-header">
                            All About data
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col" width="5%">Sr No</th>
                                <th scope="col" width="15%">Title</th>
                                <th scope="col" width="20%">Summary</th>
                                <th scope="col" width="30%">Detail</th>
                                <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($abouts as $about)
                                    <tr>
                                        <th scope="row"> {{ $i++ }}</th>
                                        <td>{{ $about->title}}</td>
                                        <td>{{ $about->summary}}</td>
                                        <td>{{ $about->detail}}</td>
                                        <td>
                                            <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('delete/about/'.$about->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
        </div>

    </div>
@endsection
