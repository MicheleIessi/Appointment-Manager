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
        })
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
        })
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
        })
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
        })
    });


























    //funzionamento bottone logout e funzione logout
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



});