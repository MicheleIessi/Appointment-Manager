$(function(){

    $("a[rel*=leanModal]").leanModal();
});


function log_var(){
  $("#logform").validate({
      rules :{     
      
              email:  {
                required: true,
                controllaEmail: true,
                maxlength: 40 },   
      
              password:  {
                required: true
                }
            }
      
      
      
  })
 }
