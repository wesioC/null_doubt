<?php
$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/super_user.class.php';
require_once $path . '/models/db/conexao.php';


class DaoSuperUser
{


    public function login($login, $senha)
    {

        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM super_user WHERE login LIKE'$login' and senha LIKE md5('$senha')";

        $result = $conn->query($sql);



        if($result->num_rows == 1){
            $_SESSION['super_user'] = $login;
            $conn->close();
            echo "<script> window.location.href='index.php?p=admin'</script> ";
        }else {
            echo "<script>alert('Dados incorretos.')</script>"; 
        }       

    }
}
