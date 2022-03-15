DROP DATABASE IF EXISTS bdm_pia;

CREATE SCHEMA bdm_pia DEFAULT CHARACTER SET utf8;
USE bdm_pia;

SET GLOBAL log_bin_trust_function_creators = 1;


DROP TABLE IF EXISTS USERS;
CREATE TABLE USERS (
    USER_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro usuario',
    USERNAME VARCHAR(50) NOT NULL UNIQUE COMMENT 'Nombre de usuario identificador',
    USER_PASSWORD VARCHAR(30) NOT NULL COMMENT 'Contraseña para acceso a la cuenta',
    EMAIL VARCHAR(100) NOT NULL UNIQUE COMMENT 'Correo electrónico asociado a la cuenta',
    FIRST_NAME VARCHAR(50) NOT NULL COMMENT 'Primer nombre del usuario',
    SECOND_NAME VARCHAR(50) NULL COMMENT 'Segundo nombre del usuario',
    LAST_NAME VARCHAR(200) NOT NULL COMMENT 'Apellidos del usuario',
    COUNTRY VARCHAR(100) NULL COMMENT 'País donde reside el usuario',
    STATE VARCHAR(100) NULL COMMENT 'Estado donde reside el usuario',
    CITY VARCHAR(100) NULL COMMENT 'Ciudad donde reside el usuario',
    POSTAL_CODE VARCHAR(7) NULL COMMENT 'Código postal donde reside el usuario',
    PROFILE_PICTURE MEDIUMBLOB NULL COMMENT 'Imagen del usuario',
    ACCOUNT_TYPE VARCHAR(20) NOT NULL COMMENT 'Tipo de cuenta que identifica el rol del usuario',
    ACCOUNT_STATUS INT NOT NULL DEFAULT 1 COMMENT 'Estatus de activo de la cuenta',
    REGISTRATION_DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    LAST_UPDATE_DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de ultima actualización del registro'
);

DROP TABLE IF EXISTS PAYMENT_METHOD;
CREATE TABLE PAYMENT_METHOD (
    PAYMENT_METHOD_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del método de pago',
    ID_USER INT(10) NOT NULL COMMENT 'Usuario que maneja el método de pago',
    METHOD VARCHAR(50) NOT NULL COMMENT 'Nombre del método a usar (Visa/Mastercard)',
    CARD_HOLDER VARCHAR(250) NOT NULL COMMENT 'Nombre de la persona dueña de la tarjeta',
    CARD_NUMBER VARCHAR(16) NOT NULL COMMENT 'Número de la tarjeta a usar',
    EXPIRATION_MONTH VARCHAR(2) NOT NULL COMMENT 'Mes de expiración de la tarjeta',
    EXPIRATION_YEAR VARCHAR(4) NOT NULL COMMENT 'Año de expiración de la tarjeta',
    SECURITY_NUMBER VARCHAR(3) NOT NULL COMMENT 'Los 3 dígitos de seguridad de la tarjeta',
    FOREIGN KEY (ID_USER) REFERENCES USERS(USER_ID)
);

DROP TABLE IF EXISTS CATEGORIES;
CREATE TABLE CATEGORIES (
    CATEGORY_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro categoria',
    CATEGORY_NAME VARCHAR(50) NOT NULL UNIQUE COMMENT 'Nombre de la categoria',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    LAST_UPDATE_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de ultima actualización del registro'
);

DROP TABLE IF EXISTS COURSES;
CREATE TABLE COURSES (
    COURSE_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro curso',
    TITLE VARCHAR(255) NOT NULL COMMENT 'Titulo dado al curso',
    SHORT_DESCRIPTION TEXT NULL COMMENT 'Descripción corta del curso',
    LONG_DESCRIPTION TEXT NULL COMMENT 'Descripción larga del curso',
    PRICE FLOAT(10,2) NULL COMMENT 'Precio dado al curso completo',
    COURSE_PICTURE MEDIUMBLOB NULL COMMENT 'Miniatura alusiva del curso',
    ID_INSTRUCTOR INT(10) NOT NULL COMMENT 'Usuario impartidor del curo',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    LAST_UPDATE_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de ultima actualización del registro',
    FOREIGN KEY (ID_INSTRUCTOR) REFERENCES USERS(USER_ID)
);

DROP TABLE IF EXISTS COURSES_CATEGORIES;
CREATE TABLE COURSES_CATEGORIES (
    COURSES_CATEGORIES_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro curso - categorias',
    ID_CATEGORY INT(10) NOT NULL COMMENT 'Identificador de la categoría que pertenece el curso',
    ID_COURSE INT(10) NOT NULL COMMENT 'Identificador del curso que pertenece a a la categoría',
    FOREIGN KEY (ID_CATEGORY) REFERENCES CATEGORIES(CATEGORY_ID),
    FOREIGN KEY (ID_COURSE) REFERENCES COURSES(COURSE_ID)
);

DROP TABLE IF EXISTS LESSONS;
CREATE TABLE LESSONS (
    LESSON_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro lección',
    TITLE VARCHAR(255) NOT NULL COMMENT 'Titulo de la lección',
    DESCRIPTION TEXT NULL COMMENT 'Descripción de la lección',
    PRICE FLOAT(10,2) NULL COMMENT 'Precio dado a la lección individualmente',
    ID_COURSE INT(10) NOT NULL COMMENT 'Identificador del curso al que pertenece la lección',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    LAST_UPDATE_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de ultima actualización del registro',
    FOREIGN KEY (ID_COURSE) REFERENCES COURSES(COURSE_ID)
);

DROP TABLE IF EXISTS COURSES_PURCHASES;
CREATE TABLE COURSES_PURCHASES (
    PURCHASE_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro compra',
    ID_COURSE INT(10) NOT NULL COMMENT 'Identificador del curso que se adquirió',
    ID_USER INT(10) NOT NULL COMMENT 'Identificador del propietario de la compra',
    PURCHASE_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de compra del producto',
    PAYMENT_METHOD VARCHAR(50) NOT NULL COMMENT 'Tipo de metodo de pago usado',
    FOREIGN KEY (ID_COURSE) REFERENCES COURSES(COURSE_ID),
    FOREIGN KEY (ID_USER) REFERENCES USERS(USER_ID),
    UNIQUE KEY unique_course_purchase(ID_COURSE, ID_USER)
);

DROP TABLE IF EXISTS LESSONS_PURCHASES;
CREATE TABLE LESSONS_PURCHASES (
    PURCHASE_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro compra',
    ID_LESSON INT(10) NOT NULL COMMENT 'Identificador de la lección que se adquirió',
    ID_USER INT(10) NOT NULL COMMENT 'Identificador del propietario de la compra',
    PURCHASE_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de compra del producto',
    PAYMENT_METHOD VARCHAR(50) DEFAULT '' NOT NULL COMMENT 'Tipo de metodo de pago usado',
    FOREIGN KEY (ID_LESSON) REFERENCES LESSONS(LESSON_ID),
    FOREIGN KEY (ID_USER) REFERENCES USERS(USER_ID),
    UNIQUE KEY unique_lesson_purchase(ID_LESSON, ID_USER)
);

DROP TABLE IF EXISTS COMMENTS;
CREATE TABLE COMMENTS (
    COMMENT_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro comentario',
    ID_COURSE INT(10) NOT NULL COMMENT 'Identificador que hace referencia al curso que pertenece el comentario',
    ID_USER INT(10) NOT NULL COMMENT 'Identificador que hace referencia al usuario que pertenece el comentario',
    CONTENT TEXT NOT NULL COMMENT 'Contenido del comentario',
    QUALIFICATION FLOAT(3,1) NOT NULL  COMMENT 'Calificación dada al curso por el usuario',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    LAST_UPDATE_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de ultima actualización del registro',
    FOREIGN KEY (ID_COURSE) REFERENCES COURSES(COURSE_ID),
    FOREIGN KEY (ID_USER) REFERENCES USERS(USER_ID),
    CONSTRAINT CONS_QUALIFICATION CHECK (QUALIFICATION <= 10 && QUALIFICATION >= 0),
    UNIQUE KEY unique_comment(ID_COURSE, ID_USER)
);

