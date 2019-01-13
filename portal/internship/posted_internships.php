<?php

session_start();

require_once("../config.php");

$companyId = $_SESSION['portalId'];
$query = "SELECT * FROM internships WHERE added_by = $companyId ";

$result = $con->query($query);
$flag = false;
$internships = array();
if($result->num_rows > 0) {
    $flag = true;
    while($row = $result->fetch_assoc()){
        $internships[] = $row;
    }
}


?>
<?php include("../include/header.php"); ?>

    <div class="inner-wrapper">

        <?php include("../include/left-sidebar.php"); ?>        

        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Test</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.html">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Dashboard</span></li>
                    </ol>
                    
                </div>
            </header>
            <div class="row">
                <div class="col-md-12">

                    <h3>Current Jobs</h3>
                    <table id="job-table" class="table table-responsive" style="border:1px solid #F4F4F4; border-radius: 4px">
                        <thead>
                        <tr class="table-row-heading" style="border: 1px solid rgba(0, 0, 0, 0.07);">
                            <th width="5%">SNo.</th>
                            <th width="40%">Job Title</th>
                            <th width="25%">Posted Date</th>
                            <th width="10%">Status</th>
                            <th width="20%">View Applications</th>
                        </tr>
                        </thead>
                        <tbody style="background: #fff">
                        <?php
                        $count = 1;
                        if ($flag):
                            foreach ($internships as $intern):
                                ?>
                                <tr class="jobs-detail">
                                    <td align="center"><?php echo $count; ?></td>
                                    <td>
                                        <a href="job_response.php?job=<?php echo $intern['id']; ?>"
                                        style="color: #2980b9;"><?php echo $intern['profile']; ?></a><br>
                                        <a style="color: #7f8c8d; font-size: 12px;">Skills :
                                            <span><?php echo $intern['skills']; ?></span></a>
                                    </td>
                                    <td style="padding-top: 12px">
                                        <p><?php echo $intern['added_date']; ?></p>
                                    </td>
                                    <td>
                                        <?php if ($intern['status']): ?>
                                            <a href="../update_status.php?type=job&id=<?php echo $intern['id']; ?>&value=0"
                                            style="color: #27ae60;font-weight: bold;" title="click to disable"
                                            id="status-btn">LIVE</a>
                                        <?php else: ?>
                                            <a href="../update_status.php?type=job&id=<?php echo $intern['id']; ?>&value=1"
                                            style="color: #c0392b;font-weight: bold;" title="click to live" id="status-btn">DISABLED</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="job_response.php?job=<?php echo $job['id']; ?>" class="btn btn-primary"
                                        style="font-size: 12px">View Applications</a></td>
                                </tr>

                                <?php
                                $count++;
                            endforeach; endif; ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
         </section>

    <?php include("../include/right-sidebar.php"); ?>

    </div>

    <?php include '../include/footer.php'; ?>
   