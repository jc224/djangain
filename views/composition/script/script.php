<script>

  
function rechercher() {
  $('#action').val('<?= md5(strtolower("search")) ?>');
     $('#eval-form').submit();
}
   function selectmatiere(){

      code =$('#classeSelect').val();
      var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("evaluation_ajax")) ?>';
      $('#Coeficient').val('');
      $.post(
             url, 
             {code:code, action_key:  '<?= md5('1') ?>'  ,_csrf: '<?=  Yii::$app->request->getCsrfToken() ?>' },
             function(response)
             {
                $('#matiere').html(response['libmatiere']);
                $('#periode').html(response['typeeva']);
               //  console.log(response);
               
             }
        );
  }

  function selectFile() {
    document.getElementById("fileInput").click();
  }

  function verifinote(){
    
  }

  document.getElementById("fileInput").addEventListener("change", function (event) {
    var selectedFile = event.target.files[0];
    // Manipulez le fichier sélectionné ici
    $('#action').val('<?= md5(strtolower("imporetenote")) ?>');
    $('#eval-form').submit();
    // console.log(selectedFile);
  });

  function coeefmatiere(){
    codeClasse =$('#classeSelect').val();
    code =$('#matiere').val();
      var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("evaluation_ajax")) ?>';

      $.post(
             url, 
             {code:code,codeClasse:codeClasse, action_key:  '<?= md5('2') ?>'  ,_csrf: '<?=  Yii::$app->request->getCsrfToken() ?>' },
             function(response)
             {
                 $('#Coeficient').val(response['coef']);
                // $('#periode').html(response['typeeva']);
                console.log(response);
               
             }
        );
  }

  function getImg(){
    console.log('oj');
  }

</script>