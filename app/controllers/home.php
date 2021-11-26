<?php
require_once "../app/models/Subject.php";
require_once "../app/models/Student.php";
require_once "../app/models/Result.php";
session_start();

class Home extends Services
{
    public function signin(){
        return $this->get_view("home/signin");
    }
    public function change_date(){
        if(isset($_POST["chg_conf_date"])){
            $conf_date = $_POST["conf_date"];
            $conf_time = $_POST["conf_time"];
            $result = $this->db_update("administrator", "conf_time='$conf_date $conf_time'", "username='admin'");
            if($result){
                $_SESSION["infoMessage"] = "Done";
            } else {
                $_SESSION["errorMessage"] = "Error Occur";
            }
            return header("Location: homepage");
            
        }
    }
    public function check_all_res() {
        $list = array();
        $data = $this->db_get_students_cross_subjects();
        while ($row = mysqli_fetch_assoc($data)){
           $result = $this->db_check_result_for_std($row["std_id"], $row["sub_id"]);
        //    print_r($result);
           if(!isset($result["exam_id"])){
                // $not_found = $this->db_select_result_model_where("results s, students st, subjects sub", "s.sub_id={$row['sub_id']} && s.std_id={$row['std_id']}", null, 1);
                // print_r($not_found);
                // if ($row = mysqli_fetch_assoc($not_found)) {
                //     $degree = new Result($row["exam_id"], $row["subject_name"], $row["std_name"], $row["std_degree"]);
                //     array_unshift($list, $degree);
                // }
                $_SESSION['infoMessage'] = null;
                $_SESSION['errorMessage'] = "Missing Some OF Students Degrees";
                break;
           } else {
                $_SESSION['infoMessage'] = "Every Thing is Good, Now You Can Determine Conference Date";
           }
        //    print_r($list);
        }
        header("Location: homepage");
    }
    public function homepage(){
        if(isset($_POST["sign-submit"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $admin = $this->db_get_verfied_data("administrator", $username, $password);
            if($admin){
                $_SESSION["userObj"] = $admin;
                
                date_default_timezone_set("Africa/Cairo");
                $expire = time() + 60*60*24*7;
                setcookie("cookMessage", null, $expire);
                setcookie("cookMessage", "{$admin["username"]} On " . date("l jS \of F Y h:i:s A"), $expire, "/");
                // echo "<p class='text-white'>{$_COOKIE['cookMessage']}</p>";
                header("Location: homepage");
            } else {
                $errorMessage = "Username Or Password Is Wrong";
                return $this->get_view("home/signin", ["ErrMsg" => $errorMessage]);
            }
        }
        else if(isset($_SESSION['userObj'])) {
            $f_success = $this->db_get_count("results res, students s", "s.id=res.std_id && res.std_degree>=50 && s.gender='Female'");
            // echo $f_success['count'] . "<br />";
            $f_fail = $this->db_get_count("results res, students s", "s.id=res.std_id && res.std_degree<50 && s.gender='Female'");
            // echo $f_fail['count'] . "<br />";
            $m_success = $this->db_get_count("results res, students s", "s.id=res.std_id && res.std_degree>=50 && s.gender='Male'");
            // echo $m_success['count'] . "<br />";
            $m_fail = $this->db_get_count("results res, students s", "s.id=res.std_id && res.std_degree<50 && s.gender='Male'");
            // echo $m_fail['count'] . "<br />";
            $f_total = $this->db_get_count("results res, students s", "s.id=res.std_id && s.gender='Female'");
            $f_div_by_0 = $f_total['count']==0;
            // echo $f_total['count'] . "<br />";
            $m_total = $this->db_get_count("results res, students s", "s.id=res.std_id && s.gender='Male'");
            $m_div_by_0 = $m_total['count']==0;
            // echo $m_total['count'] . "<br />";
            $fem_s_percent = $f_div_by_0 ? 0: $f_success['count'] / $f_total['count'] * 100;
            $fem_f_percent = $f_div_by_0 ? 0: $f_fail['count'] / $f_total['count'] * 100;
            $male_s_percent = $m_div_by_0 ? 0: $m_success['count'] / $m_total['count'] * 100;
            $male_f_percent = $m_div_by_0 ? 0: $m_fail['count'] / $m_total['count'] * 100;
            return $this->get_view("home/homepage");
        }
    }
    public function signout() {
        $_SESSION["userObj"] = null;
        return header("Location: ../views/home/signin");
    }
    public function getAllStudents(){
        $studentsList = array();
        $result = $this->db_select_all_data("students", "std_name");
        while ($row = mysqli_fetch_assoc($result)){
            $student = new Student($row["id"], $row["std_name"], $row["age"], $row["gender"], $row["mother_name"], $row["std_school"], $row["state"], $row["sitting_num"], $row["ssn_num"]);
            array_unshift($studentsList, $student);
        }
        return $studentsList;
    }
    public function getAllSubjects(){
        $subjectList = array();
        $result = $this->db_select_all_data("subjects", "subject_name");
        while ($row = mysqli_fetch_assoc($result)){
            $subject = new Subject($row["id"], $row["subject_name"], $row["full_degree"], $row["exam_date"]);
            array_unshift($subjectList, $subject);
        }
        return $subjectList;
    }
    public function students() {
        $studentsList = $this->getAllStudents();
        return $this->get_view("home/manageStudents", ["students" => $studentsList]);
    }
    public function subjects() {
        $subjectList = $this->getAllSubjects();
        return $this->get_view("home/manageSubjects", ["subjects" => $subjectList]);
    }
    public function results() {
        $resultList = array();
        $data = $this->db_get_results();
        while ($row = mysqli_fetch_assoc($data)){
            $result = new Result($row["exam_id"], $row["subject_name"], $row["std_name"], $row["std_degree"]);
            array_unshift($resultList, $result);
        }
        return $this->get_view("home/manageDegrees", ["results" => $resultList]);
    }
    public function add_or_edit_subject() {
        if(isset($_POST['add_sub_btn']) || isset($_POST['edit_sub_btn'])){
            $sub_name = $_POST["sub_name"];
            $full_mark = $_POST["full_mark"];
            $exam_date = $_POST["exam_date"];
            $result = null;
            if(isset($_POST['add_sub_btn'])){
                $result = $this->db_insert("subjects", "null,'$sub_name', $full_mark, '$exam_date'");
            } else {
                $sub_id = $_POST["sub_id"];
                $result = $this->db_update("subjects", "subject_name='$sub_name', full_degree=$full_mark, exam_date='$exam_date'", "id=$sub_id");
            }
            if($result){
                $op1 = isset($_POST['add_sub_btn'])?"Added":"Updated";
                $_SESSION["infoMessage"] = "Subject $op1 Successfully";
            } else {
                $op2 = isset($_POST['add_sub_btn'])?"Addition":"Edition";
                $_SESSION["errorMessage"] = "An Error Occurs Subject $op2 Failed";
            }
            return header("Location: subjects");
        }
        return $this->get_view("home/addSubject");
    }
    public function add_or_edit_student() {
        if(isset($_POST['add_std_btn']) || isset($_POST['edit_std_btn'])){
            $std_name = $_POST["std_name"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $mother_name = $_POST["mother_name"];
            $std_school = $_POST["std_school"];
            $std_state = $_POST["std_state"];
            $sitting_num = $_POST["sitting_num"];
            $ssn_num = $_POST["ssn_num"];
            $result = null;
            if(isset($_POST['add_std_btn']))
                $result = $this->db_insert("students", "null,'$std_name', $age, '$gender', '$mother_name', '$std_school', '$std_state', $sitting_num, $ssn_num");
            else {
                $std_id = $_POST["std_id"];
                $result = $this->db_update("students", "std_name='$std_name', age=$age, gender='$gender', mother_name='$mother_name', std_school='$std_school', state='$std_state', sitting_num=$sitting_num, ssn_num=$ssn_num", "id=$std_id");
            }
            if($result){
                $op1 = isset($_POST['add_std_btn'])?"Added":"Updated";
                $_SESSION["infoMessage"] = "Student $op1 Successfully";
            } else {
                $op2 = isset($_POST['add_std_btn'])?"Addition":"Edition";
                $_SESSION["errorMessage"] = "An Error Occurs Student $op2 Failed";
            }
            return header("Location: students");
        }
        return $this->get_view("home/addStudent");
    }
    public function add_or_edit_degree() {
        if(isset($_POST['add_deg_btn']) || isset($_POST['edit_deg_btn'])){
            $std_id = $_POST["std_id"];
            $sub_id = $_POST["sub_id"];
            $exam_deg = $_POST["exam_deg"];
            $result = null;
            if(isset($_POST['add_deg_btn']))
                $result = $this->db_insert("results", "null, $std_id, $sub_id, $exam_deg");
            else {
                $exam_id = $_POST["exam_id"];
                $result = $this->db_update("results", "std_id=$std_id, sub_id=$sub_id, std_degree=$exam_deg", "exam_id=$exam_id");
            }
            if($result){
                $op1 = isset($_POST['add_deg_btn'])?"Added":"Updated";
                $_SESSION["infoMessage"] = "Degree $op1 Successfully";
            } else {
                $op2 = isset($_POST['add_deg_btn'])?"Addition":"Edition";
                $_SESSION["errorMessage"] = "An Error Occurs Degree $op2 Failed";
            }
            return header("Location: results");
        }
        $studentsList = $this->getAllStudents();
        $subjectList = $this->getAllSubjects();
        return $this->get_view("home/addDegree", ["students" => $studentsList, "subjects" => $subjectList]);
    }
    public function edit_subject() {
        $sub_id = $_GET['sub_id'];
        $subject = null;
        $result = $this->db_select_data_where("subjects", "id=$sub_id", null, 1);
        if ($row = mysqli_fetch_assoc($result)) {
            $subject = new Subject($row["id"], $row["subject_name"], $row["full_degree"], $row["exam_date"]);
        }
        return $this->get_view("home/addSubject", ["subject" => $subject]);
    }
    public function edit_student() {
        $std_id = $_GET['std_id'];
        $student = null;
        $result = $this->db_select_data_where("students", "id=$std_id", null, 1);
        if ($row = mysqli_fetch_assoc($result)) {
            $student = new Student($row["id"], $row["std_name"], $row["age"], $row["gender"], $row["mother_name"], $row["std_school"], $row["state"], $row["sitting_num"], $row["ssn_num"]);
        }
        return $this->get_view("home/addStudent", ["student" => $student]);
    }
    public function edit_degree() {
        $exam_id = $_GET['exam_id'];
        $degree = null;
        $result = $this->db_get_result_by_id($exam_id);
        if ($row = mysqli_fetch_assoc($result)) {
            $degree = new Result($row["exam_id"], $row["subject_name"], $row["std_name"], $row["std_degree"]);
        }
        $studentsList = $this->getAllStudents();
        $subjectList = $this->getAllSubjects();
        return $this->get_view("home/addDegree", ["degree" => $degree, "students" => $studentsList, "subjects" => $subjectList]);
    }
    public function delete_student() {
        $std_id = $_GET['std_id'];
        $result1 = $this->db_delete("results", "std_id=$std_id");
        $result2 = $this->db_delete("students", "id=$std_id", 1);
        if ($result1 && $result2) {
            $_SESSION["infoMessage"] = "Student Deleted Successfully";
        } else {
            $_SESSION["errorMessage"] = "An Error Occurs Student Deletion Failed";
        }
        return header("Location: students");
    }
    public function delete_subject() {
        $sub_id = $_GET['sub_id'];
        $result1 = $this->db_delete("results", "sub_id=$sub_id");
        $result2 = $this->db_delete("subjects", "id=$sub_id", 1);
        if ($result1 && $result2) {
            $_SESSION["infoMessage"] = "Subject Deleted Successfully";
        } else {
            $_SESSION["errorMessage"] = "An Error Occurs Subject Deletion Failed";
        }
        return header("Location: subjects");
    }
    public function delete_degree() {
        $exam_id = $_GET['exam_id'];
        $result = $this->db_delete("results", "exam_id=$exam_id", 1);
        if ($result) {
            $_SESSION["infoMessage"] = "Degree Deleted Successfully";
        } else {
            $_SESSION["errorMessage"] = "An Error Occurs Degree Deletion Failed";
        }
        return header("Location: results");
    }
    
}