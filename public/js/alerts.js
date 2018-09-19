function alert_succes(msg){
    swal({
      position: 'top-end',
      type: 'success',
      title: msg,
      showConfirmButton: false,
      timer: 2500
    });
}

function alert_error(msg){
    swal({
      position: 'top-end',
      type: 'error',
      title: msg,
      showConfirmButton: false,
      timer: 3000
    });
}


function alert_confirm(classe, titulo, texto, tipo, rota){
    var $funcao = document.querySelectorAll('.'+classe);

    Array.prototype.forEach.call($funcao,function(e){ 

        e.addEventListener('click',function(e){

           
            var strFuncao = this.getAttribute('data-name') || "";
            var id_usuario = this.getAttribute('data-usuario') || "";
            var id = this.getAttribute('data-id') || "";

            swal({
                title: titulo,
                text: texto+" "+strFuncao+"?",
                type: tipo,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
            }).then((result) => {
                if (result.value) {
                    window.location="/"+rota+"/"+id+"/"+id_usuario;
                }
            })
        });
    });
}