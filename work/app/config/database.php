<?php

namespace app\config;

require_once __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;

class Database
{
    public static function getConnection()
    {
        try {
            $envSettings = new EnvironmentSettings();
            $env = $envSettings->obterConfiguracoes();

            $uri = sprintf(
                'mongodb://%s:%s@%s:%s',
                $env['DATABASE']['username'],
                $env['DATABASE']['password'],
                $env['DATABASE']['host'],
                $env['DATABASE']['porta']
            );

            $client = new Client($uri);
            return $client->selectDatabase($env['DATABASE']['database']);
        } catch (\Exception $e) {
            die("Erro ao conectar ao MongoDB: " . $e->getMessage());
        }
    }
    
    public static function getResultFromQuery($collectionName, $filter = [])
    {
        $database = self::getConnection();

        if ($database === null) {
            return null;
        }

        $collection = $database->selectCollection($collectionName);

        try {
            $result = $collection->find($filter);
            return $result;
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }

    public static function insertDocument($collectionName, $document)
    {
        $database = self::getConnection();

        if ($database === null) {
            return false;
        }

        $collection = $database->selectCollection($collectionName);

        try {
            $collection->insertOne($document);
            return true;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            die("Erro ao inserir documento: " . $e->getMessage());
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            die("Erro ao inserir documento: " . $e->getMessage());
        }
    }

    public static function deleteDocument($collectionName, $filter)
    {
        $database = self::getConnection();

        if ($database === null) {
            return false;
        }

        $collection = $database->selectCollection($collectionName);

        try {
            $collection->deleteOne($filter);
            return true;
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            die("Erro ao excluir documento: " . $e->getMessage());
        }
    }

    public static function updateDocument($collectionName, $filter, $update)
    {
        $database = self::getConnection();

        if ($database === null) {
            return false;
        }

        $collection = $database->selectCollection($collectionName);

        try {
            $collection->updateOne($filter, $update);
            return true;
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            die("Erro ao atualizar documento: " . $e->getMessage());
        }
    }
}
?>