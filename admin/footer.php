    </body>
    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
    <script src="../ckeditor/ckeditor.js"></script>
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
            if($('.view_data').length === 0) {
                changeSubcategory(sub_category[$("#category").val().toString()]);
            }
        });

    </script>    
</html>
<?php $conn->close(); ?>