<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reschedule</title>
</head>
<body>
    <h1>Form Reschedule</h1>
    <form action="{{ route('customer.reschedule') }}" method="post">
        @csrf
        {{ method_field('PUT') }}
        <label for="date">Pilih Tanggal</label>
        <input type="date" name="date" id="date">
        <button type="submit">Simpan</button>
    </form>
</body>
</html>