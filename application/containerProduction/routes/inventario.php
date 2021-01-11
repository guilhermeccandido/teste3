
    				$route['admin/inventario'] = 'inventario/index';
				$route['admin/inventario/add'] = 'inventario/add';
				$route['admin/inventario/add/(:any)'] = 'inventario/add/$1';
				$route['admin/inventario/update'] = 'inventario/update';
				$route['admin/inventario/update/(:any)'] = 'inventario/update/$1';
				$route['admin/inventario/delete/(:any)'] = 'inventario/delete/$1';
				$route['admin/inventario/(:any)'] = 'inventario/index/$1'; //$1 = page number
    			