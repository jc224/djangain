<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">
                    <?= yii::t('app', Yii::$app->controller->id) ?>
                </h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="fas fa-home"></i> Acceuil </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">
                            <?= yii::t('app', Yii::$app->controller->id) ?>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>
                            <?= yii::t('app', Yii::$app->controller->action->id) ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-4">
        </div>
        <div class="col-sm-4 col-8 text-right add-btn-col">
            <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#add_event"><i class="fas fa-plus"></i> Ajouter une evenement</a>
        </div>
    </div>
    <div class="row">

        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Categorie Evenement</h4>
                </div>
                <div class="card-body scroll-y ">
                    <div id="eventscat" class="mb-3 scroll-y" style="max-height:100px ;">
                        <?php
                        if (sizeof($eventcat) > 0) {
                            foreach ($eventcat as $key => $value) {
                                //    die(var_dump($eventcat));
                                echo '
                                                <div class="p-1" data-class="' . $value['colore'] . '"><i class="fas fa-circle text-' . $value['colore'] . '"></i> ' . $value['Libelle'] . '</div>
                                               ';
                            }
                        }
                        ?>
                    </div>

                    <a href="#" data-toggle="modal" data-target="#add_new_event" class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Ajouter une Catégorie
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card">
                <input type="hidden" id="csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" id="lien" value="<?= Yii::$app->request->baseUrl . "/" . md5("gestion_ajax") ?>">
                <input type="hidden" id="type" value="0">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
</div>




<div class="modal custom-modal fade none-border" id="my_event">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter Une evenement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success save-event submit-btn">Ajouter</button>
                <button type="button" class="btn btn-danger delete-event submit-btn"
                    data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>


<div id="add_event" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-head bg-primary">
                <h4 class="modal-title">Ajoute une Evenement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate=""
                    action="<?= Yii::$app->request->baseUrl . '/' . md5('gestion_evenement') ?>" name="login-form"
                    id="formajoutevenement" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="action" id="action" value="" />
                    <input type="hidden" name="code" id="code" value="" />
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Titre de l'événement <span class="text-danger">*</span></label>
                            <input class="form-control" name="titre" id="titre" required="" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date Debut de l'événement <span class="text-danger">*</span></label>
                            <input class="form-control  " required="" type="date" value="<?= date('Y-m-d') ?>" name="datedebut" id="datedebut">
                        </div>
                        <div class="form-group col-md-6">

                            <label>Date Fin de l'événement <span class="text-danger">*</span></label>
                            <input class="form-control  datepicker" required="" value="<?= date('Y-m-d') ?>" name="datefin" id="datefin" type="date">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Heure Debut<span class="text-danger">*</span></label>
                            <input class="form-control" type="time" name="Heuredebut" id="Heuredebut">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Heure Fin<span class="text-danger">*</span></label>
                            <input class="form-control" type="time" name="HeureFIn" id="HeureFin">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Categorie
                                <span class="text-danger">*</span></label>
                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color" id="categorycol">
                                <?php
                                if (sizeof($eventcat) > 0) {
                                    foreach ($eventcat as $key => $value) {
                                        //    die(var_dump($eventcat));
                                        echo  ' <option value="' . $value['code'] . '">' . $value['Libelle'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group row col-md-12">
                            <!-- <label for="">Conserner</label> -->
                            <div class="col-md-12">
                                <label class="" for="">Persoonnel Conserner</label>

                            </div>
                            <div class="col-md-1 pb-2">
                                <input class="form-control form-checkbox site" type="checkbox" name="typepers[]" value="5c8188f3915e5b8206ce6657f80176043c3184763053bf8a">
                            </div>
                            <div class="col-md-2 pb-2">
                                <span>Administrateurs</span>
                            </div>
                            <?php
                            if (sizeof($typeuser) > 0) {
                                foreach ($typeuser as $key => $value) {
                                    echo ' 
                                             <div class="col-md-1 pb-2">
                                                <input  class = "form-control form-checkbox site" type="checkbox" name="typepers[]" value="' . $value['code'] . '"> 
                            
                            
                                                </div>     
                                                <div class="col-md-2 pb-2">
                                                <span>' . $value['groupe'] . '</span>
                                                </div>     
                                            
                                           ';
                                }
                            }


                            ?>
                            <div class="col-md-1 pb-2">
                                <input class="form-control form-checkbox site" type="checkbox" name="typepers[]" value="<?= yii::$app->params['parent'] ?>">
                            </div>
                            <div class="col-md-2 pb-2">
                                <span>Parents</span>
                            </div>
                            <div class="col-md-1 pb-2">
                                <input class="form-control form-checkbox site" type="checkbox" name="typepers[]" value="<?= yii::$app->params['prof'] ?>">
                            </div>
                            <div class="col-md-2 pb-2">
                                <span>Enseignant</span>
                            </div>
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="">Description</label>
                            <textarea class="form-control " name="desc" id="desc" cols="30" rows=""></textarea>

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-center">
                    <button class="btn btn-primary submit-btn " id="addevenement" onclick="enregistrer()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal custom-modal fade" id="add_new_event">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head bg-primary ">
                <h4 class="modal-title">Ajouter Une Catégorie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Libelle</label>
                        <input class="form-control form-white" placeholder="Enter name" type="text" id="catename" name="category-name">
                    </div>
                    <div class="form-group">
                        <label>Coulleur</label>
                        <select class="form-control form-white" data-placeholder="Choose a color..." id="catcolor" name="category-color">
                            <option value="#28a745">Success</option>
                            <option value="#dc3545">Danger</option>
                            <option value="#6c757d">Info</option>
                            <option value="#007bff">Primary</option>
                            <option value="#ffc107">Warning</option>
                        </select>
                    </div>
                    <div class="submit-section text-center">
                        <a href="javascript:;" class="btn btn-primary save-category submit-btn" onclick="ajoutecatevent();" data-dismiss="modal">Enregistrer</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('script/param.php'); ?>







<script>
    function enregistrer() {

        $('#addevenement').prop("disabled", true);
        let requiredFields = ['#titre', '#datefin', '#datedebut', '#HeureFin', '#Heuredebut', '#categorycol'];
        if (checkEmptyFields(requiredFields)) {
            $('#addevenement').prop("disabled", false);
            return false;
        }
       $('#formajoutevenement').submit();
    }
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