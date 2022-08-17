
<?php
    Class Conexao{
        private $servername = "127.0.0.1";
        private $database = "mtr";
        private $username = "root";
        private $password = "1234";
        private $conexao;
// Create connection

    public function getConnection(){
        $conexao = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        if($conexao->connect_error){
            die("A conexão falhou : " . $conexao->connect_error);
        }
        //echo("Conexão estabelecida!");
        return $conexao;
    }

    
    }
?>