<?php ob_start(); ?>
<div class="header-container-offline">
    <a class="logo-xs" href="index.php"><img src="images/logo/logo_xs.svg" alt="logo xs" /></a>
    <input type="text" class="search-bar-primary" name="search-bar"  placeholder="Rechercher ...">
    <a href="#" class="header-hover"><img class="profile-picture-header" src="images/users/default/profile_picture/01.jpg" alt="Photo de profil"></a>
    <a href="index.php?action=log-out"><button type="button" class="btn-orange-alpha" name="log-out" ><b>Déconnexion</b></button></a>

</div>
<?php $header = ob_get_clean(); ?>