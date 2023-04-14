<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoLapang.id</title>
</head>

<body>
    <b>Kode OTP : {{ $details['code'] }}</b> untuk aplikasi ngelapang. Kode ini hanya berlaku selama
    {{ env('OTP_EXPIRED') }}
    menit. Jangan berikan
    kode rahasia ini kepada siapapun, termasuk pihak yang mengaku dari GoLapang.
    <br>
    - Terima kasih -
</body>

</html>
