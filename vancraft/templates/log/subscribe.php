<?php ob_start(); ?>
<?php $title = "VanCraft - S'inscrire"; ?>

<div class="main">
    <div class="subscribe-container">
        <form action="/submit-subscribe" method="post">
            <div><label for="name"><b>Nom d'utilisateur</b></label></div>
            <div><input class="subscribe-field" type="text" name="name"></div>
            <div><label for="email"><b>E-mail</b></label></div>
            <div><input class="subscribe-field" type="email" name="email"></div>
            <div><label for="password"><b>Mot de passe</b></label></div>
            <div><input class="subscribe-field" type="password" name="password"></div>
            <div><label for="confirm-password"><b>Confirmer le mot de passe</b></label></div>
            <div><input class="subscribe-field" type="password" name="confirm-password"></div>
            <div><input class="btn-orange" style="margin-left:0;" type="submit" value="S'inscrire"></div>
        </form>
    </div>
    <?php if ($subscribe_succes === true) : ?>
        <div class="subscribe-succes-container">
            Votre inscription a bien été pris en compte.<div class="check-icon"></div>
        </div>
    <?php endif; ?>
</div>
<?php $content = ob_get_clean(); 
