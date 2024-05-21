@extends('templates.base')
@section('title', 'Editorial')
@section('header', 'Editorial')
@section('content')

    @include('templates/messages')  

    <div class="row">
        <div class="col-lg-12 mb-4">
            <form action="{{ route('editorial.update', $editorial['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group"> 
                    <div class="col-lg-4 mb-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ $editorial['name'] }}">
                    </div>                   
                    <div class="col-lg-4 mb-4">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" required value="{{ $editorial['address'] }}">
                    </div>                   
                </div>                
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <a href="{{ route('editorial.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                    </div>
                </div>                                
            </form>
        </div>
    </div>
@endsection