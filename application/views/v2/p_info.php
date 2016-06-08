<?php
$pageTitle = 'Info';
include_once 'Header.php'
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui.css">
<script src="<?php echo base_url(); ?>jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.min.css">
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<script>
    $(function () {

        $.ajax({url: '<?php echo base_url() . "patient/showInfo"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#info').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "patient/getNav"; ?>',
            data: {aTab: "Info"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "patient/getNot"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#not').html(data);
            }
        });

        
    });
</script>
</head>
<body>
    <header>
        <div class="jumbotron">
            <div class="container">
                <h1>Clinic Mangement System</h1>
                <h3>Patient Module</h3>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">






            </div>
            <div id ="info" class="col-sm-8 well">

                

                






            </div>
            <div class="col-sm-2">
                <div id="not" class="well">
                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>