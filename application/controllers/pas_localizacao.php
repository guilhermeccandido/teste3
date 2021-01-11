<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_localizacao extends App_controller {
const VIEW_FOLDER = 'admin/pas_localizacao';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_localizacaodao');
        Echo 'AINDA UTILIZADA, DESABILITAR';
        DIE;
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_pas'] = $id;
    	 
    	$this->load->model('pas_localizacaodao');
    	$ant = new pas_localizacaodao();
    	 
    	$data['pas_localizacao'] = $ant->get_pas_localizacao_by_id_pas($id);
    	//$this->PAR($data['pas_localizacao']);
    
        //load the view
        $data['main_content'] = 'admin/pas_localizacao/list';
        $this->load->view('includes/template', $data);
    
    }//index

    public function lista_localizacao(){
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    
    	//product id
    	$id = $this->uri->segment(4);
    	 
    	$data['id_pas'] = $id;
    
    	$data['pas_localizacao'] = $this->pas_localizacaodao->get_pas_localizacao_by_id_pas($id);
    	
    	//$this->PAR($data['acompanhamento_fisico']);
    
    	$data['localizacao_not_defined'] = $this->pas_localizacaodao->get_pas_localizacao_not_defined_by_id_pas($id);
    
    	//load the view
    	$data['main_content'] = 'admin/pas_localizacao/list';
    	$this->load->view('includes/template', $data);
    }
    
    
public function add()
    {

    $data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
    	$id_localizacao = $this->uri->segment(5);
    	
    	if($id_localizacao){
    		$data['id_localizacao']  = $id_localizacao;
    	}
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required'); 
        	$this->form_validation->set_rules('id_localizacao', 'id_localizacao', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_pas' => $this->input->post('id_pas'),
                		'id_localizacao' => $this->input->post('id_localizacao'),
                );
                
                
                $this->load->model('localizacaodao');
                $localizacao = new localizacaodao();
                $localizacaoData = $localizacao->get_localizacao_by_id($id_localizacao);
                
                $fileName = $_FILES["file"]["name"];
                $target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
                 
                $uploadOk = 1;
                $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                
                if ($uploadOk == 0 or $fileName == '') {
                	$data['flash_message'] = FALSE;
                }
                else {
                	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                
                		$file_out = PAS_FOLDER . $id_pas.'/localizacao';
                
                		if( !file_exists($file_out)){
                			mkdir($file_out, 0777, true);
                		}
                
                		if(file_exists($file_out.'/' .$id_pas.'.kmz')){
                			unlink($file_out.'/' .$id_pas.'.kmz');
                		}
                
                		copy ( $target_file , $file_out.'/' .$id_pas.'.kmz');
                		unlink($target_file);
                
                		//if the insert has returned true then we show the flash message
                		if($this->pas_localizacaodao->store_pas_localizacao($data_to_store)){
                			$data['flash_message'] = TRUE;
                		}else{
                			$data['flash_message'] = FALSE;
                		}
                		 
                	} else {
                		$data['flash_message'] = FALSE;
                	}
                }

            }

        }
                		
        //load the view
        $data['main_content'] = 'admin/pas_localizacao/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_pas = $this->uri->segment(5); 
  		$data['id_pas'] = $id_pas;
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required');
        	$this->form_validation->set_rules('id_localizacao', 'id_localizacao', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'id_pas' => $this->input->post('id_pas'),
        	'id_localizacao' => $this->input->post('id_localizacao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_localizacaodao->update_pas_localizacao($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_localizacao/update/'.$id.'/'.$id_pas);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['pas_localizacao'] = $this->pas_localizacaodao->get_pas_localizacao_by_id($id);
        		
        $data['localizacao'] = $this->pas_localizacaodao->get_localizacao_not_related_pas_by_id_pas($id_pas, $data['pas_localizacao'][0]['id_localizacao']);
        //$this->PAR($data['localizacao']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/pas_localizacao/edit';
        $this->load->view('includes/template', $data);
    
    }//update
    	
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
    
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    					
        $id = $this->uri->segment(4);
    	$id_pas = $this->uri->segment(5);
        $this->pas_localizacaodao->delete_pas_localizacao($id);
        redirect('admin/pas_localizacao/lista_localizacao/'.$id_pas);
    }//edit
    	}