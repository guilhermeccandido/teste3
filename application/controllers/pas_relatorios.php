<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
//require_once(APPPATH . 'controllers/pas_fases' . EXT);
class pas_relatorios extends App_controller {
const VIEW_FOLDER = 'admin/pas_relatorios';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pasdao');
		$this->load->model('pas_fases_movimentacaodao');
		$this->load->model('pas_fasesdao');
		$this->load->model('contratosdao');
		
		$this->load->library('gcharts');
		$this->load->library('googlemaps');
		  
    }
    	

    // RELATÓRIOS FINANCEIROS
    
    
	// RELATORIOS FÍSICOS 
	
	public function relatorio_resumo()
	{
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		
		
		$data['pas'] = $this->pasdao->get_pas('', 'lote');
		
		$this->load->model('pas_trechosdao');
	
	
		$i = 0;
		$tmpArray = array();
		$tmpFaseArray = array();
	
		//$pasFases = new pas_fases();
		// GET ALL DATA TO POPULATE CRONOGRAMA
		foreach($data['pas'] as $item){
			$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
			$tmpArray = array();
			foreach($tmpFaseArray as $row){
				// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
				$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
			}
			//echo '<br>';
			$progressoTotalSoma =  array_sum($tmpArray);
			//echo '<br>';
			$totalFases = sizeof($tmpArray) ;
			//echo '<br>';
			//$this->PAR($tmpArray);
			 
			if($progressoTotalSoma AND $totalFases){
				$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
	
				// verifica a data do primeiro movimento
				$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
	
				$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
	
				if($data['pas'][$i]['progresso_total'] >= 100){
					// verifica a data do ultimo movimento
					$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
					$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
				}
	
			}else{
				$data['pas'][$i]['progresso_total'] = 0;
			}
			 
			 
			$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
			if(sizeof($arrayTrechos) > 0){
				$firstTrecho = true;
				$labelTrecho = '';
				$ext = 0;
				foreach($arrayTrechos as $rowTrecho){
					if($firstTrecho){
						$firstTrecho = false;
						$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
					}else{
						$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
					}
					$ext += $rowTrecho['extensao'];
				}
				$data['pas'][$i]['trechos'] = $labelTrecho;
				$data['pas'][$i]['extensao'] = $ext;
	
			}else{
				$data['pas'][$i]['trechos'] = ' --- ';
				$data['pas'][$i]['extensao'] = 'Não Disponível';
			}
	
			
			
			$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
			//$this->PAR($arrayDiasCorridos);
			$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
			 
			//echo 'dias corridos '.$arrayDiasCorridos;
			//echo '<br>';
			//echo 'data inicial edital '.$data['pas'][$i]['data_ini_pas'];
			 
			$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
			$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
			$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
			 
			// PARA DATA PLANEJADA DE ACORDO COM O CRONOGRAMA
			//$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
			//$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
			 
			$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
			//$this->debugMark('data fim plan',$tmpLastDataPlan );
			$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
			 
			//echo '<br>';
			$i++;
			 
			 
		}
		 
	
		//$this->debugMark("teste", $data['pas']);
		
		$data = array_merge($data, $this->foreingControllers());
		$data = array_merge($data, $this->foreingControllersContratos());
	
		// $data['map'] = $this->get_location_list($data['pas']);
	
		//load the view
		$data['main_content'] = 'admin/pas_relatorios/relatorio_resumo';
		$this->load->view('includes/template', $data);
	
	}
	
	public function relatorio_andamento_trecho()
	{
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		
		
		$data['pas'] = $this->pasdao->get_pas_contrato_executora();
		$data['pas_trechos'] = array();
		
		$this->load->model('pas_trechosdao');
		
		
		$i = 0;
		$tmpArray = array();
		$tmpFaseArray = array();
		
		//$pasFases = new pas_fases();
		// GET ALL DATA TO POPULATE CRONOGRAMA
		foreach($data['pas'] as $item){
			$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
			$tmpArray = array();
			foreach($tmpFaseArray as $row){
				// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
				$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
			}
			//echo '<br>';
			$progressoTotalSoma =  array_sum($tmpArray);
			//echo '<br>';
			$totalFases = sizeof($tmpArray) ;
			//echo '<br>';
			//$this->PAR($tmpArray);
			
			$data['pas'][$i]['data_ini_execucao'] = '';
			$data['pas'][$i]['data_fim_execucao'] = '';
			
			
			if($progressoTotalSoma AND $totalFases){
				$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
				
				// verifica a data do primeiro movimento
				$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
				
				$data['pas'][$i]['data_ini_execucao'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
				
				if($data['pas'][$i]['progresso_total'] >= 100){
					// verifica a data do ultimo movimento
					$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
					$data['pas'][$i]['data_fim_execucao'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
				}
				
			}else{
				$data['pas'][$i]['progresso_total'] = 0;
			}
			
			
			$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
			//$this->PAR($arrayDiasCorridos);
			$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
			
			//echo 'dias corridos '.$arrayDiasCorridos;
			//echo '<br>';
			//echo 'data inicial edital '.$data['pas'][$i]['data_ini_pas'];
			
			$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
			$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
			$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
			
			// PARA DATA PLANEJADA DE ACORDO COM O CRONOGRAMA
			//$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
			//$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
			
			$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
			//$this->debugMark('data fim plan',$tmpLastDataPlan );
			$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
			
			
			$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_by_id_pas($item['id']);
			//$this->debugMark("trechos", $arrayTrechos);
			
			
			foreach($arrayTrechos as $itemTrecho){
				$data['pas_trechos'][] =  array_merge($data['pas'][$i], array(
						'rodovia' => $itemTrecho['rodovia'],
						'uf' => $itemTrecho['uf'],
						'kmInicial' => $itemTrecho['km_inicial'],
						'kmFinal' =>  $itemTrecho['km_final'],
						'snv' => $itemTrecho['snv']));
			}
			//$this->PAR($data['pas_trechos']);
			
			//echo '<br>';
			$i++;
			
			
		}
		
		//$this->debugMark("Pas Trechos", $data['pas_trechos']);
		
		
		//load the view
		$data['main_content'] = 'admin/pas_relatorios/relatorio_andamento_trecho';
		$this->load->view('includes/template', $data);
		
	}
	
	public function service_relatorio_andamento_trecho()
	{
		header('Content-type: application/json');
		
		$data = array();
		
		$data['pas'] = $this->pasdao->get_pas_contrato_executora();
		$data['pas_trechos'] = array();
		
		$this->load->model('pas_trechosdao');
		
		
		$i = 0;
		$tmpArray = array();
		$tmpFaseArray = array();
		
		//$pasFases = new pas_fases();
		// GET ALL DATA TO POPULATE CRONOGRAMA
		foreach($data['pas'] as $item){
			$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
			$tmpArray = array();
			foreach($tmpFaseArray as $row){
				// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
				$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
			}
			//echo '<br>';
			$progressoTotalSoma =  array_sum($tmpArray);
			//echo '<br>';
			$totalFases = sizeof($tmpArray) ;
			//echo '<br>';
			//$this->PAR($tmpArray);
			
			if($progressoTotalSoma AND $totalFases){
				$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
				
				// verifica a data do primeiro movimento
				$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
				
				$data['pas'][$i]['data_ini_execucao'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
				
				if($data['pas'][$i]['progresso_total'] >= 100){
					// verifica a data do ultimo movimento
					$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
					$data['pas'][$i]['data_fim_execucao'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
				}else{
					$data['pas'][$i]['data_fim_execucao'] = '';
				}
				
			}else{
				$data['pas'][$i]['progresso_total'] = 0;
			}
			
			
			$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
			
			$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
			
			
			$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
			$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
			$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
			
			$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
			//$this->debugMark('data fim plan',$tmpLastDataPlan );
			$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
			
			
			$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_by_id_pas($item['id']);
			//$this->debugMark("trechos", $arrayTrechos);
			
			
			foreach($arrayTrechos as $itemTrecho){
				unset($data['pas'][$i]['id']);
				$data['pas_trechos'][] =  array_merge($data['pas'][$i], array(
						'rodovia' => $itemTrecho['rodovia'],
						'uf' => $itemTrecho['uf'],
						'kmInicial' => $itemTrecho['km_inicial'],
						'kmFinal' =>  $itemTrecho['km_final'],
						'snv' => $itemTrecho['snv']));
			}
			$i++;
			
			
		}
		
		echo json_encode(array('success' => 1, 'result' => $data['pas_trechos']));
		exit;
		
		
	}
	
	
	public function relatorio_planejado_executado(){
		
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		
		$data['pas'] = $this->pasdao->get_planejado_executado();
		
		$data = array_merge($data, $this->foreingControllersContratos());
		//$this->debugMark('Relatorio', $data['pas'] );
		
		$data['main_content'] = 'admin/pas_relatorios/relatorio_planejado_executado';
		$this->load->view('includes/template', $data);
	}
	
	public function relatorio_trechos_lote(){
	
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
	
		$this->load->model('pas_trechosdao');
		$data['pas'] = $this->pas_trechosdao->get_pas_trechos_lotes();
		
		$data = array_merge($data, $this->foreingControllersContratos());
		
		//$this->debugMark('Relatorio', $data['pas'] );
		
		$data['main_content'] = 'admin/pas_relatorios/relatorio_trechos_lote';
		$this->load->view('includes/template', $data);
	}
	
	public function relatorio_tempo_movimentos_produtos(){
		
			$data = array();
			$data = array_merge($data, $this->get_acesso_user(true));
			// TODO
			$this->load->model('statusdao');
			$status =  new statusdao();
			$tmpStatus = $status->get_status_for_legenda();
			
			foreach($tmpStatus as $item){
				$legendArray[] = $item['titulo'];
			}
			
			//$legendArray = array( 'Inicio da Execução', 'Protocolo', 'Entregue para Análise', 'Em Análise', 'Em Revisão', 'RACP', 'RACD');
			
			//LOTE
			foreach($legendArray as $key => $item){
				$arrayBuff[$item] = 0;
			}
		
			//$this->debugMark(null, $arrayBuff);
		
			// MOVIMENTACAO DO DAS FASES DO PAS
			$this->load->model('pas_fases_movimentacaodao');
			$lastMov = new pas_fases_movimentacaodao();
				
			// STATUS DAS FASES DO PAS
			$this->load->model('statusdao');
			$status = new statusdao();
			$data['status'] = $status->get_status(null,'id');
				
			$status_option = array();
			foreach($data['status'] as $rowStatus){
				$status_option[$rowStatus['id']] = $rowStatus['titulo'];
			}
		
			$pas = $this->pasdao->get_pas( null, 'lote');
		
			//$this->debugMark(null, $pas);
			foreach($pas as $item){
			
				$pas_fases = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
				
				$i = 0;
				$string = '';
				$contrato = $item['id_contrato'];
				$lote = $item['lote'];	
				$first = true;
				
				foreach($pas_fases as $row){
			
			
					$tmpArrayMov = $lastMov->get_first_movimentacao_by_id_pas_fases($row['id']);
						
					if((sizeof($tmpArrayMov) > 0 AND $tmpArrayMov[0]['start_date'] != '' ) ){
							
						$tmpArrayMov = $lastMov->get_pas_fases_movimentacao_by_id_pas_fases($row['id'], 'data_protocolo');
						//echo $row['fases'];
						//echo '<br>';
						$tempBuffArray = array();
						$tempBuffArrayProduto = array();
			
			
						foreach($legendArray as $key => $item){
							$arrayBuffProduto[$item] = 0;
						}
						foreach($legendArray as $key => $item){
							$tempBuffArrayProduto[$item] = 0;
						}
			
						//$this->debugMark('Array Movimento', $tmpArrayMov);
						$first = true;
						$end = false;
						foreach($tmpArrayMov as $movimento){
							if($first){
									
								$tmpDate = $movimento['data_protocolo'];
								$tmpMov = $movimento['id_status'];
								$first = false;
								//$this->debugMark(null, $out);
							}else{
									
									
								$tempTime = explode(" ", $tmpDate);
								$tempTime2 = explode(" ", $movimento['data_protocolo']);
			
								$diffDaysTemp = $this->diff_date_Db_Format($tempTime[0], $tempTime2[0]);
			
								//$this->debugMark(null, $arrayBuffProduto);
								// PRODUTO
								$arrayBuffProduto[$status_option[$tmpMov]] = $arrayBuffProduto[$status_option[$tmpMov]] + $diffDaysTemp;
								$tempBuffArrayProduto[$status_option[$tmpMov]] = $tempBuffArrayProduto[$status_option[$tmpMov]] + $diffDaysTemp;
			
								$tmpDate = $movimento['data_protocolo'];
								$tmpMov = $movimento['id_status'];
							}
							// TODO :  ALTERAR ISSO
							if($movimento['tipo'] == 'Final'){
									
								//$this->debugMark('Produto', $movimento);
			
								$diffDaysTemp = 1;
								$arrayBuffProduto[$status_option[$tmpMov]] = 1;
								$tempBuffArrayProduto[$status_option[$tmpMov]] = 1;
								
								$end = true;
							}
						}
							
						if(!$end){
							if(strtotime($movimento['data_protocolo']) > strtotime(date('Y-m-d')) ){
								$lastDate = $movimento['data_protocolo'];
							}else{
								$lastDate = date('Y-m-d');
									
							}
			
							$tempTime = explode(" ", $movimento['data_protocolo']);
								
							$diffDaysTemp = $this->diff_date_Db_Format($tempTime[0], $lastDate);
								
							//produto
							$arrayBuffProduto[$status_option[$tmpMov]] = $arrayBuffProduto[$status_option[$tmpMov]] + $diffDaysTemp;
							$tempBuffArrayProduto[$status_option[$tmpMov]] = $tempBuffArrayProduto[$status_option[$tmpMov]] + $diffDaysTemp;
							
							$end = false;
						}
							
						foreach($arrayBuffProduto as $key => $value){
			
							$data['pas'][$contrato][$lote][$row['fases']][] = array('movimento' => $key, 'dias' => $value );
			
						}
			
						$arrayBuffProduto = array();
						$tempBuffArrayProduto = array();
			
			
					}
			
					$i++;
				}
			}
			
			$data = array_merge($data, $this->foreingControllersContratos());
			//$this->debugMark('mark', $data);
			
			$data['main_content'] = 'admin/pas_relatorios/relatorio_tempo_movimentos';
			$this->load->view('includes/template', $data);
			
		}
		
		
	public function relatorio_medicoes_periodo(){
			
			$data = array();
			$data = array_merge($data, $this->get_acesso_user(true));
			$data['pas'] =array();
			
			
			
			if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				
				//form validation
				$this->form_validation->set_rules('data_ini', 'Data Inicial', 'required|date');
				$this->form_validation->set_rules('data_fim', 'Data Final', 'required|date');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
			
			
				//if the form has passed through the validation
				if ($this->form_validation->run())
				{
					
					// TODO : SETAR FLAG
					$pasTemp = $this->pasdao->get_medido_periodo($this->input->post('data_ini'), $this->input->post('data_fim'));
					//$this->debugMark('final stage', $pasTemp);
					
					$i = 0;
					$pas = array();
					foreach($pasTemp as $row){
						// TODO : SETAR STATUS FINAL
						if($row['id_status'] == 7){
							if(!$this->pasdao->check_racp($row['id_pas_fases'])){
								$tempPas = $this->pasdao->get_medido_by_id_pas_fases_id_status($row['id_pas_fases'], $row['id_status']);
								if(sizeof($tempPas) > 0){
									$pas[] =  $tempPas[0];
								}
							}
						}else{
							$tempPas = $this->pasdao->get_medido_by_id_pas_fases_id_status($row['id_pas_fases'], $row['id_status']);
							if(sizeof($tempPas) > 0){
								$pas[] =  $tempPas[0];
							}
						}
						$i++;
					}
					$data['pas'] = $pas;
					
					if(sizeof($pas) > 0){
						$data['flash_message'] = TRUE;
			
					}else{
						$data['flash_message'] = FALSE;
					}
			
				}else{
					$data['flash_message'] = FALSE;
				}
			
			}
			
			$data['main_content'] = 'admin/pas_relatorios/relatorio_medicoes_periodo';
			$this->load->view('includes/template', $data);
		}
		
		
	public function relatorio_movimentacoes_contrato(){
		
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		$data['pas'] =array();
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		
			//form validation
			$this->form_validation->set_rules('id_contrato', 'Contrato', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
				
				
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
					
				// TODO : SETAR FLAG
				$data['pas'] = $this->pas_fases_movimentacaodao->get_all_movimentacao_by_id_contrato($this->input->post('id_contrato'));
					
				if(sizeof($data['pas']) > 0){
					$data['flash_message'] = TRUE;
						
				}else{
					$data['flash_message'] = FALSE;
				}
					
			}else{
				$data['flash_message'] = FALSE;
			}
				
		}else{
			$data['pas'] = $this->pas_fases_movimentacaodao->get_all_movimentacao_by_id_contrato();
		}
		
		
		$data['contratos'] = $this->contratosdao->get_contratos_with_pas( 'contrato');
		
		$data['main_content'] = 'admin/pas_relatorios/relatorio_movimentacoes_contrato';
		$this->load->view('includes/template', $data);
		
	}	
	
	
	public function get_progresso_by_pas_fase($id_pas_fases, $peso = null){
	
		$tmpArray = $this->pas_fases_movimentacaodao->get_last_status_with_peso_by_id_fases($id_pas_fases);
		// SEMPRE VALE O MAIOR PESO ADQUIRIDO
		$tmpArrayPeso = $this->pas_fases_movimentacaodao->get_max_peso_by_id_fases($id_pas_fases);
		 
		$tmpStatus = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
		$tmpPeso = (sizeof($tmpArrayPeso) > 0 ) ? $tmpArrayPeso[0]['peso'] : 0;
		 
		$progresso = 0;
	
		if((sizeof($tmpStatus) > 0 ) ){
			if($tmpStatus['composicao'] == 'Simples'){
				$progresso = ( $tmpStatus['peso'] ) ? $tmpStatus['peso'] : 0;
	
			}else{
				$progresso = ( $tmpStatus['peso'] ) ? $tmpStatus['peso'] : 0;
	
				if($peso){
					$progresso += $peso;
				}else{
					$tmpArray = $this->pas_fases_movimentacaodao->get_last_avaliation_by_id_fases($id_pas_fases);
					$tmpAvaliacao = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
					$progresso += ( isset($tmpAvaliacao['peso']) ) ? $tmpAvaliacao['peso'] : 0;
				}
	
			}
			 
		}
		$progresso = ($progresso >= $tmpPeso ) ? $progresso : $tmpPeso;
	
		return $progresso;
	}


	public function foreingControllers(){
		 
		$this->load->model('usuariosdao');
		$responsavel = new usuariosdao();
		$data['responsaveis'] = $responsavel->get_usuarios(null, 'nome');
		 
		$this->load->model('local_execucaodao');
		$localExecucao = new local_execucaodao();
		$data['local_execucao'] = $localExecucao->get_local_execucao(null, 'titulo');
		 
		// STATUS DAS FASES DO PAS
		$this->load->model('statusdao');
		$status = new statusdao();
		$data['status'] = $status->get_status(null,'id');
		 
	
		// AVALIACOES DAS FASES DO PAS
		$this->load->model('avaliacoesdao');
		$avaliacoes = new avaliacoesdao();
		$data['avaliacoes'] = $avaliacoes->get_avaliacoes(null,'id');
		 
		 
		return $data;
	}

	
	public function foreingControllersContratos(){
		
		$this->load->model('contratosdao');
		$contratos = new contratosdao();
		$data['contratos'] =  $contratos->get_contratos();
		
		return $data;
	}
	
	// RELATORIO FINANCEIRO
	public function produtos_medidos_contrato(){
		
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		$data['medicao'] = array();
		
		$this->load->model('registro_financeirodao');
		$financeiro = new registro_financeirodao();
		$data['registro_finaceiro'] = $financeiro->get_registro_financeiro(null, 'contrato');
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		
			//form validation
			$this->form_validation->set_rules('id_registro_financeiro', 'Contrato', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
				
				
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$id_registro_financeiro = $this->input->post('id_registro_financeiro');
				$this->load->model('pas_relatoriosdao');
				$relatorios = new pas_relatoriosdao();
					
				$data['medicao'] = $relatorios->get_produtos_medidos_by_id_registro_financeiro($id_registro_financeiro);
				//$this->debugMark(null, $data['medicao']);
				$data['flash_message'] = TRUE;
					
			}else{
				$data['flash_message'] = FALSE;
			}
			
		}
			
		$this->load->model('fasesdao');
		$fases = new fasesdao();
		$data['fases'] = $fases->get_fases();
		
		$this->load->model('subfasesdao');
		$subfases = new subfasesdao();
		$data['subfases'] = $subfases->get_subfases();
		
		
		
		/*
		$data['reajustes'] = $relatorios->get_reajustes_by_id_registro_financeiro($id_registro_financeiro);
		foreach($data['reajustes'] as $item){
			
		}
		*/
		
		//$this->debugMark(null, $data['medicao']);
		
		$data['main_content'] = 'admin/pas_relatorios/relatorio_produtos_medidos_contrato';
		$this->load->view('includes/template', $data);
		
	} 
	
	public function historico_completo_movimentacoes(){
		
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		
		$this->load->model('pas_relatoriosdao');
		$relatorios = new pas_relatoriosdao();
		$data['historico'] = $relatorios->get_historico_completo_movimentacoes();
		
		$first = true;
		$dataAcumul = 0;
		$diffDay = 0;
		
		for($i = 0; $i < sizeof($data['historico']);  $i++ )
		{
			if($first){
				$idFaseAnterior = $data['historico'][$i]['id'];
				$first = false;
			}else{
				if($idFaseAnterior != $data['historico'][$i]['id']){
					$idFaseAnterior = $data['historico'][$i]['id'];
					
					if($data['historico'][$i-1]['tipo'] == 'Final'){
						$data['historico'][$i-1]['diff'] = 1;
						$data['historico'][$i-1]['acumulado'] = $dataAcumul + 1 ;
					}else{
						$data['historico'][$i-1]['diff'] = 0;
						$data['historico'][$i-1]['acumulado'] = 0;
					}
					$diffDay = 0;
					$dataAcumul = 0;
					
				}else{
					$diffDay = $this->diff_date_Db_Format($data['historico'][$i-1]['data_protocolo'], $data['historico'][$i]['data_protocolo']);
					$dataAcumul += $diffDay;
					$data['historico'][$i-1]['diff'] = $diffDay;
					$data['historico'][$i-1]['acumulado'] = $dataAcumul;
				}
			}
			
		}
		$data['historico'][$i-1]['diff'] = $diffDay;
		$data['historico'][$i-1]['acumulado'] = $dataAcumul;
		
		$data = array_merge($data, $this->foreingControllersContratos());
		
		//$this->debugMark($i, $data['historico']);
		
		$data['main_content'] = 'admin/pas_relatorios/relatorio_historico_movimentacao_completo';
		$this->load->view('includes/template', $data);
	}
	
	public function fiscalizacao_mensal($param = null, $value = null)
	{
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));

		if($value == null){ 
			$value = date("Y"); 
		}
		
		$this->load->model('pas_relatoriosdao');
		$relatorios = new pas_relatoriosdao();
		$response = $relatorios->get_fiscalizacao_mensal($value);
		$data['response'] = $response;
		$data['main_content'] = 'admin/pas_relatorios/relatorio_fiscalizacao_mensal';
		$data['anoSelected'] = $value;

		$this->load->view('includes/template', $data);
	}

	public function quantidade_itens_analista_contrato(){
		
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		
		$this->load->model('pas_relatoriosdao');
		$relatorios = new pas_relatoriosdao();
		
		
		
		$data = array_merge($data, $this->foreingControllersContratos());
		
		//$this->debugMark($i, $data['historico']);
		
		$data['main_content'] = 'admin/pas_relatorios/relatorio_historico_movimentacao_completo';
		$this->load->view('includes/template', $data);
	}
	
}






