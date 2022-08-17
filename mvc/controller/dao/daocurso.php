<?php
$path = 'C:\xampp\htdocs\app\last\php\mvc';

require_once $path . '/models/class/curso.class.php';
require_once $path . '/models/db/conexao.php';

class DaoCurso
{

    public function createCurso($curso)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "INSERT INTO curso(cod_Curso, ativo, nome) VALUES(?,?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $cod_Curso, $ativo, $nome);

        $cod_Curso = $curso->getCodCurso();
        $ativo = $curso->getAtivo();
        $nome = $curso->getNome();
        
        $stmt->execute();
    }

    public function getMaxId()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT MAX(cod_curso) FROM `curso`";

        $result = $conn->query($sql);
        
        $qnt = $result->fetch_row();

        return $qnt[0]+1;
    }

    public function getAllActiveCoursers()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `curso` WHERE curso.ativo = 1 ORDER BY curso.nome";

        $result = $conn->query($sql);

        $courses = null;

        while ($data = $result->fetch_object()) {
            $courses[] = $data;
        }

        return $courses;
    }

    public function getAllInactiveCoursers()
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM `curso` WHERE curso.ativo = 0 ORDER BY curso.nome";

        $result = $conn->query($sql);

        $courses = null;

        while ($data = $result->fetch_object()) {
            $courses[] = $data;
        }

        return $courses;
    }

    public function alterarStatusAtivoDoCurso($cod_Curso, $ativo)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        echo $ativo;
        if ($ativo == 1) {
            $ativo = 0;
        } else {
            $ativo = 1;
        }

        $sql = "UPDATE `curso` SET curso.ativo = $ativo WHERE curso.cod_Curso = $cod_Curso";
        // UPDATE `mtr`.`curso` SET `ativo` = '0' WHERE (`cod_Curso` = '2');

        if ($conn->query($sql)) {
            echo "<script> window.location.href='?p=admin&adm=cursos'</script> ";
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

    public function getCursoObj($cod_Curso)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT cod_Curso, ativo, nome FROM curso WHERE cod_Curso = " . $cod_Curso;

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

    public function getCursoInfo($cod_Curso)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT cod_Curso, ativo, nome FROM curso WHERE cod_Curso = " . $cod_Curso;

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
