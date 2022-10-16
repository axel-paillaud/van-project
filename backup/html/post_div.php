        <div>
            <div class="post-container">
                <div class="row-container">
                    <div class="post-title">
                        <?= $posts[0]->title ?>
                    </div>
                    <div class="views-votes-container">
                        <div class="post-stat">
                            <?= $posts[0]->votes ?> votes
                        </div>
                        <div class="post-stat">
                            <?= $posts[0]->answers ?> réponses
                        </div>
                        <div class="post-stat">
                            <?= $posts[0]->views ?> vues
                        </div>
                    </div>
                </div>
                <div class="row-container">
                    <div class="tag-container">
                        <div class="btn-orange">Armaflex</div>
                        <div class="btn-orange">Styrodur</div>
                        <div class="btn-orange">Laine de verre</div>
                        <div class="btn-orange">Isolation</div>
                    </div>
                    <div class="user-container">
                        <img class="profile-picture-small" src="<?= $profiles[1] ?>" <?= $profiles[1] ?> alt="Photo profil">
                        <b style="margin-left: 8px;" ><?= $profiles[0] ?></b>
                    </div>
                </div>
            </div>
            <div class="post-container">
                <div class="row-container">
                    <div class="post-title">
                        <?= $posts[1]->title ?>
                    </div>
                    <div class="views-votes-container">
                        <div class="post-stat">
                            <?= $posts[1]->votes ?> votes
                        </div>
                        <div class="post-stat">
                            <?= $posts[1]->answers ?> réponses
                        </div>
                        <div class="post-stat">
                            <?= $posts[1]->views ?> vues
                        </div>
                    </div>
                </div>
                <div class="row-container">
                    <div class="tag-container">
                        <div class="btn-orange">Armaflex</div>
                        <div class="btn-orange">Styrodur</div>
                        <div class="btn-orange">Laine de verre</div>
                        <div class="btn-orange">Laine de verre un tag super long</div>
                        <div class="btn-orange">Isolation</div>
                    </div>
                    <div class="user-container">
                        <img class="profile-picture-small" src="<?= $profiles_2[1] ?>" <?= $profiles_2[1] ?> alt="Photo de profil">
                        <b style="margin-left: 8px;" ><?= $profiles_2[0] ?></b>
                    </div>
                </div>
            </div>
        </div>

        