<?php
$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/docente.class.php';
require_once $path . '/models/db/conexao.php';

class DaoDocente
{
    public function login($matricula, $senha)
    {

        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM docente WHERE matricula LIKE'$matricula' and senha LIKE md5('$senha')";

        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $_SESSION['docente'] = $matricula;
            $conn->close();
            echo "<script> window.location.href='index.php?p=docente'</script> ";
        }else {
            echo "<script>alert('Dados incorretos.')</script>"; 
        }       

    }

    public function createDocente($docente)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "INSERT INTO docente(nome, senha, matricula, ativo) VALUES(?,MD5(?),?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi",  $nome, $senha, $matricula, $ativo);
        $matricula = $docente->getMatricula();
        $nome = $docente->getNome();
        $senha = $docente->getSenha();
        $ativo = $docente->getAtivo();
        $stmt->execute();
        echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
    }

    public function editDocente($matricula, $nome, $senha)
    {   
        
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $ativo = 0;
        echo $ativo;
        //$sql = "UPDATE `docente` SET `ativo` = $ativo WHERE `docente`.`matricula` = $matricula";
        
      //$sql = "UPDATE `docente` SET `nome` = $nome WHERE `docente`.`matricula` = $matricula";

        //$sql = "UPDATE `docente` SET `nome` = $nome WHERE `docente`.`matricula` = $matricula"; // erro; ja volto
        $sql = "UPDATE `docente` SET `nome` = ' $nome ', `senha` = md5(' $senha ') WHERE `docente`.`matricula` = '$matricula'";
        //      UPDATE `docente` SET `nome` = 'Adriano', `senha` = '123' WHERE `docente`.`matricula` = '50000';
        //echo $sql;
        if ($conn->query($sql)) {
            echo "<script>alert('O docente foi reajustado com sucesso, gg.')</script>";
            echo "<script> window.location.href='?p=admin'</script> ";
        } else {
            //echo $matricula;
            //echo $nome;
            //echo $senha;
            echo '

                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao editar o docente, perdemo.
                <br>
                <span class="badge bg-primary">contato: lemos.dayane.d@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }

    public function getAllActiveTeachers()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `docente` WHERE docente.ativo = 1";

        $result = $conn->query($sql);

        $teachers = null;

        while ($data = $result->fetch_object()) {
            $teachers[] = $data;
        }

        return $teachers;
    }

    public function getAllInactiveTeachers()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `docente` WHERE docente.ativo = 0";

        $result = $conn->query($sql);

        $teachers = null;

        while ($data = $result->fetch_object()) {
            $teachers[] = $data;
        }

        return $teachers;
    }

    public function alterarStatusAtivoDoDocente($matricula, $ativo)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        echo $ativo;
        if ($ativo == 1) {
            $ativo = 0;
        } else {
            $ativo = 1;
        }

        $sql = "UPDATE `docente` SET `ativo` = $ativo WHERE `docente`.`matricula` = $matricula";
              //UPDATE `docente` SET `nome` = 'Adriano', `senha` = '123' WHERE `docente`.`matricula` = '50000';
        //echo $sql;
        if ($conn->query($sql)) {
            echo "<script>alert('Cadastro reajustado com sucesso')</script>";
            echo "<script> window.location.href='?p=admin&adm=docentes'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao reajustar o docente, perdemo.
                <br>
                <span class="badge bg-primary">contato: lemos.dayane.d@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }

    public function getDocenteInfo($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT matricula, ativo, nome FROM docente WHERE matricula = " . $matricula;

        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $conn->close();
            return $row;
        } else {
            echo $conn->error;
        }
    }

    public function getDocenteObj($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT matricula, ativo, nome FROM docente WHERE matricula = " . $matricula;

        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_object();

            $conn->close();
            return $row;
        } else {
            echo $conn->error;
        }
    }



   
}
