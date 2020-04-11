<footer>
            <div class="container">            
                <div>
                    <div class="row btm-padding">
                        <div class="col">
                            <!--<img src="./public/images/LOGO.png" class="img-responsive" height="42px" width="190px">-->
                            <h5 style='margin-bottom: -30px;'>FOLLOW ME</h5>
                            <a href="#" class="fa fa-instagram"></a>
                            <a href="#" class="fa fa-twitter"></a>
                            <a href="#" class="fa fa-facebook"></a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <!--<div class="col-3">-->
                    <!--    <div class="footer_details">-->
                    <!--        <img class="my-photo" src="./public/images/LOGO.png">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col">
                        <div class="footer_details top-padding">
                            <h5>ABOUT ME</h5>
                            <a href=""> 
                              Hello, I'm Harish , targeting Competitive exams with India as my bazooka and dedicating this work of mine and future works in memory of Rakshantha Muthukumar
                            </a> 
                        </div>    
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('.toggle_menu').click(function() {
                if($(this).hasClass('active')) {
                    $('.toggle_menu').addClass('active');
                    $(this).removeClass('active');
                }
                if($(this).hasClass('fa-bars')) {
                    $('body').css('overflow','hidden');
                    $('.links').show();
                } else {
                    $('body').css('overflow','auto');
                    $('.links').hide();
                }
            });
        });
    </script>
</html>
<?php $conn->close(); ?>