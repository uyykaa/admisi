<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// database connection
include('config.php');

$added = false;


//Add  new student code 

if(isset($_POST['submit'])){
	$u_card = $_POST['card_no'];
	$u_f_name = $_POST['user_first_name'];
	$u_l_name = $_POST['user_last_name'];
	$u_father = $_POST['user_father'];
	$u_birthday = $_POST['user_dob'];
	$u_gender = $_POST['user_gender'];
	$u_email = $_POST['user_email'];
	$u_phone = $_POST['user_phone'];
	$u_state = $_POST['state'];
	$u_dist = $_POST['dist'];
	$u_village = $_POST['village'];
	$u_pincode = $_POST['pincode'];
	$u_mother = $_POST['user_mother'];
	$u_staff_id = $_POST['staff_id'];
	


	//image upload

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO student_data(u_card, u_f_name, u_l_name, u_father, u_birthday, u_gender, u_email, u_phone, u_state, u_dist, u_village, u_pincode, u_mother, staff_id,image,uploaded) VALUES ('$u_card','$u_f_name','$u_l_name','$u_father','$u_birthday','$u_gender','$u_email','$u_phone','$u_state','$u_dist','$u_village','$u_pincode','$u_mother','$u_staff_id','$image',NOW())";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
		  $added = true;
  	}else{
  		echo "Data not insert";
  	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<style>
		.center {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 25%;	
		}
    </style>

	<div class="container">
		<br>
<a href="index.php" target="_blank"><img src="upload_images/utdi-3A.png" alt="" width="250px" class="center"></a><br><hr>

<!-- adding alert notification  -->
<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				Data Mahasiswa berhasil ditambahkan!
			</div><br>
		";
	}

?>

	<a href="logout.php" class="btn btn-success"><i class="fa fa-sign-out"></i> Keluar </a>
	<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Tambah Data
  </button>
  <hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">No.</th>
				<th class="text-center" scope="col">Nama</th>
				<th class="text-center" scope="col">NIM</th>
				<th class="text-center" scope="col">No. Handphone</th>
				<th class="text-center" scope="col">Admin</th>
				<th class="text-center" scope="col">Foto</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php

        	$get_data = "SELECT * FROM student_data order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$u_card = $row['u_card'];
				$u_f_name = $row['u_f_name'];
				$u_l_name = $row['u_l_name'];
				$u_phone = $row['u_phone'];
				$u_staff_id = $row['staff_id'];

        		$image = $row['image'];

        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$u_f_name   $u_l_name</td>
				<td class='text-left'>$u_card</td>
				<td class='text-left'>$u_phone</td>
				<td class='text-center'>$u_staff_id</td>
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>

					     
					    
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>


        		";
        	}

        	?>

			
			
		</table>
	</div>


	<!---Add in modal---->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
    
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
			
			<!-- This is test for New Card Activate Form  -->
			<!-- This is Address with email id  -->
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">NIM</label>
<input type="text" class="form-control" name="card_no" placeholder="Masukkan 9 digit NIM" maxlength="12" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">No Handphone</label>
<input type="phone" class="form-control" name="user_phone" placeholder="Masukkan 12 digit No. Handphone" maxlength="12" required>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">Nama Depan</label>
<input type="text" class="form-control" name="user_first_name" placeholder="Masukkan nama depan">
</div>
<div class="form-group col-md-6">
<label for="lastname">Nama Belakang</label>
<input type="text" class="form-control" name="user_last_name" placeholder="Masukkan nama belakang">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="fathername">Nama Ayah</label>
<input type="text" class="form-control" name="user_father" placeholder="Masukkan nama Ayah">
</div>
<div class="form-group col-md-6">
<label for="mothername">Nama Ibu</label>
<input type="text" class="form-control" name="user_mother" placeholder="Masukkan nama Ibu">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="email">Alamat Email</label>
<input type="email" class="form-control" name="user_email" placeholder="Masukkan alamat email">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Jenis Kelamin</label>
<select id="inputState" name="user_gender" class="form-control">
  <option selected>Pilih...</option>
  <option>Laki - Laki</option>
  <option>Perempuan</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Tanggal Lahir</label>
<input type="date" class="form-control" name="user_dob" placeholder="Masukkan tanggal lahir">
</div>
</div>

<div class="form-group col-md-6">
<label for="inputAddress">Desa</label>
<input type="text" class="form-control" name="village">
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputCity">Kecamatan</label>
<input type="text" class="form-control" name="dist">
</div>
<div class="form-group col-md-3">
<label for="inputState">Kota</label>
<input type="text" class="form-control" name="state">
</div>
<div class="form-group col-md-3">
<label for="inputZip">Kode Pos</label>
<input type="text" class="form-control" name="pincode">
</div>
</div>


<div class="form-group col-md-12">
<label for="inputAddress">ID Admin</label>
<input type="text" class="form-control" name="staff_id" maxlength="12" placeholder="Masukkan ID Admin">
</div>
		

<div class="form-group col-md-12">
<label>Image</label>
<input type="file" name="image" class="form-control" >
</div>

