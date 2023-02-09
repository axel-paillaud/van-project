{% set active = "class=active-page" %}
<aside class="sidenav">
    <nav>
        <a {% if page == 'home' %} {{ active }} {% endif %} href="/home">Accueil</a>
        <a {% if page == 'post' %} {{ active }} {% endif %} href="/post-article">Questions</a>
        <a {% if page == 'tag' %} {{ active }} {% endif %} href="#">Mots-clés</a>
        <a {% if page == 'user' %} {{ active }} {% endif %} href="#">Utilisateurs</a>
    </nav>
</aside>
