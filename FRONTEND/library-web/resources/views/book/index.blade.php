@extends('templates.base')
@section('title', 'Libro')
@section('header', 'Libro')
@section('content')

    <div class="row">
        <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">            
            <a href="{{ route('book.create') }}" class="btn btn-primary">Crear</a>                   
        </div>
    </div>

    @include('templates/messages')

    <div class="row">
        <div class="col-lg-12 mb-4">
            <table id="table_data" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($books as $book)                       
                        <tr>
                            <td>{{ $book['id'] }}</td>
                            <td>{{ $book['isbn'] }}</td>
                            <td>{{ $book['title'] }}</td>
                            <td>{{ $book['author'] }}</td>
                            <td>{{ $book['editorial']['name'] }}</td>
                            <td>{{ $book['category']['name'] }}</td>
                            <td>
                                <a href="{{ route('book.edit', $book['id']) }}" title="editar" class="btn btn-info btn-circle btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="{{ route('book.destroy', $book['id']) }}" title="eliminar" class="btn btn-danger btn-circle btn-sm" 
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

