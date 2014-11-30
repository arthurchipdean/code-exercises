CREATE TABLE `posts` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`date_posted` DATETIME NOT NULL,
`date_modified` DATETIME NOT NULL,
`content` MEDIUMTEXT NOT NULL,
INDEX (`user_id`),
INDEX (`date_posted`),
INDEX (`date_modified`)
)
INSERT INTO `posts` (`id`, `user_id`, `date_posted`, `date_modified`, `content`) VALUES (NULL, '1', '2014-10-27 17:11:25', '2014-11-11 17:11:28', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor massa eget magna sodales, ac finibus metus commodo. ');
INSERT INTO `posts` (`id`, `user_id`, `date_posted`, `date_modified`, `content`) VALUES (NULL, '2', '2014-11-25 17:11:46', '2014-11-25 17:11:49', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor massa eget magna sodales, ac finibus metus commodo. ');
INSERT INTO `posts` (`id`, `user_id`, `date_posted`, `date_modified`, `content`) VALUES (NULL, '1', '2014-11-25 17:10:55', '2014-11-25 17:10:57', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor massa eget magna sodales, ac finibus metus commodo. ');
INSERT INTO `posts` (`id`, `user_id`, `date_posted`, `date_modified`, `content`) VALUES (NULL, '1', '2014-11-04 17:11:05', '2014-11-25 17:11:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor massa eget magna sodales, ac finibus metus commodo. ');

SELECT `id` FROM (SELECT `id`,`date_modified`,`user_id` FROM `posts` ORDER BY `date_modified` DESC) AS c GROUP BY `user_id`;