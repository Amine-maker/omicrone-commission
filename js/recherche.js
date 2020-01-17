$(document).ready(function(){
  $('#categoryFilter').on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $('#filter .filter_td').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
}); 

//$(document).ready(function() 
//{ 
//    (function($){
//        $('#categoryFilter').focus().keyup(function(event){ //dès qu'on ecrit une lettre
//            var input = $(this); //creer une variable
//            var val = input.val(); //stock la valeur dans cet variable
//          
//            if(val===""){ //si le champs est vide
//                $('#filter .filter_td').parent().show(); //on affiche toutes les lignes
//                $('#filter span').removeClass('highlighted'); //supprimer le surlignement
//                return true;
//            }
//          
//            var regexp = '\\b(.*)'; //expression reguliaire
//            for (var i in val){ 
//                regexp+='('+val[i]+')(.*)';
//            }
//            regexp += '(.*)\\b'; //cloture de l'expression
//            $('#filter .filter_td').parent().show(); 
//            $('#filter').find('.filter_span').each(function(){ //parcours tous les spans 
//                var span= $(this); 
////                console.log(span);
//            var resultats = span.text().match(new RegExp(regexp,'i'));
//            if(resultats)
//            {
//            var string="";    
//              for (var i in resultats)
//                {
//                // console.log(resultats);
//                   if (i>0)
//                    {
//                        if(i%2===0)
//                        {
//                        string += "<span class='highlighted'>" +resultats[i] + '</span>';
//                        }
//                        else 
//                        {
//                        string += resultats[i];
//                        }
//                    }
//                }
//                span.empty().append(string); //afficher les resultats 
//                //console.log(resultats);
//            }
//            else {
//                span.parent().parent().parent().hide(); //cache les elements qui ne sont pas un resultat
//            }
//            });
//        });
//    })(jQuery);
//});