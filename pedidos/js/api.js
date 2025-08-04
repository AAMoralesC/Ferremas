$(document).ready(function () { 
      $.ajax({  
        type: "GET",  
        url: "https://mindicador.cl/api",    
        dataType: "json", 
        success: function (data) {              
            let fecha = data.fecha;             
            let indicadores="<p>Indicadores Econ&oacute;micos >>> Fecha: "+fecha.substring(0,10)+" - UF: "+data.uf.valor.toLocaleString()+" - DOLAR: "+data.dolar.valor.toLocaleString()+" - EURO: "+data.euro.valor.toLocaleString()+" - IPC: "+data.ipc.valor+"% - UTM: "+data.utm.valor.toLocaleString()+"</p>";
            $("#textoIndicadores").append(indicadores);     
        }, 
    });  
  
   
  });