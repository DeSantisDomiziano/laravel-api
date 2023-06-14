@extends('layouts.admin')

@section('content')

    <div class="py-5">

        <div class="row">
            <div class="col">
                <img src="{{ $project->img_path }}" alt="">
            </div>
        </div>


        <div class="col">
            <h1>{{ $project->title }}</h1>
            <p>{{ $project->overview }}</p>
        </div>
        
    </div>

@endsection