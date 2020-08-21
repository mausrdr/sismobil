<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        
        parent::__construct();
        
    }
    
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'brasao.svg';
        $this->ImageSVG($image_file, $x=92.5, $y=5, $w=20, $h=20, $link='', $align='', $palign='C', $border=0, $fitonpage=true);
        // Set font
        $this->SetFont('times', 'B', 14);
        // Title
        $this->Cell(0, 15, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 15, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 10, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        
        $this->Cell(0, 0, 'MINISTÉRIO DA EDUCAÇÃO', 0, 1, 'C', false);
        $this->Cell(0, 0, 'Secretaria de Educação Profissional e Tecnológica', 0, 1, 'C', false);
        $this->Cell(0, 0, 'Instituto Federal de Educação, Ciência e Tecnologia do Sul de Minas Gerais', 0, 1, 'C', false);
        
    }
    
    public function ColoredTable($header,$data, $campus) {
        // Colors, line width and bold font
        $this->SetFillColor(148, 148, 148);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        
        for ($i = 0; $i < count($data); $i++) {
                        
            if($i == 0) {
                $max_len = strlen($data[$i][0]);
            }

            $len = strlen($data[$i][0]);

            if($max_len < $len) {
                $max_len = $len;
            }

        }
        
        $total = round(1.929 * $max_len);
        
        // Header
        $w = array(12, $total, 26, 11, 10, 15, 8, 16, 12);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        $i = 1;
        foreach($data as $row) {
            if($row[2] == $campus) {
                $this->Cell($w[0], 6, $i++, 'LR', 0, 'C', $fill);
                $this->Cell($w[1], 6, $row[0], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row[1], 'LR', 0, 'C', $fill);
                $this->Cell($w[3], 6, $row[3], 'LR', 0, 'C', $fill);
                for ($j = 0; $j < strlen($row[4]); $j++) {
                    if($row[4][$j] == 1) {
                        $this->Cell($w[$j + 4], 6, 'Sim', 'LR', 0, 'C', $fill);
                    } else {
                        $this->Cell($w[$j + 4], 6, 'Não', 'LR', 0, 'C', $fill);
                    }
                }
                $this->Ln();
                $fill=!$fill;
            }
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
}

?>