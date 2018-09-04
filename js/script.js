/**
 * 
 * @description: Rotina de animação da pagina.
 * 
 */

// Espera a pagina carregar para utilizar os scripts
$(document).ready( event => {
    
    // Escuta os header toggler
    $('.toggler').click(function(){
        
        var target = this.dataset.reference;
        document.getElementById(target).classList.toggle('collapsed');
        
    } );

});