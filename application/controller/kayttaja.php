<?php

class Kayttaja extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
		echo "olet käyttäjäcontrollerin index-funktiossa";
    }
	
	public function tarkistaKirjautuminen() {
		if(isset($_POST["kt"]) && isset($_POST["ss"])){
			$kt = $_POST["kt"]
			$ss = $_POST["ss"]
		
			$k_model = $this->lataaModel('kayttajamodel');
			$tulos = $k_model->tarlostaTunnukset($kt, $ss);
			
			if($tulos == false){
				echo "Kirjautuminen epäonnistui";
			} else {
				echo "Kirjautuminen onnistui"
			}
		}
	}
	
    public function lisaa()
    {
		// tarkistetaan ensin, että tänne saapui käyttäjätunnus ja salasana-parametrit
		if(isset($_POST["kt"]) && isset($_POST["ss"])) {
		// echo "parametrejä tuli";
			//TODO: tarkista, että annetut tiedot eivät sisällä kiellettyjä merkkejä
			//TODO: muista kryptata salasana ennen tietokantaan tallennusta
			
			// otetaan käyttäjämodeli käyttöön ja tehdään tietokantalisäys sen avulla
			// lisätyn tunnuksen id tulee paluupostissa modelilta
			// $uusi_id = $this->model->lisaa($_POST["kt"], $_POST["ss"]);
			$k_model = $this->lataaModel('kayttajamodel');
			$uusi_id = $k_model->lisaa($_POST["kt"], $_POST["ss"]);
			
			echo $uusi_id;
		}//if
    }
	
	public function haeRyhmanJasenet(){
		if(isset($_POST["rm"])){
			
		}
	}
	
	public function poistaRyhmasta(){
		
		$kid = _GET["kid"]
	
		$k_model = $this->lataaModel('kayttajamodel');
		$k_model->poistaRyhmasta($_POST["kt"]);
		
		echo null;
	}

     /**
     * ACTION: editSong
     * This method handles what happens when you move to http://yourproject/songs/editsong
     * @param int $song_id Id of the to-edit song
     */
    public function editSong($song_id)
    {
        // if we have an id of a song that should be edited
        if (isset($song_id)) {
            // do getSong() in model/model.php
            $song = $this->model->getSong($song_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/songs/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'songs/index');
        }
    }
    
    /**
     * ACTION: updateSong
     * This method handles what happens when you move to http://yourproject/songs/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a song" form on songs/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateSong()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_update_song"])) {
            // do updateSong() from model/model.php
            $this->model->updateSong($_POST["artist"], $_POST["track"],  $_POST["link"], $_POST['song_id']);
        }

        // where to go after song has been added
        header('location: ' . URL . 'songs/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        $amount_of_songs = $this->model->getAmountOfSongs();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_songs;
    }

}
