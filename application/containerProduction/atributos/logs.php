<?php
$atributosLOGS = array(
		'trecho' => 	"ID_TRECHO" ,
		'Velocidade' => 	"VELOCIDADE" ,
		'Hodometro trecho' => 	"HODOMETRO_TRECHO" ,
		'GPS Velocidade' => 	"GPS_VELOCIDADE" ,
		'GPS Hodometro' => 	"GPS_HODOMETRO" ,
		'GPS Latitude' => 	"GPS_LATITUDE" ,
		'GPS Longitude' => 	"GPS_LONGITUDE" ,
		'GPS Altitude' => 	"GPS_ALTITUDE" ,
		'GPS Erro' => 	"GPS_ERRO" ,
		'GPS Qnt. Satelites' => 	"GPS_QTDE_SATELITES" ,
		'GPS X' => 	"GPS_X" ,
		'GPS Y' => 	"GPS_Y" ,
		'GPS Azimute' => 	"GPS_AZIMUTE" ,
		'GPS_NMEA_GPRMC ' => 	"GPS_NMEA_GPRMC" ,
		'GPS_NMEA_GPGGA' => 	"GPS_NMEA_GPGGA" ,
		'Frame Cam.1' => 	"FRAME_CAMERA_1" ,
		'Frame Cam.2' => 	"FRAME_CAMERA_2" ,
		'Tempo Cam.1' => 	"TEMPO_CAMERA_1" ,
		'Tempo Cam.2' => 	"TEMPO_CAMERA_2" ,
		'Data Hora' => 	"DATA_HORA" ,
		'Tempo Log' => 	"TEMPO_LOG" ,
		'Barometro Pressao' => 	"BAROMETRO_PRESSAO" ,
		'Barametro Temperatura' => 	"BAROMETRO_TEMPERATURA" ,
		'Barametro Altitude' => 	"BAROMETRO_ALTITUDE" ,
		'IRI INTERNO' => 	"IRI_INTERNO" ,
		'IRI EXTERNO' => 	"IRI_EXTERNO" ,
		'Ext. Log' => 	"EXTENSAO_LOG" ,
		'Perimetro Urbano' => 	"PERIMETRO_URBANO" ,
		'Sinalizacao Vert, Dir.' => 	"SINALIZACAO_VERT_DIREITA",
		'Sinalizacao Vert, Esq.' => 	"SINALIZACAO_VERT_ESQUERDA",
		'Acesso Direita' => 	"ACESSO_DIREITA",
		'Acesso Esquerda' => 	"ACESSO_ESQUERDA",
		'Tipo Revestimento' => 	"TIPO_REVESTIMENTO" ,
		'Log Original' => 	"ID_LOG_ORIGINAL" ,
		'Odometro' => 	"odometro" ,
		'Flecha Int' => 	"Flecha_Int" ,
		'Flacha Ext' => 	"Flecha_Ext"
);

$atributosLOGS2 = array(	'Classe ' => 'id_classe_obras' ,
		'Tipo' 	  => 'id_tipo_obras',
		'Data Inicial' => 'data_ini',
		'Data Final' => 'data_fim',
		'Data Inicial' => 'data_ini',
		'Data Final' => 'data_fim',
		'Lat/Long' => 'lat_long'
);


$this->atributos = array(
		'Custo de Ilesos' 	=> 'ilesos',
		'Custo de Feridos' 	=> 'feridos',
		'Custo de Mortos' 	=> 'mortos',
		'Custo Geral' 	=> 'geral',
		'Data Base' => 'data_base'
);

//prequisa_trafecos

$this->atributos = array(
		'Classificação Veicular' 		=> 'id_classeveiculos',
		'Título' 		=> 'titulo',
		'Rodovia' 		=> 'rodovia',
		'UF' 			=> 'uf',
		'Trecho' 		=> 'trecho',
		'KM' 			=> 'km',
		'Número do Posto'=> 'n_posto',
		'Rodovia' 		=> 'rodovia',
		'Título' 		=> 'titulo',
		'Chefe do Posto'=> 'chefe_posto',
		'Data Inicio' 	=> 'data_ini',
		'Data Fim' 		=> 'data_fim'
);

