<?php
session_cache_expire(21);
session_start();
if($_SESSION['logado'] != 'weennn'){
	header('location: ../login');
}
?>