<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'erro404';
$route['mobile'] = "mobile";
$route['movel'] = "mobile";

/*portal*/
//$route[''] = 'portal/index';



/*admin*/
$route['admin'] = 'anteprojetos/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/logout_home'] = 'user/logout_home';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';
$route['admin/login/validate_credentials_temp'] = 'user/validate_credentials_temp';

// PORTO
$route['admin/gestao_anteprojetos'] = 'gestao_anteprojetos/index';
$route['admin/gerenciais'] = 'gerenciais/index';

$route['admin/anteprojetos'] = 'anteprojetos/index';
$route['anteprojetos/lista_anteprojetos'] = 'anteprojetos/lista_anteprojetos';

$route['admin/anteprojetos/add'] = 'anteprojetos/add/$1';
$route['admin/anteprojetos/add/(:any)'] = 'anteprojetos/add';
$route['admin/anteprojetos/update'] = 'anteprojetos/update';
$route['admin/anteprojetos/update/(:any)'] = 'anteprojetos/update/$1';
$route['admin/anteprojetos/delete/(:any)'] = 'anteprojetos/delete/$1';
$route['admin/anteprojetos/detalhes/(:any)'] = 'anteprojetos/detalhes/$1';
$route['admin/anteprojetos/edit_table_pendencias'] = 'anteprojetos/edit_table_pendencias';
$route['admin/anteprojetos/edit_table_pendencias/(:any)'] = 'anteprojetos/edit_table_pendencias/$1';
$route['admin/anteprojetos/add_img'] = 'anteprojetos/add_img';
$route['admin/anteprojetos/get_anteprojetos_events'] = 'anteprojetos/get_anteprojetos_events';
$route['admin/anteprojetos/get_anteprojeto_all_events'] = 'anteprojetos/get_anteprojeto_all_events';
$route['admin/anteprojetos/get_anteprojeto_event_by_id/(:any)'] = 'anteprojetos/get_anteprojeto_event_by_id/$1';
$route['anteprojetos/visualizar/(:any)'] = 'anteprojetos/visualizar/$1';


$route['anteprojetos/lista_anteprojetos/(:any)'] = 'anteprojetos/lista_anteprojetos/$1';
$route['anteprojetos/(:any)'] = 'anteprojetos/lista_anteprojetos/$1';
$route['admin/anteprojetos/(:any)'] = 'anteprojetos/index/$1'; //$1 = page number

$route['admin/documentos'] = 'documentos/index';
$route['admin/documentos/add'] = 'documentos/add';
$route['admin/documentos/update'] = 'documentos/update';
$route['admin/documentos/update/(:any)'] = 'documentos/update/$1';
$route['admin/documentos/delete/(:any)'] = 'documentos/delete/$1';
$route['admin/documentos/(:any)'] = 'documentos/index/$1'; //$1 = page number

$route['admin/anteprojetos_documentos'] = 'anteprojetos_documentos/index';
$route['admin/anteprojetos_documentos/add'] = 'anteprojetos_documentos/add';
$route['admin/anteprojetos_documentos/add/(:any)'] = 'anteprojetos_documentos/add/$1';
$route['admin/anteprojetos_documentos/update'] = 'anteprojetos_documentos/update';
$route['admin/anteprojetos_documentos/update/(:any)'] = 'anteprojetos_documentos/update/$1';
$route['admin/anteprojetos_documentos/delete/(:any)'] = 'anteprojetos_documentos/delete/$1';

$route['admin/anteprojetos_documentos/lista_documento/(:any)'] = 'anteprojetos_documentos/lista_documento/$1';
$route['admin/anteprojetos_documentos/(:any)'] = 'anteprojetos_documentos/index/$1'; //$1 = page number

$route['admin/acompanhamento_fisico'] = 'acompanhamento_fisico/index';
$route['admin/acompanhamento_fisico/add'] = 'acompanhamento_fisico/add';
$route['admin/acompanhamento_fisico/update'] = 'acompanhamento_fisico/update';
$route['admin/acompanhamento_fisico/update/(:any)'] = 'acompanhamento_fisico/update/$1';
$route['admin/acompanhamento_fisico/delete/(:any)'] = 'acompanhamento_fisico/delete/$1';
$route['admin/acompanhamento_fisico/(:any)'] = 'acompanhamento_fisico/index/$1'; //$1 = page number


$route['admin/anteprojetos_acompanhamento_fisico'] = 'anteprojetos_acompanhamento_fisico/index';
$route['admin/anteprojetos_acompanhamento_fisico/add'] = 'anteprojetos_acompanhamento_fisico/add';
$route['admin/anteprojetos_acompanhamento_fisico/add/(:any)/(:any)'] = 'anteprojetos_acompanhamento_fisico/add/$1/$2';
$route['admin/anteprojetos_acompanhamento_fisico/update'] = 'anteprojetos_acompanhamento_fisico/update';
$route['admin/anteprojetos_acompanhamento_fisico/update/(:any)'] = 'anteprojetos_acompanhamento_fisico/update/$1';
$route['admin/anteprojetos_acompanhamento_fisico/delete/(:any)'] = 'anteprojetos_acompanhamento_fisico/delete/$1';

$route['admin/anteprojetos_acompanhamento_fisico/lista_acompanhamento_fisico/(:any)'] = 'anteprojetos_acompanhamento_fisico/lista_acompanhamento_fisico/$1';
$route['admin/anteprojetos_acompanhamento_fisico/(:any)'] = 'anteprojetos_acompanhamento_fisico/index/$1'; //$1 = page number
    
$route['admin/anteprojetos_localizacao'] = 'anteprojetos_localizacao/index';
$route['admin/anteprojetos_localizacao/add'] = 'anteprojetos_localizacao/add';
$route['admin/anteprojetos_localizacao/add/(:any)/(:any)'] = 'anteprojetos_localizacao/add/$1/$2';
$route['admin/anteprojetos_localizacao/update'] = 'anteprojetos_localizacao/update';
$route['admin/anteprojetos_localizacao/update/(:any)'] = 'anteprojetos_localizacao/update/$1';
$route['admin/anteprojetos_localizacao/delete/(:any)'] = 'anteprojetos_localizacao/delete/$1';

$route['admin/anteprojetos_localizacao/lista_localizacao/(:any)'] = 'anteprojetos_localizacao/lista_localizacao/$1';
$route['admin/anteprojetos_localizacao/(:any)'] = 'anteprojetos_localizacao/index/$1'; //$1 = page number



$route['admin/localizacao'] = 'localizacao/index';
$route['admin/localizacao/add'] = 'localizacao/add';
$route['admin/localizacao/update'] = 'localizacao/update';
$route['admin/localizacao/update/(:any)'] = 'localizacao/update/$1';
$route['admin/localizacao/delete/(:any)'] = 'localizacao/delete/$1';
$route['admin/localizacao/(:any)'] = 'localizacao/index/$1'; //$1 = page number


$route['admin/empreendimentos'] = 'empreendimentos/index';
$route['admin/empreendimentos/add'] = 'empreendimentos/add';
$route['admin/empreendimentos/update'] = 'empreendimentos/update';
$route['admin/empreendimentos/update/(:any)'] = 'empreendimentos/update/$1';
$route['admin/empreendimentos/delete/(:any)'] = 'empreendimentos/delete/$1';
$route['admin/empreendimentos/(:any)'] = 'empreendimentos/index/$1'; //$1 = page number

$route['admin/empreendimentos_anteprojetos'] = 'empreendimentos_anteprojetos/index';
$route['admin/empreendimentos_anteprojetos/add'] = 'empreendimentos_anteprojetos/add';
$route['admin/empreendimentos_anteprojetos/add/(:any)/(:any)'] = 'empreendimentos_anteprojetos/add/$1/$2';
$route['admin/empreendimentos_anteprojetos/update'] = 'empreendimentos_anteprojetos/update';
$route['admin/empreendimentos_anteprojetos/update/(:any)'] = 'empreendimentos_anteprojetos/update/$1';
$route['admin/empreendimentos_anteprojetos/delete/(:any)'] = 'empreendimentos_anteprojetos/delete/$1';

$route['admin/empreendimentos_anteprojetos/lista_anteprojeto/(:any)'] = 'empreendimentos_anteprojetos/lista_anteprojeto/$1'; //$1 = page number
$route['admin/empreendimentos_anteprojetos/(:any)'] = 'empreendimentos_anteprojetos/index/$1'; //$1 = page number


$route['admin/lista_acompanhamento_fisico'] = 'lista_acompanhamento_fisico/index';
$route['admin/lista_acompanhamento_fisico/add'] = 'lista_acompanhamento_fisico/add';
$route['admin/lista_acompanhamento_fisico/add/(:any)'] = 'lista_acompanhamento_fisico/add/$1';
$route['admin/lista_acompanhamento_fisico/update'] = 'lista_acompanhamento_fisico/update';
$route['admin/lista_acompanhamento_fisico/update/(:any)'] = 'lista_acompanhamento_fisico/update/$1';
$route['admin/lista_acompanhamento_fisico/delete/(:any)'] = 'lista_acompanhamento_fisico/delete/$1';
$route['admin/lista_acompanhamento_fisico/(:any)'] = 'lista_acompanhamento_fisico/index/$1'; //$1 = page number

//CONTRATOS

$route['admin/gestao_contratos'] = 'gestao_contratos';



$route['admin/contratos'] = 'contratos/index';
$route['admin/contratos/add'] = 'contratos/add';
$route['admin/contratos/update'] = 'contratos/update';
$route['admin/contratos/update/(:any)'] = 'contratos/update/$1';
$route['admin/contratos/delete/(:any)'] = 'contratos/delete/$1';
$route['admin/contratos/orcamento'] = 'contratos/orcamento';
$route['admin/contratos/orcamento/(:any)'] = 'contratos/orcamento/$1';
$route['admin/contratos/gerencial'] = 'contratos/gerencial';
$route['admin/contratos/gerencial/(:any)'] = 'contratos/gerencial/$1';

$route['admin/contratos/get_contrato_all_events'] = 'contratos/get_contrato_all_events';

$route['admin/contratos/controle'] = 'contratos/controle';
$route['admin/contratos/controle2'] = 'contratos/controle2';

$route['admin/contratos/upload_data'] = 'contratos/upload_data';
$route['admin/contratos/upload_medicoes'] = 'contratos/upload_medicoes';
$route['admin/contratos/upload_empenhos'] = 'contratos/upload_empenhos';

$route['admin/contratos/(:any)'] = 'contratos/index/$1'; //$1 = page number


$route['admin/contratos_relacoes'] = 'contratos_relacoes/index';
$route['admin/contratos_relacoes/add'] = 'contratos_relacoes/add';
$route['admin/contratos_relacoes/add/(:any)'] = 'contratos_relacoes/add/$1';
$route['admin/contratos_relacoes/update'] = 'contratos_relacoes/update';
$route['admin/contratos_relacoes/update/(:any)'] = 'contratos_relacoes/update/$1';
$route['admin/contratos_relacoes/delete/(:any)'] = 'contratos_relacoes/delete/$1';
$route['admin/contratos_relacoes/(:any)'] = 'contratos_relacoes/index/$1'; //$1 = page number

$route['admin/contratos_empenhos'] = 'contratos_empenhos/index';
$route['admin/contratos_empenhos/add'] = 'contratos_empenhos/add';
$route['admin/contratos_empenhos/add/(:any)'] = 'contratos_empenhos/add/$1';
$route['admin/contratos_empenhos/update'] = 'contratos_empenhos/update';
$route['admin/contratos_empenhos/update/(:any)'] = 'contratos_empenhos/update/$1';
$route['admin/contratos_empenhos/delete/(:any)'] = 'contratos_empenhos/delete/$1';
$route['admin/contratos_empenhos/(:any)'] = 'contratos_empenhos/index/$1'; //$1 = page number

$route['admin/contratos_medicoes'] = 'contratos_medicoes/index';
$route['admin/contratos_medicoes/add'] = 'contratos_medicoes/add';
$route['admin/contratos_medicoes/add/(:any)'] = 'contratos_medicoes/add/$1';
$route['admin/contratos_medicoes/update'] = 'contratos_medicoes/update';
$route['admin/contratos_medicoes/update/(:any)'] = 'contratos_medicoes/update/$1';
$route['admin/contratos_medicoes/delete/(:any)'] = 'contratos_medicoes/delete/$1';
$route['admin/contratos_medicoes/(:any)'] = 'contratos_medicoes/index/$1'; //$1 = page number
    


$route['admin/programas'] = 'programas/index';
$route['admin/programas/add'] = 'programas/add';
$route['admin/programas/add/(:any)'] = 'programas/add/$1';
$route['admin/programas/update'] = 'programas/update';
$route['admin/programas/update/(:any)'] = 'programas/update/$1';
$route['admin/programas/delete/(:any)'] = 'programas/delete/$1';
$route['admin/programas/(:any)'] = 'programas/index/$1'; //$1 = page number
    
$route['admin/orcamento'] = 'orcamento/index';
$route['admin/orcamento/add'] = 'orcamento/add';
$route['admin/orcamento/add/(:any)'] = 'orcamento/add/$1';
$route['admin/orcamento/add_projecao(:any)'] = 'orcamento/add_projecao/$1';
$route['admin/orcamento/update'] = 'orcamento/update';
$route['admin/orcamento/update/(:any)'] = 'orcamento/update/$1';
$route['admin/orcamento/delete/(:any)'] = 'orcamento/delete/$1';
$route['admin/orcamento/editTable'] = 'orcamento/editTable';
$route['admin/orcamento/delete_projecao/(:any)'] = 'orcamento/delete_projecao/$1';
$route['admin/orcamento/projecoes/(:any)'] = 'orcamento/projecoes/$1';
$route['admin/orcamento/(:any)'] = 'orcamento/index/$1'; //$1 = page number


$route['admin/imagens'] = 'imagens/index';
$route['admin/imagens/add'] = 'imagens/add';
$route['admin/imagens/add/(:any)'] = 'imagens/add/$1';
$route['admin/imagens/update'] = 'imagens/update';
$route['admin/imagens/update/(:any)'] = 'imagens/update/$1';
$route['admin/imagens/delete/(:any)'] = 'imagens/delete/$1';
$route['admin/imagens/(:any)'] = 'imagens/index/$1'; //$1 = page number
    