$this->atributos = array(
		'uf'  		=> 'uf',
		'br'  		=> 'br',
		'km_ini'  	=> 'km_ini',
		'km_fim' 	=> 'km_fim',
		'data_ini' 	=> 'data_ini',
		'data_fim' 	=>'data_fim'
);

$this->atributos = array(
		'Titulo' 	=> 'titulo',
		'Tipo' 		=> 'tipo',
		'Rodovia' 	=> 'rodovia',
		'UF' 		=> 'uf',
		'Trecho' 	=> 'trecho',
		'Km Inicial' => 'km_inicial',
		'Km Final' 	=> 'km_final',
		'Lote' 		=> 'lote',
		'Estudo' 	=> 'estudo'

);


$this->atributos = array(
		'Titulo' 	=> 'titulo',
		'UF' 		=> 'uf',
		'Rodovia' 	=> 'rodovia',
		'Furo' 		=> 'furo',
		'Lado' 		=> 'lado',
		'Latitude' 	=> 'lat',
		'Logitude' 	=> 'long',

		'mm' 	=> 'mm',
		'50_8' 	=> '50_8',
		'38_1'	=> '38_1',
		'25_4'	=> '25_4',
		'19_1' 	=> '19_1',
		'9_5' 	=> '9_5',
		'4_8'	=> '4_8',
		'2' 	=> '2',
		'1_2'	=> '1_2',
		'0_59'	=> '0_59',
		'0_42' 	=> '0_42',
		'0_30' 	=> '0_30',
		'0_15'	=> '0_15',
		'0_074'	=> '0_074',

		'% de Silte' 	=> 'silte',
		'% de Argila'	=> 'argila',
		'Tipo de Solo'	=> 'solo',

		'LL(%)'	=> 'll',
		'LP(%)'	=> 'lp',
		'IP(%)'	=> 'ip',

		'IG'	=> 'ig',
		'HRB'	=> 'hrb',

		'Dmáx (g/cm2)'			=> 'dmax',
		'Wot(%)'				=> 'wot',
		'EXP(%)'				=> 'exp',
		'Energia (N. golpes)'	=> 'eng',
		'ISC(%)'				=> 'isc',

		'Densidade Natural'	=> 'densidade_natural',
		'Wcampo'	=> 'wcampo',

		'Areia'	=> 'areia',

		'Nível de Água' => 'nivel_agua',

		'Ensaio Triaxial' => 'ensaio_triaxial'



);


$this->atributos = array(
		'Código'					=> 'codigo',
		'Composição'				=> 'titulo',
		'Data Base'					=> 'data_base',
		'Tipo'						=> 'tipo',
		'Produção da Equipe'		=> 'producao_equipe',
		'Prod. Eq. Unidade'			=> 'producao_equipe_unidade',
		'Observação'				=> 'observacao',
);


$this->atributos = array(
		'Título'					=> 'titulo',
		'Largura da Pista'			=> 'largura_pista',
		'Largura do Acostamento'	=> 'largura_acostamento',
		'Largura do Acostamento 2'	=> 'largura_acostamento2',
		'Solo Estab.sem Mistura'	=> 'solo_estab_s_mistura',
		'Estab.Brita40Laterita60'	=> 'estab_brita_40_laterita60',
		'TSD'						=> 'tsd',
		'CBUQ Faixa C - espes.'		=> 'cbuq_faixa_c_espes',
		'CBUQ Faixa B - espes.'		=> 'cbuq_faixa_b_espes',
		'Brita Graduada - BGS'		=> 'brita_graduada_bgs',
		'Br.Grad.Tr.Cim. - BGTC'	=> 'brita_graduada_bgtc',
		'Sub-base Estab.s/Mist.'	=> 'sub_base_estab_s_mist',
		'AAUQ'						=> 'aauqt',
		'40%Seixo e 60%Laterita'	=> '40_seixo_60_laterita',
		'Observação'				=> 'observacao'
);


