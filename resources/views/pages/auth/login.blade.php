@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="bg-gray-100 min-h-screen flex items-center justify-center">

        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
            @php $lang = app()->getLocale(); @endphp

            <div class="absolute top-4 right-4 text-sm space-x-2">
                <a href="/lang/en"
                    class="px-2 py-1 rounded {{ $lang == 'en' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                    EN
                </a>

                <a href="/lang/id"
                    class="px-2 py-1 rounded {{ $lang == 'id' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                    ID
                </a>
            </div>

            <!-- Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">{{ __('Login') }}</h1>
                <p class="text-gray-500 mt-2"> {{ __('Subtitle_login') }} </p>
            </div>

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                {{ csrf_field() }}

                @if ($errors->any())
                    <div class="text-red-500 mb-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <!-- usename -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Username') }}
                    </label>
                    <input type="text" name="name" placeholder="Username"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Password') }}
                    </label>

                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="••••••••"
                            class="w-full px-4 py-2 pr-12 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>

                        <!-- Eye Button -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            <!-- Eye open -->
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                   c4.477 0 8.268 2.943 9.542 7
                                                   -1.274 4.057-5.065 7-9.542 7
                                                   -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- Eye close -->
                            <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                                   c-4.478 0-8.27-2.943-9.543-7
                                                   a9.956 9.956 0 012.042-3.362M6.223 6.223
                                                   A9.956 9.956 0 0112 5c4.478 0 8.27 2.943 9.543 7
                                                   a9.953 9.953 0 01-4.132 5.411M15 12a3 3 0 00-3-3
                                                   m0 0a3 3 0 00-3 3m3-3l0 6m-9-9l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>



                <!-- Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    {{ __('Sign In') }}
                </button>
            </form>

            <!-- Register -->
            {{-- <p class="text-center text-sm text-gray-500 mt-6">
                {{ __('Dont_have_account') }}
                <a href="/register" class="text-blue-600 hover:underline">
                    {{ __('Register') }}
                </a>
            </p> --}}


        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const open = document.getElementById('eyeOpen');
            const close = document.getElementById('eyeClose');

            if (input.type === 'password') {
                input.type = 'text';
                open.classList.add('hidden');
                close.classList.remove('hidden');
            } else {
                input.type = 'password';
                open.classList.remove('hidden');
                close.classList.add('hidden');
            }
        }
    </script>


@endsection
