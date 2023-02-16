{% extends "layout.php" %}
{% block title %}Vancraft - Page d'accueil{% endblock %}
{% block content %}
<main class="main">
    {% if bad_message %}
        <div class="message-container error">
            {{ message }}
        </div>
    {% elseif message %}
        <div class="message-container">
            {{ message }}
        </div>
    {% endif %}
    <div class="title-container">
        <div class="title-text-container">
            <h1 class="title-title">VanCraft</h1>
            <h2 class="title-subtitle">Une aide communautaire à la réalisation de son véhicule aménagé.</h2>
        </div>
       <div class="title-logo-container">
            <img src="assets/images/logo/logo.svg" alt="VanCraft Logo"/>
       </div>
    </div>
    <div class="content-post-container">
        <div class="title-btn-post-container">
            <p class="header-title-post">Questions populaires</p>
            <a href="/post-article"><button class="btn-orange"><b>Poser une question</b></button></a>
        </div>
        <hr class="horizontal-rule">

        <!-- parent's div for first child and last child -->
        <div>
        {% for post in posts %}
            <div class="post-container">
                <div class="row-container">
                    <a href="/post-10" class="post-title">
                        {{ post.title }}
                    </a>
                    <div class="views-votes-container">
                        <div class="post-stat">
                            {{ post.votes }} votes
                        </div>
                        <div class="post-stat">
                            {{ post.answers }} réponses
                        </div>
                        <div class="post-stat">
                            {{ post.views }} vues
                        </div>
                    </div>
                </div>
                <div class="row-container">
                    <div class="tag-container">
                        {% for tag in post.tags %}
                            <div class="tag">{{ tag.title }}</div>
                        {% endfor %}
                    </div>
                    <div class="user-container">
                        <img class="profile-picture-small" src="assets/images/users/{{ post.user_image_profile_url }}" alt="Photo profil">
                        <b style="margin-left: 8px;" >{{ post.user_name }}</b>
                    </div>
                </div>
            </div>
        {% endfor %}
        </div>   
    </div>
</main>
{% endblock %}
