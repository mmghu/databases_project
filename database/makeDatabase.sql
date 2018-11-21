DROP DATABASE lexHealth; 
CREATE DATABASE lexHealth;

USE lexHealth; 

CREATE TABLE customer
	(
	username VARCHAR(20) PRIMARY KEY NOT NULL,
	name VARCHAR(20),
	password VARCHAR(20) NOT NULL
	);

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
	name VARCHAR(20) NOT NULL PRIMARY KEY,
	price FLOAT, 
	FOREIGN KEY (rid) REFERENCES restaurant(rid)
	);

CREATE TABLE ingredient
(
	name VARCHAR(20) NOT NULL,
	foodGroup VARCHAR(20) NOT NULL, 
    PRIMARY KEY (name, foodGroup)
);

CREATE TABLE contains
(
	itemName VARCHAR(20) NOT NULL, 
	rid INT NOT NULL, 
	ingredientName VARCHAR(20) NOT NULL, 
	PRIMARY KEY (itemName, ingredientName, rid), 
	FOREIGN KEY (itemName) REFERENCES menuitem(name),
	FOREIGN KEY (rid) REFERENCES restaurant(rid),  
	FOREIGN KEY (ingredientName) REFERENCES ingredient(name) 
);

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

CREATE TABLE favorites
(
    username VARCHAR(20) NOT NULL,
	itemName VARCHAR(20) NOT NULL, 
	rid INT NOT NULL, 
	PRIMARY KEY (username, rid, itemName), 
	FOREIGN KEY (itemName) REFERENCES menuitem(name), 
	FOREIGN KEY (rid) REFERENCES restaurant(rid), 
    FOREIGN KEY (username) REFERENCES customer(username)
);


CREATE TABLE restrictions 
(
	username VARCHAR(20) NOT NULL, 
	ingredientName VARCHAR(20) NOT NULL, 
    foodGroup VARCHAR(20) NOT NULL, 
	PRIMARY KEY (username, ingredientName, foodGroup), 
	FOREIGN KEY (username) REFERENCES customer(username), 
	FOREIGN KEY (ingredientName) REFERENCES ingredient(name)
);
