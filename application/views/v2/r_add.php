<?php
$pageTitle = 'Add Patient';
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
            data: {aTab: "Add Patient"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });

        $('#apet').click(function () {
            $('#float').removeClass("has-error");
            $('#float').removeClass("has-success");


           
            var r = confirm("Do you want to add this patient?");
            if (r == true) {
                $.ajax({url: '<?php echo base_url() . "recp/addpatient"; ?>',
                    data: {fname: $(fname).val(), lname: $(lname).val(), hight: $(hight).val(), weight: $(weight).val(),
                        pNo: $(pNo).val(), wNo: $('#wNo option:selected').text(), gender: $('#gender option:selected').text()},
                    type: 'get',
                    success: function (data) {
                        $("#pId").html(data);
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

                <div class="col-sm-6 well">

                    <input type="text" id="fname" class="form-control" placeholder="First Name">
                    <hr>
                    <input  type="text" id="lname" class="form-control" placeholder="Last Name">
                    <hr>                 
                    <div class="input-group">
                        <input type="text" id="hight" class="form-control" placeholder="Hight">
                        <span class="input-group-addon">meter's</span>
                    </div>
                    <hr>
                    <div class="input-group">
                        <input type="text" id="weight" class="form-control" placeholder="Weight">
                        <span class="input-group-addon">kg</span>
                    </div>

                    <hr>





                </div>

                <div class = "col-sm-6 well">

                    <div class="input-group">
                        <span class="input-group-addon">+880</span>
                        <input type="text" id="pNo"  class="form-control" placeholder="Phone No">
                    </div>
                    <hr>
                    <select class="form-control"  id="gender">
                        <option >Male</option>
                        <option >Female</option>
                    </select>
                    <hr>
                    <select class="form-control"  id="wNo">
                        <option >Word No</option>
                        <option >1</option>
                        <option >2</option>
                        <option >3</option>
                        <option >4</option>
                        <option >5</option>
                    </select>
                    <hr>

                </div>
                <div calss = "row">	
                    <center>				
                        <button id ="apet" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Add Patient</button>
                        <div class="modal fade" id="modal-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title">Patient ID</h3>
                                    </div>
                                    <div id ="pId" class="modal-body">




                                    </div>

                                </div>
                            </div>
                        </div>
                    </center>
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