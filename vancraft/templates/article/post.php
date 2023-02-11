{% extends "layout.php" %}

{% block title %}Vancraft - Poser une question{% endblock %}

{% block content %}
<main class="main">
    <div class="send-post-container">
        <form action="/submit-post" method="post">
            <label for="title"><b>Titre</b></label>
            <input id="title" autocomplete="off" class="post-field" type="text" name="title" placeholder="Soyez spécifique et faites comme si vous posez la question à vous-même.">
            <label for="content"><b>Contenu</b></label>
            <textarea id="content" class="post-field text-content" autocomplete="off" name="content" placeholder="Quels sont les détails de votre question ? Développez le contenu de votre titre ici."></textarea>
            <label><b>Mots-clefs</b></label>
            <div class="post-tags-container">
{#                 Ajouter jusqu'à 5 mots-clefs (tags) à votre question. Séparer les mots-clefs par des virgules.
 #}             
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tags">
                    <div class="modal-tags">
                        <ul>
                            <li>armaflex</li>
                            <li>styrodur</li>
                            <li>laine</li>
                        </ul>
                    </div>
                </div>
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tags">
                </div>
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tags">
                </div>
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tags">
                </div>
                <div class="input-tag-container">
                    <input autocomplete="off" type="text" name="tags">
                </div>
            </div>
            <input autocomplete="off" class="post-field" type="text" name="tags" placeholder="Ajouter jusqu'à 5 mots-clefs (tags) à votre question. Séparer les mots-clefs par des virgules.">
            <input class="btn-orange" type="submit" value="Envoyer la question" style="margin-left: 0;">
        </form>
    </div>
</main>
<script src="assets/js/addTags.js"></script>
{% endblock %}