$route['admin/anteprojetos_imagens'] = 'anteprojetos_imagens/index';
$route['admin/anteprojetos_imagens/add'] = 'anteprojetos_imagens/add';
$route['admin/anteprojetos_imagens/add/(:any)'] = 'anteprojetos_imagens/add/$1';
$route['admin/anteprojetos_imagens/update'] = 'anteprojetos_imagens/update';
$route['admin/anteprojetos_imagens/update/(:any)'] = 'anteprojetos_imagens/update/$1';
$route['admin/anteprojetos_imagens/delete/(:any)'] = 'anteprojetos_imagens/delete/$1';
$route['admin/anteprojetos_imagens/(:any)'] = 'anteprojetos_imagens/index/$1'; //$1 = page number

$route['admin/anteprojetos_categorias_imagens'] = 'anteprojetos_categorias_imagens/index';
$route['admin/anteprojetos_categorias_imagens/add'] = 'anteprojetos_categorias_imagens/add';
$route['admin/anteprojetos_categorias_imagens/add/(:any)'] = 'anteprojetos_categorias_imagens/add/$1';
$route['admin/anteprojetos_categorias_imagens/update'] = 'anteprojetos_categorias_imagens/update';
$route['admin/anteprojetos_categorias_imagens/update/(:any)'] = 'anteprojetos_categorias_imagens/update/$1';
$route['admin/anteprojetos_categorias_imagens/delete/(:any)'] = 'anteprojetos_categorias_imagens/delete/$1';
$route['admin/anteprojetos_categorias_imagens/(:any)'] = 'anteprojetos_categorias_imagens/index/$1'; //$1 = page number

$route['admin/empresas'] = 'empresas/index';
$route['admin/empresas/add'] = 'empresas/add';
$route['admin/empresas/update'] = 'empresas/update';
$route['admin/empresas/update/(:any)'] = 'empresas/update/$1';
$route['admin/empresas/delete/(:any)'] = 'empresas/delete/$1';
$route['admin/empresas/(:any)'] = 'empresas/index/$1'; //$1 = page number


$route['admin/pendencias'] = 'pendencias/index';
$route['admin/pendencias/add'] = 'pendencias/add';
$route['admin/pendencias/add/(:any)'] = 'pendencias/add/$1';
$route['admin/pendencias/update'] = 'pendencias/update';
$route['admin/pendencias/update/(:any)'] = 'pendencias/update/$1';
$route['admin/pendencias/delete/(:any)'] = 'pendencias/delete/$1';
$route['admin/pendencias/(:any)'] = 'pendencias/index/$1'; //$1 = page number

$route['admin/anteprojetos_pendencias'] = 'anteprojetos_pendencias/index';
$route['admin/anteprojetos_pendencias/add'] = 'anteprojetos_pendencias/add';
$route['admin/anteprojetos_pendencias/add/(:any)'] = 'anteprojetos_pendencias/add/$1';
$route['admin/anteprojetos_pendencias/add_json'] = 'anteprojetos_pendencias/add_json';
$route['admin/anteprojetos_pendencias/add_json/(:any)'] = 'anteprojetos_pendencias/add_json/$1';
$route['admin/anteprojetos_pendencias/update'] = 'anteprojetos_pendencias/update';
$route['admin/anteprojetos_pendencias/update/(:any)'] = 'anteprojetos_pendencias/update/$1';
$route['admin/anteprojetos_pendencias/delete/(:any)'] = 'anteprojetos_pendencias/delete/$1';
$route['admin/anteprojetos_pendencias/(:any)'] = 'anteprojetos_pendencias/index/$1'; //$1 = page number

// CONTRATOS

$route['admin/coordenacao_geral'] = 'coordenacao_geral/index';
$route['admin/coordenacao_geral/add'] = 'coordenacao_geral/add';
$route['admin/coordenacao_geral/update'] = 'coordenacao_geral/update';
$route['admin/coordenacao_geral/update/(:any)'] = 'coordenacao_geral/update/$1';
$route['admin/coordenacao_geral/delete/(:any)'] = 'coordenacao_geral/delete/$1';
$route['admin/coordenacao_geral/(:any)'] = 'coordenacao_geral/index/$1'; //$1 = page number

$route['admin/coordenacao_setorial'] = 'coordenacao_setorial/index';
$route['admin/coordenacao_setorial/add'] = 'coordenacao_setorial/add';
$route['admin/coordenacao_setorial/update'] = 'coordenacao_setorial/update';
$route['admin/coordenacao_setorial/update/(:any)'] = 'coordenacao_setorial/update/$1';
$route['admin/coordenacao_setorial/delete/(:any)'] = 'coordenacao_setorial/delete/$1';
$route['admin/coordenacao_setorial/(:any)'] = 'coordenacao_setorial/index/$1'; //$1 = page number

$route['admin/coordenacao_geral_setorial'] = 'coordenacao_geral_setorial/index';
$route['admin/coordenacao_geral_setorial/add'] = 'coordenacao_geral_setorial/add';
$route['admin/coordenacao_geral_setorial/add/(:any)'] = 'coordenacao_geral_setorial/add/$1';
$route['admin/coordenacao_geral_setorial/update'] = 'coordenacao_geral_setorial/update';
$route['admin/coordenacao_geral_setorial/update/(:any)'] = 'coordenacao_geral_setorial/update/$1';
$route['admin/coordenacao_geral_setorial/delete/(:any)'] = 'coordenacao_geral_setorial/delete/$1';
$route['admin/coordenacao_geral_setorial/(:any)'] = 'coordenacao_geral_setorial/index/$1'; //$1 = page number
    
$route['admin/coordenacao_geral_contratos'] = 'coordenacao_geral_contratos/index';
$route['admin/coordenacao_geral_contratos/add'] = 'coordenacao_geral_contratos/add';
$route['admin/coordenacao_geral_contratos/add/(:any)'] = 'coordenacao_geral_contratos/add/$1';
$route['admin/coordenacao_geral_contratos/update'] = 'coordenacao_geral_contratos/update';
$route['admin/coordenacao_geral_contratos/update/(:any)'] = 'coordenacao_geral_contratos/update/$1';
$route['admin/coordenacao_geral_contratos/delete/(:any)'] = 'coordenacao_geral_contratos/delete/$1';
$route['admin/coordenacao_geral_contratos/(:any)'] = 'coordenacao_geral_contratos/index/$1'; //$1 = page number


$route['admin/intervencao'] = 'intervencao/index';
$route['admin/intervencao/add'] = 'intervencao/add';
$route['admin/intervencao/update'] = 'intervencao/update';
$route['admin/intervencao/update/(:any)'] = 'intervencao/update/$1';
$route['admin/intervencao/delete/(:any)'] = 'intervencao/delete/$1';
$route['admin/intervencao/(:any)'] = 'intervencao/index/$1'; //$1 = page number

// relatorio gerencial

$route['admin/relatorio_gerencial'] = 'relatorio_gerencial/index';
$route['admin/relatorio_gerencial/add'] = 'relatorio_gerencial/add';
$route['admin/relatorio_gerencial/add/(:any)'] = 'relatorio_gerencial/add/$1';
$route['admin/relatorio_gerencial/update'] = 'relatorio_gerencial/update';
$route['admin/relatorio_gerencial/update/(:any)'] = 'relatorio_gerencial/update/$1';
$route['admin/relatorio_gerencial/delete/(:any)'] = 'relatorio_gerencial/delete/$1';
$route['admin/relatorio_gerencial/delete_file/(:any)'] = 'relatorio_gerencial/delete_file/$1';

$route['admin/relatorio_gerencial/(:any)'] = 'relatorio_gerencial/index/$1'; //$1 = page number


// MAPEAMENTO

$route['admin/mapeamento'] = 'mapeamento/index';
$route['admin/mapeamento/add'] = 'mapeamento/add';
$route['admin/mapeamento/dashboard'] = 'mapeamento/dashboard';
$route['admin/mapeamento/add/(:any)'] = 'mapeamento/add/$1';
$route['admin/mapeamento/update'] = 'mapeamento/update';
$route['admin/mapeamento/update/(:any)'] = 'mapeamento/update/$1';
$route['admin/mapeamento/delete/(:any)'] = 'mapeamento/delete/$1';
$route['admin/mapeamento/(:any)'] = 'mapeamento/index/$1'; //$1 = page number



//PRODUTO 2

$route['admin/equipamentos'] = 'equipamentos/index';
$route['admin/equipamentos/add'] = 'equipamentos/add';
$route['admin/equipamentos/update'] = 'equipamentos/update';
$route['admin/equipamentos/update/(:any)'] = 'equipamentos/update/$1';
$route['admin/equipamentos/delete/(:any)'] = 'equipamentos/delete/$1';
$route['admin/equipamentos/(:any)'] = 'equipamentos/index/$1'; //$1 = page number

$route['admin/materiais'] = 'materiais/index';
$route['admin/materiais/add'] = 'materiais/add';
$route['admin/materiais/update'] = 'materiais/update';
$route['admin/materiais/update/(:any)'] = 'materiais/update/$1';
$route['admin/materiais/delete/(:any)'] = 'materiais/delete/$1';
$route['admin/materiais/(:any)'] = 'materiais/index/$1'; //$1 = page number

$route['admin/mao_obra'] = 'mao_obra/index';
$route['admin/mao_obra/add'] = 'mao_obra/add';
$route['admin/mao_obra/update'] = 'mao_obra/update';
$route['admin/mao_obra/update/(:any)'] = 'mao_obra/update/$1';
$route['admin/mao_obra/delete/(:any)'] = 'mao_obra/delete/$1';
$route['admin/mao_obra/(:any)'] = 'mao_obra/index/$1'; //$1 = page number

$route['admin/materiais_betuminosos'] = 'materiais_betuminosos/index';
$route['admin/materiais_betuminosos/add'] = 'materiais_betuminosos/add';
$route['admin/materiais_betuminosos/update'] = 'materiais_betuminosos/update';
$route['admin/materiais_betuminosos/update/(:any)'] = 'materiais_betuminosos/update/$1';
$route['admin/materiais_betuminosos/delete/(:any)'] = 'materiais_betuminosos/delete/$1';
$route['admin/materiais_betuminosos/(:any)'] = 'materiais_betuminosos/index/$1'; //$1 = page number

$route['admin/sicro_equipamento_custo'] = 'sicro_equipamento_custo/index';
$route['admin/sicro_equipamento_custo/add'] = 'sicro_equipamento_custo/add';
$route['admin/sicro_equipamento_custo/add/(:any)'] = 'sicro_equipamento_custo/add/$1';
$route['admin/sicro_equipamento_custo/add/(:any)/(:any)'] = 'sicro_equipamento_custo/add/$1/$2';
$route['admin/sicro_equipamento_custo/update'] = 'sicro_equipamento_custo/update';
$route['admin/sicro_equipamento_custo/update/(:any)'] = 'sicro_equipamento_custo/update/$1';
$route['admin/sicro_equipamento_custo/delete/(:any)'] = 'sicro_equipamento_custo/delete/$1';
// 
$route['admin/sicro_equipamento_custo/lista_equipamento/(:any)'] = 'sicro_equipamento_custo/lista_equipamento/$1';
$route['admin/sicro_equipamento_custo/(:any)'] = 'sicro_equipamento_custo/index/$1'; //$1 = page number

$route['admin/sicro_mao_obra_custo'] = 'sicro_mao_obra_custo/index';
$route['admin/sicro_mao_obra_custo/add'] = 'sicro_mao_obra_custo/add';
$route['admin/sicro_mao_obra_custo/add/(:any)'] = 'sicro_mao_obra_custo/add/$1';
$route['admin/sicro_mao_obra_custo/add/(:any)/(:any)'] = 'sicro_mao_obra_custo/add/$1/$2';
$route['admin/sicro_mao_obra_custo/update'] = 'sicro_mao_obra_custo/update';
$route['admin/sicro_mao_obra_custo/update/(:any)'] = 'sicro_mao_obra_custo/update/$1';
$route['admin/sicro_mao_obra_custo/delete/(:any)'] = 'sicro_mao_obra_custo/delete/$1';
//
$route['admin/sicro_mao_obra_custo/lista_mao_obra/(:any)'] = 'sicro_mao_obra_custo/lista_mao_obra/$1';
$route['admin/sicro_mao_obra_custo/(:any)'] = 'sicro_mao_obra_custo/index/$1'; //$1 = page number

$route['admin/sicro_material_custo'] = 'sicro_material_custo/index';
$route['admin/sicro_material_custo/add'] = 'sicro_material_custo/add';
$route['admin/sicro_material_custo/add/(:any)'] = 'sicro_material_custo/add/$1';
$route['admin/sicro_material_custo/add/(:any)/(:any)'] = 'sicro_material_custo/add/$1/$2';
$route['admin/sicro_material_custo/update'] = 'sicro_material_custo/update';
$route['admin/sicro_material_custo/update/(:any)'] = 'sicro_material_custo/update/$1';
$route['admin/sicro_material_custo/delete/(:any)'] = 'sicro_material_custo/delete/$1';
//
$route['admin/sicro_material_custo/lista_material/(:any)'] = 'sicro_material_custo/lista_material/$1';
$route['admin/sicro_material_custo/(:any)'] = 'sicro_material_custo/index/$1'; //$1 = page number


$route['admin/sicro_material_betuminoso_custo'] = 'sicro_material_betuminoso_custo/index';
$route['admin/sicro_material_betuminoso_custo/add'] = 'sicro_material_betuminoso_custo/add';
$route['admin/sicro_material_betuminoso_custo/add/(:any)'] = 'sicro_material_betuminoso_custo/add/$1';
$route['admin/sicro_material_betuminoso_custo/add/(:any)/(:any)'] = 'sicro_material_betuminoso_custo/add/$1/$2';
$route['admin/sicro_material_betuminoso_custo/update'] = 'sicro_material_betuminoso_custo/update';
$route['admin/sicro_material_betuminoso_custo/update/(:any)'] = 'sicro_material_betuminoso_custo/update/$1';
$route['admin/sicro_material_betuminoso_custo/delete/(:any)'] = 'sicro_material_betuminoso_custo/delete/$1';
//
$route['admin/sicro_material_betuminoso_custo/lista_material_betuminoso/(:any)'] = 'sicro_material_betuminoso_custo/lista_material_betuminoso/$1';
$route['admin/sicro_material_betuminoso_custo/(:any)'] = 'sicro_material_betuminoso_custo/index/$1'; //$1 = page number


