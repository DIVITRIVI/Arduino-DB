<?php
	Class dbObj{
		/* Database connection start */
		var $dbhost = "localhost";
		var $username = "root";
		var $password = "";
		var $dbname = "ardbd";
		var $conn;
		function getConnstring() {
			$con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());
			 
			/* check connection */
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			} else {
				$this->conn = $con;
			}
			return $this->conn;
		}
	}
?>