<?php
/**
 * Created by Indrek Päri
 * Date: 3.04.14 13:58
 */

namespace Utility;

class Phantom_chart
{
    public $aVar = array();
    private $aData = array();

    function __construct($aWidth=300,$aHeight=200,$aLabels=array()){
        $this->aData['width'] = $aWidth;
        $this->aData['height'] = $aHeight;
        //$this->aData['options']['fontSize'] = '12';
        $this->aData['options']['fontName'] = 'Verdana';

        $this->aData['data'][0][] = 'Label';
        foreach($aLabels as $k => $label)
        {
            $this->aData['data'][($k+1)][] = $label;
        }
    }

    public function addBar($aData,$sLabel,$sColor,$sOpacity)
    {
        $this->aVar['color'] = $sColor;
        $this->aVar['opacity'] = $sOpacity;

        $this->aData['data'][0][] = $sLabel;
        foreach($aData as $k => $value)
        {
            $this->aData['data'][($k+1)][] = $value;
        }
    }

    public function addLinear($aData,$sLabel,$sColor)
    {
        $this->aData['data'][0][] = $sLabel;
        foreach($aData as $k => $value)
        {
            $this->aData['data'][($k+1)][] = (int)$value;
        }

        $this->aData['options']['colors'][] = $sColor;
    }

    private function postData($sChartType)
    {
        foreach($this->aData['data'] as $k => $value)
        {
            if($sChartType == 'BarChart')
            {
                if($k == 0) $this->aData['data'][$k][] = array('role'=>'style');
                else $this->aData['data'][$k][] = 'color: '.$this->aVar['color'].'; opacity: '.$this->aVar['opacity'];
            }
        }
    }

    private function isPieChart(){
        $this->aData['options']['legend'] = array('position' => 'right');
        $this->aData['options']['chartArea'] = array('left'=>10,'top'=>10,'width'=>'90%','height'=>'80%');
        $this->aData['options']['is3D'] = true;
    }
    private function isLineChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>60,'top'=>10,'width'=>'90%','height'=>'80%');
        $this->aData['options']['vAxis']['minValue'] = "0";
    }
    private function isBarChart(){
        $this->aData['options']['legend']['position'] = 'none';
        $this->aData['options']['chartArea'] = array('left'=>100,'top'=>10,'width'=>'75%','height'=>'85%');
        $this->aData['options']['bar'] = array('groupWidth'=>'30%');
    }
    private function isAreaChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>50,'top'=>10,'width'=>'85%','height'=>'75%');
        $this->aData['options']['pointSize'] = 7;
    }
    private function isComboChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>70,'top'=>10,'width'=>'75%','height'=>'75%');
        $this->aData['options']['seriesType'] = "line";   
        $this->aData['options']['vAxis']['minValue'] = "0";
    }
    private function isColumnChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>50,'top'=>10,'width'=>'85%','height'=>'75%');
    }

    public function show($sChartType,$sReturnType='img',$options = array())
    {
        $this->postData($sChartType);

        $m = 'is'.$sChartType;
        if(method_exists($this,$m))
        {
            $this->$m();
        }

        $this->aData['options'] = array_merge($this->aData['options'],$options);

        //$debug = true;
        if($sReturnType == 'img')
        {            
            //old code
            // Display the graph          

            exec('sudo phantomjs /var/www/library/phantom_chart/chart.js \''.$sChartType.'\' '.$this->aData['width'].' '.$this->aData['height'].' \''.json_encode($this->aData['options']).'\' \''.json_encode($this->aData['data']).'\' '.(isset($debug)?'1':''),$out);            
            //return '<img src="data:image/png;base64,'.$out[0].'" style="width:400;height:200"/>';
            return '<img src="data:image/png;base64,'.$out[0].'"/>';
            //return '<img src="/var/www/application/public/demo123.png"/>';

        }
        else if($sReturnType == 'html')
        {
            $aTplData['args'] = array(
                '_t' => $sChartType,
                '_w' => $this->aData['width'],
                '_h' => $this->aData['height'],
                '_o' => json_encode($this->aData['options']),
                '_d' => json_encode($this->aData['data']),
                'unique_id' => substr(md5(rand()), 0, 8)
            );

            return \Utility\SmartyTemplate::fetchTemplate('chart.tpl', $aTplData);
        }

    }

}