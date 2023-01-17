@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">La lista delle tipologie</h3>
        <div class="row mt-5">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-6 p-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" placeholder="Aggiungi categoria" name="name"
                            value="{{ old('name') }}">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Aggiungi</button>
                    </div>
                </form>
            </div>
            <div class="col-6 p-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">N° Progetti</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td>
                                    <form id="form-edit-{{ $type->id }}"
                                        action="{{ route('admin.types.update', $type->slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" placeholder="Aggiungi categoria"
                                            name="name" value="{{ old('name', $type->name) }}">
                                    </form>
                                </td>
                                <th scope="row">{{ $type->projects->count() }}</th>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.types.show', $type->slug) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="btn btn-warning" form="form-edit-{{ $type->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
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
