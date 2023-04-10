@extends('layouts.admin')

@section('container-class')
    container
@endsection

@section('body-class')
    col-md-12
@endsection

@section('admin-title')
    <div>
        <span><a class="btn btn-link p-0" href="{{ route('images') }}">Dashboard</a>/Select Image</span>
    </div>
@endsection

@section('admin-body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h5 class="d-block text-center w-100 fw-bold">{{ $searchNumber }}/{{ $searchCount }}</h5>

                <hr>

                <h2 class="d-block text-center w-100 fw-bold">{{ $name }}</h2>

                <hr>

                <div class="row select-image-container">
                    @foreach($images as $image)
                        <form class="col-md-3 mb-3" method="POST" action="{{ route('images.find') }}" >
                            {{ csrf_field() }}
                            <input type="hidden" name="selected_image_url" value="{{ $image['src'] }}">
                            <input class="submit-img" type="image" name="submit" src="{{ $image['thumb'] }}" alt="Submit" />
                        </form>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
