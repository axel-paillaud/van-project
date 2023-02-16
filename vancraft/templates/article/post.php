{% extends "layout.php" %}

{% block title %}Vancraft - Question numéro xxx {% endblock %}

{% block content %}

<main class="main">
    <article class="article-container">
        <div class="flex-space-between">
            <h2 class="margin-16-0 font-normal font-size-27">Pourquoi le choix de l'armaflex est judicieux face à de la laine de verre</h2>
            <a class="btn-orange">Poser une question</a>
        </div>
        <small class="flex align-center gap-16">
            <time>Date: Aujourd'hui</time><p>Nombre de vue: 12</p>
        </small>
        <hr class="margin-16--32-64--32 light-mid-gray light-hr">
        <div class="flex">
            <div class="flex flex-direction-column align-center gap-8 flex-basis-10">
                <div class="circle-vote background-color-di-sierra"><i class="fa-regular fa-thumbs-up"></i></div>
                <p class="font-size-24">-2</p>
                <div class="circle-vote background-color-laser"><i class="fa-solid fa-thumbs-down"></i></div>
            </div>
            <div class="flex-basis-90">
                <p>
                    Est-ce qu'il y a vraiment un gain de performance d'isolation en partant sur de l'armaflex plutôt que de la laine de verre ?
                    J'ai des difficultées à positionner la laine de verre par endroit (voir photo) et je pense partir sur de l'armaflex pour mon prochain véhicule.
                </p>
                <div>
                    <div>
                        <figure>
                            <img src="assets/images/tmp/img-1.png" alt="Image utilisateur 1">
                        </figure>
                        <ul>
                            <li>isolation</li>
                            <li>armaflex</i>
                            <li>laine de verre</li>
                        </ul>
                    </div>
                    <div>
                        <div class="user-container">
                            <img class="profile-picture-small" src="assets/images/users/default/profile_images/1.jpg" alt="Photo profil">
                            <b style="margin-left: 8px;" >Jean-luc</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>

{% endblock %}
