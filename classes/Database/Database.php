<?php

namespace Rss\Database;
/**
 * A class to abstract out the database connection, in case we
 * want to change how we connect.
 * 
 */
class Database {
    
    /**
     *
     * @var \PDO
     */
    private $connection;
    
    /**
     * Constructor
     * 
     * @param \PDO $databaseConnection
     */
    public function __construct(\PDO $databaseConnection) 
    {
        $this->connection = $databaseConnection;
    }
    
    /**
     * Execute a PDO query
     * 
     * @param type $query
     * @param array $values
     * 
     * @return \PDOStatement
     */
    public function execute($query, array $values)
    {
        $statement = $this->connection->prepare($query);
                
        $statement->execute($values);
        
        return $statement;
    }
    
}