{% extends "layout.php" %}

{% block title %}Vancraft - Poser une question{% endblock %}

{% block content %}
<main class="main">
    <div class="send-post-container">
        <form id="post-form" action="/submit-post" method="post" enctype="multipart/form-data">
            <label for="title"><b>Titre</b></label>
            <input id="title" maxlength="496" autocomplete="off" required class="post-field" type="text" name="title" placeholder="Soyez spécifique et faites comme si vous posez la question à vous-même.">
            <label for="content"><b>Contenu</b></label>
            <textarea id="content" required class="post-field text-content" autocomplete="off" name="content" placeholder="Quels sont les détails de votre question ? Développez le contenu de votre titre ici."></textarea>
            <div id="add-img" class="add-img mt-16 mb-32">
                <label for="image">
                    <p class="btn-brown-light">+ Ajouter des photos</p>
                    <input class="display-none" id="image" type="file" name="image[]" accept="image/png, image/jpeg, image/gif" multiple max="4">
                    <img src="assets/images/icons/pictures-brown.svg" alt="Ajouter une photo">
                </label>
                <small class="margin-left-8">Jusqu'à 4 photos, jpg, png, gif : 2mo max</small>
            </div>
            <label><b>Mots-clefs</b></label>
            <div class="post-tags-container">
                <span>Ajouter jusqu'à 5 mots-clefs (tags) à votre question.</span>
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tag[]" maxlength="64">
                    <div id="js-modal-tag" class="modal-tags" style="display: none;"></div>
                </div>
            </div>
            <input id="submit-btn" class="btn-orange mt-16 padding-base" type="submit" value="Envoyer la question">
        </form>
    </div>
    <div id="js-error-msg"></div>
</main>
<script src="assets/js/thumbnailImgFunction.js"></script>
<script src="assets/js/addTags.js"></script>
{% endblock %}