DROP TABLE IF EXISTS MESSAGES;
CREATE TABLE MESSAGES (
    MESSAGE_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro mensaje',
    CONTENT TEXT NOT NULL COMMENT 'Contenido del mensaje',
    VIEWED BIT DEFAULT 0 COMMENT 'Bandera para validar si se ha visto el mensaje',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    ID_EMMITER INT(10) NOT NULL COMMENT 'Identificador del \r\nusuario emisor del mensaje',
    ID_RECIEVER INT(10) NOT NULL COMMENT 'Identificador del usuario que recibe el mensaje',
    FOREIGN KEY (ID_EMMITER) REFERENCES USERS(USER_ID),
    FOREIGN KEY (ID_RECIEVER) REFERENCES USERS(USER_ID)
);

DROP TABLE IF EXISTS LESSON_VIEWED;
CREATE TABLE LESSON_VIEWED (
    LESSON_VIEWED_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro lección vista',
    ID_LESSON INT(10) NOT NULL COMMENT 'Identificador que hace referencia al curso visto',
    ID_COURSE INT(10) NOT NULL COMMENT 'Identificador que hacer referencia al curso que pertenece la lección',
    ID_USER INT(10) NOT NULL COMMENT 'Identificador del usuario que ha visto la lección',
    LESSON_ViEWED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha en la que se vio la lección',
    FOREIGN KEY (ID_LESSON) REFERENCES LESSONS(LESSON_ID),
    FOREIGN KEY (ID_COURSE) REFERENCES COURSES(COURSE_ID),
    FOREIGN KEY (ID_USER) REFERENCES USERS(USER_ID),
    UNIQUE KEY unique_lesson_VIEWED(ID_LESSON, ID_COURSE, ID_USER)
);

DROP TABLE IF EXISTS LESSON_VIDEOS;
CREATE TABLE LESSON_VIDEOS (
    LESSSON_VIDEO_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro video de la lección',
    VIDEO VARCHAR(255) NOT NULL COMMENT 'Ruta del video guardado en el servidor',
    ID_LESSON INT(10) NOT NULL COMMENT 'Identificador que hace referencia al curso visto',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    FOREIGN KEY (ID_LESSON) REFERENCES LESSONS(LESSON_ID)
);

DROP TABLE IF EXISTS LESSON_DOCUMENTS;
CREATE TABLE LESSON_DOCUMENTS (
    LESSON_DOCUMENT_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro documento de la lección',
    DOCUMENT VARCHAR(255) NOT NULL COMMENT 'Ruta del documento guardado en el servidor',
    ID_LESSON INT(10) NOT NULL COMMENT 'Identificador que hace referencia al curso visto',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    FOREIGN KEY (ID_LESSON) REFERENCES LESSONS(LESSON_ID)
);

DROP TABLE IF EXISTS LESSON_IMAGES;
CREATE TABLE LESSON_IMAGES (
    LESSON_DOCUMENT_ID INT(10) PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del registro documento de la lección',
    IMAGES MEDIUMBLOB NOT NULL COMMENT 'Imagen de la lección',
    ID_LESSON INT(10) NOT NULL COMMENT 'Identificador que hace referencia al curso visto',
    CREATION_DATE DATETIME DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de la creación del registro',
    FOREIGN KEY (ID_LESSON) REFERENCES LESSONS(LESSON_ID)
);

/* //////////////////////////////////////////////////////// PROCEDURE ////////////////////////////////////////////////////////  */

DROP PROCEDURE IF EXISTS proc_view_profile;
DELIMITER //
	CREATE PROCEDURE proc_view_profile(IN vAction VARCHAR(5), IN vUserId INT(10))
	BEGIN
		IF vAction = 'N' THEN
			SELECT u.FIRST_NAME, u.SECOND_NAME, u.LAST_NAME, u.USERNAME, u.PROFILE_PICTURE FROM USERS u
			WHERE u.USER_ID = vUserId;
        ELSEIF vAction = 'C' THEN
			SELECT c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.COURSE_PICTURE FROM COURSES c
            WHERE c.ID_INSTRUCTOR = vUserId;
        ELSEIF vAction = 'L' THEN
			SELECT c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.COURSE_PICTURE FROM purchases p
            LEFT OUTER JOIN courses c ON c.COURSE_ID = p.ID_COURSE
            WHERE p.ID_USER = vUserId;
        END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_user;
DELIMITER //
	CREATE PROCEDURE proc_user(IN vAction VARCHAR(5), IN vUserId INT, IN vUserName VARCHAR(50), IN vPassword VARCHAR(30), IN vEmail VARCHAR(100),
								IN vFirstName VARCHAR(50), IN vSecondName VARCHAR(50), IN vLastName VARCHAR(200), IN vCountry VARCHAR(100),
                                IN vSate VARCHAR(100), IN vCity VARCHAR(100), IN vPostalCode VARCHAR(7), IN vProfilePicture MEDIUMBLOB, IN vAccountType VARCHAR(20), IN vAccountStatus INT)
	BEGIN
		IF vAction = 'I' THEN
			INSERT INTO USERS (USERNAME, USER_PASSWORD, EMAIL, FIRST_NAME, SECOND_NAME, LAST_NAME, ACCOUNT_TYPE, PROFILE_PICTURE)
            VALUES (vUserName, vPassword, vEmail, vFirstName, vSecondName, vLastName, vAccountType, vProfilePicture);
        ELSEIF vAction = 'L' THEN
			SELECT USER_ID, USERNAME, FIRST_NAME, SECOND_NAME, LAST_NAME, EMAIL, ACCOUNT_TYPE, PROFILE_PICTURE
            FROM USERS WHERE EMAIL = vEmail AND USER_PASSWORD = vPassword;
        ELSEIF vAction = 'U' THEN
			UPDATE USERS u SET  u.USERNAME = vUserName, u.FIRST_NAME = vFirstName, u.SECOND_NAME = vSecondName, u.LAST_NAME = vLastName,
								u.COUNTRY = vCountry, u.STATE = vSate, u.CITY = vCity, u.POSTAL_CODE = vPostalCode, u.EMAIL = vEmail,
                                u.USER_PASSWORD = vPassword, u.ACCOUNT_TYPE = vAccountType, u.LAST_UPDATE_DATE = CURRENT_TIMESTAMP()
            WHERE u.USER_ID = vUserId;
        ELSEIF vAction = 'UPP' THEN /*Update Profile Picture*/
            UPDATE USERS u SET u.PROFILE_PICTURE = vProfilePicture, u.LAST_UPDATE_DATE = CURRENT_TIMESTAMP()
            WHERE u.USER_ID = vUserId;
            SELECT PROFILE_PICTURE FROM USERS WHERE USER_ID = vUserId;
        ELSEIF vAction = 'S' THEN
			SELECT USERNAME, FIRST_NAME, SECOND_NAME, LAST_NAME, COUNTRY, STATE, CITY, POSTAL_CODE, EMAIL, USER_PASSWORD, ACCOUNT_TYPE, PROFILE_PICTURE
            FROM USERS WHERE USER_ID = vUserId;
		ELSEIF vAction = 'SA' THEN
			SELECT USERNAME, FIRST_NAME, SECOND_NAME, LAST_NAME, COUNTRY, STATE, CITY, POSTAL_CODE, EMAIL, USER_PASSWORD, ACCOUNT_TYPE, PROFILE_PICTURE
            FROM USERS;
		ELSEIF vAction = 'D' THEN
			UPDATE USERS u SET u.ACCOUNT_STATUS = vAccountStatus, u.LAST_UPDATE_DATE = CURRENT_TIMESTAMP()
            WHERE u.USER_ID = vUserId;
        END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_categories;
DELIMITER //
	CREATE PROCEDURE proc_categories(IN vAction VARCHAR(5), IN vCategoryId INT, IN vCategoryName VARCHAR(50))
	BEGIN
		IF vAction = 'I' THEN
			INSERT INTO CATEGORIES(CATEGORY_NAME) VALUE(vCategoryName);
        ELSEIF vAction = 'C' THEN
			SELECT CATEGORY_ID, CATEGORY_NAME FROM CATEGORIES WHERE UPPER(CATEGORY_NAME) LIKE UPPER(vCategoryName);
        ELSEIF vAction = 'S' THEN
			SELECT CATEGORY_ID, CATEGORY_NAME FROM CATEGORIES WHERE CATEGORY_ID = vCategoryId;
		ELSEIF vAction = 'SA' THEN
			SELECT CATEGORY_ID, CATEGORY_NAME FROM CATEGORIES ORDER BY CATEGORY_ID ASC;
		END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_course;