// transportes
$this->atributos = array(
		'Transporte'		=> 'titulo',
		'Código'			=> 'codigo',
		'Região'			=> 'regiao',
		'Uf'				=> 'uf',
		'Ano Base'			=> 'ano_base',
		'Observação'		=> 'observacao'

);

//transporte_material_classe
 $this->atributos = array(	
        							'Transporte'		=> 'id_transporte',
        							'Composição'		=> 'id_composicao',
        							'Material'			=> 'titulo',
        							'Origem'			=> 'origem',
					        		'Destino'			=> 'destino',
					        		'Distância (km)'	=> 'distancia',
        							'Fórmula'			=> 'formula',
					        		'Trans./Veíc./Caminho'			=> 'trans_veic_caminho',
									'Observação'		=> 'observacao'
        		
        						);
		
// dados de entradas para hdm_veiculos
 $this->atributos = array(
 		'Reajuste Salário'						=> 'reajuste_salario',
 		'Ind. Reajuste'	=> 'ind_reajuste',
 		'Ind. Variação IGPM'					=> 'ind_var_igpm',
 		'Valor Gasolina'				=> 'valor_gasolina',
 		'Fator Gasolina'						=> 'gasolina_fator_conversao',
 		'Valor Oleo'					=> 'valor_oleo',
 		'Fator Oleo' 				=> 'oleo_fator_conversao',
 		'Valor Ec. Gasolina'				=> 'valor_gas_e',
 		'Valor E. Oleo' 				=> 'valor_oleo_e',
 		'Data Base'				=> 'data_base',
 		'Observação'				=> 'observacao'
 
 );
 
