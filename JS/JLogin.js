$(function(){

    $('#loginform').submit(function(e){
        if(ControllaMail()==0)
        {alert("attenzione questo non e' un indirizzo mail!");}
    });
    $("a[rel*=leanModal]").leanModal();
});



function ControllaMail()
{ var mail=$('#mail').val();
    var email =/[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    var ctlm=0;
    if(email.test(mail))
    {ctlm=1;}
    return ctlm;
}