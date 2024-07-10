@extends('master')

@section('content')

    <!--- Image Slider -->
        @include('blog.sections.home')


@endsection

@section('scripts')
    <script src="{{ asset('js/video.js') }}"></script>
@endsection
