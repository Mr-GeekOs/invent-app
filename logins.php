<?php session_start();
	
	include_once"modules/general/parametre-db.inc.php";
	$logs = trim( strip_tags( html_entity_decode( addslashes( @$_POST['uemail'] ) , ENT_QUOTES) ) );
	$pass = trim( strip_tags( html_entity_decode( addslashes( @$_POST['upw'] ) , ENT_QUOTES) ) );
	
	$result = mysql_query("SELECT * FROM admin WHERE email = '$logs' AND psswd = '$pass'");
	$membre = mysql_fetch_assoc($result);
	
	
	if (($logs=="") || ($pass=="")) { $url_id = "index.html"; header("Location:$url_id"); }
	
	else if(($logs==$membre['email'])&&($pass==$membre['psswd']))
	{
		if ($membre['acces']==1)
		{
			$_SESSION['email']='brahim@gsm.com';
			$_SESSION['iduser']='44';
			$_SESSION['nom']='brahim team';
		}
		else
		{
			$_SESSION['email']=$membre['email'];
			$_SESSION['iduser']=$membre['id_adm'];
			$_SESSION['nom']=$membre['nom'];
		}
		$url_id = "dashboard.php"; header("Location:$url_id");
	}

	else { $url_id = "index.html"; header("Location:$url_id"); }

?>
