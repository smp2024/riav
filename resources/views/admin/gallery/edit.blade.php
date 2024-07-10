@extends('admin.master')
@section('title', 'Ediat Galería')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/gallerys') }}">
            <i class="fal fa-photo-video"></i>
            Galerías
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-9">
                <div class="container-fluid">
                    <div class="panel shadow">
                            <div class="header">
                                <h2 class="title">
                                    <i class="fas fa-plus"></i>
                                    Editar galería
                                </h2>
                            </div>
                        <div class="inside">

                            @if (kvfj(Auth::user()->permissions, 'gallery_edit'))

                                {!! Form::open(['url' => '/admin/gallery/'.$cat->id.'/edit', 'files' => true]) !!}
                                    @csrf
                                    <div class="row" style="padding: 16px;">


                                        <div class="col-md-7">

                                            {!! Form::label('name','Nombre:') !!}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-keyboard"></i>
                                                    </span>
                                                </div>
                                                {!! Form::text('name', $cat->name, [ 'class' => 'form-control']) !!}
                                            </div>

                                        </div>

                                        <div class="col-md-5">

                                            {!! Form::label('file','Imagen:') !!}
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    {!! Form::file('file', ['class' => 'custom-file-input', 'id' => 'customFile']) !!}
                                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4 col-12">

                                            {!! Form::label('status','Estado:') !!}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </span>
                                                </div>
                                                {!! Form::select('status', [ '0' => 'Borrador', '1' => 'Publicado'], $cat->status, ['class' => 'custom-select']) !!}

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
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">

                        <div class="container-fluid">
                            <div class="panel shadow">

                                <div class="header">
                                    <h2 class="title">
                                        <i class="far fa-image "></i>
                                        Imagen destacada
                                    </h2>
                                </div>
                                <div class="inside">
                                    <img src="{{ url('/multimedia/'.$cat->file_path.'/t_'.$cat->file) }}" class="img-fluid">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

@stop


