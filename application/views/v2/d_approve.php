<?php
$pageTitle = 'Approve';
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

        $.ajax({url: '<?php echo base_url() . "doctor/getNav"; ?>',
            data: {aTab: "Approve"},
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
        $.ajax({url: '<?php echo base_url() . "doctor/getNurse"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#nurse').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "doctor/getUEq"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#eq').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "doctor/getUMed"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#med').html(data);
            }
        });



        $('#nurse').on('click', 'table tbody tr .cbox', function () {

            var index = $('.cbox').index(this);

            var r = confirm("Do you want to add this nurse?");
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "doctor/aNurse"; ?>',
                    data: {po_id: $(this).parent('td').parent('tr').children('td').eq(3).text(),
                        n_id: $(this).parent('td').parent('tr').children('td').eq(1).text()},
                    type: 'get',
                    success: function (data) {
                         window.location.reload();
                    }
                });
            }

        });
        $('#eq').on('click', 'table tbody tr .cbox', function () {

            var index = $('.cbox').index(this);

            var r = confirm("Do you want to add this equipment?");
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "doctor/aEq"; ?>',
                    data: {po_id: $(this).parent('td').parent('tr').children('td').eq(3).text(),
                        n_id: $(this).parent('td').parent('tr').children('td').eq(1).text()},
                    type: 'get',
                    success: function (data) {
                        window.location.reload();
                    }
                });
            }
        });
        $('#med').on('click', 'table tbody tr .cbox', function () {

            var index = $('.cbox').index(this);

            var r = confirm("Do you want to add this medicine?");
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "doctor/aMed"; ?>',
                    data: {po_id: $(this).parent('td').parent('tr').children('td').eq(3).text(),
                        n_id: $(this).parent('td').parent('tr').children('td').eq(1).text()},
                    type: 'get',
                    success: function (data) {
                        window.location.reload();
                    }
                });
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
                <h3>Doctor Module</h3>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">



            </div>

            <div class="col-sm-8 well">
                <div class="panel-group" id="accordion">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#nurse" data-toggle="collapse" data-parent="accordion">
                                    Approve Nurse</a>
                            </h4>
                        </div>
                        <div id="nurse" class="panel-collapse collapse">
                            <div id ="nurse" class="panel-body">
                                <div id = "nurse"></div>	
                                <button type="button" class="btn btn-primary">Reload</button>	
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#medicine" data-toggle="collapse" data-parent="accordion">
                                    Approve Medicine</a>
                            </h4>
                        </div>
                        <div id="medicine" class="panel-collapse collapse in">
                            <div class="panel-body">

                                <div id = "med"></div>

                            </div>
                        </div>
                    </div>						
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#equipment" data-toggle="collapse" data-parent="accordion">
                                    Approve Equipment</a>
                            </h4>
                        </div>
                        <div id="equipment" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div id = "eq"></div>	

                            </div>
                        </div>
                    </div>

                </div>	

            </div>











            <div class="col-sm-2">
                <div id ="not" class="well">
                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Footer.php' ?>