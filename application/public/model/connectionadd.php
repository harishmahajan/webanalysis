<?php
namespace Model;

class connectionadd extends \Webpage
{
	public function pop()
	{
		$this->addSub('connection_add.tpl','content',$this->aTplVars);
		exit;
	}
}
?>