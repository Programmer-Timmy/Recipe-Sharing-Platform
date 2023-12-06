<?php

class comments
{
    /**
     * @param $id
     * @return array|false
     */
    public static function getCommentsByRecipeId($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT comments.id, users.id as user_id, comment, timestamp, rating, username, users.img_url, recipes.title FROM comments join users on comments.users_id = users.id join recipes on comments.recipes_id = recipes.id WHERE recipes_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $comment
     * @param $rating
     * @param $recipe_id
     * @param $user_id
     * @return bool
     */
    public static function createComment($comment, $rating, $recipe_id, $user_id)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO comments (comment, rating, recipes_id, users_id) VALUES (?, ?, ?, ?)");
        $stmt->bindValue(1, htmlspecialchars($comment));
        $stmt->bindValue(2, $rating);
        $stmt->bindValue(3, $recipe_id);
        $stmt->bindValue(4, $user_id);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteComment($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @return $0|false|object|stdClass|null
     */
    public static function getCommentsByUserAndProductId($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM comments WHERE users_id = ? AND recipes_id = ?");
        $stmt->bindValue(1, $_SESSION['userId']);
        $stmt->bindValue(2, $id);
        $stmt->execute();
        return $stmt->fetchObject();

    }

    /**
     * @param $id
     * @param $comment
     * @param $rating
     * @return bool
     */
    public static function updateComment($id, $comment, $rating, $user_id)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE comments SET comment = ?, rating = ? WHERE id = ? and users_id = ?");
        $stmt->bindValue(1, htmlspecialchars($comment));
        $stmt->bindValue(2, $rating);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $user_id);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteCommentsByRecipeId($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM comments WHERE recipes_id = ?");
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteCommentsByUserId($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM comments WHERE users_id = ?");
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    /**
     * @param $user
     * @param $recipe
     * @return mixed
     */
    public static function getCommentsByUserAndRecipe($user, $recipe)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT comments.*, users.username, recipes.title FROM comments join users on comments.users_id = users.id join recipes on comments.recipes_id = recipes.id WHERE recipes_id = ? AND users_id = ?");
        $stmt->bindValue(1, $recipe);
        $stmt->bindValue(2, $user);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return array|false
     */
    public static function getCommentsByUserId($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT comments.*, users.username, recipes.title FROM comments join users on comments.users_id = users.id join recipes on comments.recipes_id = recipes.id WHERE users_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}