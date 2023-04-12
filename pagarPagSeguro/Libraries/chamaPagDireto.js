


$('#BotaoPagamento').on('click',function(event){
    event.preventDefault();

    $.ajax({
        url: URL+"/pagarPagSeguro/PagamentoDireto.php",
        type: 'POST',
        dataType:'html',
        success:function(data){
            $('#code').val(data);
            $('#FormPagamento').submit();
        }
    });
});