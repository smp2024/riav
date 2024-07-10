@extends('master')
@section('title', $section)
@section('css')
<style>
    .cont_ {
        justify-content: center;
        height: 76vh;
        align-items: center;
    }
</style>
@endsection
@section('content')
        <div class="row cont_">

            <div class="col-12 text-center">
                <button id="refSharedWhatsApp"  type="button" class="btn btn-outline-dark" data-whatever="WhatsApp ">
                    WhatsApp
                </button>
            </div>

        </div>
@endsection

@section('scripts')
    <script>

        if (screen.width < 800) {
        console.log('oo');
        $('#main_').removeClass("row");
        }
        $("#refSharedWhatsApp").on('click', function (){
            var telefono = 5554153289;
            var mensaje = 'Se pide información acerca de los servicios de Red Impulso Audiovisual';
            window.open('https://wa.me/' + telefono + '?text=' + mensaje);
        });

    </script>
@endsection
