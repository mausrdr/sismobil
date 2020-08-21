<?php

class Pdf_classificacao_controller extends MY_controller {

    function __construct() {

        parent::__construct();
        
        $this->load->model('ficha_candidatura_to');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('edital_dao');
        
    }
    
    function index() {

        //$texto = 'Primeiro teste de geração automática de pdf via codeigniter!!!';
        $this->generatePdf();
    }

    private function generatePdf() {
        $this->load->library('pdf');

        require_once K_PATH_MAIN.'config/lang/bra.php';
        // set document information
        $this->pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('mauro.rodrigues');
        $this->pdf->SetTitle('Resultado Final da Mobilidade Estudantil');
        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        
        $this->pdf->Header();

// set default header data
        //$this->pdf->SetHeaderData('brasao.svg', 30, 'PDF_HEADER_TITLE', 'PDF_HEADER_STRING');
        $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
       

// set header and footer fonts
        $this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        $this->pdf->SetMargins(5, 60, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(5);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
        $this->pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set font
        $this->pdf->SetFont('times', 'B', 14);

// add a page
        $this->pdf->AddPage();
        
        $lista = $this->input->post('lista');
        $edital = $this->edital_dao->getNumeroEdital($this->input->post('id_edital'));
        
        for ($i = 0; $i < count($lista['nome']); $i++) {
            $data[$i] = array(
                $lista['nome'][$i],
                $lista['cpf'][$i],
                $lista['campus'][$i],
                $lista['cora'][$i],
                $lista['binario'][$i],
            );
        }
        
        // column titles
        $header = array('Class.', 'Nome', 'CPF', 'CoRA', 'B.I.C', 'P.V.P.P', 'P.O', 'Estágio', 'E.C./C');
        
        $txt = "Edital Nº. ".$edital;
        
        $this->pdf->Cell(0, 0, 'Resultado Final da Mobilidade Estudantil', 0, 1, 'C', false);
        $this->pdf->Cell(0, 0, $txt, 0, 2, 'C', false);
        
        $campus_unique = array_unique($lista['campus']);
        
        foreach ($campus_unique as $campus) {
            $this->pdf->SetFont('times', 'B', 14);
            $this->pdf->Ln();
            $this->pdf->Cell(0, 0, $campus, 0, 1, 'C', false);
            $this->pdf->Ln();
            $this->pdf->SetFont('dejavusans', '', 10);
            // print colored table
            $this->pdf->ColoredTable($header, $data, $campus);
        }

// reset pointer to the last page
        $this->pdf->lastPage();
        
        $str_edital = str_replace('/', '_', $edital);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Close and output PDF document
        $this->pdf->Output('Classificacao_do_Edital_'. $str_edital .'.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
    }

}

?>
