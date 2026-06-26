<!-- START PRELOADER -->
<div class="preloaders">
    <span class="loader"></span>
</div>
<!-- END PRELOADER -->

<!-- START NAVBAR -->
<div id="navigation" class="navbar-light bg-faded site-navigation">
    <div class="container-fluid">
        <div class="row">
            <div class="col-20 align-self-center">
                <div class="site-logo">
                    <a href="{{route('admin.index')}}"> <img src={{asset('assets/img/logo.png')}} alt="Logo"></a>
                </div>
            </div><!--- END Col -->

            <div class="col-60 d-flex">
                <nav id="main-menu">
                    <ul>
                        <li class="menu-item"><a href="{{route('admin.index')}}">Home</a>
                        </li>
                        <li><a href="{{route('admin.about')}}">About</a></li>
                        <li class="menu-item-has-children"><a href="{{route('admin.course')}}">Course</a>
                            <ul>
                                <li><a href="{{route('admin.course')}}">Course</a></li>
                                <li><a href="{{route('admin.course_details')}}">Course Details</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Pages</a>
                            <ul>
                                <li><a href="{{route('admin.instructor')}}">Instructor</a></li>
                                <li><a href="{{route('admin.ins_details')}}">Instructor Details</a></li>
                                <li><a href="{{route('admin.pricing')}}">Pricing Plan</a></li>
                                <li><a href="faq.html">Faq Page</a></li>
                                <li><a href="404.html">404</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="blog.html">Blog</a>
                            <ul>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog_single.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div><!--- END Col -->

            <div class="col-20 d-none d-xl-block text-end align-self-center">
                <a href="#" class="header-btn">Sign In</a>
                <a href="contact.html" class="btn_one">Sign Up</a>
            </div><!--- END Col -->

            <ul class="mobile_menu">
                <li><a href="#">Home</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.index') }}">Home 01</a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li><a href="#">Course</a>
                    <ul class="sub-menu">
                        <li><a href="course.html">Course</a></li>
                        <li><a href="course_details.html">Course Deails</a></li>
                    </ul>
                </li>
                <li><a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="instructor.html">Instructor</a></li>
                        <li><a href="ins_details.html">Instructor Details</a></li>
                        <li><a href="pricing.html">Pricing Plan</a></li>
                        <li><a href="faq.html">Faq Page</a></li>
                        <li><a href="404.html">404</a></li>
                    </ul>
                </li>
                <li><a href="blog.html">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog_single.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div><!--- END ROW -->
    </div><!--- END CONTAINER -->
</div>
<!-- END NAVBAR -->
