$(document).ready( function()   {
    
    $("#modificaCliente").validate(    {
        
        rules:
        {
            nome:  {
                required: true
            },
            
            cognome:  {
                required: true
            },
            
            dataNascita:  {
                required: true,
                dateITA: true
            },
            
            sesso:  {
                required: true
            },
            
            email:  {
                required: true,
                email: true
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
                required: "  Inserisci la tua data di nascita",
                dateITA: true
            },
            
            sesso:  {
                required: "  Campo richiesto"
            },
            
            email:  {
                required: "  Inserisci il tuo indirizzo email",
                email: "  Formato dell'email errato"
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