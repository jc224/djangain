<?php
    $url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
    $csrf = Yii::$app->request->getCsrfToken();
  
?>







<script>
    function ajouter(){
        $('#action').val('<?= md5('paiementpers')?>');
        $('#ajoutforme').submit();
    }



    function paiementprof() {
        codeprof =$('#codePrpf').val();
     
        $.post(
         '<?= $url ?>',
         { codeprof: codeprof,action_key: '<?= md5(strtolower('charlistepaiemt')) ?>', _csrf: '<?= $csrf ?>' },
         function (response) {
            $('#typepaiement').html(response);
           
            console.log(response);
         }

      );   
      codefonction =$('#codefonction').val();
          $.post(
         '<?= $url ?>',
         { codefonction: codefonction,action_key: '<?= md5(strtolower('chargefonction')) ?>', _csrf: '<?= $csrf ?>' },
         function (response) {
           $('#salaire').val(response);
           $('#netpaier').val(response)  ;
           calculesalaire();
            console.log(response);
         }

      );        
    }


    function calculesalaire() {
        salaire= parseInt($('#salaire').val()     )
       montantppaye= parseInt($('#montantppaye').val());
       prime= parseInt($('#prime').val())  ;
       netpaier = salaire+prime;

       $('#netpaier').val(netpaier)  ;
        
       restepayer = netpaier - montantppaye;
       prime= parseInt($('#restepaier').val(restepayer))  ;


    }
</script>