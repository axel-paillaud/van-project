{% extends "layout.php" %}

{% block title %}Vancraft - Question numéro xxx {% endblock %}

{% block content %}

<main class="main">
    <article class="article-container margin-64-0-32-0">
        <div class="flex-space-between">
            <h2 class="my-16 ml-0 mr-24 font-normal font-size-27">{{ post.title }}</h2>
            <a href="#" class="btn-orange">Poser une question</a>
        </div>
        <small class="flex align-center gap-16">
            <p>Date : <time>{{ post.french_creation_date }}</time></p><p>Nombre de vue : {{ post.views }}</p>
            {# only show modification date if not equal to post date to avoid redundance #}
            {% if post.french_creation_date != post.french_last_modification %}
                <p>Dernière modification : <time>{{ post.french_last_modification }}</time></p>
            {% endif %}
        </small>
        <hr class="-mx-32 mt-16 mb-64 light-mid-gray light-hr">
        <div class="flex">
            <div class="flex flex-direction-column align-center gap-8 flex-basis-10">
                <div class="circle-vote background-color-di-sierra"><i class="fa-regular fa-thumbs-up"></i></div>
                <p class="font-size-24">{{ post.votes }}</p>
                <div class="circle-vote background-color-laser"><i class="fa-solid fa-thumbs-down"></i></div>
            </div>
            <div class="flex-basis-90 padding-0-32">
                <p class="margin-0-0-32-0">
                    {# find a solution here to show htmlspecialchars correctly #}
                    {{ post.content }}
                </p>
                <div class="flex space-between flex-wrap">
                    <div>
                        {# div for images here #}
                        {% if postImages %}
                        <div class="flex gap-32 flex-wrap">
                            {% for image in postImages %}
                            <figure class="img-post">
                                <img class="full-size cover" src="{{ image.url }}" alt="Image utilisateur 1">
                            </figure>
                            {% endfor %}
                        </div>
                        {% endif %}
                        <ul class="flex padding-0">
                            {% for tag in post.tags %}
                            <li class="tag">{{ tag.title }}</li>
                            {% endfor %}
                        </ul>
                    </div>
                    <div class="flex align-items-end width-100 justify-content-end">
                        <div class="user-container">
                            <img class="profile-picture-small" src="assets/images/users/{{ post.user_image_profile_url }}" alt="Photo profil">
                            <b style="margin-left: 8px;" >{{ post.user_name }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <p class="margin-16-0">Nombre de réponse : 1</p>
    <article class="article-container mb-32">
        <div class="flex">
            <div class="flex flex-direction-column align-center gap-8 flex-basis-10">
                <div class="circle-vote background-color-di-sierra"><i class="fa-regular fa-thumbs-up"></i></div>
                <p class="font-size-24">-2</p>
                <div class="circle-vote background-color-laser"><i class="fa-solid fa-thumbs-down"></i></div>
            </div>
            <div class="padding-0-32 flex-basis-90">
                <p class="margin-0-0-32-0">
                    Oui, l'armaflex a un pouvoir isolant bien supérieur à la laine de verre, de plus il est fourni "adhésivé",
                    il suffit juste de le coller sur une surface propre. Son inconvénient est le prix, surtout comparé à la
                    laine de verre, qui elle, n'est pas chère du tout.
                </p>
                <div class="flex space-between flex-wrap">
                    <div class="flex gap-32 flex-wrap margin-0-0-32-0">
                        <figure class="img-post">
                            <img class="full-size cover" src="assets/images/tmp/img-3.jpg" alt="Image utilisateur 1">
                        </figure>
                        <figure class="img-post">
                            <img class="full-size cover" src="assets/images/tmp/img-2.JPG" alt="Image utilisateur 1">
                        </figure>
                    </div>
                    <div class="flex align-items-end justify-content-end width-100">
                        <div class="user-container">
                            <img class="profile-picture-small" src="assets/images/users/default/profile_images/1.jpg" alt="Photo profil">
                            <b style="margin-left: 8px;" >Jean-luc</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
        <form action="/post" method="post" enctype="multipart/form-data" >
            <div class="article-container">
                <label class="font-size-20" for="answer">Votre réponse</label>
                <hr class="light-hr light-mid-gray -mx-32 my-16">
                <textarea id="answer" class="m-w-full w-full min-h-200" required autocomplete="off" name="answer"></textarea>
                <div id="add-img" class="add-img  mt-32 mb-16">
                    <label for="image">
                        <p class="btn-brown-light">+ Ajouter des photos</p>
                        <input class="display-none" id="image" type="file" name="image[]" accept="image/png, image/jpeg, image/gif" multiple max="4">
                        <img src="assets/images/icons/pictures-brown.svg" alt="Ajouter une photo">
                    </label>
                    <small class="margin-left-8">Jusqu'à 4 photos, jpg, png, gif : 2mo max</small>
                </div>
            </div>
            <input id="submit-answer" class="btn-orange mt-16 mb-32" type="submit" value="Poster la réponse">
        </form>
</main>
<script src="assets/js/thumbnailImgFunction.js"></script>
<script src="assets/js/thumbnailImg.js"></script>
{% endblock %}
