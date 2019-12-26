<?php
/*
https://remotemysql.com/databases.php
solidity@gmx.com
M.TYZu7fuLHz.F5

*/
//https://remotemysql.com/phpmyadmin/
//User: wuhlYcf1xv/WUAVVGNlxg

// Server: remotemysql.com:3306
// User: wuhlYcf1xv
// Password: WUAVVGNlxg
// Db Name: wuhlYcf1xv
// Connections: https://remotemysql.com/tutor4.html

/*
DROP TABLE IF EXISTS wuhlYcf1xv.users; CREATE TABLE wuhlYcf1xv.users
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(25) NOT NULL UNIQUE KEY,
  fullname varchar(25) NOT NULL,
  password BLOB NOT NULL,
  photo_url varchar(255) NULL,
  description varchar(255) NULL,
  post_count int(2) NOT NULL DEFAULT '0',
  logged_in BOOLEAN DEFAULT TRUE,
  datetime TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

INSERT INTO wuhlYcf1xv.users (username, fullname, password, description)
VALUES ('steel.irons','Steel Irons', AES_ENCRYPT('123456','secret'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

SELECT AES_DECRYPT(`pswd`, 'secret') AS `pswd` FROM `users` WHERE `email` = 'user6@example.com';

INSERT INTO wuhlYcf1xv.users (username, fullname, description)
VALUES ('svety.kat','Svety Kat', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');

DROP TABLE IF EXISTS wuhlYcf1xv.posts; CREATE TABLE wuhlYcf1xv.posts
(
  post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  image_url varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  likes int(6) NOT NULL DEFAULT '0',
  datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

INSERT INTO wuhlYcf1xv.posts (user_id, image_url, description)
VALUES (1, 
'https://instagram.fmia1-2.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/71214533_195708338260676_4586009137826630778_n.jpg',
'Waiting by the side of the road, for day to break so we could go down into Los Angeles with dirty hands and worn out knees'
);

INSERT INTO wuhlYcf1xv.posts (user_id, image_url, description)
VALUES (2,
'https://instagram.fmia1-2.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/p640x640/79686952_181563546321122_1182303998122524202_n.jpg?_nc_ht=instagram.fmia1-2.fna.fbcdn.net&_nc_cat=1&_nc_ohc=HHwBoY-4MIUAX9OSyGc&oh=4c3a2135311d940506c91e8020869ff1&oe=5E791BF0',
'Your eyes give you away. Something inside you is feeling like I do.'
);

UPDATE wuhlYcf1xv.users SET post_count = post_count + 1 WHERE id = 1;
UPDATE wuhlYcf1xv.users SET post_count = post_count + 1 WHERE id = 2;

DROP TABLE IF EXISTS wuhlYcf1xv.comments; CREATE TABLE wuhlYcf1xv.comments
(
  comment_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  post_id INT NOT NULL,
  comment_text varchar(255) NOT NULL,
  datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;
INSERT INTO wuhlYcf1xv.comments (post_id, comment_text) values (1, 'test comment');
INSERT INTO wuhlYcf1xv.comments (post_id, comment_text) values (2, 'test comment');

*/

// https://www.instagram.com/p/B4C9zymHkJj/
// https://www.instagram.com/p/B5drzYInRCi/

?>
