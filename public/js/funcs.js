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
        $('#messageFlash').empty()
        var success = "<div class=\"col-start-2 col-span-4 bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 w-3/4\" role=\"alert\">\n" +
            "                    <p class=\"font-bold\">" + data.title + "</p>\n" +
            "                    <p class=\"text-sm\">" + data.msg + "</p>\n" +
            "                </div>";
      $('#messageFlash').slideDown(300).append(success).delay( 3000 ).slideUp(300);
    });

}