$route['admin/composicao_material'] = 'composicao_material/index';
$route['admin/composicao_material/add'] = 'composicao_material/add';
$route['admin/composicao_material/add/(:any)'] = 'composicao_material/add/$1';
$route['admin/composicao_material/update'] = 'composicao_material/update';
$route['admin/composicao_material/update/(:any)'] = 'composicao_material/update/$1';
$route['admin/composicao_material/delete/(:any)'] = 'composicao_material/delete/$1';
//
$route['admin/composicao_material/lista_material/(:any)'] = 'composicao_material/lista_material/$1';
$route['admin/composicao_material/(:any)'] = 'composicao_material/index/$1'; //$1 = page number

$route['admin/composicao_material_betuminoso'] = 'composicao_material_betuminoso/index';
$route['admin/composicao_material_betuminoso/add'] = 'composicao_material_betuminoso/add';
$route['admin/composicao_material_betuminoso/add/(:any)'] = 'composicao_material_betuminoso/add/$1';
$route['admin/composicao_material_betuminoso/update'] = 'composicao_material_betuminoso/update';
$route['admin/composicao_material_betuminoso/update/(:any)'] = 'composicao_material_betuminoso/update/$1';
$route['admin/composicao_material_betuminoso/delete/(:any)'] = 'composicao_material_betuminoso/delete/$1';

$route['admin/composicao_material_betuminoso/lista_material_betuminoso/(:any)'] = 'composicao_material_betuminoso/lista_material_betuminoso/$1';
$route['admin/composicao_material_betuminoso/(:any)'] = 'composicao_material_betuminoso/index/$1'; //$1 = page number

$route['admin/composicao_mao_obra'] = 'composicao_mao_obra/index';
$route['admin/composicao_mao_obra/add'] = 'composicao_mao_obra/add';
$route['admin/composicao_mao_obra/add/(:any)'] = 'composicao_mao_obra/add/$1';
$route['admin/composicao_mao_obra/update'] = 'composicao_mao_obra/update';
$route['admin/composicao_mao_obra/update/(:any)'] = 'composicao_mao_obra/update/$1';
$route['admin/composicao_mao_obra/delete/(:any)'] = 'composicao_mao_obra/delete/$1';
//
$route['admin/composicao_mao_obra/lista_mao_obra/(:any)'] = 'composicao_mao_obra/lista_mao_obra/$1';
$route['admin/composicao_mao_obra/(:any)'] = 'composicao_mao_obra/index/$1'; //$1 = page number

$route['admin/composicao_equipamento'] = 'composicao_equipamento/index';
$route['admin/composicao_equipamento/add'] = 'composicao_equipamento/add';
$route['admin/composicao_equipamento/add/(:any)'] = 'composicao_equipamento/add/$1';
$route['admin/composicao_equipamento/update'] = 'composicao_equipamento/update';
$route['admin/composicao_equipamento/update/(:any)'] = 'composicao_equipamento/update/$1';
$route['admin/composicao_equipamento/delete/(:any)'] = 'composicao_equipamento/delete/$1';
//			  
$route['admin/composicao_equipamento/lista_equipamento/(:any)'] = 'composicao_equipamento/lista_equipamento/$1';
$route['admin/composicao_equipamento/(:any)'] = 'composicao_equipamento/index/$1'; //$1 = page number

$route['admin/composicao_composicao'] = 'composicao_composicao/index';
$route['admin/composicao_composicao/add'] = 'composicao_composicao/add';
$route['admin/composicao_composicao/add/(:any)'] = 'composicao_composicao/add/$1';
$route['admin/composicao_composicao/update'] = 'composicao_composicao/update';
$route['admin/composicao_composicao/update/(:any)'] = 'composicao_composicao/update/$1';
$route['admin/composicao_composicao/delete/(:any)'] = 'composicao_composicao/delete/$1';
//
$route['admin/composicao_composicao/lista_composicao/(:any)'] = 'composicao_composicao/lista_composicao/$1';
$route['admin/composicao_composicao/(:any)'] = 'composicao_composicao/index/$1'; //$1 = page number
    
$route['admin/composicao_composicao_transporte'] = 'composicao_composicao_transporte/index';
$route['admin/composicao_composicao_transporte/add'] = 'composicao_composicao_transporte/add';
$route['admin/composicao_composicao_transporte/add/(:any)'] = 'composicao_composicao_transporte/add/$1';
$route['admin/composicao_composicao_transporte/update'] = 'composicao_composicao_transporte/update';
$route['admin/composicao_composicao_transporte/update/(:any)'] = 'composicao_composicao_transporte/update/$1';
$route['admin/composicao_composicao_transporte/delete/(:any)'] = 'composicao_composicao_transporte/delete/$1';
//
$route['admin/composicao_composicao_transporte/lista_composicao_transporte/(:any)'] = 'composicao_composicao_transporte/lista_composicao_transporte/$1';
$route['admin/composicao_composicao_transporte/(:any)'] = 'composicao_composicao_transporte/index/$1'; //$1 = page number


$route['admin/sicros'] = 'sicros/index';
$route['admin/sicros/add'] = 'sicros/add';
$route['admin/sicros/update'] = 'sicros/update';
$route['admin/sicros/update/(:any)'] = 'sicros/update/$1';
$route['admin/sicros/delete/(:any)'] = 'sicros/delete/$1';
$route['admin/sicros/(:any)'] = 'sicros/index/$1'; //$1 = page number

$route['admin/composicoes'] = 'composicoes/index';
$route['admin/composicoes/add'] = 'composicoes/add';
$route['admin/composicoes/update'] = 'composicoes/update';
$route['admin/composicoes/update/(:any)'] = 'composicoes/update/$1';
$route['admin/composicoes/delete/(:any)'] = 'composicoes/delete/$1';
$route['admin/composicoes/composicao_checar/(:any)/(:any)'] = 'composicoes/composicao_checar/$1/$2';
$route['admin/composicoes/(:any)'] = 'composicoes/index/$1'; //$1 = page number

$route['admin/caracteristica_volumetrica'] = 'caracteristica_volumetrica/index';
$route['admin/caracteristica_volumetrica/add'] = 'caracteristica_volumetrica/add';
$route['admin/caracteristica_volumetrica/update'] = 'caracteristica_volumetrica/update';
$route['admin/caracteristica_volumetrica/update/(:any)'] = 'caracteristica_volumetrica/update/$1';
$route['admin/caracteristica_volumetrica/delete/(:any)'] = 'caracteristica_volumetrica/delete/$1';
$route['admin/caracteristica_volumetrica/(:any)'] = 'caracteristica_volumetrica/index/$1'; //$1 = page number
    
$route['admin/categorias'] = 'categorias/index';
$route['admin/categorias/add'] = 'categorias/add';
$route['admin/categorias/update'] = 'categorias/update';
$route['admin/categorias/update/(:any)'] = 'categorias/update/$1';
$route['admin/categorias/delete/(:any)'] = 'categorias/delete/$1';
$route['admin/categorias/(:any)'] = 'categorias/index/$1'; //$1 = page number

$route['admin/tipo_solucao'] = 'tipo_solucao/index';
$route['admin/tipo_solucao/add'] = 'tipo_solucao/add';
$route['admin/tipo_solucao/update'] = 'tipo_solucao/update';
$route['admin/tipo_solucao/update/(:any)'] = 'tipo_solucao/update/$1';
$route['admin/tipo_solucao/delete/(:any)'] = 'tipo_solucao/delete/$1';
$route['admin/tipo_solucao/(:any)'] = 'tipo_solucao/index/$1'; //$1 = page number

$route['admin/solucoes'] = 'solucoes/index';
$route['admin/solucoes/add'] = 'solucoes/add';
$route['admin/solucoes/update'] = 'solucoes/update';
$route['admin/solucoes/update/(:any)'] = 'solucoes/update/$1';
$route['admin/solucoes/delete/(:any)'] = 'solucoes/delete/$1';
$route['admin/solucoes/executa_solucao/(:any)'] = 'solucoes/executa_solucao/$1';

$route['admin/solucoes/solucao_checar/(:any)/(:any)'] = 'solucoes/solucao_checar/$1/$2';

$route['admin/solucoes/(:any)'] = 'solucoes/index/$1'; //$1 = page number

$route['admin/solucao_composicao'] = 'solucao_composicao/index';
$route['admin/solucao_composicao/add'] = 'solucao_composicao/add';
$route['admin/solucao_composicao/add/(:any)'] = 'solucao_composicao/add/$1';
$route['admin/solucao_composicao/update'] = 'solucao_composicao/update';
$route['admin/solucao_composicao/update/(:any)'] = 'solucao_composicao/update/$1';
$route['admin/solucao_composicao/delete/(:any)'] = 'solucao_composicao/delete/$1';

$route['admin/solucao_composicao/lista_composicao/(:any)'] = 'solucao_composicao/lista_composicao/$1';
$route['admin/solucao_composicao/(:any)'] = 'solucao_composicao/index/$1'; //$1 = page number

$route['admin/variaveis'] = 'variaveis/index';
$route['admin/variaveis/add'] = 'variaveis/add';
$route['admin/variaveis/update'] = 'variaveis/update';
$route['admin/variaveis/update/(:any)'] = 'variaveis/update/$1';
$route['admin/variaveis/delete/(:any)'] = 'variaveis/delete/$1';
$route['admin/variaveis/(:any)'] = 'variaveis/index/$1'; //$1 = page number

$route['admin/composicao_variaveis'] = 'composicao_variaveis/index';
$route['admin/composicao_variaveis/add'] = 'composicao_variaveis/add';
$route['admin/composicao_variaveis/update'] = 'composicao_variaveis/update';
$route['admin/composicao_variaveis/update/(:any)'] = 'composicao_variaveis/update/$1';
$route['admin/composicao_variaveis/delete/(:any)'] = 'composicao_variaveis/delete/$1';
$route['admin/composicao_variaveis/(:any)'] = 'composicao_variaveis/index/$1'; //$1 = page number


// TRANSPOSTES DESAFIO

$route['admin/sicro_transporte'] = 'sicro_transporte/index';
$route['admin/sicro_transporte/add'] = 'sicro_transporte/add';
$route['admin/sicro_transporte/update'] = 'sicro_transporte/update';
$route['admin/sicro_transporte/update/(:any)'] = 'sicro_transporte/update/$1';
$route['admin/sicro_transporte/delete/(:any)'] = 'sicro_transporte/delete/$1';
$route['admin/sicro_transporte/(:any)'] = 'sicro_transporte/index/$1'; //$1 = page number
    
$route['admin/transporte_material_classe'] = 'transporte_material_classe/index';
$route['admin/transporte_material_classe/add'] = 'transporte_material_classe/add';
$route['admin/transporte_material_classe/update'] = 'transporte_material_classe/update';
$route['admin/transporte_material_classe/update/(:any)'] = 'transporte_material_classe/update/$1';
$route['admin/transporte_material_classe/delete/(:any)'] = 'transporte_material_classe/delete/$1';

$route['admin/transporte_material_classe/lista_transporte_material_classe/(:any)'] = 'transporte_material_classe/lista_transporte_material_classe/$1';
$route['admin/transporte_material_classe/(:any)'] = 'transporte_material_classe/index/$1'; //$1 = page number

$route['admin/transportes'] = 'transportes/index';
$route['admin/transportes/add'] = 'transportes/add';
$route['admin/transportes/update'] = 'transportes/update';
$route['admin/transportes/update/(:any)'] = 'transportes/update/$1';
$route['admin/transportes/delete/(:any)'] = 'transportes/delete/$1';
$route['admin/transportes/(:any)'] = 'transportes/index/$1'; //$1 = page number
    
$route['admin/material_transporte'] = 'material_transporte/index';
$route['admin/material_transporte/add'] = 'material_transporte/add';
$route['admin/material_transporte/update'] = 'material_transporte/update';
$route['admin/material_transporte/update/(:any)'] = 'material_transporte/update/$1';
$route['admin/material_transporte/delete/(:any)'] = 'material_transporte/delete/$1';
$route['admin/material_transporte/(:any)'] = 'material_transporte/index/$1'; //$1 = page number

$route['admin/material_betuminoso_transporte'] = 'material_betuminoso_transporte/index';
$route['admin/material_betuminoso_transporte/add'] = 'material_betuminoso_transporte/add';
$route['admin/material_betuminoso_transporte/update'] = 'material_betuminoso_transporte/update';
$route['admin/material_betuminoso_transporte/update/(:any)'] = 'material_betuminoso_transporte/update/$1';
$route['admin/material_betuminoso_transporte/delete/(:any)'] = 'material_betuminoso_transporte/delete/$1';
$route['admin/material_betuminoso_transporte/(:any)'] = 'material_betuminoso_transporte/index/$1'; //$1 = page number

$route['admin/composicao_transporte_transporte'] = 'composicao_transporte_transporte/index';
$route['admin/composicao_transporte_transporte/add'] = 'composicao_transporte_transporte/add';
$route['admin/composicao_transporte_transporte/update'] = 'composicao_transporte_transporte/update';
$route['admin/composicao_transporte_transporte/update/(:any)'] = 'composicao_transporte_transporte/update/$1';
$route['admin/composicao_transporte_transporte/delete/(:any)'] = 'composicao_transporte_transporte/delete/$1';
$route['admin/composicao_transporte_transporte/(:any)'] = 'composicao_transporte_transporte/index/$1'; //$1 = page number


$route['admin/composicao_transporte'] = 'composicao_transporte/index';
$route['admin/composicao_transporte/add'] = 'composicao_transporte/add';
$route['admin/composicao_transporte/update'] = 'composicao_transporte/update';
$route['admin/composicao_transporte/update/(:any)'] = 'composicao_transporte/update/$1';
$route['admin/composicao_transporte/delete/(:any)'] = 'composicao_transporte/delete/$1';
$route['admin/composicao_transporte/(:any)'] = 'composicao_transporte/index/$1'; //$1 = page number
    
