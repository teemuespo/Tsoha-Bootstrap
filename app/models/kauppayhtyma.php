<?php
class Kauppayhtyma extends BaseModel{
    // Attribuutit
    public $id, $nimi, $bonus;
    // Konstruktori
    public function __construct($attributes){
    	parent:: __construct($attributes);
    }
    public static function all(){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT * FROM Kauppayhtyma');
	    // Suoritetaan kysely
	    $query->execute();
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kauppayhtymat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    foreach($rows as $row){
	      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
	      $kauppayhtymat[] = new Kauppayhtyma(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'bonus' => $row['bonus']
	      ));
	    }

	    return $kauppayhtymat;
    }
    public static function find($id){
	    $query = DB::connection()->prepare('SELECT * FROM Kauppayhtyma WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
	    $row = $query->fetch();

	    if($row){
	      $kauppayhtyma = new Kauppayhtyma(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'bonus' => $row['bonus']
	      ));

	      return $kauppayhtyma;
	    }

	    return null;
	}
	public static function kaupat($id){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT * FROM Kauppa WHERE kauppayhtyma_id = :id');
	    // Suoritetaan kysely
	    $query->execute(array('id' => $id));
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kaupat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    if($rows){
		    foreach($rows as $row){
		      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
		      $kaupat[] = new Kauppa(array(
		        'id' => $row['id'],
		        'nimi' => $row['nimi'],
		        'osoite' => $row['osoite'],
		        'kauppayhtyma_id' => $row['kauppayhtyma_id']
		      ));
		    }

		    return $kaupat;
		}
		return null;    
    }    
	 
	public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Kauppayhtyma (nimi, bonus) VALUES (:nimi, :bonus) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('nimi' => $this->nimi, 'bonus' => $this->bonus));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	}
	public function destroy($id) {
		$query = DB::connection()->prepare('UPDATE Kauppa SET kauppayhtyma_id = :kauppayhtyma_id WHERE kauppayhtyma_id = :id');
		$query->execute(array('id' => $id, 'kauppayhtyma_id' => 6));
		$query = DB::connection()->prepare('DELETE FROM Kauppayhtyma WHERE id = :id RETURNING id');
		$query->execute(array('id' => $id));
	}
	public function update($id){
		$query = DB::connection()->prepare('UPDATE Kauppayhtyma SET nimi = :nimi, bonus = :bonus WHERE id = :id');
		$query->execute(array('nimi' => $this->nimi, 'bonus' => $this->bonus, 'id' => $id));
		$row = $query->fetch();

		if($row){
	      $kauppayhtyma = new Kauppayhtyma(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'bonus' => $row['bonus']
	      ));

	      return $kauppayhtyma;
	    }

	    return null;
	}

}
