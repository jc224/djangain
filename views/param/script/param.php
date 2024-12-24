<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();


?>


<script>
   function ajouter() {
      libelle = document.getElementById('libAnnee').value;
      etat = document.getElementById('etatsected').value;
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#libAnnee'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         $('#btnajout').prop("disabled", false);

         return false;
      }

      if (etat == '2') {
         $('#anneescolaire-form').submit();
         return
      }

      $.post(
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('anneeScolaire')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {
            console.log('ok');
            if (response) {
               message("error", '<?= Yii::t("app", "L\'année Scolaire existe déjà") ?>')
               $('#btnajout').prop("disabled", false);
               return;
            } else {
               $('#anneescolaire-form').submit();
            }

         }

      );

   }

   function ajouterniveau() {
      libelle = document.getElementById('niveauEleve').value;
      etat = document.getElementById('etatsected').value;
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#niveauEleve'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      if (etat == '2') {
         $('#anneescolaire-form').submit();
         return
      }

      $.post(
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('niveau')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {
            if (response) {
               message("error", '<?= Yii::t("app", "Le niveau existe déjà") ?>')
               $('#btnajout').prop("disabled", false);
               return;
            } else {
               $('#anneescolaire-form').submit();
            }
            console.log(response);
         }

      );



   }


   function ajouterClaase() {
      libelle = document.getElementById('classe').value;
      libNiveau = document.getElementById('libNiveau').value;
      etat = document.getElementById('etatsected').value;
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#classe'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      if (etat == '2') {
         $('#anneescolaire-form').submit();
         return
      }

      $.post(
         '<?= $url ?>', {
            libelle: libelle,
            libNiveau: libNiveau,
            action_key: '<?= md5(strtolower('classe')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {
            console.log(response);
            if (response) {
               message("error", '<?= Yii::t("app", "Le Classe existe déjà") ?>')
               $('#btnajout').prop("disabled", false);

               return false;
            } else {
               $('#anneescolaire-form').submit();
            }
            console.log(response);
         }

      );



   }

   function ajoutermatiere() {
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
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('matiere')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {

            if (response) {
               message("error", '<?= Yii::t("app", "Le Classe existe déjà") ?>')
               $('#btnajout').prop("disabled", false);

               return false;
            } else {
               $('#anneescolaire-form').submit();
            }
            console.log(response);
         }

      );

   }


   function ajouterpaiement() {
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
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('paiement')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {

            if (response) {
               message("error", '<?= Yii::t("app", "Le Classe existe déjà") ?>')
               $('#btnajout').prop("disabled", false);

               return false;
            } else {
               $('#anneescolaire-form').submit();
            }
            console.log(response);
         }

      );

   }



   function ajouterpaiementpers() {
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
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('paiementpers')) ?>',
            _csrf: '<?= $csrf ?>'
         },
         function(response) {

            if (response) {
               message("error", '<?= Yii::t("app", "L\'acte existe déjà") ?>')
               $('#btnajout').prop("disabled", false);
               return false;
            } else {
               $('#anneescolaire-form').submit();
            }
            console.log(response);
         }

      );

   }

   function ajoutcatpaiement() {

      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#montant'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      $('#mpaiement').submit();
   }

   function modifiercat() {

      $('#addp').prop("disabled", true);
      let requiredFields = ['#montantupdate'];
      if (checkEmptyFields(requiredFields)) {
         $('#addp').prop("disabled", false);
         return false;
      }
      $('#anneescolaire-form').submit();
   }

   function ajouterfonction() {
      libelle = document.getElementById('fonction').value;
      etat = document.getElementById('etatsected').value;
      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#fonction'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      if (etat == '2') {
         $('#anneescolaire-form').submit();
         return
      }

      $.post(
         '<?= $url ?>', {
            libelle: libelle,
            action_key: '<?= md5(strtolower('fonction')) ?>',
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

   function selectpaiement() {
      codepaiement = document.getElementById('seletpaiement').value;
      $.ajax({
         url: '<?= $url ?>',
         type: 'POST',
         data: {
            codepaiement: codepaiement,
            action_key: '<?= md5(strtolower('selectpaiement')) ?>',
            _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'
         },
         success: function(response) {
            // En cas de succès, insérer la réponse dans l'élément avec l'ID 'classe'
            $('#classe').html(response);
         },
         error: function(jqXHR, textStatus, errorThrown) {
            // Gestion des erreurs
            console.error('Erreur AJAX :', textStatus, errorThrown); // Afficher l'erreur dans la console
            alert('Une erreur est survenue : ' + textStatus); // Afficher une alerte à l'utilisateur
         }
      });

   }


   function ajouttaux() {

      $('#btnajout').prop("disabled", true);
      let requiredFields = ['#montant'];
      if (checkEmptyFields(requiredFields)) {
         $('#btnajout').prop("disabled", false);
         return false;
      }
      $('#anneescolaire-form').submit();

   }

   //evenement
   function ajoutecatevent() {
      cat = $('#catename').val();
      coulleur = $('#catcolor').val();
      $.post(
         '<?= $url ?>', {
            cat: cat,
            coulleur: coulleur,
            action_key: '<?= md5(strtolower('ajoutcategorieev')) ?>',
            _csrf: '<?= $csrf = Yii::$app->request->getCsrfToken() ?>'
         },
         function(response) {
            if (response == true) {
               $('#mainErreurMsg').text('<?= Yii::t("app", "Le libelle  existe déjà") ?>');
               $('#miraEmptyMsgPopUp').modal({
                  backdrop: 'static'
               });
               $('#miraEmptyMsgPopUp').modal('show');
               return;
            } else {
               $('#eventscat').html(response);
            }

         }

      );


   }
</script>