<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Reset Password</title>
</head>
<body>
<div class="w-1/2 max-w-56 p-5">
    <form class="max-w-sm mx-auto" href="{{ route('password.update') }}" method="post">
        @csrf
        {{-- Alert untuk notifikasi jika terjadi error --}}
        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            
        {{-- Alert untuk notifikasi jika berhasil --}}
        @if(session()->has('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session()->get('status') }}
            </div>
        @endif

        <h2>Forgot Your Password ?</h2>
        <p>Please Enter Your Email For Password Reset</p>
        <div class="mb-5">
            <input type="hidden" name="email" value="{{ request('token') }}">
            <label for="password" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" id="email" name="email" value="{{ request('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
            <label for="password" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <label for="password_confirmation" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Confirmation</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <button type="submit" class="border p-4 bg-blue-400">Kirim</button>
    </form>
</div>
</body>
</html>