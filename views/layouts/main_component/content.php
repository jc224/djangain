
<?= $content ?>

<script>
    function checkEmptyFields(fields) {
        let isEmpty = false; // Initialisation de la variable de vérification
        fields.forEach(function(selector) {
            // Vérifier si la valeur du champ est vide

            if ($(selector).val().trim() === "") {
                $(selector).addClass('error');
                isEmpty = true;
                // return false;
            } else {
                $(selector).removeClass('error');
            }
        });
        if (isEmpty) {
            o = "rtl" === $("html").attr("data-textdirection"),
                toastr.error(
                    "Veuillez remplir tous les champs obligatoires.",
                    "Erreur", {
                        positionClass: "toast-top-right",
                        rtl: o
                    }
                );
        }
        return isEmpty; // Retourne true si l'un des champs est vide
    }
</script>
<style>
    .error {
        border: 1px solid red;
        /* Bordure rouge pour les champs vides */
    }
</style>