<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight justify-content-between d-flex align-items-center">
            <b>Update Category</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h4 class="card-header">Update Category Form</h4>
                        <div class="card-body">
                            <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label"></label>
                                    @error("category_name")
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                    <input type="text" name="category_name" id="" class="form-control" placeholder="Enter category name" aria-describedby="helpId" value="{{ $category->category_name }}">
                                    <br />
                                    <button class="btn btn-primary btn-block" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
