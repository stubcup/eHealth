<?php include ('connect1.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Schedule </title>
	<meta name="viewport" content="width:device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="tbStyle.css">
        <link rel="stylesheet" type="text/css" href="style1.css">
		<link rel = "stylesheet" type = "text/css" href = "styleX.css" />
		<link rel="stylesheet" type="text/css" href="xCSS/css/all.css">
                <link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
                
   
</head>
<body>
    <ul class="nav">
            
			
            
        <li><a href="admin_dashboard.php"><<</a></li>
            
            
            <li><a href="logout_adm.php"> <i class="fas fa-power-off"></i> Logout</a></li>
          
        </ul>
    <div class="header">
		<h2>Appointments</h2>
	</div>
    <br>
   
<table align="center">
	<thead>
            <tr>
		<th>ID</th>
                <th>Time</th>
                <th>Date</th>
                <th>ID Number</th>
		<th>Name</th>
                <th>Surname</th>
                <th>Contact</th>
                <th>Purpose</th>
          
                
            </tr>
	</thead>
	<tbody>
            <?php  
		$query = $conn->query("SELECT * FROM booking") or die(mysqli_error());
		while($fetch = $query->fetch_array()){
            ?>
						
                <tr>
                    <td><?php echo $fetch['book_id']?></td>
                    <td><?php echo $fetch['b_time']?></td>
                    <td><?php echo $fetch['b_date']?></td>
                    <td><?php echo ($fetch['b_id'])?></td>
                    <td><?php echo $fetch['b_name']?></td>
                    <td><?php echo $fetch['b_surname']?></td>
                    <td><?php echo $fetch['b_contact']?></td>
                    <td><?php echo ($fetch['purpose'])?></td>
                    
							
		</tr>
		<?php
		}
		?>
                
                
	</tbody>
</table>
     <style>
         .header {
	
	
	color: black;
	
	text-align: center;
	
	
}
        .img{
    text-align: center;
    background-color: black;
 
    position: relative;
}


.Logged{
	font-family:calibri;
	font-weight:bold;
	font-size:26px;
	color:white;
	background-color:green;
	padding:8px;
}
.cust{
	position:absolute;
	background:#fff;
	margin-right:18px;
	
}
.head1{


	color: white;
	background: blue;
	text-align: left;
	
	border-bottom: none;
	font-size:20px;


	float:left;
	

}



.nav{
	color:black;
    background:lightblue;
 
    
    list-style: none;
    text-align: right;
    padding: 19px ;
	
   
        
}
.nav>li{
    
    display: inline-block;
    padding: 0 10px 0 10px;
	font-family:calibri;
	text-align:right;
	font-size:18px;
	margin-left:5px;
	line-height:20px;
	height:20px;
	
      
}
.nav>li>a{
    text-decoration: none;
    color:black;
	text-align:right;
	float:right;
	display:block;
	padding-right:8px;
	padding-left:8px;

}
.nav>li>a:hover{
    color: white;
    background-color: white;
	

	margin-top:0px;
	border-radius: 20px 20px 20px 20px;
	padding: 8px;
	top:50%;
   
      
}




.image{
  position: relative;
    
}
.text-block{
    position: absolute;
    bottom: 20px;
    right: 20px;
    background-color: transparent;
    color: white;
    padding-left: 20px;
    padding-right: 20px;
    
 
}
table{
    border-collapse: collapse;
    width: 100%;
    border: 2px solid lightblue;
   
    
}
th{
    height: 100%;
    
    background-color: lightblue;
    color: black;
    padding: 10px;
 
}
td{
    height: 100%;
    border: 2px solid lightblue;
    padding: 9px;
 
}
table.center{
    
    margin-left: auto;
    margin-right: auto;
}
     </style>
    
</body>
</html>