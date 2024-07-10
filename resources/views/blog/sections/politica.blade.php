@foreach ($politicas as $politic)

    @extends('master')

    @section('title',  $politic->name )

    @section('content')

        <div id="" class="col-12 h-100">
            <div class="row h-100  justify-content-center align-content-center">
                <h1>{{  $politic->name}}</h1>
            </div>
        </div>

    @endsection

    @section('scripts')
    @endsection

@endforeach
