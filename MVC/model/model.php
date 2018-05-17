<?php
  
   /* Clase Encargada de la conexion y la gestion de los datos
      por medio de las consultas basicas.  */

  class model{
    
    public $table;        // Nombre de la tabla (String)
    private $_fields;     // lista de Campos (Array) 
    private $_host;       // Nombre del Servidor (String)
    private $_user;       // Nombre del Usuario (String)
    private $_password;   // Contraseña del Usuario (String)
    private $_database;   // Nombre de la Base de Datos (String)
    private $_conn;       // Objeto instanciado de la clase mysqli (Object)
    
    // Metodo Constructor el cual configura y ejecuta la conexion.
    public function __construct($table)
    {
      $this->_setConnection();
	  
      
      $this->_connect();

      $this->table = $table;
      $this->_fields = $this->getFields($table);
    }
    

    // Metodo privado encargado de configurar la conexion apartir del archivo conf.php
    private function _setConnection()
    {
      require 'conf.php';

      $this->_host = $host;
      $this->_user = $user;
      $this->_password = $password;
      $this->_database = $database;
    }
    
    // Metodo privado encargado de crear la conexion, genera el objeto de conexion.
    private function _connect()
    {
      $this->_conn = @new mysqli($this->_host, $this->_user, $this->_password, $this->_database);
      // $this->_conn->set_charset('utf8');

      if($this->_conn->connect_errno){
        die("<div style='font-size: 90%; border:1px solid #CD0A0A; margin-top: 20px; padding: 0pt 0.7em; background-color:#F00015; color:#FFF'><p><b>Numero del Error: </b><i>".$this->_conn->connect_errno."</i></p>".
                "<p><b>No se pudo establecer la conexion: </b><i>".$this->_conn->connect_error.".</i></p></div>");
      }
    }

    
    private function getFields($table)
    {
      $query = "Describe $table";
      $describe = $this->_sql($query);
      $fields = array();

      if($describe){
        foreach($describe as $key=>$value){
          array_push($fields, $table.'.'.$value['Field']);
        }
      }

      array_shift($fields);

      return $fields;
    }


    private function _sql($query)
    {
      $queryQ = $this->_conn->query($query);
  
      if($this->_conn->errno){
        return "<div style='font-size: 90%; border:1px solid #CD0A0A; margin-top: 20px; padding: 0pt 0.7em; background-color:#F00015; color:#FFF'>
          <p><b>Numero del Error: </b>".$this->_conn->errno.",</p>".
        "<p><b>Error al ejecutar la sentencia en la tabla {$this->table}: </b><i>". $this->_conn->error.".</i></p></div>";
      }

      $result = array();
      
      if($queryQ instanceof mysqli_result){
        while($queryF = $queryQ->fetch_assoc()){
          array_push($result, $queryF);
        }

        if(empty($result)) 
          return "<div style='font-size: 90%; border:1px solid #F9DD34; margin-top: 20px; padding: 0pt 0.7em; background-color:#FFF1A0; color:#363636' ><p><b><i>No Hay Registros para Mostrar.</i></b></p></div>";
        else 
          return $result;
      }
      else 
        return $this->_conn->affected_rows;
    }





    /**
     * Metodo Publico encargado de generar la consulta SELECT
     * Puedo retornar un arreglo o un mensaje de texto. 
     * String $whereStr ('id=1') o false
     * String $orderStr (nombreCampo [asc | desc]) o false
     * Int $limitStr    (cantidadRegistros) o false
     * Int $start       (inicioRegistro) o false
     */
    public function getRecords($whereStr=false, $orderStr=false, $limitStr=false, $start=0)
    {
      $where = $whereStr ? "WHERE $whereStr" : "";
      $order = $orderStr ? "ORDER BY $orderStr" : "";
      $limit = $limitStr ? "LIMIT $start, $limitStr" : "";
      
      $fields = implode(", ", $this->_fields);

      $query = "SELECT * FROM {$this->table} $where $order $limit";
      
      return $this->_sql($query);
    }



    public function insertRecord($data)
    {
      $fields = $this->_fields;
      $fields = implode(", ", $fields);
      $data = implode("', '", $data);

     $query="INSERT INTO {$this->table} ($fields) VALUES ('$data')";
      
      return $this->_sql($query);
    }


    public function updateRecord($id, $data)
    {
      $fields = $this->_fields;
      $result = array();

      foreach($fields as $key => $value){
        $current_data = $data[$key];
        array_push($result, "$value = '$current_data'");
      }

      $updates=implode(", ",$result);
      
      $query="UPDATE {$this->table} SET $updates WHERE id = $id";
      
      return $this->_sql($query);
    }
        

    public function deleteRecord($id)
    {
      $query="DELETE FROM {$this->table} WHERE id = $id";
      return $this->_sql($query);
    }
    
    

    public function getRecord($id)
    {
      return $this->getRecords("id = $id",false,1);
    }
  

    public function getLastId()
    {
      $query="SELECT * FROM {$this->table} WHERE id = (SELECT MAX(id) as id FROM {$this->table})";
      return $this->_sql($query);
    }


    public function getCount()
    {
      $query="SELECT COUNT(id) as count FROM {$this->table}";
      return $this->_sql($query);
    }



    public function __destruct()
    {
      @$this->_conn->close();
    }
  }