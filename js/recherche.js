$(document).ready(function(){
  $('#categoryFilter').on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $('#filter .filter_td').parent().filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
}); 
