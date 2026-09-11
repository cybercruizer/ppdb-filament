<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pendaftaran Calon Murid Baru' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-slate-50">
    {{ $slot }}

    @livewireScripts
</body>

</html>