<!DOCTYPE html>
 <html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Welcome to Floristia </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
    footer{
        margin-top: 60px;
        position: relative;
        bottom: 0px;
         width: 100%;
         height:  20%; 
         background: #F7F8F6;
         
         }
    .footer-container{
	    max-width: 100%;
	    margin:auto;
      margin:0;
	    padding:0;
	    box-sizing: border-box;
    }   
 
    .footer-row{
      display: flex;
	    flex-wrap: wrap;
      
    }

    .footer-container ul{
	    list-style: none;
      margin:0;
	    padding:0;
	    box-sizing: border-box;
    }
        
  .footer-col{
    width: 25%;
     padding: 0 25px;
     
  }
  
.footer-col h4{
	color: #404533; 
  font-size: 20px; 
  font-family: Yantramanav; 
  font-weight: 00; 
  line-height: 30px; 
	text-transform: capitalize;
	margin-bottom: 25px;
	position: relative;
}
.footer-col h4::before{
	content: '';
	position: absolute;
	left: 0;
	bottom: -10px;
	background-color: #74873D;
	height: 4px;
	box-sizing: border-box;
	width: 70px;
}

.footer-col ul li a{
  font-size: 20px;  
  font-weight: 300; 
  line-height: 30px;
	text-transform: capitalize;
	color: #404533;
	text-decoration: none;
	display: block;
	transition: all 0.3s ease;
}
.footer-col ul li a:hover{
	color: #74873D;
	padding-left: 8px;
}

.footer-col .social-links a{
	display: inline-block;
	height: 55px;
	width: 55px;
	margin:0 10px 10px 0;
	text-align: center;
	line-height: 55px;
	border-radius: 50%;
	color: #524b4b;
	transition: all 0.5s ease;
}

.footer-col .social-links a:hover{
	color: #74873D;
	background-color: #e2ecc4;
}

.foot-col{
  display: flex;
  height: 160px;
  justify-content:flex-end;
  flex-direction: column;
  align-items: center;
     
     
}

.payment-img a{
  margin: 0 15px 0px 15px;
  justify-items: center;
}

            
            

  </style>


 </head>
 <body>

    <footer id="footer">
        <div class="footer-container">
          <div class="footer-row">
            <div class="footer-col">
              <h4>company</h4>
              <ul>
                <li><a href="#about us">about us</a></li>
                <li><a href="contactUs.php">Contact</a></li>
                <li><a href="#">FAQ</a></li>
              </ul>
            </div>
    
            <div class="footer-col">
              <h4>Information</h4>
              <ul>
                <li><a href="#">Plant Shipping Restrictions</a></li>
                <li><a href="#">Shipping & Refunds</a></li>
                <li><a href="#">Terms of Services</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Return Policy</a></li>
              </ul>
            </div>
    
            <div class="footer-col">
              <h4>follow us</h4>
              <div class="social-links">
                <a href="#"><i class="fa-brands fa-snapchat"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                 </div>
            </div>
    
           </div> 
           
           <div class="foot-col">
            <div class="payment-img">
              <a href="#"><img src="images\desing imgs\applepay.png" alt="apple-Pay"></a>
              <a href="#"><img style="padding-bottom: 5%;" src="images\desing imgs\visa.png" alt="visa"></a>
              <a href="#"><img src="images\desing imgs\mastercard.png" alt="master card"></a>
              <a href="#"><img src="images\desing imgs\stcpay.png" alt="stc-pay"></a>
               </div>
        <h6>all rights reserved 2024 © Floristia</h6>
          </div> 
         </footer>
     </body>
     </html>