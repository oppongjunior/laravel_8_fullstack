@extends('admin.admin_layout')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6">
        <a href="{{ url("user/all") }}" class="">
            <div class="card card-mini mb-4 sm-card-box">
                <div class="card-body">
                    <h2 class="mb-1">{{ count($users) }}</h2>
                    <p>Users</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ url("brand/all") }}" class="">
            <div class="card card-mini mb-4 sm-card-box">
                <div class="card-body">
                    <h2 class="mb-1">{{ count($clients) }}</h2>
                    <p>Clients</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ url("contact/messages") }}" class="">
            <div class="card card-mini mb-4 sm-card-box">
                <div class="card-body">
                    <h2 class="mb-1">{{ count($messages) }}</h2>
                    <p>Messages</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route("admin.service") }}" class="">
            <div class="card card-mini mb-4 sm-card-box">
                <div class="card-body">
                    <h2 class="mb-1">{{ count($services) }}</h2>
                    <p>Services</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route("admin.portfolio") }}" class="">
            <div class="card card-mini mb-4 sm-card-box">
                <div class="card-body">
                    <h2 class="mb-1">{{ count($portfolio) }}</h2>
                    <p>Portfolio</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route("all.slider")}}" class="">
            <div class="card card-mini mb-4 sm-card-box">
                <div class="card-body">
                    <h2 class="mb-1">{{ count($sliders) }}</h2>
                    <p>Sliders</p>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection
