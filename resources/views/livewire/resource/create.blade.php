
<x-jet-form-section submit="save" >
    <x-slot name="title">
        @if($isEdit)
            {{ __('Editar recurso') }}
        @else
            {{ __('Criar recurso') }}
        @endif
    </x-slot>

    <x-slot name="description">
        {{ __('Os recursos são importantes, pois eles são responsáveis pela execução da sua atividade.') }}
    </x-slot>

    <x-slot name="form" >

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_name" value="{{ __('Nome') }}" />
            <x-jet-input id="str_name" type="text" class="mt-1 block w-full" wire:model.defer="resource.str_name" />
            <x-jet-input-error for="str_name" class="mt-2" />

        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_name" value="{{ __('Tipo de recurso') }}" />
            <div class="inline-block relative w-64">
                <select name="type_resource" id="type_resource_id" wire:model="resource.type_resource_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value=""></option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->str_type}}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <x-jet-input-error for="type_resource_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            @if($typeId == \App\Models\Constant::TYPE_PESSOA)

            @endif

        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            @if($isEdit)
                {{ __('Editar') }}
            @else
                {{ __('Criar') }}
            @endif
        </x-jet-button>

    </x-slot>
</x-jet-form-section>


