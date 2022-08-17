<?php
$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/discente.class.php';
require_once $path . '/models/db/conexao.php';

class DaoDiscente
{
    public function login($matricula, $senha)
    {

        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM discente WHERE matricula LIKE'$matricula' and senha LIKE md5('$senha')";

        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $_SESSION['discente'] = $matricula;
            $conn->close();
            echo "<script> window.location.href='index.php?p=discente'</script> ";
        }else {
            echo "<script>alert('Dados incorretos.')</script>"; 
        }       

    }

    public function alterarStatusAtivoDoDiscente($matricula, $ativo)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        if ($ativo == 1) {
            $ativo = 0;
        } else {
            $ativo = 1;
        }

        $sql = "UPDATE `discente` SET `ativo` = $ativo WHERE `discente`.`matricula` = $matricula";
        if ($conn->query($sql)) {
            echo "<script> window.location.href='?p=admin&adm=discentes'</script> ";
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

    public function getAllActiveDiscentes()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `discente` WHERE discente.ativo = 1 ORDER BY discente.nome";

        $result = $conn->query($sql);

        $discentes = null;

        while ($data = $result->fetch_object()) {
            $discentes[] = $data;
        }

        return $discentes;
    }
    
    public function getAllInactiveDiscentes()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `discente` WHERE discente.ativo = 0 ORDER BY discente.nome";

        $result = $conn->query($sql);

        $discentes = null;

        while ($data = $result->fetch_object()) {
            $discentes[] = $data;
        }

        return $discentes;
    }

    public function createDiscente($discente)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "INSERT INTO discente(nome, senha, matricula, fk_curso, ativo, monitor) VALUES(?,MD5(?),?,?,?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssiii",  $nome, $senha, $matricula, $fk_curso, $ativo, $monitor);
        $matricula = $discente->getMatricula();
        $nome = $discente->getNome();
        $senha = $discente->getSenha();
        $ativo = $discente->getAtivo();
        $monitor = $discente->getMonitor();
        $fk_curso = $discente->getFKCurso();
        $stmt->execute();        
    }

    public function editDiscente($matricula, $nome, $senha, $fk_curso)
    {          
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        $sql = "UPDATE `discente` SET `nome` = ' $nome ', `senha` = md5(' $senha '), `fk_Curso` = $fk_curso WHERE `discente`.`matricula` = '$matricula'";

        if ($conn->query($sql)) {
            echo "<script>alert('O discente foi editado com sucesso, gg.')</script>";
            echo "<script> window.location.href='?p=admin'</script> ";
        } else {
            //echo $matricula;
            //echo $nome;
            //echo $senha;
            echo '

                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao editar o discente, perdemo.
                <br>
                <span class="badge bg-primary">contato: lemos.dayane.d@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }



    public function update($discente)
    {
        $sql = "UPDATE discente SET matricula = ?, 
            nome = ?, curso = ?, senha MD5(?)
            WHERE id_discente = " . $discente->getIdDiscente();
        $con = new Conexao();
        $con = $con->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $matricula, $nome, $curso, $senha);

        $matricula = $discente->getMatricula();
        $nome = $discente->getNome();
        $curso = $discente->getCurso();
        $senha = $discente->getSenha();

        if ($stmt->execute()) {
            $sql = "UPDATE discente SET matricula = ?, 
                nome = ?, curso = ?,senha MD5(?) WHERE id_discente =" . $discente->getIdDiscente();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssss", $matricula, $nome, $curso, $senha);
            $matricula = $discente->getMatricula();
            $nome = $discente->getNome();
            $curso = $discente->getCurso();
            $senha = $discente->getSenha();
        } else {
            echo "primeiro errado" . $con->error;
        }
    }



    public function read()
    {
        $sql = "SELECT * FROM discente;";
        $con = new Conexao();
        $con = $con->getConnection();
        $result = $con->query($sql);

        $row = $result->fetch_assoc();
        $dis = new Discente();
        $dis->setNome($row['nome']);
        $dis->setMatricula($row['matricula']);
        // echo "<pre>";
        // var_dump($retorno);
        // echo "</pre>";
        $retorno = $dis;

        return $retorno;
    }


    public function readAll()
    {
        $sql = "SELECT * FROM discente;";
        $con = new Conexao();
        $con = $con->getConnection();
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $retorno = array();
            while ($row = $result->fetch_assoc()) {
                $dis = new Discente($con);
                $dis->setMatricula($row['Matricula']);
                $dis->setNome($row['Nome']);
                $dis->setSenha($row['senha']);


                array_push($retorno, $dis);
            }
        }
        return $retorno;
        // echo '<pre>';
        //     print_r($retorno);
        // echo "</pre>";
    }

    public function delete($discente)
    {
        $dis = $discente["Matricula"];
        $sql = 'DELETE FROM discente WHERE Matricula =  ' . $dis;

        $con = new Conexao();
        $con = $con->getConnection();
        $result = $con->query($sql);

        if ($result == TRUE) {
            echo "$discente removido";
        } else {
            echo 'Error : ' . $con->error;
        }
        //return $result;
    }

    public function getDiscenteInfo($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT matricula, ativo, nome, fk_curso, monitor FROM discente WHERE matricula = " . $matricula;

        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $conn->close();
            return $row;
        } else {
            echo $conn->error;
        }
    }

    public function getDiscenteObj($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT matricula, ativo, nome, fk_curso, monitor FROM discente WHERE matricula = " . $matricula;

        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_object();

            $conn->close();
            return $row;
        } else {
            echo $conn->error;
        }
    }
    
