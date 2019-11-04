<?php
namespace Classes\Ok ;

class DatabaseTable 
{   
    private $pdo;
    private $table;
    private $primaryKey;
    private $className;
    private $constructorArgs;
    
    public function __construct(\PDO $pdo, $table, $primaryKey,
               string $className ='\stdClass', $constructorArgs = []){
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }
    public function pdoQuery($query, $parameters=[]){
      
        $query = $this->pdo->prepare($query);

        $query->execute($parameters);
        
        return $query;
    }
    public function find(){
        $query = 'SELECT * FROM ' . $this->table;
        
        $query = $this->pdoQuery($query);
        
        $output = $query->fetchAll(\PDO::FETCH_CLASS,$this->className, $this->constructorArgs);
        
        return $output;
    }
    public function findById($id){
        $query = 'SELECT * FROM ' . $this->table .
            ' WHERE ' . $this->primaryKey . ' = ' . $id ;
        $query = $this->pdoQuery($query);
        
        $output = $query->fetchObject($this->className, $this->constructorArgs);
     
        return $output;
    }
    public function findByColumn($column, $value){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';
        $parameters = [
            'value' => $value
        ];
        
        $query = $this->pdoQuery($query, $parameters);
        $output = $query->fetchObject($this->className, $this->constructorArgs);
 
        return $output;
    }
    public function findByColumnAll($column, $value){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';
        $parameters = [
            'value' => $value
        ];
        
        $query = $this->pdoQuery($query, $parameters);
        $output = $query->fetchAll(\PDO::FETCH_CLASS,$this->className, $this->constructorArgs);
 
        return $output;
    }
    public function insert($insertColumn){
        $query = 'INSERT INTO `' . $this->table . '` SET ' ;
        
        foreach($insertColumn as $key => $value){
            $query .='`' . $key . '` = :' . $key . ','; 
        }
        
        $query = rtrim($query, ',');
        
        $this->pdoQuery($query, $insertColumn);
        
    }
    public function lastId(){
        $lastId = $this->pdo->lastInsertId();
        return $lastId;
        
    }
    public function update($updateColumn, $primaryKey){
        $query = 'UPDATE `' . $this->table . '` SET ';
      
        foreach($updateColumn as $key => $value){
            $query .= ' `' . $key . '` = :' . $key .',';    
        }
        $query = rtrim($query, ',');
        $query .= ' WHERE ' . $this->primaryKey . ' = ' . $primaryKey  ;
        
        $this->pdoQuery($query, $updateColumn);
    }
    public function delete($primaryKey, $value){
        $query = 'DELETE FROM `' . $this->table . '` WHERE `' . $primaryKey . '` = ' .$value;
       
        $this->pdoQuery($query);
    }
    
    public function innerJoin($innerTable){
        $query = 'SELECT * FROM `' . $this->table . '`';
            foreach($innerTable as $key => $value){
                $query .= ' INNER JOIN `' . $key . '` ON `' .
                $this->table . '` . `' . $value .
                '` = `' . $key . '` . `' . $value . '`';
            }
        
        $query = $this->pdoQuery($query);
        
        $query = $query->fetchAll();
        
        return $query;
    }
   
    
}




