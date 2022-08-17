<?php
function retornaAtivoEmFormatoTexto($ativo)
{
    if ($ativo == 1) {
        $ativo = "Ativo";
    } else {
        $ativo = "Inativo";
    }
    
    return $ativo;
}
?>

<?php
$dao = new Daolocal();
$local_on = $dao->getAllActiveLocal();
$local_off = $dao->getAllInactiveLocal();
echo '
<h4 class="text-center mt-5">Locais</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Departamento</th>
            <th scope="col">Sala</th>
            <th scope="col">Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';

if ($local_on != null or $local_off != null) {
    if ($local_on != null) {
        foreach ($local_on as $local) {
            echo '
                    <tr>
                    <td>' . $local->cod_local . '</td>
                    <td>'. $local->departamento . '</td>
                    <td><a href=#> ' . $local->sala . '</a></td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($local->ativo) . '</b> </font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-local&id='
                    . $local->cod_local .
                    '"><button type="submit" class="button_red">
                    Desativar</button> 
                    </a>
                    </td>
                    </tr>
                    ';
        }
    }
    if ($local_off != null) {
        foreach ($local_off as $local) {
          
            echo '
            <tr>
            <td>' . $local->cod_local . '</td>
            <td> ' . $local->departamento  . '</td>
            <td><a href=#> ' . $local->sala . '</a></td>
            <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($local->ativo) . '</b> </font> </td>
            <td> 
                    <a href="?p=admin&adm=altern-local&id='
                    . $local->cod_local .
                    '"><button type="submit" class="button_green">
                    Ativar</button> 
                    </a>
                    </td>
            </tr>
            ';
        }
    }
} else {
    echo '
                    <tr>
                        <td colspan="5">Nenhum local por enquanto</td>
                    </tr>
        
                ';
}
echo '
        <tr>
        <form method="post">
        <td></td>   
        <td>
            <input placeholder="Departamento" type="text" id="departamento_local" name="departamento_local" size="16">
        </td>
        <td>    
            <input placeholder="Sala" type="text" id="sala_local" name="sala_local" size="16">
        </td>
            <td></td>   
            <td>               
                <button id="adicionar_local" type="submit" name="adicionar_local">
                    Adicionar                    
                </button>                          
            </td>
            </form>
        </tr>
        ';
?>

</tbody>
</table>