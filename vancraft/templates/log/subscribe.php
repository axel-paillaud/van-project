<?php $title = "VanCraft - S'inscrire"; ?>

<?php ob_start(); ?>
<div class="main">
    <div class="subscribe-container">
        <form action="index.php?action=submit-subscribe" method="post">
            <div><label for="name"><b>Prénom</b></label></div>
            <div><input class="subscribe-field" type="text" name="name"></div>
            <div><label for="email"><b>E-mail</b></label></div>
            <div><input class="subscribe-field" type="email" name="email"></div>
            <div><label for="password"><b>Mot de passe</b></label></div>
            <div><input class="subscribe-field" type="password" name="password"></div>
            <div><input class="btn-orange" style="margin-left:0;" type="submit" value="S'inscrire"></div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); 
require('templates/layout.php'); ?>