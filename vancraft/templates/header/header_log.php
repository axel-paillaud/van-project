<?php ob_start(); ?>
<header class="header-container-offline">
    <a class="logo-xs" href="/home"><img src="images/logo/logo_xs.svg" alt="logo xs" /></a>
    <input type="text" class="search-bar-primary" name="search-bar"  placeholder="Rechercher ...">
    <a href="#" class="header-hover"><img class="profile-picture-header" src="<?= $_SESSION['user_image_profile_sm'] ?>" alt="Photo de profil"></a>
    <a href="/log-out"><button type="button" class="btn-orange-alpha" name="log-out" ><b>Déconnexion</b></button></a>

</header>
<?php $header = ob_get_clean(); ?>