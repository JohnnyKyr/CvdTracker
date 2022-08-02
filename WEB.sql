	-- INIT DATABASE
	DROP DATABASE IF EXISTS covidtrack;
	CREATE DATABASE covidtrack;
	USE covidtrack;

	DROP TABLE IF EXISTS user;
		CREATE TABLE user(
							
							username varchar(255) NOT NULL,
							password varchar(255) NOT NULL, 
							email varchar(255) NOT NULL,
							cvdtmstmp varchar(255) default NULL,
							primary key(username)
		)Engine=InnoDB;

	DROP TABLE IF EXISTS Poi;

	CREATE TABLE Poi(
						id varchar(255) NOT NULL,
						name varchar(255) default " " NOT NULL,
						types JSON,
						address varchar(255) default "" NOT NULL,
						coords JSON,
						rating float(3,1),
						rating_n smallint(4),
						
						primary key(id)
		)Engine=InnoDB;



	DROP TABLE IF EXISTS popularity;
	CREATE TABLE popularity(
						popID varchar(255) NOT NULL,
						day varchar(255) default "" NOT NULL,
						data  JSON,
						primary key(popID,day),
						constraint POIST
						foreign key (popID) references Poi(id)
						ON DELETE CASCADE ON UPDATE CASCADE
		)Engine=InnoDB;





	DROP TABLE IF EXISTS place;
	CREATE TABLE place(
						poiID varchar(255) default " " NOT NULL,
						userID varchar(255) default " " NOT NULL,
						tmstmp DATETIME default CURRENT_TIMESTAMP,
						numofp INT(10) default NULL,
						primary key(poiID,userID),
						constraint PlacePOI
						foreign key(poiID) references Poi(id)
						ON DELETE CASCADE ON UPDATE CASCADE,
						constraint PlaceUser
						foreign key(userID) references user(username)
						ON DELETE CASCADE ON UPDATE CASCADE
				)Engine=InnoDB;


	DROP TABLE IF EXISTS ConfirmedCase;

	CREATE TABLE ConfirmedCase(
						poiID varchar(255) default " " NOT NULL,
						primary key(poiID),
						constraint ConfC
						foreign key(poiID) references place(poiID)
						ON DELETE CASCADE ON UPDATE CASCADE
	)Engine=InnoDB;