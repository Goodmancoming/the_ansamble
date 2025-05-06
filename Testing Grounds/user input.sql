/* catatan template command untuk belajar wkwkwkwkwwkwkkwkkkwkw
written by : ahong


my own data tables
    1) users --yes yes
        A) id --an auto incrementing id for each user int(15)
        B) username --the users name varchar(31)
        C) passkey --hashed password varchar(31)
        D) email --the users email varchar(255)
        E) created_at --the date the user was created datetime
        F) web_roles --the roles the user has in the web application int(1) 0 is guest, 1 is user, 2 is admin
        G) user_desc --a description of the user varchar(255)

    2) comment --to store comments
        A) id --an auto incrementing id for each comment int(15)
        B) users_id --the id of the user who made the comment int(31)
        C) comment_message --the comment itself text
        D) created_at --the date the comment was made datetime

    3) chars --for the chars of me game
	char_id --id for chars, no need for autoincrement? int(15) NOT NULL,
    name --the chars name, duh varchar(31) not null,
    dob --date of birth, date not null,
    title -- the title for the chars varchar(255) not null DEFAULT "nameless",
    lore --lore text not null DEFAULT "no records"
thats it
    



=========================================================command to create tables=========================================================================================================================================================

CREATE TABLE literature (
	id int(4) NOT NULL AUTO_INCREMENT,
    title varchar(31) not null,
    book text not null,
    created_at datetime not null DEFAULT CURRENT_DATE,
    PRIMARY KEY(id)
	);

CREATE TABLE users (
	id int(15) NOT NULL AUTO_INCREMENT,
    username varchar(31) not null,
    passkey varchar(31) not null,
    email varchar(255),
    created_at datetime not null DEFAULT CURRENT_DATE,
    PRIMARY KEY(id)
	);

CREATE TABLE comments (
    id INT(15) not null AUTO_INCREMENT,
    users_id int(15),
    username varchar(31) not null,
    comment_message text not null,
    created_at datetime not null DEFAULT CURRENT_TIME,
    PRIMARY KEY(id),
    FOREIGN KEY(users_id) REFERENCES users(id) ON DELETE SET null
	)

==============================================================if you want to insert new data=================================================================================================
INSERT INTO users (username, passkey, email) VALUES ('username', 'passkey', 'email);


EXAMPLE:
INSERT INTO `users`(`username`, `passkey`, `email`) VALUES ('janedoe','janedoe','janedoe@gmail.com');



=========================================================================if you want to change/update existing data===============================================================================
UPDATE users SET username = 'newusername' WHERE id = 1;


EXAMPLE:
UPDATE `users`SET email = "janeedoe@gmail.com", passkey = "yomama" WHERE id=2;



=====================================================if you want to delete existing data==================================================================================================
DELETE FROM users WHERE id = 1;


EXAMPLE:
DELETE FROM 'users' where id = 2;























































































































