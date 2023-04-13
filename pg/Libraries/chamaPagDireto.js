var Root = "https://"+document.location.hostname+"/";


$('#BotaoPagamento').on('click',function(event){
    event.preventDefault();

    $.ajax({
        url: Root+"/pagarPagSeguro/PagamentoDireto.php",
        type: 'POST',
        dataType:'html',
        success:function(data){
            $('#code').val(Root);
            $('#FormPagamento').submit();
        }
    });
});