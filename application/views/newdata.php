<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">

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
            <!--<ul class="nav navbar-nav navbar-right">
                <li><a href="#">Help</a></li>
            </ul>-->
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
                <li class="active"><a href="#">Show All Data <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Show Certain Data</a></li>
                <li><a href="#">Save New Data</a></li>
                <li><a href="#">Modify Data</a></li>
                <li><a href="#">Delete Data</a></li>
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
            <h1 class="page-header">Store New Customer Data</h1>
            <?php echo form_open_multipart('kontak/create');?>
            <table>
                <tr><td>Full Name: </td><td><?php echo form_input('nama');?></td></tr>
                <tr><td>Birthdate: </td><td><?php echo form_input('nomor');?></td></tr>
                <tr><td colspan="2">
                        <?php echo form_submit('submit','Simpan');?>
                        <?php echo anchor('kontak','Kembali');?></td></tr>
            </table>
            <?php
            echo form_close();
            ?>



        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../assets/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="../assets/js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
