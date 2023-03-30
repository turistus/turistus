


function pagamento() {

    //Endereco padrão do projeto
    var endereco = jQuery('.endereco').attr("data-endereco");
    $.ajax({

        //URL completa do local do arquivo responsável em buscar o ID da sessão
        url: endereco + "pagamento.php",
        type: 'POST',
        dataType: 'json',
        success: function (retorno) {

            //ID da sessão retornada pelo PagSeguro
            PagSeguroDirectPayment.setSessionId(retorno.id);
            console.log(retorno);
        },
        complete: function (retorno) {
            //listarMeiosPag();
        }
    });
}