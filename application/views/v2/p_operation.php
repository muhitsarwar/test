<?php
$pageTitle = 'Operation';
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


        $.ajax({url: '<?php echo base_url() . "patient/getNav"; ?>',
            data: {aTab: "Operation"},
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
        
        $.ajax({url: '<?php echo base_url() . "patient/getPOperation"; ?>',
            data: {aTab: "Operation"},
            type: 'get',
            success: function (data) {
                $('#pop').html(data);
            }
        });
        
        $.ajax({url: '<?php echo base_url() . "patient/getUOperation"; ?>',
            data: {aTab: "Operation"},
            type: 'get',
            success: function (data) {
                $('#uop').html(data);
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
            <div id ="pidContainer" class="col-sm-8 well">
                


                <div class="panel-group" id="accordion">
                    <div class="row panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#medicine" data-toggle="collapse" data-parent="accordion">
                                    Past Operation</a>
                            </h4>
                        </div>
                        <div id="medicine" class="panel-collapse collapse in">
                            <div id ="pop" class="panel-body">


                            </div>
                        </div>
                    </div>
                    <div class="row panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#test" data-toggle="collapse" data-parent="accordion">
                                    Upcoming Operation</a>
                            </h4>
                        </div>
                        <div id="test" class="panel-collapse collapse">
                            <div id="uop" class="panel-body">

                            </div>
                        </div>
                    </div>
                    

                </div>






            </div>
            <div class="col-sm-2">
                <div id="not" class="well">
                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>