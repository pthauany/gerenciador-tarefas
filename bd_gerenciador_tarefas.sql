create database gerenciador_tarefas;
use gerenciador_tarefas;

create table tasks (
	id int auto_increment primary key,
    task_name varchar(190),
    task_description varchar(250),
    task_image varchar(50),
    task_date date
);