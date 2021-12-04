USE db_conteneurisation;
CREATE table universities(id INT  PRIMARY KEY  AUTO_INCREMENT, name_u varchar(50),  domain_u varchar(20), img varchar(100));

insert into universities values(1,"Université Moulay Ismail","umi.ac.ma", "imgs\/1.jpg");
insert into universities values(2,"Université Ibn Tofail","uit.ac.ma", "imgs\/2.png");
insert into universities values(3,"Université Mohammed 5","um5.ac.ma", "imgs\/3.jfif");