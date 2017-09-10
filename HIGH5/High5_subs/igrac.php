<?php

class igrac
{
	var $id;
	var $number;
	var $ime;
	var $prezime;
	var $starost;
	var $stamina;
	var $moral;
	var $visina;
	var $pozicija;
	var $brzina;
	var $agresivnost;
	var $sut_za_2;
	var $sut_za_3;
	var $sut_za_slobodna;
	var $skok_u_napadu;
	var $asistencija;
	var $dribling;
	var $skok_u_odbrani;
	var $blokada;
	var $presecen_pas;
	var $ukradena_lopta;
	var $aktivan;
	var $index;
	var $poeni;
	
	public function __construct($id,$n,$i,$pr,$sr,$sm,$m,$v,$p,$b,$a,$s2,$s3,$s1,$skn,$as,$d,$sko,$bl,$pp,$ul,$akt,$index,$poeni)
	{
		$this->id = $id;
		$this->number = $n;
		$this->ime = $i;
		$this->prezime = $pr;
		$this->starost = $sr;
		$this->stamina = $sm;
		$this->moral = $m;
		$this->visina = $v;
		$this->pozicija = $p;
		$this->brzina = $b;
		$this->agresivnost = $a;
		$this->sut_za_2 = $s2;
		$this->sut_za_3 = $s3;
		$this->sut_za_slobodna = $s1;
		$this->skok_u_napadu = $skn;
		$this->asistencija = $as;
		$this->dribling = $d;
		$this->skok_u_odbrani = $sko;
		$this->blokada = $bl;
		$this->presecen_pas = $pp;
		$this->ukradena_lopta = $ul;
		$this->aktivan = $akt;
		$this->index = $index;
		$this->poeni = $poeni;	
	}
	
}

?>