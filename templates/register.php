<?php $title = "MyMeetic - Inscription"; ?>

<?php ob_start(); ?>
<main class="form-signin w-100 m-auto">
    <?php if(!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endforeach ; ?>
    <?php endif; ?>
    <form method="POST" action="#">
        <h1 class="h3 mb-3 fw-normal">Inscrivez-vous</h1>
        <div class="form-floating">
            <input type="lastname" class="form-control" id="lastname" placeholder="Nom" name="lastname" value="<?= $_POST['lastname'] ?? null ?>">
            <label for="lastname">Nom</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="firstname" class="form-control" id="firstname" placeholder="Prénom" name="firstname" value="<?= $_POST['firstname'] ?? null ?>">
            <label for="firstname">Prénom</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="date" class="form-control" id="birthday" placeholder="Date de naissance" name="birthday" value="<?= $_POST['birthday'] ?? null ?>">
            <label for="birthday">Date de naissance</label>
        </div>
        <br>
        <div class="form-floating">
            <select name="sexe" id="sexe" class="form-select">
                <option value="0" selected>Féminin</option>
                <option value="1">Masculin</option>
                <option value="2">Autre</option>
            </select>
        </div>
        <br>
        <div class="form-floating">
            <select class="form-select" aria-label="Ville" name="city">
                <option value="Paris">Paris</option>
                <option value="Lyon">Lyon</option>
                <option value="Marseille">Marseille</option>
            </select>
        </div>
        <br class="space-line-form">
        <div class="form-floating selectHobby">
            <select class="form-select" multiple aria-label="Hobby" id="hobby" name="hobbies[]">
                <?php foreach($hobbies as $hobbie): ?>
                    <option value="<?= $hobbie['id'] ?>"><?= $hobbie['name'] ?></option>
                <?php endforeach; ?>
                    <option value="Autre">Autre</option>
            </select>
        </div>
        <br class="space-line-form-none" style="display: none">
        <div class="form-floating hobby" style="display: none">
            <input type="text" class="form-control" id="inputHobby" placeholder="Loisir" name="inputHobby" value="<?= $_POST['inputHobby'] ?? null ?>">
            <label for="inputHobby">Préciser votre loisir</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $_POST['email'] ?? null ?>">
            <label for="email">Email</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
            <label for="password">Mot de passe</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Inscription</button>
        <a href="index.php" class="mt-3 w-100 btn btn btn-secondary">Connexion</a>
    </form>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout_login.php') ?>
