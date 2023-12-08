<?php

class country
{
    /**
     * @return array|false
     */
    public static function getAllCountries()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM countries");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function addCountry($name)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO countries (name) VALUES (?)");
        $stmt->bindValue(1, $name);
        $stmt->execute();
    }

    public static function deleteCountry($id)
    {
        try {
            global $conn;
            $stmt = $conn->prepare("DELETE FROM countries WHERE id = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
        } catch (PDOException) {
            return false;
        }
    }


}