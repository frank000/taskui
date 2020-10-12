
<x-jet-form-section submit="save" >
    <x-slot name="title">
        {{ __('Criar atividade') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form" >

        <x-jet-confirmation-modal wire:model="isSaved" type="sucess">
            <x-slot name="title">Aviso</x-slot>
            <x-slot name="content">{{$msg}}</x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('isSaved')" wire:loading.attr="disabled">
                    OK
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-confirmation-modal>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_atividade" value="{{ __('Nome') }}" />
            <x-jet-input id="str_atividade" type="text" class="mt-1 block w-full" wire:model.defer="atividade.str_atividade" />
            <x-jet-input-error for="str_atividade" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_desc" value="{{ __('Descrição') }}" />
            <x-jet-input id="str_desc" type="textarea" class="mt-1 block w-full" wire:model.defer="atividade.str_desc"  />
            <x-jet-input-error for="str_desc" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="temp_periodo" value="{{ __('Tempo em minutos da atividade') }}" />
            <div class="inline-flex"><x-jet-input id="temp_periodo" type="number" class="mt-1 block w-20" wire:model.defer="atividade.temp_periodo"  /> <div class="ml-1 pt-4">Min.</div></div>
            <x-jet-input-error for="temp_periodo" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="str_img" value="{{ __('Imagem') }}" />
            <x-jet-input id="str_img" type="file" class="mt-1 block w-full" wire:model.defer="atividade.str_img"  />
            <x-jet-input-error for="str_img" class="mt-2" />
        </div>


            <div class="col-span-6 sm:col-span-4">
                <div class="inline-flex">

                    <x-jet-label for="dat_inicio" value="{{ __('Início da atividade') }}" />
                    <x-jet-input id="dat_inicio" type="date" class="mt-1 block w-40" wire:model.defer="atividade.dat_inicio"  />
                    <x-jet-input-error for="dat_inicio" class="mt-2" />

                    <x-jet-label for="dat_fim" value="{{ __('Fim da atividade') }}"  class="ml-4"/>
                    <x-jet-input id="dat_fim" type="date" class="mt-1 block w-40" wire:model.defer="atividade.dat_fim"  />
                    <x-jet-input-error for="dat_fim" class="mt-2" />
                </div>

            </div>
        <div class="col-span-6 sm:col-span-4 border-t  @if($custonOpen) bg-white @else bg-indigo-50 @endif">
            <div class="col-span-6 sm:col-span-4 border-t text-center">
                <strong><x-jet-label for="check1" class="cursor-pointer" value="{{ __('Informe os dias  periodos que o serviço sera disponibilizado') }}" wire:click="showPersonalizar"/></strong>
            </div>
        @if(!$custonOpen)

            <div class="col-span-6 sm:col-span-4 inline-flex gap-4" >
                <div class="focus:bg-gray-100"><x-jet-label for="check1" value="{{ __('Todos os dias (7 dias)') }}" />
                <input id="check1" type="checkbox" class="mt-1 block" wire:model="dias.all" @if($custonOpen) disabled @endif/>
                    <x-jet-input-error for="check1" class="mt-2" /></div>

               <div> <x-jet-label for="check2" value="{{ __('Dias uteis(5 dias)') }}" />
                <input id="check2" type="checkbox" class="mt-1 block" wire:model="dias.uteis" @if($custonOpen) disabled @endif/>
                   <x-jet-input-error for="check2" class="mt-2" /></div>
                <div> <x-jet-label for="hor_inicio" value="{{ __('Hora de inicio') }}" />
                    <input id="hor_inicio" type="time" class="mt-1 block" wire:model="dias.hor_inicio" @if($custonOpen) disabled @endif/>
                    <x-jet-input-error for="hor_inicio" class="mt-2" /></div>
                <div> <x-jet-label for="hor_fim" value="{{ __('Hora do términio') }}" />
                    <input id="hor_fim" type="time" class="mt-1 block" wire:model="dias.hor_fim" @if($custonOpen) disabled @endif/>
                    <x-jet-input-error for="hor_fim" class="mt-2" /></div>
            </div>
        @endif
        </div>
        <div class="col-span-6 sm:col-span-4 border-t @if($custonOpen) bg-indigo-50 @else bg-white @endif">
            <div class="col-span-6 sm:col-span-4 border-t text-center">
            <strong><x-jet-label class="cursor-pointer" value="{{ __('Personalizado') }}"  wire:click="showPersonalizar" /></strong>
            </div>
                @if($custonOpen)
                    <div class="gap-4">
                        @foreach($arrDias as $dia)

                            @livewire('componente.check-hour',[ 'dia' => $dia, 'dias' => $dias, 'i' => $i], key($dia))
                            <input type="hidden" value="{{$i++}}" />
                        @endforeach
                    </div>
            @endif
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


