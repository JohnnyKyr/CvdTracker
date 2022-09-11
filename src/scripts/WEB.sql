		-- INIT DATABASE

		DROP TABLE IF EXISTS user;
		
		DROP TABLE IF EXISTS Poi;
		DROP TABLE IF EXISTS popularity;
		DROP TABLE IF EXISTS hasCovid;
		DROP TABLE IF EXISTS log;
		DROP TABLE IF EXISTS place;
		
			CREATE TABLE user(
								
								username varchar(255) NOT NULL,
								password varchar(255) NOT NULL, 
								email varchar(255) NOT NULL,
								privilages INT(9),
								primary key(username)
			)Engine=InnoDB;



		DROP TABLE IF EXISTS Poi;

		CREATE TABLE Poi(
							id varchar(255) NOT NULL,
							name varchar(255) default " " NOT NULL,
							types JSON,
							address varchar(255) default "" NOT NULL,
							lat FLOAT(50),
							lng FLOAT(50),
							rating  float(3,1),
							rating_n smallint(4),
							
							primary key(id)
			)Engine=InnoDB;


		
		CREATE TABLE popularity(
							popID varchar(255) NOT NULL,
							day varchar(255) default "" NOT NULL,
							data  JSON,
							primary key(popID,day),
							constraint POIST
							foreign key (popID) references Poi(id)
							ON DELETE CASCADE ON UPDATE CASCADE
			)Engine=InnoDB;



		CREATE TABLE place(
							visitID INT(11)  AUTO_INCREMENT,
							poiID varchar(255) default " " NOT NULL,
							userID varchar(255) default " " NOT NULL,
							tmstmp DATETIME default CURRENT_TIMESTAMP,
							numofp INT(10) default NULL,
							primary key(visitID),
							constraint PlacePOI
							
							foreign key(poiID) references Poi(id)
							ON DELETE CASCADE ON UPDATE CASCADE,
							constraint PlaceUser
							foreign key(userID) references user(username)
							ON DELETE CASCADE ON UPDATE CASCADE
					)Engine=InnoDB;

		
		CREATE TABLE log(
							views INT(11) AUTO_INCREMENT,
							userID varchar(255),
							tmstmp DATETIME,
							primary key(views)
					)Engine=InnoDB;
		
		INSERT INTO log VALUES();


		
		CREATE TABLE hasCovid(
							reg INT(11) AUTO_INCREMENT,
							id varchar(255) NOT NULL,
							covid DATE,
							status varchar(255) NOT NULL,
							primary key(reg,id),
							constraint Hcovid
							foreign key(id) references user(username)
							ON DELETE CASCADE ON UPDATE CASCADE
							
			)Engine=InnoDB;


        DROP PROCEDURE if EXISTS conn;
            DELIMITER $$
        CREATE PROCEDURE Conn(username VARCHAR(255))
			BEGIN 
				
				DECLARE done INT DEFAULT FALSE;
				DECLARE placename varchar(255);
				DECLARE name varchar(255);
				DECLARE nname varchar(255);
				DECLARE placedate DATETIME;
				DECLARE tmstmp DATETIME;

				DECLARE cursorU CURSOR FOR
			SELECT place.poiID, MAX(place.tmstmp), poi.name FROM place INNER JOIN poi ON place.userID =username AND poi.id = place.poiID AND DATEDIFF(CURDATE(), place.tmstmp) <= 7 GROUP BY poi.id;     
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=TRUE;
				
				DROP TABLE IF EXISTS cvhs;
				
				CREATE TEMPORARY TABLE cvhs(
					name varchar(255) DEFAULT "",
					tempdate DATETIME DEFAULT NULL
				);

				OPEN cursorU;
				uLoop:
				LOOP
					FETCH cursorU INTO placename,placedate,nname;
					IF done THEN LEAVE uLoop;
					END IF;

					SET @name = NULL;
					SELECT  place.poiID,place.tmstmp INTO @name,@tmstmp from place,hascovid WHERE hasCovid.id = place.userID AND place.poiID = placename AND hascovid.id !=username  ORDER BY (place.tmstmp) DESC LIMIT 1;
					
					
				
					IF @name IS NOT NULL
						THEN
						
						IF @tmstmp>=placedate - INTERVAL 2 HOUR AND @tmstmp <=placedate + INTERVAL 2 HOUR 
							THEN
						
							INSERT INTO cvhs(name,tempdate) VALUES(nname,placedate);
						END IF;
					END IF;
				END LOOP uLoop;
			
			SELECT * FROM cvhs;
    	END$$
DELIMITER ;
	

	 
	   DROP PROCEDURE if EXISTS dateConflict;
      DELIMITER $$
        CREATE PROCEDURE dateConflict(cvdDay INT,username VARCHAR(255))
			BEGIN 
				DECLARE cvdDate DATE;
				DECLARE done INT DEFAULT FALSE;
                DECLARE accept INT DEFAULT FALSE;
				DECLARE placedate DATE;

				DECLARE cursorU CURSOR FOR
				SELECT covid FROM hasCovid WHERE id=username;     
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=TRUE;

				SELECT CURRENT_TIMESTAMP -INTERVAL cvdDay DAY INTO cvdDate;
                SET accept = True;
				OPEN cursorU;
				uLoop:
				LOOP
					FETCH cursorU INTO placedate;
                    
					IF done THEN LEAVE uLoop;
					END IF;
						
					IF cvdDate <=placedate + INTERVAL 7 DAY AND cvdDate >=placedate - INTERVAL 7 DAY  THEN
						SET accept = FALSE;
					END IF;
					
				END LOOP uLoop;
			
            IF placedate is NULL THEN
						INSERT INTO hasCovid(ID,covid,status) VALUES(username,cvdDate,'positive'); 
					END IF;
                    
            IF accept is TRUE AND placedate is NOT NULL THEN
            	INSERT INTO hasCovid(ID,covid,status) VALUES(username,cvdDate,'positive');
            END IF;
    	END$$
	DELIMITER ;

