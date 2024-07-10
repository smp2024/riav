@extends('admin.master')
@section('title', 'Ediat Carousel')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/areas') }}">
            <i class="fal fa-layer-group"></i>
            Modulos principales
        </a>
    </li>
        <li class="breadcrumb-item">
        <a href="{{ url('/admin/area/'.$area->id.'/edit') }}">
            <i class="fal fa-layer-group"></i>
           {{$area->name}}
        </a>
    </li>



@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-9 p-0">
                <div class="container-fluid">
                    <div class="panel shadow">
                            <div class="header">
                                <h2 class="title">
                                   <i class="fal fa-edit"></i>
                                    Editar {{$area->name}}
                                </h2>
                            </div>
                        <div class="inside">

                            @if (kvfj(Auth::user()->permissions, 'area_edit'))

                                {!! Form::open(['url' => '/admin/area/'.$area->id.'/edit', 'files' => true]) !!}
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
                                                {!! Form::text('name', $area->name, [ 'class' => 'form-control']) !!}
                                            </div>

                                        </div>
                                       

                                        <div class="col-md-5 col-12 ">

                                            {!! Form::label('status','Estado:') !!}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </span>
                                                </div>
                                                {!! Form::select('status', [ '0' => 'Borrador', '1' => 'Publicado'], $area->status, ['class' => 'custom-select']) !!}

                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6 mt16">

                                            {!! Form::label('file','Imagen:') !!}
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    {!! Form::file('file', ['class' => 'custom-file-input', 'id' => 'customFile']) !!}
                                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                                </div>
                                            </div>

                                        </div>

                                        
                                       <div class="col-md-6 mt16">

                                            {!! Form::label('orden','Orden:') !!}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-sort-amount-down"></i>
                                                    </span>
                                                </div>
                                                {!! Form::text('orden', $area->orden, [ 'class' => 'form-control']) !!}
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

            <div class="col-md-3 p-0">
                <div class="row">
                    <div class="col-md-12">

                        <div class="container-fluid">
                            <div class="panel shadow">

                                <div class="header">
                                    <h2 class="title">
                                        <i class="far fa-image "></i>
                                        Imagen
                                    </h2>
                                </div>
                                <div class="inside">
                                    <img src="{{ url('/multimedia/'.$area->file_path.'/t_'.$area->file) }}" class="img-fluid">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

@stop


