<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{asset ('allcss/css/all.min.css')}}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset ('allcss/bootstrap/css/bootstrap.min.css')}}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{asset ('allcss/css/owl.carousel.css')}}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{asset ('allcss/css/magnific-popup.css')}}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{asset ('allcss/css/animate.css')}}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{asset ('allcss/css/meanmenu.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{asset ('allcss/css/main.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset ('allcss/css/responsive.css')}}">

    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    padding: 100px;
    width: 430px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    margin-top:200px;
    height: 820px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 10px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 100px;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
/* Define the animation */
@keyframes fadeOut {
    0% { opacity: 1; }
    100% { opacity: 0; }
}

/* Apply the animation to the alert */
.alert {
    animation: fadeOut 1s forwards; /* 1s is the duration of the animation */
    /* Wait for 7 seconds before starting the animation */
    animation-delay: 7s; /* 7s is the delay before starting the animation */
}


    </style>
</head>
<body>
    @include('User.common.header')
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    @if (session('register'))
    <div id="myAlert" class="alert alert-success" role="alert">
        Register Successfully!
    </div>  
    @php
    session(['register'=>false]);
    @endphp   
    
    @elseif (session('password'))
    <div id="myAlert" class="alert alert-danger" role="alert">
        Password Mix Match !
    </div>  
    @php
    session(['password'=>false]);
    @endphp 

    
@elseif (session('emailerror'))
<div id="myAlert" class="alert alert-danger" role="alert">
    Email already Taken !
</div>  
@php
session(['emailerror'=>false]);
@endphp 
@endif


    <form method="post" action="SignUp">
        
     
        @csrf
        <h3>SignUp Here</h3>

        <label for="password">Name</label>
        <input type="name" placeholder="Name" id="" name="name">

        <label for="username">Email</label>
        <input type="text" placeholder="Email Address" id="username" name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="pass">

        <label for="password">Confirm Password</label>
        <input type="password" placeholder="CPassword" id="password" name="cpass">
        
        <div class="container mt-5">
            <div class="form-group">
              <label for="exampleTextarea" style="margin-top:-20px; margin-left:-10px;">Address</label>
              <textarea class="form-control" id="exampleTextarea" rows="3" style="background-color: rgba(255,255,255,0.07); width:320px; margin-left:-10px;" name="address"></textarea>
            </div>
          </div>
        

        <input type="submit" class="btn btn-primary" value="Sign Up">
        <div class="social">
          
        </div>
    </form>


	<!-- end copyright -->
	
	<!-- jquery -->
	<script src="{{asset ('allcss/js/jquery-1.11.3.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset ('allcss/bootstrap/js/bootstrap.min.js')}}"></script>
	<!-- count down -->
	<script src="{{asset ('allcss/js/jquery.countdown.js')}}"></script>
	<!-- isotope -->
	<script src="{{asset ('allcss/js/jquery.isotope-3.0.6.min.js')}}"></script>
	<!-- waypoints -->
	<script src="{{asset ('allcss/js/waypoints.js')}}"></script>
	<!-- owl carousel -->
	<script src="{{asset ('allcss/js/owl.carousel.min.js')}}"></script>
	<!-- magnific popup -->
	<script src="{{asset ('allcss/js/jquery.magnific-popup.min.js')}}"></script>
	<!-- mean menu -->
	<script src="{{asset ('allcss/js/jquery.meanmenu.min.js')}}"></script>
	<!-- sticker js -->
	<script src="{{asset ('allcss/js/sticker.js')}}"></script>
	<!-- main js -->
	<script src="{{asset ('allcss/js/main.js')}}"></script>
</body>
</html>
