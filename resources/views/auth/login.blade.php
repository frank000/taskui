<header class=" bg-cover border-t-2 border-blue-600 h-full" style="background-image: url('https://images.pexels.com/photos/57690/pexels-photo-57690.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

    <div class="content px-8 py-2">
        <nav class="flex items-center justify-between">
            <div class="font-extrabold tracking-widest text-xl text-white">
                <a href="#" class="transition duration-500 hover:text-indigo-500">AGENDRIX | taskUI</a>
            </div>
            <div class="auth flex items-center">

{{--                <button class="bg-transparent text-gray-200  p-2 rounded border border-gray-300 mr-4 hover:bg-gray-100 hover:text-gray-700">Sign in</button>--}}
{{--                <button class="bg-gray-900 text-gray-200  py-2 px-3 rounded  hover:bg-gray-800 hover:text-gray-100">Sign up for free</button>--}}
            </div>
        </nav>
        <div class="body mt-20 mx-8">

            <div class="md:flex items-center justify-between">
                <div class="w-full md:w-1/2 mr-auto" style="text-shadow: 0 10px 20px hsla(0,0%,0%,8);">
                    <h2 class=" text-2xl font-bold text-white tracking-wide">Seja muito<span class="text-gray-200"> bem-vindo</span></h2>
                    <p class="text-gray-300">
                        A nossa proximidade é fator de sucesso.
                    </p>
                    <h1 class="text-4xl font-bold text-white tracking-wide"></h1>



                </div>
                <div class="w-full md:max-w-md mt-6">
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card bg-white shadow-md rounded-lg px-4 py-4 mb-6 ">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="flex items-center justify-center">
                                <h2 class="text-2xl font-bold tracking-wide">
                                    <img src="{{asset('/img/logo_login.png')}}"/>
                                </h2>
                            </div>
                            <h2 class="text-xl text-center font-semibold text-gray-800 mb-2">
                                {{__("Login")}}
                            </h2>
                            <x-jet-input class="rounded px-4 w-full py-1 bg-gray-200  border border-gray-400 mb-6 text-gray-700 placeholder-gray-700 focus:bg-white focus:outline-none" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />

                            <x-jet-input class="ounded px-4 w-full py-1 bg-gray-200  border border-gray-400 mb-4 text-gray-700 placeholder-gray-700 focus:bg-white focus:outline-none" type="password" name="password" placeholder="Password" required autocomplete="current-password" />

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar me') }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('password.request') }}" class="text-gray-600">{{__("Esqueceu sua senha?")}}</a>
                                <x-jet-button class="ml-4">
                                    {{ __('Login') }}
                                </x-jet-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
