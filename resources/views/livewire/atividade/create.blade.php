<x-jet-form-section submit="save" xmlns="">
    <x-slot name="title">
        {{ __('Criar atividade') }}
    </x-slot>

    <x-slot name="description">
        {{ __('A atividade é o serviço que você irá oferecer a seu cliente. Obs.: E interessante que entender o responsável pela execução
dessa atividade, será o recurso que você criou anteriormente.') }}
    </x-slot>

    <x-slot name="form" >

        <x-jet-confirmation-modal wire:model="isSaved" type="sucess">
            <x-slot name="title">Aviso</x-slot>
            <x-slot name="content">{{$msg}}</x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('isSaved')" wire:click="redirectPage" wire:loading.attr="disabled">
                    OK
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-confirmation-modal>
    @if($pageScreen == 1)
            <div class="col-span-6 sm:col-span-4">
                <img src="{{asset('/img/task.png')}}" width="110%"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="str_atividade" value="{{ __('Nome') }}" />
                <x-jet-input id="str_atividade" type="text" class="mt-1 block w-full" wire:model="atividade.str_atividade" />
                <x-jet-input-error for="str_atividade" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="str_desc" value="{{ __('Descrição') }}" />
                <x-jet-input id="str_desc" type="textarea" class="mt-1 block w-full" wire:model="atividade.str_desc"  />
                <x-jet-input-error for="str_desc" class="mt-2" />
            </div>



            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="temp_periodo" value="{{ __('Tempo em minutos da atividade') }}" />
                <div class="inline-flex"><x-jet-input id="temp_periodo" type="number" class="mt-1 block w-20" wire:model="atividade.temp_periodo"  /> <div class="ml-1 pt-4">Min.</div></div>
                <x-jet-input-error for="temp_periodo" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="str_img" value="{{ __('Imagem') }}" />
                <x-jet-input id="str_img" type="file" class="mt-1 block w-full" wire:model="atividade.str_img"  />
                <x-jet-input-error for="str_img" class="mt-2" />
            </div>


                <div class="col-span-6 sm:col-span-4">
                    <div class="inline-flex">

                        <x-jet-label for="dat_inicio" value="{{ __('Início da atividade') }}" />
                        <x-jet-input id="dat_inicio" type="date" class="mt-1 block w-50" wire:model="atividade.dat_inicio"  />
                        <x-jet-input-error for="dat_inicio" class="mt-2" />

                        <x-jet-label for="dat_fim" value="{{ __('Fim da atividade') }}"  class="ml-4"/>
                        <x-jet-input id="dat_fim" type="date" class="mt-1 block w-50" wire:model="atividade.dat_fim"  />
                        <x-jet-input-error for="dat_fim" class="mt-2" />
                    </div>

                </div>

    @elseif($pageScreen == 2)
            <div class="col-span-6 sm:col-span-4">
                    <img src="{{asset('/img/task2.png')}}" width="110%"/>

            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="str_name" value="{{ __('Recurso') }}" />
                <div class="inline-block relative w-64">
                    <select name="type_resource" id="type_resource"  wire:model="resourceObj"  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        <option value="s">asda</option>
                        @foreach($resources as $rec)
                            <option value="{{\App\Http\Service\TokenService::tokenizer($rec->id)->id}}">
                                {{$rec->str_name}}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                <x-jet-input-error for="type_resource" class="mt-2" />


            </div>
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="check2" value="{{ __('Informe os dias e periodos que o serviço será disponibilizado') }}" />
            <div class="space-y-4 pb-2 pl-2 col-span-6 sm:col-span-4 border-t gap-4  @if($custonOpen) bg-white @else bg-indigo-50 @endif">
                <div class=" sm:col-span-4 border-t text-center mb-4 ">
                    <strong>
                        <x-jet-label for="check1" class="cursor-pointer text-lg" value="{{ __('Padrão') }}" wire:click="showPersonalizar"/>
                    </strong>
                </div>
                    @if(!$custonOpen)

                            <div class=" sm:col-span-4 inline-flex gap-6" >
                                <div class="focus:bg-gray-100"><x-jet-label for="check1" value="{{ __('Todos os dias (7 dias)') }}" />
                                    <input id="all" type="checkbox" class="mt-1 block" wire:model="dias.all" @if(isset($dias['uteis']) && $dias['uteis']) disabled @endif/>
                                    <x-jet-input-error for="all" class="mt-2" /></div>

                                <div> <x-jet-label for="check2" value="{{ __('Dias uteis(5 dias)') }}" />
                                    <input id="uteis" type="checkbox" class="mt-1 block" wire:model="dias.uteis" @if(isset($dias['all']) && $dias['all']) disabled @endif/>
                                    <x-jet-input-error for="uteis" class="mt-2" />
                                </div>
                            </div>
                            <div class=" sm:col-span-4 inline-flex gap-4" >
                                <div> <x-jet-label for="hor_inicio_man" value="{{ __('Hora de inicio - manhã') }}" />
                                    <input id="hor_inicio_man" type="time" class="mt-1 block" wire:model="dias.hor_inicio_man" @if($custonOpen) disabled @endif/>
                                    <x-jet-input-error for="hor_inicio_man" class="mt-2" />
                                </div>

                                <div> <x-jet-label for="hor_fim_man" value="{{ __('Hora do términio - manhã') }}" />
                                    <input id="hor_fim_man" type="time" class="mt-1 block" wire:model="dias.hor_fim_man" @if($custonOpen) disabled @endif/>
                                    <x-jet-input-error for="hor_fim_man" class="mt-2" />
                                </div>
                                <div> <x-jet-label for="hor_inicio_tar" value="{{ __('Hora de inicio - tarde') }}" />
                                    <input id="hor_inicio_tar" type="time" class="mt-1 block" wire:model="dias.hor_inicio_tar" @if($custonOpen) disabled @endif/>
                                    <x-jet-input-error for="hor_inicio_tar" class="mt-2" />
                                </div>

                                <div> <x-jet-label for="hor_fim_tar" value="{{ __('Hora do términio - tarde') }}" />
                                    <input id="hor_fim_tar" type="time" class="mt-1 block" wire:model="dias.hor_fim_tar" @if($custonOpen) disabled @endif/>
                                    <x-jet-input-error for="hor_fim_tar" class="mt-2" />
                                </div>
                            </div>
                    @endif
            </div>
            <div class="col-span-6 sm:col-span-4 border-t @if($custonOpen) bg-indigo-50 @else bg-white @endif">
                <div class="col-span-6 sm:col-span-4 border-t text-center">
                    <strong><x-jet-label class="cursor-pointer text-lg" value="{{ __('Personalizado') }}"  wire:click="showPersonalizar" /></strong>
                </div>
                @if($custonOpen)
                    <div class="grid grid-cols-1  gap-4">
                        @foreach($arrDias as $dia)

                            @livewire('componente.check-hour',[ 'dia' => $dia, 'dias' => $dias, 'i' => $i], key($dia))
                            <x-jet-input-error for="erroInput_{{strtolower($dia)}}" class="mt-2" />
                            <input type="hidden" value="{{$i++}}" />
                        @endforeach

                    </div>
                @endif
            </div>
            </div>
            <div class="col-span-6 sm:col-span-4 justify-end inline-flex">
                <a class="cursor-pointer inline-flex items-center px-1 py-1 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 "
                   wire:click="addResource" >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </a>
            </div>
            <div class="col-span-6 sm:col-span-4 space-y-4">
{{--                <livewire:componente.inner-resource :resources="$resourcesArr"/>--}}
                @livewire('componente.inner-resource', ['resources' => $resourcesArr])
            </div>


    @elseif($pageScreen == 3)
            <div class="col-span-6 sm:col-span-4">
                <div class="col-span-6 sm:col-span-4">
                    <img src="{{asset('/img/task3.png')}}" width="110%"/>
                </div>
                @livewire('componente.detail-activity',['atividade' => $atividade, 'resources' => $resourcesArr, 'isCreate' => true])
            </div>

    @endif

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        @if($pageScreen != 1)
            <a class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-15"
               wire:click="backPage({{$pageScreen}})" >
                Voltar
            </a>
        @endif
        @if($pageScreen != 3)
            <a class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-15"
               wire:click="changePage({{$pageScreen}})" >
                Próximo
            </a>
        @endif
        @if($pageScreen == 3)
            <x-jet-button id="btn_concluir" href="#">
                {{ __('Concluir') }}
            </x-jet-button>
        @endif

    </x-slot>
</x-jet-form-section>
<script>
    $(document).ready(function(){
        $(document).on('click','#btn_concluir',function (){
            carregando(true)
        })
        Livewire.on('selectResourceEvent', function (){
            //alert('Favor relacionar ao menos um recurso para a execução da atividade.')
             massageAlert({title:'Alerta',msg:'Favor relacionar ao menos um recurso para a execução da atividade.'})
        });

        Livewire.on('hideLoadingEvent', function (){
            carregando(false);
        });


    });


</script>

