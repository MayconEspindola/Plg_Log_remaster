<?php

use app\config\database;
use MongoDB\BSON\Regex;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    public function testIfThereIsAConnection()
    {
        $conn = Database::getConnection();
        $this->assertInstanceOf(\MongoDB\Database::class, $conn);
    }

    public function testIfThereIsAResultNotNull()
    {
        $collectionName = 'DatabaseTest';
        $result = Database::getResultFromQuery($collectionName);
        $this->assertInstanceOf(\MongoDB\Driver\Cursor::class, $result);
    }

    public function testInsertDocument()
    {
        $collectionName = 'DatabaseTest';
        $document = ['Test' => 'abc123OI321cba'];
        $result = Database::insertDocument($collectionName, $document);
        $this->assertTrue($result);
    }

    public function testDeleteDocument()
    {
        $collectionName = 'DatabaseTest';
        $filter = ['Test' => 'abc123OI321cba'];
        Database::insertDocument($collectionName, $filter); // Insert a document for testing deletion
        $result = Database::deleteDocument($collectionName, $filter);
        $this->assertTrue($result);
    }

    public function testUpdateDocument()
    {
        $collectionName = 'DatabaseTest';
        $filter = ['Test' => 'abc123OI321cba'];
        $update = ['$set' => ['Test' => 'new_abc123OI321cba']];
        Database::insertDocument($collectionName, $filter); // Insert a document for testing update
        $result = Database::updateDocument($collectionName, $filter, $update);
        $this->assertTrue($result);
    }
}
?>