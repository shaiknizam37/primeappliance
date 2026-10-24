<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

// include_once 'vendor/mpdf/mpdf.php';
include_once 'vendor/mpdf8/vendor/autoload.php';


class M_pdf {

    public $pdf;
    public function __construct()
    {
        $this->pdf = new \Mpdf\Mpdf();
    }
}
?>