<?php 
class Result{
    private $exam_id;
    private $std_name;
    private $sub_name;
    private $exam_degree;

    public function __construct($exam_id, $sub_name, $std_name, $exam_degree){

        $this->exam_id = $exam_id;        
        $this->std_name = $std_name;        
        $this->sub_name = $sub_name;
        $this->exam_degree = $exam_degree;

    }

    public function __set($key, $value){
        switch ($key) {
            case 'exam_id':
                $this->exam_id = $value;
            break;
            case 'std_name':
                $this->std_name = $value;
            break;
            case 'sub_name':
                $this->sub_name = $value;
            break;
            case 'exam_degree':
                $this->exam_degree = $value;
            break;
        }
        return $value;
    }
    public function __get($key){
        switch ($key) {
            case 'exam_id':
                return $this->exam_id;
            case 'sub_name':
                return $this->sub_name;
            case 'std_name':
                return $this->std_name;
            case 'exam_degree':
                return $this->exam_degree;
        }
    }
}