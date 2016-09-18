<?php


class Accueil_operation extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('cey_operation','ops');

    }

    

    public function index($id)
    {
        $this->accueil_operation($id);

    }

    public function accueil_operation($id)
    {
        if($this->session->userdata('loggin')){

            $id_traits = (int) $id;


            //** CODE **
            $operation = $this->ops->liste_operation_by_traitement($id_traits);
            $level = $this->session->userdata('level');
            //** END CODE **
            
        
            // *** PARAMETRE VUE
            $data['titre'] = 'ACCUEIL PROCESSUS';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min');
            $data['level'] = $level;
            if(!empty($operation)){
                $data['operation'] = $operation;
            }
            // *** END PARAMETRE VUE
        
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            $this->load->view('front/accueil_operation_view.php', $data);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }

}