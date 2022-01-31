<?php

class m0003create_users_table
{
    public function up()
    {
    $db=\app\core\Application::$app->db;
    $sql="create table users
    (
        id int auto_increment primary key,
        email varchar(256) not null ,
        firstname varchar(256) not null ,
        lastname varchar (256) not null,
        status tinyint not null,
        created_at timestamp default current_timestamp
     ) ENGINE = INNODB;";
    $db->pdo->exec($sql);
    }

    public function down()
    {
        $db=\app\core\Application::$app->db;
        $sql="drop table users;";
        $db->pdo->exec($sql);

    }
}
