<?php
  class admin {
    public $id;
  	public $name;
  	public $email;
  	public $password;

    public function insert($conn)
  	{
  		$qry = "insert into admin (email,name,password)".
  			 " values('$this->email','$this->name','$this->password') ";
      $res = mysqli_query($conn,$qry);
      $ans = mysqli_affected_rows($conn);
      if($ans<=0){
        echo $qry;
        return false;
  		}
  		else
  		  return true;
  	}
    
  }
 ?>
