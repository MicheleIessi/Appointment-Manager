$(document).ready(function() {
    $(function(){
        $("a[rel*=leanModal]").leanModal();
    });

    $('#bottoneLogout').click(function () {
        log_out();
    });
    
    $(function() {                                                              // settaggio di datapicker; tramite
        $.datepicker.setDefaults( $.datepicker.regional[ "it" ] );              // datapicker.regional["it"] si setta
        $( "#datepicker" ).datepicker();                                        // in modo tale che rispetti il formato
    }); 

    function log_out() {
        var uscita = confirm("Vuoi davvero uscire?");
        if (uscita) {
            $.ajax({
                url: "Chiamate/ALogin.php",
                method: "post",
                data: {
                    task: 'logout'
                },
                success: function () {
                    location.href = "index.php";
                }
            });
        }
    }

    $("#loginForm").validate({
        
        rules: {
            email: {
                required: true,
                controllaEmail: true,
                maxlength: 50,
                //conferma:true,
                remote: {

                    onfocusout: true,
                    url: "Chiamate/ALogin.php",
                    method: "post",
                    data: {
                        task: 'controllaEsistenzaMailL'
                    }
                    }
                 
                
            },

            password: {
                required: true
                
            }
        },
    

        messages: {
            email:  {
                required: "Inserisci il tuo indirizzo email",
                email: "Non rispetta il giusto formato per una mail",
                remote: "Email non presente, ricontrollala",
                maxlength: "Massimo 50 caratteri"
            },
            pass: {
                required: "Inserisci la password",
                rermote: "password sbagliata"
            }
                 }
             
          });

$("#RegisterForm").validate({
        rules: {
                 Nome:  {
                 required: true,
                 noNumeri: true,
                 maxlength:20
                        },
            
                 Cognome:  {
                 required:true,
                 noNumeri:true,
                 maxlength:20
                        },
            
                 Data:  {
                 required: true,
                 formatoData: true
                        },
            
                 CodiceFiscale:  {
                 required: true,
                 formatoCodiceFiscale: true,
                 remote: {

                    onfocusout: true,
                    url: "Chiamate/ALogin.php",
                    method: "post",
                    data: {
                        task: 'controllaEsistenzaCodiceFiscale'
                           }
                      
                         }
                                  },
                 Sesso:  {
                 required: true
                      },
                 email:  {
                 required: true,
                 email: true,
                 controllaEmail: true,
                 maxlength: 40,
                 remote: {

                    onfocusout: true,
                    url: "Chiamate/ALogin.php",
                    method: "post",
                    data: {
                        task: 'controllaEsistenzaMailR'
                           }
                      
                         }
                 
                        },
                 Password:  {
                required: true,
                minlength:8,
                maxlength:20
                      },
                 RPassword:  {
                required: true,
                equalTo: "#Password"
                             }
             },
        
        messages:       // Questi sono i messaggi di errore nel caso in cui uno dei campi non rispetta le rules
        {
            Nome:  {
                required: "   Inserisci il tuo nome",
                maxlength: "   Massimo 20 caratteri"
            },
            
            Cognome:  {
                required: "   Inserisci il tuo cognome",
                maxlength: "   Massimo 20 caratteri"
            },
            
            Data:  {
                required: "   Inserisci la tua data di nascita"
            },
            
            CodiceFiscale:  {
                required: "   Inserisci il tuo codice fiscale",
                remote: "   Codice fiscale già presente, modificare"
            },
            
            Sesso:  {
                required: " Campo richiesto"
            },
            
            email:  {
                required: "   Inserisci il tuo indirizzo email",
                email: "   Non rispetta il giusto formato per una mail",
                remote: "   Email già presente, modificare",
                maxlength: "   Massimo 40 caratteri"
            },
            
            Password:  {
                required: "   Campo richiesto",
                minlength: "   Minimo 8 caratteri",
                maxlength: "   Massimo 20 caratteri"
            },
            
            RPassword:  {
                required: "   Campo richiesto",
                equalTo: "   Conferma password errata"
            }
        }
    }
);
});

$.validator.addMethod("controllaEmail", function (value, element) {

        return this.optional(element) || /^([a-zA-z0-9.]{3,})@([a-zA-z0-9.]+)\.([a-zA-Z]{2,4})/.test(value);

    }, "   Non rispetta il giusto formato per una mail");
$.validator.addMethod("formatoData", function(value, element) {
 
    return this.optional( element ) || /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/.test( value );
    
}, "   Non rispetta il giusto formato per una data aaaa/mm/gg");

$.validator.addMethod("formatoCodiceFiscale", function(value, element) {
 
    return this.optional( element ) || /^[A-Z]{6}[0-9]{2}[ABCDEHLMPRST]{1}[0-9]{2}([A-Z]{1}[0-9]{3})[A-Z]{1}$/.test( value );
    
}, "   Non rispetta il giusto formato per un codice fiscale");


$.validator.addMethod("noNumeri", function(value, element) {
 
    return this.optional( element ) || /^[ a-zA-Zèéòì'àù]+$/.test( value );
    
}, "   Questo campo non può contenere numeri o caratteri speciali"); 
/*$.validator.addMethod("conferma",function(value,element){
    $.ajax({
         async : false,
         type: "POST",
         url: "Control/Chiamate/ALogin.php",
         data: {email:$('#email').val(),
                task :'controllaconferma'}});
        
     
      
         
},"email non ancora confermata");*/