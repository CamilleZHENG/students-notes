$(document).ready(function(){
'use strict';


  if($('section.saisie-note p').hasClass('error_message')){

    var error_message = $('.error_message').text();
    console.log(error_message);

    if(error_message.indexOf('élève') !== -1){
      console.log(error_message.indexOf('élève'));
      $('form select[name="eleve"]').addClass('champs-a-saisir');
    }
    if(error_message.indexOf('matière') !== -1){
      $('form select[name="matiere"]').addClass('champs-a-saisir');
    }
    if((error_message.indexOf('note') !== -1)
        || (error_message.indexOf('negatif') !== -1)
        || (error_message.indexOf('dépasser') !== -1)
      ){
      $('form input[name="note"]').addClass('champs-a-saisir');
    }


  }

});
