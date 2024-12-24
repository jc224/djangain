



<style>



  body {

    /* margin: 40px 10px; */

    margin: 0;

    height: 100%;

    width: 100%;

    padding: 0;

    font-size: 14px;

  }



  #calendar {

    width: 100%;

    margin: 0 ;

  }

  .fc-event {

    /* background-color: blue; Changez la couleur de fond en bleu */

}



/* Cibler les cellules de date (jours) */

.fc-day {

    text-transform: uppercase; /* Mettre les jours en majuscules */

    color: forestgreen; /* Changer la couleur des jours en rouge */

}

  



</style>









<div class="content container-fluid">



  <div class="page-header shadow-lg">

    <div class="row ">

      <div class="col-md-6 ">

        <h3 class="page-title mb-0" style="font-weight: bolder;"> BIENVENUE DANS VOTRE ESPACE DJANGUAI </h3>

      </div>

      <div class="col-md-6">

        <ul class="breadcrumb mb-0 p-0 float-right">

          <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Acceuil</a>

          </li>

          <li class="breadcrumb-item"><span>Acceuil </span></li>

        </ul>

      </div>

    </div>

  </div>



  <div class="row">

    <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">

      <!--begin::Items-->

      <a href='<?= yii::$app->request->baseUrl . '/' . md5('site_racourcis') ?>'>

        <div class="dash-widget dash-widget5 shadow-lg">

          <span class="float-left"> <i class="fa fa-plus fs-5x fs-lg-5hx text-gray-500 " aria-hidden="true"></i></span>

          <div class="dash-widget-info text-right">

            <span>Ajouter/modifier un racourcci</span>

          </div>

        </div>

      </a>

    </div>

    <?php

    if (sizeof($action) > 0) {

      foreach ($action as $key => $value) {



        $controller = explode('_', $value['action']);

        // die(var_dump($controller));

        $icon = yii::$app->menuactionClass->getIcon($controller[0]);

        echo '

          <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3 ">

          <!--begin::Items-->

          <a href=' . yii::$app->request->baseUrl . '/' . md5($value['action']) . '>

            <div class="dash-widget dash-widget5 shadow-lg">

              <span class="float-left"> ' . $icon . '</span>

              <div class="dash-widget-info text-right ">

                <span style="font-size:16px"> ' . yii::t("app", $value['action']) . '</span>

              </div>

            </div>

          </a>

        </div>';



      }

    }

    ?>





  </div>

  <div class="row">

 

    <div class="col-lg-12 col-md-12 col-12 d-flex">

      <div class="card flex-fill">

        <div class="card-header">

          <div class="row align-items-center">

            <div class="col-auto">

              <div class="page-title">

                CALENDRIER DES EVENEMENTS

              </div>

            </div>

            

          </div>

        </div>

        <div class="card-body">



          <input type="hidden" id="csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

          <input type="hidden" id="lien" value="<?= Yii::$app->request->baseUrl . "/" . md5("gestion_ajax") ?>">

          <input type="hidden" id="type" value="<?=$admintype['code']?>">

          <div class="table-responsive"> <div id="calendar" ></div>

        </div>

      </div>

    </div>



  </div>





</div>


<?php
  $csrf = Yii::$app->request->getCsrfToken();
  $lien = yii::$app->request->baseUrl . '/' . md5('tb_statistique');

?>

<script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        "use strict";
        var data = null;
        var csrf = $('#csrf').val();
        var lien = $('#lien').val();
        var type = $('#type').val();



        // console.log(response);
        data = <?= $event ?>;
        console.log(data);

        // return false;



        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },

            initialDate: new Date(),
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,

            select: function(arg) {
                console.log(arg);
                // var title = prompt('Event Title:');
                $('#datedebut').val(arg.startStr);
                $('#datefin').val(arg.endStr);
                $('#add_event').modal('show');

                // if (title) {
                //    calendar.addEvent({

                //       title: title,
                //       start: arg.start,
                //       end: arg.end,
                //       allDay: arg.allDay
                //    })
                // }
                calendar.unselect()
            },
            events: data,
        });

        calendar.render();


    });
</script>