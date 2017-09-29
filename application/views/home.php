<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sanction List: Main Page Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

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
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/futuready.png'); ?>" width="82px" height="22px"></a>
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="min-height: 580px;">
            <?php
            if (isset($message)) {
                echo "<div class='message' style='color: #204d74'>";
                echo $message;
                echo "</div>";
            }
            ?>
            <?php if($this->session->flashdata('msg')): ?>
                <p style="color: #204d74"><?php echo $this->session->flashdata('msg'); ?></p>
            <?php endif; ?>
            <h1 class="page-header">Data List</h1>

            <h2 class="sub-header">Sanction List Customer</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>FULL NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE NUMBER</th>
                        <th>BIRTHDATE</th>
                        <th>GENDER</th>
                        <th>INPUT TIME</th>
                        <th>INPUT BY</th>
                        <th>APPROVED TIME</th>
                        <th>APPROVED BY</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($custdata as $row) { ?>
                        <tr>
                            <th><?php echo $row->full_name ?></th>
                            <th><?php echo $row->email ?></th>
                            <th><?php echo $row->phone_number ?></th>
                            <th><?php echo date_format(new DateTime($row->birthdate), "d M Y") ?></th>
                            <th><?php echo $row->gender ?></th>
                            <th><?php echo date_format(new DateTime($row->input_time), "d M Y H:i:s") ?></th>
                            <th><?php echo $row->input_by ?></th>
                            <th><?php echo date_format(new DateTime($row->approved_time), "d M Y H:i:s") ?></th>
                            <th><?php echo $row->approved_by ?></th>
                            <th><?php echo anchor('sanction/edit/'.$row->list_id, 'Edit', 'class="link-class"') ?></th>
                            <th><a href="#" onClick="delete_records('<?php echo $row->list_id;?>');" alt="delete_records" />Delete</a></th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="text-align: center; margin-top: 40px; margin-bottom: 5px;">
            <img src="<?php echo base_url('assets/images/aegon-ft-logo.png'); ?>">
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="<?php echo base_url('assets/js/holder.min.js'); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
<script>
    function delete_records(list_id)
    {
        var baseUrl = "<?php echo base_url() ?>";
        var conf= confirm("Do you really want delete this data?");
        if (conf== true){
             location = baseUrl + "sanction/delete/" + list_id;
        }else{
            return;
        }
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
                return x = x;
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
        height: 20px;
        color: #ffffff;
        text-align: center;
        font: 16px/21px 'DIGITAL', Helvetica;
    }
</style>
</body>
</html>
