@extends('admin.admin_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <h4 class="card-header">Portfolio Form</h4>
                <div class="card-body">
                    <form action="{{ route('store.portfolio') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                            <label for="" class="form-label">Title</label>
                            @error("title")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="text" name="title" required id="" class="form-control" placeholder="Enter portfolio title" aria-describedby="helpId">
                            <br />
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Select Category</label>
                          <select class="form-control btn btn-dark text-left" name="category" id="">
                            <option value="app">App</option>
                            <option value="website">Website</option>
                            <option value="graphic_design">Graphic Design</option>
                          </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Portfolio Image</label>
                            @error("image")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <input type="file" name="image" required id="" class="form-control" aria-describedby="helpId">
                            <br />
                        </div>
                        <div class="mb-1">
                            <label for="" class="form-label">Description</label>
                            @error("description")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <textarea name="description" required class="form-control" id="description" rows="10" placeholder="Enter Description"></textarea>
                            <br />
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Add Portfolio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
