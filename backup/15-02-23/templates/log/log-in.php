{% extends "layout.php" %}
{% block title %}Vancraft - Se connecter{% endblock %}

{% block content %}
<main class="main">
    <div class="subscribe-container">
        <form action="/submit-log-in" method="post">
            <label for="name"><b>Nom d'utilisateur</b></label>
            <input class="subscribe-field" type="text" name="name">
            <label for="email"><b>E-mail</b></label>
            <input class="subscribe-field" type="email" name="email">
            <label for="password"><b>Mot de passe</b></label>
            <input class="subscribe-field" type="password" name="password">
            <input class="btn-orange margin-8-0" type="submit" value="Se connecter">
        </form>
    </div>
</main>
{% endblock %}
