<?php 
class Cey_processus extends CI_Model
{
	
	protected $table = 'cey_process';

	public function liste_processus($process)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('cey_process_id', $process)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_processus_first($process)
	{
		$rq = $this->db->select('cey_process_id')
						->from($this->table)
						->where('process_id', $process)
						->order_by('ordre','asc')
						->limit(1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_processus_dern($process)
	{
		$rq = $this->db->select('cey_process_id, ordre')
						->from($this->table)
						->where('process_id', $process)
						->order_by('ordre','desc')
						->limit(1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function get_processus_by_id($procid)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('cey_process_id', $procid)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function ajouter_processus($data)
	{
		
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
    	
	}

	public function editer_processus($data_set, $id) {
		return $this->db->where("cey_process_id", $id)
						->update($this->table, $data_set);
	}
	
}