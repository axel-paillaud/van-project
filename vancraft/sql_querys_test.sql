SELECT post_id, title, content, views, votes, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss')
 AS frenchCreationDate, DATE_FORMAT(last_modification, '%d/%m/%Y à %Hh%imin%ss') AS frenchLastModification FROM posts ORDER BY votes DESC LIMIT 0, 15\G

 CREATE TABLE users (
    user_id int NOT NULL AUTO_INCREMENT,
    name varchar(24) NOT NULL,
    email varchar(255),
    account_creation_date datetime DEFAULT CURRENT_TIMESTAMP,
    password varchar(128) NOT NULL,
    last_connexion datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    numbers_of_answers int,
    numbers_of_questions int,
    PRIMARY KEY (user_id)
 );

 CREATE TABLE tags (
    tag_id int NOT NULL AUTO_INCREMENT,
    title varchar(64) NOT NULL,
    PRIMARY KEY (tag_id)
 );

 CREATE TABLE posts_tags (
    id INT NOT NULL AUTO_INCREMENT,
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id),
    PRIMARY KEY (id)
 );


 CREATE TABLE medals (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    bronze_medal int DEFAULT 0,
    silver_medal int DEFAULT 0,
    gold_medal int DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (id)
 )

 CREATE TABLE users_config (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    best_post int,
    about text,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (best_post) REFERENCES posts(post_id),
    PRIMARY KEY (id)
 );

CREATE TABLE users_answers (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    answer_id int NOT NULL UNIQUE,
    post_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (user_id),
    FOREIGN KEY (answer_id) REFERENCES answers (answer_id),
    PRIMARY KEY (id)
);

CREATE TABLE images_profiles (
    image_id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL UNIQUE,
    image_url_sm varchar(255),
    image_url_lg varchar(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (image_id)
);

INSERT INTO tags VALUES (
    NULL,
    "contreplaqué",
    "Panneau de bois. Obtenu par collage de couches adjacentes à fils croisés, appelées plis. L'épaisseur varie entre 1 mm et 50 mm.
    Très solide."
);

SELECT title FROM tags WHERE tag_id IN
(SELECT tag_id FROM posts_tags WHERE post_id = 1);

SELECT user_id, name FROM users WHERE user_id IN (
   SELECT user_id FROM posts_users WHERE post_id = 1
);
