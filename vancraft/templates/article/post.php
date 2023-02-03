<?php ob_start(); ?>
<?php $title = "Vancraft - Poser une question" ?>
<main class="main">
    <div class="send-post-container">
        <form action="/submit-post" method="post">
            <div><label for="title"><b>Titre</b></label></div>
            <div><input autocomplete="off" class="post-field" type="text" name="title" placeholder="Soyez spécifique et faites comme si vous posez la question à vous-même."></div>
            <div><label for="content"><b>Contenu</b></label></div>
            <div><textarea class="post-field content" autocomplete="off" name="content" placeholder="Quels sont les détails de votre question ? Développez le contenu de votre titre ici."></textarea></div>
            <div><label for="title"><b>Mots-clefs</b></label></div>
            <div><input autocomplete="off" class="post-field" type="text" name="tags" placeholder="Ajouter jusqu'à 5 mots-clefs (tags) à votre question. Séparer les mots-clefs par des virgules."></div>
            <div><input class="btn-orange" type="submit" value="Envoyer la question" style="margin-left: 0;"></div>
        </form>
    </div>
</main>
<?php $content = ob_get_clean(); ?>
