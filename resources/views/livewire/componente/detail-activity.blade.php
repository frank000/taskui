<br><br>
<div class="col-span-6 sm:col-span-4 border-t text-center">
    <strong><x-jet-label class="cursor-pointer text-lg" value="{{ __('Resumo') }}"  wire:click="showPersonalizar" /></strong>
</div>
<br>
<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="str_atividade" value="{{ __('Nome') }}" />
    <x-jet-input id="str_atividade" type="text" class="mt-1 block w-full" value="{{$atividade['str_atividade']}}" disabled />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="str_atividade" value="{{ __('Descrição') }}" />
    <x-jet-input id="str_atividade" type="text" class="mt-1 block w-full" value="{{$atividade['str_desc']}}" disabled />
</div>
<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="str_atividade" value="{{ __('Período') }}" />
    <x-jet-input id="str_atividade" type="text" class="mt-1 block w-full" value="{{$atividade['temp_periodo']}} Min." disabled/>
</div>
<div class="col-span-6 sm:col-span-4">
    <div class="inline-flex">
        <x-jet-label for="dat_inicio" value="{{ __('Início da atividade') }}" />
        <x-jet-input id="dat_inicio" type="date" class="mt-1 block w-50" value="{{$atividade['dat_inicio']}}"  disabled/>

        <x-jet-label for="dat_fim" value="{{ __('Fim da atividade') }}"  class="ml-4"/>
        <x-jet-input id="dat_fim" type="date" class="mt-1 block w-50" value="{{$atividade['dat_fim']}}" disabled  />
    </div>
</div>
<div class="col-span-6 sm:col-span-4">

    <x-jet-label for="str_atividade" value="{{ __('Recursos') }}" />
@foreach($resources as $rec)

        <x-jet-input id="rec" type="text" class="mt-1 block w-full" value="{{$rec['resource'] . $rec['dias'] }}" disabled/>

@endforeach
    @if(!$isCreate)
    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
    font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none
     focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
       href="/adm/atividades/create/{{$ids}}">
        {{ __('Editar') }}
    </a>
     @endif
</div>
