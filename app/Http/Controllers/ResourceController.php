<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ResourceController extends Controller{
    protected $model;
    protected $query_terms = [];
    protected $data = [];
    public function __construct(string $model,Request $request , string $default_search_term = 'title'){
        $this->model = (new $model)->getTable();
        if($request->limit){
            $this->query_terms['limit'] = $request->limit;
        }else{
            $this->query_terms['limit'] = 20;
        }
        if($request->order_by){
            $this->query_terms['order_by'] = $request->order_by;
        }else{
            $this->query_terms['order_by'] = 'id';
        }
        if($request->order){
            $this->query_terms['order'] = $request->order ;
        }else{
            $this->query_terms['order'] = 'ASC';
        }
        if($request->page){
            $this->query_terms['page'] = $request->page;
        }else{
            $this->query_terms['page'] = '1';
        }
        if($request->query){
            $this->query_terms['query_string'] = $request->query;
        }else{
            $this->query_terms['query_string'] = '';
        }
        if($request->query_term){
            $this->query_terms['query_term'] = $request->query_term;
        }else{
            $this->query_terms['query_term'] = $default_search_term;
        }
        $this->data = DB::table($this->model)
                        ->where($this->query_terms['query_term'], 'LIKE', '%'.$this->query_terms['query_string'].'%')
                        ->orderBy($this->query_terms['order_by'] | 'id', $this->query_terms['order'] | 'ASC')
                        ->limit($this->query_terms['limit'])
                        ->paginate(20,['*'],'page',$this->query_terms['page']);
    }
}