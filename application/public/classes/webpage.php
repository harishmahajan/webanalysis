<?php
/**
 * Created by Indrek Päri
 * Date: 21.03.14 15:06
 */

abstract class Webpage{

    public $TemplateData = array(
        'name' => 'main.tpl',
        'data' => array()
    );

    public function addSub($sFile,$sVarName,$aData)
    {
        $this->TemplateData['subtemplates'][$sVarName] = array(
            'name' => $sFile,
            'data' => $aData
        );
    }

    public function popSub($sFile,$sVarName,$aData)
    {
        $this->TemplateData['subtemplates'][$sVarName] = array(
            'name' => $sFile,
            'data' => $aData
        );
    }

}