<style>
    @page {

        size: 54.98mm 86.6mm;

        margin: 0;

        padding: 0;

    }



    #main {

        max-width: 100%;

        height: auto;

        background-image: url("<?= $retro ?>");

        background-size: cover;

        height: 100%;

        width: 100%;

        font-family: "Calibri";





    }



    #mainVerso {

        max-width: 100%;

        height: auto;

        background-image: url("<?= $verso ?>");

        background-size: cover;

        height: 100%;

        width: 100%;

        font-family: "Calibri";

    }



    .text {

        padding-left: 20px;

        padding-right: 20px;

        height: 40%;

        font-size: 8px;





        text-align: justify;

    }

    .infobottom {



        padding-left: 20px;

        padding-right: 20px;

        height: 12%;

        font-size: 10px;

        padding-top: 20%;

    }

    /* Clear floats after the columns */







    .img {

        padding-top: 113px;
        /* border: 1px solid #1D1D27; */
        padding-left: 66px;

    }



    .imgprofil {
        height: 79px;
        width: 79px;
        background-color: white;
        /* border-radius: 30px; */
        border-radius: 100%;
        background-image: url('<?= $photo ?>');
        overflow: hidden;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: 50% 180%;
        background-position: center;



    }





    .div1,

    .div2 {

        display: inline-block;

        float: left;

        width: 50%;

        /* vous pouvez ajuster la largeur selon vos besoins */



    }





    .information {
        height: 40%;
        padding-top: 3px;
        /* color:#f7f6f2; */

    }





    .information p {
        text-transform: uppercase;
        padding-top: -13px;
        text-align: center;
        font-size: 12px;
        color: #102C3D;
    }



    .other {



        border: 1px solid #FFC300;



        padding-left: 4px;

        padding-right: 4px;

        display: flex;

        align-items: flex-start;

        justify-content: space-between;





    }

    .col {

        float: left;

        width: 50%;

        text-align: center;



    }



    .other p {

        /* text-align:center; */

    }



    p span {

        text-align: center;

    }



    .barcodecell {

        margin-top: 8px;

        margin-left: 10px;

        margin-right: 10px;



        text-align: center;

        vertical-align: middle;

    }



    .qrcode {

    

    }
</style>

<div id="main">

    <div class="img">

        <div class="imgprofil">



        </div>

    </div>

    <div class="information">



        <p><span style="font-weight:bold;"></span><span><?= strtoupper($value['nom']) ?> <?= $value['prenom'] ?></span></p>
        <p><span style="font-weight:bold;"></span><span><?= $classe['libelle'] ?></span></p>
        <!-- <p ><span style="font-weight:bold;"></span><span><?= $classe['libClasse'] ?></span></p> -->
        <p> <span style="font-weight:bold;"></span><span><?= $value['matricule'] ?></span></p>

        <div class="qrcode" style=" padding-left:75px;">

        <div style="width:55px;height:55px;  ">

            <img src="<?= $qr ?>" alt="qrcode">

        </div>
    </div>


    </div>



</div>



<div id="mainVerso" style="height: 100%;">

</div>