<?php

$pageTitle = 'Patient History';
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
        $('#pid').val('<?php echo $_SESSION['current_patient'];  ?>'); 
        $.ajax({url: '<?php echo base_url() . "doctor/showProfile"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#profile').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "doctor/getNot"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#not').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "doctor/getNav"; ?>',
            data: {aTab: "Patient History"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });

        $('#load').click(function () {




            $.ajax({url: '<?php echo base_url() . "doctor/report"; ?>',
                data: {pid: $('#pid').val()},
                type: 'get',
                success: function (data) {
                    $("#test").html(data);
                   
                    $('#pidContainer').addClass("has-success");
                }
            }); // get the id from the hidden input
            $.ajax({url: '<?php echo base_url() . "doctor/patientInfo"; ?>',
                data: {pid: $('#pid').val()},
                type: 'get',
                success: function (data) {
                    $("#pInfo").html(data);
                }
            });
            $.ajax({url: '<?php echo base_url() . "doctor/patientMed"; ?>',
                data: {pid: $('#pid').val()},
                type: 'get',
                success: function (data) {
                    $("#med").html(data);

                }
            });

        });

    });
</script>
</head>
<body>
    <header>
        <div class="jumbotron">
            <div class="container">
                <h1>Clinic Mangement System</h1>
                <h3>Doctor Module</h3>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">






            </div>
            <div id ="pidContainer" class="col-sm-8 well">
                <input type="text" id="pid" class="form-control" placeholder="Patient Id">
                <button type="button" id ="load" class="btn btn-primary">Load</button>
                <hr>


                <div class="panel-group" id="accordion">
                    <div class="row panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#medicine" data-toggle="collapse" data-parent="accordion">
                                    Patient Medicine</a>
                            </h4>
                        </div>
                        <div id="medicine" class="panel-collapse collapse in">
                            <div id ="med" class="panel-body">


                            </div>
                        </div>
                    </div>
                    <div class="row panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#test" data-toggle="collapse" data-parent="accordion">
                                    Patient Test</a>
                            </h4>
                        </div>
                        <div id="test" class="panel-collapse collapse">
                            <div id="test" class="panel-body">

                            </div>
                        </div>
                    </div>
                    <div class="row panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#patient" data-toggle="collapse" data-parent="accordion">
                                    Patient Info</a>
                            </h4>
                        </div>
                        <div id="patient" class="panel-collapse collapse">
                            <div id="pInfo" class="panel-body">

                            </div>
                        </div>
                    </div>

                </div>






            </div>
            <div class="col-sm-2">
                <div id = "not" class="well">
                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>