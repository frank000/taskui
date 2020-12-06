<div>
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{asset('/css/customDatatable.css')}}" rel="stylesheet">
<!--Container-->
    <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
        <!--Title-->
        <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
            Recursos
        </h1>
        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                <tr>
                    <th data-priority="1">Ações</th>
                    <th data-priority="2">Recurso</th>
                    <th data-priority="3">Tipo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $rec)
                    <tr>
                        <td><a href="/adm/resources/create/{{$rec->id}}" class="hover:text-indigo-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></a></td>
                        <td>{{$rec->str_name}}</td>
                        <td>{{$rec->typeResource->str_type}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
        <!--/Card-->
    </div>
    <!--/container-->
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = grid('#example', "recursos");

        } );
    </script>
</div>
