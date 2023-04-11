@extends('layouts.admin')

@section('container-class')
    container
@endsection

@section('body-class')
    col-md-8
@endsection

@section('admin-title')
    <div>
        <span><a class="btn btn-link p-0" href="{{ route('images') }}">Dashboard</a></span>
    </div>
@endsection

@section('admin-body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if (!empty($searches))
                    <h5 class="text-bg-warning p-3">Previous search is not finished!</h5>
                    <form class="mb-4" method="POST" action="{{ route('images.find') }}" >
                        {{ csrf_field() }}
                        <input type="hidden" name="continue" value="1">
                        <input type="submit" value="Continue" class="col-md-3">
                    </form>
                    <hr>
                @endif

                <strong>---Find images:---</strong>
                <form method="POST" action="{{ route('images.find') }}" >
                    {{ csrf_field() }}
                    <textarea name="search" rows="20" type="text" placeholder="Names to search for" class="col-md-12" required></textarea>
                    <input type="submit" value="Find" class="col-md-3">
                </form>
            </div>
        </div>
    </div>
@endsection
