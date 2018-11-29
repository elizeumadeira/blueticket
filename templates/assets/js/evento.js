function adicionar_ingresso(){
    $.ajax({
        url: '/eventos/tipoingresso',
        complete: function(jq){
            $('#ingressos_container').append(jq.responseText);
        }
    });
};

function excluir_ingresso(container){
    container.remove();
}

function esconder_campos_ingresso(container){
    var form_campos = container.find('.form-campos');
    var desc = container.find('input[name="ingressodescricao[]"]').val();
    var label_desc = container.find('.label_descricao');
    
    if(form_campos.is(':hidden')){
        form_campos.show();
        label_desc.hide();
    }else{
        form_campos.hide();
        label_desc.html(desc).show();
    }
}