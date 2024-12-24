<script>

  function rechercher() {
    $('#action').val('<?= md5(strtolower("search")) ?>');
    $('#eval-form').submit();
  }

  function calcmoy1(id) {
    max = '<?=$max?>';
    note1 = parseInt($('#notea1' + id + '').val());
    notea2 = parseInt($('#notea2' + id + '').val());
    notea = note1 + notea2;
    parseInt($('#notea' + id + '').val(notea / 2));


  }
  function calcmoy2(id) {
    note1 = parseInt($('#noteb1' + id + '').val());
    notea2 = parseInt($('#noteb2' + id + '').val());
    notea = note1 + notea2;
    parseInt($('#noteb' + id + '').val(notea / 2));


  }
  function calcmoy3(id) {
    note1 = parseInt($('#notec1' + id + '').val());
    notea2 = parseInt($('#notec2' + id + '').val());
    notea = note1 + notea2;
    parseInt($('#notec' + id + '').val(notea / 2));


  }


  function calculnote(id) {
    max = <?=$max?>;
 
    note1 = parseInt($('#notea1' + id + '').val());
    note2 = parseInt($('#notea2' + id + '').val());
    note3 = parseInt($('#notec1' + id + '').val());

    if(note1 > max || note1 <0){
      note1 =0 ;
      $('#notea1' + id + '').val('0');
    }
    
    if(note2 > max || note2 <0){
      note2 =0 ;
      $('#notea2' + id + '').val('0');
    }

    if(note3 > max || note2 <0){
      note3 =0 ;
      $('#notec1' + id + '').val('0');
    }


    if (note3) {
      notea = (note1 + note2 + note3) / 3;

    } else {
      notea = (note1 + note2) / 2;

    }
    $('#moy' + id + '').val(notea);


  }




  function selectFile() {
    document.getElementById("fileInput").click();
  }

  document.getElementById("fileInput").addEventListener("change", function (event) {
    var selectedFile = event.target.files[0];
    // Manipulez le fichier sélectionné ici
    $('#action').val('<?= md5(strtolower("pdf")) ?>');
    $('#eval-form').submit();
    // console.log(selectedFile);\
  });

  function selectmatiere() {

    code = $('#classeSelect').val();
    var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("evaluation_ajax")) ?>';
    $('#Coeficient').val('');
    $.post(
      url,
      { code: code, action_key: '<?= md5('1') ?>', _csrf: '<?= Yii::$app->request->getCsrfToken() ?>' },
      function (response) {
        $('#matiere').html(response['libmatiere']);
        $('#periode').html(response['typeeva']);
        //  console.log(response);

      }
    );
  }

  function coeefmatiere() {
    codeClasse = $('#classeSelect').val();
    code = $('#matiere').val();
    var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("evaluation_ajax")) ?>';

    $.post(
      url,
      { code: code, codeClasse: codeClasse, action_key: '<?= md5('2') ?>', _csrf: '<?= Yii::$app->request->getCsrfToken() ?>' },
      function (response) {
        $('#Coeficient').val(response['coef']);
        // $('#periode').html(response['typeeva']);
        console.log(response);

      }
    );
  }

  function getImg() {
    console.log('oj');
  }

</script>