<?php

class Pdf_controller extends MY_controller {

    function __construct() {

        parent::__construct();
        
        $this->load->model('ficha_candidatura_to');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('edital_dao');
        
    }

    function index($id) {

        //$texto = 'Primeiro teste de geração automática de pdf via codeigniter!!!';
        $this->generatePdf($id);
    }

    private function generatePdf($id) {
        $this->load->library('pdf');

        require_once K_PATH_MAIN.'config/lang/bra.php';
        // set document information
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('mauro.rodrigues');
        $this->pdf->SetTitle('Ficha de Candidatura para Alunos de Intercâmbio');
        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        
        //$this->pdf->Header();

// set default header data
        $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
        $this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
        $this->pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set font
        $this->pdf->SetFont('dejavusans', '', 10);

// add a page
        $this->pdf->AddPage();
        
        $fc = new Ficha_candidatura_to();
        $fc = $this->ficha_candidatura_dao->getFichaCandidatura($id);
        
        $edital = $this->edital_dao->getNumeroEdital($fc->getEdital_id_edital());
        $nome = $fc->getNome();
        $sexo = $fc->getSexo();
        $endereco = $fc->getEndereco();
        $numero = $fc->getNumero_endereco();
        $complemento = $fc->getComplemento();
        $bairro = $fc->getBairro();
        $cidade = $fc->getCidade();
        $estado = $fc->getEstado();
        $cep = $fc->getCep();
        $pais = $fc->getPais();
        $telefone = $fc->getTelefone();
        $celular = $fc->getCelular();
        $rg = $fc->getRg();
        $data_expedicao = $fc->getData_expedicao();
        $orgao_expeditor = $fc->getOrgao_emissor();
        $cpf = $fc->getCpf();
        $passaporte = $fc->getPassaporte();
        $nacionalidade = $fc->getNacionalidade();
        $email = $fc->getEmail();
        $data_nascimento = $fc->getData_nascimento();
        $campus = $fc->getNome_campus();
        $curso = $fc->getCurso_origem();
        $semestre_atual = $fc->getSemestre_atual();
        $semestre_total = $fc->getSemestre_total();
        $media_geral = $fc->getMedia_geral();
        $coordenador = $fc->getCoordenador();
        $diretor = $fc->getDiretor();
        $telefone_campus = $fc->getTelefone_campus();
        $fax = $fc->getFax();
        $periodo = $fc->getPeriodo();
        $atividade = $fc->getDescricao_atividade();
        $informacoes_adicionais = $fc->getInformacoes();
        $lingua_materna = $fc->getLingua_materna();
        $outros_idiomas = explode(',', $fc->getLingua_alternativa());
        $fluencia = explode(',', $fc->getFluencia_linguistica());
        $cont_outros_idiomas = count($outros_idiomas);
        $financiamento = $fc->getFinanciamento();
        $carta_motivacao = $fc->getCarta();
        $carta_motivacao .= "\n";
        $iniciacao_cientifica = $fc->getIniciacao_cientifica();
        $iniciacao_cientifica .= "\n";
        $extencao_cultural = $fc->getExtencao_cultural();
        $extencao_cultural .= "\n";
        $carimbo = "Narayana de Deus Nogueira Bregagnoli";
        
        if($sexo == 'm') {
            
            $sexo = 'masculino';
            
        } else {
            
            $sexo = 'feminino';
            
        }
        
        if(!empty($complemento)) {
            
            $complemento .= " - ";
            
        }
            
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// create some HTML content
        $html = '<table border="1" style="width:930px;text-align:left;border-collapse: collapse;border: 1px solid black;">
            <tr style="border-collapse: collapse;border: 1px solid black;">
                <td style="width:190px;border: 1px solid black;"><b>Universidade de Destino:<br />Edital DRI nº '. $edital .'</b></td>
                <td><p style="color:white;">obladiobladalá</p></td>
             </tr>
             <tr style="border-collapse: collapse;border: 1px solid black;">
                <td style="height:30px;border: 1px solid black;"><b><br />Curso Pretendido:</b></td>
                <td><p style="color:white;">obladiobladalá</p></td>
             </tr>
             </table>
             <h1>1 - Dados Pessoais</h1>
             <table border="0" cellpadding="4">
                <tr>
                    <td><b>Nome:</b> ' . $nome . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Sexo:</b> '. $sexo .'</td>
                </tr>
                <tr>
                    <td><b>Endereço:</b> ' . $endereco . ', ' . $numero . ' - ' . $complemento . '' . $bairro . ', ' . $cidade . '-' . $estado . ' <b>Cep.:</b> ' . $cep . ' - ' . $pais . '</td>
                </tr>
                <tr>
                    <td><b>Telefone:</b> ' . $telefone . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Celular:</b> ' . $celular . '&nbsp;&nbsp;&nbsp;&nbsp;<b>RG.:</b> ' . $rg . '</td>
                </tr>
                <tr>
                    <td><b>Data de expedição:</b> ' . $data_expedicao . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Órgão expeditor:</b> ' . $orgao_expeditor . '</td>
                </tr>
                <tr>
                    <td><b>CPF.:</b> ' . $cpf . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Passaporte:</b> ' . $passaporte . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Nacionalidade:</b> ' . $nacionalidade . '</td>
                </tr>
                <tr>
                    <td><b>Email:</b> ' . $email . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Data de nascimento:</b> ' . $data_nascimento . '</td>
                </tr>
             </table>
             <p></p>
             <h1>2 - Campus de Origem do Candidato</h1>
             <table border="0" cellpadding="4">
                <tr>
                    <td><b>Câmpus:</b> ' . $campus . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Curso:</b> ' . $curso . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Semestre atual:</b> ' . $semestre_atual . '</td>
                </tr>
                <tr>
                    <td><b>Total de semestres a serem cursados:</b> ' . $semestre_total . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Média geral das disciplinas cursadas:</b> ' . $media_geral . '</td>
                </tr>
                <tr>
                    <td><b>Coordenador do curso:</b> ' . $coordenador . '</td>
                </tr>
                <tr>
                    <td><b>Nome do diretor do campus de origem:</b> ' . $diretor . '</td>
                </tr>
                <tr>
                    <td><b>Telefone do câmpus:</b> ' . $telefone_campus . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fax do câmpus:</b> ' . $fax . '</td>
                </tr>
             </table>
             <p></p>
             <h1>3 - Informações Sobre a Mobilidade</h1>
             <table border="1" style="width:930px;text-align:left;border-collapse: collapse;border: 1px solid black;">
            <tr style="border-collapse: collapse;border: 1px solid black;">
                <td style="width:190px;border: 1px solid black;"> <b><br />Universidade de Destino:</b></td>
                <td><p style="color:white;">obladiobladalá</p></td>
             </tr>
             <tr style="border-collapse: collapse;border: 1px solid black;">
                <td style="height:30px;border: 1px solid black;"> <b><br />Curso:</b></td>
                <td><p style="color:white;">obladiobladalá</p></td>
             </tr>
             </table>
             <p></p>
             <table border="0" cellpadding="4">
                <tr>
                    <td><b>Período de estudos pretendido no exterior:</b> ' . $periodo . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Tipo de atividade:</b> ' . $atividade . '</td>
                </tr>
                <tr>
                    <td><b>Informações adicionais:</b> ' . $informacoes_adicionais . '</td>
                </tr>
             </table>
             <p></p>
             <h1>4 - Conhecimentos Lingüísticos</h1>
             <table border="0" cellpadding="4">
                <tr>
                    <td><b>Língua materna:</b> ' . $lingua_materna . '</td>
                </tr>
                <tr>
                    <td><b>Conhecimento de outras línguas:<br /></b><b>Idioma:</b> ' . $outros_idiomas[0] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[0] . '</td>
                </tr>
             ';

        switch ($cont_outros_idiomas) {
            case 1:
                $html .= '</table>';
            break;
            case 2:                
                $html .= '<tr>
                    <td><b>Idioma:</b> ' . $outros_idiomas[1] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[1] . '</td>
                </tr>
             </table>';
            break;
            case 3:
                $html .= '<tr>
                    <td><b>Idioma:</b> ' . $outros_idiomas[1] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[1] . '</td>
                </tr>
                <tr>
                    <td><b>Idioma:</b> ' . $outros_idiomas[2] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[2] . '</td>
                </tr>
             </table>';
            break;
            case 4:
                $html .= '<tr>
                    <td><b>Idioma:</b> ' . $outros_idiomas[1] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[1] . '</td>
                </tr>
                <tr>
                    <td><b>Idioma:</b> ' . $outros_idiomas[2] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[2] . '</td>
                </tr>
                <tr>
                    <td><b>Idioma:</b> ' . $outros_idiomas[3] . '&nbsp;&nbsp;&nbsp;&nbsp;<b>Fluência lingüística:</b> ' . $fluencia[3] . '</td>
                </tr>
             </table>';
            break;

        } 

// output the HTML content
        $this->pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
        $this->pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
// add a page
        $this->pdf->AddPage();

// create some HTML content

        $html = '<h1>5 - Financiamento</h1>
             <table border="0" cellpadding="4">
                <tr>
                    <td>' . $financiamento . '</td>
                </tr>
             </table>
             <p></p>
             <h1>6 - Carta de Motivação</h1>
                ';

// output the HTML content
        $this->pdf->writeHTML($html, true, false, true, false, '');

        $this->pdf->write(0, $carta_motivacao, '', 0, 'J', true, 0, false, false, 0);

        $html = '<p></p>
            <h1>7 - Atividades Extracurriculares</h1>';

        $this->pdf->writeHTML($html, true, false, true, false, '');

        $this->pdf->SetFont('dejavusans', 'B', 9);

        $this->pdf->write(0, "Envolvimento em programas, atividades, organizações, eventos e iniciação científica relacionados ao curso de graduação:\n", '', 0, 'J', true, 0, false, false, 0);

        $this->pdf->SetFont('dejavusans', '', 10);

        $this->pdf->write(0, $iniciacao_cientifica, '', 0, 'J', true, 0, false, false, 0);

        $this->pdf->SetFont('dejavusans', 'B', 9);

        $this->pdf->write(0, "Envolvimento em programas, atividades, organizações, eventos de extensão culturais e/ou internacionais:\n", '', 0, 'J', true, 0, false, false, 0);

        $this->pdf->SetFont('dejavusans', '', 10);

        $this->pdf->write(0, $extencao_cultural, '', 0, 'J', true, 0, false, false, 0);

// reset pointer to the last page
        $this->pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
// add a page
        $this->pdf->AddPage();

// create some HTML content
        $html = '<h1>8 - Condições</h1>
            <p>A Diretoria de Relações Internacionais - DRI <b><u>não</u></b> se responsabilizapelos procedimentos e prazos estabelecidos pelos Consulados de cada país para solicitação do visto de estudante.</p><p>A DRI também <b><u>não</u></b> se responsabiliza pela reserva de alojamento na Universidade de Destino ou pela aquisição de seguro de saúde internacional ou passagem aérea.</p><p>Cada candidato, após recebimento da Carta de Aceite da Universidade de Destino, se responsabiliza pelos procedimentos para solicitação de visto, reserva de alojamento e aquisição do seguro de saúde internacional.</p><p>Todas as informações referentes aos procedimentos descritos acima estão disponíveis nos sites das universidades, consulados, seguradoras e agências de viagens.</p><p>No seu retorno, o estudante se compromete a enviar um relatório das atividades desenvolvidas no intercâmbio.</p><p>A confirmação da candidatura e orientações sobre a mobilidade serão encaminhadas ao estudante, por e-mail (fornecido pelo candidato no item 1 deste formulário).</p>
            <h1>9 - Termo de Responsabilidade</h1>
            <p></p>
            ';

        $left_column = '<p>Confirmo a veracidade das informações fornecidas neste formulário.</p><p>Aceito as condições do programa de intercâmbio, comprometendo-me cumprir as regras do IFSULDEMINAS e os custos referentes à aquisição de seguro de saúde internacional e as demais responsabilidades financeiras não previstas no acordo. Comprometo-me a enviar, à Assessoria de Relações Internacionais, um relatório das atividades desenvolvidas no período do intercâmbio.</p><p><b>Estou ciente de que, em caso de desistência após o envio dos documentos originais à universidade de destino, não mais serei elegível para participar de outros processos seletivos na área internacional durante o curso de graduação.</b></p>';

        $this->pdf->SetFont('dejavusans', '', 9);

        $this->pdf->writeHTML($html, true, 0, true, true);

// get current vertical position
        $y = $this->pdf->getY();

// set color for background
        $this->pdf->SetFillColor(255, 255, 255);

// set color for text
        $this->pdf->SetTextColor(0, 0, 0);

// output the HTML content

        $this->pdf->writeHTMLCell(155, '', '', $y, $left_column, 0, 0, 1, true, 'J', true);

        $assinatura = '<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p>Data:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/         <br />Assinatura do aluno (com reconhecimento de firma):</p>
            <p></p>
            ';

        $this->pdf->SetFont('dejavusans', '', 8);

        $this->pdf->writeHTML($assinatura, true, 0, true, true);

        $this->pdf->Image('/var/www/sismobil/application/libraries/tcpdf/images/quadro3x4.jpg', 170, $y, 0, 0, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);

        $html = '<h1>10 - Autorização DRI</h1>
            <p><b><i>(A ser assinado pelo responsável pela mobilidade na Assessoria de Relações Internacionais do IFSULDEMINAS)</i></b></p>
            <p>Autorizo a participação do estudante que preencheu esse formulário.</p>
            ';

        $this->pdf->SetFont('dejavusans', '', 9);

        $this->pdf->writeHTML($html, true, 0, true, true,'J');

        $assinatura = '<p></p><p></p><p></p><p>Data:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/         <br />Assinatura:</p>';

        $this->pdf->SetFont('dejavusans', '', 8);

        $this->pdf->writeHTML($assinatura, true, 0, true, true);

        $html = '<p></p><p></p><p><b>Enviar este formulário de inscrição para:</b><i><br />Instituto Federal de Educação, Ciência e Tecnologia do Sul de Minas - IFSULDEMINAS<br />Assessoria de Relações Internacionais<br />Rua Ciomara Amaral de Paula,167<br />Bairro Medicina<br />Pouso Alegre – MG<br />Cep: 37.550-000</i></p>
            ';

        $this->pdf->SetFont('dejavusans', '', 9);

        $this->pdf->writeHTML($html, true, 0, true, true,'C');

// reset pointer to the last page
        $this->pdf->lastPage();
            
// ---------------------------------------------------------
//Close and output PDF document
        $this->pdf->Output('ficha_candidatura_'. $nome .'.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
    }

}

?>
