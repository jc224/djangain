<?php
$csrf = Yii::$app->request->getCsrfToken();
$lien = yii::$app->request->baseUrl . '/' . md5('tb_statistique');
?>

<script>
    'use strict';




document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    "use strict";
    var     data= null;
    var csrf = $('#csrf').val();
    var lien = $('#lien').val();
    var type = $('#type').val();
 
 
    $.post(
        lien,
        { type: type, _csrf: csrf, action_key: 'evenementdaa' },
        function (response) {
            console.log(response);
            data =response;
         

        // return false;

    

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'fr',
        headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
    
        initialDate: new Date(),
        editable: true,
        selectable: true,
        businessHours: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: data,
    });

    calendar.render();

}

);
});



    function statforniveau() {
        // alert('qw');
        var url = '<?= $lien ?>';
        var value = [];
        var libelle = [];
        $.post(
            url,
            { action: '<?= md5('statniveau') ?>', _csrf: '<?= Yii::$app->request->getCsrfToken() ?>' },
            function (response) {
                if (response != null) {


                }


            }
        );
    }








    $(document).ready(function () {
        //chargement du calendruer









        statforniveau();
        var value = [];
        var libelle = [];
        // libelle array;


















        $.post(
            '<?= $lien ?>', {
            action: '<?= md5('statans') ?>',
            _csrf: '<?= $csrf ?>'
        },
            function (response) {
                if (response != null) {

                    value = response['value'];
                    libelle = response['libelle'];
                    var options = {
                        series: [{
                            name: "TOTAL ELEVES",
                            data: value
                        }],
                        chart: {
                            height: 450,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        markers: {
                            size: 6,
                            colors: ["#00B871"],
                            strokeColors: "#fff",
                            strokeWidth: 2,
                            hover: {
                                size: 7,
                            }
                        },
                        colors: ["#8944D7"],
                        grid: {
                            row: {
                                colors: ['transparent', 'transparent'],
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: libelle,
                        },
                    };
                    var chart = new ApexCharts(document.querySelector("#chartans"), options);
                    chart.render();
                }

            }
        );


        var eleves = [];
        var pesrnonel = [];
        $.post(
            '<?= $lien ?>', {
            action: '<?= md5('statindividus') ?>',
            _csrf: '<?= $csrf ?>'
        },
            function (response) {
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




    });


  
</script>