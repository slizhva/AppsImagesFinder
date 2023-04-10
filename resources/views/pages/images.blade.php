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
