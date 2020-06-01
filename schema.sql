CREATE DATABASE `blog_spot`;

CREATE TABLE `blog_spot`.`blog_content` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `content` MEDIUMTEXT NULL,
  `img_url` VARCHAR(45) NULL,
  `cat_id` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`));

CREATE TABLE `blog_spot`.`new_table` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `parent_id` INT NOT NULL DEFAULT 0,
  `category_name` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`));


ALTER TABLE `indiazooka`.`pagecontent` 
ADD COLUMN `one_line_description` VARCHAR(150) NULL DEFAULT '' AFTER `content`;
