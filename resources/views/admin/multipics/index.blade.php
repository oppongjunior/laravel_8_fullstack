<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight justify-content-between d-flex align-items-center">
            <b>Multipics</b>
            <button type="button" class="btn btn-light">
                Users <span class="badge bg-danger"></span>
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
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
                        <div class="card-group">
                            @foreach ($images as $image)
                            <div class="col-md-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset($image->image)}}" alt="Card image cap">
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h4 class="card-header">Multipics Form</h4>
                        <div class="card-body">
                            <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Brand Image</label>
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <input type="file" name="images[]" id="" class="form-control" aria-describedby="helpId" multiple>
                                    <br />
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Add images</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
