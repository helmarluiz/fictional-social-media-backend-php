-- SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

DROP DATABASE IF EXISTS fsm;
CREATE DATABASE fsm;
USE fsm;

CREATE TABLE posts
(
    id VARCHAR(255) NOT NULL,
    user_name VARCHAR(255),
    user_id VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    message_length INTEGER NOT NULL,
    type VARCHAR(255) NOT NULL,
    created_time DATETIME NOT NULL,
    PRIMARY KEY (id),
    INDEX (user_id)
);

CREATE TABLE user_analysis
(
    user_id VARCHAR(255) NOT NULL,
    user_name VARCHAR(255),
    post_count INTEGER NOT NULL,
    post_avg_characters FLOAT NOT NULL,
    post_months JSON NOT NULL,
    post_longest_id VARCHAR(255),
    PRIMARY KEY (user_id),
    INDEX (post_longest_id),
    FOREIGN KEY (post_longest_id) REFERENCES posts(id) ON DELETE CASCADE
);