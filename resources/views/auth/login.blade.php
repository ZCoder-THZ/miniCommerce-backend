<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="container w-[50px] mx-auto">
                <div class=" bg-blue-800 w-[50px]  py-1 rounded-md">
                    <h1 class="text-md  font-bold text-dark text-center">LO</h1>
                    <h1 class="text-md  font-bold text-dark text-center">GO</h1>
                </div>
            </div>
            <h1 class="text-center text-black text-2xl text-bold py-2">Login to Your Account </h1>
            <h1 class="text-gray-600 text-md text-center">Welcome Back !</h1>
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>



            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <div class="flex justify-center items-center ">
                    <a href="{{ route('register') }}" class="text-gray-600 mr-4">don't have account? <span
                            class="text-blue-400 text-md">Register</span></a>
                    <x-button class="ml-4">
                        {{ __('login') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
