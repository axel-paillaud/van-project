CREATE TABLE answers_posts (
    id int  NOT NULL AUTO_INCREMENT,
    post_id int NOT NULL,
    answer_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (answer_id) REFERENCES answers(answer_id)
);