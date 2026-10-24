<!--footer-->
    <div class="footer">
       <p></p>
    </div>
    <!--//footer-->
    </div>

    <!-- new added graphs chart js-->

    <script src="<?=base_url()?>extras/system/js/Chart.bundle.js"></script>
    <script src="<?=base_url()?>extras/system/js/utils.js"></script>
    <!-- new added graphs chart js-->

    <!-- Classie --><!-- for toggle left push menu script -->
        <script src="<?=base_url()?>extras/system/js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
                showLeftPush = document.getElementById( 'showLeftPush' ),
                body = document.body;

            showLeftPush.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( body, 'cbp-spmenu-push-toright' );
                classie.toggle( menuLeft, 'cbp-spmenu-open' );
                disableOther( 'showLeftPush' );
            };


            function disableOther( button ) {
                if( button !== 'showLeftPush' ) {
                    classie.toggle( showLeftPush, 'disabled' );
                }
            }
        </script>
    <!-- //Classie --><!-- //for toggle left push menu script -->

    <!--scrolling js-->
    <script src="<?=base_url()?>extras/system/js/jquery.nicescroll.js"></script>
    <script src="<?=base_url()?>extras/system/js/scripts.js"></script>
    <!--//scrolling js-->

    <!-- side nav js -->
   
    <!-- //side nav js -->
    <!-- Bootstrap Core JavaScript -->
   <script src="<?=base_url()?>extras/system/js/bootstrap.js"> </script>
    <!-- //Bootstrap Core JavaScript -->

</body>
</html>
