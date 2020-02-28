<?php include ('connect.php');?>
<?php include('create_appointment_process.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Appointment</title>
	<meta name="viewport" content="width:device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="style1.css">
		<link rel = "stylesheet" type = "text/css" href = "styleX.css" />
		<link rel="stylesheet" type="text/css" href="xCSS/css/all.css">

   
</head>
<body>
   
	
                
   
                <div class="header">
		<h2>Make Appointment</h2>
	</div>
    
    
    <form method="post" action="create_appointment.php">
        <?php include('errors111.php'); ?>
        <div class="input-group111">
			<label>Appointment Time</label>
                        <select name="b_time">
                            <option>09:00</option>
                            <option>09:15</option> 
                            <option>09:30</option> 
                            <option>09:45</option> 
                            <option>10:00</option> 
                            <option>10:15</option>
                            <option>10:30</option> 
                            <option>10:45</option>
                            <option>11:00</option> 
                            <option>11:15</option> 
                            <option>11:30</option> 
                            <option>11:45</option> 
                            <option>12:00</option>
                            <option>14:00</option>
                            <option>14:15</option>
                            <option>14:30</option>
                            <option>14:45</option>
                            <option>15:00</option>
                            <option>15:15</option>
                            <option>15:30</option>
                            <option>15:45</option>
                            <option>16:00</option>
                            <option>16:15</option>
                            <option>16:30</option>
                            
                            
                        
                            
                        </select>
		</div>
    
                <div class="input-group">
			<label>Appointment Date</label>
                        <input type="date" name="date">
		</div>
                
                
                 <div class="input-group">
			<label>Name</label>
                        <input type="text" name="name" >
		</div>
                <div class="input-group">
			<label>Surname</label>
			<input type="text" name="sname" >
		</div>
                <div class="input-group">
			<label>Patient ID</label>
			<input type="text" name="id_num">
		</div>
                <div class="input-group">
			<label>CellPhone Number</label>
			<input type="text" name="contact" >
		</div>
                <div class="input-group">
			<label>Reason for visit</label>
                        <input type="text" name="purpose" >
		</div>
                <div class="input-group">
                    <button type="submit" class="btn111" name="create_appointment">Create Appointment</button>
		</div>
        <a href="index.php">go back to home page</a>
        
                </form>
                
               
                <style>
                    body {
	font-size: 125%;
	 background: url('300.jpeg') no-repeat;
    background-size: cover;
    font-family: Arial;
       
 


}
                            
            
.head{
width: 100%;
	
	color: white;
	background:lightblue;
	text-align: center;
	border: 2px solid #B0C4DE;
	border-bottom: none;
	border-radius: 0px 00px 0px 0px;
	padding: 10px;
	

}
* {
	margin: 0px;
	padding: 0px;
}
body {
	font-size: 125%;
	 background: url('300.jpeg') no-repeat;
    background-size: cover;
    font-family: Arial;
       
 


}
.backback{
    font-size: 15px;
}

.header {
	width: 25%;
	margin: 50px auto 0px;
	color: black;
	background: lightblue;
	text-align: center;
	border: 5px solid lightblue;
	border-bottom: none;
	border-radius: 11px 11px 0px 0px;
	padding: 20px;
}
form, .content {
	color:black;
	font-size:20px;
	width: 25%;
	margin: 0px auto;
	padding: 20px;
	border: 5px solid lightblue;
	background: silver;
	border-radius: 0px 0px 0px 0px;
	
}
.input-group {
	margin: 10px 0px 10px 0px;
	
}

.input-group label {
	display: block;
	text-align: left;
	margin: 5px;
}
.input-group input {
	
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 0px;
	border: 1px solid gray;
}
.btn111 {
	padding: 10px;
	font-size: 15px;
	color: black;
	background: lightblue;
	border: none;
	border-radius: 5px;
        text-align: center;
}
.error {
	width: 92%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid white; 
	color: red; 
	background: white; 
	border-radius: 5px; 
	text-align: left;
}
.success {
	color: #3c763d; 
	background: #dff0d8; 
	border: 1px solid #3c763d;
	margin-bottom: 20px;
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
	color:white;
    background:blue;
 
    
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
    color:white;
	text-align:right;
	float:right;
	display:block;
	padding-right:8px;
	padding-left:8px;

}
.nav>li>a:hover{
    color: white;
    background-color: black;
	

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
                    .btn {
                        padding: 10px;
                        font-size: 15px;
                        color: white;
                        background: black;
                        border: none;
                        border-radius: 5px;
                    }
                        
                        .book{
                        color:red;
                        font-size:20px;
                        width: 45%;
                        margin: 0px auto;
                        padding: 30px;
                        border: 2px solid black;
                        background: gray;
                        border-radius: 0px 0px 0px 0px;
                        }
                        .bookIMG{
                            text-align: center;
                            background: black;
                        }
                        .input-group111 label {
	display: block;
	text-align: left;
	margin: 5px;
}
                        .input-group111 select{
	
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 0px;
	border: 1px solid gray;
}
	

                </style>
</body>

</html>