<?php ob_start(); ?>

<div class="main">
    <?php if (isset($message) && !empty($message)) : ?>
        <?php if ($bad) : ?>
            <div class="message-container error">
                <?= $message ?>
            </div>
        <?php else : ?>
            <div class="message-container">
                <?= $message ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="title-container">
        <div class="title-text-container">
            <h1 class="title-title">VanCraft</h1>
            <h4 class="title-subtitle">Une aide communautaire à la réalisation de son véhicule aménagé.</h4>
        </div>
       <div class="title-logo-container">
            <img src="images/logo/logo.svg" alt="VanCraft Logo"/>
       </div>
    </div>

    <div class="content-post-container">
        <div class="title-btn-post-container">
            <h3 class="header-title-post">Questions populaires</h3>
            <a href="/post-article"><button class="btn-orange"><b>Poser une question</b></button></a>
        </div>
        <hr class="horizontal-rule">

        <!-- parent's div for first child and last child -->
        <div>
        <?php foreach ($posts as $post) : ?>
            <div class="post-container">
                <div class="row-container">
                    <div class="post-title">
                        <?= $post->title ?>
                    </div>
                    <div class="views-votes-container">
                        <div class="post-stat">
                            <?= $post->votes ?> votes
                        </div>
                        <div class="post-stat">
                            <?= $post->answers ?> réponses
                        </div>
                        <div class="post-stat">
                            <?= $post->views ?> vues
                        </div>
                    </div>
                </div>
                <div class="row-container">
                    <div class="tag-container">
                        <?php foreach ($post->tags as $tag) : ?>
                            <div class="btn-orange"><?= $tag->title ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="user-container">
                        <img class="profile-picture-small" src="<?= $post->user_image_profile_url ?>" alt="Photo profil">
                        <b style="margin-left: 8px;" ><?= $post->user_name ?></b>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>   
    </div>
</div>
<?php $content = ob_get_clean(); ?>
