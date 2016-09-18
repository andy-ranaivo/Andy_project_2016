<?php


class Accueil_categories extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('cey_categorie','cats');
        $this->load->model('cey_traitement','traits');

    }

    

    public function index()
    {

        $this->accueil_categories();

    }


    public function accueil_categories()
    {
        if($this->session->userdata('loggin')){

            //** CODE **
            $categories = $this->cats->liste_categories();
            $level = $this->session->userdata('level');
            //** END CODE **
			
            //** PARAMETRE VUE **
			$data['titre'] = 'ACCUEIL CATEGORIE';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min');
            $data['categories'] = $categories;
            $data['level'] = $level;
            //$data['js'] = array('js/back.js');
            //** END PARAMETRE VUE **
		
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            //$this->load->view('includes/menu_horizental.php');
            $this->load->view('front/accueil_categories_view.php', $data);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }

    public function accueil_traitement()
    {
        if($this->session->userdata('loggin')){

            //** CODE **
            $categories = $this->cats->liste_categories_by_niveau(2);
            $level = $this->session->userdata('level');
            //** END CODE **
            
            //** PARAMETRE VUE **
            $data['titre'] = 'ACCUEIL TRAITEMENT';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min');
            $data['categories'] = $categories;
            $data['level'] = $level;
            //** END PARAMETRE VUE **
        
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            //$this->load->view('includes/menu_horizental.php');
            $this->load->view('front/accueil_traitement_view.php', $data);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }

}