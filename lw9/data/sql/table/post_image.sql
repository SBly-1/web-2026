USE blog;
CREATE TABLE post_image(
    id INT UNSIGNED AUTO_INCREMENT,
    post_id INT UNSIGNED NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    image_alt VARCHAR(255) NOT NULL, 
    image_number INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (post_id, image_number),
    FOREIGN KEY (post_id) REFERENCES post(id)
);