DELIMITER //
	CREATE PROCEDURE proc_course(IN vAction VARCHAR(5), IN vCourseId INT(10), IN vTitle VARCHAR(255), IN vShortDescription TEXT, IN vLongDescription TEXT, vPrice FLOAT(10,2),
	IN vCoursePicture MEDIUMBLOB, IN vIdInstructor INT(10))
	BEGIN
		IF vAction = 'I' THEN
			INSERT INTO COURSES(TITLE, SHORT_DESCRIPTION, LONG_DESCRIPTION, PRICE, COURSE_PICTURE, ID_INSTRUCTOR)
            VALUE(vTitle, vShortDescription, vLongDescription, vPrice, vCoursePicture, vIdInstructor);
            SELECT LAST_INSERT_ID() LAST_ID;
		ELSEIF vAction = 'II' THEN
			UPDATE COURSES c SET c.COURSE_PICTURE = vCoursePicture, c.LAST_UPDATE_DATE = CURRENT_TIMESTAMP()
            WHERE c.COURSE_ID = vCourseId;
        ELSEIF vAction = 'SANI' THEN /*SELECT ALL NEWEST EN INDEX */
            SELECT COURSE_ID, TITLE, SHORT_DESCRIPTION, PRICE, COURSE_PICTURE, CREATION_DATE
            FROM COURSES ORDER BY CREATION_DATE DESC LIMIT 6;
        ELSEIF vAction = 'SAPI' THEN /*SELECT ALL MOST POPULAR*/
            SELECT c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.PRICE, c.COURSE_PICTURE, c.CREATION_DATE, COUNT(c.COURSE_ID) as COMPRAS
            FROM COURSES c
            INNER JOIN COURSES_PURCHASES cp ON cp.ID_COURSE = c.COURSE_ID
            GROUP BY c.COURSE_ID ORDER BY COMPRAS DESC LIMIT 6;
        ELSEIF vAction = 'SBR' THEN /*SELECT BEST RATED*/
            SELECT c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.PRICE, c.COURSE_PICTURE, c.CREATION_DATE, AVG(cm.QUALIFICATION) QUALIFICATION
            FROM COMMENTS cm
            LEFT JOIN COURSES c ON c.COURSE_ID = cm.ID_COURSE
            GROUP BY c.COURSE_ID ORDER BY QUALIFICATION DESC LIMIT 6;
        ELSEIF vAction = 'SA' THEN /*SELECT ALL COURSES*/
            SELECT COURSE_ID, TITLE, SHORT_DESCRIPTION, LONG_DESCRIPTION, PRICE, COURSE_PICTURE, ID_INSTRUCTOR, CREATION_DATE, LAST_UPDATE_DATE
            FROM COURSES;
        ELSEIF vAction = 'SCID' THEN /*SELECT COURSE BY ID*/
            SELECT v.TITLE, v.SHORT_DESCRIPTION, v.LONG_DESCRIPTION, v.COURSE_PICTURE, v.CREATION_DATE, v.LAST_UPDATE_DATE, v.PRICE, v.QUALIFICATION, v.PARTICIPANTS, v.FIRST_NAME, v.LAST_NAME, v.ID_INSTRUCTOR
            FROM view_course_detail v
            WHERE v.COURSE_ID = vCourseId;
        ELSEIF vAction = 'STC' THEN /*SELECT TEACHER COURSES*/
            SELECT c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.PRICE, c.COURSE_PICTURE
            FROM COURSES c
            WHERE c.ID_INSTRUCTOR = vIdInstructor ORDER BY c.CREATION_DATE;
		ELSEIF vAction = 'SUC' THEN
		    SELECT c.TITLE, c.SHORT_DESCRIPTION, c.LONG_DESCRIPTION, c.PRICE FROM COURSES c WHERE c.COURSE_ID = vCourseId;
		ELSEIF vAction = 'UCI' THEN
		    IF vCoursePicture IS NULL THEN
		        UPDATE COURSES c SET c.TITLE = vTitle, c.SHORT_DESCRIPTION = vShortDescription, c.LONG_DESCRIPTION = vLongDescription, c.PRICE = vPrice, c.LAST_UPDATE_DATE = CURRENT_TIMESTAMP() WHERE c.COURSE_ID = vCourseId;
		    ELSE
		        UPDATE COURSES c SET c.TITLE = vTitle, c.SHORT_DESCRIPTION = vShortDescription, c.LONG_DESCRIPTION = vLongDescription, c.PRICE = vPrice, c.COURSE_PICTURE = vCoursePicture, c.LAST_UPDATE_DATE = CURRENT_TIMESTAMP()
                WHERE c.COURSE_ID = vCourseId;
		    END IF;
        ELSEIF vAction = 'GCFLP' THEN /*GET COURSE FROM LESSON PURCHASED*/
            SELECT COURSE_ID, COURSE_PICTURE, TITLE, SHORT_DESCRIPTION, PERCENTAGE FROM view_course_from_lessonsp where ID_USER = vIdInstructor GROUP BY COURSE_ID, COURSE_PICTURE, TITLE, SHORT_DESCRIPTION, PERCENTAGE;
		END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_course_categories;
DELIMITER //
	CREATE PROCEDURE proc_course_categories(IN vAction VARCHAR(5), IN vCourseCategoriesId INT(10), IN vIdCategory INT(10), IN vIdCourse INT(10))
	BEGIN
		IF vAction = 'I' THEN
			INSERT INTO COURSES_CATEGORIES(ID_CATEGORY, ID_COURSE) VALUE(vIdCategory, vIdCourse);
		ELSEIF vAction = 'SCC' THEN
		    SELECT c.CATEGORY_NAME, c.CATEGORY_ID FROM COURSES_CATEGORIES cc
		        INNER JOIN CATEGORIES c ON cc.ID_CATEGORY = c.CATEGORY_ID
		    WHERE cc.ID_COURSE = vIdCourse;
		ELSEIF vAction = 'D' THEN
		    DELETE FROM COURSES_CATEGORIES WHERE ID_CATEGORY = vIdCategory AND ID_COURSE = vIdCourse;
		END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_lesson;
DELIMITER //
	CREATE PROCEDURE proc_lesson(IN vAction VARCHAR(5), IN vLessonId INT(10), IN vTitle VARCHAR(255), IN vDescription TEXT, vPrice FLOAT(10,2),
								IN vIdCourse INT(10))
	BEGIN
		IF vAction = 'I' THEN
			INSERT INTO LESSONS(TITLE, DESCRIPTION, PRICE, ID_COURSE) VALUE(vTitle, vDescription, vPrice, vIdCourse);
            SELECT LAST_INSERT_ID() LAST_LESSON_ID;
        ELSEIF vAction = 'ST' THEN /*SELECT TITLE */
            SELECT l.LESSON_ID, l.TITLE, l.PRICE
            FROM LESSONS l WHERE ID_COURSE = vIdCourse;
        ELSEIF vAction = 'S' THEN /*SELECT TITLE */
            SELECT l.LESSON_ID, l.TITLE, l.PRICE
            FROM LESSONS l WHERE LESSON_ID = vLessonId;
        ELSEIF vAction = 'SAL' THEN /* SELECT ALL LESSON DATA FROM COURSE */
            SELECT l.LESSON_ID, l.TITLE, l.DESCRIPTION, ld.DOCUMENT, li.IMAGES, lv.VIDEO
            FROM LESSONS l
            LEFT JOIN LESSON_DOCUMENTS ld ON ld.ID_LESSON = l.LESSON_ID
            LEFT JOIN LESSON_VIDEOS lv ON lv.ID_LESSON = l.LESSON_ID
            LEFT JOIN LESSON_IMAGES li ON li.ID_LESSON = l.LESSON_ID
            WHERE l.ID_COURSE = vIdCourse ORDER BY LESSON_ID;
        ELSEIF vAction = 'SALC' THEN /* SELECT ALL LESSON FROM COURSE */
		    SELECT LESSON_ID, TITLE, DESCRIPTION, PRICE FROM LESSONS WHERE ID_COURSE = vIdCourse ORDER BY LESSON_ID ASC;
        ELSEIF vAction = 'SLVL' THEN /*SELECT LAST VEWED LESSON*/
            SELECT vl.ID_LESSON FROM LESSON_VEWED lv
            WHERE lv.ID_COURSE = vIdCourse AND lv.ID_LESSON = vLessonId ORDER BY LESSON_VIEWED_ID LIMIT 1;
        ELSEIF vAction = 'U' THEN
		    UPDATE LESSONS l SET l.TITLE = vTitle, l.DESCRIPTION = vDescription, l.PRICE = vPrice WHERE l.LESSON_ID = vLessonId;
		END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_lesson_viewed;
