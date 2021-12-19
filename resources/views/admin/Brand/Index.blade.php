@extends('admin.admin_layout')

@section('content')
<div class="py-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ session('success') }}</strong>
                </div>
                @endif

                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function(alert) {
                        new bootstrap.Alert(alert)
                    })

                </script>
                <div class="card">
                    <div class="card-header">
                        All Brand
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand Name</th>
                                        <th>Brand Image</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand )
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}" class="img-thumbnail w-50"></td>
                                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url("brand/edit/".$brand->id) }}"><button class="btn btn-info mx-2">Edit</button></a>
                                                <a href="{{ url("brand/softdelete/".$brand->id) }}"><button class="btn btn-danger">Delete</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Trash Brand
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand Name</th>
                                        <th>Brand Image</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashed as $item )
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td><img src="{{ asset($item->brand_image) }}" alt="{{ $item->brand_name }}" class="brand-table-image img-thumbnail w-50"></td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url("brand/restore/".$item->id) }}"><button class="btn btn-warning mx-2">Restore</button></a>
                                                <a href="{{ url("brand/pdelete/".$item->id) }}"><button class="btn btn-danger">P Delete</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $trashed->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <h4 class="card-header">Brand Form</h4>
                    <div class="card-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label for="" class="form-label"></label>
                                @error("brand_name")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <input type="text" name="brand_name" id="" class="form-control" placeholder="Enter brand name" aria-describedby="helpId">
                                <br />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Brand Image</label>
                                @error("brand_image")
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <input type="file" name="brand_image" id="" class="form-control" aria-describedby="helpId">
                                <br />
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
