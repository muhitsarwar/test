<?php

$pageTitle = 'Create Operation';
include_once 'Header.php'
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui.css">
<script src="<?php echo base_url(); ?>jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/clockface.css">
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/clockface.js"></script>

<script>
    $(function () {
        $('#pid').val('<?php  echo $_SESSION['current_patient']; ?>'); 
        $.ajax({url: '<?php echo base_url() . "doctor/getNav"; ?>',
            data: {aTab: "Create Operation"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });
        
        $.ajax({url: '<?php echo base_url() . "doctor/getNot"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#not').html(data);
            }
        });

        $(".search").keypress(function () {
            var table = $(this).attr('table');
            var id = this.id;
            var trig = $(this).attr('trig'); //WHICH ELEMENT WILL BE TRIGGERED WHEN CHANGE ON THIS

            $('#' + id).autocomplete({
                source: function (request, response) {
                    $.ajax({url: '<?php echo base_url() . "doctor/search"; ?>',
                        data: {term: $('#' + id).val(), table: table},
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                minLength: 2,
                //source: $local_source,
                select: function (event, ui) {
                    $('#' + id).val(ui.item.label); // display the selected text
                    $('#' + trig).val(ui.item.value); // save selected id to hidden input
                    return false;
                },
                change: function (event, ui) {
                    $("#" + trig).val(ui.item ? ui.item.value : 0);
                }
            });

        });

        $('#aDoctor').click(function () {
            $('#tContainer').removeClass('has-success');
            $('#tContainer').addClass('has-error');
            var r = confirm("Do you want to add doctor " + $('#did').val() + " for patient " + $('#pid').val());
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "doctor/addDoctor"; ?>',
                    data: {pid: $('#pid').val(),
                        date: $('#date').val(),
                        oid: $('#oName').val(),
                        did: $('#did').val(),
                        time: $('#time').val()},
                    type: 'get',
                    success: function (data) {

                        $('#did').val('');
                        $('#tContainer').addClass('has-success');
                        $('#tContainer').removeClass('has-error');
                    }
                });
            }// get the id from the hidden input
        });
        $('#cOperation').click(function () {
            $('#mContainer').removeClass('has-success');
            $('#mContainer').addClass('has-error');
            var r = confirm("Do you want to create operation a for patient " + $('#pid').val());
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "doctor/createOperation"; ?>',
                    data: {pid: $('#pid').val(),
                        date: $('#date').val(),
                        time: $('#time').val(),
                        oid: $('#oName').val()},
                    type: 'get',
                    success: function (data) {

                        $('#mContainer').addClass('has-success');
                        $('#mContainer').removeClass('has-error');
                    }
                }); // get the id from the hidden input
            }
        });
        $('#time').clockface({format: 'HH:mm'}); 

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

            <div class="col-sm-8 well">
                <div id ="mContainer" class="col-sm-6 well">

                    <input type="text" id="pid" class="form-control" placeholder="Patient Id">
                    <hr>
                    <input type="text" id="oName" table = "operation" trig = "oName" class="search form-control" placeholder="Operation Name">
                    <hr>
                    Date: <input type="date" id="date" class="form-control">
                    <hr>
                   <input type="text" id="time" value ="0:0" placeholder="Time"  data-format="HH:mm" class="form-control">
                    <hr>
                    <button type="button" id = "cOperation" class="btn btn-primary">Create Operation</button>	



                </div>
                <div id ="tContainer" class="col-sm-6 well">

                    <input type="text" id="did" class="form-control" placeholder="Doctor Ids">
                    <hr>
                    <button type="button" id = "aDoctor" class="btn btn-primary">Add Doctor</button>
                </div>

            </div>











            <div class="col-sm-2">
                <div id ="not" class="well">
                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>