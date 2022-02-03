<?php

class m0004_change_users_status
{
    public function up(){
        $db=\app\core\Application::$app->db;
        $sql="ALTER TABLE users MODIFY COLUMN status tinyint not null default 0";
        $db->pdo->exec($sql);
    }

}
