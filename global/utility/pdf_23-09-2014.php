<?php
/**
 * Created by Indrek Päri
 * Date: 7.04.14 11:26
 */

namespace Utility;

require_once ('library/mpdf/mpdf.php');

class Pdf  extends \mPDF{

    public function __construct()
    {
        parent::__construct();
    }

    public static function Generate($filename,$html)
    {
        $mpdf=new self('utf-8', 'Letter', 10);
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output($filename,'D');
        exit();
    }

}