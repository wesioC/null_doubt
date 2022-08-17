<?php

$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/disciplina.class.php';
require_once $path . '/models/db/conexao.php';

class DaoDisciplina{
    public function create($disciplina)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql =
            "INSERT INTO `disciplina` (`id`, `nome`, `periodo`, `data_de_encerramento`, `ativo`, `cod_disciplina`, `monitor`, `fk_docente`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isisiiii', $id, $nome, $periodo, $data_de_encerramento, $ativo, $cod_disciplina, $monitor, $fk_docente);

        $id = $disciplina->getId();
        $nome = $disciplina->getNome();
        $periodo = $disciplina->getPeriodo();
        $data_de_encerramento = $disciplina->getDataDeEncerramento();
        $ativo = $disciplina->getAtivo();
        $cod_disciplina = $disciplina->getCodDisciplina();
        $monitor = $disciplina->getMonitor();
        $fk_docente = $disciplina->getFKDocente();
        if($stmt->execute()){
            echo "<script> window.location.href='?p=admin&adm=disciplinas'</script> ";
        }else{
            echo $conn->error;
        }
        
    }
    public function getMaxId()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT MAX(id) FROM `disciplina`";

        $result = $conn->query($sql);
        
        $qnt = $result->fetch_row();

        return $qnt[0]+1;
    }

    public function getAllActiveFromDocente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `disciplina` WHERE disciplina.ativo = 1 AND disciplina.fk_Docente = $matricula ORDER BY disciplina.nome";

        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function getAllActiveFromDocenteWithoutScheduling($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `disciplina` WHERE disciplina.ativo = 1 AND disciplina.fk_docente = $matricula and monitor IS NULL;";

        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function getAllActiveDisciplinas()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `disciplina` WHERE disciplina.ativo = 1 ORDER BY disciplina.nome";

        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function getAllInactiveDisciplinas()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `disciplina` WHERE disciplina.ativo = 0 ORDER BY disciplina.nome";

        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function alterarStatusAtivoDaDisciplina($id, $ativo)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        echo $ativo;
        if ($ativo == 1) {
            $ativo = 0;
        } else {
            $ativo = 1;
        }

        $sql = "UPDATE `disciplina` SET disciplina.ativo = $ativo WHERE disciplina.id = $id";
        // UPDATE `mtr`.`curso` SET `ativo` = '0' WHERE (`cod_Curso` = '2');

        if ($conn->query($sql)) {
            echo "<script> window.location.href='?p=admin&adm=disciplinas'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao reajustar o curso, perdemo.
                <br>
                <span class="badge bg-primary">contato: lemos.dayane.d@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }

    public function getDisciplinaObj($id)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT id, nome, periodo, data_de_encerramento, ativo, cod_disciplina, monitor, fk_docente FROM disciplina WHERE id = " . $id;

        $result = $conn->query($sql);
        //echo $result;
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_object();    

            $conn->close();

            return $row;
        } else {
            echo $conn->error;
        }
    }


    public function getDisciplinaInfo($id)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT id, nome, periodo, data_de_encerramento, ativo, cod_disciplina, fk_docente FROM disciplina WHERE id = " . $id;

        $result = $conn->query($sql);
        //echo $result;
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_assoc();    

            $conn->close();

            return $row;
        } else {
            echo $conn->error;
        }
    }
    
    public function ativarMonitor($matricula, $id)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "UPDATE `disciplina` SET disciplina.monitor = $matricula WHERE disciplina.id = $id";
        // UPDATE `mtr`.`curso` SET `ativo` = '0' WHERE (`cod_Curso` = '2');

        if ($conn->query($sql)) {
            echo "<script>alert('O discente foi promovido á monitor com sucesso!')</script>";
            echo "<script> window.location.href='?p=docente&doc=monitores'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao tentar adicionar o monitor.
                <br>
                <span class="badge bg-primary">contato: gustavomourago@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }

    public function desativarMonitor($matricula, $id)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "UPDATE `disciplina` SET disciplina.monitor = null WHERE disciplina.id = $id";
        // UPDATE `mtr`.`curso` SET `ativo` = '0' WHERE (`cod_Curso` = '2');

        if ($conn->query($sql)) {
            echo "<script>alert('O monitor foi rebaixado á discente sucesso com sucesso!')</script>";
            echo "<script> window.location.href='?p=docente&doc=monitores'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao tentar desativar o monitor.
                <br>
                <span class="badge bg-primary">contato: gustavomourago@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }
    
    public function getDisciplinaObjFromMonitor($monitor)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM disciplina WHERE monitor = " . $monitor;

        $result = $conn->query($sql);
        //echo $result;
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_object();    

            $conn->close();

            return $row;
        } else {
            echo $conn->error;
        }
    }
}

?>