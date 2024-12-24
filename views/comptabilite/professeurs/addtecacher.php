<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">ajout professeur</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.html">professeur</a></li>
                    <li class="breadcrumb-item"><span> ajout professeur</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <form class="" enctype="multipart/form-data" method="post" novalidate="novalidate"
                                    action="<?= Yii::$app->request->baseUrl.'/'.md5("personnel_addteachers")?>">
                                    <input type="hidden" name="_csrf" vlue="<?= Yii::$app->request->getCsrfToken() ?>" />
                                      <input type="hidden" name="action" id="action" value=""/>

                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Genre</label>
                                        <select class="form-control" name="genre" id="genre" aria-hidden="true">
                                            <option value="1">Masculin</option>
                                            <option value="2">Féminin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> Date de Naissance</label>
                                        <input class="form-control datetimepicker-input datetimepicker" id="dnais" name="dnais" type="text"
                                            data-toggle="datetimepicker">
                                    </div>
                                    <div class="form-group">
                                        <label> Adresse</label>
                                        <input class="form-control " type="text" id="lnai" name="adresse">
                                    </div>
                                    <div class="form-group">
                                        <label> Date début Service</label>
                                        <input class="form-control datetimepicker-input datetimepicker" id="Datedebutservice" name="Datedebutservice" type="text"
                                            data-toggle="datetimepicker">
                                    </div>
                                    <div class="form-group students-up-files">
                                        <label>Ajouter Une Photo</label>
                                        <div class="uplod">
                                            <div id="frames" style="broder:1px solid black; " class="mb-2"></div>
                                            <label class="file-upload image-upbtn mb-0"> Choisir une photo <input
                                                    type="file" id="image" class="" name="photo" accept="image/*" />
                                                <br />
                                            </label>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                                <div class="form-group">
                                    <label>Prénoms</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Numéro de téléphone </label>
                                    <input class="form-control" name="tel" id="tel" type="text">
                                </div>

                                <div class="form-group">
                                    <label> Matricule</label>
                                    <input type="text" name="mat" id="mat" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Lieu de Naissance</label>
                                    <input type="text"  name="lieuNai" id="lieuNai" class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <label>Catégorie D'enseignants</label>
                                    <select class="form-control" name="groupe" id="groupe" aria-hidden="true">
                                        <option hidden>Séléctionner une Catégorie...</option>
                                        <option value="1">Titulaire</option>
                                        <option value="2">Non Titulaire</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>A propos</label>
                                    <textarea class="form-control"  id="desc" name="desc" rows="4"></textarea>
                                </div>

                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <form>
                                <div class="form-group text-center custom-mt-form-group">
                                    <button class="btn btn-primary mr-2" type="submit">Valider</button>
                                    <button class="btn btn-secondary" type="reset">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<script>
$(document).ready(function() {
    $('#image').change(function() {
        $("#frames").html('');
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#frames").html('<img src="' + window.URL.createObjectURL(this.files[i]) +
                '" width="100px" height="100px"/>');
        }
    });

    $('#submit').click(function() {
        $('#form').submit();
    });
});
</script>