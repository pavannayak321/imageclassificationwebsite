<html>
<head>

<style>
tr,th,td
{
	border:2px solid grey;
	
}
#inputtable
{
	border:2px solid grey;
}

#fileuploadtr
{
width:234px;
height:44px;
}
#labelfile
{
	width:234px;
}

#userreset
{
	width:123px;
}

#fileuploader
{
	text-align:center;
	width:123%;
	/*border:5px;*/
}
</style>

	</head>
	<!--welcome-heading-->
	
	<body>
		<h1 align="center" color="grey">PLEASE UPLOAD YOUR IMAGE FOR CLASSIFICATION </h1>


		<!--table for insertion of data-->
		<form method="post"  action="?" enctype="multipart/form-data">
		<table align="center" id="inputtable">
			<!--input file from user-->
			<tr > 
			<td colspan="2" id="fileuploader">
			<input type="file"  required name="file" value="fileupload" >
			</td>
			</tr>

			<!--taking roll number from user-->
			<tr>
			<th style="text-align:right; ">Enter Roll_Number:
			</th>

			<td >
			<input type="text"  required name="roll">
			</td>
			</tr>
			<!--taking user caption-->
			<tr>
			<th style="text-align:right; ">
			<p6>Enter Caption:</p6>
			</th>
			<td>
			<input type="text"  required name="caption">

			</td>
			</tr>
			
			<tr>
			<!--reset detais-->
			<td style="text-align:right;">
				<input   type="reset" name="reset">
			</td>
			<!--submit form-->
			<td id="usersubmit">
				<input type="submit" name="submit">
			</td>
		</tr>

		</table>
	</form>
		
			
		
	</body>
	</html>


	<?php
	if(isset($_POST['submit']))
	{
		
		$fname=$_FILES['file']['name'];
		//roll number 
		$rollnumber=$_POST['roll'];
		//caption
		$caption=$_POST['caption'];

		$tempname=$_FILES['file']['tmp_name'];

		/* creating the temporary folder for the uploading images */
		$folder="img/".$fname;
		//get all the submitted data from the form 
		$image=$_FILES['file']['name'];

		//moving uploaded file to anoother folder
		if(move_uploaded_file($tempname,$folder))
		{
			$msg= "image uploaded succefully";
		}
		else
		{
			$msg="there was a problem uploading image";
		}


		//connecting to the database 
		$servername="localhost";
		$username="root";
		$password="";
		$dbname="student";

		//create connection

		$conn=new mysqli($servername,$username,$password,$dbname);

		//check connection
		if($conn->connect_error)
		{
			die ("coonnection failed".$conn->connect_error);
		}
		else
		{
			echo "connected succefully";
		}
		

		$sql="INSERT INTO `images`(`id`, `image`, `rollnumber`, `caption`) VALUES ('','$folder','$rollnumber','$caption') ";
		
		if($conn->query($sql)==TRUE)
		{
			echo "new record created succefully";
		}
		else
		{
			echo "error:".$sql."<br>".$conn->error;
		}
		$conn->close();

		
		
	}