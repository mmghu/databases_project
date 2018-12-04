-- Create and select database
DROP DATABASE lexHealth; 
CREATE DATABASE lexHealth;

USE lexHealth; 

-- ENTITIES 
-- Create 'user' table and upload data
CREATE TABLE customer
	(
	username VARCHAR(20) PRIMARY KEY NOT NULL,
	name VARCHAR(20),
	password VARCHAR(20) NOT NULL
	);
LOAD DATA LOCAL INFILE './customers.txt'
INTO TABLE customer
FIELDS TERMINATED BY ',';

CREATE TABLE restaurant 
	(
	rid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(20),
	latitude VARCHAR(40),
	longitude VARCHAR(40),
	priceRating FLOAT,
	openHour INT,
	closeHour INT, 
	rating FLOAT, 
	specialty VARCHAR(20) 
	);

LOAD DATA LOCAL INFILE './restaurants.txt'
INTO TABLE restaurant
FIELDS TERMINATED BY ',';

CREATE TABLE menuitem
	(
	rid INT NOT NULL, 
	name VARCHAR(20) NOT NULL,
	price FLOAT, 
    PRIMARY KEY (rid, name),
	FOREIGN KEY (rid) REFERENCES restaurant(rid)
	);
LOAD DATA LOCAL INFILE './menuitems.txt'
INTO TABLE menuitem
FIELDS TERMINATED BY ',';

CREATE TABLE ingredient
(
    name VARCHAR(20) NOT NULL,
    foodGroup VARCHAR(20) NOT NULL, 
    PRIMARY KEY (name, foodGroup)
);
LOAD DATA LOCAL INFILE './ingredients.txt'
INTO TABLE ingredient
FIELDS TERMINATED BY ',';

CREATE TABLE contains
(
    name VARCHAR(20) NOT NULL, 
    rid INT NOT NULL, 
    ingredientName VARCHAR(20) NOT NULL, 
    PRIMARY KEY (name, ingredientName, rid), 
    FOREIGN KEY (rid) REFERENCES restaurant(rid),  
    FOREIGN KEY (ingredientName) REFERENCES ingredient(name) 
);
LOAD DATA LOCAL INFILE './contains.txt'
INTO TABLE contains
FIELDS TERMINATED BY ',';

CREATE TABLE reviews
(
	username VARCHAR(20) NOT NULL, 
	rid INT NOT NULL, 
	timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (username, rid, timestamp), 
	FOREIGN KEY (username) REFERENCES customer(username), 
	FOREIGN KEY (rid) REFERENCES restaurant(rid), 
	rating INT NOT NULL, 
	review VARCHAR(250)
);
LOAD DATA LOCAL INFILE './reviews.txt'
INTO TABLE reviews
FIELDS TERMINATED BY ',';

CREATE TABLE favorites
(
    username VARCHAR(20) NOT NULL,
    itemName VARCHAR(20) NOT NULL, 
    rid INT NOT NULL, 
    PRIMARY KEY (username, rid, itemName), 
    FOREIGN KEY (rid) REFERENCES restaurant(rid), 
    FOREIGN KEY (username) REFERENCES customer(username)
);
LOAD DATA LOCAL INFILE './favorites.txt'
INTO TABLE favorites
FIELDS TERMINATED BY ',';


CREATE TABLE restrictions 
(
    username VARCHAR(20) NOT NULL, 
    ingredientName VARCHAR(20) NOT NULL, 
    foodGroup VARCHAR(20) NOT NULL, 
    PRIMARY KEY (username, ingredientName, foodGroup), 
    FOREIGN KEY (username) REFERENCES customer(username), 
    FOREIGN KEY (ingredientName) REFERENCES ingredient(name)
);
LOAD DATA LOCAL INFILE './restrictions.txt'
INTO TABLE restrictions
FIELDS TERMINATED BY ',';
