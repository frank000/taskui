
<div>
    @if (session()->has('message'))
        <div class="alert alert-success text-red-500">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <div class="col-span-4  inline-flex w-full">
        <div class="col-span-2 sm:col-span-4 w-3/4">
            <x-jet-label for="str_email" value="{{ __('Atividade') }}" />
            <x-jet-input id="str_activity" wire:model="activity.str_desc" type="text" class="mt-1 block w-2/4" disabled/>
        </div>
    </div>
    <x-jet-label for="str_nome" value="{{ __('Selecione uma Data') }}" />
    <select name="data" id="data"  wire:model.lazy="dateValue"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
        <option value=""></option>
    @foreach($dates as $key => $date)
        <option value="{{$key}}">{{$key}}</option>
    @endforeach
    </select>
    @if(isset($hours))
{{--        <input id="p" type="hidden" wire:model="hourValue"  />--}}
        <x-jet-label for="str_nome" value="{{ __('Selecione um Horário') }}" />
        <select name="hours" id="hours"  wire:model.lazy="hourValue"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value=""></option>
            @foreach($hours as $key => $ho)
                <option  {{ ((string)$hourValue ==(string)$key)? 'selected' : '' }} value="{{$key}}">
                    {{$key}}
                </option>
            @endforeach
        </select>

{{--        @if(count($resources) > 0)--}}
            <x-jet-label for="str_nome" value="{{ __('Selecione o Recurso') }}" />
            <select name="resource" id="resource"  wire:model="resourceId"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option></option>
                @foreach($resources as $key => $item)
                    <option value="{{$item['id']}}">
                        {{$item['str_name']}}
                    </option>

                @endforeach
            </select>
{{--        @endif--}}
{{--    @endif--}}
{{--    @if(isset($hourValue))--}}

    <div class="grid w-full gap-4 border-gray-500 border mt-3 p-6 rounded-md">
        <x-jet-label for="str_title" value="{{ __('Informe seus dados para completar o agendamento.') }}" />
        <div class="col-span-6 sm:col-span-4 w-2/4">
            <div class="inline-flex"><x-jet-label for="str_nome" value="{{ __('Cliente') }}" /><span style="color: red">*</span></div>
            <x-jet-input id="str_nome" wire:model.lazy="client.str_nome" type="text" class="mt-1 block w-full"/>
            <x-jet-input-error for="str_nome" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 w-2/4">
            <div class="inline-flex"><x-jet-label for="str_email" value="{{ __('Email') }}" /><span style="color: red">*</span></div>
            <x-jet-input id="str_email" type="text" wire:model.lazy="client.str_email" class="mt-1 block w-full"/>
            <x-jet-input-error for="str_email" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 w-2/4">
            <div class="inline-flex"><x-jet-label for="num_telefone" value="{{ __('Telefone') }}" /><span style="color: red">*</span></div>
            <x-jet-input id="num_telefone" type="text" wire:model.lazy="client.num_telefone"
                         class='mt-1 block w-full' onkeyup="mascaraTel(this)"/>
            <x-jet-input-error for="num_telefone" class="mt-2" />

        </div>
    </div>
        <div class="flex justify-center">
            <a href="#" wire:click="save"
               class="cursor-pointer bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white
               py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Agendar
            </a>
        </div>
    @endif

</div>
<script>


</script>

