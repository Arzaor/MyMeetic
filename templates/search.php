<?php $title = "MyMeetic - Recherche"; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row py-5">
        <div class="col-12">
            <form method="POST" action="#" id="searchForm">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <select name="sexe" id="sexe" class="form-select">
                            <option value="-1" selected>Sexe</option>
                            <option value="0">Femme</option>
                            <option value="1">Homme</option>
                            <option value="2">Autre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <select name="age" id="age" class="form-select">
                            <option value="-1" selected>Tranche d'âge</option>
                            <option value="0">18-25 ans</option>
                            <option value="1">25-35 ans</option>
                            <option value="2">35-35 ans</option>
                            <option value="3">+45 ans</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <select class="form-select" multiple aria-label="Ville" id="cities" name="cities[]">
                            <option value="Paris">Paris</option>
                            <option value="Lyon">Lyon</option>
                            <option value="Marseille">Marseille</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <select class="form-select" multiple aria-label="Loisirs" id="hobbies" name="hobbies[]">
                            <?php foreach ($getHobbies as $hobby): ?>
                                <option value="<?= $hobby['id'] ?>"><?= $hobby['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="search" class="btn btn-primary">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row results"></div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>