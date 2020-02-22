<?php

class Store
{

    protected $settings;
    protected static $tables;

    public function __construct()
    {
        $this->settings = App::getSettings();
    }

    public function getTables() {
        self::$tables = [
            'users' => ['login', 'password', 'created_at', 'updated_at', 'deleted_at', 'group_id'],
            'orders' => [
                'owner_login', 'status', 'place_from', 'place_to',
                'description', 'driver', 'cost', 'car_class',
                'created_at', 'updated_at', 'deleted_at'],
        ];

        $RESULT = [];
        foreach (self::$tables as $tableName => $value) {
            $query = APP::getConnection()->prepare("SELECT * FROM {$tableName} WHERE deleted_at = '0'");
            $query->execute();
            $RESULT[$tableName] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $RESULT;
    }

    public static function createRow($row, $tableName) {
        $row['created_at'] = mktime();

        // prepare data
        $fields = [];
        $fieldKeys = [];
        $fieldValues = [];
        foreach (self::$tables[$tableName] as $columnName) {
            if (isset($row[$columnName])) {
                $fields[':' . $columnName] = $row[$columnName];
                $fieldKeys[] = $columnName;
                $fieldValues[] = ':' . $columnName;
            }
        }

        // form sql
        $strKeys = join(',', $fieldKeys);
        $strValues = join(',', $fieldValues);
        $strSql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strValues})";

        $sql = App::getConnection()->prepare($strSql);
        return $sql->execute($fields);
    }

    public static function updateRow($row, $tableName) {
        $row['updated_at'] = mktime();

        // prepare data
        $fields = [];
        $fieldKeys = [];
        foreach (self::$tables[$tableName] as $columnName) {
            if (isset($row[$columnName])) {
                $fields[':' . $columnName] = $row[$columnName];
                $fieldKeys[] = $columnName . '=' . ':' . $columnName;
            }
        }
        $fields[':id'] = $row['id'];

        // form sql
        $strKeys = join(',', $fieldKeys);
        $strSql = "UPDATE {$tableName} SET {$strKeys} WHERE id=:id";


        $sql = App::getConnection()->prepare($strSql);
        return $sql->execute($fields);

    }


}