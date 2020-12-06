<x-guest-layout>

    <div class="flex justify-center ">
        <div class="text-gray-700 text-center px-4 py-2 m-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agendamento Remoto') }}
            </h2>
        </div>

    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-2 p-20 sm:p-10">


                @livewire('guest.selection',['dates'=>$dates])


            </div>

        </div>

    </div>

</x-guest-layout>
