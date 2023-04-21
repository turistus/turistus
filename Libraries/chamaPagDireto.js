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
        url: Root+"../INSERIRPAGSEG.php",
        type: 'POST',
        dataType:'html',
        success:function(data){
            $('#titulo').val(data);

            $('#FormPagamento').submit();
        }

    });

});