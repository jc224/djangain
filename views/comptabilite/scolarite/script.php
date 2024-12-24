<script>

    function calculTotal(){
        var paiement = $('#paiement').val();
        var matricule = document.getElementById('matricule').value;
        // var classe = document.getElementById('classe').value;
        $('#somPaier').val('');
        $('#apaiier').val('');
        var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("comptable_scolarite")) ?>';
        
        $.post(
             url, 
             {matricule: matricule,paiement: paiement, action_key:  '<?= md5('1') ?>'  ,_csrf: '<?=  Yii::$app->request->getCsrfToken() ?>' },
             function(response)
             {
               $('#somPaier').val(response['montant']);
               //$('#apaiier').val(response['montant']);
               
             }
        );

        

    }


  
     function calcul(){
      somPaier =  $('#somPaier').val(); 
      montant =  $('#montant').val(); 
      $('#reste').val(''); 
    alert(montant);
      if(montant > somPaier){
        $('#montant').val(''); 
        $('#reste').val(''); 

        $('#montant').focus();
         alert('Le montant doit pas etre superieur a la somme a paier');
      }else{
        $('#reste').val(somPaier - montant); 


      }
 
       
     }


     function selectpaiement(){
        alert('salut');
     }
</script>