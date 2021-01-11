
    				$route['admin/mapeamento'] = 'mapeamento/index';
				$route['admin/mapeamento/add'] = 'mapeamento/add';
				$route['admin/mapeamento/add/(:any)'] = 'mapeamento/add/$1';
				$route['admin/mapeamento/update'] = 'mapeamento/update';
				$route['admin/mapeamento/update/(:any)'] = 'mapeamento/update/$1';
				$route['admin/mapeamento/delete/(:any)'] = 'mapeamento/delete/$1';
				$route['admin/mapeamento/(:any)'] = 'mapeamento/index/$1'; //$1 = page number
    			