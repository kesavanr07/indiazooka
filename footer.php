        <?php if($is_admin_panel === false) { ?>
            <footer>
                <div class="container">            
                    <div>
                        <div class="row btm-padding">
                            <div class="col">
                                <img src="./public/images/indiazooka_logo.png" class="img-responsive">
                                <!-- <h5 style='margin-bottom: -30px;'>FOLLOW ME</h5> -->
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
                                <a> 
                                Hello, I'm Harish targeting Competitive exams with India as my bazooka and dedicating this work of mine and future works in memory of Rakshantha Muthukumar
                                </a> 
                            </div>    
                        </div>
                    </div>
                </div>
            </footer>
        <?php } ?>
    </body>
    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
   
    <?php if($is_admin_panel === false) { ?>
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
                        $('.links').show();
                    } else {
                        $('body').css('overflow','auto');
                        $('.context-menu').show();
                        $('.tab-content').show();
                        $('footer').show();
                        $('.links').hide();
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
    <?php } else { ?>
        <script src="./ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'detail_content' );

            var changeSubcategory = (sub_cat) => {
                var option_html = "";
                var is_disabled = false;
                if(!sub_cat) {
                    option_html +="<option>No Data</option>";
                    is_disabled = true;
                } else {
                    for (let obj of sub_cat) {
                        option_html += "<option value="+obj.id+">"+obj.category_name+"</option>";
                    };
                }
                $('#sub_category').html(option_html);
                if(is_disabled) {
                    $('#sub_category').attr("disabled", "true");
                } else {
                    $('#sub_category').removeAttr("disabled");
                }
            }

            $(function() {
                var sub_category = {};
                $('#sub_category option').each(function() {
                    if(!sub_category[$(this).attr("parent-id")]) {
                        sub_category[$(this).attr("parent-id")] = [];
                    }
                    sub_category[$(this).attr("parent-id")].push({
                        id : $(this).attr("value"),
                        parent_id : $(this).attr("value"),
                        category_name : $(this).text()
                    });
                });
                $("#category").change(function(){
                    changeSubcategory(sub_category[$(this).val().toString()]);
                });
                changeSubcategory(sub_category[$("#category").val().toString()]);
            });

        </script>    
    <?php } ?>
</html>
<?php $conn->close(); ?>