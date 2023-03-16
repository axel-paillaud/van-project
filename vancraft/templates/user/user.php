{% extends "layout.php" %}

{% block title %}Vancraft - Utilisateur xxx{% endblock %}

{% block content %}
<main class="main">
    <!--profile picture with name and last connexion date-->
    <div class="m-32 flex justify-between align-start">
        <figure class="flex align-center">
            <img class="profile-picture" src="assets/images/users/default/profile_images/nina.jpg" alt="Photo de profil">
            <figcaption class="ml-32 flex flex-col">
                <span class="font-bold font-24  mb-16">Jules Derouineau</span>
                <div>
                    <span>Membre depuis : 1 janvier 2001</span>
                    <span class="ml-32">Dernière connexion : aujourd'hui</span>
                </div>
            </figcaption>
        </figure>
        <a class="btn-orange px-16 py-10" href="#"><i class="fa-solid fa-pen text-black mr-8"></i>Editer le profil</a>
    </div>
</main>
{% endblock %}