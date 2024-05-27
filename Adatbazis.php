<?php
	class User{
		private $host="localhost";
		private $felhasznalonev="root";
		private $jelszo="";
		private $abNev="pizzahot";
		private $kapcsolat;
    
		//konstuktor
		public function __construct() {	
			$this->kapcsolat = new mysqli(
				$this->host,
				$this->felhasznalonev,
				$this->jelszo,
				$this->abNev
			);
			$siker = 0;
			if ($this->kapcsolat->connect_errno) {
				$siker = "Nem sikerült a kapcsolat";
			}
			else{
				$siker = "Sikerült a kapcsolat";
				//echo $siker;
			}
	
		//ékezetes betűk
		$this->kapcsolat->query("SET NAMES UTF8");
		}

		public function reg_felhasznalo($nev, $email, $jelszo){
			//jelszó titkosítása
			$titkosJelszo = md5($jelszo);

			//lekérdezem a felhasznalo adatai alapján, létezik-e már?
			$email = $this->kapcsolat->query("SELECT email FROM felhasznalo");
			$nev = $this->kapcsolat->query("SELECT nev FROM felhasznalo");
			if ($emailNev == $email || $emailNev==$emailNev) {
				$_SESSION['$login'] = TRUE;
			}
			//ha nem, felveszem/beszúrom a táblába az adatait; szerkesztő lesz alapból, és a bejelentkezett mező 0
				//visszatérek a lekérdezés eredményével (sikerült-e beszúrni)
			//különben hamis
		}
		
		public function bejelentkezes($emailNev, $jelszo){
			//jelszó titkosítása
			//lekérdezés: email vagy nev a megadott érték
			//ha már létezik, 
				//állítsuk be a login kulcsot a sessionben igazra,
				//hozzuk létre a felhAzon kulcsú sessiont,
					//segítség:  $result->fetch_array(MYSQLI_ASSOC);
				//módosítsuk a bejelentkezést 1-re! térjünk vissza igazzal!
			//különben hamissal térjünk vissza!
    	}

    	
    	public function get_nev($felhAzon){
    		//felhAzon alapján név visszaadása
			//$result->fetch_array(MYSQLI_ASSOC);
    	}
		
		public function adminE($felhAzon){
    		//lekérdezés
    	}

	    public function kijelentkezes() {
			$felhAzon = $_SESSION['felhAzon'];
			//módosítsd a bejelentkezett mezőt 0-ra!
	        //állítsd a session login kulcsát hamisra!
	        //állítsd le a sessiont!
	    }
		
		public function aktivok(){
			//lekérdezés
		}
		
		public function megjelenit_aktivok($matrix){
			//listázza az eredményt
		}

	}
?>