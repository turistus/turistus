var Root = "https://"+document.location.hostname+"/";


$('#BotaoPagar').on('click',function(event){
    event.preventDefault();

    $.ajax({
        url: Root+"../pg/pagarPagSeguro/PagamentoDireto.php",
        type: 'POST',
        dataType:'html',
        success:function(data){
            $('#code').val(data);
            $('#FormPagamento').submit();
        }



    });

    $.ajax({
        caminho: Root+"../INSERIRPAGSEG.php",
        type: 'POST',
        dataType:'html',
        success:function(data){
            $('#titulo').val(data);
            $('#idEv').val(data);
            $('#descricao').val(data);
            $('#custoEvento').val(data);
            $('#idGuia').val(data);

            $('#FormPagamento').submit();
        }

    });

});