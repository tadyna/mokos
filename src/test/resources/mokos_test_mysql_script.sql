--
-- Script for create database for integration tests in Mokos project.
-- version: 0.1
-- author: tomascejka
-- 
CREATE DATABASE IF NOT EXISTS mokos_test;
use mokos_test;
CREATE TABLE IF NOT EXISTS person
(
ID_PERSON int(10) NOT NULL AUTO_INCREMENT,
FIRST_NAME varchar(255) NOT NULL,
LAST_NAME varchar(255),
ADDRESS varchar(255),
CITY varchar(255),
PRIMARY KEY (ID_PERSON)
);
CREATE TABLE IF NOT EXISTS person_basic_data
(
ID_PERSON_BASIC_DATA int NOT NULL AUTO_INCREMENT,
BIRTH_NAME varchar(255) NOT NULL,
BIRTH_SURNAME varchar(255),
DATE_FROM date NOT NULL,
DATE_TO date NOT NULL,
PERSON_ID int(10),
PRIMARY KEY (ID_PERSON_BASIC_DATA),
FOREIGN KEY (PERSON_ID) REFERENCES PERSON(ID_PERSON) ON DELETE CASCADE
);
-- 
-- Grant will create the user if the account does not already exist
--
GRANT ALL ON mrdka_database TO 'mokos_test'@'localhost';
FLUSH PRIVILEGES;
