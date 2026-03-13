document.addEventListener("DOMContentLoaded", function(){

    let botonesSumar = document.querySelectorAll(".sumar");
    let botonesRestar = document.querySelectorAll(".restar");

    botonesSumar.forEach(function(boton){
        boton.addEventListener("click", function(){
            let cantidad = this.parentElement.querySelector(".cantidad");
            cantidad.textContent = parseInt(cantidad.textContent) + 1;
        });
    });

    botonesRestar.forEach(function(boton){
        boton.addEventListener("click", function(){
            let cantidad = this.parentElement.querySelector(".cantidad");
            let valor = parseInt(cantidad.textContent);

            if(valor > 1){
                cantidad.textContent = valor - 1;
            }
        });
    });

});