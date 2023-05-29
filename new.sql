create database if not exists library;
use library;
-- drop database library;

create table if not exists books(
  Book_No int(10) not null, 
  Author varchar(50) not null,
  Title varchar(30) not null,
  Edition varchar(15) not null,
  Publisher varchar(50) not null,
  Total_Pages int not null,
  Cost int not null,
  Supplier varchar(50),
  Bill_No varchar(20),
  Status varchar(20) default "Available",
  primary key(Book_No)
);

create table if not exists student(
  Student_Rollno varchar(20) not null,
  Student_Name varchar(50) not null,
  Student_Course varchar(50) not null,
  Student_Enrollmentno varchar(20) not null,
  primary key(Student_Rollno)
);

create table if not exists faculty(
  Faculty_ID varchar(20) not null,
  Faculty_Name varchar(50) not null,
  Faculty_Type varchar(20) not null,
  Faculty_Fatherorhusband varchar(50) not null,
  primary key(Faculty_ID)
);

create table if not exists member(
    Member_ID varchar(20) not null,
    MemberType
    Book_Issue1 int(10) default null,
    Book_Issue2 int(10) default null,
    Book_Issue3 int(10) default null,
    Book_Issue4 int(10) default null,
    Book_Issue5 int(10) default null,
    Book_Issue6 int(10) default null,
    Book_Issue7 int(10) default null,
    Book_Issue8 int(10) default null,
    Book_Issue9 int(10) default null,
    Book_Issue10 int(10) default null,
    primary key(Member_ID)
);

create table if not exists issue_return(
  Issue_No int not null AUTO_INCREMENT,
  Issue_By varchar(20) not null,
  Member_Type varchar(8) not null,
  Issue_Bookno int(10) not null,
  Issue_Date date not null,
  Return_Date date default null,
  primary key(Issue_No)
);

alter table student add constraint student_member
    foreign key(Student_Rollno) references member(Member_ID);

alter table faculty add constraint faculty_member
    foreign key(Faculty_ID) references member(Member_ID);

alter table issue_return add constraint Issue_Book
    foreign key(Issue_Bookno) references books(Book_No);

alter table issue_return add constraint Issue_member
    foreign key(Issue_By) references member(Member_ID);

alter table member add constraint bk1
    foreign key(Book_Issue1) references books(Book_No);

alter table member add constraint bk2
    foreign key(Book_Issue2) references books(Book_No);

alter table member add constraint bk3
    foreign key(Book_Issue3) references books(Book_No);

alter table member add constraint bk4
    foreign key(Book_Issue4) references books(Book_No);

alter table member add constraint bk5
    foreign key(Book_Issue5) references books(Book_No);

alter table member add constraint bk6
    foreign key(Book_Issue6) references books(Book_No);

alter table member add constraint bk7
    foreign key(Book_Issue7) references books(Book_No);

alter table member add constraint bk8
    foreign key(Book_Issue8) references books(Book_No);

alter table member add constraint bk9
    foreign key(Book_Issue9) references books(Book_No);

alter table member add constraint bk10
    foreign key(Book_Issue10) references books(Book_No);