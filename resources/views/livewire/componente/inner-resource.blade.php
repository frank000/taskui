<div>
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <!--Container-->
    <div class="container  mx-auto">
        <!--Title-->
        <!--Card-->
        <div id='recipients' class="shadow">
            <table id="example" class="stripe hover text-center" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                <tr>
                    <th data-priority="1">Ações</th>
                    <th data-priority="2">Recurso</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $rec)
                    <tr>

                        <td><a wire:click="deleteResource('{{$rec['resource']}}')" class="hover:text-indigo-400"><svg class="w-6 h-6 ml-4 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></a></td>

{{--                        <td>{{$rec['recurso']}}</td>--}}
                        <td>{{$rec['resource'] . $rec['dias']}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
        <!--/Card-->
    </div>
    <!--/container-->

    <script>
        $(document).ready(function() {
            var table = grid('#example', "recursos");

        } );
    </script>
</div>
