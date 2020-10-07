<?
namespace createPDF;
require_once $_SERVER["DOCUMENT_ROOT"].'/generate_pdf/pdfcrowd.php';

class createPDF{

    protected $htmlData = "";
    private $pdfCrowdLogin = 'fsknw_ru';
    private $pdfCrowdToken = '3b29a3def55166e228ffba6e176bac92';

    private function generateHTML($flatID)
    {
        $this->htmlData = file_get_contents('https://fsknw.ru/generate_pdf/print.php?ID='.$flatID);
        /*ob_start();
        echo
        $this->htmlData = ob_get_contents();
        ob_end_flush();*/
    }

    public function generatePDF($flatID, $fileName)
    {
        $this->generateHTML($flatID);
        $this->connectPdfCrowd($fileName, $this->htmlData);
        //$this->file_force_download($fileName);
    }

    public function file_force_download($file) {
        if (file_exists($file)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    protected function connectPdfCrowd($fileName, $htmlData){
        try {
            $client = new \Pdfcrowd\HtmlToPdfClient($this->pdfCrowdLogin, $this->pdfCrowdToken);
            $client->setSmartScalingMode('content-fit');
            $client->setDebugLog(true);
            $html = mb_convert_encoding($htmlData, 'HTML-ENTITIES', 'UTF-8');
            $output_stream = fopen($fileName, "wb");
            if (!$output_stream) {
                throw new \Exception(error_get_last()['message']);
            }
            $client->convertStringToStream($html, $output_stream);
            fclose($output_stream);

        } catch (\Pdfcrowd\Error $why) {
            error_log("Pdfcrowd Error: {$why}\n");
            //print_r($why);
        }
    }
}

//1488
$flatID = $_GET['ID']?:1488;
$fileName = $flatID.'.pdf';
$filePath = '/generate_pdf/files/';
$file = $_SERVER['DOCUMENT_ROOT'].$filePath.$fileName;
//if(!file_exists($file)){
$pdf = new createPDF();
$pdf->generatePDF($flatID, $file);
//}
echo json_encode([
    'file' => 'https://fsknw.ru'.$filePath.$fileName
]);
?>
