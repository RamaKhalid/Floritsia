<!-- contact us by r.m. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js"></script>
	<script src="https://smtpjs.com/v3/smtp.js"></script>
</head>

<body>
    
    <section >
	
    <?php
     #Include the customer_header file
	require_once 'customer_header.php';
	?>
	
        <div class="rm-container">
            <div class="rm-image1">
                <img src="images\Desing imgs\design3.png" alt="plantPic">

            </div> 
            <div class="rm-title">contact us
            
                <p>
                    Got questions or feedback? We're here to help! Reach out to us at 
                    any time via email at contact@floristia.com or through our contact form on the website. Our dedicated team is committed to providing you with prompt and personalized assistance. Let's connect and make your plant shopping experience with Floristia exceptional!</p>
                
            </div>
           
            <form method="post" onsubmit="sendEmail(); reset(); return false;" > <!-- call function to send form to admin email -->

                <input type="hidden" name="access_key" value="0d58d67b-637e-49b4-80a6-a8c52564a055">
			
                <div class="rm-fields">
					
                    <div class="contactname">
                        <div><label for="nameform">Your Name (Required)</label></div>
                        <div><input type="text" id="nameform" placeholder="Enter Your Name" name="name:" required></div>
                    </div>
					
					<div class="contactemail">
						<div><label for="emailform">Your Email (Required)</label></div>
						<div><input type="email" id="emailform" name="email" placeholder="custmer@domain.com" required></div>
					</div>
										
                    <div class="message">
                        <div><label for="">Your letter</label></div>
                        <div><textarea id="messageform" name="message" placeholder="Hi Floristia Team..." required></textarea></div>
                    </div>
					

					
                </div>
				
				
				
                <div class="sendformbuttons">
					<button type="submit" id="sendform"> send </button>
                </div>

	            <div>
                    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5838.561637785155!2d50.214364624646606!3d26.321967047133615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49e8f0369114af%3A0xec29b00430b78eaf!2z2YHZhNmI2LHZitiz2KrYpyDYqNmI2KrZitmD!5e0!3m2!1sar!2ssa!4v1714583538932!5m2!1sar!2ssa" width="100" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>			
				
            </form>

            <div id="sendSuccessMsg" class="sendSuccessMsg">
                    <div class="content">
                        <span id="Msgclosebutton" class="close-button">&times;</span>
                        <h2>Floritsia</h2>
                        <p>Your message has been sent successfully! Thank you.</p>
                        <button id="MsgOkButton">OK</button>
                    </div>
            </div>
            
        </div>
        <?php
            #Include the footer file
	        require_once 'footer.php';
	    ?>
    </section>  

</body>

</html>