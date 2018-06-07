<?php
/**
 * Created by Indrek Päri
 * Date: 16.01.14 10:56
 */

namespace Utility;

include_once('library/smarty/Smarty.class.php');

class SmartyTemplate extends \Smarty
{
    public function __construct()
    {
        parent::__construct();
    }
    public static function fetchTemplate($sTemplateName, $aTemplateData = array())
    {
        $smarty = new self();
//		$smarty->debugging = true;
//		$smarty->force_compile = true;
//		$smarty->caching = true;
//		$smarty->cache_lifetime = 120;

//        $smarty->assign('var', $aTemplateData);
        $smarty->assign($aTemplateData);
        return $smarty->fetch($sTemplateName);
    }
    public function fetch($template = null, $cache_id = null, $compile_id = null, $parent = null, $display = false, $merge_tpl_vars = true, $no_output_filter = false)
    {
        $this->setTemplatePath($template);
        $this->setPluginsDir(array('global/smarty_plugins/','library/smarty/plugins/'));

        return parent::fetch($template, $cache_id, $compile_id, $parent, $display, $merge_tpl_vars, $no_output_filter);
    }

    private function setTemplatePath($sFilename)
    {
        $sTemplatePath = 'application/'.APPLICATION.'/templates/';
        $sCachePath = 'cache/'.APPLICATION.'/templates/';

        $sGlobalTemplatePath = 'global/templates/';
        $sGlobalCachePath = 'cache/global/templates/';

        if(is_file($sTemplatePath.$sFilename))
        {
            $this->setTemplateDir(realpath($sTemplatePath));

            if(is_dir($sCachePath))
            {
                $this->setCompileDir(realpath($sCachePath));
            }
            else
            {
                trigger_error('Compile_dir not found: "<b>' . $sCachePath . '</b>".', E_USER_ERROR);
            }
        }
        elseif(is_file($sGlobalTemplatePath.$sFilename))
        {
            $this->setTemplateDir(realpath($sGlobalTemplatePath));

            if(is_dir($sGlobalCachePath))
            {
                $this->setCompileDir(realpath($sGlobalCachePath));
            }
            else
            {
                trigger_error('Compile_dir not found: "<b>' . $sGlobalCachePath . '</b>".', E_USER_ERROR);
            }
        }
        else
        {
            trigger_error('Template file not found: "<b>' . $sFilename . '</b>".', E_USER_ERROR);
        }
    }
}