<?php

namespace work\config;

require __DIR__ . '/../../vendor/autoload.php';


class EnvironmentSettings {
    private $env;

    public function __construct() {
        $envFilePath = __DIR__ . '/../env.ini';

        if (!file_exists($envFilePath)) {
            throw new \Exception("Arquivo env.ini não encontrado.");
        }

        $this->env = parse_ini_file($envFilePath, true);
    }

    public function obterConfiguracoes() {
        return $this->env;
    }
}