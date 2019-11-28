<?php

namespace Core\Libraries;

use Core\Nayo_Exception;
use Core\Request;

class Datatables
{

    protected $entity = false;
    protected $filter = false;
    protected $request = false;
    protected $useIndex = true;
    protected $dtRowClass;
    protected $dtRowId;
    protected $columnCounter = 0;
    protected $column = array();
    protected $dtTableColumns = array();

    /**
     * Class constructor.
     */

    protected $output = array(
        "draw" => null,
        "recordsTotal" => null,
        "recordsFiltered" => null,
        "data" => null
    );
    public function __construct($entity, $filter = array())
    {
        if (!$this->entity) {
            $this->entity = $entity;
        }

        if (!empty($filter))
            $this->filter = $filter;


        if (!$this->request)
            $this->request = Request::getInstance();
        
        if(!is_numeric($this->request->get('columns')[0]['data'])){
            $this->dtTableColumns = $this->request->get('columns');
            $this->useIndex = false;
        } else {
            $this->useIndex = true;
        }
    }

    private function newEntity()
    {
        $ent = 'App\\Models\\' . $this->entity;
        return $ent;
    }

    public function populate()
    {
        try {
            // echo \json_encode($this->dtTableColumns);
            if(!$this->useIndex)
                if(count($this->column) != count($this->dtTableColumns))
                    Nayo_Exception::throw("Field Count Missmatch");

            $model = $this->newEntity();
            $params = array();

            $params['whereIn'] = isset($this->filter['whereIn']) ? $this->filter['whereIn'] : null;
            $params['where'] = isset($this->filter['where']) ? $this->filter['where'] : null;
            $params['join'] = isset($this->filter['join']) ? $this->filter['join'] : null;

            if ($this->request->get('length') != -1) {
                $params['limit'] = array(
                    'page' => $this->request->get('start') + 1,
                    'size' => $this->request->get('length')
                );
            }

            if ($this->request->get('search') && $this->request->get('search')['value'] != '') {
                $searchValue = $this->request->get('search')['value'];

                foreach ($this->column as $column) {
                    if ($column['searchable']) {
                        $params['group']['orlike'][$column['column']] = $searchValue;
                    }
                }
            }

            if ($this->request->get('order') && count($this->request->get('order'))) {
                $order = $this->request->get('order')[0];

                if (isset($this->column[$order['column']]) && $this->column[$order['column']]['orderable'])
                    $params['order'] = array(
                        $this->column[$order['column']]['column'] =>  $order['dir'] === 'asc' ? "ASC" : "DESC"
                    );
            } 
            // echo \json_encode($_GET);
            $result = $model::getAll($params);

            $this->output["draw"] = !empty($this->request->get('draw')) ? intval($this->request->get('draw')) : 0;
            $this->output["recordsTotal"] = intval(count($result));
            $this->output["recordsFiltered"] = intval($this->allData($params));
            $this->output["data"] = $this->output($result);

        } catch (Nayo_Exception $e) {
            $this->output["error"] = $e->messages;
        }

        return $this->output;
    }

    private function allData($filter = array())
    {
        $model = $this->newEntity();
        $params = array(
            'join' => isset($filter['join']) ? $filter['join'] : null,
            'where' => isset($filter['where']) ? $filter['where'] : null,
            'group' => isset($filter['group']) ? $filter['group'] : null,
            'order' => isset($filter['order']) ? $filter['order'] : null,
        );
        return $model::countAll($params);
    }

    private function output($datas)
    {
        $out = array();
        foreach ($datas as $data) {
            $row = array();
            $i = 0;
            foreach ($this->column as $column) {
                $rowdata = null;
                if(!is_null($column['callback']))
                    $rowdata = $column['callback']($data);
                else {
                    $rowdata = $this->getColValue($column, $data);
                }

                if ($this->useIndex){
                    $row[] = $rowdata;
                } else {
                    $row[$this->dtTableColumns[$i]['data']] = $rowdata;
                }

                if ($this->dtRowId && $this->dtRowId == $column['column']) {
                    $rowid = $this->dtRowId;
                    $row['DT_RowId'] = $data->$rowid;
                }

                $row['DT_RowClass'] = $this->dtRowClass;
                $i++;
            }
            $out[] = $row;
        }
        return $out;
    }

    public function addColumn($column, $callback = null, $searchable = true, $orderable = true, $isdefaultorder = false)
    {

        $columns = array(
            'column' => $column,
            'callback' => $callback,
            'searchable' => $searchable,
            'orderable' => $orderable,
            'isdefaultorder' => $isdefaultorder
        );
        array_push($this->column, $columns);
        $this->columnCounter++;
        return $this;
    }

    public function addDtRowClass($className)
    {
        $this->dtRowClass = $className;
        return $this;
    }

    public function addDtRowId($columName)
    {
        $this->dtRowId = $columName;
        return $this;
    }

    private function getColValue($column, $data){
        $col = explode(".", $column['column']);
        if(count($col) == 2){
            if(lcfirst($this->entity) != $col[0]){
                $table = explode("_", $col[0]);
                $relatedTable = "get_".ucfirst($table[0])."_".singularize(ucfirst($table[1]));
                $selectedColumn = $col[1];
                return $data->$relatedTable()->$selectedColumn;
            } else {
                $selectedColumn = $col[1];
                return $data->$selectedColumn;
            }
        } else {
            $selectedColumn = $col[0];
            return $data->$selectedColumn;
        }
    }
}
