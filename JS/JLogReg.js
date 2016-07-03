$(function(){
    $("a[rel*=leanModal]").leanModal();    
});

function log_out(){
    var uscita=confirm("confermi di uscire?");
    if(uscita){
    $.ajax({url: "Logout.php",
            method : "post",
            data : {uscita :true},
            success:function(){
              location.reload();}
            });
              }      
    }
    
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
 $.validator.addMethod("controllaEmail", function(value, element) {
 
    return this.optional( element ) || /^([a-zA-z0-9.]{3,})@([a-zA-z0-9.]+)\.([a-zA-Z]{2,4})/.test( value );
    
}, "   Non rispetta il giusto formato per una mail");
