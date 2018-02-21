<?php
class Kauppa extends BaseModel{
    // Attribuutit
    public $id, $nimi, $osoite, $kauppayhtyma_id;
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
    public static function all(){
    	 // Alustetaan kysely tietokantayhteydellämme
    	//$options = array('id' => $options['id']);
	    $query = DB::connection()->prepare('SELECT Kauppa.id, Kauppa.nimi, Kauppa.kauppayhtyma_id, Kauppa.osoite, Kauppayhtyma.nimi as kauppayhtyma FROM Kauppa LEFT JOIN Kauppayhtyma ON Kauppa.kauppayhtyma_id = Kauppayhtyma.id');
	    // Suoritetaan kysely
	    $query->execute();
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kaupat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    foreach($rows as $row){
	      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)

	      $kaupat[] = array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'osoite' => $row['osoite'],
	        'kauppayhtyma' => $row['kauppayhtyma'],
	        'kauppayhtyma_id' => $row['kauppayhtyma_id']
	      );
	    }

	    return $kaupat;
    }
    public static function find($id){
	    $query = DB::connection()->prepare('SELECT Kauppa.Id, Kauppa.nimi, Kauppa.osoite, Kauppa.kauppayhtyma_id, Kauppayhtyma.nimi as kauppayhtyma FROM Kauppa LEFT JOIN Kauppayhtyma ON Kauppa.kauppayhtyma_id = Kauppayhtyma.id WHERE Kauppa.id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
	    $row = $query->fetch();

	    if($row){
	      $kauppa = array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'osoite' => $row['osoite'],
	        'kauppayhtyma_id' => $row['kauppayhtyma_id'],
	        'kauppayhtyma' => $row['kauppayhtyma']
	      );

	      return $kauppa;
	    }

	    return null;
	  }
	public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Kauppa (nimi, osoite, kauppayhtyma_id) VALUES (:nimi, :osoite, :kauppayhtyma_id) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('nimi' => $this->nimi, 'osoite' => $this->osoite, 'kauppayhtyma_id' => $this->kauppayhtyma_id));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	  }  
	public function update($id){
		$query = DB::connection()->prepare('UPDATE Kauppa SET nimi = :nimi, osoite = :osoite, kauppayhtyma_id = :kauppayhtyma_id WHERE id = :id');
		$query->execute(array('nimi' => $this->nimi, 'osoite' => $this->osoite, 'kauppayhtyma_id' => $this->kauppayhtyma_id, 'id' => $id));
		$row = $query->fetch();

		if($row){
	      $kauppa = new Kauppa(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'osoite' => $row['osoite'],
	        'kauppayhtyma_id' => $row['kauppayhtyma_id']
	      ));

	      return $kauppa;
	    }

	    return null;
	} 
	public function destroy($id) {
		$query = DB::connection()->prepare('DELETE FROM Ostotapahtuma WHERE kauppa_id = :id');
		$query->execute(array('id' => $id));
		$query = DB::connection()->prepare('DELETE FROM Kauppa WHERE id = :id RETURNING id');
		$query->execute(array('id' => $id));
	} 
}