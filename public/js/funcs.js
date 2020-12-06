function mascaraCpf(el) {
    valor = el.value;


    //retira os caracteres indesejados...
    cpf = valor.replace(/[^\d]/g, "");

    //realizar a formatação...
    el.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

function mascaraTel(el){
    v = el.value;
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    el.value = v;
}
function massage(data){
    $(document).ready(function(){
        $('#helperMessage').empty()
        var success = "<div class=\"col-start-2 col-span-4 bg-blue-100 border-t border-b focus:border-blue-500 text-blue-700 px-4 py-3 w-3/4\" role=\"alert\">\n" +
            "                    <p class=\"font-bold\">" + data.title + "</p>\n" +
            "                    <p class=\"text-sm\">" + data.msg + "</p>\n" +
            "                </div>";
      $('#helperMessage').slideDown(300).append(success).delay( 3000 ).slideUp(300);
    });


}
function massageAlert(data){
    $(document).ready(function(){
        $('#helperMessage').empty()
        var success = "<div class=\"text-center bg-red-100 border-t border-b border-red-500 text-blue-700 px-4 py-3 w-full\" role=\"alert\">\n" +
            "                    <p class=\"font-bold\">" + data.title + "</p>\n" +
            "                    <p class=\"text-sm\">" + data.msg + "</p>\n" +
            "                </div>";
        $('#helperMessage').slideDown(300).append(success).delay( 3000 ).slideUp(300);
        $("html, body").animate({ scrollTop: 0 });
    });


}

function carregando(exibirCarregando) {
    if (exibirCarregando == false) {
        $(".loading-dialog").fadeOut();
    } else {
        // Reseta o progress
        $(".loading-dialog .loading-progress").removeAttr('value').removeAttr('max');
        $('.loading-dialog .loading-progress').hide();

        $(".loading-dialog").fadeIn();
    }
};


function grid(table,showName)
{
    return $(table).DataTable( {
        responsive: true,
        "language": {
            "lengthMenu": "Apresenta _MENU_ "+ showName +" por pagina",
            "zeroRecords": "Não há "+ showName +".",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sem registros",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search":         "Busca:",
            "paginate": {
                "first":      "Primeiro",
                "last":       "Último",
                "next":       "Próximo",
                "previous":   "Anterior"
            },
        }
    } )
        .columns.adjust()
        .responsive.recalc();
}

function closeMesssage()
{
    $('#message').hide();
}
