
<x-jet-form-section submit="save" >
    <x-slot name="title">
        {{ __('Criar atividade') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_ativiade" value="{{ __('Nome') }}" />
            <x-jet-input id="str_ativiade" type="text" class="mt-1 block w-full" wire:model.defer="atividade.str_ativiade" />
            <x-jet-input-error for="str_ativiade" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_desc" value="{{ __('Descrição') }}" />
            <x-jet-input id="str_desc" type="textarea" class="mt-1 block w-full" wire:model.defer="atividade.str_desc"  />
            <x-jet-input-error for="str_desc" class="mt-2" />
        </div>


    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Criar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
