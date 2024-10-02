<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class DB
{
    /**
     * @var DB|null
     */
    private static ?self $instance = null;
    /**
     * @var string
     */
    private string $connectionString;

    /**
     *
     */
    private function __construct()
    {
        $this->connectionString = "mysql:host=" . $_ENV['DB_HOST'] ."; port=" . $_ENV['DB_PORT'] . "; dbname=" . $_ENV['DB_NAME'] . "; charset=UTF8";
    }

    /**
     * @return PDO|PDOException
     */
    private function connectDb(): PDO|PDOException
    {
        try {
            return new PDO(
                $this->connectionString,
                $_ENV['DB_LOGIN'],
                $_ENV['DB_PASS'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
                ]
            );
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $query
     * @param array $param
     * @return bool|\PDOStatement
     */
    public static function Query($query, array $param = []): bool|\PDOStatement
    {
        $result = self::getInstance()->connectDb()->prepare($query);
        $result->execute($param);
        return $result;
    }

    /**
     * @param $query
     * @param array $param
     * @return array|bool
     */
    public static function Select($query, array $param = []): array|bool
    {
        if (self::Query($query, $param)) {
            return self::Query($query, $param)->fetchAll();
        }
        return false;
    }

    private function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    public function __wakeup(): void
    {
        // TODO: Implement __wakeup() method.
    }
}
