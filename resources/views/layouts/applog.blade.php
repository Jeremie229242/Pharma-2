<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('v1/styles/index.css')}}">
    <link rel="stylesheet" href="{{asset('v1/styles/tailwind.css')}}">
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

<script>
        window.Laravel = {!! json_encode([
            'userId' => auth()->check() ? auth()->id() : null,
        ]) !!};
    </script>
</body>
</html>





















