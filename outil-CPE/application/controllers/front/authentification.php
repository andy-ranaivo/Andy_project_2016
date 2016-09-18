<?php

// TRAITEMENT  AUTHENTIFICATION PAR (MATRICULE, MOT DE PASSE)
class Authentification extends CI_Controller {

	public function __construct()
    {
        //  OBLIGATOIRE CONTRUCTEUR
        parent::__construct();
        $this->load->model('cey_user');
        $this->load->library('form_validation');

    }

	public function index()
	{
		$this->authentification();
	}

	public function authentification()
	{
		if($this->input->post('ajax') == '1') {
			
			// VALIDATION DU CHAMPS DU FORMULAIRE (MATRICULE, MOT DE PASSE)
			$this->form_validation->set_rules('matricule', 'Matricule', 'integer|trim|required|min_length[2]|max_length[10]|xss_clean|htmlspecialchars');
			$this->form_validation->set_rules('pass', 'Mot de passe', 'trim|required|min_length[4]|max_length[8]|xss_clean|htmlspecialchars');

			// PERSONNALISATION DES MESSAGES D'ERREUR
			$this->form_validation->set_message('required', 'le champs est obligatoire');
			$this->form_validation->set_message('max_length', 'longueur de champs invalide');
			$this->form_validation->set_message('min_length', 'longueur de champs invalide');
			$this->form_validation->set_message('integer', 'il faut entrer une champs numérique');
			$this->form_validation->set_message('htmlspecialchars', 'caractères invalide');
		
			// TRAITEMENT DU FORMULAIRE
			if($this->form_validation->run()) {
				
				$mle = $this->input->post('matricule');  
		        $pass = $this->input->post('pass');
		        $ip = $this->input->ip_address();
            	
		        // TRAITEMENT A PARTIR DE LA TABLE (cey_user)
				$user = $this->cey_user->verifier_login($mle, $pass);
				
				if($user != false) {

					// POUR L'HISTORIQUE
					$this->session->set_userdata('loggin', true);
					$this->session->set_userdata('ip', $ip);
					$this->session->set_userdata('mle', $mle);

					foreach ($user as $val_user) {
						$level = $val_user->level;
					}

					$this->session->set_userdata('level', $level);

					$level_user = $this->session->userdata('level');

					echo 'success_'.$level_user;
				}else if($user == false){
					echo 'erreur';
				}

	        }else{
	        	echo form_error('matricule' ,'<div class="alert alert-danger" align="center">' ,'</div>')."1".form_error('pass' ,'<div class="alert alert-danger" align="center">' ,'</div>');
	        }

    	}else{
    		redirect('login');
    	}
	}
}

