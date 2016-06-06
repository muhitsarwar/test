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

        $.ajax({url: '<?php echo base_url() . "nurse/showMedicine"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#med').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "nurse/getNav"; ?>',
            data: {aTab: "Patient Medicine"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });





        $('#med').on('click', 'table tbody tr .cbox', function () {

            var index = $('.cbox').index(this);

            var r = confirm("Do you want to use medicine " + $(this).parent('td').parent('tr').children('td').eq(4).text() + " for " + $(this).parent('td').parent('tr').children('td').eq(2).text());
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "nurse/done"; ?>',
                    data: {vid: $(this).parent('td').parent('tr').children('td').eq(0).text(),
                        mid: $(this).parent('td').parent('tr').children('td').eq(3).text(),
                        time: $(this).parent('td').parent('tr').children('td').eq(5).text()},
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
                <h3>Nurse Module</h3>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="row">
            <div id ="nav" class="col-sm-2">






            </div>
            <div id ="med" class="col-sm-8 ">








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