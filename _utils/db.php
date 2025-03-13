
<?php 
class database{
    public string $serverip;
    public string $username;
    public string $password;
    public string $databse;
    public mysqli $connection;
    public array $tables = [];
    function __construct(string $serverip, string $username, string $password, string $database){
        $this->serverip = $serverip;
        $this->username= $username;
        $this->password = $password;
        $this->databse = $database;
        $this->connection = new mysqli($serverip, $username, $password, $database) or die("Unable to connect");

    }
    function disconnect(){
        mysqli_close($this->connection);
    }
    function add_table(string $nome, array $values){
        $this->tables[$nome] = $values;
    }

    function insert(string $table, array $values){
        $valuesStr = "";
        for ($i = 0; $i < sizeof($this->tables[$table]) ; $i++){
            $valuesStr.=$this->tables[$table][$i];
            if ($i+1 != sizeof($this->tables[$table])){
                $valuesStr .=  ",";
            }
        }
        
        $valuesStr2 = "";
        for ($i = 0; $i < sizeof($values) ; $i++){
            if (is_string($values[$i])) $values[$i] = "'$values[$i]'";
            if (is_bool($values[$i])) $values[$i] = $values[$i]? "true" : "false"  ;
            if ($values[$i] == null) $values[$i] = "null";
            $valuesStr2 .= $values[$i];
            if ($i+1 != sizeof($values)){
                $valuesStr2 .=  ",";
            }
        }
        
        $sql = "INSERT INTO $table ($valuesStr) VALUES ($valuesStr2);";
        mysqli_query($this->connection, $sql);
        
    }
    function get(string $table, string $column, mixed $key){
        if (is_string($key)) $key= "'$key'";
        $sql = "select * from $table where $column = $key";
        $result = mysqli_query($this->connection, $sql);
        
        return mysqli_fetch_all($result);

    }

    function update(string $table, int $id, string $column, mixed $newValue){
        if (is_string($newValue)) $newValue = "'$newValue'";
        if (is_bool($newValue)) $newValue = $newValue? "true" : "false";
        $sql = "UPDATE $table SET $column = $newValue WHERE id = $id";
        mysqli_query($this->connection,$sql);
    }

    function removeRow(string $table, string $column, mixed $key){
        if (is_string($key)) $key = "'$key'";
        if (is_bool($key)) $key = $key? "true" : "false";
        $sql = "DELETE FROM $table WHERE $column = $key";
        mysqli_query($this->connection, $sql); 
    }
}
?>