//-----------------------------------------------------------------------monitor-------------------------------------------------------------------

public function alterarStatusAtivoDoDiscenteMonitor($matricula, $ativo)
{
    $conexao = new Conexao();
    $conn = $conexao->getConnection();
    if ($ativo == 1) {
        $ativo = 0;
    } else {
        $ativo = 1;
    }

    $sql = "UPDATE `discente` SET `ativo` = $ativo WHERE `discente`.`matricula` = $matricula";
          //UPDATE `docente` SET `nome` = 'Adriano', `senha` = '123' WHERE `docente`.`matricula` = '50000';
    //echo $sql;
    if ($conn->query($sql)) {
        echo "<script> window.location.href='?p=admin&adm=monitores'</script> ";
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

    public function getAllActiveDiscentesMonitor()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM discente WHERE ativo = 1 AND monitor = 1 ORDER BY discente.nome";

        $result = $conn->query($sql);

        $discentes = null;

        while ($data = $result->fetch_object()) {
            $discentes[] = $data;
        }

        return $discentes;
    }

    public function getMonitoresFromDocente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT D.* FROM discente D, disciplina DIS, docente DOC WHERE D.matricula = DIS.monitor AND DIS.fk_docente = $matricula;";

        $result = $conn->query($sql);

        $discentes = null;

        while ($data = $result->fetch_object()) {
            $discentes[] = $data;
        }

        return $discentes;
    }

    public function readMonitor(){
        $sql = "SELECT * FROM discente Where monitor = 1;";
        $con = new Conexao();
        $con = $con->getConnection();
        $result = $con->query($sql);

        $row = $result->fetch_assoc();
        $dis = new Discente();
        $dis->setNome($row['nome']);
        $dis->setMatricula($row['matricula']);
        // echo "<pre>";
        // var_dump($retorno);
        // echo "</pre>";
        $retorno = $dis;

        return $retorno;
    }

    public function getAllInactiveDiscentesMonitor()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM discente WHERE ativo = 0 AND monitor = 1 ORDER BY discente.nome";

        $result = $conn->query($sql);

        $discentes = null;

        while ($data = $result->fetch_object()) {
            $discentes[] = $data;
        }

        return $discentes;
    }

    public function ativarMonitor($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "UPDATE `discente` SET `monitor` = 1 WHERE `discente`.`matricula` = $matricula";
        if ($conn->query($sql)) {
            
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao reajustar o docente, perdemo.
                <br>
                <span class="badge bg-primary">contato: gustavomourago@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }

    public function desativarMonitor($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "UPDATE `discente` SET `monitor` = 0 WHERE `discente`.`matricula` = $matricula";
        if ($conn->query($sql)) {
            echo "<script> window.location.href='?p=docente&doc=monitores'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao reajustar o docente, perdemo.
                <br>
                <span class="badge bg-primary">contato: gustavomourago@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }
}
?>