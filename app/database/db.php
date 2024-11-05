<?php
session_start();
require 'c:\Xampp\htdocs\dynamic_website\app\database\connect.php';

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    echo '<br>';
}


/**
 * This function checks if a PDO query encountered any errors.
 * If an error is detected, it will print the error message and terminate the script.
 *
 * @param PDOStatement $query The PDOStatement object representing the executed query.
 *
 * @return bool Returns true if no errors were encountered, otherwise it will terminate the script.
 */
function dbCheckError($query)
{
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit;
    }
    return true;
}

// Функция которая позволяет получить данные с абсолютно любой таблицы
/**
 * This function retrieves all records from a specified table.
 *
 * @param string $table The name of the table from which to retrieve records.
 *
 * @return array An array containing all records from the specified table.
 *
 * @throws PDOException If an error occurs while executing the query.
 */
function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    // проверяем были ли переданы параметры
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql .=  " WHERE $key=:$key";
            } else {
                $sql .= " AND $key=:$key";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $query->bindValue(":$key", $value);
    }
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    // проверяем были ли переданы параметры
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql .=  " WHERE $key=:$key";
            } else {
                $sql .= " AND $key=:$key";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $query->bindValue(":$key", $value);
    }
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
};



/**
 * Inserts a new record into the specified table with the provided parameters.
 *
 * @param string $table The name of the table in which to insert the record.
 * @param array $params An associative array containing the column names as keys and their corresponding values as values.
 *
 * @throws InvalidArgumentException If the provided parameters array is empty.
 *
 * @return int The unique identifier of the newly inserted record.
 */
function insert($table, $params)
{
    global $pdo;

    // INSERT INTO `users` (admin, username, email, password) VALUES ('1', '44', 'for4@test.com' '4444');
    if (empty($params)) {
        throw new InvalidArgumentException("Params cannot be empty.");
    }

    $columns = '';
    $placeholders = '';
    $i = 0;

    foreach ($params as $key => $value) {
        if ($i === 0) {
            $placeholders .= ":$key";
            $columns .= $key;
        } else {
            $placeholders .= ", :" . $key;
            $columns .= ', ' . $key;
        }
        $i++;
    }

    $sql = "INSERT INTO $table ( $columns ) VALUES ( $placeholders )";

    // tt($sql);
    $query = $pdo->prepare($sql);
    $query->execute($params);
    $errors = dbCheckError($query);

    if ($errors != true) {
        echo $errors;
    }

    $id = $pdo->lastInsertId();
    // return an id of inserted array
    return $id;
};


/**
 * Updates a record in the specified table with the provided parameters.
 *
 * @param int $id The unique identifier of the record to update.
 * @param string $table The name of the table in which to update the record.
 * @param array $params An associative array containing the column names as keys and their corresponding values as values.
 *
 * @throws InvalidArgumentException If the provided ID is not numeric.
 *
 * @return bool
 */
function update($id, $table, $params)
{
    global $pdo;
    // if id isn`t numeric throw an error
    if (!is_numeric($id)) {
        throw new InvalidArgumentException("ID must be numeric.");
    }
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $sql .=  "$key=:$key";
        } else {
            $sql .= ", $key=:$key";
        }
        $i++;
    }
    $sql .= " WHERE id=$id";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    $errors = dbCheckError($query);

    if ($errors == true) {
        return true; // Record updated successfully
    } else {
        return false; // Error occurred while updating record
    }
}

/**
 * Deletes a record from the specified table based on the provided ID.
 *
 * @param int $id The unique identifier of the record to delete.
 * @param string $table The name of the table from which to delete the record.
 *
 * @throws InvalidArgumentException If the provided ID is not numeric.
 *
 * @return  bool;
 */
function deleteData($id, $table)
{
    global $pdo;

    if (!is_numeric($id)) {
        throw new InvalidArgumentException("ID must be numeric.");
    }

    $sql = "DELETE FROM $table WHERE id = :id";
    $query = $pdo->prepare($sql);

    $query->bindParam(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $errors = dbCheckError($query);

    if ($errors == true) {
        return true; // Record deleted successfully
    } else {
        return false;
    }
}

/**
 * Retrieves all posts along with their associated user information from the database.
 *
 * This function performs a SQL JOIN operation between two tables:
 * one containing posts and the other containing user information. 
 * It fetches specific columns from both tables for each post.
 *
 * @param string $table1 The name of the posts table.
 * @param string $table2 The name of the users table.
 * @return array An array of associative arrays, where each associative array represents a post 
 *               with details including the username of the associated user.
 */
function selectAllFromPostsWithUsers($table1, $table2)
{
    global $pdo; // Access the global PDO instance for database operations.

    // SQL query to select post details along with the associated username from the users table.
    $sql = "SELECT 
        t1.id,            // ID of the post
        t1.title,         // Title of the post
        t1.img,           // Image URL of the post
        t1.content,       // Content of the post
        t1.status,        // Publication status of the post
        t1.topic_id,      // Associated topic ID of the post
        t1.created_date,  // Creation date of the post
        t2.username       // Username of the user who created the post
        FROM $table1 AS t1 
        JOIN $table2 AS t2 ON t1.id_user = t2.id"; // Join condition based on user ID

    // Prepare the SQL statement for execution.
    $query = $pdo->prepare($sql);

    // Execute the prepared statement.
    $query->execute();

    // Check for any database errors.
    dbCheckError($query);

    // Fetch all results as an associative array and return it.
    return $query->fetchAll();
}
