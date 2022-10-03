<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
				<span class="login100-form-title p-b-26">
					Welcome Dominican
				</span>
				<span class="login100-form-title p-b-48">
					<i class="zmdi zmdi-pin-account"></i>
				</span>

				<form action="<?= base_url("index.php/login/loginprocess"); ?>" method="post" id="formlogin">

					<div class="wrap-input100 validate-input" data-validate="Email must be Registered">
						<input class="input100" type="text" name="email" required>
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" required>
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				</form>
		</div>
	</div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<!-- <script src="<?= base_url() ?>loginassets/vendor/jquery/jquery-3.2.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>loginassets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>loginassets/vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url() ?>loginassets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>loginassets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>loginassets/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url() ?>loginassets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>loginassets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>loginassets/js/main.js"></script>

<script>
	$("#loginsubmit").on("click", function(){
	$("#formlogin").submit()
	
	})
	$("#loginsubmit").on("submit", function(){
	
	})
</script>