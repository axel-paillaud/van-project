<?php ob_start(); ?>
<div class="header-container-offline">
    <a class="logo-xs" href="index.php"><img src="images/logo/logo_xs.svg" alt="logo xs" /></a>
    <input type="text" class="search-bar-primary" name="search-bar"  placeholder="Rechercher ...">
        <button type="button" class="btn-orange" name="sign-in" ><b>S'inscrire</b></button>
        <button type="button" class="btn-orange-log-in" name="log-in" ><b>Se connecter</b></button>
</div>
<?php $header = ob_get_clean(); ?>