<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agenda da atividade') }}
        </h2>
    </x-slot>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-20 mb-6 pb-10">

                    <div class="flex justify-center">
                        <a href="/adm/atividades" class="cursor-pointer bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                            Voltar
                        </a>
                    </div>
                    @livewire('componente.detail-activity',['atividade' => $atividade, 'resources' => $resourcesArr, 'ids' => $ids])

                </div>
            </div>
        </div>

</x-app-layout>
