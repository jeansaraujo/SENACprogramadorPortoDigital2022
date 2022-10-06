<h1 style="text-align:center;">
    Interesses
</h1>
<hr>
<?php 
    $conexao = new PDO("mysql:dbname=recepcao;host=localhost","root","");
    $selectcursos = $conexao->PREPARE("SELECT cursos.*, categoria.interessado as 'categoria', categoria.modalidade as 'modalidade' from cursos join categoria on cursos.categoria_id = categoria.id");
    $selectcursos->execute();
    $cursos = $selectcursos->fetchAll(PDO::FETCH_ASSOC);
    $selectinteressados = $conexao->PREPARE("SELECT ci.* ,inte.contato ,inte.email ,inte.escolaridade ,inte.dtNasc as 'nascimento' ,inte.tpcontato as 'tipocontato' ,inte.nome as 'interessado' ,cur.nome as 'curso' ,cur.dtIni as 'inicio' ,cur.dtFim as 'fim' ,cur.cargaHoraria as 'ch' ,capacidade ,cat.nome as 'categoria' ,modalidade from cursosinteressados ci join interessados inte on ci.interessados_id = inte.id join cursos cur on cur.id = ci.cursos_id join categoria cat on cur.categoria_id = cat.id");
    $selectinteressados->execute();
    $interessados = $selectinteressados->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($interessados);
?>
<div style="display: flex; justify-content:center;">
    <form method="POST">    
        <input type="hidden" name="cadcurso" value="interesses">
        <input type="hidden" name="cadinteressado" value="cadastro">        
        <label style="font-weight:900;">Cursos</label>   
        <select style="width=100%;" name="cadcurso">
            <?php
                foreach ($cursos as $c){
                    print 
                        "<option value='".$c['id']."' style='width:100%;'>".
                            $c['interessado']." - ".$c['categoria']." - ".$c['modalidade'].
                        "</option>";                   
                }
            ?>
        </select>
        <label style="font-weight:900;">Interessados</label>   
        <select style="width=100%;" name="cadinteressado">
            <?php
                foreach ($interessados as $i){
                    print 
                        "<option value='".$i['id']."' style='width:100%;'>".
                            $i['interessado'].
                        "</option>";                   
                }
            ?>
        </select>
        <button>
            Registrar
        </button>
    </form>
</div>
<hr>
<hr>
<table style="width:100%">
    <thead>
        <tr style="font-weight:900; text-align:center;">
            <td>id</td>            
            <td>Categoria/Modalidade</td>
            <td>Curso</td>
            <td>Interessado</td>
            <td>Contato</td>
            <td>Email</td>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($interessados as $i){
                print"
                    <tr style='text-align:center;'>
                        <td>"
                            .$i['cursos_id']." - ".$i['interessados_id'].
                        "</td>
                        <td>"
                            .$i['categoria']." / ".$i['modalidade'].
                        "</td>
                        <td>"
                            .$i['curso'].
                        "</td>
                        <td>"
                            .$i['interessado'].
                        "</td>
                        <td>"
                            .$i['contato'].
                        "</td>
                        <td>"
                            .$i['email'].
                        "</td>
                    </tr>
                    ";
            }
        ?>
    </tbody>
</table>