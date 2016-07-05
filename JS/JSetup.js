$(document).ready( function() {

    $(function() {                                                              // settaggio di datapicker; tramite
        $.datepicker.setDefaults( $.datepicker.regional[ "it" ] );              // datapicker.regional["it"] si setta
        $( "#dataNascitaAdmin" ).datepicker();                                  // in modo tale che rispetti il formato
    });                                                                         // e abbia la lingua

    $('#setupForm').validate( {

        rules: {
            // regole anagrafica
            nomeAdmin:  {
                required: true,
                noNumeri: true,
                maxlength:20
            },

            cognomeAdmin:  {
                required:true,
                noNumeri:true,
                maxlength:20
            },

            dataNascitaAdmin:  {
                required: true,
                formatoData: true
            },

            codiceFiscaleAdmin: {
                required: true,
                formatoCodiceFiscale: true
            },

            sessoAdmin: {
                required: true
            },

            emailAdmin: {
                required: true,
                controllaEmail: true,
                maxlength: 40
            },

            passwordAdmin1: {
                required: true,
                minlength: 8,
                maxlength: 20
            },

            passwordAdmin2: {
                required: true,
                equalTo: "#password1"
            },

            //regole db

            dbms: {
                required: true
            },
            dbuser: {
                required: true
            },
            dbpass: {
                required: false
            },
            dbname: {
                required: true,
                maxlength: 20
            },
            dbhost: {
                required: true
            },

            //regole gestione mail

            smtphost: {
                required: true,
                formatoHost: true
            },
            smtpport: {
                required: true,
                digits: true
            },
            smtpuser: {
                required: true,
                controllaEmail: true
            },
            smtppass: {
                required: true
            }


        },
        messages: {
            nomeAdmin: {
                required: "Questo campo è richiesto",
                maxlength: "Massimo 20 caratteri"
            },
            cognomeAdmin: {
                required: "Questo campo è richiesto",
                maxlength: "Massimo 20 caratteri"
            },
            dataNascitaAdmin: {
                required: "Questo campo è richiesto"
            },
            codiceFiscaleAdmin: {
                required: "Questo campo è richiesto"
            },
            sessoAdmin: {
                required: "Questo campo è richiesto"
            },
            emailAdmin: {
                required: "Questo campo è richiesto",
                maxlength: "Massimo 40 caratteri"
            },
            passwordAdmin1: {
                required: "Questo campo è richiesto",
                minlength: "Minimo 8 caratteri",
                maxlength: "Massimo 20 caratteri"
            },
            passwordAdmin2: {
                required: "Questo campo è richiesto",
                equalTo: "Le password non coincidono"
            },
            dbms: {
                required: "Questo campo è richiesto"
            },
            dbuser: {
                required: "Questo campo è richiesto"
            },
            dbpass: {
                required: "Questo campo è richiesto"
            },
            dbname: {
                required: "Questo campo è richiesto",
                maxlength: "Massimo 20 caratteri"
            },
            dbhost: {
                required: "Questo campo è richiesto"
            },

            //regole gestione mail

            smtphost: {
                required: "Questo campo è richiesto"
            },
            smtpport: {
                required: "Questo campo è richiesto",
                digits: "Questo campo può contenere solo numeri"
            },
            smtpuser: {
                required: "Questo campo è richiesto"
            },
            smtppass: {
                required: "Questo campo è richiesto"
            }

        }

    });

});

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

$.validator.addMethod("formatoHost", function(value, element) {

    return this.optional( element ) || /^[a-zA-Z0-9]{1,15}\.[a-zA-Z0-9]{1,10}\.[a-zA-Z0-9]{1,5}$/.test( value );

}, "   Non rispetta il giusto formato per un web host");

