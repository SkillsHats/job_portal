<?php
session_start();

if(!isset($_SESSION['uid'])){
    header("Location: ../login.php");
    exit();
}
if (!isset($_GET['id'])){
    header("Location: company_response.php");
    exit();
}

include '../config.php';
require '../source/Classes/Portal.php';

$userId    = 0;
$userType   = 0;

if(isset($_SESSION['uid'])){
    $userId = $_SESSION['uid'];
    $userType = $_SESSION['utype'];
}

$companyId = (int)$_GET['id'];

$portal = new Portal($con);
$portal->userId     = $userId;
$portal->companyId  = $companyId;
$portal->userType   = $userType;

$flag = false;
$stmtCompany    = $portal->readOneCompany();
$stmtUser       = $portal->readUser();
$aboutCompany   = '';

if ($stmtCompany->num_rows > 0){
    $aboutCompany = $stmtCompany->fetch_object();
    $flag = true;
}

$result      = $portal->permissions();
$permissions = array();

$totalCreated = $totalPermission = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_object()){
        $permissions[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("../includes/head.php"); ?>
<body data-sidebar-color="sidebar-light" class="sidebar-light">

<?php include("../includes/header.php"); ?>

<div class="main-container">
    <?php include("../includes/mainsidebar.php") ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/screen.css">

    <div class="page-container">
        <div class="page-header clearfix">
            <div class="row">

                <div class="col-sm-6">
                    <ol class="breadcrumb mb-0">
                        <li><a href="view_companies.php">Company</a></li>
                        <li class="active"><?php echo $aboutCompany->COMPANY_NAME; ?></li>
                    </ol>
                </div>
            </div>
        </div>

        <?php $type  = '';
        if (isset($_SESSION['message'])){
            $type = $_SESSION['message']['type']; $message = $_SESSION['message']['message'];
        }
        if ($type && $message): ?>
            <div id="Message" class="<?php echo $type == 'error' ? 'alert-danger' : 'alert-success' ?> col-sm-12" style="margin-bottom: 12px; padding: 12px 12px;"><?php echo $message; ?></div>
        <?php endif; ?>
        <script>
            setTimeout(function() {
                $('#Message').fadeOut('fast');
                <?php unset($_SESSION['message']); ?>
            }, 5000);
        </script>

        <div class="box">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if($flag): ?>
                        <div class="box-container application">
                            <div class="box-heading">
                                <div class="col-sm-7">
                                    <p><?php echo $aboutCompany->COMPANY_NAME; ?> Profile</p>
                                </div>
                                <div class="col-sm-3">
                                    <p>Company ID : <?php echo $aboutCompany->COMPANY_ID; ?></p>
                                </div>
                                <div class="col-sm-2">
                                    <?php if ($aboutCompany->STATUS): ?>
                                        <p class="pull-right"><a class="btn btn-default" style="color: #00AA00;">Active</a></p>
                                    <?php else: ?>
                                        <p class="pull-right"><a href="update_status.php?companyId=<?php echo $aboutCompany->COMPANY_ID; ?> " class="btn btn-default" style="color: #AA0000;" title="Click to Active">Inactive</a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="box-body">

                                <div class="tab-content">
                                    <div class="tab-panel">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="right-tab-view" id="user-info">
                                                    <div class="top-part">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img class="img-responsive applicants-image" src="../<?php echo $aboutCompany->LOGO; ?>">
                                                            </div>
                                                            <div class="col-md-7">
                                                                <p class="applicant-name"><?php echo $aboutCompany->COMPANY_NAME; ?></p>
                                                                <p class="applicant-location"><i class="fa fa-map-marker"></i> <?php echo ""; ?></p>
                                                                <p class="applicant-college"><i class="fa fa-graduation-cap"></i> <?php echo ""; ?> </p>
                                                                <p><i class="fa fa-shield-alt"></i> <?php echo ""; ?></p>
                                                                <p class="applicant-mobile ng-scope" title=""><i class="fa fa-phone"></i><span class="blur"> <?php echo $aboutCompany->COMPANY_MOBILE; ?></span></p>
                                                                <p class="applicant-email" title="Email address"><i class="fa fa-envelope"></i><span class="blur"> <?php echo $aboutCompany->COMPANY_EMAIL; ?></span></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <?php if ($aboutCompany->STATUS): ?>
                                                                    <a class="pull-right btn btn-sm btn-default" style="width: 120px;" disabled=""> Approved</a>
                                                                <?php else: ?>
                                                                    <a class="pull-right btn btn-sm btn-default" title="Approve Company Request" href="update_status.php?companyId=<?php echo $aboutCompany->COMPANY_ID; ?> " style="width: 120px;">&nbsp; Approve</a>
                                                                    <a class="pull-right btn btn-sm btn-success" title="Give Permissions" href="#permissions" style="width: 120px;margin-top: 10px;">&nbsp;Give Permissions</a>
                                                                <?php endif; ?>

                                                                <a class="pull-right btn btn-sm btn-danger" title="Delete company request" href="decline_company_request.php?id=<?php echo $aboutCompany->COMPANY_ID; ?> " style="width: 120px;margin-top: 45px;"> Delete Company</a> </div>
                                                        </div>
                                                    </div>
                                                     <h4 class="heading" id="permissions">Give Permissions</h4>
                                                    <div class="middle-info-part fixht">
                                                        <form action="map_company_permissions.php" method="POST">
                                                            <input type="hidden" name="role" value="<?php echo $userType; ?>">
                                                            <div class="form-group">
                                                                <?php foreach ($permissions as $permission): ?>
                                                                    <ul style="display: inline;float: left; width: 200px;list-style: none; padding-left: 0px;">
                                                                        <li><input type="checkbox" name="permissions[]" value="<?php echo $permission->PERMISSION_ID; ?>"> <?php echo $permission->PERMISSION_NAME; ?></li>
                                                                    </ul>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <input type="submit" class="form-control btn btn-primary" name="map" value="Give Permissions" >
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <div class="box-container application" style="min-height: 80px!important;text-align: center">
                        <div class="box-heading">
                            <div class="col-sm-12">
                                <p>Company not exist!</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>

<div class="footer" style="text-align: center;margin-top: 20px;">
    <?php echo date('Y'); ?> &copy;  <a href="#">Nerd Geek Lab</a>
</div>

</div>

<?php include("../includes/rightsidebar.php"); ?>

</div>

<?php include "../includes/footer.php" ?>


</body>
</html>