DELIMITER //
    CREATE PROCEDURE proc_lesson_viewed(IN vAction VARCHAR(5), IN vUserId INT(10), IN vLessonId INT(10), IN vCourseId INT(10))
    BEGIN
        IF vAction = 'ILV' THEN /*INSERT LESSON VIEWED*/
            INSERT INTO LESSON_VIEWED(ID_LESSON, ID_COURSE, ID_USER, LESSON_VIEWED_DATE)
            VALUES(vLessonId, vCourseId, vUserId, CURRENT_TIMESTAMP());
        ELSEIF vAction = 'SVL' THEN /* SELECT VIEWED LESSONS*/
            SELECT lv.ID_LESSON, lv.ID_COURSE FROM LESSON_VIEWED lv
            WHERE lv.ID_COURSE = vCourseId AND lv.ID_LESSON = vLessonId AND lv.ID_USER = vUserId ORDER BY LESSON_VIEWED_ID;
        ELSEIF vAction = 'LILB' THEN /*LESSON INFORMATION FROM LESSON BOUGHT*/
            SELECT l.LESSON_ID, l.TITLE, l.DESCRIPTION, ld.DOCUMENT, li.IMAGES, lv.VIDEO
            FROM LESSONS_PURCHASES lp
            LEFT JOIN LESSONS l ON lp.ID_LESSON = l.LESSON_ID
            LEFT JOIN COURSES c ON l.ID_COURSE = c.COURSE_ID
            LEFT JOIN LESSON_DOCUMENTS ld ON ld.ID_LESSON = l.LESSON_ID
            LEFT JOIN LESSON_VIDEOS lv ON lv.ID_LESSON = l.LESSON_ID
            LEFT JOIN LESSON_IMAGES li ON li.ID_LESSON = l.LESSON_ID
            WHERE lp.ID_USER = vUserId AND COURSE_ID = vCourseId;
        END IF;
    END;
//

DROP PROCEDURE IF EXISTS proc_media_lesson;
DELIMITER //
	CREATE PROCEDURE proc_media_lesson(IN vAction VARCHAR(5), IN vMediaId INT(10), IN vVideoLesson VARCHAR(255), IN vImageLesson MEDIUMBLOB,
	                                    IN vDocumentLesson VARCHAR(255), IN vIdLesson INT(10))
	BEGIN

	    DECLARE videoExist BIT;
	    DECLARE imageExist BIT;
	    DECLARE docExist BIT;

		IF vAction = 'I' THEN
            IF(vVideoLesson IS NOT NULL AND vVideoLesson NOT LIKE '') THEN
                    INSERT INTO LESSON_VIDEOS(VIDEO, ID_LESSON) VALUE(vVideoLesson, vIdLesson);
            END IF;

            IF(vImageLesson IS NOT NULL AND vImageLesson NOT LIKE '') THEN
                INSERT INTO LESSON_IMAGES(IMAGES, ID_LESSON) VALUE(vImageLesson, vIdLesson);
            END IF;

            IF(vDocumentLesson IS NOT NULL AND vDocumentLesson NOT LIKE '') THEN
                INSERT INTO LESSON_DOCUMENTS(DOCUMENT, ID_LESSON) VALUE(vDocumentLesson, vIdLesson);
            END IF;
        ELSEIF vAction = 'U' THEN
            IF(vVideoLesson IS NOT NULL AND vVideoLesson NOT LIKE '') THEN
                SET videoExist = (SELECT COUNT(LESSSON_VIDEO_ID) FROM LESSON_VIDEOS WHERE ID_LESSON = vIdLesson);
                IF videoExist = 1 THEN
                    UPDATE LESSON_VIDEOS SET VIDEO = vVideoLesson WHERE ID_LESSON = vIdLesson;
                ELSE
                    INSERT INTO LESSON_VIDEOS(VIDEO, ID_LESSON) VALUE(vVideoLesson, vIdLesson);
                END IF;
            END IF;

            IF(vImageLesson IS NOT NULL AND vImageLesson NOT LIKE '') THEN
                SET imageExist = (SELECT COUNT(LESSON_DOCUMENT_ID) FROM LESSON_IMAGES WHERE ID_LESSON = vIdLesson);
                IF imageExist = 1 THEN
                    UPDATE LESSON_IMAGES SET IMAGES = vImageLesson WHERE ID_LESSON = vIdLesson;
                ELSE
                    INSERT INTO LESSON_IMAGES(IMAGES, ID_LESSON) VALUE(vImageLesson, vIdLesson);
                END IF;
            END IF;

            IF(vDocumentLesson IS NOT NULL AND vDocumentLesson NOT LIKE '') THEN
                SET docExist = (SELECT COUNT(LESSON_DOCUMENT_ID) FROM LESSON_DOCUMENTS WHERE ID_LESSON = vIdLesson);
                IF docExist = 1 THEN
                    UPDATE LESSON_DOCUMENTS SET DOCUMENT = vDocumentLesson WHERE ID_LESSON = vIdLesson;
                ELSE
                    INSERT INTO LESSON_DOCUMENTS(DOCUMENT, ID_LESSON) VALUE(vDocumentLesson, vIdLesson);
                END IF;
            END IF;
		END IF;
	END;
//

DROP PROCEDURE IF EXISTS proc_message;
DELIMITER //
CREATE PROCEDURE proc_message(IN vAction VARCHAR(5), IN vMessageId INT(10), IN vContent TEXT, vViewed BIT, IN vCreationDate DATETIME,
                                IN vIdEmmiter INT(10), IN vIdReceiver INT(10), IN vSearch VARCHAR(255))
BEGIN

    IF vAction = 'I' THEN
        INSERT INTO MESSAGES(CONTENT, ID_EMMITER, ID_RECIEVER) VALUE (vContent, vIdEmmiter, vIdReceiver);
    ELSEIF vAction = 'UV' THEN # Marcar visto
        UPDATE MESSAGES m SET m.VIEWED = 1 WHERE m.MESSAGE_ID = vMessageId;
    ELSEIF vAction = 'SA' THEN # Obtener mensajes de una conversación
        SELECT m.MESSAGE_ID, m.ID_EMMITER, m.CONTENT, m.CREATION_DATE, m.VIEWED, u.FIRST_NAME, u.LAST_NAME, u.USER_ID
        FROM MESSAGES m
            LEFT JOIN USERS u ON u.USER_ID = m.ID_EMMITER
        WHERE (ID_RECIEVER IN (vIdEmmiter, vIdReceiver) AND ID_EMMITER IN (vIdEmmiter, vIdReceiver))
        ORDER BY CREATION_DATE ASC;
    ELSEIF vAction = 'SP' THEN # Obtener preview mensaje
        SELECT m.CONTENT, u.USER_ID USER_ID_EMMITER, u.FIRST_NAME FIRST_NAME_EMMITER, u.LAST_NAME LAST_NAME_EMMITER, u2.USER_ID USER_ID_RECEIVER, u2.FIRST_NAME FIRST_NAME_RECEIVER, u2.LAST_NAME LAST_NAME_RECEIVER FROM MESSAGES m
        INNER JOIN
            (
            SELECT MAX(mi.MESSAGE_ID) as LAST_ID FROM MESSAGES mi WHERE (mi.ID_EMMITER = vIdEmmiter OR mi.ID_RECIEVER = vIdEmmiter)
            GROUP BY (
                    CONCAT(
                        LEAST(mi.ID_EMMITER, mi.ID_RECIEVER),
                        '.',
                        GREATEST(mi.ID_EMMITER, mi.ID_RECIEVER)
                    )
                )
            ) CONVERSATIONS ON CONVERSATIONS.LAST_ID = m.MESSAGE_ID
        LEFT JOIN USERS u on u.USER_ID = m.ID_EMMITER
        LEFT JOIN USERS u2 on u2.USER_ID = m.ID_RECIEVER
        ORDER BY m.CREATION_DATE DESC ;
    ELSEIF vAction = 'SU' THEN # Buscamos usuarios en el apartado de chat
        IF vSearch NOT LIKE '' THEN
            SELECT u.USER_ID, u.FIRST_NAME, u.LAST_NAME FROM USERS u
            WHERE u.USER_ID != vIdEmmiter AND (u.FIRST_NAME LIKE CONCAT('%',vSearch, '%') OR u.LAST_NAME LIKE CONCAT('%',vSearch, '%')
                    OR u.USERNAME LIKE CONCAT('%',vSearch, '%'));
        ELSE
            SELECT m.CONTENT, u.USER_ID USER_ID_EMMITER, u.FIRST_NAME FIRST_NAME_EMMITER, u.LAST_NAME LAST_NAME_EMMITER, u2.USER_ID USER_ID_RECEIVER, u2.FIRST_NAME FIRST_NAME_RECEIVER, u2.LAST_NAME LAST_NAME_RECEIVER FROM messages m
            INNER JOIN
                (
                SELECT MAX(mi.MESSAGE_ID) as LAST_ID FROM MESSAGES mi WHERE (mi.ID_EMMITER = vIdEmmiter OR mi.ID_RECIEVER = vIdEmmiter)
                GROUP BY (
                        CONCAT(
                            LEAST(mi.ID_EMMITER, mi.ID_RECIEVER),
                            '.',
                            GREATEST(mi.ID_EMMITER, mi.ID_RECIEVER)
                        )
                    )
                ) CONVERSATIONS ON CONVERSATIONS.LAST_ID = m.MESSAGE_ID
            LEFT JOIN USERS u on u.USER_ID = m.ID_EMMITER
            LEFT JOIN USERS u2 on u2.USER_ID = m.ID_RECIEVER
            ORDER BY m.CREATION_DATE DESC ;
        END IF;
    END IF;
