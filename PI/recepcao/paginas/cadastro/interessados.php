<div class="row">
    <div class="col">
        <p class="h2 text-center mt-5">
            Interessados
        </p>
        <hr>
    </div>
</div>
<?php
    if(isset($_POST['sucesso'])){
        $sucesso = $_POST['sucesso'];
        if($sucesso == "true"){
            print "
                <div style='width:60vw; margin:auto; font-size:1.2em; padding:5px; border: solid 2px green; border-radius:10px; background:lightgreen;'>
                    <p style='text-align:center; color:darkgreen; font-weight:900;'>
                        Cadastro realizado com sucesso!
                    </p>
                </div>
            ";
        }
    }
?>
<div class="row">
    <div class="col">
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Novo | <i class="fa-solid fa-arrow-down"></i>
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form  method="POST">
                    <input type="hidden" name="pagina" value="cadastro">
                    <input type="hidden" name="cad" value="interessados">
                    <input type="hidden" name="sucesso" value="true">
                    <?php
                        if(isset($ratualiza)){
                            print "<input type='hidden' name='atualizar' value='".$edicao."'>";                    
                        }
                    ?>
                    <label class="form-label">
                        Nome
                    </label>
                    <input class="form-control" type="text" name="nome" style="width:100%; margin-bottom:10px;">
                    <table class="table" style="width:100%">
                        <tr>
                            <td>
                                <label class="form-label">
                                Contato
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Tipo de Contato
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control" type="tel" name="contato" style="width:100%; margin-bottom:10px;">
                            </td>
                            <td>
                            <select class="form-control" name="tpcontato" >
                                <option value="soligacao">
                                        Só Ligação
                                </option>
                                <option value="whastapp">
                                        whastapp
                                </option>
                                <option value="telegram">
                                        Telegram
                                </option>               
                            </select>            
                            </td>
                        </tr>
                    </table>               
                    <label class="form-label">
                        Email
                    </label>
                    <input class="form-control" type="email" name="email" style="width:100%; margin-bottom:10px;">            
                    <table style = "width:100%;">
                        <tr>
                            <td>
                                <label class="form-label">
                                    Escolaridade
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Data de Nascimento
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control" name="escolaridade" >
                                    <option value="fundamental">
                                            Fundamental
                                    </option>
                                    <option value="medio">
                                            Médio   
                                    </option>
                                    <option value="superior">
                                            Superior   
                                    </option>
                                    <option value="posgraduado">
                                            posgraduado   
                                    </option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" style="width:100%; margin-bottom:10px; "type="date" name="dataNascimento">
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-primary">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php
            $conexao = new PDO("mysql:dbname=recepcao;host=localhost","root","");
            $selectInteressados = $conexao->PREPARE("select * FROM interessados");
            $selectInteressados->execute();
            $interessados = $selectInteressados->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <p class="h4 text-center">
            Listagem de Interessados
        </p>
        <table class="table table-striped">
            <thead>
                <tr style="font-weight:900; text-align:center;">
                    <td>id</td>
                    <td>Nome</td>
                    <td>Contato</td>
                    <td>Tipo</td>
                    <td>Email</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($interessados as $interessado){
                        print
                        "
                        <tr style='text-align:center;'>
                            <td>".$interessado['id']."</td>
                            <td>".$interessado['nome']."</td>                                    
                            <td>"."
                            <a href='https://api.whatsapp.com/send?phone='"
                            .$interessado['contato'].">"
                                .$interessado['contato'].
                            "</a>"
                            ."</td>
                            <td>".$interessado['tpcontato']."   </td>
                            <td>".$interessado['email']."</td>
                            <td>"."
                                <a href='?pagina=cadastro&cad=interessado&editar=".$interessado['id']."'><i style='color:orange;'class='fa-solid fa-pencil'></i></a>
                                <a href='?pagina=cadastro&cad=interessado&excluir=".$interessado['id']."'><i style='color:red;' class='fa-solid fa-trash'></i></a> 
                                <a href='?pagina=cadastro&cad=interessado&detalhes=".$interessado['id']."'><i style='color:blue;'class='fa-solid fa-eye'></i></a>"."</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
