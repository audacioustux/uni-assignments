create table users (
    id number,
    handle varchar2(40) NOT NULL,
    name varchar2(80),
    creation_date TIMESTAMP WITH TIME ZONE NOT NULL,
    password varchar2(255) NOT NULL,
    CONSTRAINT pk_users PRIMARY KEY(id)
);

create table email_verification(
    email varchar2(255),
    key number(6) not null,
    CONSTRAINT pk_email_verification PRIMARY KEY(email)
);

create table email(
email varchar2(255),
author number constraint user_email_id_fk references users on delete cascade,
is_primary char check (is_primary in (0,1)),
for_recovery char check (for_recovery in (0,1)),
for_digest char check (for_digest in (0,1)),
CONSTRAINT pk_email PRIMARY KEY(email)
);

create table tag(
id number,
name varchar2(64) NOT NULL,
description varchar2(255),
CONSTRAINT pk_tag PRIMARY KEY(id)
);

create table category(
id number,
name varchar2(64) NOT NULL,
description varchar2(255),
CONSTRAINT pk_category PRIMARY KEY(id)
);

create table cat_tag(
cat_id number constraint cat__cat_tag_id_fk references category on delete cascade,
tag_id number constraint tag__cat_tag_id_fk references tag on delete cascade,
CONSTRAINT unique__cat_tag UNIQUE(cat_id, tag_id)
);

create table blog(
id number,
author number constraint blog_author_id_fk references users on delete cascade,
title varchar2(128),
slug varchar2(128) not null,
excerpt varchar2(255),
content varchar2(4000),
category number constraint blog_category_id_fk references users on delete cascade,
CONSTRAINT pk_blog PRIMARY KEY(id)
);

create table blog_tag(
blog_id number constraint blog__blog_tag_id_fk references blog on delete cascade,
tag_id number constraint tag__blog_tag_id_fk references tag on delete cascade,
CONSTRAINT unique__blog_tag UNIQUE(blog_id, tag_id)
);

insert into users(id, handle, name, creation_date, password) values(1, 'tux', 'Tanjim hossain', sysdate, '1234');
insert into users(id, handle, name, creation_date, password) values(2, 'tux3', 'Tanjim hossain3', sysdate, '1234');
insert into users(id, handle, name, creation_date, password) values(3, 'tux2', 'Tanjim hossain4', sysdate, '1234');
insert into users(id, handle, name, creation_date, password) values(4, 'tuxq', 'Tanjim hossain7', sysdate, '1234');
insert into users(id, handle, name, creation_date, password) values(5, 'tuxa', 'Tanjim hossain9', sysdate, '1234');

insert into email(email, author) values('tangimhossain1@gmail.com', 1);
insert into email(email, author) values('tangimhossain12@gmail.com', 1);
insert into email(email, author) values('tangimhossain13@gmail.com', 2);
insert into email(email, author) values('tangimhossain14@gmail.com', 4);
insert into email(email, author) values('tangimhossain15@gmail.com', 1);

insert into email_verification(email, key) values('tangimhossain1@gmail.com', 43523);
insert into email_verification(email, key) values('tangimhossain12@gmail.com',43523);
insert into email_verification(email, key) values('tangimhossain13@gmail.com',43523);
insert into email_verification(email, key) values('tangimhossain14@gmail.com',43523);
insert into email_verification(email, key) values('tangimhossain15@gmail.com',43523);

insert into blog(id, author, slug, title, content) values(1, 2, 'sdf0e3d-dsd',  'abcdcedsdf', '1234');
insert into blog(id, author, slug, title, content) values(2, 2, 'sdf0e3d-dsd3', 'abcdcedsdf', '1234');
insert into blog(id, author, slug, title, content) values(3, 1, 'sdf0e3d-dsd4', 'abcdcedsdf', '1234');
insert into blog(id, author, slug, title, content) values(4, 3, 'sdf0e3d-dsd7', 'abcdcedsdf', '1234');
insert into blog(id, author, slug, title, content) values(5, 2, 'sdf0e3d-dsd9', 'abcdcedsdf', '1234');
 
insert into tag(id, name) values(1, 'dsfef3ds');
insert into tag(id, name) values(2, 'dsfef3ds4');
insert into tag(id, name) values(3, 'dsfef3ds4');
insert into tag(id, name) values(4, 'dsfef3ds4');
insert into tag(id, name) values(5, 'dsfef3ds4');

insert into category(id, name) values(1, 'dsfef3ds4');
insert into category(id, name) values(2, 'dsfef3ds4');
insert into category(id, name) values(3, 'dsfef3ds4');
insert into category(id, name) values(4, 'dsfef3ds4');
insert into category(id, name) values(5, 'dsfef3ds4');

insert into cat_tag values (1,1);
insert into cat_tag values (1,2);
insert into cat_tag values (2,2);
insert into cat_tag values (2,1);
insert into cat_tag values (1,3);

insert into blog_tag values (2,5);
insert into blog_tag values (1,2);
insert into blog_tag values (4,2);
insert into blog_tag values (3,1);
insert into blog_tag values (1,3);

update blog set category=1 where id=2;


select tag.* from tag, cat_tag where cat_id in (select category from blog where id=2) and cat_tag.tag_id = tag.id
select blog.* from blog_tag, blog where blog_tag.tag_id = 2 and blog.id=blog_tag.blog_id
select email_verification.email from email, email_verification where email.email = email_verification.email
select tag.* from tag where tag.id in (select tag_id from blog_tag where blog_tag.blog_id=2) or tag.id in ((select tag.id from tag, cat_tag where cat_id in (select category from blog where id=2) and tag.id in cat_tag.tag_id))
select email.*, users.* from users, email where email.is_primary=1 and email.author = users.id
select u.* from users t, users u where t.creation_date <= u.creation_date and t.handle='tux'