END;
//

DROP PROCEDURE IF EXISTS proc_purchases;
DELIMITER //
CREATE PROCEDURE proc_purchases(IN vAction VARCHAR(5), IN vCourseId INT(10), IN vLessonId INT(10), IN vUserId INT(10), IN vPaymentMethod VARCHAR(50))
BEGIN
    IF vAction = 'I' THEN
        INSERT INTO COURSES_PURCHASES(ID_COURSE, ID_USER, PURCHASE_DATE, PAYMENT_METHOD)
        VALUES(vCourseId, vUserId, CURRENT_TIMESTAMP(), vPaymentMethod);
    ELSEIF vAction = 'IL' THEN
        INSERT INTO LESSONS_PURCHASES(ID_LESSON, ID_USER, PURCHASE_DATE, PAYMENT_METHOD)
        VALUES(vLessonId, vUserId, CURRENT_TIMESTAMP(), vPaymentMethod);

        SET @aux = (SELECT ID_COURSE FROM LESSONS WHERE LESSON_ID = vLessonId);
        SET @lessonsQ = (SELECT COUNT(LESSON_ID) FROM LESSONS WHERE ID_COURSE = @aux);
        SET @lessonsB = (SELECT COUNT(lp.PURCHASE_ID) FROM LESSONS_PURCHASES lp
        INNER JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
        INNER JOIN COURSES c ON c.COURSE_ID = l.ID_COURSE
        WHERE lp.ID_USER = vUserId AND c.COURSE_ID = @aux);

        IF @lessonsB >= @lessonsQ THEN
            INSERT INTO COURSES_PURCHASES(ID_COURSE, ID_USER, PURCHASE_DATE)
            VALUES(@aux, vUserId, CURRENT_TIMESTAMP());
        END IF;
    ELSEIF vAction = 'UHC' THEN
        SELECT func_user_has_course(vCourseId, vUserId) as 'Bool';
    ELSEIF vAction = 'UHL' THEN
        SELECT func_user_has_lesson(vLessonId, vUserId) as 'Bool';
        ELSEIF vAction = 'SUCP' THEN
        SELECT COURSE_ID, TITLE, SHORT_DESCRIPTION, COURSE_PICTURE, PERCENTAGE FROM view_course_from_purchases WHERE USER_ID = vUserId;
    END IF;
END;
//

DROP PROCEDURE IF EXISTS proc_search;
DELIMITER //
CREATE PROCEDURE proc_search(IN vAction VARCHAR(5), IN vSearch VARCHAR(255), IN vOwnerName VARCHAR(255), IN vfromDate DATE, IN vToDate DATE, IN vCategoryId VARCHAR(50))
BEGIN
    IF vAction = 'SS' THEN
        SELECT COURSE_ID, TITLE, SHORT_DESCRIPTION, PRICE, COURSE_PICTURE, CREATION_DATE
            FROM COURSES WHERE TITLE LIKE CONCAT('%',vSearch,'%')  ORDER BY CREATION_DATE;
    ELSEIF vAction = 'SA' THEN
        SELECT COURSE_ID, TITLE, SHORT_DESCRIPTION, PRICE, COURSE_PICTURE, CREATION_DATE
            FROM COURSES ORDER BY CREATION_DATE;
    ELSEIF vAction = 'SF' THEN
        SELECT COURSE_ID, TITLE, SHORT_DESCRIPTION, PRICE, COURSE_PICTURE, CREATION_DATE
        FROM COURSES
        LEFT JOIN USERS U on COURSES.ID_INSTRUCTOR = U.USER_ID
        LEFT JOIN COURSES_CATEGORIES CC on COURSES.COURSE_ID = CC.ID_COURSE
        WHERE (TITLE LIKE CONCAT('%',vSearch,'%')) OR (U.FIRST_NAME LIKE CONCAT('%',vOwnerName,'%') OR U.SECOND_NAME LIKE CONCAT('%',vOwnerName,'%') OR U.LAST_NAME LIKE CONCAT('%',vOwnerName,'%'))
                OR (CREATION_DATE BETWEEN vfromDate AND vToDate) OR (CC.ID_CATEGORY = vCategoryId) GROUP BY COURSE_ID;
    END IF;
END;
//

DROP PROCEDURE IF EXISTS proc_payment_method;
DELIMITER //
CREATE PROCEDURE proc_payment_method(IN vAction VARCHAR(5), IN vPaymentMethodId INT(10), IN vIdUser INT(10), IN vMethod VARCHAR(50), IN vCardHolder VARCHAR(250), IN vCardNumber VARCHAR(16), IN vExpirationMonth VARCHAR(2), IN vExpirationYear VARCHAR(4), IN vSecurityNumber VARCHAR(3))
BEGIN
    IF vAction = 'I' THEN
        INSERT INTO PAYMENT_METHOD(ID_USER, METHOD, CARD_HOLDER, CARD_NUMBER, EXPIRATION_MONTH, EXPIRATION_YEAR, SECURITY_NUMBER)
            VALUES(vIdUser, vMethod, vCardHolder, vCardNumber, vExpirationMonth, vExpirationYear, vSecurityNumber);
    ELSEIF vAction = 'U' THEN
        UPDATE PAYMENT_METHOD pm SET pm.METHOD = vMethod, pm.CARD_HOLDER = vCardHolder, pm.CARD_NUMBER = vCardNumber, pm.EXPIRATION_MONTH = vExpirationMonth,
                                     pm.EXPIRATION_YEAR = vExpirationYear, pm.SECURITY_NUMBER = vSecurityNumber WHERE pm.PAYMENT_METHOD_ID = vPaymentMethodId;
    ELSEIF vAction = 'D' THEN
        DELETE FROM PAYMENT_METHOD WHERE PAYMENT_METHOD_ID = vPaymentMethodId;
    ELSEIF vAction = 'S' THEN
        SELECT pm.PAYMENT_METHOD_ID, pm.METHOD, pm.CARD_HOLDER, pm.CARD_NUMBER, pm.EXPIRATION_MONTH, pm.EXPIRATION_YEAR, pm.SECURITY_NUMBER
        FROM PAYMENT_METHOD pm WHERE pm.PAYMENT_METHOD_ID = vPaymentMethodId;
    ELSEIF vAction = 'SAU' THEN
        SELECT pm.PAYMENT_METHOD_ID, pm.METHOD, pm.CARD_HOLDER, pm.CARD_NUMBER, pm.EXPIRATION_MONTH, pm.EXPIRATION_YEAR
        FROM PAYMENT_METHOD pm WHERE pm.ID_USER = vIdUser;
    ELSEIF vAction = 'VPM' THEN
        SELECT pm.PAYMENT_METHOD_ID, pm.METHOD, pm.CARD_HOLDER, pm.CARD_NUMBER, pm.EXPIRATION_MONTH, pm.EXPIRATION_YEAR
        FROM PAYMENT_METHOD pm WHERE pm.PAYMENT_METHOD_ID = vPaymentMethodId AND (pm.CARD_NUMBER = vCardNumber AND pm.SECURITY_NUMBER = vSecurityNumber);
    END IF;
