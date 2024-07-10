@extends('master')
@section('title', $section)
@section('content')


    @if ($section == 'inicio')
        @include('blog.sections.home')
    @elseif ($section == 'contactos')
        @include('blog.sections.contactos')
    @endif

@endsection

@section('scripts')
    <script>

        if (screen.width < 800) {
        console.log('oo');
        $('#main_').removeClass("row");
        }
    </script>
@endsection
