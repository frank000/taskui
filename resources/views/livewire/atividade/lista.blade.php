<div>
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <style>

        /*Overrides for Tailwind CSS */

        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568; 			/*text-gray-700*/
            padding-left: 1rem; 		/*pl-4*/
            padding-right: 1rem; 		/*pl-4*/
            padding-top: .5rem; 		/*pl-2*/
            padding-bottom: .5rem; 		/*pl-2*/
            line-height: 1.25; 			/*leading-tight*/
            border-width: 2px; 			/*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7; 		/*border-gray-200*/
            background-color: #edf2f7; 	/*bg-gray-200*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;	/*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button		{
            font-weight: 700;				/*font-bold*/
            border-radius: .25rem;			/*rounded*/
            border: 1px solid transparent;	/*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current	{
            color: #fff !important;				/*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
            font-weight: 700;					/*font-bold*/
            border-radius: .25rem;				/*rounded*/
            background: #667eea !important;		/*bg-indigo-500*/
            border: 1px solid transparent;		/*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
            color: #fff !important;				/*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
            font-weight: 700;					/*font-bold*/
            border-radius: .25rem;				/*rounded*/
            background: #667eea !important;		/*bg-indigo-500*/
            border: 1px solid transparent;		/*border border-transparent*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important; /*bg-indigo-500*/
        }

    </style>
{{--    <h1>LISTA</h1>--}}
{{--    <div class="grid grid-cols-5 gap- w-full ">--}}
{{--        <div class="col-span-1 w-1/5">Ações</div>--}}
{{--        <div class="col-span-1 w-1/5">Atividade</div>--}}
{{--        <div class="col-span-1 w-1/5"> Inicio</div>--}}
{{--        <div class="col-span-1 w-1/5">Fim</div>--}}
{{--        <div class="col-span-1 w-1/5">Período</div>--}}

{{--    </div>--}}
{{--    @foreach($atividades as $ati)--}}
{{--        @if(count($ati->semanaPeriodos) > 0)--}}


{{--        @endif--}}
{{--    @endforeach--}}



<!--Container-->
    <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
        @if (session()->has('message'))
                  <div id="message" class="alert alert-success bg-gray-100 h-20 rounded-lg">
                <div class="flex justify-end bg-gray-200 p-2 rounded-t-lg">
                    <svg class="w-6 h-6 align cursor-pointer" fill="none" stroke="currentColor" onclick="closeMesssage()"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path></svg>
                </div>
                <div class="p-2">
                    <p class="text-red-500">{{ session('message') }}</p>
                </div>
            </div>
        @endif
        <!--Title-->
        <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
            Atividades
        </h1>


        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                <tr>
                    <th data-priority="1">Ações</th>
                    <th data-priority="2">Atividade</th>
                    <th data-priority="3">Início</th>
                    <th data-priority="4">Fim</th>
                    <th data-priority="5">Período</th>
                </tr>
                </thead>
                <tbody>
                @foreach($atividades as $ati)
                    <tr>
                        <td class="inline-flex">
                            <span title="{{__('Resumo')}}">
                                <a href="/adm/atividades/show/{{$ati->id}}"
                                   class="hover:text-indigo-400"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">

                                        </path></svg>
                                </a>
                            </span>
                            <span title="{{__('Excluir')}}">
                                <a
{{--                                    href="/adm/atividades/delete/{{$ati->id}}"--}}
                                   wire:click="setDelete(true,'{{$ati->id}}')"
                                   class="text-red-700 hover:text-red-400 cursor-pointer"><svg class="w-6 h-6" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5
                                               4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">

                                        </path></svg>
                                </a>
                            </span>
                        </td>
                        <td>{{$ati->str_atividade}}</td>
                        <td>{{$ati->dat_inicio}}</td>
                        <td>{{$ati->dat_fim}}</td>
                        <td>{{$ati->temp_periodo}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>


        </div>
        <!--/Card-->


    </div>
    <!--/container-->



    <x-jet-dialog-modal wire:model="displaying">
        <x-slot name="title">
            <span class="inline-flex">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0
                          013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138
                          3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0
                          00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                    </path></svg>
                {{ __('Confirmação') }}
            </span>
        </x-slot>
        <x-slot name="content">
            <div>
                {{ __('Você tem certeza que deseja excluir a atividade?') }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="delete" >
                {{ __('Deletar') }}
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Fechar') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = grid('#example', "atividades");

            Livewire.on('reloadGridEvent', id => {
                $('#example').dataTable()._fnInitialise()
            })
        } );

    </script>

</div>
