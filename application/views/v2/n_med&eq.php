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


        $.ajax({url: '<?php echo base_url() . "nurse/getNav"; ?>',
            data: {aTab: "Add Med&Equipment"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });

        $('#amed').click(function () {

            $('#med').removeClass('has-success');
            $('#med').addClass('has-error');
            $.ajax({url: '<?php echo base_url() . "nurse/amed"; ?>',
                data: {mid: $('#mname').val()},
                type: 'get',
                success: function (data) {
                    
                    $('#med').addClass('has-success');
                    $('#med').removeClass('has-error');
                }
            }); // get the id from the hidden input
        });
        $('#aeq').click(function () {

            $('#eq').removeClass('has-success');
            $('#eq').addClass('has-error');
            $.ajax({url: '<?php echo base_url() . "nurse/aeq"; ?>',
                data: {eid: $('#ename').val()},
                type: 'get',
                success: function (data) {

                    $('#eq').addClass('has-success');
                    $('#eq').removeClass('has-error');
                }
            }); // get the id from the hidden input
        });


        $(".search").keypress(function () {
            var table = $(this).attr('table');
            var id = this.id;
            var trig = $(this).attr('trig'); //WHICH ELEMENT WILL BE TRIGGERED WHEN CHANGE ON THIS

            $('#' + id).autocomplete({
                source: function (request, response) {
                    $.ajax({url: '<?php echo base_url() . "nurse/search"; ?>',
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
            <div  class="col-sm-8 well">

                <div id ="med" class="col-sm-6 well">

                    <input type="text" id="mname" table = "medicine" trig = "mname" class="search form-control" placeholder="Medicine Name">
                    <hr>
                    <button type="button" id ="amed" class="btn btn-primary">Add Medicine</button>	



                </div>
                <div id ="eq" class="col-sm-6 well ">

                    <input type="text" id="ename" table ="equipment" trig="ename"  class="search form-control" placeholder="Equipment Name">
                    <hr>
                    <button type="button" id ="aeq" class="btn btn-primary">Add Equipment</button>	





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