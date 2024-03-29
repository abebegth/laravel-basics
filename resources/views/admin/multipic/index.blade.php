<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multiple Images
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

            <!-- Display all the brands -->

                <div class="col-md-8">
                    <div class="card-group">
                        @foreach($images as $image)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{ asset($image->image) }}" alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Insert a brand ... the form -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Upload Multiple Images</div>
                        <div class="card-body">
                            <form action="{{ route('store.multipic') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Multi Image</label>
                                    <input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" multiple ="">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</x-app-layout>
