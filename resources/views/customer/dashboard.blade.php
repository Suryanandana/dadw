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
    {{-- Check $data is $data = null? --}}
    @if (!empty($data))
    {{-- If $data not null, do this down below condition(if statment) --}}
        <table border="1">
            <tr>
                <td>Status</td>
                <td>Pax</td>
                <td>Date</td>
                <td>Service Name</td>
                <td>Room Type</td>
                <td>Total</td>
                <td>Aksi</td>
            </tr>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->status_booking }}</td>
                    <td>{{ $item->pax }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->service_name }}</td>
                    <td>{{ $item->room_name }}</td>
                    {{-- Calculate total price --}}
                    <td>{{ $item->price * $item->pax }}</td>
                    <td>
                        <a href="{{ route('reschedule-form') }}">Reschedule</a>
                        {{-- 
                            *NOTE* : The delete button must use the form
                                    because it is necessary to define the DELETE method
                        --}}
                        <form action="{{ route('cancellation/'.$item->id) }}" method="post" onclick="return confirm('Are you sure you want to cancel this reservation?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </table>
    @else
        {{-- if $data is null then show this text --}}
        <p>Anda belum memiliki reservasi apapun</p>
    @endif
</body>
</html>