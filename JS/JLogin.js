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

$.validator.addMethod("controllaEmail", function (value, element) {

        return this.optional(element) || /^([a-zA-z0-9.]{3,})@([a-zA-z0-9.]+)\.([a-zA-Z]{2,4})/.test(value);

    }, "   Non rispetta il giusto formato per una mail");