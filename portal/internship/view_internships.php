<?php


require '../core/init.php';
include '../source/Classes/Intern.php';

$permissionId = Permissions::$viewInternshipPermissionId;
$flag = $permissions->checkUserPermission($permissionId);

if ($parent) {
    if (!$flag){
        $response = array(
            "type" => "error",
            "message" => "You have not any Permission to view Internship."
        );
        $_SESSION['message'] = $response;
        header("location:../index.php");
        exit();
    }
}

$intern = new Intern($con);
$intern->companyId = $companyId;
$stmt = $intern->read();
$flag = false;
$interns = array();
if ($stmt->num_rows > 0) {
    while ($row = $stmt->fetch_object()) {
        $interns[] = $row;
    }
    $flag = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include("../includes/head.php"); ?>

<body data-sidebar-color="sidebar-light" class="sidebar-light">

<?php include("../includes/header.php"); ?>

<div class="main-container">
    <?php include("../includes/mainsidebar.php") ?>

    <div class="page-container">
        <div class="page-header clearfix">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb mb-0">
                        <li><a href="#">Internships</a></li>
                        <li class="active">View Internships</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="container" style="background: #f1f1f1">
            <ul class="nav nav-tabs">
                <li class="active"><a>View Internships</a></li>
                <li><a href="create_internship.php">Add Internship</a></li>
            </ul>
        </div>

        <div class="page-content container-fluid">
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
            </script><br>

            <div id="form_fields" class="col-sm-12">
                <h3 align="center" style="margin-top:32px">Internships</h3><hr style="width:300px;padding-bottom:0px;margin-bottom:2px"><hr style="width:250px;padding-bottom:20px;margin-top:0px">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="10%">SNo.</th>
                        <th width="40%">Title</th>
                        <th width="15%">Added Date</th>
                        <th width="15%">Location</th>
                        <th width="10%">Update</th>
                        <th width="10%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($interns as $intern): ?>
                        <tr>
                            <td><?php echo $intern->ID ?></td>
                            <td><?php echo $intern->TITLE ?></td>
                            <td><?php echo date("d-M-Y",strtotime($intern->ADDED_DATE)) ?></td>
                            <td><?php echo $intern->CITY ?></td>
                            <td><a href="update_internship.php?intern=<?php echo $intern->ID ?>">Update</a></td>
                            <td><a href="../source/helpers/delete_internship.php?intern=<?php echo $intern->ID ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="footer" style="text-align: center;margin-top: 20px;">
        <?php echo date('Y'); ?> &copy;  <a href="#">Nerd Geek Lab</a>
    </div>

</div>

<?php include("../includes/rightsidebar.php"); ?>

</div>

<?php include "../includes/footer.php"  ?>

</body>
</html>
