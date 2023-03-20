<!DOCTYPE html>
<html lang="en">
<head>
	<title>Magang SA-MWA 2018</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<style type="text/css">
		.alert {
			width: 100%;
			display: none;
		}
	</style>
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" id= "form-pendaftaran" name="pendaftaran">
					<span class="login100-form-title p-b-51">
						FORM PENDAFTARAN USER
					</span>

					<div class="alert alert-warning" role="alert">
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" id="username" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" id="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<select class="input100" id="status" name="status" required>
								<option value="Aktif">Aktif</option>
								<option value="Tidak Aktif">Tidak Aktif</option>
						</select>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn-new m-t-17">
						<button class="login100-form-btn-new" type="button" id="reset">
							New
						</button>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" type="button" id="add-user">
							Simpan
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>

	<?php
		// Get the db info
		require_once('db_info.php');

        // Connect to the DB
        require_once('db_connect.php');

		//Asign a query
		$query = " SELECT * FROM user";
		
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $db->error);
		}
	?>

	<div class="limiter" id="table-user">
		<div class="container-table100">
			<div class="wrap-table100">
					<div class="table">

						<div class="row header">
							<div class="cell" style="width:20%">
								Username
							</div>
							<div class="cell" style="width:30%">
								Password
							</div>
							<div class="cell" style="width:25%">
								Status
							</div>
							<div class="cell" style="width:25%">
								Aksi
							</div>
						</div>

						<tbody>
							<?php
								while ($row = $result->fetch_object()){
								echo '<div class="row">';
									echo '<div class="cell" data-title="Username">';
										echo '<td>'.$row->username.'</td> ';
									echo '</div>';
									echo '<div class="cell" data-title="Password">';
										echo '<td>'.$row->password.'</td> ';
									echo '</div>';
									echo '<div class="cell" data-title="Status">';
										echo '<td>'.$row->status.'</td> ';
									echo '</div>';
									echo '<div class="cell" data-title="Aksi">';
										echo '<td>'.$row->status.'</td> ';
									echo '</div>';
								echo '</div>';
								}
							?>
						</tbody>
					</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<script type="text/javascript">

		// Wait until the document fully loaded
		$(document).ready(function() {

			// Add user
			$("#add-user").click(function() {
				// Get the form element
				const form = document.getElementById("form-pendaftaran");
				
				// Check form validity (all input should be filled)
				if (form.checkValidity()) {

					// Send request to the API
					$.ajax({
						type: "POST",
						url: "api/add_user.php",
						data: $("#form-pendaftaran").serialize(),
						success: function(data) {

							// Display an success message if data already added
							$(".alert").text("Data berhasil ditambahkan")
							$(".alert").css('display', 'block')

							// Refresh the table content
							$.ajax({
								type: "GET",
								url: "api/get_all_user.php",
    							dataType: 'json',
								success: function(data) {

									// Clear the table
									var $table = $('.table');
									$table.empty();

									// Add the header
									$table.append(`
										<div class="row header">
											<div class="cell" style="width:20%">
												Username
											</div>
											<div class="cell" style="width:30%">
												Password
											</div>
											<div class="cell" style="width:25%">
												Status
											</div>
											<div class="cell" style="width:25%">
												Aksi
											</div>
										</div>
									`)

									// Add the body
									for (i = 0; i < data.length ; i++) {
										console.log(data[i])
										$table.append(`
											<div class="row">
												<div class="cell" data-title="Username">
													<td>${data[i]['username']}</td>
												</div>
												<div class="cell" data-title="Password">
													<td>${data[i]['password']}</td>
												</div>
												<div class="cell" data-title="Status">
													<td>${data[i]['status']}</td>
												</div>
												<div class="cell" data-title="Aksi">
													<td>${data[i]['status']}</td>
												</div>
											</div>
										`)
									}
								}
							});
						},
						error: function() {

							// Display an error message if adding data failed
							$(".alert").text("Data gagal ditambahkan");
							$(".alert").css('display', 'block')
						}
					});
				} else {

					// Display an error message if any required fields are missing
					$(".alert").text("Lengkapi formulir terlebih dahulu")
					$(".alert").css('display', 'block')
				}
			});

			// Clear the form
			$("#reset").click(function() {
				$("#username").val('')
				$("#password").val('')
				$(".alert").text("Form pendaftaran berhasil di-reset")
			});

	    });
	</script>

</body>
</html>