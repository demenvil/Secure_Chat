<div class="menu_contact">
    <?php include('conversations.php');?>
<!--<h1>Chat iSecure2000 #SWAG edition</h1> --!>
		<!-- Gray box for the chat window -->
		<div class="box">
		<div class="picture">
			<img alt="logo"  src="/public/img/front_top.png">
		</div>
	
			<!-- Here the chat (message and form) -->
			<div class="chatbox">
				<div class="messages">
                                    <!-- Obviously the messages -->
                                    <?php include('messages.php');?>
                                </div>
				<!-- Captain obvious strikes again, the 'formbox' with the form and the send button -->
				<div class="formbox">

					<form action="/chat/sendMessage" method="POST">

						<textarea class="form_message" name="message"> </textarea>
                                                <!-- Temporarily, I manually add a value for idR -->
                                                <input class="idR" type="hidden" name="idR" value="<?php if(isset($_SESSION['idR'])) {echo $_SESSION['idR'];} ?>">
						<button class="submit" onclick=""> Envoyer </button>

					</form>

				<!-- formbox-->
				</div>

			<!-- chatbox -->
			</div>

		<!-- box -->
		</div>