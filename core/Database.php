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

        $this->createTableMigrations();

        $bazaga_yozilgan_migrationlar = $this->bazaga_yozilgan_migrationlar();

        $migration_fayllar = scandir(Application::$ROOT_DIR . '/migrations');

        $bazaga_yozilmagan_migrationlar = array_diff($migration_fayllar, $bazaga_yozilgan_migrationlar);

        $migration_massiv = [];
        foreach ($bazaga_yozilmagan_migrationlar as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            require_once Application::$ROOT_DIR . "/migrations/$item";
            $classname = pathinfo($item, PATHINFO_FILENAME);

            $migration_class = new $classname();
            echo  date('Y-m-d h:i:s')."   ".$item."  ishga tushyapti\n";
            $migration_class->up();
            echo date('Y-m-d h:i:s')."  migration yakunlandi\n\n";

            $migration_massiv[] = $item;
        }

        if (!empty($migration_massiv)) {
            $this->bazaga_migrationlarni_yoz($migration_massiv);

        } else {
            echo "Hamma migrationlar migrate qilingan!\n";
        }
    }

    public function createTableMigrations()
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
        $natija = $this->pdo->prepare('select migration from migrations');
        $natija->execute();
        return $natija->fetchAll(\PDO::FETCH_COLUMN); // sub massiv li datani oddiy massiv qilib qaytaradi
    }

    protected function bazaga_migrationlarni_yoz(array $migration_massiv)
    {
//        $this->pdo->prepare('insert into migrations (migration) values
//        ("name1"),
//        ("name2")'); // bu korinishda birdaniga bazaga bir nechta roq qo'shadi

        // maqsad $migration_massivni
        // ("name1"),
        // ("name2")'   -----> ko'rinishga olib keliw
        $str = implode(',', array_map(fn($m) => "('$m')", $migration_massiv));
        $sql= $this->pdo->prepare("insert into migrations (migration) values $str");
        $sql->execute();
    }
}
