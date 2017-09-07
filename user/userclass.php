<?php

class user
{
	public $id;
	public $name;
	public $email;
	public $password;
	public $phoneno;

  public function selectitemid()
	{
		$qry = "select id from user where email='$this->email'";
		$res = mysqli_query($conn,$qry);
    $ans = mysqli_affected_rows($res);
    if($ans<=0)
		{
			 return false;
		}
		else
		{
			$r = mysqli_fetch_row($res);
			$this->id = $r[0];
		}
		 return true;
	}
	public function delete()
	{
		$qry = "delete from user where id='$this->id'";
		$res = mysqli_query($conn,$qry);
    $ans = mysqli_affected_rows($res);
    if($ans<=0)
		{
			 return false;
		}
	  else
		  return true;
	}

	public function selectAll($conn)
	{
		$qry = "select * from user where email='$this->email'";
    $res = mysqli_query($conn,$qry);
    $ans = mysqli_affected_rows($conn);
    if($ans<=0)
		{
			 return false;
		}
		else
		{
			$r = mysqli_fetch_row($res);
			$this->id = $r[0];
			$this->name = $r[2];
			$this->password = $r[3];
			$this->phoneno = $r[4];
		}
		 return true;
	}
}
?>
