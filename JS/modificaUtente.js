$(document).ready( function()   {
    
    $(function() {                                                              // settaggio di datapicker; tramite
        $.datepicker.setDefaults( $.datepicker.regional[ "it" ] );              // datapicker.regional["it"] si setta
        $( "#datepicker" ).datepicker();                                        // in modo tale che rispetti il formato
    });                                                                         // e abbia la lingua
    
    $("#modificaUtente").validate(    {        // Validazione form usando jquery validate
        
        rules:          // Queste sono le regole che devono essere verificate per i singoli campi delle form
        {
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
                    url: "Chiamate/AControllaEsistenza.php",
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
                    url: "Chiamate/AControllaEsistenza.php",
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
    
}
);

// Queste sono funzioni per fare dei controlli particolari; vengono usate tra le rules

$.validator.addMethod("noNumeri", function(value, element) {
 
    return this.optional( element ) || /^[ a-zA-Zèéòì'àù]+$/.test( value );
    
}, "   Questo campo non può contenere numeri o caratteri speciali"); 


$.validator.addMethod("controllaEmail", function(value, element) {
 
    return this.optional( element ) || /^([a-zA-Z0-9.]{3,})@([a-zA-z0-9.]+)\.([a-zA-Z]{2,4})/.test( value );
    
}, "   Non rispetta il giusto formato per una mail");

$.validator.addMethod("formatoData", function(value, element) {
 
    return this.optional( element ) || /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/.test( value );
    
}, "   Non rispetta il giusto formato per una data");

$.validator.addMethod("formatoCodiceFiscale", function(value, element) {
 
    return this.optional( element ) || /^[A-Z]{6}[0-9]{2}[ABCDEHLMPRST]{1}[0-9]{2}([A-Z]{1}[0-9]{3})[A-Z]{1}$/.test( value );
    
}, "   Non rispetta il giusto formato per un codice fiscale");


