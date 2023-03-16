{% extends "layout.php" %}

{% block title %}Vancraft - Utilisateur xxx{% endblock %}

{% block content %}
<main class="main">
    <!--profile picture with name and last connexion date-->
    <div class="m-32 flex justify-between align-start">
        <figure class="flex align-center">
            <img class="profile-picture" src="assets/images/users/default/profile_images/nina.jpg" alt="Photo de profil">
            <figcaption class="ml-32 flex flex-col">
                <h1 class="font-bold font-24 mb-16 font-lato">Julie Derouineau</h1>
                <div>
                    <span>Membre depuis : 1 janvier 2001</span>
                    <span class="ml-32">Dernière connexion : aujourd'hui</span>
                </div>
            </figcaption>
        </figure>
        <a class="btn-orange px-16 py-10" href="#"><i class="fa-solid fa-pen text-black mr-8"></i>Editer le profil</a>
    </div>
    <!--stats and about section-->
    <div class="m-32 flex gap-32">
        <!--stats section-->
        <div class="basis-20">
            <div class="font-24 mb-8">Statistiques</div>
            <div class="about-container flex justify-around">
                <div class="flex flex-col justify-around">
                    <span>3 réponses</span>
                    <span>3 questions</span>
                </div>
                <!--if we need more user stats, we can put 2 mores here-->
                <div class="display-none">
                    <span class="hidden">32 médailles</span>
                    <span class="hidden">empty</span>
                </div>
            </div>
        </div>
        <!--about section-->
        <div class="basis-80">
            <div class="font-24 mb-8">À propos</div>
            <div  class="about-container flex align-center">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est sunt obcaecati qui, nihil aspernatur a in 
                illo doloribus! Provident delectus ut autem recusandae? Error obcaecati amet eveniet iusto, nihil tempora?
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est sunt obcaecati qui, nihil aspernatur a in 
                illo doloribus! Provident delectus ut autem recusandae? Error obcaecati amet eveniet iusto, nihil tempora?
            </div>
        </div>
    </div>
    <!--best article section-->
    <div class="m-32">
        <div class="font-24 mb-8">Articles populaires</div>
        <article class="post-container flex">
            <div class="views-votes-container">
                <p class="post-stat">
                    32 votes
                </p>
                <p class="post-stat">
                    26 réponses
                </p>
                <p class="post-stat">
                    158 vues
                </p>
            </div>
        <div class="flex flex-col w-full">
            <a href="/post?id={{ post.id }}" class="post-title mb-8">
                Voila mon meilleur article !
            </a>
            <div class="row-container justify-between">
                <div class="tag-container">
                    <div class="tag">armaflex</div>
                    <div class="tag">styrodur</div>
                </div>
                <a class="user-container" href="/user">
                    <img class="profile-picture-small" src="assets/images/users/default/profile_images/nina.jpg" alt="Photo profil">
                    <b style="margin-left: 8px;" >Julia Derouineau</b>
                </a>
            </div>
        </div>
        </article>
    </div>
    <br>
</main>
{% endblock %}