END;
//

DROP PROCEDURE IF EXISTS proc_comments;
DELIMITER //
CREATE PROCEDURE proc_comments(IN vAction VARCHAR(5), IN vCourseId INT(10), IN vUserId INT(10), vContent TEXT, vQualification FLOAT(3,1))
BEGIN
    IF vAction = 'I' THEN /* INSERT DE PAPU*/
        INSERT INTO COMMENTS (ID_COURSE, ID_USER, CONTENT, QUALIFICATION, CREATION_DATE, LAST_UPDATE_DATE)
        VALUES(vCourseId, vUserId, vContent, vQualification, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
    ELSEIF vAction = 'SCC' THEN /*SELECT COMMENT FROM COURSE*/
        SELECT cm.COMMENT_ID, u.USERNAME, u.PROFILE_PICTURE, cm.CONTENT, cm.QUALIFICATION, cm.CREATION_DATE
        FROM COMMENTS cm
        LEFT JOIN USERS u ON u.USER_ID = cm.ID_USER
        WHERE cm.ID_COURSE = vCourseId;
    ELSEIF vAction = 'UHC' THEN /*USER HAS COMMENTED*/
        SELECT COUNT(COMMENT_ID) FROM COMMENTS
        WHERE ID_USER = vUserId AND ID_COURSE = vCourseId;
    END IF;
END;
//

DROP PROCEDURE IF EXISTS proc_dates_courses;
DELIMITER //
CREATE PROCEDURE proc_dates_courses(IN vIdUser INT(10), IN vCourseId INT(10))
BEGIN
    DECLARE IS_FINISH FLOAT;
    DECLARE IS_FOR_LESSONS INT;
    DECLARE IS_INITIATED INT;

    DECLARE ENROLLMENT_DATE TEXT;
    DECLARE LAST_ACTIVITY_DATE TEXT;
    DECLARE FINISH_DATE TEXT;

    SET IS_FINISH = func_percentage_of_course(vCourseId, vIdUser);

    SET IS_FOR_LESSONS = (SELECT COUNT(lp.PURCHASE_ID) FROM LESSONS_PURCHASES lp
                            INNER JOIN LESSONS l on lp.ID_LESSON = l.LESSON_ID
                        WHERE lp.ID_USER = vIdUser AND l.ID_COURSE = vCourseId);

    SET IS_INITIATED = (SELECT COUNT(LESSON_ViEWED_DATE) FROM LESSON_VIEWED WHERE ID_COURSE = vCourseId AND ID_USER = vIdUser);

    IF IS_FINISH = 100 THEN
        SET FINISH_DATE = (SELECT MAX(DATE_FORMAT(lv.LESSON_ViEWED_DATE, '%d/%m/%Y')) FINISH_DATE FROM LESSON_VIEWED lv
            INNER JOIN LESSONS l on lv.ID_LESSON = l.LESSON_ID
        WHERE lv.ID_USER = vIdUser AND l.ID_COURSE = vCourseId);
    ELSE
        SET FINISH_DATE = 'XX/XX/XXXX';
    END IF;

    IF IS_FOR_LESSONS > 0 THEN
        SET ENROLLMENT_DATE = (SELECT MIN(DATE_FORMAT(lp.PURCHASE_DATE, '%d/%m/%Y')) ENROLLMENT_DATE FROM LESSONS_PURCHASES lp
            INNER JOIN LESSONS l on lp.ID_LESSON = l.LESSON_ID
        WHERE lp.ID_USER = vIdUser AND l.ID_COURSE = vCourseId);
    ELSE
        SET ENROLLMENT_DATE = (SELECT MIN(DATE_FORMAT(cp.PURCHASE_DATE, '%d/%m/%Y')) ENROLLMENT_DATE FROM COURSES_PURCHASES cp
        WHERE cp.ID_USER = vIdUser AND cp.ID_COURSE = vCourseId);
    END IF;

    IF IS_INITIATED > 0 THEN
        SET LAST_ACTIVITY_DATE = (SELECT MAX(DATE_FORMAT(lv.LESSON_ViEWED_DATE, '%d/%m/%Y')) FINISH_DATE FROM LESSON_VIEWED lv
            INNER JOIN LESSONS l on lv.ID_LESSON = l.LESSON_ID
        WHERE lv.ID_USER = vIdUser AND l.ID_COURSE = vCourseId);
    ELSE
        SET LAST_ACTIVITY_DATE = 'XX/XX/XXXX';
    END IF;

    SELECT ENROLLMENT_DATE, LAST_ACTIVITY_DATE, FINISH_DATE;
END;
//

DROP PROCEDURE  IF EXISTS proc_purchases_total_PaymentMethod;
DELIMITER //
CREATE PROCEDURE proc_purchases_total_PaymentMethod(vUserId INT(10))
BEGIN
    DECLARE totalFromLessonsVisa FLOAT DEFAULT 0;
    DECLARE totalFromLessonsMastercard FLOAT DEFAULT 0;
    DECLARE totalFromCoursesVisa FLOAT DEFAULT 0;
    DECLARE totalFromCoursesMastercard FLOAT DEFAULT 0;

    DECLARE totalVisa FLOAT DEFAULT 0;
    DECLARE totalMastercard FLOAT DEFAULT 0;
    DECLARE total FLOAT DEFAULT 0;

    SET totalFromLessonsVisa = (SELECT SUM(PRICE) FROM view_total_purchases_lp_pm
                                    WHERE ID_INSTRUCTOR = vUserId AND PAYMENT_METHOD = 'visa'
                                    GROUP BY PAYMENT_METHOD);

    SET totalFromLessonsMastercard = (SELECT SUM(PRICE) FROM view_total_purchases_lp_pm
                                        WHERE ID_INSTRUCTOR = vUserId AND PAYMENT_METHOD = 'mastercard'
                                        GROUP BY PAYMENT_METHOD);

    SET totalFromCoursesVisa = (SELECT SUM(PRICE) FROM view_total_purchases_cp_pm
                                WHERE ID_INSTRUCTOR = vUserId AND PAYMENT_METHOD = 'visa'
                                GROUP BY PAYMENT_METHOD);

    SET totalFromCoursesMastercard = (SELECT SUM(PRICE) FROM view_total_purchases_cp_pm
                                    WHERE ID_INSTRUCTOR = vUserId AND PAYMENT_METHOD = 'mastercard'
                                    GROUP BY PAYMENT_METHOD);

    IF totalFromLessonsVisa IS NULL THEN
        SET totalFromLessonsVisa = 0;
    END IF;

    IF totalFromLessonsMastercard IS NULL THEN
        SET totalFromLessonsMastercard = 0;
    END IF;

     IF totalFromCoursesVisa IS NULL THEN
        SET totalFromCoursesVisa = 0;
    END IF;

    IF totalFromCoursesMastercard IS NULL THEN
        SET totalFromCoursesMastercard = 0;
    END IF;

    SET totalVisa = totalFromLessonsVisa + totalFromCoursesVisa;
    SET totalMastercard = totalFromLessonsMastercard + totalFromCoursesMastercard;
    SET total = totalVisa + totalMastercard;

    SELECT totalVisa VISA, totalMastercard MASTERCARD, total TOTAL;
END //

DROP PROCEDURE IF EXISTS proc_reports;
DELIMITER //
CREATE PROCEDURE proc_reports(IN vAction VARCHAR(5), IN vCourseId INT(10), IN vUserId INT(10))
BEGIN
    IF vAction = 'R1' THEN /* REPORTE UNO */
        SELECT COURSE_ID, TITLE, PARTICIPANTS, LESSON_MOST_COMPLETED, SALES FROM view_course_report_1 WHERE ID_INSTRUCTOR = vUserId;
    ELSEIF vAction = 'RC' THEN /* REPORTE DOS */
        CALL proc_purchases_total_PaymentMethod(vUserId);
    ELSEIF vAction = 'R2' THEN /* REPORTE DOS */
        SELECT USER_ID, FIRST_NAME, LAST_NAME, PERCENTAGE_COMPLETION, TOTAL_SPENT, PAYMENT_METHOD FROM view_course_report_2 WHERE COURSE_ID = vCourseId;
    ELSEIF vAction = 'R2C' THEN /* REPORTE DOS */
        SELECT COURSE_ID ,TITLE FROM COURSES WHERE ID_INSTRUCTOR = vUserId;
    ELSEIF vAction = 'CERT' THEN
        SELECT TITLE, u.FIRST_NAME, u.LAST_NAME FROM COURSES
            LEFT JOIN USERS u on COURSES.ID_INSTRUCTOR = u.USER_ID
        WHERE COURSE_ID = vCourseId;
    END IF;
END;
//

/* //////////////////////////////////////////////////////// FUNCTION ////////////////////////////////////////////////////////  */

DROP FUNCTION IF EXISTS func_count_participants;
DELIMITER //
CREATE FUNCTION func_count_participants(vCourseId INT(10)) RETURNS INT
BEGIN
    DECLARE total_participants INT;

    SET total_participants = (SELECT COUNT(PURCHASE_ID) FROM COURSES_PURCHASES WHERE ID_COURSE = vCourseId);

    RETURN total_participants;
END //

DROP FUNCTION IF EXISTS func_user_has_course;
DELIMITER //
CREATE FUNCTION func_user_has_course(vCourseId INT(10), vUserId INT(10)) RETURNS BIT
BEGIN
    DECLARE bool BIT;

    SET bool = (SELECT COUNT(PURCHASE_ID) FROM COURSES_PURCHASES WHERE ID_COURSE = vCourseId AND ID_USER = vUserId);

    RETURN bool;
END //

DROP FUNCTION IF EXISTS func_user_has_lesson;
DELIMITER //
CREATE FUNCTION func_user_has_lesson(vLessonId INT(10), vUserId INT(10)) RETURNS BIT
BEGIN
    DECLARE bool BIT;
    SET bool = (SELECT COUNT(PURCHASE_ID) FROM LESSONS_PURCHASES WHERE ID_LESSON = vLessonId AND ID_USER = vUserId);
    RETURN bool;
END //

DROP FUNCTION IF EXISTS func_percentage_of_course;
DELIMITER //
CREATE FUNCTION func_percentage_of_course(vCourseId INT(10), vUserId INT(10)) RETURNS FLOAT
BEGIN
    DECLARE percentage FLOAT;
    DECLARE totalLessonsForCourse INT;
    DECLARE lessonsViewsForUser INT;

    SET totalLessonsForCourse = (SELECT COUNT(l.LESSON_ID) FROM LESSONS l WHERE ID_COURSE = vCourseId);
    SET lessonsViewsForUser = (SELECT COUNT(lv.ID_LESSON) FROM LESSON_VIEWED lv WHERE ID_COURSE = vCourseId AND ID_USER = vUserId);

    SET percentage = ROUND((lessonsViewsForUser/totalLessonsForCourse)*100);

    RETURN percentage;
END //

DROP FUNCTION IF EXISTS func_purchases_total;
DELIMITER //
CREATE FUNCTION func_purchases_total(vCourseId INT(10), vUserId INT(10)) RETURNS FLOAT
BEGIN
    DECLARE totalFromLessons FLOAT DEFAULT 0;
    DECLARE totalFromCourses FLOAT DEFAULT 0;
    DECLARE total FLOAT DEFAULT 0;

    SET totalFromLessons = (SELECT SUM(l.PRICE) FROM LESSONS_PURCHASES lp
                LEFT JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
                LEFT JOIN COURSES c on l.ID_COURSE = c.COURSE_ID
                WHERE l.ID_COURSE = vCourseId AND c.ID_INSTRUCTOR = vUserId);

    SET totalFromCourses = (SELECT SUM(c.PRICE) FROM COURSES_PURCHASES cp
                LEFT JOIN COURSES c on c.COURSE_ID = cp.ID_COURSE
                WHERE c.COURSE_ID = vCourseId AND c.ID_INSTRUCTOR = vUserId);

    IF totalFromLessons IS NULL THEN
        SET totalFromLessons = 0;
    END IF;

    IF totalFromCourses IS NULL THEN
        SET totalFromCourses = 0;
    END IF;

    SET total = totalFromCourses + totalFromLessons;

    RETURN total;
END //

DROP FUNCTION IF EXISTS func_purchases_totalByUserAndCourse;
DELIMITER //
CREATE FUNCTION func_purchases_totalByUserAndCourse(vCourseId INT(10), vUserId INT(10)) RETURNS FLOAT
BEGIN
    DECLARE totalFromLessons FLOAT DEFAULT 0;
    DECLARE totalFromCourses FLOAT DEFAULT 0;
    DECLARE total FLOAT DEFAULT 0;

    SET totalFromLessons = (SELECT SUM(l.PRICE) FROM LESSONS_PURCHASES lp
                LEFT JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
                LEFT JOIN COURSES c on l.ID_COURSE = c.COURSE_ID
                WHERE l.ID_COURSE = vCourseId AND lp.ID_USER = vUserId);

    SET totalFromCourses = (SELECT SUM(c.PRICE) FROM COURSES_PURCHASES cp
                LEFT JOIN COURSES c on c.COURSE_ID = cp.ID_COURSE
                 WHERE c.COURSE_ID = vCourseId AND cp.ID_USER = vUserId);

    IF totalFromLessons IS NULL THEN
        SET totalFromLessons = 0;
    END IF;

    IF totalFromCourses IS NULL THEN
        SET totalFromCourses = 0;
    END IF;

    SET total = totalFromCourses + totalFromLessons;

    RETURN total;
END //

DROP FUNCTION IF EXISTS func_payment_method_rep;
DELIMITER //
CREATE FUNCTION func_payment_method_rep(vCourseId INT(10), vUserId INT(10)) RETURNS VARCHAR(50)
BEGIN
    DECLARE paymentMethodResult VARCHAR(50);
    DECLARE isForLessons INT;

    SET isForLessons = (SELECT COUNT(PAYMENT_METHOD) FROM LESSONS_PURCHASES lp
                        LEFT JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
                        LEFT OUTER JOIN COURSES c on c.COURSE_ID = l.ID_COURSE
                        WHERE lp.ID_USER = vUserId AND c.COURSE_ID = vCourseId);

    IF isForLessons > 0 THEN
        SET paymentMethodResult = (SELECT MAX(PAYMENT_METHOD) FROM LESSONS_PURCHASES lp
                                    LEFT JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
                                    LEFT OUTER JOIN COURSES c on c.COURSE_ID = l.ID_COURSE
                                    WHERE lp.ID_USER = vUserId AND c.COURSE_ID = vCourseId);
    ELSE
        SET paymentMethodResult = (SELECT MAX(PAYMENT_METHOD) FROM COURSES_PURCHASES cp
                                    LEFT JOIN COURSES c on c.COURSE_ID = cp.ID_COURSE
                                    WHERE cp.ID_USER = vUserId AND c.COURSE_ID = vCourseId);
    END IF;

    RETURN paymentMethodResult;
END //

/* //////////////////////////////////////////////////////// VIEW ////////////////////////////////////////////////////////  */

DROP VIEW IF EXISTS view_course_detail;
DELIMITER //
CREATE VIEW view_course_detail AS
    SELECT c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.LONG_DESCRIPTION, c.COURSE_PICTURE, c.CREATION_DATE, c.LAST_UPDATE_DATE, c.PRICE,
            AVG(cm.QUALIFICATION) QUALIFICATION, func_count_participants(c.COURSE_ID) PARTICIPANTS, u.FIRST_NAME, u.LAST_NAME, c.ID_INSTRUCTOR FROM COURSES c
    LEFT JOIN USERS u ON u.USER_ID = c.ID_INSTRUCTOR
    LEFT JOIN COMMENTS cm ON cm.ID_COURSE = c.COURSE_ID
    GROUP BY c.COURSE_ID, cm.ID_COURSE;
//

DROP VIEW IF EXISTS view_course_report_1;
DELIMITER //
CREATE VIEW view_course_report_1 AS
      SELECT c.ID_INSTRUCTOR, c.COURSE_ID, c.TITLE, func_count_participants(c.COURSE_ID) PARTICIPANTS, ROUND(AVG(lv.ID_LESSON)) LESSON_MOST_COMPLETED, func_purchases_total(c.COURSE_ID, c.ID_INSTRUCTOR) SALES FROM COURSES c
    LEFT JOIN USERS u ON u.USER_ID = c.ID_INSTRUCTOR
    LEFT JOIN LESSON_VIEWED lv ON c.COURSE_ID = lv.ID_COURSE
    LEFT JOIN COURSES_PURCHASES cp ON c.COURSE_ID = cp.ID_COURSE
    LEFT JOIN LESSONS l ON c.COURSE_ID = l.LESSON_ID
    LEFT JOIN LESSONS_PURCHASES lp ON l.LESSON_ID = lp.ID_LESSON
    GROUP BY c.COURSE_ID;
//

DROP VIEW IF EXISTS view_course_report_2;
DELIMITER //
CREATE VIEW view_course_report_2 AS
      SELECT c.COURSE_ID, u.USER_ID, u.FIRST_NAME, u.LAST_NAME, func_percentage_of_course(c.COURSE_ID, u.USER_ID) PERCENTAGE_COMPLETION, func_purchases_totalByUserAndCourse(c.COURSE_ID, u.USER_ID) TOTAL_SPENT, func_payment_method_rep(c.COURSE_ID, u.USER_ID) PAYMENT_METHOD FROM COURSES c
    LEFT JOIN COURSES_PURCHASES cp ON c.COURSE_ID = cp.ID_COURSE
    LEFT JOIN LESSONS l ON c.COURSE_ID = l.ID_COURSE
    LEFT JOIN LESSONS_PURCHASES lp ON l.LESSON_ID = lp.ID_LESSON
    LEFT JOIN USERS u ON (cp.ID_USER = u.USER_ID OR lp.ID_USER = u.USER_ID)
    GROUP BY c.COURSE_ID, u.USER_ID, u.FIRST_NAME, u.LAST_NAME;
//

DROP VIEW IF EXISTS view_course_from_lessonsp;
DELIMITER //
CREATE VIEW view_course_from_lessonsp AS
    SELECT lp.ID_USER, l.ID_COURSE LCOURSEID, c.COURSE_ID, c.COURSE_PICTURE, c.TITLE, c.SHORT_DESCRIPTION, func_percentage_of_course(c.COURSE_ID, lp.ID_USER) PERCENTAGE FROM LESSONS_PURCHASES lp
            LEFT JOIN LESSONS l on lp.ID_LESSON = l.LESSON_ID
            LEFT JOIN COURSES c on l.ID_COURSE = c.COURSE_ID
            LEFT JOIN LESSON_DOCUMENTS ld ON ld.ID_LESSON = l.LESSON_ID
            LEFT JOIN LESSON_VIDEOS lv ON lv.ID_LESSON = l.LESSON_ID
            LEFT JOIN LESSON_IMAGES li ON li.ID_LESSON = l.LESSON_ID;
//

DROP VIEW IF EXISTS view_course_from_purchases;
DELIMITER //
CREATE VIEW view_course_from_purchases AS
    SELECT u.USER_ID, c.COURSE_ID, c.TITLE, c.SHORT_DESCRIPTION, c.COURSE_PICTURE, func_percentage_of_course(c.COURSE_ID, u.USER_ID) PERCENTAGE
        FROM COURSES c
        INNER JOIN COURSES_PURCHASES cp ON c.COURSE_ID = cp.ID_COURSE
        INNER JOIN USERS u ON cp.ID_USER = u.USER_ID
        ORDER BY cp.PURCHASE_DATE;
//

DROP VIEW IF EXISTS view_total_purchases_lp_pm;
DELIMITER //
CREATE VIEW view_total_purchases_lp_pm AS
    SELECT l.PRICE, c.ID_INSTRUCTOR, lp.PAYMENT_METHOD FROM LESSONS_PURCHASES lp
                LEFT JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
                LEFT JOIN COURSES c on l.ID_COURSE = c.COURSE_ID;
//

DROP VIEW IF EXISTS view_total_purchases_cp_pm;
DELIMITER //
CREATE VIEW view_total_purchases_cp_pm AS
    SELECT c.PRICE, c.ID_INSTRUCTOR, cp.PAYMENT_METHOD FROM COURSES_PURCHASES cp
                LEFT JOIN COURSES c on cp.ID_COURSE = c.COURSE_ID;
//

/* //////////////////////////////////////////////////////// TRIGGER ////////////////////////////////////////////////////////  */

DROP TRIGGER IF EXISTS trig_purchase_lesson;
DELIMITER //
CREATE TRIGGER trig_purchase_lesson AFTER INSERT ON LESSONS_PURCHASES
FOR EACH ROW
BEGIN
    DECLARE lessonsQ INT;
    DECLARE lessonsB INT;
    DECLARE aux INT;

    SET aux = (SELECT ID_COURSE FROM LESSONS WHERE LESSON_ID = NEW.ID_LESSON);
    SET lessonsQ = (SELECT COUNT(LESSON_ID) FROM LESSONS WHERE ID_COURSE = aux);

    SET lessonsB = (SELECT COUNT(lp.PURCHASE_ID) FROM LESSONS_PURCHASES lp
    INNER JOIN LESSONS l on l.LESSON_ID = lp.ID_LESSON
    INNER JOIN COURSES c ON c.COURSE_ID = l.ID_COURSE
    WHERE lp.ID_USER = new.ID_USER AND c.COURSE_ID = aux);

    IF lessonsB >= lessonsQ THEN
        INSERT INTO COURSES_PURCHASES(ID_COURSE, ID_USER, PURCHASE_DATE)
        VALUES(aux, NEW.ID_USER, CURRENT_TIMESTAMP());
    END IF;
END;
//

DROP TRIGGER IF EXISTS trig_add_comment;
DELIMITER //
CREATE TRIGGER trig_add_comment BEFORE INSERT ON COMMENTS
FOR EACH ROW
BEGIN
    IF NEW.QUALIFICATION < 0 THEN
        SET NEW.QUALIFICATION = 0;
    ELSEIF NEW.QUALIFICATION > 10 THEN
        SET NEW.QUALIFICATION = 10;
    END IF;
END;
//

DROP TRIGGER IF EXISTS trig_update_categories;
DELIMITER //
CREATE TRIGGER trig_update_categories BEFORE UPDATE ON CATEGORIES
FOR EACH ROW
BEGIN
    SET NEW.LAST_UPDATE_DATE = CURRENT_TIMESTAMP();
END;
//

DROP TRIGGER IF EXISTS trig_update_comments;
DELIMITER //
CREATE TRIGGER trig_update_comments BEFORE UPDATE ON COMMENTS
FOR EACH ROW
BEGIN
    SET NEW.LAST_UPDATE_DATE = CURRENT_TIMESTAMP();
END;
//

DROP TRIGGER IF EXISTS trig_update_courses;
DELIMITER //
CREATE TRIGGER trig_update_courses BEFORE UPDATE ON COURSES
FOR EACH ROW
BEGIN
    SET NEW.LAST_UPDATE_DATE = CURRENT_TIMESTAMP();
END;
//

DROP TRIGGER IF EXISTS trig_update_lessons;
DELIMITER //
CREATE TRIGGER trig_update_lessons BEFORE UPDATE ON LESSONS
FOR EACH ROW
BEGIN
    SET NEW.LAST_UPDATE_DATE = CURRENT_TIMESTAMP();
END;
//

DROP TRIGGER IF EXISTS trig_update_users;
DELIMITER //
CREATE TRIGGER trig_update_users BEFORE UPDATE ON USERS
FOR EACH ROW
BEGIN
    SET NEW.LAST_UPDATE_DATE = CURRENT_TIMESTAMP();
END;
//