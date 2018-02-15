<?php
class Ostotapahtuma extends BaseModel{
    // Attribuutit
    public $tuote_id, $kauppa_id, $hinta, $ostohetki;
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
    public static function tuotteella($id){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT Tuote.nimi as tuote, Tuote.id, Ostotapahtuma.tuote_id, Ostotapahtuma.kauppa_id, Kauppa.nimi as kauppa, hinta, ostohetki FROM Ostotapahtuma LEFT JOIN Tuote ON Ostotapahtuma.tuote_id = Tuote.id LEFT JOIN Kauppa ON Ostotapahtuma.kauppa_id = Kauppa.id WHERE tuote_id = :id');
	    // Suoritetaan kysely
	    $query->execute(array('id' => $id));
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kaupat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    if($rows){
		    foreach($rows as $row){
		      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
		      $ostot[] = array(
		        'tuote' => $row['tuote'],
		        'tuote_id' => $row['tuote_id'],
		        'kauppa' => $row['kauppa'],
		        'kauppa_id' => $row['kauppa_id'],
		        'hinta' => $row['hinta'],
		        'ostohetki' => $row['ostohetki']
		      );
		    }

		    return $ostot;
		}
		return null;
    }
    public static function kaupalla($id){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT Tuote.nimi as tuote, Tuote.id, Ostotapahtuma.tuote_id, Ostotapahtuma.kauppa_id, Kauppa.nimi as kauppa, hinta, ostohetki FROM Ostotapahtuma LEFT JOIN Tuote ON Ostotapahtuma.tuote_id = Tuote.id LEFT JOIN Kauppa ON Ostotapahtuma.kauppa_id = Kauppa.id WHERE kauppa_id = :id');
	    // Suoritetaan kysely
	    $query->execute(array('id' => $id));
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kaupat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    if($rows){
		    foreach($rows as $row){
		      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
		      $ostot[] = array(
		        'tuote' => $row['tuote'],
		        'tuote_id' => $row['tuote_id'],
		        'kauppa' => $row['kauppa'],
		        'kauppa_id' => $row['kauppa_id'],
		        'hinta' => $row['hinta'],
		        'ostohetki' => $row['ostohetki']
		      );
		    }

		    return $ostot;
		}
		return null;
    }
    public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Ostotapahtuma (tuote_id, kauppa_id, hinta, ostohetki) VALUES (:tuote_id, :kauppa_id, :hinta, :ostohetki) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('tuote_id' => $this->tuote_id, 'kauppa_id' => $this->kauppa_id, 'hinta' => $this->hinta, 'ostohetki' => $this->ostohetki));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	}
}    