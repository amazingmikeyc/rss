<?php

namespace Rss\RSSFeed;

use Rss\Database\Database;

/**
 * Methods for getting data from and putting  feed data in the 
 * database
 */
class Repository {
    
    /**
     *
     * @var Database
     */
    private $dbConnection;
    
    /**
     * Constructor
     * 
     * @param Database $dbConnection
     */
    public function __construct(Database $dbConnection) 
    {
        $this->dbConnection = $dbConnection;
    }
    
    /**
     * Get a list of all the feeds we have saved
     * 
     * @return array
     */
    public function getAllFeeds()
    {
        $sql = 'SELECT id, uri FROM feed ORDER BY timestamp DESC';
        $statement = $this->dbConnection->execute($sql, []);
      
        return $statement->fetchAll();
    }
    
    /**
     * Get the uri of a given feed
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getFeed($id)
    {
        $sql = 'SELECT uri FROM feed WHERE id = ? ';
        $statement = $this->dbConnection->execute($sql, [$id]);
    
        return $statement->fetch();
    }
    
       
    /**
     * Add a feed into the list
     * 
     * @param string $uri
     */
    public function addFeed($uri)
    {
        $sql = 'INSERT INTO feed (uri, timestamp) VALUES (?, ?)';
        $statement = $this->dbConnection->execute($sql, [$uri, date('Y-m-d H:i:s')]);
    
    }
    
    
    /**
     * Remove a feed from the list
     * 
     * @param int $id
     */
    public function removeFeed($id)
    {
        $sql = 'DELETE FROM feed WHERE id = ?';
        $statement = $this->dbConnection->execute($sql, [$id]);
    
    }
}
