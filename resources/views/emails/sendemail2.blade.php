<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h1>Halo, {{ $data['name'] }}!</h1>
    <p>Terima kasih telah mendaftar di aplikasi Perpustakaan kami.</p>
    <p><strong>Detail Pendaftaran:</strong></p>
    <ul>
        <li><strong>Nama:</strong> {{ $data['name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
    </ul>
    <p>{{ $data['body'] }}</p>
    <p>Salam, <br>Tim Aplikasi</p>
</body>
</html>
