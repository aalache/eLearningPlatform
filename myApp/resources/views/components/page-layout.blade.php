<!DOCTYPE html>
<html lang="en" class="h-full bg-[#efefef] text-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./../output.css">
    <link rel="stylesheet" href="./../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="h-full bg-[#efefef]">
    {{ $slot }}
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
