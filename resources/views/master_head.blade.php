<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tenzir telefonia</title>
    <link rel="icon" href="{{ asset('images/about-us.webp') }}">

    <!-- App CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('externalfeatures/bootstrap.css') }}" rel="stylesheet">
</head>

@include('components/loader_of_page')
@include('components/toast_messager')
@include('components/modal')

<script src="{{ asset('externalfeatures/bootstrap.js') }}"></script>
<script src="{{ asset('externalfeatures/jquery.js') }}"></script>
<script>
    /* Ajax Area */
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>