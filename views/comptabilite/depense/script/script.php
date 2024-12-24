<?php



$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");

$csrf = Yii::$app->request->getCsrfToken();





?>

<script>
   function ajoutcat() {

      libelle = document.getElementById('libelle').value;

      etat = document.getElementById('etatsected').value;
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#libelle'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      if (etat == '2') {

         $('#anneescolaire-form').submit();

         return

      }

      $.post(

         '<?= $url ?>',

         {
            libelle: libelle,
            action_key: '<?= md5(strtolower('depense')) ?>',
            _csrf: '<?= $csrf ?>'
         },

         function(response) {

            if (response) {

               message("error", '<?= Yii::t("app", "Le motif existe déjà") ?>')

               $('#btnajout').prop("disabled", false);

               return;

            } else {



               $('#anneescolaire-form').submit();

            }

            console.log(response);

         }



      );







   }


   function submitdepense() {
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#libelle','#date','#desc','#motifs','#montant'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      $('#formsubmit').submit();

   }
</script>