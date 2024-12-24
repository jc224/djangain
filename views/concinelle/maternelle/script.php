<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();


?>

<script>



function ajouterfonction() {
      libelle = document.getElementById('libelle').value;
      etat = document.getElementById('etatsected').value;
      modifier = document.getElementById('editemo').value;
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#libelle','#classe','#langage'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }

      if (modifier == '1') {
         $('#anneescolaire-form').submit();
         return
      }

      $.post(
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('laguage')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {

            if (response) {
               message("error", '<?= Yii::t("app", "LA fonction existe déjà") ?>')
               $('#btnajout').prop("disabled", false);
               return false;
            } else {
               $('#anneescolaire-form').submit();
            }
            console.log(response);
         }

      );

   }

</script>
