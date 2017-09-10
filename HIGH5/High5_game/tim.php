<?php
include 'igrac.php';

class tim
{
	var $id;
	var $name;
	var $stil;
	var $logo;
	var $arena;
	var $nizigraca = array();
	var $aktivni = array();
	var $zamene = array();
	
	public function __construct($id,$n,$s,$l,$a,$svi,$akt,$zam)
	{
		$this->id = $id;
		$this->name = $n;
		$this->stil = $s;
		$this->logo = $l;
		$this->arena = $a;
		$this->nizigraca = $svi;
		$this->aktivni = $akt;
		$this->zamene = $zam;
	}
	
}

?>