<?php
$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/local.class.php';
require_once $path . '/models/db/conexao.php';

class DaoLocal
{

    public function getMaxId()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT MAX(cod_local) FROM `local`";

        $result = $conn->query($sql);
        
        $qnt = $result->fetch_row();

        return $qnt[0]+1;
    }

    public function createlocal($local)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "INSERT INTO local(departamento, sala, ativo, cod_local) VALUES(?,?,?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssii", $departamento, $sala, $ativo, $cod_local);

        $cod_local = $local->getCodlocal();
        $ativo = $local->getAtivo();
        $sala = $local->getSala();
        $departamento = $local->getDepartamento();  
        
        $stmt->execute();
    }

    public function getAllActiveLocal()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `local` WHERE local.ativo = 1 ORDER BY local.departamento, local.sala";

        $result = $conn->query($sql);

        $courses = null;

        while ($data = $result->fetch_object()) {
            $courses[] = $data;
        }

        return $courses;
    }

    public function getAllInactiveLocal()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `local` WHERE local.ativo = 0";

        $result = $conn->query($sql);

        $courses = null;

        while ($data = $result->fetch_object()) {
            $courses[] = $data;
        }

        return $courses;
    }

    public function alterarStatusAtivoDolocal($cod_local, $ativo)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        echo $ativo;
        if ($ativo == 1) {
            $ativo = 0;
        } else {
            $ativo = 1;
        }

        $sql = "UPDATE `local` SET local.ativo = $ativo WHERE local.cod_local = $cod_local";
        // UPDATE `mtr`.`local` SET `ativo` = '0' WHERE (`cod_local` = '2');

        if ($conn->query($sql)) {
            echo "<script> window.location.href='?p=admin&adm=locais'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao reajustar o local, perdemo.
                <br>
                <span class="badge bg-primary">contato: lemos.dayane.d@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }

    public function getLocalObj($cod_local)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM local WHERE cod_local = " . $cod_local;

        $result = $conn->query($sql);
        //echo $result;
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_object();
          //$row = $result->fetch_assoc();     ANTES


            $conn->close();

            return $row;
        } else {
            echo $conn->error;
        }
    }

    public function getlocalInfo($cod_local)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM local WHERE cod_local = " . $cod_local;

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
}
