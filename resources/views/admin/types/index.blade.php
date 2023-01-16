@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">La lista delle tipologie</h3>
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-8">
                <a href="{{ route('admin.types.create') }}" class="btn btn-primary my-3">Crea una tipologia</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <th scope="row">{{ $type->name }}</th>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.types.show', $type->slug) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('admin.types.edit', $type->slug) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger delete-btn"
                                            data-project-title="{{ $type->name }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('partials.delete-modal')
        </div>
    </div>
@endsection
