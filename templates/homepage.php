<?php $title = "MyMeetic - Connexion"; ?>

<?php ob_start(); ?>
<main class="form-signin w-100 m-auto">
    <?php if(isset($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errors ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="#">
        <h1 class="h3 mb-3 fw-normal">Connectez-vous</h1>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            <label for="password">Mot de passe</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="connexion">Connexion</button>
        <a href="index.php?action=register" class="mt-3 w-100 btn btn btn-secondary">Inscription</a>
    </form>
</main>
<?php $content = ob_get_clean(); ?>
<?php require('layout_login.php') ?>
