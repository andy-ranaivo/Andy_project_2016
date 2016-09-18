<?php


class Accueil_traitement extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('cey_categorie','cats');
        $this->load->model('cey_traitement','traits');

    }

    

    public function index($id)
    {
        $this->accueil_traitement($id);

    }

    public function accueil_traitement($id)
    {
        if($this->session->userdata('loggin')){


            $id_cats = (int) $id;
            
            $traitement = $this->traits->liste_traitement_by_categorie($id_cats);
            $categories = $this->cats->liste_categories();
			$nom_categorie=$this->cats->getNomcategorieById($id);
            $nombre_traitement=$this->traits->countTtraitement();

            //** CODE **
            $level = $this->session->userdata('level');
            //** END CODE **
            
            //** PARAMETRE VUE **
            $data['titre'] = 'ACCUEIL TRAITEMENT';
			$data['categories'] = $categories;
			$data['nombre_traitement'] = $nombre_traitement;
			$data['nom_categorie']= $nom_categorie;
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min');
            $data['traitement'] = $traitement;
            $data['level'] = $level;
            $data['js'] = array('js/back.js');
            //** END PARAMETRE VUE **
        
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
			$this->load->view('includes/menu_vertical_traitement.php', $data);
            $this->load->view('includes/menu_verticale_traitement.php',$data);
            $this->load->view('front/accueil_traitement_view.php', $data);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }

}