@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">La lista dei progetti con tipologia {{ $type->name }}</h3>
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->title }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
