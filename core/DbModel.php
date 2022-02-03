<?php

namespace app\core;

abstract class DbModel extends Model
{
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
            $baza->bindValue($attribute,$this->{$attribute});

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
