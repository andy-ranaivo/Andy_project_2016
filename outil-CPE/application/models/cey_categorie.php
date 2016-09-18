<?php 
class cey_categorie extends CI_Model
{
	
	protected $table = 'cey_categorie';

	public function liste_categories()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('fte_categories_id', $id)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_niveau($niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('niveau', $niveau)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
	public function getNomcategorieById($id){
		$rq = $this->db->select('info_categorie')
					   ->from($this->table)
					   ->where('cey_categorie_id',$id)
					   ->get();
		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_by_parent($parent)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('parent_id', $parent)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
		
}