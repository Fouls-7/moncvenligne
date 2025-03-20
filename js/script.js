

    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionner tous les liens de la page
        document.querySelectorAll('a').forEach(function(link) {
            // Ajouter l'attribut target="_blank" à chaque lien
            /*link.setAttribute('target', '_blank');*/
        });

        $('#contact-form').submit(function(e){
            e.preventDefault();
            $('.comments').empty();
            var postdata = $('#contact-form').serialize();
            $.ajax({
                type: 'POST',
                url: 'php/contact.php',
                data: postdata,
                dataType: 'json',
                success: function(result){
                    if (result.isSuccess) {
                        $("#contact-form").append("<p class='thank-you'>Votre message a bien été envoyé, merci de m'avoir contacté!</p>");
                        $("#contact-form")[0].reset();
                    }else{
                        $("#firstname + .comments").html(result.firstnameError);
                        $("#name + .comments").html(result.nameError);
                        $("#email + .comments").html(result.emailError);
                        $("#telephone + .comments").html(result.telephoneError);
                        $("#message + .comments").html(result.messageError);
                    }
    
                }
            })
    
        });

    });