$route['admin/categoria_tipo'] = 'categoria_tipo/index';
$route['admin/categoria_tipo/add'] = 'categoria_tipo/add';
$route['admin/categoria_tipo/update'] = 'categoria_tipo/update';
$route['admin/categoria_tipo/update/(:any)'] = 'categoria_tipo/update/$1';
$route['admin/categoria_tipo/delete/(:any)'] = 'categoria_tipo/delete/$1';
$route['admin/categoria_tipo/(:any)'] = 'categoria_tipo/index/$1'; //$1 = page number
    
$route['admin/relatorios_cmg'] = 'relatorios_cmg/index';
$route['admin/relatorios_cmg/gerar_relatorio'] = 'relatorios_cmg/gerar_relatorio';
$route['admin/relatorios_cmg/gerar_relatorio/(:any)'] = 'relatorios_cmg/gerar_relatorio/$1';
$route['admin/relatorios_cmg/gerar_relatorio_categoria/(:any)/(:any)/(:any)'] = 'relatorios_cmg/gerar_relatorio_categoria/$1/$2/$3';
$route['admin/relatorios_cmg/update/(:any)'] = 'relatorios_cmg/update/$1';
$route['admin/relatorios_cmg/delete/(:any)'] = 'relatorios_cmg/delete/$1';

$route['admin/relatorios_cmg/catalogos'] = 'relatorios_cmg/catalogos';
$route['admin/relatorios_cmg/gerar_catalogo/(:any)'] = 'relatorios_cmg/gerar_catalogo/$1';
$route['admin/relatorios_cmg/get_catalogo_hdm/(:any)'] = 'relatorios_cmg/get_catalogo_hdm/$1';

$route['admin/relatorios_cmg/get_catalogo_concreto_asflatico'] = 'relatorios_cmg/get_catalogo_concreto_asflatico';
$route['admin/relatorios_cmg/get_catalogo_concreto_asflatico/(:any)'] = 'relatorios_cmg/get_catalogo_concreto_asflatico/$1';

$route['admin/relatorios_cmg/get_catalogo_tratamento_superficial'] = 'relatorios_cmg/get_catalogo_tratamento_superficial';
$route['admin/relatorios_cmg/get_catalogo_tratamento_superficial/(:any)'] = 'relatorios_cmg/get_catalogo_tratamento_superficial/$1';
$route['admin/relatorios_cmg/get_passarela'] = 'relatorios_cmg/get_passarela';
$route['admin/relatorios_cmg/(:any)'] = 'relatorios_cmg/index/$1'; //$1 = page number

$route['admin/fator_pavimentacao_padrao'] = 'fator_pavimentacao_padrao/index';
$route['admin/fator_pavimentacao_padrao/add'] = 'fator_pavimentacao_padrao/add';
$route['admin/fator_pavimentacao_padrao/update'] = 'fator_pavimentacao_padrao/update';
$route['admin/fator_pavimentacao_padrao/update/(:any)'] = 'fator_pavimentacao_padrao/update/$1';
$route['admin/fator_pavimentacao_padrao/delete/(:any)'] = 'fator_pavimentacao_padrao/delete/$1';
$route['admin/fator_pavimentacao_padrao/(:any)'] = 'fator_pavimentacao_padrao/index/$1'; //$1 = page number

$route['admin/sicro_fator_pavimentacao'] = 'sicro_fator_pavimentacao/index';
$route['admin/sicro_fator_pavimentacao/add'] = 'sicro_fator_pavimentacao/add';
$route['admin/sicro_fator_pavimentacao/add/(:any)'] = 'sicro_fator_pavimentacao/add/$1';
$route['admin/sicro_fator_pavimentacao/update'] = 'sicro_fator_pavimentacao/update';
$route['admin/sicro_fator_pavimentacao/update/(:any)'] = 'sicro_fator_pavimentacao/update/$1';
$route['admin/sicro_fator_pavimentacao/delete/(:any)'] = 'sicro_fator_pavimentacao/delete/$1';
// 
$route['admin/sicro_fator_pavimentacao/lista_fator_pavimentacao/(:any)'] = 'sicro_fator_pavimentacao/lista_fator_pavimentacao/$1';
$route['admin/sicro_fator_pavimentacao/(:any)'] = 'sicro_fator_pavimentacao/index/$1'; //$1 = page number
    
$route['admin/hdm_veiculos'] = 'hdm_veiculos/index';
$route['admin/hdm_veiculos/add'] = 'hdm_veiculos/add';
$route['admin/hdm_veiculos/update'] = 'hdm_veiculos/update';
$route['admin/hdm_veiculos/update/(:any)'] = 'hdm_veiculos/update/$1';
$route['admin/hdm_veiculos/delete/(:any)'] = 'hdm_veiculos/delete/$1';

$route['admin/hdm_veiculos/relatorios'] = 'hdm_veiculos/relatorios';
$route['admin/hdm_veiculos/relatorios/(:any)'] = 'hdm_veiculos/relatorios/$1';
$route['admin/hdm_veiculos/get_relatorio/(:any)'] = 'hdm_veiculos/get_relatorio/$1';
$route['admin/hdm_veiculos/get_relatorio/(:any)/(:any)'] = 'hdm_veiculos/get_relatorio/$1/$2';
$route['admin/hdm_veiculos/(:any)'] = 'hdm_veiculos/index/$1'; //$1 = page number
    
$route['admin/veiculos'] = 'veiculos/index';
$route['admin/veiculos/add'] = 'veiculos/add';
$route['admin/veiculos/update'] = 'veiculos/update';
$route['admin/veiculos/update/(:any)'] = 'veiculos/update/$1';
$route['admin/veiculos/delete/(:any)'] = 'veiculos/delete/$1';
$route['admin/veiculos/(:any)'] = 'veiculos/index/$1'; //$1 = page number

$route['admin/hdm_veiculos_vmo_vpol_vv'] = 'hdm_veiculos_vmo_vpol_vv/index';
$route['admin/hdm_veiculos_vmo_vpol_vv/add'] = 'hdm_veiculos_vmo_vpol_vv/add';
$route['admin/hdm_veiculos_vmo_vpol_vv/update'] = 'hdm_veiculos_vmo_vpol_vv/update';
$route['admin/hdm_veiculos_vmo_vpol_vv/update/(:any)'] = 'hdm_veiculos_vmo_vpol_vv/update/$1';
$route['admin/hdm_veiculos_vmo_vpol_vv/delete/(:any)'] = 'hdm_veiculos_vmo_vpol_vv/delete/$1';
$route['admin/hdm_veiculos_vmo_vpol_vv/(:any)'] = 'hdm_veiculos_vmo_vpol_vv/index/$1'; //$1 = page number

$route['admin/vpol'] = 'vpol/index';
$route['admin/vpol/add'] = 'vpol/add';
$route['admin/vpol/update'] = 'vpol/update';
$route['admin/vpol/update/(:any)'] = 'vpol/update/$1';
$route['admin/vpol/update/(:any)/(:any)'] = 'vpol/update/$1/$2';
$route['admin/vpol/delete/(:any)'] = 'vpol/delete/$1';

$route['admin/vpol/lista_vpol/(:any)'] = 'vpol/lista_vpol/$1';
$route['admin/vpol/(:any)'] = 'vpol/index/$1'; //$1 = page number

$route['admin/vv'] = 'vv/index';
$route['admin/vv/add'] = 'vv/add';
$route['admin/vv/update'] = 'vv/update';
$route['admin/vv/update/(:any)'] = 'vv/update/$1';
$route['admin/vv/update/(:any)/(:any)'] = 'vv/update/$1/$2';
$route['admin/vv/delete/(:any)'] = 'vv/delete/$1';

$route['admin/vv/lista_vv/(:any)'] = 'vv/lista_vv/$1';
$route['admin/vv/(:any)'] = 'vv/index/$1'; //$1 = page number

$route['admin/vmo'] = 'vmo/index';
$route['admin/vmo/add'] = 'vmo/add';
$route['admin/vmo/update'] = 'vmo/update';
$route['admin/vmo/update/(:any)'] = 'vmo/update/$1';
$route['admin/vmo/update/(:any)/(:any)'] = 'vmo/update/$1/$2';
$route['admin/vmo/delete/(:any)'] = 'vmo/delete/$1';

$route['admin/vmo/lista_vmo/(:any)'] = 'vmo/lista_vmo/$1';
$route['admin/vmo/(:any)'] = 'vmo/index/$1'; //$1 = page number
    
$route['admin/fator_conversao_padrao'] = 'fator_conversao_padrao/index';
$route['admin/fator_conversao_padrao/add'] = 'fator_conversao_padrao/add';
$route['admin/fator_conversao_padrao/update'] = 'fator_conversao_padrao/update';
$route['admin/fator_conversao_padrao/update/(:any)'] = 'fator_conversao_padrao/update/$1';
$route['admin/fator_conversao_padrao/delete/(:any)'] = 'fator_conversao_padrao/delete/$1';
$route['admin/fator_conversao_padrao/(:any)'] = 'fator_conversao_padrao/index/$1'; //$1 = page number

$route['admin/fator_conversao'] = 'fator_conversao/index';
$route['admin/fator_conversao/add'] = 'fator_conversao/add';
$route['admin/fator_conversao/update'] = 'fator_conversao/update';
$route['admin/fator_conversao/update/(:any)'] = 'fator_conversao/update/$1';
$route['admin/fator_conversao/update/(:any)/(:any)'] = 'fator_conversao/update/$1/$2';
$route['admin/fator_conversao/delete/(:any)'] = 'fator_conversao/delete/$1';

$route['admin/fator_conversao/lista_fator_conversao/(:any)'] = 'fator_conversao/lista_fator_conversao/$1';
$route['admin/fator_conversao/(:any)'] = 'fator_conversao/index/$1'; //$1 = page number
    




$route['admin/usuarios'] = 'usuarios/index';
$route['admin/usuarios/add'] = 'usuarios/add';
$route['admin/usuarios/update'] = 'usuarios/update';
$route['admin/usuarios/update/(:any)'] = 'usuarios/update/$1';
$route['admin/usuarios/delete/(:any)'] = 'usuarios/delete/$1';

$route['esqueci_minha_senha'] = 'usuarios/UsuarioRecPass';
$route['recuperar_senha'] = 'usuarios/recover_pass';
$route['recuperar_senha/(:any)'] = 'usuarios/recover_pass/$1';

$route['admin/usuarios/(:any)'] = 'usuarios/index/$1'; //$1 = page number

$route['admin/usuario_perfil'] = 'usuario_perfil/index';
$route['admin/usuario_perfil/add'] = 'usuario_perfil/add';
$route['admin/usuario_perfil/add/(:any)'] = 'usuario_perfil/add/$1';
$route['admin/usuario_perfil/update'] = 'usuario_perfil/update';
$route['admin/usuario_perfil/update/(:any)'] = 'usuario_perfil/update/$1';
$route['admin/usuario_perfil/delete/(:any)'] = 'usuario_perfil/delete/$1';
$route['admin/usuario_perfil/(:any)'] = 'usuario_perfil/index/$1'; //$1 = page number

$route['admin/modulos'] = 'modulos/index';
$route['admin/modulos/add'] = 'modulos/add';
$route['admin/modulos/add/(:any)'] = 'modulos/add/$1';
$route['admin/modulos/update'] = 'modulos/update';
$route['admin/modulos/update/(:any)'] = 'modulos/update/$1';
$route['admin/modulos/delete/(:any)'] = 'modulos/delete/$1';
$route['admin/modulos/acesso'] = 'modulos/acesso';
$route['admin/modulos/add_acesso'] = 'modulos/add';
$route['admin/modulos/add_acesso/(:any)'] = 'modulos/add/$1';
$route['admin/modulos/update_acesso'] = 'modulos/update';
$route['admin/modulos/update_acesso/(:any)'] = 'modulos/update/$1';
$route['admin/modulos/delete_acesso/(:any)'] = 'modulos/delete/$1';
$route['admin/modulos/(:any)'] = 'modulos/index/$1'; //$1 = page number

$route['admin/modulos_submodulos'] = 'modulos_submodulos/index';
$route['admin/modulos_submodulos/add'] = 'modulos_submodulos/add';
$route['admin/modulos_submodulos/add/(:any)'] = 'modulos_submodulos/add/$1';
$route['admin/modulos_submodulos/update'] = 'modulos_submodulos/update';
$route['admin/modulos_submodulos/update/(:any)'] = 'modulos_submodulos/update/$1';
$route['admin/modulos_submodulos/delete/(:any)'] = 'modulos_submodulos/delete/$1';
$route['admin/modulos_submodulos/(:any)'] = 'modulos_submodulos/index/$1'; //$1 = page number

$route['admin/modulos_perfil'] = 'modulos_perfil/index';
$route['admin/modulos_perfil/add'] = 'modulos_perfil/add';
$route['admin/modulos_perfil/add/(:any)'] = 'modulos_perfil/add/$1';
$route['admin/modulos_perfil/update'] = 'modulos_perfil/update';
$route['admin/modulos_perfil/update/(:any)'] = 'modulos_perfil/update/$1';
$route['admin/modulos_perfil/delete/(:any)'] = 'modulos_perfil/delete/$1';
$route['admin/modulos_perfil/lista_submodulos/(:any)'] = 'modulos_perfil/lista_submodulos/$1';
$route['admin/modulos_perfil/(:any)'] = 'modulos_perfil/index/$1'; //$1 = page number
  
$route['admin/modulos_modulos'] = 'modulos_modulos/index';
$route['admin/modulos_modulos/add'] = 'modulos_modulos/add';
$route['admin/modulos_modulos/add/(:any)'] = 'modulos_modulos/add/$1';
$route['admin/modulos_modulos/update'] = 'modulos_modulos/update';
$route['admin/modulos_modulos/update/(:any)'] = 'modulos_modulos/update/$1';
$route['admin/modulos_modulos/delete/(:any)'] = 'modulos_modulos/delete/$1';
$route['admin/modulos_modulos/(:any)'] = 'modulos_modulos/index/$1'; //$1 = page number

