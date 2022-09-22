<?php ob_start(); ?>
<div class="sidenav">
    <a href="#"<?php if ($which_page == 1) {echo $here;}; ?>>Accueil</a>
    <a href="#">Questions</a>
    <a href="#">Mots-clés</a>
    <a href="#">Utilisateurs</a>
</div>
<?php $sidebar = ob_get_clean(); ?>