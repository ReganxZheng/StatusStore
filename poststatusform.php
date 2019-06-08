<!--
   poststatusform.html

   Copyright 2019 Frankie <frankie@frankie-GE60-2PE>

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
   MA 02110-1301, USA.


-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Post Status Form</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.27" />
	<link rel ="stylesheet" href = "style/style.css">
	<style>
		table, th, td {
				text-align:left;
		}
	</style>
</head>
<body>
	<div class="header">
		<h1>Status Posting System</h1>
	</div>
	<div class="topnav">
		<button type="button" name="button"><a href="index.html">Home</a></button>
		<button type="button" name="button"><a href="poststatusform.php">Posting</a></button>
		<button type="button" name="button"><a href="searchstatusform.html">Searching</a></button>
		<button type="button" name="button"><a href="about.html">About</a></button>
	</div>
	<form action="poststatusprocess.php" method="post">
	<div class="ex1">
		<table style="width:100%">
			<tr>
			<td>Status Code(required):</td>
			<!-- Pattern restricted user has to input S and 4 Integer as STATUS_CODE -->
			<td><input type="text" required="" size="15" maxlength="5" pattern="[S]+[0-9]{4}" title="Must start with S" name="status_code" placeholder="S####"></td>
			</tr>
			<tr>
			<td>Status(required):</td>
			<!-- Pattern restricted input can't contains any symbols except allowed one  -->
			<td><input type="text" required="" size="40" pattern="[A-Za-z0-9!?,.\s]*" title="Invaild symbols" name="status_name"</td>
			</tr>
		</table>
	<br>
	<table style="width:90%">
		<tr>
			<td>Share: </td>
			<td>
				<input type="radio" name="share" value="Public">Public
				<input type="radio" name="share" value="Friends">Friends
				<input type="radio" name="share" value="Only Me">Only me
			</td>
		</tr>
		<tr>
			<td>Date: </td>
			<td>
				<!-- Raw pattern that can verify whether the month is bewteen 1-12 but the day of month is exclusive -->
				<input type="datetime" required name="day" placeholder="DD/MM/YYYY" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
				value="<?php  echo date('d/m/Y')?>"  title="Invaild date formate. Must follow (DD/MM/YYYY)"
				>
			</td>
		</tr>
		<tr>
			<td>Permission Type: </td>
			<td>
				<input type="checkbox" name="box[]" value="Like">Allow Like
				<input type="checkbox" name="box[]" value="Comment">Allow Comment
				<input type="checkbox" name="box[]" value="Share">Allow Share
			</td>
		</tr>
	</table><br>

	<input type="submit" class="btn btn-primary" name="post" value="Post">
	<input type="reset"  class="btn btn-primary" value="Reset">

	<br><br>
	<a href ="index.html">Return to Home Page</a>

	</div>
	</form>
</body>

</html>
