        <footer>
            <div class="container"> 
                <!-- <hr> -->
                <div class="row">
                    <div class="col-2">
                        <div class="footer_details">
                            <img class="footer-photo" src="./public/images/LOGO.png">
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer_details top-padding">
                            <div>ABOUT ME</div>
                            <a class="title_font_res">
                            Hello, I'm Harish targeting Competitive exams, learning, sharing knowledge with India as my bazooka and dedicating in memory of Rakshantha Muthukumar.
                            </a> 
                        </div>    
                    </div>
                </div>
                <hr>
                           
                <div>
                    <div class="row">
                        <div class="col">
                            <!-- <img src="./public/images/indiazooka_logo.png" class="img-responsive"> -->
                            <a href="https://www.facebook.com/indiazooka.indiazooka" class="fa fa-facebook"></a>
                            <a href="https://twitter.com/indiazooka?s=08" class="fa fa-twitter"></a>
                            <a href="https://www.instagram.com/indiazooka?r=nametag" class="fa fa-instagram"></a>
                            <a href="https://t.me/indiazooka" class="fa fa-telegram"></a>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="text-center">
                    <small class="text-muted">
                        © 2020 Indiazooka. All rights reserved.<br>
                            Developed by Weird World
                    </small>
                </div>
            </div>
        </footer>
    </body>
    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
   
    <script src="./public/js/slick.js"></script>
    <script>
        $(function() {
            $('.toggle_menu').click(function() {
                if($(this).hasClass('active')) {
                    $('.toggle_menu').addClass('active');
                    $(this).removeClass('active');
                }
                if($(this).hasClass('fa-bars')) {
                    $('.context-menu').hide();
                    $('.tab-content').hide();
                    $('footer').hide();
                    $('.home_menu').hide();
                    $('.links').show();
                } else {
                    $('body').css('overflow','auto');
                    $('.context-menu').show();
                    $('.tab-content').show();
                    $('footer').show();
                    $('.links').hide();
                    $('.home_menu').show();
                }
            });
            var addColorNavItem = (ths) => {
                if(ths.prev().hasClass('red_text') === false) {
                    ths.prev().addClass('red_text');
                }
            }
            var removeColorNavItem = (ths) => {
                if(ths.prev().hasClass('red_text') === true) {
                    ths.prev().removeClass('red_text');
                }
            }

            $(".dropdown-menu").mouseover(function() {
                addColorNavItem($(this));
            });
            $(".dropdown-menu").mouseout(function() {
                removeColorNavItem($(this));
            });
            $(".dropdown-menu").focusin(function() {
                addColorNavItem($(this));
            });
            $(".dropdown-menu").focusout(function() {
                removeColorNavItem($(this));
            });
            $('.customer-logos').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                arrows: false,
                dots: false,
                pauseOnHover: true,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });
        });
    </script>    

</html>
<?php $conn->close(); ?>