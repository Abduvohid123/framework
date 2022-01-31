<?php

class m0004_add_password_column_to_users
{
    public function up(){
        $db=\app\core\Application::$app->db;
        $sql='alter table users add column password varchar(512) not null';
        $db->pdo->exec($sql);
    }

}
