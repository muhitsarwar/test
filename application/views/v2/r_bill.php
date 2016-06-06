<?php
$pageTitle = 'Release Patient';
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

        $.ajax({url: '<?php echo base_url() . "recp/getNav"; ?>',
            data: {aTab: "Release Patient"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });

        $('#xpett').click(function () {
            $('#float').removeClass("has-error");
            $('#float').removeClass("has-success");
            $.ajax({url: '<?php echo base_url() . "recp/pexpense"; ?>',
                data: {pid: $('#pid').val()},
                type: 'get',
                success: function (data) {
                    $("#cost").html(data);
                    $('#float').removeClass("has-error");
                    $('#float').removeClass("has-success");
                    $('#float').addClass("has-success");
                }
            }); // get the id from the hidden input

        });

        $('#rpet').click(function () {
            $('#float').removeClass("has-error");
            $('#float').removeClass("has-success");
            var r = confirm("Do you want to release patient "+$('#pid').val());
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "recp/prelease"; ?>',
                    data: {pid: $('#pid').val()},
                    type: 'get',
                    success: function (data) {
                        alert(data);
                        $('#float').removeClass("has-error");
                        $('#float').removeClass("has-success");
                        $('#float').addClass("has-success");
                    }
                }); // get the id from the hidden input
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
                <h3>Receptionist Module</h3>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">






            </div>
            <div id ="float" class="col-sm-8 well">

                <input type="text" id="pid" class="form-control" placeholder="Patient Id">
                <button id ="xpet" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Find Expense</button>
                <hr>
                <hr>
                <div id ="cost">

                </div>
                <button id ="rpet" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Release Patient</button>




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