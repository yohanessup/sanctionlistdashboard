<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sanction List: Insert New Customer Data</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" media="screen">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url('assets/css/ie10-viewport-bug-workaround.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/dashboard.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sanction List</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('sanction/logout'); ?>">logout (<?php echo $this->session->userdata('logged_in')['username']; ?>)</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <div class="digital-clock">00:00:00</div>
            </ul>
            <!--<form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>-->
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="<?php echo base_url(); ?>">Data List <span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo base_url('sanction/baru'); ?>">Save New Data</a></li>
            </ul>
            <!--            <ul class="nav nav-sidebar">-->
            <!--                <li><a href="">Nav item</a></li>-->
            <!--                <li><a href="">Nav item again</a></li>-->
            <!--                <li><a href="">One more nav</a></li>-->
            <!--                <li><a href="">Another nav item</a></li>-->
            <!--                <li><a href="">More navigation</a></li>-->
            <!--            </ul>-->
            <!--            <ul class="nav nav-sidebar">-->
            <!--                <li><a href="">Nav item again</a></li>-->
            <!--                <li><a href="">One more nav</a></li>-->
            <!--                <li><a href="">Another nav item</a></li>-->
            <!--            </ul>-->
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php
            if (isset($message)) {
                echo "<div class='message' style='color: #aa0000'>";
                echo $message;
                echo "</div>";
            }
            ?>
            <h1 class="page-header">Insert New Customer Data</h1>
            <?php echo form_open('sanction/baru'); ?>
            <form>
                <div class="form-group">
                    <label for="inputFullname">Customer Full Name</label>
                    <input type="text" name="full_name" class="form-control" id="inputFullname" placeholder="customer full name">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Customer Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="dtp_input2">Customer Birthdate</label>
                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="birthdate" id="dtp_input2" value="" /><br/>
                </div>
                <div class="form-group">
                    <label for="inputPhoneNumber">Customer Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="inputPhoneNumber" onkeypress="return isNumber(event)" placeholder="number only">
                </div>
                <div class="form-group">
                    <label for="inputGender">Customer Gender</label>
                    <select class="form-control" id="inputGender" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <button name="submit" type="submit" class="btn btn-default">Save Data</button>
                <button name="cancel" type="submit" class="btn btn-default">Cancel</button>
            </form>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/vendor/jquery.min.js'); ?>"><\/script>')</script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="<?php echo base_url('assets/js/holder.min.js'); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.8.3.min.js'); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js'); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/locales/bootstrap-datetimepicker.us.js'); ?>" charset="UTF-8"></script>
<script type="text/javascript">

    $('.form_date').datetimepicker({
        language:  'us',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script>
    $(document).ready(function() {
        clockUpdate();
        setInterval(clockUpdate, 1000);
    })

    function clockUpdate() {
        var date = new Date();
        $('.digital-clock').css({'color': '#fff', 'text-shadow': '0 0 6px #ff0'});
        function addZero(x) {
            if (x < 10) {
                return x = '0' + x;
            } else {
                return x;
            }
        }

        function twelveHour(x) {
            if (x > 12) {
                return x;
            } else if (x == 0) {
                return x = 12;
            } else {
                return x;
            }
        }

        var h = addZero(twelveHour(date.getHours()));
        var m = addZero(date.getMinutes());
        var s = addZero(date.getSeconds());

        $('.digital-clock').text(h + ':' + m + ':' + s)
    }
</script>
<style>
    @font-face {
        font-family: 'Arial';
    }

    html {
        height: 100%;
    }

    .digital-clock {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100px;
        height: 30px;
        color: #ffffff;
        text-align: center;
        font: 20px/30px 'DIGITAL', Helvetica;
    }
</style>
</body>
</html>
