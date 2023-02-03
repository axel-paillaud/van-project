<?php ob_start(); ?>
<?php $title = "VanCraft - S'inscrire"; ?>

<main class="main">
    <div class="subscribe-container">
        <form action="/submit-subscribe" method="post">
            <label for="name"><b>Nom d'utilisateur</b></label>
            <input class="subscribe-field" type="text" name="name">
            <label for="email"><b>E-mail</b></label>
            <input class="subscribe-field" type="email" name="email">
            <label for="password"><b>Mot de passe</b></label>
            <input class="subscribe-field" type="password" name="password">
            <label for="confirm-password"><b>Confirmer le mot de passe</b></label>
            <input class="subscribe-field" type="password" name="confirm-password">
            <input class="btn-orange" style="margin-left:0;" type="submit" value="S'inscrire">
        </form>
    </div>
    <?php if ($subscribe_succes === true) : ?>
        <div class="subscribe-succes-container">
            Votre inscription a bien été pris en compte.<div class="check-icon"></div>
        </div>
    <?php endif; ?>
</main>
<?php $content = ob_get_clean(); 