$route['admin/submodulos'] = 'submodulos/index';
$route['admin/submodulos/add'] = 'submodulos/add';
$route['admin/submodulos/add/(:any)'] = 'submodulos/add/$1';
$route['admin/submodulos/update'] = 'submodulos/update';
$route['admin/submodulos/update/(:any)'] = 'submodulos/update/$1';
$route['admin/submodulos/delete/(:any)'] = 'submodulos/delete/$1';
$route['admin/submodulos/(:any)'] = 'submodulos/index/$1'; //$1 = page number
    

$route['admin/usuarios_modulos'] = 'usuarios_modulos/index';
$route['admin/usuarios_modulos/add'] = 'usuarios_modulos/add';
$route['admin/usuarios_modulos/add/(:any)'] = 'usuarios_modulos/add/$1';
$route['admin/usuarios_modulos/update'] = 'usuarios_modulos/update';
$route['admin/usuarios_modulos/update/(:any)'] = 'usuarios_modulos/update/$1';
$route['admin/usuarios_modulos/delete/(:any)'] = 'usuarios_modulos/delete/$1';
$route['admin/usuarios_modulos/(:any)'] = 'usuarios_modulos/index/$1'; //$1 = page number


$route['admin/usuarios_contratos'] = 'usuarios_contratos/index';
$route['admin/usuarios_contratos/add'] = 'usuarios_contratos/add';
$route['admin/usuarios_contratos/add/(:any)'] = 'usuarios_contratos/add/$1';
$route['admin/usuarios_contratos/update'] = 'usuarios_contratos/update';
$route['admin/usuarios_contratos/update/(:any)'] = 'usuarios_contratos/update/$1';
$route['admin/usuarios_contratos/delete/(:any)'] = 'usuarios_contratos/delete/$1';
$route['admin/usuarios_contratos/(:any)'] = 'usuarios_contratos/index/$1'; //$1 = page number


// dashboard geral

$route['admin/dashboard_geral'] = 'dashboard_geral/index';


/* gestao de estudos e projetos */


$route['admin/gestao_estudos_projetos'] = 'gestao_estudos_projetos/index';
$route['admin/gestao_estudos_projetos/add'] = 'gestao_estudos_projetos/add';
$route['admin/gestao_estudos_projetos/add(:any)'] = 'gestao_estudos_projetos/add/$1';
$route['admin/gestao_estudos_projetos/update'] = 'gestao_estudos_projetos/update';
$route['admin/gestao_estudos_projetos/update/(:any)'] = 'gestao_estudos_projetos/update/$1';
$route['admin/gestao_estudos_projetos/delete/(:any)'] = 'gestao_estudos_projetos/delete/$1';
$route['admin/gestao_estudos_projetos/(:any)'] = 'gestao_estudos_projetos/index/$1'; //$1 = page number
    

// PAS

$route['admin/pas'] = 'pas/index';
$route['admin/pas/add'] = 'pas/add';
$route['admin/pas/add(:any)'] = 'pas/add/$1';
$route['admin/pas/update'] = 'pas/update';
$route['admin/pas/update/(:any)'] = 'pas/update/$1';
$route['admin/pas/delete/(:any)'] = 'pas/delete/$1';
$route['admin/pas/detalhes/(:any)'] = 'pas/detalhes/$1';
$route['admin/pas/edit_table_pendencias'] = 'pas/edit_table_pendencias';
$route['admin/pas/edit_table_pendencias/(:any)'] = 'pas/edit_table_pendencias/$1';
$route['admin/pas/contratos'] = 'pas/contratos';
$route['admin/pas/contratos/(:any)'] = 'pas/contratos/$1';
$route['admin/pas/add_img'] = 'pas/add_img';
$route['admin/pas/relatorios'] = 'pas/relatorios';
$route['admin/pas/relatorios/(:any)'] = 'pas/relatorios/$1';
// events
$route['admin/pas/get_pas_events'] = 'pas/get_pas_events';
$route['admin/pas/get_pas_all_events'] = 'pas/get_pas_all_events';
$route['admin/pas/get_pas_event_by_id/(:any)'] = 'pas/get_pas_event_by_id/$1';
$route['admin/pas/get_pas_all_lote_events'] = 'pas/get_pas_all_lote_events';
$route['admin/pas/get_pas_planejamento_by_id/(:any)'] = 'pas/get_pas_planejamento_by_id/$1';
$route['admin/pas/get_pas_planejamento_all_lotes'] = 'pas/get_pas_planejamento_all_lotes';
$route['admin/pas/get_pas_all_lote_events_by_contrato'] = 'pas/get_pas_all_lote_events_by_contrato';
$route['admin/pas/get_pas_planejamento_all_lotes_by_contratos'] = 'pas/get_pas_planejamento_all_lotes_by_contratos';
$route['admin/pas/get_cronograma_all_lotes_by_contratos'] = 'pas/get_cronograma_all_lotes_by_contratos';



//analista events
$route['admin/pas/get_pas_all_events_analista'] = 'pas/get_pas_all_events_analista';

$route['admin/pas/get_pas_prazos_by_id_pas_id_fase'] = 'pas/get_pas_prazos_by_id_pas_id_fase';
$route['admin/pas/get_pas_prazos_by_id_pas_id_fase/(:any)'] = 'pas/get_pas_prazos_by_id_pas_id_fase/$1';
$route['admin/pas/get_cronograma_atividade/(:any)'] = 'pas/get_cronograma_atividade/$1';
$route['admin/pas/get_cronograma_atividade_planejada/(:any)'] = 'pas/get_cronograma_atividade_planejada/$1';
$route['admin/pas/get_cronograma_atividade_contratada/(:any)'] = 'pas/get_cronograma_atividade_contratada/$1';
$route['admin/pas/get_cronograma_all_lotes'] = 'pas/get_cronograma_all_lotes';
$route['admin/pas/get_cronograma_all_lotes/(:any)'] = 'pas/get_cronograma_all_lotes/$1';
$route['admin/pas/get_cronograma_produto/(:any)'] = 'pas/get_cronograma_produto/$1';
$route['admin/pas/get_cronograma_produto_id_fases/(:any)'] = 'pas/get_cronograma_produto_id_fases/$1';
$route['admin/pas/get_cronograma_all_lotes_responsavel/(:any)'] = 'pas/get_cronograma_all_lotes_responsavel/$1';

// ANALISTA AREA
//$route['admin/pas/analista'] = 'pas/analista';
//$route['admin/pas/analista/(:any)'] = 'pas/analista/$1';

$route['admin/pas/(:any)'] = 'pas/index/$1'; //$1 = page number
    

// PAS PENDENCIAS

$route['admin/pas_pendencias'] = 'pas_pendencias/index';
$route['admin/pas_pendencias/add'] = 'pas_pendencias/add';
$route['admin/pas_pendencias/add/(:any)'] = 'pas_pendencias/add/$1';
$route['admin/pas_pendencias/add_json'] = 'pas_pendencias/add_json';
$route['admin/pas_pendencias/add_json/(:any)'] = 'pas_pendencias/add_json/$1';
$route['admin/pas_pendencias/update'] = 'pas_pendencias/update';
$route['admin/pas_pendencias/update/(:any)'] = 'pas_pendencias/update/$1';
$route['admin/pas_pendencias/delete/(:any)'] = 'pas_pendencias/delete/$1';
$route['admin/pas_pendencias/(:any)'] = 'pas_pendencias/index/$1'; //$1 = page number

// PAS LOCALIZACAO

$route['admin/pas_localizacao'] = 'pas_localizacao/index';
$route['admin/pas_localizacao/add'] = 'pas_localizacao/add';
$route['admin/pas_localizacao/add/(:any)'] = 'pas_localizacao/add/$1';
$route['admin/pas_localizacao/update'] = 'pas_localizacao/update';
$route['admin/pas_localizacao/update/(:any)'] = 'pas_localizacao/update/$1';
$route['admin/pas_localizacao/delete/(:any)'] = 'pas_localizacao/delete/$1';

$route['admin/pas_localizacao/lista_localizacao/(:any)'] = 'pas_localizacao/lista_localizacao/$1';
$route['admin/pas_localizacao/(:any)'] = 'pas_localizacao/index/$1'; //$1 = page number


// PAS DOCUMENTOS

$route['admin/pas_documentos'] = 'pas_documentos/index';
$route['admin/pas_documentos/add'] = 'pas_documentos/add';
$route['admin/pas_documentos/add/(:any)'] = 'pas_documentos/add/$1';
$route['admin/pas_documentos/update'] = 'pas_documentos/update';
$route['admin/pas_documentos/update/(:any)'] = 'pas_documentos/update/$1';
$route['admin/pas_documentos/delete/(:any)'] = 'pas_documentos/delete/$1';

$route['admin/pas_documentos/lista_documento/(:any)'] = 'pas_documentos/lista_documento/$1';
$route['admin/pas_documentos/(:any)'] = 'pas_documentos/index/$1'; //$1 = page number


// PAS ACOMPANHAMENTO FISICO

$route['admin/pas_acompanhamento_fisico'] = 'pas_acompanhamento_fisico/index';
$route['admin/pas_acompanhamento_fisico/add'] = 'pas_acompanhamento_fisico/add';
$route['admin/pas_acompanhamento_fisico/add/(:any)/(:any)'] = 'pas_acompanhamento_fisico/add/$1/$2';
$route['admin/pas_acompanhamento_fisico/update'] = 'pas_acompanhamento_fisico/update';
$route['admin/pas_acompanhamento_fisico/update/(:any)'] = 'pas_acompanhamento_fisico/update/$1';
$route['admin/pas_acompanhamento_fisico/delete/(:any)'] = 'pas_acompanhamento_fisico/delete/$1';

$route['admin/pas_acompanhamento_fisico/lista_acompanhamento_fisico/(:any)'] = 'pas_acompanhamento_fisico/lista_acompanhamento_fisico/$1';
$route['admin/pas_acompanhamento_fisico/(:any)'] = 'pas_acompanhamento_fisico/index/$1'; //$1 = page number

$route['admin/pas_list_acompanhamento_fisico'] = 'pas_list_acompanhamento_fisico/index';
$route['admin/pas_list_acompanhamento_fisico/add'] = 'pas_list_acompanhamento_fisico/add';
$route['admin/pas_list_acompanhamento_fisico/add/(:any)'] = 'pas_list_acompanhamento_fisico/add/$1';
$route['admin/pas_list_acompanhamento_fisico/update'] = 'pas_list_acompanhamento_fisico/update';
$route['admin/pas_list_acompanhamento_fisico/update/(:any)'] = 'pas_list_acompanhamento_fisico/update/$1';
$route['admin/pas_list_acompanhamento_fisico/delete/(:any)'] = 'pas_list_acompanhamento_fisico/delete/$1';
$route['admin/pas_list_acompanhamento_fisico/(:any)'] = 'pas_list_acompanhamento_fisico/index/$1'; //$1 = page number


// PAS FASES DE PROJETO

$route['admin/pas_fases'] = 'pas_fases/index';
$route['admin/pas_fases/add'] = 'pas_fases/add';
$route['admin/pas_fases/add/(:any)'] = 'pas_fases/add/$1';
$route['admin/pas_fases/update'] = 'pas_fases/update';
$route['admin/pas_fases/update/(:any)'] = 'pas_fases/update/$1';
$route['admin/pas_fases/delete/(:any)'] = 'pas_fases/delete/$1';
$route['admin/pas_fases/(:any)'] = 'pas_fases/index/$1'; //$1 = page number


// PAS TRECHOS

$route['admin/pas_trechos'] = 'pas_trechos/index';
$route['admin/pas_trechos/add'] = 'pas_trechos/add';
$route['admin/pas_trechos/add/(:any)'] = 'pas_trechos/add/$1';
$route['admin/pas_trechos/update'] = 'pas_trechos/update';
$route['admin/pas_trechos/update/(:any)'] = 'pas_trechos/update/$1';
$route['admin/pas_trechos/delete/(:any)'] = 'pas_trechos/delete/$1';
$route['admin/pas_trechos/(:any)'] = 'pas_trechos/index/$1'; //$1 = page number


// AVALIAÇÕES

$route['admin/avaliacoes'] = 'avaliacoes/index';
$route['admin/avaliacoes/add'] = 'avaliacoes/add';
$route['admin/avaliacoes/add/(:any)'] = 'avaliacoes/add/$1';
$route['admin/avaliacoes/update'] = 'avaliacoes/update';
$route['admin/avaliacoes/update/(:any)'] = 'avaliacoes/update/$1';
$route['admin/avaliacoes/delete/(:any)'] = 'avaliacoes/delete/$1';
$route['admin/avaliacoes/(:any)'] = 'avaliacoes/index/$1'; //$1 = page number


// MOVIMENTACOES PAS

$route['admin/pas_fases_movimentacao'] = 'pas_fases_movimentacao/index';
$route['admin/pas_fases_movimentacao/add'] = 'pas_fases_movimentacao/add';
$route['admin/pas_fases_movimentacao/add/(:any)'] = 'pas_fases_movimentacao/add/$1';
$route['admin/pas_fases_movimentacao/update'] = 'pas_fases_movimentacao/update';
$route['admin/pas_fases_movimentacao/update/(:any)'] = 'pas_fases_movimentacao/update/$1';
$route['admin/pas_fases_movimentacao/delete/(:any)'] = 'pas_fases_movimentacao/delete/$1';
$route['admin/pas_fases_movimentacao/analista/(:any)'] = 'pas_fases_movimentacao/analista/$1';
$route['admin/pas_fases_movimentacao/contratada/(:any)'] = 'pas_fases_movimentacao/contratada/$1';
$route['admin/pas_fases_movimentacao/gerente/(:any)'] = 'pas_fases_movimentacao/gerente/$1';
$route['admin/pas_fases_movimentacao/administrador/(:any)'] = 'pas_fases_movimentacao/administrador/$1';
$route['admin/pas_fases_movimentacao/delete_file/(:any)'] = 'pas_fases_movimentacao/delete_file/$1';
$route['admin/pas_fases_movimentacao/get_movimento_detalhes/(:any)'] = 'pas_fases_movimentacao/get_movimento_detalhes/$1';

$route['admin/pas_fases_movimentacao/(:any)'] = 'pas_fases_movimentacao/index/$1'; //$1 = page number


