<?php

class country
{
    public static function getAllCountries()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM countries");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}