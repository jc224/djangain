<script>
    function ajoutermatier() {
        $('#btnajout').prop("disabled", true);
        let requiredFields = ['#seletmatier'];
        if (checkEmptyFields(requiredFields)) {
            $('#btnajout').prop("disabled", false);
            return false;
        }
        $('#anneescolaire-form').submit();

    }

    function selectmat() {
        codematiere = document.getElementById('seletmatier').value;
        $.post(

            '<?= $url = Yii::$app->request->baseUrl . "/" . md5("gestion_ajax") ?>',

            {
                codematiere: codematiere,
                action_key: '<?= md5(strtolower('selectmatiere')) ?>',
                _csrf: '<?= $csrf = Yii::$app->request->getCsrfToken() ?>'
            },

            function(response) {

                console.log(response);

                $('#classe').html(response);

            }



        );

    }
</script>