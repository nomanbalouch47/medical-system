<?php


class Databases{
	public $con;  
  public $error;
    
  public $servername = "localhost";
	public $username = "root";
	public $password = "";
	public $database = "db_medical_sys";  
    
    public function __construct()  
      {  
           $this->con = mysqli_connect($this->servername, $this->username,$this->password, $this->database);
           if(!$this->con)
           {  
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
           }  
           
      }

      public function insert($table_name, $data)  
      {  
           $string = "INSERT INTO ".$table_name." (";            
           $string .= implode(",", array_keys($data)) . ') VALUES (';            
           $string .= "'" . implode("','", array_values($data)) . "')";  
           if(mysqli_query($this->con, $string))  
           {  
                return true;  
           }  
           else  
           {  
                echo mysqli_error($this->con);  
           }  
      }

      public function query($sql){
        $result= mysqli_query($this->con,$sql);
        if(!$result){
            die("Query Failed");
        }
        return  $result;

      }

      public function select($table_name)  
      {
           $array = array();  
           $query = "SELECT * FROM ".$table_name."";  
           $result = mysqli_query($this->con, $query);  
           while($row = mysqli_fetch_array($result))
           {  
                $array[] = $row;  
           }  
           return $array;  
      }

      public function select_where($table_name, $where_condition)
      {
           $condition = '';
           $array = array();
           foreach($where_condition as $key => $value)
           {
                $condition .= $key . " = '".$value."' AND ";
           }
           $condition = substr($condition, 0, -5);
           $query = "SELECT * FROM ".$table_name." WHERE " . $condition;
           $result = mysqli_query($this->con, $query);
           while($row = mysqli_fetch_array($result))
           {
                $array[] = $row;
           }
           return $array;
      }
}

class Queries{
    public static function find_max_record($colname,$table){

        $result_set = self::find_this_query("select max($colname) as maxcol from $table");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;

    }
    public static function find_this_query($sql){
        global $data;

        $result_set=$data->query($sql);
        return $result_set;
    }
    
}


?>