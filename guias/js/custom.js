function maskCPF(numberCPF){
    var cpf = numberCPF.value;

    if (isNaN(cpf[cpf.length - 1])) {
        numberCPF.value = cpf.substring(0, cpf.length - 1);
        return;
    }

    if(cpf.length === 3 || cpf.length === 7){
        numberCPF.value += ".";
    }
    if(cpf.length === 11){
        numberCPF.value += "-";
    }
}

function maskPhone(numberPhone){
    var phone = numberPhone.value;

    if(phone.length < 14){
        phone = phone.replace(/\D/g, "");
        phone = phone.replace(/^(\d{2})(\d)/g, "($1)$2");
        phone = phone.replace(/(\d)(\d{3})$/, "$1-$2");
        numberPhone.value = phone;
    }
}


function adicionarCampo(){
    var controleCampo = 1;
    controleCampo++;
    document.getElementById('formulario').insertAdjacentHTML('beforeend','<div id="formulario" class="col-xl-12 col-lg-12 col-md-12 col-sm-12" >'+
    '<div class="form-group" id="bloco' + controleCampo +'" style="border: 1px solid green; padding:10px;">'+
    '<button type="button" id="'+ controleCampo +'" onclick="removerCampo('+ controleCampo +')"> - </button>'+
    '<div class="col-6" ><label>  N° Vagas  </label>'+
        '<select id="vagas" name="vagas[]" class="custom-select d-block col-3 " required>'+
                '<option value="">Selecione</option>'+
                '<option value="01">01 Pessoa</option>'+
                '<option value="02">02 Pessoas</option>'+
                '<option value="03">03 Pessoas</option>'+
                '<option value="04">04 Pessoas</option>'+
                '<option value="05">05 Pessoas</option>'+
                '<option value="06">06 Pessoas</option>'+
                '<option value="07">07 Pessoas</option>'+
                '<option value="08">08 Pessoas</option>'+
                '<option value="09">09 Pessoas</option>'+
                '<option value="10">10 Pessoas</option>'+
                '<option value="11">11 Pessoas</option>'+
                '<option value="12">12 Pessoas</option>'+
                '<option value="13">13 Pessoas</option>'+
                '<option value="14">14 Pessoas</option>'+
                '<option value="15">15 Pessoas</option>'+
                '<option value="16">16 Pessoas</option>'+
                '<option value="17">17 Pessoas</option>'+
                '<option value="18">18 Pessoas</option>'+
                '<option value="19">19 Pessoas</option>'+
                '<option value="20">20 Pessoas</option>'+
        '</select></div>'+
    '<div class="col-6" ><label> Total R$ </label>'+
        '<input class="form-control col-3" type="text"  name="total[]" id="total" value="" required> <br>'+
    '</div></div></div>');
}

function removerCampo(idCampo){

    document.getElementById('campo' + idCampo).remove();
}
