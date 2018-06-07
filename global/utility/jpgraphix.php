<?php
/**
 * Created by Indrek Päri
 * Date: 1.04.14 9:46
 */

namespace Utility;

require_once ('library/jpgraph/jpgraph.php');
require_once ('library/jpgraph/jpgraph_line.php');
require_once ('library/jpgraph/jpgraph_bar.php');

class Jpgraphix
{
    private $graph;

    public function __construct($aWidth=300,$aHeight=200,$aLabels=array(),$aCachedName='',$aTimeout=0,$aInline=true)
    {
        $this->graph = new \Graph($aWidth,$aHeight,$aCachedName,$aTimeout,$aInline);
        $this->graph->SetScale('textlin');

        $theme_class = new \UniversalTheme;
        $this->graph->SetTheme($theme_class);

        $this->graph->SetBox(false);
        $this->graph->SetFrame(false);

        $this->graph->xaxis->SetTickLabels($aLabels);
        $this->graph->xaxis->SetColor('#aaaaaa', '#aaaaaa');

        $this->graph->yaxis->HideZeroLabel();
        $this->graph->yaxis->HideLine(false);
        //$this->graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
        $this->graph->yaxis->HideTicks(false,false);
        $this->graph->yaxis->SetColor('#aaaaaa', '#aaaaaa');

        $this->graph->ygrid->SetFill(false);

        $this->graph->legend->SetMarkAbsSize(6);

    }

    public function addBar($aData,$sLabel,$sColor,$sFcolor)
    {
        $oLineplot = new \BarPlot($aData);
        $this->graph->Add($oLineplot);

        $oLineplot->SetColor($sColor);
        $oLineplot->SetFillColor($sFcolor);

        $oLineplot->SetLegend($sLabel);
    }

    public function addLinear($aData,$sLabel,$sColor,$sFcolor)
    {
        $oLineplot = new \LinePlot($aData);
        $this->graph->Add($oLineplot);

        $oLineplot->SetColor($sColor);
        $oLineplot->SetFillColor($sFcolor);

        $oLineplot->mark->SetType(MARK_FILLEDCIRCLE);
        $oLineplot->mark->color = $sColor;
        $oLineplot->mark->SetFillColor($sColor);

        $oLineplot->SetLegend($sLabel);
    }

    public function show()
    {
        // Display the graph
        $this->graph->Stroke();
    }
}