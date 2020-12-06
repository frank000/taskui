<div class="col-span-1 inline-flex gap-6">
    <x-jet-label for="{{strtolower($dia) }}" value="{{ __($dia) }}" />
    <input id="{{strtolower($dia)}}" type="checkbox" class="mt-1 " wire:model="dias.{{strtolower($dia)}}" />
    <x-jet-input-error for="{{strtolower($dia)}}" class="mt-2" />
    <div>
        <x-jet-label for="hor_inicio_man_p" value="{{ __('Hora de inicio') }}" />
        <input id="hor_inicio_man_p" type="time" class="mt-1 block" wire:model="dias.hor_inicio_man_p"/>
        <x-jet-input-error for="hor_inicio_man_p" class="mt-2" />
    </div>
    <div>
        <x-jet-label for="hor_fim_man_p" value="{{ __('Hora do términio') }}" />
        <input id="hor_fim_man_p" type="time" class="mt-1 block" wire:model="dias.hor_fim_man_p" />
        <x-jet-input-error for="hor_fim_man_p" class="mt-2" />
    </div>
    <div>
        <x-jet-label for="hor_inicio_tar_p" value="{{ __('Hora de inicio') }}" />
        <input id="hor_inicio_tar_p" type="time" class="mt-1 block" wire:model="dias.hor_inicio_tar_p"/>
        <x-jet-input-error for="hor_inicio_tar_p" class="mt-2" />
    </div>
    <div>
        <x-jet-label for="hor_fim_tar_p" value="{{ __('Hora do términio') }}" />
        <input id="hor_fim_tar_p" type="time" class="mt-1 block" wire:model="dias.hor_fim_tar_p" />
        <x-jet-input-error for="hor_fim_tar_p" class="mt-2" />
    </div>
</div>

