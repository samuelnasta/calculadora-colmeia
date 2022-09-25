<?php
/**
 * Class that connects to the database using PDO
 * 
 * The constants are defined in access secret file
 */

class DB extends PDO {
    private $_host, $_database, $_user, $_password, $_connection;

    public function __construct(){
        $this->_host = DB_HOST;
        $this->_database = DB_DATABASE;
        $this->_user = DB_USER;
        $this->_password = DB_PASSWORD;

        try {
            $this->_connection = parent::__construct(
                "mysql:host=$this->_host;dbname=$this->_database;charset=utf8mb4",
                $this->_user,
                $this->_password
            );
            parent::setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            parent::setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_OBJ
            );
        }
        catch (PDOException $error) {
            echo 'Error: ' . $error->getMessage();
        }
    }


    /**
	 * Prepare a query and filters results
	 *
	 * @param string $query         The SQL query
	 * @param string $params        The binding pairs to be executed in query
	 * @param string $limit         Limit only the first result
     * 
	 * @return string               Data retrieved from database query
	 */
    public function get($sql, $params = null, $limit = null) {

        $query = $this->prepare($sql);
        $query->execute($params);
        $results = $query->fetchAll();
        
        if($limit === 1) {
            return $results[0];
        } else {
            return $results;
        }
    }


    /**
	 * Insert a row using the provided parameters
	 *
	 * @param string $table         Table name for data to be inserted
	 * @param string $params        The binding pairs to be executed in query
     * 
	 * @return int                  Number of rows affected
	 */
    public function set($table, $params = null) {
        $fields = implode(",", array_keys($params));
        $values = implode(", :", array_keys($params));

        $sql = "INSERT INTO $table
        ($fields)
        VALUES (:$values)";

        foreach ($params as $key => $value) {
            $bind_params[":$key"] = $value;
        }
        
        $query = $this->prepare($sql);
        $query->execute($bind_params);

        return $query->rowCount();
    }


    /**
	 * Delete a row from table
	 *
	 * @param string $table         Table name for data to be deleted
	 * @param string $id            The id to be removed
     * 
	 * @return int                  Number of rows affected
	 */
    public function delete($table, $id) {
        $bind_param = array(':id' => $id);

        $sql = "DELETE FROM $table
        WHERE id = :id";

        $query = $this->prepare($sql);
        $query->execute($bind_param);

        return $query->rowCount();
    }

}