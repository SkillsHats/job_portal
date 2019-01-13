<?php

session_start();

if (empty($_SESSION['utype'])) {
    header("location: ../login.php");
}

if (empty($_SESSION['uid'])) {
    header("location: ../login.php");
}

include '../config.php';
require '../source/Classes/Portal.php';

if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    $userType = $_SESSION['utype'];
}

$portal = new Portal($con);
$portal->userId     = $userId;
$portal->userType   = $userType;

$stmtCompany    = $portal->readCompany();

$companies = array();
$flag = false;

if ($stmtCompany->num_rows > 0) {
    while($row = $stmtCompany->fetch_object()){
        $companies[] = $row;
    }
    $flag = true;
}

?>


<!DOCTYPE html>
<html lang="en">

<?php include("../includes/head.php"); ?>
<body data-sidebar-color="sidebar-light" class="sidebar-light">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<link rel="stylesheet" href="../css/screen.css">

<?php include("../includes/header.php"); ?>

<div class="main-container">

    <?php include("../includes/mainsidebar.php"); ?>

    <div class="page-container">
        <div class="page-header clearfix">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mt-0 mb-5">Welcome to nerd geek</h4>
                    <p class="text-muted mb-0"> Dashboard</p>
                </div>
            </div>
        </div>

        <div class="container" style="background: #f1f1f1">
            <ul class="nav nav-tabs">
                <li class="active"><a href="view_companies.php">View Companies</a></li>
                <li><a href="company_response.php">Company Requests</a></li>
            </ul>
        </div>

        <div class="page-content container-fluid">
            <div class="widget">
                <div class="widget-body">

                    <?php if ($flag): ?>

                        <table id="company-list" style="width: 100%" class="table table-hover table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>Company Id</th>
                                <th>Company Name</th>
                                <th class="text-center">Applied Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($companies as $company): ?>
                                <tr>
                                    <td>#<?php echo $company->COMPANY_ID; ?></td>
                                    <td><?php echo $company->COMPANY_NAME; ?></td>
                                    <td class="text-center"><?php echo date("d-M-Y",strtotime($company->ADDED_DATE)); ?></td>
                                    <?php if ($company->STATUS): ?>
                                    <td style="color: #00AA00;"><span class="label label-success">Approved</span></td>
                                    <?php else: ?>
                                    <td style="color: #AA0000;"><span class="label label-danger">Pending</span></td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <div role="group" aria-label="Basic example" class="btn-group btn-group-sm">
                                            <a href="company_details.php?id=<?php echo $company->COMPANY_ID; ?>" target="_blank" type="button" class="btn btn-outline btn-primary" title="View Company details"><i class="ti-eye"></i></a>
                                            <a href="company_details.php?id=<?php echo $company->COMPANY_ID; ?>" target="_blank" type="button" class="btn btn-outline btn-success" title="Give Permissions to company"><i class="ti-check"></i></a>
                                            <a href="decline_company_request.php?id=<?php echo $company->COMPANY_ID; ?>" type="button" id="decline-request-btn" class="btn btn-outline btn-danger" title="Decline Company Request"><i class="ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <h3>No Company Requests.</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="view_company" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-left">Choose Your Profile Cover</h4>
                        <button class="btn btn-default pull-right" id="inputImage-button" style="margin-top: -30px;margin-right: 30px;">Add Image</button>
                        <input id="inputImage" type="file" style="display: none;"/>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">Search</button>
                            </div>
                        </div>
                        <br>

                        <p>List of photos for you</p>
                        <div class="photos">
                            <img src="../empty-icon.png" alt="" width="100px" height="100px">
                            <h4>No results found!</h4>
                            <p>Sorry, we couldn't find any results matching your query.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../includes/footer.php"); ?>
    </div>

    <?php include("../includes/rightsidebar.php"); ?>

</div>

<?php include "../includes/footer.php"; ?>

</body>
</html>