<?php 
	
	include 'library/global.php';


	$password = 'pass@word1';

	$glb = new globalLibrary();


	echo $glb->encrypt_decrypt('encrypt',$password, 'password') .'</br>'; 
	echo $glb->encrypt_decrypt('decrypt','vQBYqqTWtf6pD-hRRfqtIs_kV_zBkizD_CLH5IA_re_zQJQe38iYD0hxgK-vyMqWAafvoVJ3N3nkZANfE-w2uA==', 'password'); 


?>