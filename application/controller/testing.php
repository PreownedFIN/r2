<?php

class Testing extends Controller
{

    public function index()
    {
		echo "testi toimii<br/>";
		
		// controller-kantaluokkaan on lisätty lataaModel-funktio, jotta 
		// erinimisten modelien lataus onnistuu
		$tm = $this->lataaModel("testmodel");
		echo $tm->hello();
    }

}
