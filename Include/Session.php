<?php
class Session{


public function __construct(){
		session_start();
}

public function inputSession($nom_enreg,$val_parm)
{
$_SESSION[$nom_enreg]=$val_parm;
}

public function outSession($nom_parm){
return $_SESSION[$nom_parm];
}
public  function  detruire ()
{
	session_destroy();
}
	public function detruirevariable ($param)
	{
		unset($_SESSION[$param]);
	}
public function verifexistence ($param)
{
	if (isset($_SESSION[$param]))
	{
		return true;
	}
	return false;
}
}

$session=new Session();


?>