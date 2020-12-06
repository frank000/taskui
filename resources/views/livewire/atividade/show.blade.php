<div>
    <link href='{{asset('js/calendar/main.css')}}' rel='stylesheet' />
<script src='{{asset('js/calendar/main.js')}}'></script>
<script src='{{asset('js/funcs.js')}}'></script>
<script src='{{asset('js/calendar/locales/pt-br.js')}}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script>

        function renderCalendar(idActivity, idResource)
        {
            console.log(idResource)
            if (idResource == undefined || idResource == "")
                return false;


            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: '80%',
                locale: 'pt-br',
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,listDay,listWeek'
                },
                expandRows: true,
                contentHeight: 'auto',
                dayMaxEvents: true,
                events: '{{url('/api/agenda/')}}/'+idActivity + '_' + idResource,
                dayMaxEvents: 5,
                eventClick: function(info) {

                    // alert('Event: ' + info.event.id);

                    // change the border color just for fun
                },

                eventClassNames: function (info) {
                    //info.el.id = info.event.id;
                    return "identiclass_" + info.event.id;

                },



            });
            calendar.render();
        }

        function cancelAgenda()
        {
            Livewire.emit('cancelAgendaEvent',  $('#p').val() )
        }

        function closeAgenda()
        {
            Livewire.emit('closeAgendaEvent',   $('#idAgenda').val() )
        }

        function openAgenda()
        {
            Livewire.emit('openAgendaEvent',   $('#idAgenda').val() )
        }
        function openPrintQrCode()
        {
            var url = "{{ url('/adm/atividades/pdf-general-code/') }}" + "/" + $('#p').val();
            window.open(url );
        }

    $(document).ready(function(){
        $('[name=activity] option').each(function(name, val){
            if($(this).val() == $('#p').val())
            {
                $(this).attr('selected','true')
            }
        })
        $('#myModal').modal('show');
        $(document).on('click','[class*="identiclass"]', function (e){
            //reponsavel por retornar o ID
            var classList =  $(this).attr("class");
            var classArr = classList.split(/\s+/);
            var resultString;
            classArr.forEach(function(classe){
                if(classe.indexOf('identiclass') > -1){
                    resultString = classe;
                }
            });
            var matches = resultString.split('_');
            var idAgenda = matches[1]; // _my_string
            // console.log('val e ' + idAgenda);
            //lança o emit
            // $('#idAgenda').val(idAgenda);
            Livewire.emit('modalAgendaEvent',idAgenda) //mostra a modal

        } );
        //mostra
        Livewire.on('renderCalendarEvent', postId => {
            renderCalendar($('#p').val(), postId);
        })
        //mostra modal evento vindo o php
        Livewire.on('showEvent', postId => {
            $('#exampleModal').modal('show');
            renderCalendar($('#p').val(), $('[name=resource]').val());
        })
        //hide modal evento vindo o php
        Livewire.on('linkAgendaEndEvent', postId => {
            $('#exampleModal').modal('hide');
            massage({title:'Aviso',
                     msg: 'Agendamento realizado.',   });
            renderCalendar($('#p').val(), $('[name=resource]').val());
        })

        Livewire.on('closeAgendaEndEvent', postId => {
            $('#exampleModal').modal('hide');
            massage({title:'Aviso',
                     msg: 'Agendamento fechado com sucesso.',   });
            renderCalendar($('#p').val(), $('[name=resource]').val());
        })
        Livewire.on('cancelAgendaEndEvent', postId => {
            $('#exampleModal').modal('hide');
            massage({title:'Aviso',
                     msg: 'Agendamento cancelado com sucesso.',   });
            renderCalendar($('#p').val(), $('[name=resource]').val());
        })
        Livewire.on('returnEndEvent', function(event){
            $('#exampleModal').modal('hide');
            massage({title:event.title,
                msg: event.msg,   });
            renderCalendar($('#p').val(), $('[name=resource]').val());
        })

        $(document).on('click','#linkerAgenda',function (){
            Livewire.emit('linkAgendaEvent', {
                str_nome:$('#nome').val(),
                str_email:$('#email').val(),
                num_telefone:$('#telefone').val()
            }) //mostra a modal
        })
    });
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>

    html, body {

        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar-container {
        margin: 0 10vw;
        width: 70%;
        position: relative;

        left: 0;
        right: 0;
        bottom: 0;
    }

    .fc-header-toolbar {
        /*
        the calendar will be butting up against the edges,
        but let's scoot in the header's buttons
        */
        padding-top: 1em;
        padding-left: 1em;
        padding-right: 1em;
    }
    .modal-footer-my{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;

        padding: 1rem;
        border-top: 1px solid #e9ecef;
    }

    /*INICIO*/
    /* Dropup Button */
    .dropbtn {

        color: white;

        font-size: 16px;
        border: none;
    }

    /* The container <div> - needed to position the dropup content */
    .dropup {
        position: relative;
        display: inline-block;
    }

    /* Dropup content (Hidden by Default) */
    .dropup-content {
        display: none;
        position: absolute;
        bottom: 35px;
        min-width: 160px;
        z-index: 1;
    }

    /* Links inside the dropup */
    .dropup-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropup links on hover */
    .dropup-content a:hover {background-color: #ddd}

    /* Show the dropup menu on hover */
    .dropup:hover .dropup-content {
        display: block;
    }

    /* Change the background color of the dropup button when the dropup content is shown */
    .dropup:hover .dropbtn {
        background-color: #2980B9;
    }
    .fc-event{
        cursor: pointer;
    }
</style>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input id="p" type="hidden" wire:model="p">
                        <input id="idAgenda" value="" type="hidden">
                        @csrf
                        <label>Atividade: </label>
                        <input type="text" wire:model="atividadeObj.str_atividade" disabled><br/>
                        <label>Data/Hora de incio: </label>
                        <input type="text" wire:model="agenda.dat_marcacao" disabled><br/>


                        @if($isMarked)
                            <label>Cliente: </label>
                            <input type="text" wire:model="client.str_nome" disabled><br/>
                        @else
                            <label>Cliente: </label>
                            <input type="text"  id="nome" ><br/>
                            <label>Email: </label>
                            <input type="text"  id="email" ><br/>
                            <label>Telefone: </label>
                            <input type="text" id="telefone" onkeyup="mascaraTel(this)" value="" maxlength="15" ><br/>
                        @endif

                    </form>
                </div>
                <div class="modal-footer-my">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Fechar')}}</button>
                    @if(!$isMarked && $isClosed != 2)
                        <button id="linkerAgenda" type="button" class="btn btn-primary">{{__('Salvar agendamento')}}</button>
                    @endif


                    <div class="dropup">
                        <div>
                             <button class="btn bg-red-500">Ações</button>
                        </div>
                        <div class="dropup-content">
                            @switch($isClosed)
                                @case(0)

                                @break
                                @case(1)
                                    <button id="opcao2" class="btn btn-primary" onclick="cancelAgenda()">
                                        {{__('Cancelar horário')}}
                                    </button>
                                @break
                                @case(2)
                                    <button id="opcao3" class="btn btn-primary" onclick="openAgenda()">

                                        {{__('Desfazer bloqueio')}}
                                    </button>
                                @break
                                @case(3)
                                    <button id="opcao1" class="btn btn-primary" onclick="closeAgenda()">
                                        {{__('Bloquear horário')}}
                                    </button>
                                @break
                                @case(4)
                                    <button id="opcao1" class="btn btn-primary" onclick="closeAgenda()">
                                        {{__('Desfazer cancelamento')}}
                                    </button>
                                @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div id='calendar-container'>
        <div class="pt-3"><label for="resourceType">Selecione a atividade:</label>
            <div class="inline-block relative w-64">

                <select id='activity' name="activity" class="block appearance-none w-full bg-white border border-gray-400
                 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                wire:model.lazy="activity" wire:change="loadResource($event.target.value)" >
                    <option></option>
                    @foreach($atividades as $ati)

                        <option {{  ($activity==App\Http\Service\TokenService::tokenizer($ati->id)->id)? 'selected="true"' : '' }}
                                value="{{ App\Http\Service\TokenService::tokenizer($ati->id)->id}}"  >
                            {{$ati->str_atividade}}{{ $activity == $ati->id }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        @if(isset($activity))
        <div class="pt-3"><label for="resourceType">Selecione o recurso:</label>
            &nbsp;&nbsp;
            <div class="inline-block relative w-64">
                <select name="resource" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                        wire:model="resource" >
                    <option></option>
                    @foreach($resources as $rec)
                        <option value="{{$rec['id']}}">{{$rec['str_name']}}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
            <div class="pt-3"><label for="resourceType">Ações :</label>
                <div class="inline-block relative w-64">
                    <div class="dropup">
                        <div>
                            <button class="btn bg-blue-500">+</button>
                        </div>
                        <div class="dropup-content">
                            @if($p)
                                <button id="opcao1" class="btn btn-primary" onclick="openPrintQrCode()" tool>
                                    Imprimir QR Code
                                </button>
                                <button id="opcao1" class="btn btn-primary" onclick="openPrintQrCode()">
                                    Enviar convite SMS
                                </button>
                            @endif
                               </div>
                    </div>
                </div>
            </div>
        @endif
        <div id='calendar'></div>





    </div>
    </div>
</div>
{{--Inicio comportamento botão flutuante--}}
<style>
    .fab{
        position: fixed;
        bottom:10px;
        right:10px;
    }

    .fab button{
        cursor: pointer;


        background-color: #cb60b3;
        border: none;
        box-shadow: 0 1px 5px rgba(0,0,0,.4);

        color: white;

        -webkit-transition: .2s ease-out;
        -moz-transition: .2s ease-out;
        transition: .2s ease-out;
    }

    .fab button.main{
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 30px;
        background-color: #5b19b7;
        right: 0;
        bottom: 0;
        z-index: 20;
    }

    .fab button.main:before{
        content: '+';
    }

    .fab ul{
        position:absolute;
        bottom: 0;
        right: 0;
        padding:0;
        padding-right:5px;
        margin:0;
        list-style:none;
        z-index:10;

        -webkit-transition: .2s ease-out;
        -moz-transition: .2s ease-out;
        transition: .2s ease-out;
    }

    .fab ul li{
        display: flex;
        justify-content: flex-start;
        position: relative;
        margin-bottom: -10%;
        opacity: 0;

        -webkit-transition: .3s ease-out;
        -moz-transition: .3s ease-out;
        transition: .3s ease-out;
    }

    .fab ul li label{
        margin-right:10px;
        white-space: nowrap;
        display: block;
        margin-top: 10px;
        padding: 5px 8px;
        background-color: white;
        box-shadow: 0 1px 3px rgba(0,0,0,.2);
        border-radius:3px;
        height: 18px;
        font-size: 16px;
        pointer-events: none;
        opacity:0;

        -webkit-transition: .2s ease-out;
        -moz-transition: .2s ease-out;
        transition: .2s ease-out;
    }

    .fab button.main:active,
    .fab button.main:focus{
        outline: none;
        background-color: #7716ff;
        box-shadow: 0 3px 8px rgba(0,0,0,.5);
    }

    .fab button.main:active:before,
    .fab button.main:focus:before{
        content: '↑';
    }

    .fab button.main:active + ul,
    .fab button.main:focus + ul{
        bottom: 70px;
    }

    .fab button.main:active + ul li,
    .fab button.main:focus + ul li{
        margin-bottom: 10px;
        opacity: 1;
    }

    .fab button.main:active + ul li:hover label,
    .fab button.main:focus + ul li:hover label{
        opacity: 1;
    }
</style>

{{--fim comportamento botão flutuante--}}
