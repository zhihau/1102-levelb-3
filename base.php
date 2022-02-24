<?php

date_default_timezone_set('Asia/Taipei');
session_start();

class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=web02";
    private $root="root";
    private $pw="";
    private $table="";
    private $pdo;
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->pw);
    }
    private function jon($arg){
        $sql="";
        if(is_array($arg)){
            foreach($arg as $k=>$v){
                $tmp[]="`$k`='$v'";
            }
            $sql.="where ".join(" and ",$tmp);
        }else{
            $sql.="where `id`='$arg'";
        }
        return $sql;
    }
    private function chk($arg){
        $sql="";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
                $sql.=$this->jon($arg[0]);
            }else{
                $sql.=$arg[0];
            }
        }
        if(!empty($arg[1])){
            $sql.=" ".$arg[1];
        }
        return $sql;
    }

    public function all(...$arg){
        $sql="select * from $this->table ";
        $sql.=$this->chk($arg);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";
        $sql.=$this->chk($arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function find($arg){
        $sql="select * from $this->table ";
        $sql.=$this->jon($arg);
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function del($arg){
        $sql="delete from $this->table ";
        $sql.=$this->jon($arg);
        return $this->pdo->exec($sql);
    }
    public function q($arg){
        return $this->pdo->query($arg)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save($arg){
        $sql="";
        if(!empty($arg['id'])){
            foreach($arg as $k=>$v){
                if($k!='id')
                $tmp[]="`$k`='$v'";
            }
            $sql.=sprintf("update %s set %s where `id`='%s'",$this->table,join(",",$tmp),$arg['id']);
        }else{
$sql.=sprintf("insert into %s (`%s`) values ('%s')",$this->table,join("`,`",array_keys($arg)),join("','",$arg));
        }
        return $this->pdo->exec($sql);
    }
}
 function dd($arg){
     echo "<pre>";
     print_r($arg);
     echo "</pre>";
 }
 function to($arg){
     header('location:'.$arg);
 }
//  all math find del save q
$User=new DB('user');
$View=new DB('view');
$News=new DB('news');
$Que=new DB('que');
$Log=new DB('log');

// echo $User->save(['acc'=>'test3']);
// dd($User->all());
// $id=$User->math('max','id');
// echo $User->save(['id'=>$id,'acc'=>'test6']);
// dd($User->find(['id'=>$id]));

// echo $User->del($id);
// dd($User->q('select * from user'));

if(!isset($_SESSION['view'])){
    if($View->math('count','*',['date'=>date('Y-m-d')])>0){
$view=$View->find(['date'=>date('Y-m-d')]);
$view['total']++;
$View->save($view);
$_SESSION['view']=$view['total'];
}else{
    $View->save(['date'=>date('Y-m-d'),'total'=>1]);
    $_SESSION['view']=1;

    }
}