@extends('admin.admin_layout')
@section('content')
<div class="py-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header">Update Brand Form</h4>
                    <div class="card-body">
                        <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label for="" class="form-label"></label>
                                @error("brand_name")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <input type="text" name="brand_name" id="" class="form-control" value="{{ $brand->brand_name }}" placeholder="Enter brand name" aria-describedby="helpId">
                                <br />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Brand Image</label>
                                @error("brand_image")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}" id="" class="form-control" aria-describedby="helpId">
                                <input type="file" name="brand_image" id="" class="form-control" aria-describedby="helpId">
                                <br />
                                <img src="{{ asset($brand->brand_image) }}" class="w-50 img-thumbnail" alt="">
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Update Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