// ATIVIDADES

$route['admin/atividades'] = 'atividades/index';
$route['admin/atividades/add'] = 'atividades/add';
$route['admin/atividades/add/(:any)'] = 'atividades/add/$1';
$route['admin/atividades/update'] = 'atividades/update';
$route['admin/atividades/update/(:any)'] = 'atividades/update/$1';
$route['admin/atividades/delete/(:any)'] = 'atividades/delete/$1';
$route['admin/atividades/(:any)'] = 'atividades/index/$1'; //$1 = page number


// PRAZOS PAS

$route['admin/pas_prazos'] = 'pas_prazos/index';
$route['admin/pas_prazos/add'] = 'pas_prazos/add';
$route['admin/pas_prazos/add/(:any)'] = 'pas_prazos/add/$1';
$route['admin/pas_prazos/update'] = 'pas_prazos/update';
$route['admin/pas_prazos/update/(:any)'] = 'pas_prazos/update/$1';
$route['admin/pas_prazos/delete/(:any)'] = 'pas_prazos/delete/$1';
$route['admin/pas_prazos/get_list_prazos_by_contrato/(:any)'] = 'pas_prazos/get_list_prazos_by_contrato/$1';

$route['admin/pas_prazos/(:any)'] = 'pas_prazos/index/$1'; //$1 = page number

// PRAZOS FASES


$route['admin/pas_prazos_fases'] = 'pas_prazos_fases/index';
$route['admin/pas_prazos_fases/add'] = 'pas_prazos_fases/add';
$route['admin/pas_prazos_fases/add/(:any)'] = 'pas_prazos_fases/add/$1';
$route['admin/pas_prazos_fases/update'] = 'pas_prazos_fases/update';
$route['admin/pas_prazos_fases/update/(:any)'] = 'pas_prazos_fases/update/$1';
$route['admin/pas_prazos_fases/delete/(:any)'] = 'pas_prazos_fases/delete/$1';
$route['admin/pas_prazos_fases/(:any)'] = 'pas_prazos_fases/index/$1'; //$1 = page number
    


// FASE DE PROJETO

$route['admin/fases'] = 'fases/index';
$route['admin/fases/add'] = 'fases/add';
$route['admin/fases/add/(:any)'] = 'fases/add/$1';
$route['admin/fases/update'] = 'fases/update';
$route['admin/fases/update/(:any)'] = 'fases/update/$1';
$route['admin/fases/delete/(:any)'] = 'fases/delete/$1';
$route['admin/fases/(:any)'] = 'fases/index/$1'; //$1 = page number

// SUBFASES

$route['admin/subfases'] = 'subfases/index';
$route['admin/subfases/add'] = 'subfases/add';
$route['admin/subfases/add/(:any)'] = 'subfases/add/$1';
$route['admin/subfases/update'] = 'subfases/update';
$route['admin/subfases/update/(:any)'] = 'subfases/update/$1';
$route['admin/subfases/delete/(:any)'] = 'subfases/delete/$1';
$route['admin/subfases/(:any)'] = 'subfases/index/$1'; //$1 = page number
    
//FINANCEIRO

$route['admin/registro_financeiro'] = 'registro_financeiro/index';
$route['admin/registro_financeiro/add'] = 'registro_financeiro/add';
$route['admin/registro_financeiro/add/(:any)'] = 'registro_financeiro/add/$1';
$route['admin/registro_financeiro/update'] = 'registro_financeiro/update';
$route['admin/registro_financeiro/update/(:any)'] = 'registro_financeiro/update/$1';
$route['admin/registro_financeiro/delete/(:any)'] = 'registro_financeiro/delete/$1';
$route['admin/registro_financeiro/(:any)'] = 'registro_financeiro/index/$1'; //$1 = page number
    
$route['admin/financeiro_fases_subfases'] = 'financeiro_fases_subfases/index';
$route['admin/financeiro_fases_subfases/add'] = 'financeiro_fases_subfases/add';
$route['admin/financeiro_fases_subfases/add/(:any)'] = 'financeiro_fases_subfases/add/$1';
$route['admin/financeiro_fases_subfases/update'] = 'financeiro_fases_subfases/update';
$route['admin/financeiro_fases_subfases/update/(:any)'] = 'financeiro_fases_subfases/update/$1';
$route['admin/financeiro_fases_subfases/delete/(:any)'] = 'financeiro_fases_subfases/delete/$1';
$route['admin/financeiro_fases_subfases/(:any)'] = 'financeiro_fases_subfases/index/$1'; //$1 = page numberF

$route['admin/financeiro_reajuste'] = 'financeiro_reajuste/index';
$route['admin/financeiro_reajuste/add'] = 'financeiro_reajuste/add';
$route['admin/financeiro_reajuste/add/(:any)'] = 'financeiro_reajuste/add/$1';
$route['admin/financeiro_reajuste/update'] = 'financeiro_reajuste/update';
$route['admin/financeiro_reajuste/update/(:any)'] = 'financeiro_reajuste/update/$1';
$route['admin/financeiro_reajuste/delete/(:any)'] = 'financeiro_reajuste/delete/$1';
$route['admin/financeiro_reajuste/(:any)'] = 'financeiro_reajuste/index/$1'; //$1 = page number

$route['admin/financeiro_medicoes'] = 'financeiro_medicoes/index';
$route['admin/financeiro_medicoes/add'] = 'financeiro_medicoes/add';
$route['admin/financeiro_medicoes/add/(:any)'] = 'financeiro_medicoes/add/$1';
$route['admin/financeiro_medicoes/update'] = 'financeiro_medicoes/update';
$route['admin/financeiro_medicoes/update/(:any)'] = 'financeiro_medicoes/update/$1';
$route['admin/financeiro_medicoes/delete/(:any)'] = 'financeiro_medicoes/delete/$1';
$route['admin/financeiro_medicoes/(:any)'] = 'financeiro_medicoes/index/$1'; //$1 = page number

$route['admin/pas_financeiro_subfases'] = 'pas_financeiro_subfases/index';
$route['admin/pas_financeiro_subfases/add'] = 'pas_financeiro_subfases/add';
$route['admin/pas_financeiro_subfases/add/(:any)'] = 'pas_financeiro_subfases/add/$1';
$route['admin/pas_financeiro_subfases/update'] = 'pas_financeiro_subfases/update';
$route['admin/pas_financeiro_subfases/update/(:any)'] = 'pas_financeiro_subfases/update/$1';
$route['admin/pas_financeiro_subfases/delete/(:any)'] = 'pas_financeiro_subfases/delete/$1';
$route['admin/pas_financeiro_subfases/(:any)'] = 'pas_financeiro_subfases/index/$1'; //$1 = page number


$route['admin/medicoes_pas_fases'] = 'medicoes_pas_fases/index';
$route['admin/medicoes_pas_fases/add'] = 'medicoes_pas_fases/add';
$route['admin/medicoes_pas_fases/add/(:any)'] = 'medicoes_pas_fases/add/$1';
$route['admin/medicoes_pas_fases/update'] = 'medicoes_pas_fases/update';
$route['admin/medicoes_pas_fases/update/(:any)'] = 'medicoes_pas_fases/update/$1';
$route['admin/medicoes_pas_fases/delete/(:any)'] = 'medicoes_pas_fases/delete/$1';
$route['admin/medicoes_pas_fases/(:any)'] = 'medicoes_pas_fases/index/$1'; //$1 = page number

// PRIORIDADES

$route['admin/prioridades'] = 'prioridades/index';
$route['admin/prioridades/add'] = 'prioridades/add';
$route['admin/prioridades/add/(:any)'] = 'prioridades/add/$1';
$route['admin/prioridades/update'] = 'prioridades/update';
$route['admin/prioridades/update/(:any)'] = 'prioridades/update/$1';
$route['admin/prioridades/delete/(:any)'] = 'prioridades/delete/$1';
$route['admin/prioridades/(:any)'] = 'prioridades/index/$1'; //$1 = page number
    
// LOCAL DE EXECUÇÃO

$route['admin/local_execucao'] = 'local_execucao/index';
$route['admin/local_execucao/add'] = 'local_execucao/add';
$route['admin/local_execucao/add/(:any)'] = 'local_execucao/add/$1';
$route['admin/local_execucao/update'] = 'local_execucao/update';
$route['admin/local_execucao/update/(:any)'] = 'local_execucao/update/$1';
$route['admin/local_execucao/delete/(:any)'] = 'local_execucao/delete/$1';

$route['admin/local_execucao/(:any)'] = 'local_execucao/index/$1'; //$1 = page number


// CRONOGRAMA GERAL

$route['admin/cronograma_geral'] = 'cronograma_geral/index';
$route['admin/cronograma_geral/add'] = 'cronograma_geral/add';
$route['admin/cronograma_geral/add/(:any)'] = 'cronograma_geral/add/$1';
$route['admin/cronograma_geral/update'] = 'cronograma_geral/update';
$route['admin/cronograma_geral/update/(:any)'] = 'cronograma_geral/update/$1';
$route['admin/cronograma_geral/delete/(:any)'] = 'cronograma_geral/delete/$1';
$route['admin/cronograma_geral/allCronogramas'] = 'cronograma_geral/allCronogramas';
$route['admin/cronograma_geral/dashboard'] = 'cronograma_geral/dashboard';
$route['admin/cronograma_geral/(:any)'] = 'cronograma_geral/index/$1'; //$1 = page number


// INVENTARIO DE DADOS

$route['admin/inventario_dados_tecnicos'] = 'inventario_dados_tecnicos';

$route['admin/inventario'] = 'inventario/index';
$route['admin/inventario/add'] = 'inventario/add';
$route['admin/inventario/add/(:any)'] = 'inventario/add/$1';
$route['admin/inventario/update'] = 'inventario/update';
$route['admin/inventario/update/(:any)'] = 'inventario/update/$1';
$route['admin/inventario/delete/(:any)'] = 'inventario/delete/$1';
$route['admin/inventario/unifilar'] = 'inventario/unifilar';
$route['admin/inventario/clustergram'] = 'inventario/clustergram';
$route['admin/inventario/lego'] = 'inventario/lego';
$route['admin/inventario/(:any)'] = 'inventario/index/$1'; //$1 = page number
    

$route['admin/configuracao_geral'] = 'configuracao_geral';

/*
 		551
 */

$route['admin/gestao_551'] = 'gestao_551';

// CONFIGURAÇÕES GERAIS

$route['admin/estados'] = 'estados/index';
$route['admin/estados/add'] = 'estados/add';
$route['admin/estados/add/(:any)'] = 'estados/add/$1';
$route['admin/estados/update'] = 'estados/update';
$route['admin/estados/update/(:any)'] = 'estados/update/$1';
$route['admin/estados/delete/(:any)'] = 'estados/delete/$1';
$route['admin/estados/(:any)'] = 'estados/index/$1'; //$1 = page number
    
// CHECKLIST
$route['admin/checklist'] = 'checklist/index';
$route['admin/checklist/add'] = 'checklist/add';
$route['admin/checklist/add/(:any)'] = 'checklist/add/$1';
$route['admin/checklist/update'] = 'checklist/update';
$route['admin/checklist/update/(:any)'] = 'checklist/update/$1';
$route['admin/checklist/delete/(:any)'] = 'checklist/delete/$1';
$route['admin/checklist/(:any)'] = 'checklist/index/$1'; //$1 = page number
    

$route['admin/fases_checklist'] = 'fases_checklist/index';
$route['admin/fases_checklist/add'] = 'fases_checklist/add';
$route['admin/fases_checklist/add/(:any)'] = 'fases_checklist/add/$1';
$route['admin/fases_checklist/update'] = 'fases_checklist/update';
$route['admin/fases_checklist/update/(:any)'] = 'fases_checklist/update/$1';
$route['admin/fases_checklist/delete/(:any)'] = 'fases_checklist/delete/$1';
$route['admin/fases_checklist/(:any)'] = 'fases_checklist/index/$1'; //$1 = page number
    

// STATUS

$route['admin/status'] = 'status/index';
$route['admin/status/add'] = 'status/add';
$route['admin/status/add/(:any)'] = 'status/add/$1';
$route['admin/status/update'] = 'status/update';
$route['admin/status/update/(:any)'] = 'status/update/$1';
$route['admin/status/delete/(:any)'] = 'status/delete/$1';
$route['admin/status/(:any)'] = 'status/index/$1'; //$1 = page number

$route['admin/status_status'] = 'status_status/index';
$route['admin/status_status/add'] = 'status_status/add';
$route['admin/status_status/add/(:any)'] = 'status_status/add/$1';
$route['admin/status_status/update'] = 'status_status/update';
$route['admin/status_status/update/(:any)'] = 'status_status/update/$1';
$route['admin/status_status/delete/(:any)'] = 'status_status/delete/$1';
$route['admin/status_status/(:any)'] = 'status_status/index/$1'; //$1 = page number
    
$route['admin/status_perfil'] = 'status_perfil/index';
$route['admin/status_perfil/add'] = 'status_perfil/add';
$route['admin/status_perfil/add/(:any)'] = 'status_perfil/add/$1';
$route['admin/status_perfil/update'] = 'status_perfil/update';
$route['admin/status_perfil/update/(:any)'] = 'status_perfil/update/$1';
$route['admin/status_perfil/delete/(:any)'] = 'status_perfil/delete/$1';
$route['admin/status_perfil/(:any)'] = 'status_perfil/index/$1'; //$1 = page number
        

// REPOSITORIO DE DOCUMENTOS

$route['admin/documentos_repositorio'] = 'documentos_repositorio/index';
$route['admin/documentos_repositorio/add'] = 'documentos_repositorio/add';
$route['admin/documentos_repositorio/add/(:any)'] = 'documentos_repositorio/add/$1';
$route['admin/documentos_repositorio/update'] = 'documentos_repositorio/update';
$route['admin/documentos_repositorio/update/(:any)'] = 'documentos_repositorio/update/$1';
$route['admin/documentos_repositorio/delete/(:any)'] = 'documentos_repositorio/delete/$1';
$route['admin/documentos_repositorio/(:any)'] = 'documentos_repositorio/index/$1'; //$1 = page number	

// tipos de documentos

