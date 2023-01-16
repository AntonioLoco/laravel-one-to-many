@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-8">
                <h1 class="text-center">Modifica tipologia {{ $type->name }}</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.types.update', $type->slug) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $type->name) }}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Modifica Tipologia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
