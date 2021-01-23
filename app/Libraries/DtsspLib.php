<?php

namespace App\Libraries;
//use CodeIgniter\HTTP\RequestInterface;
/*
|==================================================================
|* Code page : https://github.com/sluvanda/codeigniter-datatables/blob/master/application/libraries/Datatables_server_side.php
|* github repo : https://github.com/sluvanda/codeigniter-datatables
|==================================================================
*/

class DtsspLib {

	/**
	 * Database table
	 *
	 * @var	string
	 */
	private $table;

	/**
	 * Primary key
	 *
	 * @var	string
	 */
	private $primary_key;

	/**
	 * Columns to fetch
	 *
	 * @var	array
	 */
	private $columns;

	/**
	 * Where clause
	 *
	 * @var	mixed
	 */
	private $where;

	/**
	 * CI Singleton
	 *
	 * @var	object
	 */
	private $CI;

	/**
	 * GET request
	 *
	 * @var	array
	 */
	private $request;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param	array	$params	Initialization parameters
	 * @return	void
	 */
	public function __construct($params)
	{
		//
		$this->db = \Config\Database::connect();
		
		$this->table = (array_key_exists('table', $params) === TRUE && is_string($params['table']) === TRUE) ? $params['table'] : '';
		
		$this->primary_key = (array_key_exists('primary_key', $params) === TRUE && is_string($params['primary_key']) === TRUE) ? $params['primary_key'] : '';
		
		$this->columns = (array_key_exists('columns', $params) === TRUE && is_array($params['columns']) === TRUE) ? $params['columns'] : [];

		$this->where = (array_key_exists('where', $params) === TRUE && (is_array($params['where']) === TRUE || is_string($params['where']) === TRUE)) ? $params['where'] : [];
		
		$req = \Config\Services::request(); //$this->request->getGetPost();
		
		$this->request = $req->getGet();

		//$this->request =  \Config\Services::request(); //$this->request->getGetPost();
		
		$this->validate_table();

		$this->validate_primary_key();

		$this->validate_columns();

		$this->validate_request();
	}

	// --------------------------------------------------------------------