$this->atributos = array(	
        							'VEH_NAME' => 	'VEH_NAME' ,
									'CATEGORY' => 	'CATEGORY'  ,
									'BASE_TYPE' => 	'BASE_TYPE' ,
									'CLASS' => 	'CLASS'  ,
									'INFO' => 	'INFO' ,
									'INFO' => 	'LIFE_MODEL'  ,
									'PCSE' => 	'PCSE' ,
									'NUM_WHEELS' => 	'NUM_WHEELS' ,
									'NUM_AXLES' => 	'NUM_AXLES'  ,
									'TYRE_TYPE' => 	'TYRE_TYPE'  ,
									'TYRE_NR0' => 	'TYRE_NR0' ,
									'TYRE_RREC' => 	'TYRE_RREC' ,
									'AKM0' => 	'AKM0' ,
									'HRWK0' => 	'HRWK0'  ,
									'LIFE0' => 	'LIFE0' ,
									'PP' => 	'PP'  ,
									'PAX' => 	'PAX' ,
									'W' => 	'W' ,
									'WEIGHT_OP' => 	'WEIGHT_OP' ,
									'WGT_UNIT' => 	'WGT_UNIT'  ,
									'ESAL' => 	'ESAL' ,
									'EUC_FUEL' => 	'EUC_FUEL' ,
									'EUC_INTRST' => 	'EUC_INTRST'  ,
									'FUC_FUEL' => 	'FUC_FUEL' ,
									'FUC_INTRST' => 	'FUC_INTRST'  ,
									'AF' => 	'AF' ,
									'CD' => 	'CD' ,
									'CDMULT' => 	'CDMULT' ,
									'CR_B_A0' => 	'CR_B_A0' ,
									'CR_B_A1' => 	'CR_B_A1' ,
									'CR_B_A2' => 	'CR_B_A2' ,
									'PDRIVE' => 	'PDRIVE'  ,
									'PDRV_UNITS' => 	'PDRV_UNITS'  ,
									'PBRAKE' => 	'PBRAKE'  ,
									'PBRK_UNITS' => 	'PBRK_UNITS'  ,
									'PRAT' => 	'PRAT'  ,
									'PRAT_UNITS' => 	'PRAT_UNITS'  ,
									'FPLIM' => 	'FPLIM'  ,
									'B_VDES2' => 	'B_VDES2' ,
									'B_VDES_A0' => 	'B_VDES_A0' ,
									'B_VDES_A1' => 	'B_VDES_A1' ,
									'B_VDES_A2' => 	'B_VDES_A2' ,
									'B_VDES_CW1' => 	'B_VDES_CW1'  ,
									'B_VDES_CW2' => 	'B_VDES_CW2' ,
									'C_VDES2' => 	'C_VDES2' ,
									'C_VDES_A0' => 	'C_VDES_A0' ,
									'C_VDES_A1' => 	'C_VDES_A1' ,
									'C_VDES_A2' => 	'C_VDES_A2' ,
									'C_VDES_CW1' => 	'C_VDES_CW1'  ,
									'C_VDES_CW2' => 	'C_VDES_CW2' ,
									'U_VDES2' => 	'U_VDES2' ,
									'U_VDES_A0' => 	'U_VDES_A0' ,
									'U_VDES_A1' => 	'U_VDES_A1' ,
									'U_VDES_A2' => 	'U_VDES_A2' ,
									'U_VDES_CW1' => 	'U_VDES_CW1'  ,
									'U_VDES_CW2' => 	'U_VDES_CW2' ,
									'VCURVE_A0' => 	'VCURVE_A0' ,
									'VCURVE_A1' => 	'VCURVE_A1' ,
									'VROUGH_A0' => 	'VROUGH_A0' ,
									'ARVMAX' => 	'ARVMAX'  ,
									'SPEED_SIG' => 	'SPEED_SIG'  ,
									'SPEED_BETA' => 	'SPEED_BETA' ,
									'COV' => 	'COV' ,
									'CGR_A0' => 	'CGR_A0' ,
									'CGR_A1' => 	'CGR_A1' ,
									'CGR_A2' => 	'CGR_A2' ,
									'RPM_A0' => 	'RPM_A0'  ,
									'RPM_A1' => 	'RPM_A1' ,
									'RPM_A2' => 	'RPM_A2' ,
									'RPM_A3' => 	'RPM_A3' ,
									'RPM_IDLE' => 	'RPM_IDLE'  ,
									'IDLE_FUEL' => 	'IDLE_FUEL' ,
									'ZETAB' => 	'ZETAB' ,
									'EHP' => 	'EHP' ,
									'EDT' => 	'EDT' ,
									'PACCS_A0' => 	'PACCS_A0' ,
									'PCTPENG' => 	'PCTPENG' ,
									'OILCONT' => 	'OILCONT' ,
									'OILOPER' => 	'OILOPER' ,
									'AMAXV' => 	'AMAXV' ,
									'FRIAMAX' => 	'FRIAMAX' ,
									'NMTAMAX' => 	'NMTAMAX' ,
									'RIAMAX' => 	'RIAMAX' ,
									'AMAXRI' => 	'AMAXRI' ,
									'WHEEL_DIAM' => 	'WHEEL_DIAM' ,
									'TYRE_C0TC' => 	'TYRE_C0TC' ,
									'TYRE_CTCTE' => 	'TYRE_CTCTE' ,
									'TYRE_CTCON' => 	'TYRE_CTCON' ,
									'TYRE_VOL' => 	'TYRE_VOL' ,
									'PARTS_A0' => 	'PARTS_A0' ,
									'PARTS_A1' => 	'PARTS_A1' ,
									'PARTS_KP' => 	'PARTS_KP' ,
									'RI_SHAPE' => 	'RI_SHAPE' ,
									'RIMIN' => 	'RIMIN'  ,
									'CPCON' => 	'CPCON' ,
									'PARTS_K0PC' => 	'PARTS_K0PC'  ,
									'PARTS_K1PC' => 	'PARTS_K1PC'  ,
									'LAB_A0' => 	'LAB_A0' ,
									'LAB_A1' => 	'LAB_A1' ,
									'LAB_K0LH' => 	'LAB_K0LH'  ,
									'LAB_K1LH' => 	'LAB_K1LH'  ,
									'OPTLIFE_A0' => 	'OPTLIFE_A0' ,
									'OPTLIFE_A1' => 	'OPTLIFE_A1' ,
									'OPTLIFE_A2' => 	'OPTLIFE_A2'  ,
									'OPTLIFE_A3' => 	'OPTLIFE_A3' ,
									'OPTLIFE_A4' => 	'OPTLIFE_A4'  ,
									'EM_CATCONVTR' => 	'EM_CATCONVTR'  ,
									'EN_FUELTYP' => 	'EN_FUELTYP'  ,
									'EN_PRODVEH' => 	'EN_PRODVEH'  ,
									'EN_PCTPART' => 	'EN_PCTPART' ,
									'EN_PCTVEH' => 	'EN_PCTVEH' ,
									'EN_TYREWGT' => 	'EN_TYREWGT' ,
									'EN_TAREWGT' => 	'EN_TAREWGT' ,
									'EN_TAREUNT' => 	'EN_TAREUNT'  ,
									'NM_WHEEL' => 	'NM_WHEEL'  ,
									'NM_PAYLOAD' => 	'NM_PAYLOAD'  ,
									'NM_VDESP' => 	'NM_VDESP'  ,
									'NM_VDESU' => 	'NM_VDESU'  ,
									'NM_A_RGH' => 	'NM_A_RGH'  ,
									'NM_CRGR' => 	'NM_CRGR'  ,
									'NM_A_GRD' => 	'NM_A_GRD'  ,
									'NM_A_RMC' => 	'NM_A_RMC'  ,
									'NM_B_RMC' => 	'NM_B_RMC'  ,
									'NM_KEF' => 	'NM_KEF'  ,
									'EUC_PSGR' => 	'EUC_PSGR'  ,
									'EUC_ENERGY' => 	'EUC_ENERGY'  ,
									'FUC_PSGR' => 	'FUC_PSGR'  ,
									'FUC_CARGO' => 	'FUC_CARGO'  ,
									'FUC_ENERGY' => 	'FUC_ENERGY'  ,
									'EMRAT_A0' => 	'EMRAT_A0' ,
									'EMRAT_A1' => 	'EMRAT_A1' ,
									'EMRAT_A2' => 	'EMRAT_A2' ,
									'KPFAC' => 	'KPFAC'  ,
									'KPEA' => 	'KPEA'  
        		
        						);


