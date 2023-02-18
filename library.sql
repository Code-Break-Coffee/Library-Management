use library;

create table admin(
  Username varchar(50) not null,
  Password varchar(16) not null,
  primary  key(Username)
);

insert into admin values('admin',12345678);

use library;
create table books(
  Book_No varchar(10) not null,
  Author varchar(50) not null,
  Title varchar(30) not null,
  Edition varchar(15) not null,
  Publisher varchar(50) not null,
  Total_Pages int not null,
  Cost int not null,
  Supplier varchar(50) not null,
  Bill_No varchar(20),
  primary key(Book_No)
);

create table student(
  Student_Rollno varchar(20) not null,
  Student_Name varchar(50) not null,
  Student_Course varchar(50) not null,
  Student_Enrollmentno varchar(20) not null,
  Student_Book1 varchar(10) default null,
  Student_Book2 varchar(10) default null,
  Student_Book3 varchar(10) default null,
  primary key(Student_Rollno)
);

create table faculty(
  Faculty_ID varchar(20) not null,
  Faculty_Name varchar(50) not null,
  Faculty_Type varchar(20) not null,
  Faculty_Fatherorhusband varchar(50) not null,
  Faculty_Book1 varchar(10) default null,
  Faculty_Book2 varchar(10) default null,
  Faculty_Book3 varchar(10) default null,
  Faculty_Book4 varchar(10) default null,
  Faculty_Book5 varchar(10) default null,
  primary key(Faculty_ID)
);

create table issue_return(
  Issue_No int not null AUTO_INCREMENT,
  Issue_By varchar(20) not null,
  Issue_Bookno varchar(10) not null,
  Issue_Date date not null,
  Return_Status varchar(20) default 'Not returned' not null,
  Return_Date date default null,
  primary key(Issue_No)
);
use library;

alter table issue_return
add constraint issue
foreign key(Issue_Bookno) references books(Book_No);

alter table issue_return
add constraint issue_student
foreign key(Issue_By) references student(Student_Rollno);

alter table issue_return
add constraint issue_faculty
foreign key(Issue_By) references faculty(Faculty_ID);

alter table faculty
add constraint faculty_1
foreign key(Faculty_Book1) references books(Book_No);

alter table faculty
add constraint faculty_2
foreign key(Faculty_Book2) references books(Book_No);

alter table faculty
add constraint faculty_3
foreign key(Faculty_Book3) references books(Book_No);

alter table faculty
add constraint faculty_4
foreign key(Faculty_Book4) references books(Book_No);

alter table faculty
add constraint faculty_5
foreign key(Faculty_Book5) references books(Book_No);

alter table student 
add constraint student_1 
foreign key(Student_Book1) references books(Book_No);

alter table student 
add constraint student_2
foreign key(Student_Book2) references books(Book_No);

alter table student 
add constraint student_3
foreign key(Student_Book3) references books(Book_No);