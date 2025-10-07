<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('v1/styles/index.css')}}">
    <link rel="stylesheet" href="{{asset('v1/styles/tailwind.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <title>Document</title>
</head>
<body>





<section class="relative w-full h-full  min-h-screen">
<div
    class="absolute top-0 w-full h-full bg-blueGray-800 bg-no-repeat bg-cover"
    style="background-image: url('{{ asset('v1/img/register_bg_2.png') }}');"
>


@yield('contenu')

    </div>

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
        window.Laravel = {!! json_encode([
            'userId' => auth()->check() ? auth()->id() : null,
        ]) !!};
    </script>
     @if(session('success'))
    <script>
        $(document).ready(function() {
            Toastify({
                text: "{{session('success')}}",
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: " #00b09b",
                },
                onClick: function(){} // Callback after click
            }).showToast();
        });
    </script>
@endif

@if(session('error'))
    <script>
        $(document).ready(function() {
            Toastify({
                text: "{{session('error')}}",
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: " #ff5f6d",
                },
                onClick: function(){} // Callback after click
            }).showToast();
        });
    </script>
@endif
@include('sweetalert::alert')
</body>
</html>





















