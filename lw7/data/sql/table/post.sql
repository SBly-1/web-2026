-- CREATE DATABASE blog;
USE blog;
CREATE TABLE post(
    id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    likes INT UNSIGNED NOT NULL DEFAULT 0,
    content TEXT,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);