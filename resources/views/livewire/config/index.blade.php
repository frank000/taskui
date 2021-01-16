<div class="w-full flex justify-center shadow-md">
    <div class="w-full">
        <div class="w-full flex flex-col md:flex-row rounded overflow-hidden shadow-xl">

            <div class="w-full md:w-1/4 h-auto">
                <div class="top flex items-center px-5 h-16 bg-gray-700 text-white">
                    <div class="ml-3 flex flex-col text-xl">

                    </div>
                </div>
                <div class="bg-gray-400 w-full h-full sm:flex md:block">
                    <button id="button-1" onclick="showView(1)" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                        <span><i class="fa fa-inbox w-6"></i>Empresa</span>
                    </button>
                    <button id="button-2" onclick="showView(2)" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                        <span><i class="fa fa-envelope w-6"></i>Conta</span>

                    </button>
                    <button id="button-3" onclick="showView(3)" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                        <span><i class="fa fa-bookmark w-6"></i>Entre em contato</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24">
                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                        </svg>
                    </button>

                </div>
            </div>


            <div class="w-full md:w-3/4 bg-gray-400 ">
                <div class="top flex items-center px-5 h-16 bg-gray-600 text-white text-2xl">
                    <div id="title-1" class="hidden">
                        Empresa
                    </div>
                    <div id="title-2" class="hidden">
                        Conta
                    </div>
                    <div id="title-3" class="hidden">
                        Contato
                    </div>

                </div>
                <div class="w-full px-5 py-3 max-h-screen overflow-y-auto">
                    <div id="view-1" class="hidden">

                        <hr class="my-2 border-gray-500">
                        @livewire('config.form-company')
                        <hr class="my-2 border-gray-500">

                    </div>
                    <div id="view-2" class="hidden">
                        Abaixo estão diponíveis sobre sua conta.
                    </div>
                    <div id="view-3" class="hidden">
                        Aqui você tem um link direto conosco para qualquer dúvida, relato de erros, , sugestões, inconsistências e etc.
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var activeClasses = ["bg-gray-500","border-l-4","pl-4","border-gray-700"];
    var lastId = null;
    showView(1)

    function showView(id) {
        if(id == null)return
        closeLast()
        document.getElementById('view-'+id).style.display = "block"
        document.getElementById('title-'+id).style.display = "block"
        document.getElementById('button-'+id).classList.add(...activeClasses)

        lastId = id;
    }

    function closeLast() {
        if(lastId == null)return

        document.getElementById('view-'+lastId).style.display = "none"
        document.getElementById('title-'+lastId).style.display = "none"
        document.getElementById('button-'+lastId).classList.remove(...activeClasses)
    }

    /*
        //If you want to use your own identifiers replace js code

        var views = ['view-1','view-2','view-3','view-4']
        var titles = ['title-1','title-2','title-3','title-4']
        var buttons = ['button-1','button-2','button-3','button-4']
        var activeClasses = ["bg-gray-500","border-l-4","pl-4","border-gray-700"];
        close()
        showView(1)

        function showView(buttonId) {
            "use strict";

            close()
            document.getElementById(views[buttonId-1]).style.display = "block"
            document.getElementById(titles[buttonId-1]).style.display = "block"

            document.getElementById(buttons[buttonId -1]).classList.add(...activeClasses)
        }
        function close() {
            "use strict";

            views.forEach(view => {
                document.getElementById(view).style.display = "none"
            });
            titles.forEach(title => {
                document.getElementById(title).style.display = "none"
            });
            buttons.forEach(button => {
                document.getElementById(button).classList.remove(...activeClasses)
            });
        }
    */
</script>
