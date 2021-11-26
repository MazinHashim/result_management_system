<?php 
class Student{
    private $std_id;
    private $std_name;
    private $age;
    private $gender;
    private $mother_name;
    private $std_school;
    private $std_state;
    private $sitting_num;
    private $ssn_num;

    public function __construct($std_id, $std_name, $age, $gender, $mother_name, $std_school,$std_state, $sitting_num, $ssn_num){

        $this->std_id = $std_id;
        $this->std_name = $std_name;
        $this->age = $age;
        $this->gender = $gender;
        $this->mother_name = $mother_name;
        $this->std_school = $std_school;
        $this->std_state = $std_state;
        $this->sitting_num = $sitting_num;
        $this->ssn_num = $ssn_num;

    }

    public function __set($key, $value){
        switch ($key) {
            case 'std_id':
                $this->std_id = $value;
            break;
            case 'std_name':
                $this->std_name = $value;
            break;
            case 'age':
                $this->age = $value;
            break;
            case 'gender':
                $this->gender = $value;
            break;
            case 'mother_name':
                $this->mother_name = $value;
            break;
            case 'std_school':
                $this->std_school = $value;
            break;
            case 'std_state':
                $this->std_state = $value;
            break;
            case 'sitting_num':
                $this->sitting_num = $value;
            break;
            case 'ssn_num':
                $this->ssn_num = $value;
            break;
        }
        return $value;
    }
    public function __get($key){
        switch ($key) {
            case 'std_id':
                return $this->std_id;
            case 'std_name':
                return $this->std_name;
            case 'age':
                return $this->age;
            case 'gender':
                return $this->gender;
            case 'mother_name':
                return $this->mother_name;
            case 'std_school':
                return $this->std_school;
            case 'std_state':
                return $this->std_state;
            case 'sitting_num':
                return $this->sitting_num;
            case 'ssn_num':
                return $this->ssn_num;

        }
    }
}