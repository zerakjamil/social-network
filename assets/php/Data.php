<?php
session_start();
class Data {
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '') {
        $dsn = 'mysql:'. http_build_query($config, '', ';');
        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exception mode
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Default fetch mode
            ]);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function query($query, $params = []) {
        try {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $this;
    }

    public function find() {
        return $this->statement->fetch();
    }

    public function findOrFail() {
        $result = $this->find();
        if (!$result) {
            http_response_code(404);
            throw new \RuntimeException('Not Found'); // Throw an exception instead of setting HTTP response code
        }
        return $result;
    }

    public function all() {
        return $this->statement->fetchAll();
    }

    // Destructor to close the connection when the object is destroyed
    public function __destruct() {
        $this->connection = null;
    }
}