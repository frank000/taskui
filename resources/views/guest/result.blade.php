<x-guest-layout>

    <div class="flex justify-center ">
        <div class="text-gray-700 text-center px-4 py-2 m-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            @if (session()->has('message'))
                    <div class="alert alert-success">

                        {{ session('message') }}
                    </div>
            @endif
            </h2>
        </div>

    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-2 p-20 sm:p-10">
                <div class="grid w-full gap-4 border-gray-500 border mt-3 p-6 rounded-md">
                    <div class="inline-flex">
                        <div class="col-span-2 sm:col-span-4 w-3/4">
                            <x-jet-label for="str_email" value="{{ __('Atividade') }}" />
                            <x-jet-input id="str_activity" value="{{session()->get('activity')}}" type="text" class="mt-1 block w-2/4" disabled/>
                        </div>
                        <div class="col-span-2 sm:col-span-4 w-3/4">
                            <x-jet-label for="str_email" value="{{ __('Recurso') }}" />
                            <x-jet-input id="str_activity" value="{{session()->get('resource')}}" type="text" class="mt-1 block w-2/4" disabled/>
                        </div>
                    </div>
                    <div class="inline-flex">
                        <div class="col-span-2 sm:col-span-4 w-3/4">
                            <x-jet-label for="str_email" value="{{ __('Cliente') }}" />
                            <x-jet-input id="str_activity" value="{{session()->get('client')}}" type="text" class="mt-1 block w-2/4" disabled/>
                        </div>

                        <div class="col-span-2 sm:col-span-4 w-3/4">
                            <x-jet-label for="str_email" value="{{ __('Data') }}/{{ __('Hora') }}" />
                            <x-jet-input id="str_activity" value="{{session()->get('date') . ' - ' . session()->get('hour')}}"
                                         type="text" class="mt-1 block w-2/4" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
