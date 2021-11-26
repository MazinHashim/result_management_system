<?php 
class Subject{
    private $sub_id;
    private $sub_name;
    private $full_deg;
    private $exDate;

    public function __construct($sub_id, $sub_name, $full_deg, $exDate){

        $this->sub_id = $sub_id;
        $this->sub_name = $sub_name;
        $this->full_deg = $full_deg;
        $this->exDate = $exDate;

    }

    public function __set($key, $value){
        switch ($key) {
            case 'sub_id':
                $this->sub_id = $value;
            break;
            case 'sub_name':
                $this->sub_name = $value;
            break;
            case 'full_deg':
                $this->full_deg = $value;
            break;
            case 'exDate':
                $this->exDate = $value;
            break;
        }
        return $value;
    }
    public function __get($key){
        switch ($key) {
            case 'sub_id':
                return $this->sub_id;
            case 'sub_name':
                return $this->sub_name;
            case 'full_deg':
                return $this->full_deg;
            case 'exDate':
                return $this->exDate;
        }
    }

    public function create_account(){
    }
}