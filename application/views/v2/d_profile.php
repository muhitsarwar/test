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

        $.ajax({url: '<?php echo base_url() . "doctor/showProfile"; ?>',
            data: {},
            type: 'get',
            success: function (data) {
                $('#profile').html(data);
            }
        });
        $.ajax({url: '<?php echo base_url() . "doctor/getNav"; ?>',
            data: {aTab: "Profile"},
            type: 'get',
            success: function (data) {
                $('#nav').html(data);
            }
        });

        $('#saveChange').click(function () {
            $('#float').removeClass("has-error");
            $('#float').removeClass("has-success");
            var speciality = $('#speciality').val();
            var gender = $('#gender').val();
            var pNo = $('#pNo').val();
            var pwd1 = $('#pwd1').val();
            var pwd2 = $('#pwd2').val();

            if (pwd1 == pwd2) {
                $.ajax({url: '<?php echo base_url() . "doctor/updateProfile"; ?>',
                    data: {speciality: speciality, gender: gender,
                        pNo: pNo, pwd: pwd1},
                    type: 'get',
                    success: function (data) {
                        $('#float').removeClass("has-error");
                        $('#float').removeClass("has-success");
                        $('#float').addClass("has-success");
                    }
                }); // get the id from the hidden input
            } else {

                $('#float').addClass("has-error");
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

                <div class = "row">
                    <div id ="profile" class="col-sm-12">
                        <!--                          data will be set by ajax-->
                    </div>

                </div>

                <div calss = "row">	
                    <center>				
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Edit Profile</button>
                        <div class="modal fade" id="modal-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title">Profile</h3>
                                    </div>
                                    <div id = "float" class="modal-body well">



                                        <input type="text" id="speciality" class="form-control" placeholder="Speciality">
                                        <hr>
                                        <input type="text" id="gender" class="form-control" placeholder="Gender">
                                        <hr>
                                        <input type="text" id="pNo" class="form-control" placeholder="Phone No">
                                        <hr>

                                        Change Password:
                                        <input type="password" id="pwd1" class="form-control" placeholder="New Password">
                                        <input type="password" id="pwd2" class="form-control" placeholder="Confirm PassWord">
                                        <hr>

                                        <button type="button" id ="saveChange" class="btn btn-primary">Save Changes</button>	





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