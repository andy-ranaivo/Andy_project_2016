<?php 

// REPRESENTATION DE LA TABLE (fte_user)
class Cey_script extends CI_Model
{
	
	protected $table = 'cey_script';

	// TRAITEMENT DE L'AUTHENTIFICATION
	public function liste_script_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('cey_script_id', $id)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
	
}