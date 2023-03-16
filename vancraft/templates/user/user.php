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
    <br>
</main>
{% endblock %}