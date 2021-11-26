<?php
define("HOST", "localhost");
define("USER_NAME", "mazin_hashim");
define("PASSWORD", "");
define("DB_NAME", "certificate_result_db");

class Services
{
    public function get_model($model)
    {
        require_once "../app/models/" . $model . ".php";
        return new $model();
    }
    public function get_view($view, $data = []){
        require_once "../app/views/" . $view . ".php";
    }

    public static function db_connection(){
        $connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

        if(mysqli_connect_errno()){
        die("Database Connection Failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
            );
        }
        return $connection;
    }
    public static function db_close($connection){
        if (isset($connection)){
            mysqli_close($connection);
        }
    }
    public static function db_insert($table, $valuesQuery){
        $connection = Services::db_connection();
        $query = "INSERT INTO $table VALUES ($valuesQuery)";
        $result = mysqli_query($connection, $query);
        if( $result ){
            $message = "Now You Are Registered. Thank you!";
        } else {
            $error = "There Some Errors";
        }
        Services::db_close($connection);
        return $result;
    }
    public static function db_update($table, $setQuery, $whereQuery){
        $connection = Services::db_connection();
        $query = "UPDATE $table SET $setQuery WHERE $whereQuery";
        $result = mysqli_query($connection, $query);
        if( $result ){
            $message = "Udated Successfully. Thank you!";
        } else {
            $error = "There Some Errors";
        }
        Services::db_close($connection);
        return $result;
    }
    public static function db_delete($table, $whereQuery, $limit = null){
        $connection = Services::db_connection();
        $query = "DELETE FROM $table WHERE $whereQuery" . ($limit?" LIMIT $limit":"");
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
    public static function db_get_count($table, $whereQuery=null){
        $connection = Services::db_connection();
        $query = "SELECT COUNT(*) as count FROM $table " . ($whereQuery?" WHERE $whereQuery":"");
        $result = mysqli_query($connection, $query);
        if( $data = mysqli_fetch_assoc($result) ){
            return $data;
        }
        Services::db_close($connection);
    }
    public static function db_get_verfied_data($table, $username, $password){
        $connection = Services::db_connection();
        $query = "SELECT * FROM $table WHERE username='$username' && userpass='$password'";
        $result = mysqli_query($connection, $query);
        if( $user = mysqli_fetch_assoc($result) ){
            return $user;
        }
        Services::db_close($connection);
    }
    public static function db_get_students_cross_subjects(){
        $connection = Services::db_connection();
        $query = "SELECT s.id as std_id, sub.id as sub_id FROM subjects sub CROSS JOIN students s;";
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
    public static function db_check_result_for_std($std_id, $sub_id){
        $connection = Services::db_connection();
        $query = "SELECT * FROM results WHERE std_id=$std_id && sub_id=$sub_id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ( $data = mysqli_fetch_assoc($result) ){
            return $data;
        }
        Services::db_close($connection);
    }
    public static function db_get_results(){
        $connection = Services::db_connection();
        $query = "SELECT r.exam_id, sb.subject_name, st.std_name, r.std_degree FROM students as st, subjects as sb, results as r WHERE r.std_id = st.id && r.sub_id = sb.id";
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
    public static function db_get_result_by_id($exam_id){
        $connection = Services::db_connection();
        $query = "SELECT r.exam_id, sb.subject_name, st.std_name, r.std_degree FROM students as st, subjects as sb, results as r WHERE r.exam_id=$exam_id LIMIT 1";
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
    public static function db_select_all_data($table, $orderAttr = null){
        $connection = Services::db_connection();
        $query = "SELECT * FROM $table". ($orderAttr?" ORDER BY $orderAttr":"");
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
    public static function db_select_data_where($table, $whereQuery, $orderAttr = null, $limit = null){
        $connection = Services::db_connection();
        $query = "SELECT * FROM $table WHERE $whereQuery". ($orderAttr?" ORDER BY $orderAttr":""). ($limit?" LIMIT $limit":"");
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
    public static function db_select_result_model_where($table, $whereQuery, $orderAttr = null, $limit = null){
        $connection = Services::db_connection();
        $query = "SELECT s.exam_id, sub.subject_name, st.std_name, s.std_degree FROM $table WHERE $whereQuery". ($orderAttr?" ORDER BY $orderAttr":""). ($limit?" LIMIT $limit":"");
        $result = mysqli_query($connection, $query);
        return $result;
        Services::db_close($connection);
    }
}