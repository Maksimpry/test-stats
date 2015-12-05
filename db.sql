CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	login VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	PRIMARY KEY id (id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE TABLE tests (
	id INT UNSIGNED AUTO_INCREMENT,
	test_name VARCHAR(255) NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	PRIMARY KEY id (id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE TABLE test_results (
	id INT UNSIGNED AUTO_INCREMENT,
	student TINYINT NOT NULL,
	exercise VARCHAR(255),
	result char(1) NOT NULL,
	test_id INT UNSIGNED NOT NULL,
	PRIMARY KEY id (id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;