$route['admin/documentos_tipos'] = 'documentos_tipos/index';
$route['admin/documentos_tipos/add'] = 'documentos_tipos/add';
$route['admin/documentos_tipos/add/(:any)'] = 'documentos_tipos/add/$1';
$route['admin/documentos_tipos/update'] = 'documentos_tipos/update';
$route['admin/documentos_tipos/update/(:any)'] = 'documentos_tipos/update/$1';
$route['admin/documentos_tipos/delete/(:any)'] = 'documentos_tipos/delete/$1';
$route['admin/documentos_tipos/lista_tipos/(:any)'] = 'documentos_tipos/lista_tipos/$1';
$route['admin/documentos_tipos/(:any)'] = 'documentos_tipos/index/$1'; //$1 = page number

// DOCUMENTOS ATIVIDADES

$route['admin/documentos_atividades'] = 'documentos_atividades/index';
$route['admin/documentos_atividades/add'] = 'documentos_atividades/add';
$route['admin/documentos_atividades/add/(:any)'] = 'documentos_atividades/add/$1';
$route['admin/documentos_atividades/update'] = 'documentos_atividades/update';
$route['admin/documentos_atividades/update/(:any)'] = 'documentos_atividades/update/$1';
$route['admin/documentos_atividades/delete/(:any)'] = 'documentos_atividades/delete/$1';
$route['admin/documentos_atividades/(:any)'] = 'documentos_atividades/index/$1'; //$1 = page number

// DOCUMENTOS PALAVRAS CHAVE

$route['admin/documentos_palavra_chave'] = 'documentos_palavra_chave/index';
$route['admin/documentos_palavra_chave/add'] = 'documentos_palavra_chave/add';
$route['admin/documentos_palavra_chave/add/(:any)'] = 'documentos_palavra_chave/add/$1';
$route['admin/documentos_palavra_chave/update'] = 'documentos_palavra_chave/update';
$route['admin/documentos_palavra_chave/update/(:any)'] = 'documentos_palavra_chave/update/$1';
$route['admin/documentos_palavra_chave/delete/(:any)'] = 'documentos_palavra_chave/delete/$1';
$route['admin/documentos_palavra_chave/(:any)'] = 'documentos_palavra_chave/index/$1'; //$1 = page number

// DOCUMENTOS ORIGEM DESTINO

$route['admin/documentos_od'] = 'documentos_od/index';
$route['admin/documentos_od/add'] = 'documentos_od/add';
$route['admin/documentos_od/add/(:any)'] = 'documentos_od/add/$1';
$route['admin/documentos_od/update'] = 'documentos_od/update';
$route['admin/documentos_od/update/(:any)'] = 'documentos_od/update/$1';
$route['admin/documentos_od/delete/(:any)'] = 'documentos_od/delete/$1';
$route['admin/documentos_od/(:any)'] = 'documentos_od/index/$1'; //$1 = page number


// IRI     				
$route['admin/iri'] = 'iri/index';
$route['admin/iri/add'] = 'iri/add';
$route['admin/iri/add/(:any)'] = 'iri/add/$1';
$route['admin/iri/update'] = 'iri/update';
$route['admin/iri/update/(:any)'] = 'iri/update/$1';
$route['admin/iri/delete/(:any)'] = 'iri/delete/$1';
$route['admin/iri/(:any)'] = 'iri/index/$1'; //$1 = page number

