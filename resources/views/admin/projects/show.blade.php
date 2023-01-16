@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="row justify-content-center mt-3">
            <div class="col-8">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h1 class="text-center mt-3">{{ $project->title }}</h1>
                <h4 class="mt-3 text-success">{{ $project->type ? $project->type->name : 'Nessuna categoria' }}</h4>
                <div class="d-flex justify-content-between mt-3">
                    <h5>{{ $project->created_at }}</h5>
                    <p>{{ $project->slug }}</p>
                </div>
                @if ($project->image_cover)
                    <div class="text-center my-3">
                        <img src="{{ asset('storage/' . $project->image_cover) }}" alt="Image {{ $project->title }}"
                            class="w-50">
                    </div>
                @endif
                <p class="mt-3">{{ $project->description }}</p>
            </div>
        </div>
    </div>
@endsection
