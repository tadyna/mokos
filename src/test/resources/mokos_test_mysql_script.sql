--
-- Script for create database for integration tests in Mokos project.
-- version: 0.1
-- author: tomascejka
-- 
DROP DATABASE IF EXISTS mokos_test;
CREATE DATABASE IF NOT EXISTS mokos_test;
use mokos_test;

---
--- Person table
---
CREATE TABLE IF NOT EXISTS person
(
ID_PERSON int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'unique id of person',
FIRST_NAME varchar(255) NOT NULL COMMENT 'first name of person',
LAST_NAME varchar(255) COMMENT 'last name name of person',
FULLNAME varchar(255) COMMENT 'fullname of person',
ADDRESS varchar(255) COMMENT 'address where person live',
CITY varchar(255) COMMENT 'city where person live',
PRIMARY KEY (ID_PERSON)
)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT = 'basic data about person';

---
--- Person basic data table
---
CREATE TABLE IF NOT EXISTS person_basic_data
(
ID_PERSON_BASIC_DATA int NOT NULL AUTO_INCREMENT COMMENT 'unique id of person basic data',
BIRTH_NAME varchar(255) NOT NULL COMMENT 'birth name of person',
BIRTH_SURNAME varchar(255) COMMENT 'birth surname of person',
DATE_FROM date NOT NULL COMMENT 'start date when given person basic data is valid from',
DATE_TO date NOT NULL COMMENT 'start date when given person basic data is valid to',
PERSON_ID int(10) UNSIGNED COMMENT 'pointer to person',
PRIMARY KEY (ID_PERSON_BASIC_DATA),
FOREIGN KEY (PERSON_ID) REFERENCES PERSON(ID_PERSON) ON DELETE CASCADE
)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT = 'basic data by person';

---
--- Book table
---
CREATE TABLE IF NOT EXISTS book (
  `ID_BOOK` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'unique id of book',
  `NAME_BOOK` VARCHAR(45) NOT NULL COMMENT 'name of book',
  PRIMARY KEY (`ID_BOOK`)
)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT = 'book which is written by person';

---
--- Relation table between person and book
---
CREATE TABLE IF NOT EXISTS author_to_book (
  `AUTHOR_ID` int(10) UNSIGNED NOT NULL COMMENT 'Pointer to person',
  `BOOK_ID` int(10) UNSIGNED NOT NULL COMMENT 'Pointer to book'
)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT = 'Relation between person as author and book';

ALTER TABLE `author_to_book`
ADD CONSTRAINT `FK_author_to_book_1` FOREIGN KEY (`AUTHOR_ID`) REFERENCES PERSON(ID_PERSON) ON DELETE CASCADE,
ADD CONSTRAINT `FK_author_to_book_2` FOREIGN KEY (`BOOK_ID`) REFERENCES BOOK(ID_BOOK) ON DELETE CASCADE;

INSERT INTO `person` (`ID_PERSON`, `FULLNAME`, `FIRST_NAME`, `LAST_NAME`) VALUES
(1, 'Tomas Cejka', 'Tomas', 'Cejka'),
(2, 'Karolina Malkova', 'Karolina', 'Malkova');
INSERT INTO `book` (`ID_BOOK`, `NAME_BOOK`) VALUES
(1, 'About sci-fi'),
(2, 'About biology'),
(3, 'About live'),
(4, 'About babies');
INSERT INTO `author_to_book` (`BOOK_ID`, `AUTHOR_ID`) VALUES
(1, 1), -- written by tomas
(2, 2), -- written by kaja
(3, 1), -- written by tomas
(3, 2), -- written by kaja also
(4, 2); -- written by kaja
-- 
-- Grant will create the user if the account does not already exist
--
GRANT ALL ON mokos_test TO 'mokos_test'@'localhost';
FLUSH PRIVILEGES;