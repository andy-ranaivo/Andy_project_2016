<?php 
class Cey_operation extends CI_Model
{
	
	protected $table = 'cey_operation';

	public function liste_operation()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('flag', 1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_operation_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('cey_operation_id', $id)
						->order_by('ordre')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_operation_by_traitement($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('traitement_id', $id)
						->order_by('ordre')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
	
}