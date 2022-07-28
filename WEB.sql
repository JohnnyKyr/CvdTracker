-- INIT DATABASE
DROP DATABASE IF EXISTS covidtrack;
CREATE DATABASE covidtrack;
USE covidtrack;


CREATE TABLE user(
					id varchar(255) NOT NULL,
					username varchar(255) NOT NULL,
					password varchar(255) NOT NULL, 
					email varchar(255) NOT NULL,
					cvdtmstmp varchar(255) default NULL,
					primary key(id)
)Engine=InnoDB;

CREATE TABLE Poi(
					id varchar(255) NOT NULL,
					name varchar(255) default " " NOT NULL,
					address varchar(255) default "" NOT NULL,
					types JSON,
					coordinates JSON, 
					rating float(3,1),
					rating_n smallint(4),
					
					primary key(id)
	)Engine=InnoDB;

CREATE TABLE popularity(
					poiID varchar(255) NOT NULL,
					day varchar(255) default "" NOT NULL,
					data JSON,
					primary key(poiID,day),
					constraint POIS
					foreign key (poiID) references Poi(id)
					ON DELETE CASCADE ON UPDATE CASCADE
	)Engine=InnoDB;

CREATE TABLE coords(
					poiID varchar(255) NOT NULL,
					lat float(10,7) NOT NULL,
					lng float(10,7) NOT NULL,
					primary key(poiID),
					constraint coordsPOIS
					foreign key(poiID) references Poi(id)
					ON DELETE CASCADE ON UPDATE CASCADE
	)Engine=InnoDB;

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
					foreign key(userID) references user(id)
					ON DELETE CASCADE ON UPDATE CASCADE
			)Engine=InnoDB;
		
CREATE TABLE ConfirmedCase(
					poiID varchar(255) default " " NOT NULL,
					primary key(poiID),
					constraint ConfC
					foreign key(poiID) references place(poiID)
					ON DELETE CASCADE ON UPDATE CASCADE
)Engine=InnoDB;