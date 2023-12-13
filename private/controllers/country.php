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

    /**
     * @param $name
     * @return void
     */
    public static function addCountry($name)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO countries (name) VALUES (?)");
        $stmt->bindValue(1, $name);
        $stmt->execute();
    }

    /**
     * @param $id
     * @return false|void
     */
    public static function deleteCountry($id)
    {
        try {
            global $conn;
            $stmt = $conn->prepare("DELETE FROM countries WHERE id = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }


}