/*
$route['admin/veiculos'] = 'veiculos/index';
$route['admin/veiculos/add'] = 'veiculos/add';
$route['admin/veiculos/update'] = 'veiculos/update';
$route['admin/veiculos/update/(:any)'] = 'veiculos/update/$1';
$route['admin/veiculos/delete/(:any)'] = 'veiculos/delete/$1';
$route['admin/veiculos/(:any)'] = 'veiculos/index/$1'; //$1 = page number
    
$route['admin/classeveiculos'] = 'classeveiculos/index';
$route['admin/classeveiculos/add'] = 'classeveiculos/add';
$route['admin/classeveiculos/update'] = 'classeveiculos/update';
$route['admin/classeveiculos/update/(:any)'] = 'classeveiculos/update/$1';
$route['admin/classeveiculos/delete/(:any)'] = 'classeveiculos/delete/$1';
$route['admin/classeveiculos/(:any)'] = 'classeveiculos/index/$1'; //$1 = page number

$route['admin/veiculo_classeveiculo'] = 'veiculo_classeveiculo/index';
$route['admin/veiculo_classeveiculo/add'] = 'veiculo_classeveiculo/add';
$route['admin/veiculo_classeveiculo/update'] = 'veiculo_classeveiculo/update';
$route['admin/veiculo_classeveiculo/update/(:any)'] = 'veiculo_classeveiculo/update/$1';
$route['admin/veiculo_classeveiculo/delete/(:any)'] = 'veiculo_classeveiculo/delete/$1';
$route['admin/veiculo_classeveiculo/(:any)'] = 'veiculo_classeveiculo/index/$1'; //$1 = page number

$route['admin/pesquisa_trafegos'] = 'pesquisa_trafegos/index';
$route['admin/pesquisa_trafegos/add'] = 'pesquisa_trafegos/add';
$route['admin/pesquisa_trafegos/update'] = 'pesquisa_trafegos/update';
$route['admin/pesquisa_trafegos/update/(:any)'] = 'pesquisa_trafegos/update/$1';
$route['admin/pesquisa_trafegos/delete/(:any)'] = 'pesquisa_trafegos/delete/$1';
$route['admin/pesquisa_trafegos/contagens_list/(:any)'] = 'pesquisa_trafegos/contagens_list/$1';
$route['admin/pesquisa_trafegos/contagem_add/(:any)'] = 'pesquisa_trafegos/contagem_add/$1';
$route['admin/pesquisa_trafegos/contagem_update'] = 'pesquisa_trafegos/contagem_update';
$route['admin/pesquisa_trafegos/contagem_update/(:any)'] = 'pesquisa_trafegos/contagem_update/$1';
$route['admin/pesquisa_trafegos/contagem_update/(:any)/(:any)'] = 'pesquisa_trafegos/contagem_update/$1/$2';
$route['admin/pesquisa_trafegos/origens_destinos_list/(:any)'] = 'pesquisa_trafegos/origens_destinos_list/$1';
$route['admin/pesquisa_trafegos/origens_destinos_add/(:any)'] = 'pesquisa_trafegos/origens_destinos_add/$1';
$route['admin/pesquisa_trafegos/origens_destinos_update'] = 'pesquisa_trafegos/origens_destinos_update';
$route['admin/pesquisa_trafegos/origens_destinos_update/(:any)'] = 'pesquisa_trafegos/origens_destinos_update/$1';
$route['admin/pesquisa_trafegos/origens_destinos_update/(:any)/(:any)'] = 'pesquisa_trafegos/origens_destinos_update/$1/$2';
$route['admin/pesquisa_trafegos/(:any)'] = 'pesquisa_trafegos/index/$1'; //$1 = page number

$route['admin/sentidos'] = 'sentidos/index';
$route['admin/sentidos/add'] = 'sentidos/add';
$route['admin/sentidos/update'] = 'sentidos/update';
$route['admin/sentidos/update/(:any)'] = 'sentidos/update/$1';
$route['admin/sentidos/delete/(:any)'] = 'sentidos/delete/$1';
$route['admin/sentidos/pop_sentido'] = 'sentidos/pop_sentido';
$route['admin/sentidos/pop_sentido/(:any)'] = 'sentidos/pop_sentido/$1';
$route['admin/sentidos/pop_add/(:any)'] = 'sentidos/pop_add/$1';
$route['admin/sentidos/pop_update'] = 'sentidos/pop_update';
$route['admin/sentidos/pop_update/(:any)/(:any)'] = 'sentidos/pop_update/$1/$2';
$route['admin/sentidos/pop_delete/(:any)/(:any)'] = 'sentidos/pop_delete/$1/$2';
$route['admin/sentidos/(:any)'] = 'sentidos/index/$1'; //$1 = page number
    
$route['admin/contagens'] = 'contagens/index';
$route['admin/contagens/add'] = 'contagens/add';
$route['admin/contagens/update'] = 'contagens/update';
$route['admin/contagens/update/(:any)'] = 'contagens/update/$1';
$route['admin/contagens/delete/(:any)'] = 'contagens/delete/$1';
$route['admin/contagens/(:any)'] = 'contagens/index/$1'; //$1 = page number
    
$route['admin/consulta_contagens'] = 'consulta_contagens/index';
$route['admin/consulta_contagens/add'] = 'consulta_contagens/add';
$route['admin/consulta_contagens/update'] = 'consulta_contagens/update';
$route['admin/consulta_contagens/update/(:any)'] = 'consulta_contagens/update/$1';
$route['admin/consulta_contagens/delete/(:any)'] = 'consulta_contagens/delete/$1';
$route['admin/consulta_contagens/resultado/(:any)'] = 'consulta_contagens/resultado/$1';
$route['admin/consulta_contagens/resultado_od/(:any)'] = 'consulta_contagens/resultado_od/$1';
$route['admin/consulta_contagens/(:any)'] = 'consulta_contagens/index/$1'; //$1 = page number

$route['admin/origens_destinos'] = 'origens_destinos/index';
$route['admin/origens_destinos/add'] = 'origens_destinos/add';
$route['admin/origens_destinos/update'] = 'origens_destinos/update';
$route['admin/origens_destinos/update/(:any)'] = 'origens_destinos/update/$1';
$route['admin/origens_destinos/delete/(:any)'] = 'origens_destinos/delete/$1';
$route['admin/origens_destinos/(:any)'] = 'origens_destinos/index/$1'; //$1 = page number


// sondagens start
$route['admin/sondagens'] = 'sondagens/index';
$route['admin/sondagens/add'] = 'sondagens/add';
$route['admin/sondagens/update'] = 'sondagens/update';
$route['admin/sondagens/update/(:any)'] = 'sondagens/update/$1';
$route['admin/sondagens/delete/(:any)'] = 'sondagens/delete/$1';
$route['admin/sondagens/(:any)'] = 'sondagens/index/$1'; //$1 = page number

$route['admin/resumo_sondagens'] = 'resumo_sondagens/index';
$route['admin/resumo_sondagens/add'] = 'resumo_sondagens/add';
$route['admin/resumo_sondagens/add/(:any)'] = 'resumo_sondagens/add/$1';
$route['admin/resumo_sondagens/update'] = 'resumo_sondagens/update';
$route['admin/resumo_sondagens/update/(:any)'] = 'resumo_sondagens/update/$1';
$route['admin/resumo_sondagens/delete/(:any)'] = 'resumo_sondagens/delete/$1';
$route['admin/resumo_sondagens/sondagem/(:any)'] = 'resumo_sondagens/sondagem/$1';
$route['admin/resumo_sondagens/resumo/(:any)'] = 'resumo_sondagens/resumo/$1';
$route['admin/resumo_sondagens/(:any)'] = 'resumo_sondagens/index/$1'; //$1 = page number

$route['admin/tipo_sondagens'] = 'tipo_sondagens/index';
$route['admin/tipo_sondagens/add'] = 'tipo_sondagens/add';
$route['admin/tipo_sondagens/update'] = 'tipo_sondagens/update';
$route['admin/tipo_sondagens/update/(:any)'] = 'tipo_sondagens/update/$1';
$route['admin/tipo_sondagens/delete/(:any)'] = 'tipo_sondagens/delete/$1';
$route['admin/tipo_sondagens/(:any)'] = 'tipo_sondagens/index/$1'; //$1 = page number

$route['admin/consulta_sondagens'] = 'consulta_sondagens/index';
$route['admin/consulta_sondagens/add'] = 'consulta_sondagens/add';
$route['admin/consulta_sondagens/update'] = 'consulta_sondagens/update';
$route['admin/consulta_sondagens/update/(:any)'] = 'consulta_sondagens/update/$1';
$route['admin/consulta_sondagens/delete/(:any)'] = 'consulta_sondagens/delete/$1';
$route['admin/consulta_sondagens/delete/(:any)/(:any)'] = 'consulta_sondagens/delete/$1/$2';
$route['admin/consulta_sondagens/resultado/(:any)'] = 'consulta_sondagens/resultado/$1';
$route['admin/consulta_sondagens/resultado/(:any)/(:any)'] = 'consulta_sondagens/resultado/$1/$2';
$route['admin/consulta_sondagens/resultado_od/(:any)'] = 'consulta_sondagens/resultado_od/$1';
$route['admin/consulta_sondagens/(:any)'] = 'consulta_sondagens/index/$1'; //$1 = page number

$route['admin/sondagem_files'] = 'sondagem_files/index';
$route['admin/sondagem_files/add'] = 'sondagem_files/add';
$route['admin/sondagem_files/add/(:any)'] = 'sondagem_files/add/$1';
$route['admin/sondagem_files/update'] = 'sondagem_files/update';
$route['admin/sondagem_files/update/(:any)'] = 'sondagem_files/update/$1';
$route['admin/sondagem_files/delete/(:any)'] = 'sondagem_files/delete/$1';
$route['admin/sondagem_files/sondagem/(:any)'] = 'sondagem_files/sondagem/$1';
$route['admin/sondagem_files/(:any)'] = 'sondagem_files/index/$1'; //$1 = page number
    
$route['admin/tipo_ensaios'] = 'tipo_ensaios/index';
$route['admin/tipo_ensaios/add'] = 'tipo_ensaios/add';
$route['admin/tipo_ensaios/update'] = 'tipo_ensaios/update';
$route['admin/tipo_ensaios/update/(:any)'] = 'tipo_ensaios/update/$1';
$route['admin/tipo_ensaios/delete/(:any)'] = 'tipo_ensaios/delete/$1';
$route['admin/tipo_ensaios/(:any)'] = 'tipo_ensaios/index/$1'; //$1 = page number

$route['admin/resumo_sondagem_files'] = 'resumo_sondagem_files/index';
$route['admin/resumo_sondagem_files/add'] = 'resumo_sondagem_files/add';
$route['admin/resumo_sondagem_files/add/(:any)'] = 'resumo_sondagem_files/add/$1';
$route['admin/resumo_sondagem_files/update'] = 'resumo_sondagem_files/update';
$route['admin/resumo_sondagem_files/update/(:any)'] = 'resumo_sondagem_files/update/$1';
$route['admin/resumo_sondagem_files/delete/(:any)'] = 'resumo_sondagem_files/delete/$1';
$route['admin/resumo_sondagem_files/resumo/(:any)'] = 'resumo_sondagem_files/resumo/$1';
$route['admin/resumo_sondagem_files/(:any)'] = 'resumo_sondagem_files/index/$1'; //$1 = page number
    

$route['admin/perguntas'] = 'perguntas/index';
$route['admin/perguntas/add'] = 'perguntas/add';
$route['admin/perguntas/update'] = 'perguntas/update';
$route['admin/perguntas/update/(:any)'] = 'perguntas/update/$1';
$route['admin/perguntas/delete/(:any)'] = 'perguntas/delete/$1';
$route['admin/perguntas/(:any)'] = 'perguntas/index/$1'; //$1 = page number
    
$route['admin/od_perguntas'] = 'od_perguntas/index';
$route['admin/od_perguntas/add'] = 'od_perguntas/add';
$route['admin/od_perguntas/update'] = 'od_perguntas/update';
$route['admin/od_perguntas/update/(:any)'] = 'od_perguntas/update/$1';
$route['admin/od_perguntas/delete/(:any)'] = 'od_perguntas/delete/$1';
$route['admin/od_perguntas/(:any)'] = 'od_perguntas/index/$1'; //$1 = page number

$route['admin/od_entrevistas'] = 'od_entrevistas/index';
$route['admin/od_entrevistas/add'] = 'od_entrevistas/add';
$route['admin/od_entrevistas/update'] = 'od_entrevistas/update';
$route['admin/od_entrevistas/update/(:any)'] = 'od_entrevistas/update/$1';
$route['admin/od_entrevistas/delete/(:any)'] = 'od_entrevistas/delete/$1';
$route['admin/od_entrevistas/(:any)'] = 'od_entrevistas/index/$1'; //$1 = page number

$route['admin/entrevistas'] = 'entrevistas/index';
$route['admin/entrevistas/add'] = 'entrevistas/add';
$route['admin/entrevistas/update'] = 'entrevistas/update';
$route['admin/entrevistas/update/(:any)'] = 'entrevistas/update/$1';
$route['admin/entrevistas/delete/(:any)'] = 'entrevistas/delete/$1';
$route['admin/entrevistas/(:any)'] = 'entrevistas/index/$1'; //$1 = page number
    
$route['admin/entrevista_perguntas'] = 'entrevista_perguntas/index';
$route['admin/entrevista_perguntas/add'] = 'entrevista_perguntas/add';
$route['admin/entrevista_perguntas/update'] = 'entrevista_perguntas/update';
$route['admin/entrevista_perguntas/update/(:any)'] = 'entrevista_perguntas/update/$1';
$route['admin/entrevista_perguntas/delete/(:any)'] = 'entrevista_perguntas/delete/$1';
$route['admin/entrevista_perguntas/(:any)'] = 'entrevista_perguntas/index/$1'; //$1 = page number




$route['admin/acidentes'] = 'acidentes/index';
$route['admin/acidentes/add'] = 'acidentes/add';
$route['admin/acidentes/update'] = 'acidentes/update';
$route['admin/acidentes/update/(:any)'] = 'acidentes/update/$1';
$route['admin/acidentes/delete/(:any)'] = 'acidentes/delete/$1';
$route['admin/acidentes/(:any)'] = 'acidentes/index/$1'; //$1 = page number

$route['admin/classe_obras'] = 'classe_obras/index';
$route['admin/classe_obras/add'] = 'classe_obras/add';
$route['admin/classe_obras/update'] = 'classe_obras/update';
$route['admin/classe_obras/update/(:any)'] = 'classe_obras/update/$1';
$route['admin/classe_obras/delete/(:any)'] = 'classe_obras/delete/$1';
$route['admin/classe_obras/(:any)'] = 'classe_obras/index/$1'; //$1 = page number

$route['admin/tipo_obras'] = 'tipo_obras/index';
$route['admin/tipo_obras/add'] = 'tipo_obras/add';
$route['admin/tipo_obras/update'] = 'tipo_obras/update';
$route['admin/tipo_obras/update/(:any)'] = 'tipo_obras/update/$1';
$route['admin/tipo_obras/delete/(:any)'] = 'tipo_obras/delete/$1';
$route['admin/tipo_obras/(:any)'] = 'tipo_obras/index/$1'; //$1 = page number

$route['admin/obras'] = 'obras/index';
$route['admin/obras/add'] = 'obras/add';
$route['admin/obras/update'] = 'obras/update';
$route['admin/obras/update/(:any)'] = 'obras/update/$1';
$route['admin/obras/add_obra_futura'] = 'obras/add_obra_futura';
$route['admin/obras/delete/(:any)'] = 'obras/delete/$1';
$route['admin/obras/update_obra_futura'] = 'obras/update_obra_futura';
$route['admin/obras/update_obra_futura/(:any)'] = 'obras/update_obra_futura/$1';
$route['admin/obras/delete_obra_futura/(:any)'] = 'obras/delete_obra_futura/$1';
$route['admin/obras/obras_acidente'] = 'obras/obras_acidente';
$route['admin/obras/obras_tipo'] = 'obras/obras_tipo';
$route['admin/obras/obras_tipo_acidente'] = 'obras/obras_tipo_acidente';
$route['admin/obras/obras_futuras'] = 'obras/obras_futuras';
$route['admin/obras/obras_futuras/(:any)'] = 'obras/obras_futuras/$1';
$route['admin/obras/obras_futuras_analise'] = 'obras/obras_futuras_analise';
$route['admin/obras/obras_futuras_analise(:any)'] = 'obras/obras_futuras_analise/$1';
$route['admin/obras/obras_futuras_tipo_acidente'] = 'obras/obras_futuras_tipo_acidente';
$route['admin/obras/acidentes/(:any)'] = 'obras/acidentes/$1';
$route['admin/obras/(:any)'] = 'obras/index/$1'; //$1 = page number

$route['admin/upload_acidentes'] = 'upload_acidentes/index';
$route['admin/upload_acidentes/add'] = 'upload_acidentes/add';
$route['admin/upload_acidentes/update'] = 'upload_acidentes/update';
$route['admin/upload_acidentes/update/(:any)'] = 'upload_acidentes/update/$1';
$route['admin/upload_acidentes/delete/(:any)'] = 'upload_acidentes/delete/$1';
$route['admin/upload_acidentes/completo2004'] = 'upload_acidentes/completo2004';
$route['admin/upload_acidentes/completo2005'] = 'upload_acidentes/completo2005';
$route['admin/upload_acidentes/completo2006'] = 'upload_acidentes/completo2006';
$route['admin/upload_acidentes/insert_all_data'] = 'upload_acidentes/insert_all_data';
$route['admin/upload_acidentes/(:any)'] = 'upload_acidentes/index/$1'; //$1 = page number

$route['admin/upload_tipos_obras'] = 'upload_tipos_obras/index';
$route['admin/upload_tipos_obras/add'] = 'upload_tipos_obras/add';
$route['admin/upload_tipos_obras/update'] = 'upload_tipos_obras/update';
$route['admin/upload_tipos_obras/update/(:any)'] = 'upload_tipos_obras/update/$1';
$route['admin/upload_tipos_obras/delete/(:any)'] = 'upload_tipos_obras/delete/$1';
$route['admin/upload_tipos_obras/(:any)'] = 'upload_tipos_obras/index/$1'; //$1 = page number
    



$route['admin/visualizatabelas'] = 'visualizatabelas/index';
$route['admin/visualizatabelas/visualiza/(:any)/(:any)'] = 'visualizatabelas/visualiza/$1/$2';
$route['admin/visualizatabelas/(:any)'] = 'visualizatabelas/index/$1'; //$1 = page number


$route['admin/ciclos'] = 'ciclos/index';
$route['admin/ciclos/add'] = 'ciclos/add';
$route['admin/ciclos/update'] = 'ciclos/update';
$route['admin/ciclos/update/(:any)'] = 'ciclos/update/$1';
$route['admin/ciclos/delete/(:any)'] = 'ciclos/delete/$1';
$route['admin/ciclos/(:any)'] = 'ciclos/index/$1'; //$1 = page number

$route['admin/trechos'] = 'trechos/index';
$route['admin/trechos/add'] = 'trechos/add';
$route['admin/trechos/update'] = 'trechos/update';
$route['admin/trechos/update/(:any)'] = 'trechos/update/$1';
$route['admin/trechos/delete/(:any)'] = 'trechos/delete/$1';
$route['admin/trechos/(:any)'] = 'trechos/index/$1'; //$1 = page number

$route['admin/inclinacao_pista'] = 'inclinacao_pista/index';
$route['admin/inclinacao_pista/add'] = 'inclinacao_pista/add';
$route['admin/inclinacao_pista/update'] = 'inclinacao_pista/update';
$route['admin/inclinacao_pista/update/(:any)'] = 'inclinacao_pista/update/$1';
$route['admin/inclinacao_pista/delete/(:any)'] = 'inclinacao_pista/delete/$1';
$route['admin/inclinacao_pista/get_ciclo_uf/(:any)'] = 'inclinacao_pista/get_ciclo_uf/$1';
$route['admin/inclinacao_pista/(:any)'] = 'inclinacao_pista/index/$1'; //$1 = page number
    
$route['admin/logs'] = 'logs/index';
$route['admin/logs/add'] = 'logs/add';
$route['admin/logs/update'] = 'logs/update';
$route['admin/logs/update/(:any)'] = 'logs/update/$1';
$route['admin/logs/delete/(:any)'] = 'logs/delete/$1';
$route['admin/logs/(:any)'] = 'logs/index/$1'; //$1 = page number

$route['admin/inclinacao_logs'] = 'inclinacao_logs/index';
$route['admin/inclinacao_logs/add'] = 'inclinacao_logs/add';
$route['admin/inclinacao_logs/update'] = 'inclinacao_logs/update';
$route['admin/inclinacao_logs/update/(:any)'] = 'inclinacao_logs/update/$1';
$route['admin/inclinacao_logs/delete/(:any)'] = 'inclinacao_logs/delete/$1';
$route['admin/inclinacao_logs/(:any)'] = 'inclinacao_logs/index/$1'; //$1 = page number

$route['admin/gps_logs'] = 'gps_logs/index';
$route['admin/gps_logs/add'] = 'gps_logs/add';
$route['admin/gps_logs/update'] = 'gps_logs/update';
$route['admin/gps_logs/update/(:any)'] = 'gps_logs/update/$1';
$route['admin/gps_logs/delete/(:any)'] = 'gps_logs/delete/$1';
$route['admin/gps_logs/(:any)'] = 'gps_logs/index/$1'; //$1 = page number

$route['admin/detalhe_ocorrencias'] = 'detalhe_ocorrencias/index';
$route['admin/detalhe_ocorrencias/add'] = 'detalhe_ocorrencias/add';
$route['admin/detalhe_ocorrencias/update'] = 'detalhe_ocorrencias/update';
$route['admin/detalhe_ocorrencias/update/(:any)'] = 'detalhe_ocorrencias/update/$1';
$route['admin/detalhe_ocorrencias/delete/(:any)'] = 'detalhe_ocorrencias/delete/$1';
$route['admin/detalhe_ocorrencias/(:any)'] = 'detalhe_ocorrencias/index/$1'; //$1 = page number

$route['admin/grupos'] = 'grupos/index';
$route['admin/grupos/add'] = 'grupos/add';
$route['admin/grupos/update'] = 'grupos/update';
$route['admin/grupos/update/(:any)'] = 'grupos/update/$1';
$route['admin/grupos/delete/(:any)'] = 'grupos/delete/$1';
$route['admin/grupos/(:any)'] = 'grupos/index/$1'; //$1 = page number

$route['admin/ocorrencia_logs'] = 'ocorrencia_logs/index';
$route['admin/ocorrencia_logs/add'] = 'ocorrencia_logs/add';
$route['admin/ocorrencia_logs/update'] = 'ocorrencia_logs/update';
$route['admin/ocorrencia_logs/update/(:any)'] = 'ocorrencia_logs/update/$1';
$route['admin/ocorrencia_logs/delete/(:any)'] = 'ocorrencia_logs/delete/$1';
$route['admin/ocorrencia_logs/(:any)'] = 'ocorrencia_logs/index/$1'; //$1 = page number

$route['admin/tipo_ocorrencias'] = 'tipo_ocorrencias/index';
$route['admin/tipo_ocorrencias/add'] = 'tipo_ocorrencias/add';
$route['admin/tipo_ocorrencias/update'] = 'tipo_ocorrencias/update';
$route['admin/tipo_ocorrencias/update/(:any)'] = 'tipo_ocorrencias/update/$1';
$route['admin/tipo_ocorrencias/delete/(:any)'] = 'tipo_ocorrencias/delete/$1';
$route['admin/tipo_ocorrencias/(:any)'] = 'tipo_ocorrencias/index/$1'; //$1 = page number

$route['admin/consulta_trecho_acidentes'] = 'consulta_trecho_acidentes/index';
$route['admin/consulta_trecho_acidentes/add'] = 'consulta_trecho_acidentes/add';
$route['admin/consulta_trecho_acidentes/update'] = 'consulta_trecho_acidentes/update';
$route['admin/consulta_trecho_acidentes/update/(:any)'] = 'consulta_trecho_acidentes/update/$1';
$route['admin/consulta_trecho_acidentes/delete/(:any)'] = 'consulta_trecho_acidentes/delete/$1';
$route['admin/consulta_trecho_acidentes/exclusivo'] = 'consulta_trecho_acidentes/exclusivo';
$route['admin/consulta_trecho_acidentes/(:any)'] = 'consulta_trecho_acidentes/index/$1'; //$1 = page number
    
$route['admin/custos'] = 'custos/index';
$route['admin/custos/add'] = 'custos/add';
$route['admin/custos/update'] = 'custos/update';
$route['admin/custos/update/(:any)'] = 'custos/update/$1';
$route['admin/custos/delete/(:any)'] = 'custos/delete/$1';
$route['admin/custos/(:any)'] = 'custos/index/$1'; //$1 = page number
*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */
