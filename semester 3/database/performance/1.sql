select * from emp where deptno=(select deptno from dept where loc='CHICAGO') and comm is not null

select job from emp group by job having count(*) > 3

select * from emp where hiredate=(select max(hiredate) from emp where deptno=30) and deptno=30

select loc,dname from dept where deptno in (select deptno from emp where comm is not null)

select job,sum(sal + nvl(comm,0)) from emp where EXTRACT(year FROM hiredate)=1982 group by job

select ename from emp where job in ('MANAGER', 'ANALYST') and mgr=(select empno from emp where ename='KING')

select * from emp where job=(select job from emp where ename='ALLEN') and ename != 'ALLEN'

select * from emp where job = (select job from emp where ename='BLAKE') or sal > (select sal from emp where ename='SMITH')

select * from emp where sal=(select max(sal) from emp where job='SALESMAN')

select * from emp where sal=(select max(sal) from emp where mgr=(select empno from emp where ename='KING'))

select * from emp where sal=(select max(sal) from emp where sal < (select max(sal) from emp))

select * from emp where sal=(select min(sal) from emp where sal > (select min(sal) from emp where sal > (select min(sal) from emp)))

select deptno,count(*) from emp where job='MANAGER' group by deptno having count(*)>=2

select sum(sal), job from emp where sal >1000 group by job having job in ('CLERK', 'ANALYST')

select loc from dept where deptno =(select deptno from emp group by deptno having count(*) = (select max(count(*)) from emp group by deptno))
