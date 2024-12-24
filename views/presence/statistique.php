<div class="content container-fluid">

    <div class="page-header">

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <h5 class="text-uppercase mb-0 mt-0 page-title">Présence</h5>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <ul class="breadcrumb float-right p-0 mb-0">

                    <li class="breadcrumb-item">

                        <a href="#">

                            <i class="fas fa-home"></i> Acceuil </a>

                    </li>

                    <li class="breadcrumb-item">

                        <a href="#">Présence</a>

                    </li>

                    <li class="breadcrumb-item">

                        <span>Mouvement</span>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <div class="page-content">

        <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl . '/' . md5('eleve_enrollement') ?>" name="login-form" id="anneescolaire-form" method="post">



            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

            <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />



            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="row align-items-center">

                                <div class="col-sm-6">

                                    <div class="page-title">Statisque des presences </div>

                                </div>



                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">



                                <?php

                                if (isset($liste) && sizeof($liste) > 0) {

                                    $j = 0;

                                    foreach ($liste as $key => $value) {

                                        //  die(var_dump($liste));

                                        $stat = yii::$app->eleveClass->actionsTATcLASSE($value['code']);

                                        $statpresent = yii::$app->eleveClass->selectstatis($value['code']);

                                        $j++;

                                        $nb = 0;

                                        $btn = ' <a class="btn btn-primary text-white" href="' . yii::$app->request->baseUrl . '/' . md5('presence_liste') . '/' . $value['code'] . '"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>';



                                        if ($stat) {

                                            $nb  =  $stat['nb'];

                                        }

                                        //  die(var_dump(($stat['nb'])));



                                        echo '  

                                                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">

                                                        <div class="profile-widget">

                                                        

                                                            <h4 class="user-name m-t-10 m-b-0 text-ellipsis">' . $value['nomCLasse'] . '</h4>

                                                            <br><span>Niveau :' . $value['niveau'] . '</span>

                                                            <h5 class="mt-1">Effectif : <span class="badge badge-success">' . $nb . '</span></h5>

                                                            <h5 class="">Présent : <span class="badge badge-primary">' . $statpresent . '</span></h5>

                                                            

                                                        <div class=" mt-3 d-flex flex-center justify-content-center">

                                                            <div class="px-3">

                                                            ' . $btn . '

                                                            </div>

                                                        

                                                        </div>

                                                        </div>

                                                        

                                                    </div>

                                                    ';

                                    }

                                }

                                ?>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>



    <script>

        $(document).ready(function() {

            statistiquepresence();

        })



        function recherchepresence() {

            matricule = $('#matricule').val();

            var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("presence_ajax")) ?>';

            $.post(

                url, {

                    matricule: matricule,

                    action_key: '<?= md5('verifiepresence') ?>',

                    _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'

                },

                function(response) {

                    $('#contentpresence').html(response);

                    // $('#periode').html(response['typeeva']);

                    console.log(response);



                }

            );

        }





        function statistiquepresence() {

            var present = [];

            var absent = [];

            var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("presence_ajax")) ?>';

            // alert('ok');

            return false;



            $.post(

                url, {

                    action: '<?= md5('statistiqueprensence') ?>',

                    _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'

                },

                function(response) {

                    console.log(response);

                    return false;

                    if (response != null) {

                        Morris.Donut({

                            element: 'statindividus',

                            data: [{

                                label: "Total",

                                value: response['total'],

                                labelColor: '#8944D7'

                            }, {

                                label: "Personnel",

                                value: response['pesrs'],

                                labelColor: '#2FDF84'

                            }, {

                                label: "Elèves",

                                value: response['eleves'],

                                labelColor: '#86B1F2'

                            }],

                            colors: ['#8944D7', '#2FDF84', '#00B871', '#86B1F2'],

                            resize: true,

                            redraw: true,

                        });





                    }



                }

            );

        }

    </script>