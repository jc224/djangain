<?php
    $url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
    $csrf = Yii::$app->request->getCsrfToken();
  
?>







<script>
    function ajouter(){
        $('#action').val('<?= md5('addpaiementprof') ?>');
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
    }


    function calculesalaire() {
        tuaxhoorair = <?= (isset($taux['libelle']) ?  $taux['libelle'] : '0' )?>;
       montanttaux= parseInt($('#heureenseigner').val()   * tuaxhoorair  )
       heuresupl= parseInt($('#heuresupl').val()  * tuaxhoorair );
       montantppaye= parseInt($('#montantppaye').val());
       prime= parseInt($('#prime').val())  ;
       netpaier = montanttaux+heuresupl+prime;

       $('#netpaier').val(netpaier)  ;
        
       restepayer = netpaier - montantppaye;
       prime= parseInt($('#restepaier').val(restepayer))  ;


    }
</script>