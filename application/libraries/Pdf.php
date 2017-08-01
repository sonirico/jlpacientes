<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once("./vendor/dompdf/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    public function generate($html, $filename = 'document', $stream = true, $paper = 'A4', $orientation = "")
    {
        $options = new Options();
        $options->setIsPhpEnabled(true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 1));
        } else {
            return $dompdf->output();
        }
    }
}