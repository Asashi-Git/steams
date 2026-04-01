CREATE DATABASE IF NOT EXISTS steams_db; 
USE steams_db;

CREATE TABLE `roles` ( 
	`id_role` integer PRIMARY KEY AUTO_INCREMENT, 
	`title` varchar(255) NOT NULL, 
	`description` text 
);

CREATE TABLE `games` ( 
	`id_game` integer PRIMARY KEY AUTO_INCREMENT,
	`rawg_id` integer UNIQUE, 
	`title` varchar(255) NOT NULL, 
	`description` text, 
	`release_date` date, 
	`cover_image` varchar(255) 
);

CREATE TABLE `platforms` ( 
	`id_platform` integer PRIMARY KEY AUTO_INCREMENT, 
	`name` varchar(255) NOT NULL, 
	`manufacturer` varchar(255) 
);

CREATE TABLE `categories` ( 
	`id_category` integer PRIMARY KEY AUTO_INCREMENT, 
	`name` varchar(255) NOT NULL, 
	`description` text 
);

CREATE TABLE `users` ( 
	`id_user` integer PRIMARY KEY AUTO_INCREMENT, 
	`username` varchar(255) NOT NULL UNIQUE, 
	`email` varchar(255) NOT NULL UNIQUE, 
	`password` varchar(255) NOT NULL, 
	`id_role` integer NOT NULL 
);

CREATE TABLE `reviews` ( 
	`id_review` integer PRIMARY KEY AUTO_INCREMENT, 
	`title` varchar(255) NOT NULL, 
	`content` text NOT NULL, 
	`notation` integer NOT NULL, 
	`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`id_user` integer NOT NULL, `id_game` integer NOT NULL 
);

CREATE TABLE `available_on` ( 
	`id_game` integer NOT NULL, 
	`id_platform` integer NOT NULL, 
	`release_date_on_platform` date, 
	PRIMARY KEY (`id_game`, `id_platform`) 
);

CREATE TABLE `belongs` ( 
	`id_game` integer NOT NULL, 
	`id_category` integer NOT NULL, 
	PRIMARY KEY (`id_game`, `id_category`) 
);

ALTER TABLE `users` ADD FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
ALTER TABLE `reviews` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
ALTER TABLE `reviews` ADD FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE;
ALTER TABLE `available_on` ADD FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE;
ALTER TABLE `available_on` ADD FOREIGN KEY (`id_platform`) REFERENCES `platforms` (`id_platform`) ON DELETE CASCADE;
ALTER TABLE `belongs` ADD FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE;
ALTER TABLE `belongs` ADD FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE;
