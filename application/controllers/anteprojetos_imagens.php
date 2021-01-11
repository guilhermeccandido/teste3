<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class anteprojetos_imagens extends App_controller {
const VIEW_FOLDER = 'admin/anteprojetos_imagens';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('anteprojetos_imagensdao');

        
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id = $this->uri->segment(3);
    	$data['id_anteprojetos'] = $id;
    	 
    	$this->load->model('anteprojetos_imagensdao');
    	$ant = new anteprojetos_imagensdao();
    	 
    	$data['anteprojetos_imagens'] = $ant->get_anteprojetos_imagens_by_id_anteprojetos($id);
    	//$this->PAR($data['anteprojetos_imagens']);
    
    	$data = array_merge($data, $this->foreingControllers());
    	
        //load the view
        $data['main_content'] = 'admin/anteprojetos_imagens/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
		$id_anteprojetos = $this->uri->segment(4);
    	$data['id_anteprojetos'] = $id_anteprojetos;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_anteprojetos', 'id_anteprojetos', 'required'); 
        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
        	$this->form_validation->set_rules('data_registro', 'data_registro', 'required'); 
        	$this->form_validation->set_rules('categoria', 'categoria', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

            	$catList = '';
            	foreach($this->input->post('categoria') as $item){
            		$catList .= $item.' ';
            	}
            	
            	
            	$fileName = $_FILES["file"]["name"];
            	$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
            	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            	 
            	$data_to_store = array(
            			'id_anteprojetos' => $this->input->post('id_anteprojetos'),
            			'tipo' => $fileType,
            			'titulo' => $this->input->post('titulo'),
            			'data_registro' => $this->input->post('data_registro'),
            			'categoria' => $catList,
            			'descricao' => $this->input->post('descricao'),
            			'observacoes' => $this->input->post('observacoes')
            	);
            	 
				
            	$id_anteprojeto_imagem = $this->anteprojetos_imagensdao->store_anteprojetos_imagens($data_to_store);
            	
            	
            	if($id_anteprojeto_imagem){
            		
            		if(!file_exists(ANTEPROJETOS_FOLDER.'/'.$id_anteprojetos.'/img')){
            			mkdir(ANTEPROJETOS_FOLDER.'/'.$id_anteprojetos.'/img', 0777, true);
            		}
            		
            		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            		
            			$nome = $id_anteprojeto_imagem.'.'.$fileType;
            			if(copy ( $target_file , ANTEPROJETOS_FOLDER.'/'.$id_anteprojetos.'/img/' .$nome)){
            				$data['flash_message'] = TRUE;
            				
            			}else{
            				$data['flash_message'] = FALSE;
            				$this->anteprojetos_imagensdao->delete_anteprojetos_imagens($id_anteprojeto_imagem);
            				
            			};
            			unlink($target_file);
            			
            		}else{
            			$data['flash_message'] = FALSE;
            			$this->anteprojetos_imagensdao->delete_anteprojetos_imagens($id_anteprojeto_imagem);
            		}
            		
            	}else{
            		$data['flash_message'] = FALSE;
            	
            	}
            	
            }
    
        }

        $data = array_merge($data, $this->foreingControllers());
        
        //load the view
        $data['main_content'] = 'admin/anteprojetos_imagens/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
        $data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	//product id
        $id = $this->uri->segment(4);
  		$id_anteprojetos = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_anteprojetos', 'id_anteprojetos', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('data_registro', 'data_registro', 'required');
        	$this->form_validation->set_rules('categoria', 'categoria', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            
            $catList = '';
            foreach($this->input->post('categoria') as $item){
            	$catList .= $item.' ';
            }
            
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
		       $data_to_store = array(
		        	'id_anteprojetos' => $this->input->post('id_anteprojetos'),
		        	'titulo' => $this->input->post('titulo'),
		        	'data_registro' => $this->input->post('data_registro'),
		        	'categoria' => $catList,
		        	'descricao' => $this->input->post('descricao'),
		        	'observacoes' => $this->input->post('observacoes'),
                );
		       
		       $fileName = $_FILES["file"]["name"];
		       $target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
		       $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
		       
		       if($fileName){
		       	$data_to_store['tipo'] = $fileType;
		       	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		       		 
		       		$nome = $id.'.'.$fileType;
		       		copy ( $target_file , ANTEPROJETOS_FOLDER.'/'.$id_anteprojetos.'/img/' .$nome);
		       		unlink($target_file);
		       	}
		       }
                //if the insert has returned true then we show the flash message
                if($this->anteprojetos_imagensdao->update_anteprojetos_imagens($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/anteprojetos_imagens/update/'.$id.'/'.$id_anteprojetos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['anteprojetos_imagens'] = $this->anteprojetos_imagensdao->get_anteprojetos_imagens_by_id($id);

        $data = array_merge($data, $this->foreingControllers());
        		
        //load the view
        $data['main_content'] = 'admin/anteprojetos_imagens/edit';
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
    	$id_anteprojetos = $this->uri->segment(5);
        $this->anteprojetos_imagensdao->delete_anteprojetos_imagens($id);
        redirect('admin/anteprojetos_imagens/'.$id_anteprojetos);
    }//edit
    
    
    public function foreingControllers(){
    	 
    	$this->load->model('anteprojetos_categorias_imagensdao');
        $categorias_imagens = new anteprojetos_categorias_imagensdao();
        $data['categorias_imagens'] = $categorias_imagens->get_anteprojetos_categorias_imagens(null, 'titulo' );
    	 
    	return $data;
    	 
    }
    	
}