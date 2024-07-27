<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>


<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            @if(session('user_id'))
                                
                            <li class="current-list-item"><a href="/">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="/">Static Home</a></li>
                                    <li><a href="/">Slider Home</a></li>
                                </ul>
                            </li>
                           
                            @endif
                            <li><a href="/about">About</a></li>
                            
                            <li><a href="/contact">Contact</a></li>
                            @if(session('user_id'))
                            <li><a href="/logout">Logout</a></li>
                            @else
                            <li><a href="/SignUp">Sign Up</a></li>
                            <li><a href="/loginUser">Login</a></li>
                            @endif
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>