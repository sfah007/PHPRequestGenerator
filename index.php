<?php
//Script Author: ᴛɪᴋᴏʟ4ʟɪғᴇ https://t.me/Tikol4Life
	include 'config.php';
	/*if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))	{
	   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	   header('HTTP/1.1 301 Moved Permanently');
	   header('Location: ' . $redirect);
	   exit();
	}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- BASIC DATA -->
	<meta charset="utf-8">
	<title><?php echo $site_name;?></title>
	<meta name="author" content="<?php echo $owner ?>">
	<link rel="icon" href="<?php echo $site_icon; ?>" type="image/png">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $owner ?> CC Checker">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body style="background: #212121;">
	<audio id="click" src="assets/sfx/click.mp3"></audio>
	<audio id="error" src="assets/sfx/error.mp3"></audio>
	<audio id="success" src="assets/sfx/success.mp3"></audio>
	<div class="container" id="container">
		<!-- START OF IMAGE HEADER -->
		<div class="row justify-content-md-center">
			<div class="col-md">
				<center>
					<img class="rounded-circle" src="<?php echo $site_icon; ?>" width="200" height="200" style="margin-top: 40px;">
				</center>
			</div>
		</div>
		<!-- END OF IMAGE HEADER -->
		<!-- START OF FORMS -->
		<div class="row justify-content-md-center" style="margin-top: 40px;">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form>
					<div class="form-group">
						<label for="r_url" style="color: #FFFFFF; margin-left: 20px">Request URL</label>
						<input type="text" class="form-control" style="background: transparent;color: #FFFFFF;" id="r_url" aria-describedby="r_url" placeholder="https://abc.com/">
					</div>
					<div class="form-group">
						<label for="r_method" style="color: #FFFFFF; margin-left: 20px">Request Method</label>
						<div class="input-group mb-3 ">
							<select class="form-control" id="r_method" style="background: transparent;color: #FFFFFF;">
								<option style="background: #212121" value="POST">POST</option>
								<option style="background: #212121" value="GET">GET</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="r_headers" style="color: #FFFFFF; margin-left: 20px">Request Headers</label>
						<textarea class="form-control" style="background: transparent;color: #FFFFFF;overflow:hidden" id="r_headers" rows="4"  required></textarea>
					</div>
					<div class="form-group">
						<label for="r_formdata" style="color: #FFFFFF; margin-left: 20px">Form Data</label>
						<textarea class="form-control" style="background: transparent;color: #FFFFFF;overflow:hidden" id="r_formdata" rows="4" required></textarea>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<button  type="button" class="btn btn-outline-danger btn-block" onclick="save();">TEST</button>
							</div>
							<div class="col-6">
								<button  type="button" class="btn btn-outline-danger btn-block" onclick="generate();">GENERATE</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="r_results" style="color: #FFFFFF; margin-left: 20px">Results</label>
						
							<code>
								<pre>
									<p style="color: #FFFFFF" id="r_results">
										
									</p>
								</pre>
							</code>
						
						
					</div>
					
					
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
		
		<!-- END OF FORMS -->
		<div class="footer" id="footer"><center><p style="color: #FFFFFF">Tikol4Life</p></center></div>
	</div>
	
	<!-- START OF TEMPLATE MODAL -->
	<div class="modal fade" id="Modal" data-keyboard="false" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered">
			<div class="modal-content" style="background: #212121">
				<div class="modal-body" style="background: #212121">
					<center style="margin-bottom: 20px">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" style="color: #ffffff">&times;</span>
						</button>
						<img class="rounded-circle" src="<?php echo $site_icon; ?>" width="200" height="200" style="margin-top: 10px;margin-bottom: 20px;" >
						<h5 class="modal-title" id="ModalTitle" style="color: #ffffff"></h5>
						<span id="ModalMsg" style="color: #ffffff;margin-top: 20px"></span>
					</center>
				</div>
			</div>
		</div>
	</div>
	<!-- END OF TEMPLATE MODAL -->
	<!-- START OF SETTINGS MODAL -->
	<div class="modal fade" id="settingsModal" role="dialog" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered"  style="background: transparent;">
			<div class="modal-content" style="background: transparent;">
				<div class="modal-body" style="background: #212121">
					<center style="margin-bottom: 20px">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" style="color: #ffffff">&times;</span>
						</button>
						<img class="rounded-circle" src="<?php echo $site_icon; ?>" width="200" height="200" style="margin-top: 10px;margin-bottom: 20px;" >
						<h5 class="modal-title" id="exampleModalCenterTitle" style="color: #ffffff">Additional Settings</h5>
					</center>

					<form name="settingForm" id="settingForm" role="form" method="POST">
						<div>
							<div class="row">
								<div class="col-12">
									<label class="form-control-label text-white" style="margin-left: 10px" for="telebot">TELEGRAM FORWARDER</label>
									<div class="input-group mb-3">
										<input name="telebot" type="text" id="telebot" class="form-control text-white" style="background: transparent;" placeholder="Chat ID" >
										<div class="input-group-append">
											<button class="btn btn-outline-danger" type="button" onclick="howto();" >
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-question" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"/>
													<path fill-rule="evenodd" d="M10.273 2.513l-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>
												</svg>
											</button>
											<button class="btn btn-outline-danger" type="button" onclick="testBot();" >
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M10.273 2.513l-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>
													<path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
												</svg>
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6 col-lg-6">
									<label class="form-control-label text-white" style="margin-left: 10px" for="tele_msg">MESSAGE</label>
									<select class="form-control text-white" style="background: transparent;" id="tele_msg" >
										<option style="background: #212121" value="1">CVV Only</option>
										<option style="background: #212121" value="2">CCN Only</option>
										<option style="background: #212121" value="3">CVV & CCN</option>
									</select>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group">
										<label class="form-control-label text-white" style="margin-left: 10px" for="delay">DELAY</label>
										<select class="form-control text-white" style="background: transparent;" id="delay" >
											<option style="background: #212121" value="0">No Delay</option>
											<option style="background: #212121" value="200">0.2 Sec</option>
											<option style="background: #212121" value="500">0.5 Sec</option>
											<option style="background: #212121" value="1000" selected> 1  Sec</option>
											<option style="background: #212121" value="2000"> 2  Sec</option>
											<option style="background: #212121" value="3000"> 3  Sec</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>
					<center>
						<h6 id="TeleMsg" style="color: #ffffff;margin-top: 20px"></h6>
					</center>
					<div name="howto" id="howto">
						<center >
							<h5 class="modal-title" id="exampleModalCenterTitle" style="color: #ffffff">How To Use:</h5>
							<h6 style="color: #ffffff;">[1] Open our Telegram Bot: <a href="https://t.me/OppaTikoleroBot" target="_blank">@OppaTikoleroBot</a>.

							</h6>
							<h6 style="color: #ffffff;">[2] Copy-Paste the Chat ID given by the bot.</h6>
							<h6 style="color: #ffffff;">[3] Test the forwarder to check if it works.</h6>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END OF SETTINGS MODAL -->
	<!-- BOOTSTRAP PLUGIN SCRIPTS-->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!-- CHECKER PLUGIN SCRIPTS-->
	<script src="assets/js/Tikol4Life.js"></script>
</body>
</html>
