<?php

namespace app\core;

abstract class DbModel extends Model
{
    public static function findOne(array $where)//  where = [email => '',  password => '' ]
    {

        $tablename = static::tableName(); // users

        $attributes = array_keys($where);

        // select $tablename where email = :email and firstname = :firstname;  vahokazo...

        $sql = implode('and', array_map(fn($attr) => "$attr = :$attr", $attributes));

        // select $tablename where $sql

        $baza=self::prepare("select * from $tablename where $sql");

        foreach ($where as $key=> $item) {
            $baza->bindValue(":$key",$item);

        }
        $baza->execute();

//       return $baza->fetchObject();     bu holda object qaytaradi lekin qaysi klasga tegishli ekani malum emas
        return $baza->fetchObject(static::class); // bunda clasi malum


    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($attr) => ":$attr", $attributes);
        $column_names = implode(',', $attributes);
        $column_values = implode(',', $params);

        $sql = "insert into $tableName ($column_names) values ($column_values)";

        $baza = self::prepare($sql);

        foreach ($attributes as $attribute) {
            $baza->bindValue($attribute, $this->{$attribute});

        }
        $baza->execute();
        return true;
    }

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

}
