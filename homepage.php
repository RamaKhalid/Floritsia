 <!--Raghad-->
 <!DOCTYPE html>
 <html>

 <head>
 <meta name="keywords" content="plants, gifts, green plants, indoor plants, outdoor plants, planters, plants tools, soil, fertilizer, plant tools">
  <meta name="description" content=" Founded in 2024, Floristia is a beacon of botanical beauty, 
  offering a diverse selection of premium plants to elevate any living space. Our platform is 
  designed with you in mind, ensuring a seamless shopping experience with intuitive navigation and
  comprehensive plant descriptions. Whether you are a seasoned green thumb or just starting your journey, 
  our detailed care guides empower you to nurture your plants to perfection. At Floristia, we believe in the power
  of greenery to transform homes and lives. Let us be your partner in cultivating beauty and tranquility indoors. Shop now and
  discover the joy of bringing nature home with Floristia.">
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Welcome to Floritsia </title>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- <iframe src="customer_header.html" frameborder="0" scrolling="no"></iframe> -->
 </head>

 <body>

     <!-- back-to-top button embeded from elfsight website-->
     <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
     <div class="elfsight-app-ae188528-846b-498e-9c5a-9a3f7b99cc78" data-elfsight-app-lazy></div>

     <?php
        require_once 'customer_header.php';
        ?>

     <!-- first section -->
     <section style="width: 100%;
                  background-color: #F7F8F6;
                  background-position: center;
                  background-size: cover;
                  padding-top: 3.5%;" id="first-home">
         <!-- div to combain multiple divs -->

         <div style="display: flex;
                height: 200%;
                justify-content: space-around;
                ">
             <!-- text on left -->
             <div style="align-self: center;">
                 <h1 style="max-width: 50rem;
                     color: #A3A37C;
                     font-family: Yantramanav;
                     position: left;
                     font-size: 3vw ;
                      ">
                     Where Every Garden </h1>
             </div>

             <!-- image on middle -->
             <div style="display: flex;
                background-color:rgba(199,154,103,0.6399999856948853);
                position: relative;
                flex-grow: 0.1;
                border-radius: 0% 0% 49% 49% / 50% 50% 51% 51% ;
                width:15%;
                height: 30% ;
                padding-left: 10%;
                padding-right: 10%;
                align-items:center;
                justify-content: center;
                overflow:hidden">

                 <img style="width: 240%;
                  height: 240%;
                  border-radius: 49% 51% 47% 53% / 36% 36% 64% 64%  ;" src="images\desing imgs\section1img.png">
             </div>

             <!-- text on right -->
             <div style="align-self: center; flex-grow: 0.1;">
                 <h1 style="max-width: 50rem;
                    color: #646858;
                    font-family: Yantramanav;
                    position: right;
                    font-size: 3vw;
                    ">
                     Tells a Story</h1>
             </div>
         </div>
         <!-- text at end of first section -->
         <div style="color: #74873D;
                text-align: center;
                font-family: Yantramanav;
                font-size: 1.3vw;
                font-weight: 500;
                display: flex;
                align-items:center;
                padding-left: 27%;
                padding-bottom: 7%;
                padding-top: 4%;">
             Explore top-quality plants &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Learn about each plant's care needs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; • &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shop confidently with us
         </div>
     </section> <!--end of first section-->


     <!-- second section "categories"-->
     <section style="border: 100px;
                  width: 100%;
                  padding-top: 8%;
                  position: relative;" id="categories">
         <!--title:category-->
         <div style="align-self: center;
                  flex-grow: 10;
                  padding-bottom: 5%;">
             <h1 style="color: #404533;
                  text-align: center;
                  font-family: Yantramanav;
                  font-size: 3vw;
                  line-height: 150%;">
                 Categories</h1>
         </div>

         <!-- start categories cards-->
         <div style="display: grid;
                /* grid-template-rows: 6rem 6rem 6rem 6rem 6rem 6rem 6rem 6rem;
                grid-template-columns:11rem 11rem 11rem 11rem 8rem 8rem 8rem; */

                grid-template-rows: 6% 6% 6% 6% 6% 6% 6% 6%;
                grid-template-columns:10% 10% 10% 10% 10% 10% 10% /* 10% */;
                justify-content: center;
                grid-gap: 3rem;
                height: 100%;
                width: 100%;">

             <!-- 1st category-->

             <a href="Category-list.php?category_id=1" style="display: contents;">
                 <button style="background-color: #F5F5F5;
                  border-radius: 15% 15% 15% 15% / 15% 15% 15% 15% ;
                  grid-row-start: 1;
                  grid-row-end: 3;
                  grid-column-start: 1;
                  grid-column-end: 4;
                  cursor: pointer;
                  display: flex;
                  border: none;
                  position: relative;
                  ">

                     <!-- <div style="display: flex; justify-self:left;">
        <img src="..\images\indoor.png" style="width: 300px; height: 380px;  align-self: center;" alt="indoor plants" >
      </div> -->
                     <div style=" display:flex; align-self: center;">
                         <img src="images\desing imgs\indoor img.png" style="height:80%; width: 80%; padding-bottom: 35%; align-self: center;" alt="plant tools">
                     </div>
                     <h3 style="justify-self: center;
                        padding-top: 10%;
                        padding-right: 20%;
                        color: #404533;
                        font-family: Yantramanav;
                        font-size: 2vw;
                        line-height: 100%;
                        text-wrap:nowrap;
                        ">
                         Indoor Plants</h3>

                 </button>
             </a>

             <!-- 2nd category-->
             <a href="Category-list.php?category_id=6" style="display: contents;">
                 <button style="background-color: #D9E5D6;
                  border-radius: 15% 15% 15% 15% / 15% 15% 15% 15% ;
                  display: flex;
                  align-content: flex-start;
                  overflow: hidden;
                  grid-row-start: 1;
                  grid-row-end: 3;
                  grid-column-start: 4;
                  grid-column-end: 6;
                  border: none;
                  position: relative;
                  cursor: pointer;">

                     <h3 style="justify-self: flex-end;
                              padding-top: 18%;
                              padding-right: 5%;
                              padding-left: 5%;
                              color: #404533;
                              font-family: Yantramanav;
                              font-size: 40px;
                              line-height: 100%;
                              text-wrap:nowrap;">
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gifts</h3>

                     <div style=" display:flex; justify-content: end; padding-left: 80%;">
                         <img src="images\desing imgs\gifts img.png" style="height:130% ;width: 90%; position: absolute; " alt="gifts">
                     </div>
                 </button>
             </a>

             <!-- 3rd category-->
             <a href="category-list.php?category_id=4" style="display: contents;">
                 <button style="background-color: #DFDDDC;
                  border-radius: 15% 15% 15% 15% / 15% 15% 15% 15% ;
                  display: flex;
                  align-content: flex-start;
                  overflow: hidden;
                  grid-row-start: 1;
                  grid-row-end: 5;
                  grid-column-start: 6;
                  grid-column-end: 8;
                  border: none;
                  position: relative;
                  cursor: pointer;">

                     <h2 style="padding-top:40%;
                             color: #404533;
                             font-family: Yantramanav;
                              font-size: 40px;
                              line-height: 300%;
                              padding-left: 15%;">
                         Planters</h2>

                     <div style=" display:flex; justify-content: end;">
                         <img src="images\desing imgs\planters img.png" style="height:600px ;width: 400px; padding-right: 20%; padding-bottom: 20%;" alt="planters">
                     </div>
                 </button>
             </a>

             <!-- 4th category-->
             <a href="category-list.php?category_id=2" style="display: contents;">
                 <button style="background-color: #D2D6C2;
                  border-radius: 15% 15% 15% 15% / 15% 15% 15% 15% ;
                  display: flex;
                  align-content: flex-start;
                  overflow: hidden;
                  grid-row-start: 3;
                  grid-row-end: 7;
                  grid-column-start: 1;
                  grid-column-end: 3;
                  border: none;
                  position: relative;
                  cursor: pointer;">

                     <h2 style="color: #404533;
                            text-align: center;
                            font-family: Yantramanav;
                            font-size: 40px;
                            line-height: 150%;
                            text-wrap: nowrap;
                            padding-top: 40%;
                            padding-left: 5%;">
                         Outdoor Plants</h2>
                     <div style=" display:flex; justify-content: end; align-content: start;">
                         <img src="images\desing imgs\outdoor img.png" style="height:600px ;width: 250px; padding-right: 50%;" alt="outdoor plants">
                     </div>
                 </button>
             </a>

             <!-- 5th category-->
             <a href="category-list.php?category_id=5" style="display: contents;">
                 <button style="background-color: #BFBAB9;
                  border-radius: 15% 15% 15% 15% / 15% 15% 15% 15% ;
                  display: flex;
                  justify-content:end;
                  align-content:center;
                  overflow: hidden;
                  grid-row-start: 3;
                  grid-row-end: 5;
                  grid-column-start: 3;
                  grid-column-end: 6;
                  border: none;
                  position: relative;
                  cursor: pointer;">

                     <div style=" display:flex; align-self: center;">
                         <img src="images\desing imgs\tools img.png" style="height:380px ;width: 350px;padding-top: 20%;" alt="plant tools">
                     </div>

                     <h2 style="color: #404533;
                  font-family: Yantramanav;
                  font-size: 40px;
                  line-height: 10%;
                  text-wrap: nowrap;
                  padding-top: 15%;
                  padding-right: 20%;">
                         Plant Tools</h2>
                 </button>
             </a>

             <!-- 6th category-->
             <a href="category-list.php?category_id=3" style="display: contents;">
                 <button style="background-color: #EBE9E2;
                  border-radius: 15% 15% 15% 15% / 15% 15% 15% 15% ;
                  grid-row-start: 5;
                  grid-row-end: 7;
                  grid-column-start: 3;
                  grid-column-end: 8;
                  display: flex;
                  justify-content:start;
                  align-content:center;
                  overflow: hidden;
                  border: none;
                  position: relative;
                  cursor: pointer;">

                     <h2 style="color: #404533;
                            font-family: Yantramanav;
                            font-size: 40px;
                            line-height: 150%;
                            text-wrap: nowrap;
                            padding-top: 6%;
                            padding-left: 25%;">
                         Soil & Fertilizer</h2>

                     <div style=" display:flex; align-self: center;">
                         <img src="images\desing imgs\soil img.png" style="height:480px ;width: 550px; padding-left:20%; padding-bottom: 15%;" alt="soil">
                     </div>

                 </button>
             </a>
         </div>
     </section>

     <!-- start of about us section-->


     <section style="width: 100%;
                  overflow: hidden;
                  background-color: #F7F8F6;
                  background-position: center;
                  background-size: cover;
                  overflow: hidden;" id="about us">

         <div style="display: flex;
                overflow: hidden;">
             <img src="images/Desing imgs/section3img.png" alt="about us" style="height: 35%; width:35%;">

             <article style="padding-bottom: 8%; padding-top: 10%; padding-left: 5%;">
                 <h1 style="color: #404533;
                font-size: 2.5vw; 
                font-family: Yantramanav; 
                line-height: 96px;
                padding-left: 5%;">
                     About us</h1>

                 <p style="font-size: 24px; font-family: Yantramanav; line-height: 36px; text-wrap:balance;">
                     &nbsp;&nbsp;Founded in 2024, Floristia is a beacon of botanical beauty, offering a diverse selection of premium plants to elevate any living space. Our platform
                     is designed with you in mind, ensuring a seamless shopping experience with intuitive navigation and comprehensive plant descriptions. Whether you are
                     a seasoned green thumb or just starting your journey, our detailed care guides empower you to nurture your plants to perfection.</p>

                 <p style="font-size: 24px; font-family: Yantramanav; line-height: 36px; text-wrap:balance;">
                     &nbsp;&nbsp;At Floristia, we believe in the power of greenery to transform homes and lives. Let us be your partner in cultivating beauty and tranquility indoors.
                     Shop now and discover the joy of bringing nature home with Floristia.</p>
             </article>

         </div>

     </section>

     <!-- start of best sellers section-->

     <!-- <section style="padding-top: 15%;
                  padding-bottom: 15%;
                  width: 100%;">

    <h1 style="text-align: center; 
              color: #404533; 
              font-size: 64px; 
              font-family: Yantramanav; 
              line-height: 96px;">Best Sellers</h1>

    <div style="display: grid;
                justify-content: center;
                grid-template-columns: 380px 380px 380px 380px 380px;
                grid-template-rows: 380px;
                overflow: hidden;
                grid-gap: 3rem;
                padding-bottom: 10%;">
          <div style="grid-column:1/1 ; grid-row: 1/1;">
            <img src="images\Desing imgs\leftsideSec4.jpeg" alt="plant plury" style="box-shadow: 10px 10px 5px 1px lightgray; filter: blur(8px); height:400px ; width:350px ;">
          </div>-->
     <!--arrow to left-->
     <!--<div style="grid-area: 1 / 1 / 1 / 1; z-index: 1; justify-self: end; align-self: center; padding-top: 20%;">
            <img src="images\Desing imgs\Vector2.png" alt="vector">
          </div>

          <div>
            <img src="images\Indoor Plants\Monstera adansonii.jpg" alt="monstera" style="box-shadow: 10px 10px 5px 1px lightgray; height:400px ; width:380px ;">
            <span style="color: black; 
                          font-size: 24px; 
                          font-weight: bold;
                          font-family: Yantramanav;
                          line-height: 36px; 
                          word-wrap: break-word;"><br/>Monstera adansonii <br/></span>
            <span style="color: black; 
                          font-size: 24px; 
                          font-family: Yantramanav; 
                          font-weight: 400; 
                          line-height: 36px; 
                          word-wrap: break-word">56.00 SR</span>
          </div>
          <div>
            <img src="images\Indoor Plants\ficus lyrata Bambino (2).jpg" alt="ficus" style="box-shadow: 10px 10px 5px 1px lightgray; height:400px ; width:380px ;">
            <span style="color: black; 
                          font-size: 24px; 
                          font-weight: bold;
                          font-family: Yantramanav;
                          line-height: 36px; 
                          word-wrap: break-word;"><br/>Ficus lyrata Bambino  <br/></span>
            <span style="color: black; 
                          font-size: 24px; 
                          font-family: Yantramanav; 
                          font-weight: 400; 
                          line-height: 36px; 
                          word-wrap: break-word">32.00 SR</span>
          </div>
          <div>
            <img src="images\Indoor Plants\Zamioculcus zamiifolia - ZZ Plants.jpg" alt="Zamioculcus" style="box-shadow: 10px 10px 5px 1px lightgray; height:400px ; width:380px ;">
            <span style="color: black; 
                          font-size: 24px; 
                          font-weight: bold;
                          font-family: Yantramanav;
                          line-height: 36px; 
                          word-wrap: break-word;"><br/>Zamioculcus zamiifolia<br/></span>
            <span style="color: black; 
                          font-size: 24px; 
                          font-family: Yantramanav; 
                          font-weight: 400; 
                          line-height: 36px; 
                          word-wrap: break-word"> 40.00 SR </span>
          </div>-->
     <!--arrow to right-->
     <!-- <div style="grid-area: 1 / 5 / 1 / 5; z-index: 1; align-self: center; padding-top: 15%;">
            <img src="images\Desing imgs\vector.png" alt="vector">
          </div>

          <div style="grid-column:5/5 ; grid-row: 1/1; ">
            <img src="images\Desing imgs\rightsideSec4.jpeg" alt="plant plury" style="box-shadow: 10px 10px 5px 1px lightgray; filter: blur(8px); height:400px ; width:350px ;">
          </div>
    </div>
  </section> -->

     <!-- footer starts here-->
     <?php
        require_once 'footer.php';
        ?>

 </body>

 </html>