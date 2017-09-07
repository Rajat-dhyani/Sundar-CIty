<?php

class complaint
{
	public $id;
	public $userid;
	public $type;
	public $location;
	public $priority;
  public $complaint;
  public $imagepath;
  public $status;

	public function insert($conn)
	{
		$qry = "insert into complaint (user_id,`type`,location,priority,complaint,image_path,`status`)".
			 " values($this->userid,'$this->type','$this->location',$this->priority,'$this->complaint','$this->imagepath','$this->status') ";
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
