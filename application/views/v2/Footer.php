

<div class="panel panel-default">
    <center>
        <?php
        if ($this->session->userdata('user_name') != '') {
            echo 'logout(<a href=' . base_url() . "main/logout" . '>';
            echo $this->session->userdata('user_name') . '</a>)';
            echo '    ';
        }
        ?>
        &copy; muhit sarwar
    </center
</div>


</body>
</html>