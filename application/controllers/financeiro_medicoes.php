<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class financeiro_medicoes extends App_controller {
const VIEW_FOLDER = 'admin/financeiro_medicoes';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('financeiro_medicoesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_registro_financeiro = $this->uri->segment(3);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
    	
    	
        $data['financeiro_medicoes'] = $this->financeiro_medicoesdao->get_financeiro_medicoes_by_id_registro_financeiro($id_registro_financeiro, 'id', 'desc');
       // $this->debugMark(null, $data['financeiro_medicoes']);
        
        $i = 0;
        foreach($data['financeiro_medicoes'] as $item){
        	 $tmpArray = $this->financeiro_medicoesdao->get_valor_total_medicao_by_id_financeiro_medicao($item['id']);
        	 $total =  (sizeof($tmpArray) > 0) ?  $tmpArray[0]['total'] : ($item['acrecimos'] + $item['descontos']);
        	 $data['financeiro_medicoes'][$i]['total'] = $total;
        	 $i++;
        }
        //$this->debugMark(null,  $data['financeiro_medicoes']);
        
        $data['main_content'] = 'admin/financeiro_medicoes/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));	
    	
    	$id_registro_financeiro = $this->uri->segment(4);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
	        	$this->form_validation->set_rules('id_registro_financeiro', 'id_registro_financeiro', 'required'); 
	        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
	        	$this->form_validation->set_rules('data', 'data', 'required'); 
	        	$this->form_validation->set_rules('acrecimos', 'acrecimos', 'required | numeric');
	        	$this->form_validation->set_rules('descontos', 'descontos', 'required | numeric'); 
	        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            $acresimo = str_replace(',', '.',$this->input->post('acrecimos'));
            $desconto = str_replace(',', '.',$this->input->post('descontos'));
            
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_registro_financeiro' => $this->input->post('id_registro_financeiro'),
                		'titulo' => $this->input->post('titulo'),
                		'data' => $this->input->post('data'),
                		'acrecimos' => $acresimo,
                		'descontos' => $desconto,
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->financeiro_medicoesdao->store_financeiro_medicoes($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/financeiro_medicoes/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id 
        $id = $this->uri->segment(4);
        
        $id_registro_financeiro = $this->uri->segment(5);
        $data['id_registro_financeiro'] = $id_registro_financeiro;
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
			        	$this->form_validation->set_rules('id_registro_financeiro', 'id_registro_financeiro', 'required'); 
			        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
			        	$this->form_validation->set_rules('data', 'data', 'required'); 
			        	$this->form_validation->set_rules('acrecimos', 'acrecimos', 'required | numeric'); 
			        	$this->form_validation->set_rules('descontos', 'descontos', 'required | numeric'); 
			        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
            	$acresimo = str_replace(',', '.',$this->input->post('acrecimos'));
            	$desconto = str_replace(',', '.',$this->input->post('descontos'));
            	
                $data_to_store = array(
			        	'id_registro_financeiro' => $this->input->post('id_registro_financeiro'),
			        	'titulo' => $this->input->post('titulo'),
			        	'data' => $this->input->post('data'),
                		'acrecimos' => $acresimo,
                		'descontos' => $desconto,
			        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->financeiro_medicoesdao->update_financeiro_medicoes($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/financeiro_medicoes/update/'.$id.'/'.$id_registro_financeiro.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['financeiro_medicoes'] = $this->financeiro_medicoesdao->get_financeiro_medicoes_by_id($id);
        //load the view
        $data['main_content'] = 'admin/financeiro_medicoes/edit';
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
    	
    	$id_registro_financeiro = $this->uri->segment(5);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
    			
        
        $this->financeiro_medicoesdao->delete_financeiro_medicoes($id);
        redirect('admin/financeiro_medicoes/'.$id_registro_financeiro);
    }//edit    			
    	
    /*
    public function foreingControllers(){
    	
    	$this->load->model('');		
    			
    	return $data;
    	
    }
    	
     */
    	
    /**
    * Delete product by his id
    * @return void
    */
    /*
    public function JSON_METHOD(){
    	 
    	header('Content-type: application/json');    	
    	
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    	 
    }
        		
     */   		
    	}