<div class="form-group col-md-2">
	<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
</div>
<div>
	<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
</div>

</form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>


<!------DELETE modal---->


<!-- Modal -->
<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>Apakah Anda yakin?</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Hapus</a>
      </div>
      
    </div>

  </div>
</div>


	";
	
}


?>


<!-- View modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$Bday = $row['u_birthday'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$village = $row['u_village'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$time = $row['uploaded'];
	
	$image = $row['image'];
	echo "

		<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title' id='exampleModalLabel'>Profile <i class='fa fa-user-circle-o' aria-hidden='true'></i></h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class='modal-body'>
			<div class='container' id='profile'> 
				<div class='row'>
					<div class='col-sm-4 col-md-2'>
						<img src='upload_images/$image' alt='' style='width: 150px; height: 150px;' ><br>
		
						<i class='fa fa-id-card' aria-hidden='true'></i> $card<br>
						<i class='fa fa-phone' aria-hidden='true'></i> $phone  <br>
						Issue Date : $time
					</div>
					<div class='col-sm-3 col-md-6'>
						<h3 class='text-primary'>$name $name2</h3>
						<p class='text-secondary'>
						<strong>S/O :</strong> $father <br>
						<strong>M/O :</strong>$mother <br>
						<i class='fa fa-venus-mars' aria-hidden='true'></i> $gender
						<br />
						<i class='fa fa-envelope-o' aria-hidden='true'></i> $email
						<br />
						<i class='fa fa-home' aria-hidden='true'> Alamat : </i> $village, <br> $dist, $state - $pincode
						<br />
						</p>
						<!-- Split button -->
					</div>
				</div>

			</div>   
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Keluar</button>
			</div>
			</form>
			</div>
		</div>
		</div> 


    ";
}


// <!-- profile modal end -->


?>



<!----edit Data--->

<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$Bday = $row['u_birthday'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$village = $row['u_village'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$staffCard = $row['staff_id'];
	$time = $row['uploaded'];
	$image = $row['image'];
	echo "

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header' col-md-3>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title text-center'>Ubah data Mahasiswa</h4> 
      </div>

      <div class='modal-body'>
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>

		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputEmail4'>NIM</label>
		<input type='text' class='form-control' name='card_no' placeholder='Masukkan 9 digit NIM' maxlength='12' value='$card' required>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>No Handphone</label>
		<input type='phone' class='form-control' name='user_phone' placeholder='Masukkan 12 digit No. Handphone' maxlength='12' value='$phone' required>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='firstname'>Nama Depan</label>
		<input type='text' class='form-control' name='user_first_name' placeholder='Masukkan nama depan' value='$name'>
		</div>
		<div class='form-group col-md-6'>
		<label for='lastname'>Nama Belakang</label>
		<input type='text' class='form-control' name='user_last_name' placeholder='Masukkan nama belakang' value='$name2'>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='fathername'>Nama Ayah</label>
		<input type='text' class='form-control' name='user_father' placeholder='Masukkan nama Ayah' value='$father'>
		</div>
		<div class='form-group col-md-6'>
		<label for='mothername'>Nama Ibu</label>
		<input type='text' class='form-control' name='user_mother' placeholder='Masukkan nama Ibu' value='$mother'>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='email'>Alamat Email</label>
		<input type='email' class='form-control' name='user_email' placeholder='Masukkan alamat email' value='$email'>
		</div>
		</div>
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputState'>Jenis Kelamin</label>
		<select id='inputState' name='user_gender' class='form-control' value='$gender'>
		  <option selected>$gender</option>
		  <option>Laki - Laki</option>
		  <option>Perempuan</option>
		</select>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Tangga Lahir</label>
		<input type='date' class='form-control' name='user_dob' value='$Bday'>
		</div>
		</div>
		
		<div class='form-group col-md-6'>
		<label for='inputAddress'>Desa</label>
		<input type='text' class='form-control' name='village' value='$village'>
		</div>
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputCity'>Kecamatan</label>
		<input type='text' class='form-control' name='dist' value='$dist'>
		</div>
		<div class='form-group col-md-3'>
		<label for='inputState'>Kota</label>
		<input type='text' class='form-control' name='state'>
		</div>
		<div class='form-group col-md-3'>
		<label for='inputZip'>Kode Pos</label>
		<input type='text' class='form-control' name='pincode' value='$pincode'>
		</div>
		</div>
		
		
		<div class='form-group col-md-12'>
		<label for='inputAddress'>ID Admin</label>
		<input type='text' class='form-control' name='staff_id' maxlength='12' placeholder='Masukkan ID Admin' value='$staffCard'>
		</div>
        	

        	<div class='form-group col-md-12'>
        		<label>Image</label>
        		<input type='file' name='image' class='form-control'>
        		<img src = 'upload_images/$image' style='width:50px; height:50px'>
        	</div>

			<div class='form-group col-md-2'>
				<input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
			</div>
			<div>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Keluar</button>
			</div>			 
		 </div>
        </form>
		<div class='modal-footer'>

      </div>

    </div>

  </div>
</div>


	";
}


?>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>