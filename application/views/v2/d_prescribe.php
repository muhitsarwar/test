<?php
$pageTitle = 'Prescribe';
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
            data: {aTab: "Prescribe"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
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

        $('#button').click(function () {
            $('#tContainer').removeClass('has-success');
            $('#tContainer').addClass('has-error');
            $.ajax({url: '<?php echo base_url() . "doctor/addtest"; ?>',
                data: {pid: $('#pid').val(), tid: $('#ptest').val()},
                type: 'get',
                success: function (data) {
                    
                    $('#ptest').val('');
                    $('#tContainer').addClass('has-success');
                    $('#tContainer').removeClass('has-error');
                }
            }); // get the id from the hidden input
        });
        $('#mbutton').click(function () {

            $('#mContainer').removeClass('has-success');
            $('#mContainer').addClass('has-error');
            $.ajax({url: '<?php echo base_url() . "doctor/addmedicine"; ?>',
                data: {mid: $('#mname').val(),
                    date: $('#mdate').val(),
                    time: $('#mtime').val(),
                    quan: $('#mquantity').val(),
                    repeat: $('#repeat').val(),
                    pid: $('#pid').val()},
                type: 'get',
                success: function (data) {
                    
                    $('#mContainer').addClass('has-success');
                    $('#mContainer').removeClass('has-error');
                }
            }); // get the id from the hidden input
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
                <div id ="mContainer" class="col-sm-6 well">

                    <input type="text" id="pid" class="form-control" placeholder="Patient Id">
                    <hr>
                    <input type="text" id="mname" table = "medicine" trig = "mname" class="search form-control" placeholder="Medicine Name">
                    <hr>
                    Date: <input type="date" id="mdate" class="form-control">
                    <hr>
                    <input type="text" id="repeat" class="form-control" placeholder="Repeat">
                    <hr>
                    Time:<input type="time" id="mtime" class="form-control"> 
                    <hr>
                    <input type="text" id="mquantity" class="form-control" placeholder="Quantity">
                    <hr>
                    <button type="button" id = "mbutton" value = "true" content = "Add Medicine" class="btn btn-primary">Add Medicine</button>	



                </div>
                <div id ="tContainer" class="col-sm-6 well">

                    <input type="text" id="ptest" name ="test" table ="test" trig ="ptest" class="search form-control" placeholder="Test Name">
                    <hr>
                    <button type="button" id ="button" value ="true" name ="button" content ="Add Test" class="btn btn-primary">Add Test</button>	





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