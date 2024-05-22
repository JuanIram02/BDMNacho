


const btnCompra = document.querySelector("#btnCompra");
const btnVende = document.querySelector("#btnVende");
const btnAdmin = document.querySelector("#btnAdmin");
const auto = document.querySelector("#auto");
const Novo = document.querySelector("#Novo");

var x = document.getElementsByClassName('USUARIOUNO');
var y = document.getElementsByClassName('USERVENDE');
var z = document.getElementsByClassName('USERADMIN');



btnCompra.addEventListener("click",()=>{

      for (var i = 0; i < y.length; i++) {
            y[i].style.display= "none";
          }

          for (var i = 0; i < z.length; i++) {
            z[i].style.display= "none";
          }

      for (var i = 0; i < x.length; i++) {
            x[i].style.display= "block";
          }

      window.alert("Vista perfil Comprador");
     
        
});

btnVende.addEventListener("click",()=>{

      for (var i = 0; i < x.length; i++) {
            x[i].style.display= "none";
          }

          for (var i = 0; i < z.length; i++) {
            z[i].style.display= "none";
          }

      for (var i = 0; i < y.length; i++) {
            y[i].style.display= "block";
          }

      window.alert("Vista perfil Vendedor");

     
        
});

btnAdmin.addEventListener("click",()=>{

      for (var i = 0; i < x.length; i++) {
            x[i].style.display= "none";
          }

      for (var i = 0; i < y.length; i++) {
            y[i].style.display= "none";
          }

          for (var i = 0; i < z.length; i++) {
            z[i].style.display= "block";
          }



      window.alert("Vista perfil Admin");

     
        
});

auto.addEventListener("click",()=>{



      window.alert("Producto autorizado");

     
        
});

Novo.addEventListener("click",()=>{



      window.alert("Producto generado");

     
        
});
