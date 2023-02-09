<?php $title = "MyMeetic - Profil"; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row py-3">
        <h1>Votre messagerie</h1>
        <div class="col-3 py-3">
            <div class="list-group">
                <?php
                if ((isset($_GET['method']) && $_GET['method'] == "new") && isset($_GET['id_recipient'])):
                    if (isset($firstnameByRecipient)):
                ?>
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Conversation avec <?= $firstnameByRecipient['firstname'] ?></a>
                <?php
                    endif;
                endif;
                ?>
                <!-- On affiche la liste des conversations (s'il y en a) -->
            </div>
        </div>
        <div class="col-9 py-3">
            <?php if ((isset($_GET['method']) && $_GET['method'] == "new") && isset($_GET['id_recipient'])): ?>
                <div class="col-12">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-10">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="message" id="message" style="height: 100px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="send" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php elseif ((isset($_GET['method']) && $_GET['method'] == "read") && isset($_GET['id_conversation'])): ?>
                <p>On affiche un formulaire pour lire la conversation</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
