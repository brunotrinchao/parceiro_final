<!--footer section start-->
<footer>
        <p>&copy 2015 Easy Admin Panel. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a></p>
    </footer>
    <!--footer section end-->

    <!-- main content end-->

<script src="_assets/js/jquery.nicescroll.js"></script>
<script src="_assets/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="_assets/js/bootstrap.min.js"></script>
<!-- SweetAlert -->
<script src="_assets/js/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="_assets/js/functions/functions.js"></script>
<script src="_assets/js/functions/api.js"></script>
<script>
    $(document).ready(function(){
        $.gApi.exec('GET', 'https://jsonplaceholder.typicode.com/comments', {},
            function(retorno){
            console.log(retorno);
        });
    });
</script>
</body>
</html>