$(document).ready(function() {

    // aggiunta leanmodal ai bottoni
    $(function () {
        $("a[rel*=leanModal]").leanModal();
    });
    // aggiunta datepicker dove serve
    $(function() {
        $.datepicker.setDefaults( $.datepicker.regional[ "it" ] );
        $( "#datepicker" ).datepicker();
    });

    //inserimento e gestione chiamata ajax su modifica servizio

    $('#listaProf').change(function() {
        var idp = $('#listaProf').val();
        $.ajax({
            type: 'post',
            url: 'Control/Ajax/AAdmin.php',
            dataType: 'json',
            data: {
                task: 'ajaxOrari',
                idOrario: idp
            },
            success: function(response) {
                $('#modOrarioLun').val(response.lun);
                $('#modOrarioMar').val(response.mar);
                $('#modOrarioMer').val(response.mer);
                $('#modOrarioGio').val(response.gio);
                $('#modOrarioVen').val(response.ven);
                $('#modOrarioSab').val(response.sab);
                $('#modOrarioDom').val(response.dom);
            }
        });
    });

    $('#listaProfEliminaSer').change(function() {
        var idp = $('#listaProfEliminaSer').val();
        $.ajax({
            type: 'post',
            url: 'Control/Ajax/AAdmin.php',
            dataType: 'json',
            data: {
                task: 'ajaxServProf',
                idProf: idp
            },
            success: function(response) {
                var i = 0;
                var divCheck = $('#checkboxContainer');
                divCheck.empty();
                $.each(response, function() {
                    var elem = '<input type="checkbox" value="'+response[i].nomeSer+'" name="serviziDaRimuovere[]" /> '+response[i].nomeSer+'<br>';
                    divCheck.append(elem);
                    i++;
                });
            }
        });
    });

    $('#listaProfAggiungiSer').change(function() {
        var idp = $('#listaProfAggiungiSer').val();
        $.ajax({
            type: 'post',
            url: 'Control/Ajax/AAdmin.php',
            dataType: 'json',
            data: {
                task: 'ajaxAltriServ',
                idProf: idp
            },
            success: function(response) {
                var i = 0;
                var tdCheck = $('#checkboxContainerAgg');
                tdCheck.empty();
                $.each(response, function() {
                    var elem = '<input type="checkbox" value="'+response[i].nomeSer+'" name="serviziDaAggiungere[]" />'+response[i].nomeSer+'<br>';
                    tdCheck.append(elem);
                    i++;
                });
            },
            error: function(response) {
                alert(response);
            }
        });
    });


    $('#listaSer').change(function() {
        var serv = $('#listaSer').val();
        $.ajax({
            type: 'post',
            url: 'Control/Ajax/AAdmin.php',
            dataType: 'json',
            data: {
                task: 'ajaxServ',
                nome: serv
            },
            success: function(response) {
                $('#nomeModSer').val(response.nomeSer);
                $('#descModSer').val(response.descSer);
                $('#settModSer').val(response.settSer);
                $('#durataModSer').val(response.durataSer);

            }
        });
    });


    
    $("#aggiungiProf").validate(    {
        
        rules:
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
            },
        
            settore:  {
                    required: true,
                    noNumeri: true
            },

            orarioLun:  {
                    required: true,
                    formatoOrario: true
                },

            orarioMar:  {
                    required: true,
                    formatoOrario: true
                },

            orarioMer:  {
                    required: true,
                    formatoOrario: true
                },

            orarioGio:  {
                    required: true,
                    formatoOrario: true
                },

            orarioVen:  {
                    required: true,
                    formatoOrario: true
                },

            orarioSab:  {
                    required: true,
                    formatoOrario: true
                },

            orarioDom:  {
                    required: true,
                    formatoOrario: true
                }
        },
        
        messages:
        {
            nome:  {
                required: "   Inserisci il nome del professionista",
                noNumeri: "   Questo campo non può contenere numeri",
                maxlength: "   Massimo 20 caratteri"
            },
            
            cognome:  {
                required: "   Inserisci il cognome del professionista",
                noNumeri: "   Questo campo non può contenere numeri",
                maxlength: "   Massimo 20 caratteri"
            },
            
            dataNascita:  {
                required: "   Inserisci la data di nascita del professionista"
            },
            
            codiceFiscale:  {
                required: "   Inserisci il codice fiscale del professionista",
                remote: "   Codice fiscale già presente, modificare"
            },
            
            sesso:  {
                required: "   Inserisci il sesso del professionista"
            },
            
            email:  {
                required: "   Inserisci l'indirizzo email del professionista",
                email: "   Non rispetta il giusto formato per una mail",
                remote: "   Email già presente, modificare",
                maxlength: "   Massimo 40 caratteri"
            },
            
            password1:  {
                required: "   Inserisci la password per il professionista",
                minlength: "   Minimo 8 caratteri",
                maxlength: "   Massimo 20 caratteri"
            },
            
            password2:  {
                required: "   Conferma la password per il professionista",
                equalTo: "   Conferma password errato"
            },
            
            settore:  {
                required: "   Inserisci il settore del professionista"
            },

            orarioLun:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                },

            orarioMar:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                },

            orarioMer:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                },

            orarioGio:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                },

            orarioVen:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                },

            orarioSab:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                },

            orarioDom:  {
                    required: "   Campo richiesto",
                    formatoOrario: "   Non rispetta il giusto formato per un orario"
                }
            
        }
    }
    );
    
    $("#modificaOra").validate(    {
        
        rules:
        {   
            listaProf:  {
                required: true
            },
            
            modOrarioLun:  {
                required: true,
                formatoOrario: true
            },

            modOrarioMar:  {
                required: true,
                formatoOrario: true
            },

            modOrarioMer:  {
                required: true,
                formatoOrario: true
            },

            modOrarioGio:  {
                required: true,
                formatoOrario: true
            },

            modOrarioVen:  {
                required: true,
                formatoOrario: true
            },

            modOrarioSab:  {
                required: true,
                formatoOrario: true
            },

            modOrarioDom:  {
                required: true,
                formatoOrario: true
            }
        },
        
        messages:
        {
            listaProf:  {
                required: "   Campo richiesto"
            },
            
            modOrarioLun:  {
                required: "   Campo richiesto",
                formatoOrario: "   Non rispetta il giusto formato per un orario"
            },

            modOrarioMar:  {
                required: "   Campo richiesto",
                formatoOrario: "   Non rispetta il giusto formato per un orario"
            },

            modOrarioMer:  {
                required: "   Campo richiesto",
                formatoOrario: "   Non rispetta il giusto formato per un orario"
            },

            modOrarioGio:  {
                required: "   Campo richiesto",
                formatoOrario: "   Non rispetta il giusto formato per un orario"
            },

            modOrarioVen:  {
                required: "   Campo richiesto",
                formatoOrario: "   Non rispetta il giusto formato per un orario"
            },

            modOrarioSab:  {
                required: "   Campo richiesto",
                formatoOrario: "   Non rispetta il giusto formato per un orario"
            },

            modOrarioDom:  {
                required: "   Campo richiesto",
                formatoDurata: "   Non rispetta il giusto formato per un orario"
            }
            
        }
    }
    );
    
    $("#aggiungiSer").validate(    {
        
        rules:
        {            
            nomAggSer:  {
                required: true
            },

            desAggSer:  {
                required: true
            },

            setAggSer:  {
                required: true
            },

            durAggSer:  {
                required: true,
                formatoDurata: "   Non rispetta il giusto formato per un orario"
            }

        },
        
        messages:
        {
            nomAggSer:  {
                required: "   Inserisci il nome del servizio"
            },

            desAggSer:  {
                required: "   Inserisci una descrizione"
            },

            setAggSer:  {
                required: "   Inserisci il settore relativo a questo servizio"
            },

            durAggSer:  {
                required: "   Inserisci la durata del servizio",
                formatoOrario: true
            }
                        
        }
    }
    );
    
    $("#modificaSer").validate(    {
        
        rules:
        {    
            listaSer:  {
                required: true
            },
            
            nomeModSer:  {
                required: true
            },

            descModSer:  {
                required: true
            },

            settModSer:  {
                required: true
            },

            durataModSer:  {
                required: true,
                formatoDurata: "   Non rispetta il giusto formato per un orario"
            }

        },
        
        messages:
        {
            listaSer:  {
                required: "   Campo richiesto"
            },
            
            nomeModSer:  {
                required: "   Inserisci il nuovo nome del servizio"
            },

            descModSer:  {
                required: "   Inserisci una nuova descrizione"
            },

            settModSer:  {
                required: "   Inserisci un nuovo settore"
            },

            durataModSer:  {
                required: "   Inserisci la nuova durata del servizio",
                formatoOrario: true
            }
                        
        }
    }
    );
    
    $("#assegnaSer").validate(    {
        
        rules:
        {    
            listaProfAggiungiSer:  {
                required: true
            }
        },
        
        messages:
        {
            listaProfAggiungiSer:  {
                required: "   Campo richiesto"
            }             
        }
    }
    );
    
    $("#eliminaServizio").validate(    {
        
        rules:
        {    
            listaProfEliminaSer:  {
                required: true
            }
        },
        
        messages:
        {
            listaProfEliminaSer:  {
                required: "   Campo richiesto"
            }             
        }
    }
    );
        
}
);


    
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

$.validator.addMethod("formatoOrario", function(value, element) {
 
    return this.optional( element ) || /^(([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])-([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9]),?)+$/.test( value );
    
}, "   Non rispetta il giusto formato per un orario"); 

$.validator.addMethod("formatoDurata", function(value, element) {
 
    return this.optional( element ) || /^(([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9]))+$/.test( value );
    
}, "   Questo campo non rispetta il giusto formato per un orario"); 
