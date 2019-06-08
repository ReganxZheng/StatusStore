<?php
/*
 * searchstatusprocess.php
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
	<title>Search Status Process</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.27" />
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style>
		table t1{
			text-align:left;
		}
		th{
			text-align:left;
		}
		td {
			color:#1c5bf0;
		}
	</style>
</head>
<h1>Search for status</h1>
<body>
	<div class="ex1">
	<?php
    include 'connectDB.php';
    $conn_s = OpenCon();
    $statusName_s = $_GET["search"];
    $sql = "SELECT * FROM STATUS_TABLE WHERE STATUS_NAME LIKE '%". $statusName_s."%'";
    $result = $conn_s->query($sql);
    $str_together="";
    if ($result->num_rows>0) {
        //States how many results has found in database
        $count = 1;
        echo "<table class='table table-hover table-striped' width='60%'>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
					<th>Result: </th>
					<th>".$count."</th>
				</tr>";
            echo "<tr><td>Status: </td><td>". $row["STATUS_NAME"]."</td></tr>";
            echo "<tr><td>Status Code: </td><td>". $row["STATUS_CODE"]."</td></tr>";
            echo "<tr><td>Share: </td><td>". $row["SHARE_S"]."</td></tr>";
            $str_typecast = (String)$row["DAY_S"];
						//Explode array into sub_array thereby to change Integer month into String.
            $days_arr = explode("-", (String)$str_typecast);
            $str_day=$days_arr[2];
            $str_mon=$days_arr[1];
            $str_year=$days_arr[0];
            switch ($str_mon) {
                case "1": $str_mon="January"; break;
                case "2": $str_mon="February"; break;
                case "3": $str_mon="March"; break;
                case "4": $str_mon="April"; break;
                case "5": $str_mon="May"; break;
                case "6": $str_mon="June"; break;
                case "7": $str_mon="July"; break;
                case "8": $str_mon="August"; break;
                case "9": $str_mon="September"; break;
                case "10": $str_mon="October"; break;
                case "11": $str_mon="November"; break;
                case "12": $str_mon="December"; break;
            }
            $str_together=$str_mon." ".$str_day.", ".$str_year;
            echo "<tr><td>Date Posted: </td><td>". $str_together."</td></tr>";
            $permission = "Allow ";
            $permission .= str_replace("/", " and ", $row["BOX_S"]);
            echo "<tr><td>Permission: </td><td>". $permission."</td></tr>";
            $count++;
        }
        echo "</table>";
    } else {
        echo "<strong>Status is <span style='color:#fc0e0e'>NOT FOUND</span> in database, try again!<br>";
    }

    CloseCon($conn_s);

    ?>
	<br><table width="100%">
		<tr>
			<td align="left"><a href="searchstatusform.html">Serach Another Status</a></td>
			<td align="right"><a href="index.html">Return to Home Page</a></td>
		</tr>

	</table>
	</div>
</body>

</html>
