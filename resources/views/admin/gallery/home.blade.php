@extends('admin.master')
@section('title', 'Galería')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kits') }}">
            <i class="fal fa-photo-video"></i>
            Galería
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-5 d-flex">
                <div class="container-fluid p-0">
                    <div class="panel shadow">
                            <div class="header">
                                <h2 class="title">
                                    <i class="fas fa-plus"></i>
                                    Agregar Galería
                                </h2>
                            </div>
                        <div class="inside">

                            @if (kvfj(Auth::user()->permissions, 'gallery_add'))

                                {!! Form::open(['url' => '/admin/gallery/add', 'files' => true]) !!}
                                    @csrf
                                    <div class="row" style="padding: 16px;">

                                     

                                        <div class="col-12 ">

                                            {!! Form::label('file','Imagen:') !!}
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    {!! Form::file('file', ['class' => 'custom-file-input', 'id' => 'customFile']) !!}
                                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}

                                {!! Form::close() !!}

                            @endif

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-7 mt-4 mt-md-0">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title">
                            <i class="fal fa-photo-video"></i>
                            Galerías
                        </h2>
                    </div>
                    <div class="inside" style="max-height: 400px; overflow: auto;">
                        <div class="row" style="padding: 16px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td width="70">Imagen</td>
                                        <td >Nombre</td>
                                        <td  width="50">Estado</td>
                                        <td width="150"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $cat)
                                        <tr>
                                            <td><img src="{{ url('/multimedia/'.$cat->file_path.'/t_'.$cat->file) }}" class="img-fluid"></td>
                                            <td>{{ $cat->name }}</td>
                                            <td class="text-center">
                                                @if ($cat->status == '1')
                                                    <i class="fas fa-globe-americas" style="color: green;"></i>
                                                @else
                                                    <i class="fas fa-globe-americas" style="color: red;"></i>
                                                @endif
                                            </td>                                            <td>
                                                <div class="opts">
                                                    @if (kvfj(Auth::user()->permissions, 'gallery_edit'))
                                                        <a href="{{ url('/admin/gallery/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                            <i class="fas fa-edit" style="color: #ffc107;"></i>
                                                        </a>
                                                    @endif
                                                    @if (kvfj(Auth::user()->permissions, 'gallery_delete'))
                                                        <a href="{{ url('/admin/gallery/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title">
                            <i class="fal fa-file-edit"></i>
                            Editar descripción
                        </h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/section/'.$gallery->slug]) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        {{ Form::label('description','Descripcion:') }}
                                        <div class="input-group-prepend">
                                            {!! Form::textarea('description', $gallery->description, ['class' => 'form-control ', 'id' => 'editor']) !!}
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {!! Form::submit('Actualizar Descripción', ['class' => 'btn btn-success mt16']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

    </div>

@stop

@section('scripts')

    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace( 'editor' );
    </script>

@endsection
