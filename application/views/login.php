<?php
$pageTitle = 'Login';
include_once 'Header.php'
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui.css">
<script src="<?php echo base_url(); ?>jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.min.css">
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<script>

</script>
</head>
<body>
    <header>
        <div class="jumbotron">
            <div class="container">
                <h1>Clinic Management System</h1>

            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">



            </div>

            <div class="col-sm-8">
                <center>
                    <h2>Login</h2>
                    <?php
                    echo form_open('main/login_validation');
                    echo validation_errors();
                   
                    $datam = array(
                        'class'=>'form-control',
                        'name' => 'user_name',
                        'id' => 'user_name',
                        'placeholder' => 'User Id'
                    );
                    echo form_input($datam);
            

                    echo "<hr>";
                    echo form_password(array(
                        'class'=>'form-control',
                        'type' => 'password',
                        'name' => 'password',
                        'id' => 'password',
                        'placeholder' => 'Password'
                    ));
                    echo "</p>";

                    echo "<p>";
                    echo form_submit('login_submit', 'Login');
                    echo "</p>";

                    echo form_close();
                    ?>
                </center>

            </div>



            <div class="col-sm-2">

            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>