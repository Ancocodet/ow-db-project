CREATE TABLE IF NOT EXISTS `players` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `nickname` TEXT,
  `level` INT,
  `prestige` INT
);

CREATE TABLE IF NOT EXISTS `heroes` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` TEXT,
  `description` TEXT,
  `class` TEXT
);

CREATE TABLE IF NOT EXISTS `maps` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` TEXT,
  `location` TEXT
);

CREATE TABLE IF NOT EXISTS `games` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `started` datetime,
  `finished` datetime,
  `winner` INT,
  `gamemode_id` INT,
  `map_id` INT
);

CREATE TABLE IF NOT EXISTS `game_player` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `team` INT,
  `player_id` INT,
  `game_id` INT,
  `skin_id` INT
);

CREATE TABLE IF NOT EXISTS `gamemodes` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` TEXT,
  `team_size` INT
);

CREATE TABLE IF NOT EXISTS `skins` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` TEXT,
  `rarity` INT,
  `hero_id` INT
);

ALTER TABLE `game_player` ADD FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);

ALTER TABLE `game_player` ADD FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

ALTER TABLE `game_player` ADD FOREIGN KEY (`skin_id`) REFERENCES `skins` (`id`);

ALTER TABLE `games` ADD FOREIGN KEY (`gamemode_id`) REFERENCES `gamemodes` (`id`);

ALTER TABLE `games` ADD FOREIGN KEY (`map_id`) REFERENCES `maps` (`id`);

ALTER TABLE `skins` ADD FOREIGN KEY (`hero_id`) REFERENCES `heroes` (`id`);
