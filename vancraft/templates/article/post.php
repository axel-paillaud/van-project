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
            <div id="add-img">
                <label for="image">
                    <b>+ Ajouter une photo</b><br>
                    <input id="image" type="file" name="image" accept="image/png, image/jpeg, image/gif" multiple max="5">
                </label>
                <small>jpg, png, gif : 2mo max</small>
            </div>
            <label><b>Mots-clefs</b></label>
            <div class="post-tags-container">
                <span>Ajouter jusqu'à 5 mots-clefs (tags) à votre question.</span>
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tag[]" maxlength="26">
                    <div id="js-modal-tag" class="modal-tags" style="display: none;"></div>
                </div>
            </div>
            <input id="submit-btn" class="btn-orange margin-16-0-0-0" type="submit" value="Envoyer la question">
        </form>
    </div>
    <div id="js-error-msg"></div>
</main>
<script src="assets/js/addTags.js"></script>
{% endblock %}
