$(document).ready( function()   {
    
    $(function() {
        $.datepicker.setDefaults( $.datepicker.regional[ "it" ] );
        $( "#datepicker" ).datepicker();
    });
    
    $("#modificaCliente").validate(    {
        
        rules:
        {
            nome:  {
                required: true,
                noNumeri: true
            },
            
            cognome:  {
                required: true,
                noNumeri:true
            },
            
            dataNascita:  {
                required: true,
                formatoData: true
            },
            
            sesso:  {
                required: true
            },
            
            email:  {
                required: true,
                email: true,
                controllaEmail: true
            },
            
            password1:  {
                required: true
            },
            
            password2:  {
                required: true,
                equalTo: "#password1"
            }
        },
        
        messages:
        {
            nome:  {
                required: "  Inserisci il tuo nome"
            },
            
            cognome:  {
                required: "  Inserisci il tuo cognome"
            },
            
            dataNascita:  {
                required: "  Inserisci la tua data di nascita"
            },
            
            sesso:  {
                required: "  Campo richiesto"
            },
            
            email:  {
                required: "  Inserisci il tuo indirizzo email",
                email: "  Non rispetta il giusto formato per una mail"
            },
            
            password1:  {
                required: "  Campo richiesto"
            },
            
            password2:  {
                required: "  Campo richiesto",
                equalTo: "  Conferma password errato"
            }
        }
    }
    );
    
}
);

$.validator.addMethod("noNumeri", function(value, element) {
 
    return this.optional( element ) || /^[ a-zA-zèéò'àù]+$/.test( value );
    
}, "  Questo campo non può contenere numeri o caratteri speciali"); 


$.validator.addMethod("controllaEmail", function(value, element) {
 
    return this.optional( element ) || /^([a-zA-z0-9.]{3,})@([a-zA-z0-9.]+)\.([a-zA-Z]{2,4})/.test( value );
    
}, "  Non rispetta il giusto formato per una mail");

$.validator.addMethod("formatoData", function(value, element) {
 
    return this.optional( element ) || /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/.test( value );
    
}, "  Non rispetta il giusto formato per una data");



