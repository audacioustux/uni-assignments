create table branch_info(
branch_id varchar(5) primary key,
branch_name varchar(26) not null,
city varchar(9)
);

create table employee_info(
emp_id varchar(10) primary key,
emp_name varchar(30) not null,
position varchar(20) not null,
salary number(5) not null,
supervisor varchar(10),
branch_id varchar(5) constraint emp_info_branch_fk references branch_info on delete cascade
);

drop table employee_info;

create table customer_info (
account varchar(10) primary key,
branch_id varchar(5) constraint cus_info_branch_fk references branch_info on delete cascade
)

create table bank_info(
account varchar(10) primary key,
name varchar(40) not null,
branch_id varchar(5) constraint bank_info_branch_fk references branch_info on delete cascade,
balance number(7),
opendate date
)

insert into branch_info values ('abc', 'firmgate', 'dhaka')
insert into branch_info values ('abd', 'mirput', 'dhaka');
insert into branch_info values ('abe', 'bashundhara', 'dhaka')
insert into branch_info values ('abv', 'shadar road', 'barishal')

insert into employee_info values ('18-38377-2', 'tanjim', 'kamnai', 99999, '16-44466-2', 'abc');
insert into employee_info values ('15-44466-1', 'rafsan', 'khayday', 4399, '16-44466-1', 'abc');
insert into employee_info values ('16-44466-1', 'jorina', 'kajerlok', 6589, '17-69643-2', 'abc');
insert into employee_info values ('14-44466-1', 'jorina', 'kajerlok', 6589, '17-69643-2', 'abc');
insert into employee_info values ('17-69643-2', 'morjina', 'gedarma', 2229, '18-38377-2', 'abd');

insert into bank_info values ('420222', 'joint account', 'abc', '40000', '02-jan-19');
insert into bank_info values ('434678', 'bong account', 'abd', '90000', '09-jan-19');
insert into bank_info values ('420463', 'high account', 'abc', '40000', '23-jan-19');
insert into bank_info values ('920463', 'biriyani account', 'abv', '33000', '11-jan-19');

alter table Employee_info add email varchar(255);

select * from Employee_info
update employee_info set email='morjina@gmail.com' where emp_id = '17-69643-2'

no. of emp.
select branch_id, count(*) from Employee_info group by branch_id;
sum of money in each branch
select bank_info.branch_id, sum(balance) from bank_info, branch_info where bank_info.branch_id=branch_info.branch_id group by branch_info.branch_id
emps working under morjina
select * from employee_info morjina, employee_info b where b.supervisor=morjina.emp_id and morjina.emp_name='morjina';
highest balance
select * from bank_info where balance=(select max(balance) from bank_info);
second largest salary
select * from employee_info where salary=(select max(salary) from employee_info where salary<(select max(salary) from employee_info));
salary less than jorina
select e.* from employee_info t, employee_info e where e.salary < t.salary and t.emp_name='tanjim'
max sal by branch with branch info
select employee_info.branch_id, branch_info.city, sum(salary) from employee_info, branch_info group by employee_info.branch_id, branch_info.city having sum(salary)=(select max(sum(salary)) from employee_info group by branch_id)