$this->atributos = array(
		'' => 'EUC_LABOUR' ,
		'' => 'EUC_CREW' ,
		'' => 'EUC_OHEAD',
		'' => 'EUC_WORK' ,
		'' => 'EUC_NONWRK' ,
		'' => 'FUC_LABOUR' ,
		'' => 'FUC_CREW' ,
		'' => 'FUC_OHEAD' ,

);

$this->atributos = array(
		'EUC_TYRE' => 'EUC_TYRE',
		'EUC_OIL' => 'EUC_OIL',
		'EUC_CARGO' => 'EUC_CARGO',
		'FUC_TYRE' => 'FUC_TYRE',
		'FUC_OIL' => 'FUC_OIL',

);

$this->atributos = array(
		'Contrato' => 'titulo',
		'Executora' => 'id_executora',
		'Fiscal' => 'fiscal',
		'Município Unidade Local' => 'local',
		'Unidade Gestora' => 'coordenacao',
		'Intervenção' => 'id_intervencao',
		'Situação' => 'situacao',
		'Objeto' => 'objeto',
		'Edital' => 'edital',
		'Data de Proposta/Base' => 'data_proposta_base',
		'Data de Aprovação' => 'data_aprovacao',
		'Data de Assinatura' => 'data_assinatura',
		'Data de Publicação' => 'data_publicacao',
		'Data de Ordem de Início' => 'data_ordem_inicio',
		'Data de Término' => 'data_termino',
		'Prazo' => 'prazo',
		'Valor PI' => 'valor_pi',
		'Valor Reajuste' => 'valor_reajuste',
		'Valor Aditivo' => 'valor_aditivo',
		'Valor Contrato (PI+R+A)' => 'valor_contrato',
		'Valor Medido (PI)' => 'valor_medido_pi',
		'Valor Medido (PI+R)' => 'valor_contrato_pi_r',
		'Valor Pago' => 'valor_pago',
		'Empenhado' => 'empenhado',
		'Saldo de Empenho' => 'saldo_empenho',
		'Observações' => 'observacoes'
        
);


?>