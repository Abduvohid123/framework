<?php

namespace app\core;

// composer require vlucas/phpdotenv
class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'];
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }


    public function runMigrations()
    {

        $this->createTAbleMigrations();
        var_dump(        $this->bazaga_yozilgan_migrationlar());
    }

    public function createTAbleMigrations()
    {
        $this->pdo->exec(
            "create table if not exists migrations (
                      id int auto_increment primary key ,
                      migration varchar(256),
                      created_at timestamp default current_timestamp
                      ) ENGINE=INNODB;"
        );
    }

    public function bazaga_yozilgan_migrationlar()
    {
       $natija= $this->pdo->prepare('select migration from migrations');
       $natija->execute();
       return $natija->fetchAll(\PDO::FETCH_COLUMN); // sub massiv li datani oddiy massiv qilib qaytaradi
    }
}
