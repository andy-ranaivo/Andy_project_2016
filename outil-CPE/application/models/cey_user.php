<?php 

// REPRESENTATION DE LA TABLE (fte_user)
class Cey_user extends CI_Model
{
	
	protected $table = 'cey_user';

	// TRAITEMENT DE L'AUTHENTIFICATION
	public function verifier_login($mle, $pass)
	{
		$rq = $this->db->select('matricule, pass,level')
						->from($this->table)
						->where('matricule', $mle)
						->where('pass', $pass)
						->limit(1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
	
}