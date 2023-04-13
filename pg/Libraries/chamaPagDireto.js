var Root = "https://"+document.location.hostname+"/";

var_dump(Root);
$('#BotaoPagamento').on('click',function(event){
    event.preventDefault();

    $.ajax({
        url: Root+"/pagarPagSeguro/PagamentoDireto.php",
        type: 'POST',
        dataType:'html',
        success:function(data){
            $('#code').val(data);
            $('#FormPagamento').submit();
        }
    });
});