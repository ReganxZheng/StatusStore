<?php
/*
 * poststatusprocess.php
 *
 * Copyright 2019 Frankie <frankie@frankie-GE60-2PE>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Post status processing</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.27" />
	<link rel ="stylesheet" href="style/style.css">
</head>
<h1>Post status processing</h1>
<body>
	<div class="topnav">
		<button type="button" name="button"><a href="index.html">Home</a></button>
		<button type="button" name="button"><a href="poststatusform.php">Posting</a></button>
		<button type="button" name="button"><a href="searchstatusform.html">Searching</a></button>
		<button type="button" name="button"><a href="about.html">About</a></button>
	</div>
	<div class="ex1">
	<?php
    include 'connectDB.php';
    $status_code=$_POST["status_code"];
    $statusName=$_POST["status_name"];
    $share=$_POST["share"];
    $day=$_POST["day"];
		//re-value the date in order to insert into database.
		$day_exp = explode("/",$day);
		$year = $day_exp[2];
		$mon = $day_exp[1];
		$day = $day_exp[0];
		//Validation for input date.
		if(!($mon>0 && $mon <13)) {
			echo "<p><strong>Invaild month input. Please check.</p>";
			echo "<br><a href ='poststatusform.php'>Try again</a>";
			exit();
		}
		else {
			//Validation for exact for input month.
			$daysOfMonth = cal_days_in_month(CAL_GREGORIAN,$mon,$year);
			if(!($day>0&&$day<=$daysOfMonth)){
				echo "<p><strong>Invaild day in this month. Please check.</p>";
				echo "<p><strong>There are only "."<span style='color:#fc0e0e'>".$daysOfMonth."</span> days in this month!<p>";
				echo "<br><a href ='poststatusform.php'>Try again</a>";
				exit();
			}
		}
		$day=$year."-".$mon."-".$day;
    $box=$_POST["box"];
    $conn = OpenCon();
    $box_str="";
		//Assign values into box array. The last one should not contain "/"
    for ($i=0;$i<sizeof($box);$i++) {
        if ($i==sizeof($box)-1) {
            $box_str.=$box[$i];
        } else {
            $box_str.=$box[$i]."/";
        }
    }
		//insertion query of database, and database existance is pre-checked in connectDB().
		$exist = $conn->query("SELECT 1 FROM STATUS_TABLE");
		if($exist!==FALSE) {
			//table checked! do nothing, continues to insert into database.
		} else {
			//if table is not exists, create table.
			$sql_create = "CREATE TABLE STATUS_TABLE (STATUS_CODE VARCHAR(5), STATUS_NAME VARCHAR(50), SHARE_S VARCHAR(30), DAY_S DATE, BOX_S VARCHAR(50))";
			$conn->query($sql_create);
		}
    $sql = "INSERT INTO STATUS_TABLE VALUES ('".$status_code."','".$statusName."','".$share."','".$day."','".$box_str."');";
		//Check if columu already exists in the database
    $sql_check = "SELECT * FROM STATUS_TABLE WHERE STATUS_CODE = '".$status_code."'";
    $result = $conn->query($sql_check);

		//If there is not a columu match user input, then insert new columu
    if ($result->num_rows==0) {
        if ($conn->query($sql)===true) {
            echo "<strong>Insert successfully!</strong>";
        } else {
            echo "Error: ".$sql."<br>".$conn->error;
        }
				echo "<br><br><table width='100%'> <tr> <td align='left'> <a href='poststatusform.php'>Post Another Status</a></td>";
        echo "<td align='right'><a href='index.html'>Return to Home page</a></td></tr>";
    } else {
        echo "<strong>Status Code already in the database!</strong>";
        echo "<br><strong size='large'>Please try another one!</strong>";
        echo "<br><br><a href='poststatusform.php'>Try another</a>";
    }
    closeCon($conn);
    ?>
	</div>
</body>

</html>
