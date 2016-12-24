<?php

	include_once('functions.php');

	$ct1= 'create table Categories(id int not null auto_increment primary key, category varchar(64) unique
		)default charset="utf8"';


	$ct2='create table Items(id int not null auto_increment primary key,itemname varchar(32) unique, pricein int not null, pricesale int not null, 
          catid int, foreign key (catid) REFERENCES Categories(id) on delete cascade, info VARCHAR (255), rate INT, detein datetime, action int
		)default charset="utf8"';

	
	$ct3= 'create table Sales(id int not null auto_increment primary key, itemname varchar(32), FOREIGN KEY (itemname) REFERENCES Items (itemname),
          catid INT, FOREIGN KEY (catid) REFERENCES Categories(id), pricein INT, FOREIGN KEY (pricein) REFERENCES Items(pricein),
          pricesale int NOT NULL, datein datetime, FOREIGN KEY (datein) REFERENCES Items (datein), datesale datetime
		)default charset="utf8"';
	
	$ct4='create table Images(id int not null auto_increment primary key, iteamid int, FOREIGN KEY (itemid) REFERENCES Items(id),
          imagepath varchar(255
          )default charset="utf8"';

	$ct5='create table Users(id int not null auto_increment primary key, login varchar(32) unique, pass varchar(128), email varchar(128), avatar mediumblob, roleid int, 
        foreign key(roleid) references Roles(id) on delete cascade
        )default charset="utf8"';

    $ct6='create table Comments(id int not null auto_increment primary key, userid int, foreign key(userid) references Users(id), itemid int,
        foreign key(itemid) references Items(id), login varchar(32), foreign key(login) references Users(login),
        text varchar(1024) not null, datein datetime
        )default charset=utf8';

	connect();
	mysql_query($ct5);
	$err=mysql_errno();
	if($err) 
		{
			echo 'Alarm!'.$err.'<br />';
		}


?>