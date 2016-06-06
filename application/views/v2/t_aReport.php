<?php
$pageTitle = 'profile';
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

        $.ajax({url: '<?php echo base_url() . "tech/showTestField"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#testField').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "tech/getNav"; ?>',
            data: {aTab: "Add Report"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });

        $('#cRepor').click(function () {

            $.ajax({url: '<?php echo base_url() . "tech/cReport"; ?>',
                data: {pid:$('#pid').val(),
                    elm_1: $('#elm_1').attr('placeholder') + ': ' + $('#elm_1').val(),
                    elm_2: $('#elm_2').attr('placeholder') + ': ' + $('#elm_2').val(),
                    elm_3: $('#elm_3').attr('placeholder') + ': ' + $('#elm_3').val(),
                    elm_4: $('#elm_4').attr('placeholder') + ': ' + $('#elm_4').val(),
                    elm_5: $('#elm_5').attr('placeholder') + ': ' + $('#elm_5').val(),
                    elm_6: $('#elm_6').attr('placeholder') + ': ' + $('#elm_6').val(),
                    elm_7: $('#elm_7').attr('placeholder') + ': ' + $('#elm_7').val(),
                    elm_8: $('#elm_8').attr('placeholder') + ': ' + $('#elm_8').val() },
                type: 'get',
                success: function (data) {
                    alert(data);
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
                <h1>Clinic Management System</h1>
                <h3>Lab Attendant Module</h3>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">






            </div>
            <div class="col-sm-8 well">

                <div class = "row">
                    <div id ="testField" class="col-sm-12">
                        <!--                          data will be set by ajax-->
                    </div>

                    <center><button type="button" id ="cRepor" class="btn btn-primary">Create Report</button></center>
                </div>


            </div>
            <div class="col-sm-2">
                <div class="well">
                    <div class="well">
                        <p>Assigned in an operation on 1.2.3</p>
                    </div>
                    <div class="well">
                        <p>Assigned in an operation on 1.2.3</p>
                    </div>
                    <div class="well">
                        <p>Assigned in an operation on 1.2.3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>
