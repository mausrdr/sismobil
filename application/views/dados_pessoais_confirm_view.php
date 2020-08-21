<!DOCTYPE html>
<html>
    <head>
        <title>Confirmação dos Dados</title>

        <style type="text/css">

            form li {
                list-style: none;
            }
            
            form button {
                background: #384313;
                border: none;
                -moz-border-radius: 20px;
                -webkit-border-radius: 20px;
                -khtml-border-radius: 20px;
                border-radius: 20px;
                color: #ffffff;
                display: inline;
                font: 18px Georgia, "Times New Roman", Times, serif;
                letter-spacing: 1px;
                margin: auto;
                padding: 7px 25px;
                text-shadow: 0 1px 1px #000000;
                text-transform: uppercase;
            }

            form button:hover {
                background: #1e2506;
                cursor: pointer;
            }

            body {
                background: #e7efd1;
                color: #395338;
                font-family: Georgia, "Times New Roman", Times, serif;
                padding: 20px;
                counter-reset: fieldsets;
                text-align: center;
            }

            table {
                margin: auto;
                width: 700px;
                color: #000000;
                text-align: left;
                border-collapse: collapse;
                background-color: #b9cf6a;
            }

            tr:nth-child(2n+1) {
                background-color: #e3ebc3;
            }
            
            tr td {
                border: 1px solid #384313;
            }
            td {
                width: 350px;
            }


        </style>
    </head>
    <body>
        <h1>Confirmação dos dados</h1>

        <p>Por favor confira se seus dados estão corretos</p>

        <?php
        $this->output->set_header("Content-Type: text/html; charset=UTF-8");
        
        

        echo form_open($base_url . $url);
        
        

        $dados = array(

            'nome'                  =>      $candidato->getNome(),
            'sexo'                  =>      $candidato->getSexo(),
            'endereco'              =>      $candidato->getEndereco(),
            'numero'                =>      $candidato->getNumero(),
            'complemento'           =>      $candidato->getComplemento(),
            'bairro'                =>      $candidato->getBairro(),
            'cidade'                =>      $candidato->getCidade(),
            'cep'                   =>      $candidato->getCep(),
            'estado'                =>      $candidato->getEstado(),
            'pais'                  =>      $candidato->getPais(),
            'telefone'              =>      $candidato->getTelefone(),
            'celular'               =>      $candidato->getTelefone(),
            'rg'                    =>      $candidato->getRg(),
            'data_expedicao'        =>      $candidato->getData_expedicao(),
            'orgao_emissor'         =>      $candidato->getOrgao_emissor(),
            'cpf'                   =>      $candidato->getCpf(),
            'passaporte'            =>      $candidato->getPassaporte(),
            'nacionalidade'         =>      $candidato->getNacionalidade(),
            'email'                 =>      $candidato->getEmail(),
            'data_nascimento'       =>      $candidato->getData_nascimento(),
            'id_campus'             =>      $campus->getId_campus(),
            'curso_id_curso'        =>      $curso_origem->getCurso_id_curso(),
            'semestre_total'        =>      $curso_origem->getSemestre_total(),
            'media_geral'           =>      $curso_origem->getMedia_geral(),
            'coordenador'           =>      $curso_origem->getCoordenador(),
            'semestre_atual'        =>      $origem->getSemestre_atual(),
            'periodo'               =>      $mobilidade->getPeriodo(),
            'informacoes'           =>      $mobilidade->getInformacoes(),
            'id_materna'            =>      $lingua_materna->getId_linguas(),
            'quantidade_idiomas'    =>      $quantidade_idiomas,
            'id_financiamento'      =>      $financiamento->getId_tipo_financiamento(),
            'financiamento'         =>      $financiamento->getDescricao_financiamento(),
            'carta_motivacao'       =>      $carta_motivacao->getCarta(),
            'iniciacao_cientifica'  =>      $extracurricular->getIniciacao_cientifica(),
            'extensao_cultural'     =>      $extracurricular->getExtensao_cultural(),
            'id_edital'             =>      $id_edital

          );
        
        for($i = 0; $i < count($tipo_atividade); $i++) {
            
            $aux[$i] = $tipo_atividade[$i]->getId_tipo_atividade();
            
        }
        
        $dados['tipo_atividade']  = $aux;
        
        for($i = 0; $i < $quantidade_idiomas; $i++) {
            
            $post_id_lingua_str = 'id_lingua_alternativa';
            $post_id_fluencia_str = 'id_fluencia_linguistica';
            $post_id_lingua_str .= $i+1;
            $post_id_fluencia_str .= $i+1;
            $dados[$post_id_lingua_str] = $lingua_alternativa[$i]->getId_linguas();
            $dados[$post_id_fluencia_str] = $fluencia_linguistica[$i]->getId_fluencia_linguistica();
            
        }
        
        echo form_hidden($dados);
        ?>

        <table>
            <tr>
                <td>Nome</td>
                <td><?php echo $candidato->getNome() ?></td>
            </tr>
            <tr>
                <td>Sexo</td>
                <td><?php if($candidato->getSexo() == 'm') {echo 'Masculino';} else {echo 'Feminino';} ?></td>
            </tr>
            <tr>
                <td>Endereço</td>
                <td><?php echo $candidato->getEndereco(); ?></td>
            </tr>
            <tr>
                <td>Número</td>
                <td><?php echo $candidato->getNumero(); ?></td>
            </tr>
            <tr>
                <td>Complemento</td>
                <td><?php echo $candidato->getComplemento(); ?></td>
            </tr>	
            <tr>
                <td>Bairro</td>
                <td><?php echo $candidato->getBairro(); ?></td>
            </tr>
            <tr>
                <td>Cidade</td>
                <td><?php echo $candidato->getCidade(); ?></td>
            </tr>
            <tr>
                <td>CEP</td>
                <td><?php echo $candidato->getCep(); ?></td>
            </tr>
            <tr>
                <td>Estado</td>
                <td><?php echo $candidato->getEstado(); ?></td>
            </tr>
            <tr>
                <td>País</td>
                <td><?php echo $candidato->getPais(); ?></td>
            </tr>
            <tr>
                <td>Telefone</td>
                <td><?php echo $candidato->getTelefone(); ?></td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><?php echo $candidato->getCelular(); ?></td>
            </tr>
            <tr>
                <td>RG</td>
                <td><?php echo $candidato->getRG(); ?></td>
            </tr>
            <tr>
                <td>Data de expedição</td>
                <td><?php echo $candidato->getData_expedicao(); ?></td>
            </tr>
            <tr>
                <td>Órgão emissor</td>
                <td><?php echo $candidato->getOrgao_emissor(); ?></td>
            </tr>
            <tr>
                <td>CPF</td>
                <td><?php echo $candidato->getCpf(); ?></td>
            </tr>
            <tr>
                <td>Passaporte</td>
                <td><?php echo $candidato->getPassaporte(); ?></td>
            </tr>
            <tr>
                <td>Nacionalidade</td>
                <td><?php echo $candidato->getNacionalidade(); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $candidato->getEmail(); ?></td>
            </tr>
            <tr>
                <td>Data de Nascimento</td>
                <td><?php echo $candidato->getData_nascimento(); ?></td>
            </tr>
            <tr>
                <td>Câmpus</td>
                <td><?php echo $campus->getNome_campus(); ?></td>
            </tr>
            <tr>
                <td>Curso</td>
                <td><?php echo $descricao_curso_origem; ?></td>
            </tr>
            <tr>
                <td>Semestre atual</td>
                <td><?php echo $origem->getSemestre_atual(); ?></td>
            </tr>
            <tr>
                <td>Total de semestres a serem cursados</td>
                <td><?php echo $curso_origem->getSemestre_total(); ?></td>
            </tr>
            <tr>
                <td>Média geral das disciplinas cursadas</td>
                <td><?php echo $curso_origem->getMedia_geral() ?></td>
            </tr>
            <tr>
                <td>Coordenador do curso</td>
                <td><?php echo $curso_origem->getCoordenador(); ?></td>
            </tr>
            <tr>
                <td>Diretor do Câmpus de origem</td>
                <td><?php echo $campus->getDiretor(); ?></td>
            </tr>
            <tr>
                <td>Telefone do Câmpus</td>
                <td><?php echo $campus->getTelefone_campus(); ?></td>
            </tr>
            <tr>
                <td>Fax do Câmpus</td>
                <td><?php echo $campus->getFax(); ?></td>
            </tr>
            <tr>
                <td>Período de estudos pretendido no exterior</td>
                <td><?php echo $mobilidade->getPeriodo(); ?></td>
            </tr>
            <?php 
                for($i = 0; $i < count($tipo_atividade); $i++) {
            ?>        
            <tr>
                <td>Tipo de atividade <?php echo $i+1; ?></td>
                <td><?php echo $tipo_atividade[$i]->getDescricao_atividade(); ?></td>
            </tr>
            <?php        
                } 
            ?>
            <tr>
                <td>Informações adicionais</td>
                <td><?php echo $mobilidade->getInformacoes(); ?></td>
            </tr>
            <tr>
                <td>Língua materna</td>
                <td><?php echo $lingua_materna->getDescricao_linguas(); ?></td>
            </tr>
            <?php
                for($i = 0; $i < $quantidade_idiomas; $i++) {
            ?>
            <tr>
                <td>Língua alternativa <?php echo $i+1; ?></td>
                <td><?php echo $lingua_alternativa[$i]->getDescricao_linguas(); ?></td>
            </tr>
            <tr>
                <td>Fluência linguistica <?php echo $i+1 ?></td>
                <td><?php echo $fluencia_linguistica[$i]->getDescricao_fluencia(); ?></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <td>Como será financiado as despesas</td>
                <td><?php echo $financiamento->getDescricao_financiamento(); ?></td>
            </tr>
            <tr>
                <td>Carta de motivação</td>
                <td style="text-align: justify;"><?php echo $carta_formatada; ?></td>
            </tr>
            <tr>
                <td>Atividade 1</td>
                <td><?php echo $extracurricular->getIniciacao_cientifica(); ?></td>
            </tr>
            <tr>
                <td>Atividade 2</td>
                <td><?php echo $extracurricular->getExtensao_cultural(); ?></td>
            </tr>
        </table>
        <ul>
            <li>
                <div>
                    <?php echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                </div>
            </li>
        </ul>

        <?php
            echo form_close();
        ?>

    </body>
</html>
