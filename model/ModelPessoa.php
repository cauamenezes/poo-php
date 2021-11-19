<?php

class ModelPessoa{

    private $_conn;
    private $_codPessoa;
    private $_nome;
    private $_sobrenome;
    private $_email;
    private $_celular;
    private $_fotografia;

    public function __construct($conn) {

        //PERMITE RECEBER DADOS JSON ATRAVÉS DA REQUISIÇÃO
        $json = file_get_contents("php://input");
        $dadosPessoa = json_decode($json);

        //RECEBIMENTO DOS DADOS DO POSTMAN:
        $this->_codPessoa = $dadosPessoa->cod_pessoa ?? null;
        $this->_nome = $dadosPessoa->nome ?? null;
        $this->_sobrenome = $dadosPessoa->sobrenome ?? null;
        $this->_email = $dadosPessoa->email ?? null;
        $this->_celular = $dadosPessoa->celular ?? null;
        $this->_fotografia = $dadosPessoa->fotografia ?? null;

        $this->_conn = $conn;
    }

    public function findAll() {

        //MONTA A INSTRUÇÃO SQL
        $sql = "SELECT * from tbl_pessoa";

        //PREPARA UM PROCESSO DE EXECUÇÃO DE INSTRUÇÃO SQL
        $statement = $this->_conn->prepare($sql);

        //EXECUTA A INSTRUÇÃO SQL
        $statement->execute();

        //DEVOLVE OS VALORES DA SELECT PARA SEREM UTILIZADOS
        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function findById() {

        $sql = "SELECT * FROM tbl_pessoa WHERE cod_pessoa = ?";

        $statement = $this->_conn->prepare($sql);
        $statement->bindValue(1, $this->_codPessoa);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create() {

        $sql = "INSERT INTO tbl_pessoa(nome, sobrenome, email, celular, fotografia)
                VALUES (?, ?, ?, ?, ?)";

        $statement = $this->_conn->prepare($sql);

        $statement->bindValue(1, $this->_nome);
        $statement->bindValue(2, $this->_sobrenome);
        $statement->bindValue(3, $this->_email);
        $statement->bindValue(4, $this->_celular);
        $statement->bindValue(5, $this->_fotografia);

        $statement->execute();

        if ($statement->execute()) {
            return "Success";
        } else {
            return "Error";
        }
    }

}

?>
