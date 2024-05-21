@extends('templates.base')
@section('title', 'Editorial')
@section('header', 'Editorial')
@section('content')

    <div class="row">
        <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">            
            <a href="#" class="btn btn-primary">Crear</a>                   
        </div>
    </div>

    @include('templates/messages')

    <div class="row">
        <div class="col-lg-12 mb-4">
            <table id="table_data" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($editorials as $editorial)                       
                        <tr>
                            <td>{{ $editorial['id'] }}</td>
                            <td>{{ $editorial['name'] }}</td>
                            <td>{{ $editorial['address'] }}</td>
                            <td>
                                <a href="{{ route('editorial.edit', $editorial->id) }}" title="editar" class="btn btn-primary btn-circle btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="{{ route('editorial.destroy', $editorial->id) }}" title="eliminar" class="btn btn-danger btn-circle btn-sm" 
                                    onclick="return confirm('¿Está seguro de que desea eliminar el registro?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr> 
                    @endforeach                   
                </tbody>
            </table>
        </div>
    </div>

@endsection

