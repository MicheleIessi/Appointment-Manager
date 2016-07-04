
$(document).ready(function() {
    $(function(){
        $("a[rel*=leanModal]").leanModal();
    });

    $('#bottoneLogout').click(function () {
        log_out();
    });

    function log_out() {
        var uscita = confirm("Vuoi davvero uscire?");
        if (uscita) {
            $.ajax({
                url: "Control/Ajax/ALogin.php",
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
                maxlength: 40,
                remote: {

                    onfocusout: true,
                    url: "Control/Ajax/ALogin.php",
                    method: "post",
                    data: {
                        task: 'controllaEsistenzaMail'
                    }
                }
            },

            pass: {
                required: true
            }
        },

        messages: {
            email:  {
                required: "Inserisci il tuo indirizzo email",
                email: "Non rispetta il giusto formato per una mail",
                remote: "Email non presente, ricontrollala",
                maxlength: "Massimo 40 caratteri"
            },
            pass: {
                required: "Inserisci la password"
            }
        }

    });
});
$("#regForm").validate({
        rules: {
                 nome:  {
                 required: true,
                 noNumeri: true,
                 maxlength:20
                        },
            
                 cognome:  {
                 required:true,
                 noNumeri:true,
                 maxlength:20
                        },
            
                 dataNascita:  {
                 required: true,
                 formatoData: true
                        },
            
                 codiceFiscale:  {
                 required: true,
                 formatoCodiceFiscale: true,
                 remote: {
                    
                    onfocusout: true,
                    url: "controllaEsistenza.php",
                    type: "post",
                    data: {
                        tipo: 'codiceFiscale',
                        valore: function() {
                            return $('#codiceFiscale').val();
                            
                                           }
                          }
                         }
                                  },
                 sesso:  {
                 required: true
                      },
                 email:  {
                 required: true,
                 email: true,
                 controllaEmail: true,
                 maxlength: 40,
                 remote: {
                    
                    onfocusout: true,
                    url: "controllaEsistenza.php",
                    type: "post",
                    data: {
                        tipo: 'email',
                        valore: function() {
                            return $('#email').val();
                        
                                           }
                          }
                         }
                        },
                 password1:  {
                required: true,
                minlength:8,
                maxlength:20
                      },
                 password2:  {
                required: true,
                equalTo: "#password1"
                             }
             },
        
        messages:       // Questi sono i messaggi di errore nel caso in cui uno dei campi non rispetta le rules
        {
            nome:  {
                required: "   Inserisci il tuo nome",
                maxlength: "   Massimo 20 caratteri"
            },
            
            cognome:  {
                required: "   Inserisci il tuo cognome",
                maxlength: "   Massimo 20 caratteri"
            },
            
            dataNascita:  {
                required: "   Inserisci la tua data di nascita"
            },
            
            codiceFiscale:  {
                required: "   Inserisci il tuo codice fiscale",
                remote: "   Codice fiscale già presente, modificare"
            },
            
            sesso:  {
                required: "   Campo richiesto"
            },
            
            email:  {
                required: "   Inserisci il tuo indirizzo email",
                email: "   Non rispetta il giusto formato per una mail",
                remote: "   Email già presente, modificare",
                maxlength: "   Massimo 40 caratteri"
            },
            
            password1:  {
                required: "   Campo richiesto",
                minlength: "   Minimo 8 caratteri",
                maxlength: "   Massimo 20 caratteri"
            },
            
            password2:  {
                required: "   Campo richiesto",
                equalTo: "   Conferma password errato"
            }
        }
    }
);

$.validator.addMethod("controllaEmail", function (value, element) {

        return this.optional(element) || /^([a-zA-z0-9.]{3,})@([a-zA-z0-9.]+)\.([a-zA-Z]{2,4})/.test(value);

    }, "   Non rispetta il giusto formato per una mail");
