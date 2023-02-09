<?php $title = "MyMeetic - Profil"; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row py-3">
        <h1>Gérer votre compte</h1>
        <div class="col-6 py-3">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?= $user['lastname'] ?> <?= $user['firstname'] ?></li>
                    <li class="list-group-item"><?= $user['birthday'] ?></li>
                    <li class="list-group-item">
                        <?php if($user['sexe'] == 0): ?>
                            Féminin
                        <?php elseif($user['sexe'] == 1): ?>
                            Masculin
                        <?php else: ?>
                            Autre
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item"><?= $user['email'] ?></li>
                    <?php if(!empty($hobbies)): ?>
                    <li class="list-group-item">
                        Vos loisirs :
                        <?php foreach ($hobbies as $hobby): ?>
                            <?= $hobby['name'] ?>
                        <?php endforeach; ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-6 py-3">
            <?php if(isset($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errors ?>
                </div>
            <?php endif; ?>
            <h4>Modification de l'email</h4>
            <form action="#" method="POST" class="py-3">
                <div class="row">
                    <div class="col-12">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $user['email'] ?? null ?>">
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12">
                        <button type="submit" name="updateEmail" class="btn btn-primary">Modifier mon email</button>
                    </div>
                </div>
            </form>
            <h4>Modification du mot de passe</h4>
            <form action="#" method="POST" class="py-3">
                <div class="row">
                    <div class="col-12">
                        <input type="password" name="oldPassword" class="form-control" placeholder="Votre ancien mot de passe">
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12">
                        <input type="password" name="password" class="form-control" placeholder="Votre nouveau mot de passe">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="updatePassword" class="btn btn-primary">Modifier mon mot de passe</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <a href="index.php?action=profil&id=<?= $_SESSION['user_id'] ?>" class="btn btn-danger">Supprimer mon compte</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
