<?php
session_start();
 
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';
require __DIR__ . 'classSupplier.php';
require __DIR__ . 'classProduct.php';
 
interface Formulario {
    public function getDados();
}
 
class FormularioBase implements Formulario {
    protected $dados = [];
 
    public function getDados(){
        return $this->dados;
    }
}
 
class Cadastro {
    private $formularios = [];
 
    public function addForm(Formulario $formulario) {
        $this->formularios[] = $formulario;
    }
 
    public function register(){
        $dadosCadastro = [];
 
        foreach($this->formularios as $formulario) {
            $dadosCadastro = array_merge($dadosCadastro, $formulario->getDados());
        }
        var_dump($dadosCadastro);
        echo "Cadastro realizado com sucesso!";
    }
}
 
?>