<?php


class Accueil_action extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('cey_action','acts');

    }

    

    public function index($id)
    {
        $this->accueil_action($id);

    }

    public function accueil_action($id)
    {
        if($this->session->userdata('loggin')){

            $id_traits = (int) $id;


            //** CODE **
            $action = $this->acts->liste_action_by_operation($id_traits);
            $level = $this->session->userdata('level');
            //** END CODE **
            
        
            // *** PARAMETRE VUE
            $data['titre'] = 'ACCUEIL ACTION';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min');
            $data['level'] = $level;
            if(!empty($action)){
                $data['action'] = $action;
            }
            // *** END PARAMETRE VUE
        
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            $this->load->view('front/accueil_action_view.php', $data);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }

}