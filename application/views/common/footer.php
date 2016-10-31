<script>
    if ('' != "<?php echo $this->session->userdata('session_userId'); ?>" && "none" == $('#Logout').css('display')) {

        $('#User_Register').css('display', 'none');
        $('#Logout').css('display', 'block');
    };
</script>
<footer>
    <div class="main">
        <div class="foot_div">
            <p>Copyright 2016. All Rights Reserved.</p>
        </div>
    </div>
</footer>
</body>
</html>