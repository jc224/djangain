<style>
    @page {

        size: 54mm 85.6mm;
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

    .img {

        padding-top: 75px;
        /* border: 1px solid #1D1D27; */
        padding-left: 52px;

    }



    .imgprofil {
        height: 100px;
        width: 100px;
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
        height: 20%;
        margin-bottom: 0;

    }





    .information p {
        text-transform: uppercase;
        text-align: center;
        font-size: 10px;

        color: #102C3D;
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
       <p class=""><span style="font-weight:bold;"></span><span><?= strtoupper($value['nom']) ?> <?= $value['prenom'] ?></span></p>
        <div  style="margin-top: 16px;">
           <p><span style="font-weight:bold;"></span><span><?= $classe['libelle'] ?></span> <br>
              </span><span><?= $value['matricule'] ?></span></p>

        </div>
        <!-- <p ><span style="font-weight:bold;"></span><span><?= $classe['libClasse'] ?></span></p> -->



    </div>



    <div class="qrcode" style="margin-top: -6px; padding-left:67px;">

<div style="width:57px;height:57px;border: 1px solid #102C3D; padding: 2px; ">

    <img src="<?= $qr ?>" alt="qrcode">

</div>
</div>
</div>



<!-- <div id="mainVerso" style="height: 100%;">

</div> -->