	/**
	 * Validate database table
	 *
	 * @return	void
	 */
	private function validate_table()
	{
		if ($this->db->tableExists($this->table) === FALSE)
		{
			$this->response(array(
				'error' => 'Table doesn\'t exist.'
			));
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Validate primary key
	 *
	 * @return	void
	 */
	private function validate_primary_key()
	{
		if ($this->db->fieldExists($this->primary_key, $this->table) === FALSE)
		{
			$this->response(array(
				'error' => 'Invalid primary key.'
			));
		}
	}

	// --------------------------------------------------------------------

	/**
	 * validate columns to fetch
	 *
	 * @return	void
	 */
	private function validate_columns()
	{
		foreach ($this->columns as $column)
		{
			if (is_string($column) === FALSE || $this->db->fieldExists($column, $this->table) === FALSE)
			{
				$this->response(array(
					'error' => 'Invalid column.'
				));
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * validate GET request
	 *
	 * @return	void
	 */
	private function validate_request()
	{
		if (count($this->request['columns']) !== count($this->columns))
		{
			$this->response(array(
				'error' => 'Column count mismatch.'
			));
		}

		foreach ($this->request['columns'] as $column)
		{
			if (isset($this->columns[$column['data']]) === FALSE)
			{
				$this->response(array(
					'error' => 'Missing column.'
				));
			}

			$this->request['columns'][$column['data']]['name'] = $this->columns[$column['data']];
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generates the ORDER BY portion of the query
	 *
	 * @return	CI_DB_query_builder
	 */
	private function order()
	{
		foreach ($this->request['order'] as $order)
		{
			$column = $this->request['columns'][$order['column']];

			if ($column['orderable'] === 'true')
			{
				$this->CI->db->orderBy($column['name'], strtoupper($order['dir']));
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generates the LIKE portion of the query
	 *
	 * @return	CI_DB_query_builder
	 */
	private function search()
	{
		$global_search_value = $this->request['search']['value'];
		$likes = [];

		foreach ($this->request['columns'] as $column)
		{
			if ($column['searchable'] === 'true')
			{
				if (empty($global_search_value) === FALSE)
				{
					$likes[] = array(
						'field' => $column['name'],
						'match' => $global_search_value
					);
				}

				if (empty($column['search']['value']) === FALSE)
				{
					$likes[] = array(
						'field' => $column['name'],
						'match' => $column['search']['value']
					);
				}
			}
		}

		foreach ($likes as $index => $like)
		{
			if ($index === 0)
			{
				$this->db->like($like['field'], $like['match']);
			}
			else
			{
				$this->db->orLike($like['field'], $like['match']);
			}
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Generates the WHERE portion of the query
	 *
	 * @return	CI_DB_query_builder
	 */
	private function where()
	{
		$this->db->where($this->where);
	}

	// --------------------------------------------------------------------

	/**
	 * Send response to DataTables
	 *
	 * @param	array	$data
	 * @return	void
	 */
	private function response($data)
	{
		/*
		$this->CI->output->set_content_type('application/json');
        $this->CI->output->set_output(json_encode($data));
        $this->CI->output->_display();
        */
        //return $this->response->setJSON($data);
        header('Content-Type: application/json');
        echo json_encode( $data );
        exit;
	}

	// --------------------------------------------------------------------

	/**
	 * Calculate total number of records
	 *
	 * @return	int
	 */
	private function records_total()
	{
		$this->db->resetQuery();

		$this->where();

		$this->db->from($this->table);

		return $this->db->countAllResults();
	}

	// --------------------------------------------------------------------

	/**
	 * Calculate filtered records
	 *
	 * @return	int
	 */
	private function records_filtered()
	{
		$this->db->resetQuery();

		$this->search();

		$this->where();

		$this->db->from($this->table);

		return $this->db->countAllResults();
	}

	// --------------------------------------------------------------------

	/**
	 * Process
	 *
	 * @param	string	$row_id = 'data'
	 * @param	string	$row_class = ''
	 * @return	void
	 */
	public function process($row_id = 'data', $row_class = '')
	{
		if (in_array($row_id, array('id', 'data', 'none'), TRUE) === FALSE)
		{
			$this->response(array(
				'error' => 'Invalid DT_RowId.'
			));
		}

		if (is_string($row_class) === FALSE)
		{
			$this->response(array(
				'error' => 'Invalid DT_RowClass.'
			));
		}

		$columns = array();

		$add_primary_key = TRUE;

		foreach ($this->columns as $column)
		{
			$columns[] = $column;

			if ($column === $this->primary_key)
			{
				$add_primary_key = FALSE;
			}
		}

		if ($add_primary_key === TRUE)
		{
			$columns[] = $this->primary_key;
		}

		$this->db->select(implode(',', $columns));

		$this->order();

		$this->search();

		$this->where();

		//$query = $this->db->get($this->table, $this->request['length'], $this->request['start']);
		$builder = $this->db->table($this->table);
		$builder->get($this->request['length'], $this->request['start']);

		$data['data'] = array();

		foreach ($builder->resultArray() as $row)
		{
			$r = [];

			foreach ($this->columns as $column)
			{
				$r[] = $row[$column];
			}

			if ($row_id === 'id')
			{
				$r['DT_RowId'] = $row[$this->primary_key];
			}

			if ($row_id === 'data')
			{
				$r['DT_RowData'] = array(
					'id' => $row[$this->primary_key]
				);
			}

			if ($row_class !== '')
			{
				$r['DT_RowClass'] = $row_class;
			}

			$data['data'][] = $r;
		}

		$data['draw'] = intval($this->request['draw']);

		$data['recordsTotal'] = $this->records_total();

		$data['recordsFiltered'] = $this->records_filtered();

		$this->response($data);
	}
}