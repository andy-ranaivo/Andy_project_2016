<?php 
class Cey_action extends CI_Model
{
	
	protected $table = 'cey_action';

	public function liste_action()
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

	public function liste_action_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('cey_action_id', $id)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_action_by_operation($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('operation_id', $id)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
	
}