-- database
CREATE TABLE
  IF NOT EXISTS `bookreview`;
USE bookreview;
-- review table
CREATE TABLE
  IF NOT EXISTS `user_reviews` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `book_name` VARCHAR(100) NOT NULL,
    `genre` INT NOT NULL,
    `uid` INT NOT NULL,
    `rating` INT NOT NULL,
    `author` VARCHAR(50) NOT NULL,
    `comment` TEXT NOT NULL,
    `publish_date` DATE NOT NULL,
    `active` TINYINT (1) DEFAULT NULL,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );



-- booklisting table
CREATE TABLE
  IF NOT EXISTS `blog_list` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `content` VARCHAR(100) NOT NULL,
    `category` INT NOT NULL,
    `sub_category` INT NOT NULL,
    `uid` INT NOT NULL,
    `rating` INT DEFAULT NULL,
    `subject` TEXT NOT NULL,
    `publish_date` DATE DEFAULT NULL,
    `active` TINYINT (1) DEFAULT NULL,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );
-- user table
CREATE TABLE
  IF NOT EXISTS `user_listing` (
    `id` int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `email` varchar(100) UNIQUE NOT NULL,
    `username` varchar(100) UNIQUE NOT NULL,
    `password` varchar(100) NOT NULL,
    `created_at` datetime DEFAULT current_timestamp(),
    `login_token` varchar(100) DEFAULT NULL,
    `active` tinyint (1) DEFAULT 0,
    `activation_token` varchar(100) DEFAULT NULL
  );

--  Create forget_passw table 
CREATE TABLE
  IF NOT EXISTS `forget_passw` (
    `id` int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `uid` int (11) NOT NULL,
    `uri` varchar(100) NOT NULL,
    `created_at` datetime DEFAULT current_timestamp(),
    `superseded` tinyint (1) DEFAULT 0
  );

-- activity log user table
CREATE TABLE
  IF NOT EXISTS `activity_log_user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `uid` INT NOT NULL,
    `activity` VARCHAR(100) NOT NULL,
    `ip_addr` VARCHAR(100) NOT NULL,
    `superseded` TINYINT (1) DEFAULT NULL,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );

-- activity log other table
CREATE TABLE
  IF NOT EXISTS `activity_log_user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `uid` INT NOT NULL,
    `activity` VARCHAR(100) NOT NULL,
    `ip_addr` VARCHAR(100) NOT NULL,
    `superseded` TINYINT (1) DEFAULT NULL,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );

-- genre list table
CREATE TABLE
  IF NOT EXISTS `genre` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `slug` VARCHAR(50) NOT NULL
  );

-- contact us table
CREATE TABLE
  IF NOT EXISTS `contact_us` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `uid` INT NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(12) NOT NULL,
    `query` TEXT NOT NULL,
    `ip_addr` VARCHAR(100) NOT NULL,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );

  -- forget password table
CREATE TABLE
  IF NOT EXISTS `user_passw_change` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `uid` INT NOT NULL,
    `activation_token` VARCHAR(50) NOT NULL,
    `ip_addr` VARCHAR(100) NOT NULL,
    `active` TINYINT DEFAULT 1,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );

  -- contact us table
CREATE TABLE
  IF NOT EXISTS `user_profile` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `uid` INT NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(12) NOT NULL,
    `created_at` DATETIME DEFAULT UTC_TIMESTAMP ()
  );

  -- booklisting table
CREATE TABLE
  IF NOT EXISTS `category` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `category` INT NOT NULL
    );

    
CREATE TABLE
  IF NOT EXISTS `sub_category` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `sub_category` INT NOT NULL,
    `category` INT NOT NULL
    );