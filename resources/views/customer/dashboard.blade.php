<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h1>Hallo {{ $user->name }}</h1>
    {{-- Cek apakah customer memiliki reservasi atau tidak --}}
    @if (!empty($data))
    {{-- jika ada data reservasi maka tampilkan data reservasi customer --}}
        <table border="1">
            <tr>
                <td>Status</td>
                <td>Pax</td>
                <td>Date</td>
                <td>Customer Name</td>
                <td>Aksi</td>
            </tr>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->status_booking }}</td>
                    <td>{{ $item->pax }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="{{ route('reschedule-form') }}">Reschedule</a>
                        {{-- 
                            *NOTE :*  tombol delete harus menggunakan form
                                    karena perlu mendifinisikan method DELETE
                        --}}
                        <form action="{{ route('cancellation') }}" method="post" onclick="return confirm('Are you sure you want to cancel this reservation?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </table>
    @else
        {{-- jika tidak maka tampilkan tulisan berikut --}}
        <p>Anda belum memiliki reservasi apapun</p>
    @endif
</body>
</html>