USE blog;
CREATE TABLE user(
    id INT UNSIGNED AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    avatar_url VARCHAR(255),
    bio VARCHAR(255), 
    PRIMARY KEY (id)
);