<?php
	//Import the Database configurations
	include("db-connection.php");

	//Official Link on tool labs server
	$LINK_TL = "tools.wmflabs.org/durl-shortener";

	//Official Link on localhost server
	$LINK_LH = "localhost:3000/shortener.php";

	//make sure the post is parsed and data is gotten
	if(isset($_POST['link']) && !empty($_POST['link'])) {
		$long_link = $_POST['link'];
		$hash = substr(strtolower(preg_replace('/[0-9_\/]+/','', base64_encode(sha1($long_link)))),0,8);

		$short_link = $LINK_LH . '/shortener.php/' . $hash;

		$query = "INSERT INTO urls (id, short_url, long_url) VALUES ('', '$short_link', '$long_link');";

		$res = mysql_query($query);

		if(!$res) {
			die("Error running query" . mysql_error());
		}

        echo json_encode(array("shortUrl"=>$short_link, "hash"=>$hash));
    }