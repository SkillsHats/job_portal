<?php

session_start();
require_once("../config.php");

$company_id = $_SESSION['portalId'];
$query = "SELECT company_id,company_email, contact_number, company_type FROM company WHERE company_id = $company_id";

$result = $con->query($query);

$company = "";
$flag = false;
if($result->num_rows > 0){
    $company = $result->fetch_assoc();
    $flag = true;
}


?>

<?php include("../include/header.php"); ?>

    <div class="inner-wrapper">

        <?php include("../include/left-sidebar.php"); ?>
        <script type="text/javascript" src="../tinymce/jquery.tinymce.min.js"></script>
        <script type="text/javascript" src="../tinymce/tinymce.min.js"></script>

        <style>
            .texteditor-container {
                width: 100%;
                height: 365px;
            }

            textarea#editor1 {
                width: 100% !important;
                border: 1px solid red;
            }

            .mce-branding-powered-by {
                display: none;
            }
        </style>
        
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Job</h2>

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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="posted_jobs.php">View Jobs</a></li>
                            <li class="active"><a href="#">Post Job</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">

            <?php 
                $type  = '';
                if (isset($_SESSION['message'])){
                    $type = $_SESSION['message']['type']; $message = $_SESSION['message']['message'];
                }
                if ($type && $message): ?>
                    <div id="Message" class="<?php echo $type == 'error' ? 'alert-danger' : 'alert-success' ?> col-sm-12" style="margin-bottom: 12px; padding: 12px 12px;"><?php echo $message; ?></div>
                <?php endif; ?>

                <form id="job-form" method="POST" action="../source/helpers/insert_job.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-2">Job Title <span class="required">*</span></label>
                        <div class="col-md-10">
                            <input id="title" type="text" name="title" placeholder=" Python Developer, UX/UI Designer etc. "
                                data-rule-required="true" data-rule-rangelength="[1,120]" data-rule-text="true"
                                class="form-control" required>
                        </div>
                    </div>
                                      
                    <div class="form-group">
                        <input type="hidden" name="logo" class="form-control" value="<?php echo $aboutCompany->LOGO; ?>" >
                        
                        <label class="control-label col-md-2">Industry Type <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input id="industry_type" type="text" name="industry_type"
                                placeholder=" IT " data-rule-required="true" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Address <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input id="location" type="text" name="location" placeholder=" Cannaught Place "
                                data-rule-required="true" data-rule-rangelength="[3,560]" data-rule-text="true"
                                class="form-control" value="" required>
                        </div>
                        <label class="control-label col-md-1" style="text-align: center">City <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input id="city" type="text" name="city" placeholder=" New Delhi " data-rule-required="true"
                                data-rule-rangelength="[1,160]" data-rule-text="true" class="form-control" value="" required>
                        </div>                   
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Paid or Not</label>
                        <div class="col-md-6">
                            <label class="radio-inline">
                                <input type="radio" name="paid" id="paid-yes" value="Y" checked> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="paid" id="paid-no" value="N"> No
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Profile <span class="required">*</span></label>
                        <div class="col-md-10">
                            <input id="profile" type="text" name="profile" placeholder=" Like: Python Developer "
                                data-rule-required="true" data-rule-rangelength="[3,6000]" data-rule-text="true"
                                class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Qualification <span class="required">*</span></label>
                        <div class="col-md-10">
                            <input id="qualification" type="text" name="qualification"
                                placeholder="B.Tech, M.Tech" data-rule-required="true"
                                data-rule-rangelength="[1,6000]" data-rule-text="true" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Key Skills <span class="required">*</span></label>
                        <div class="col-md-10">
                            <input id="skills" type="text" name="skills" placeholder=" Key Skills "
                                data-rule-required="true" data-rule-rangelength="[3,6000]" data-rule-text="true"
                                class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Desired Experience <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="minexperience" placeholder="0 years" data-rule-required="true" data-rule-rangelength="[3,6000]" data-rule-text="true" class="form-control" required>
                        </div>
                        <label class="col-md-1 control-label text-center">to</label>
                        <div class="col-md-5">
                            <input type="text" name="maxexperience" placeholder="3 years" data-rule-required="true" data-rule-rangelength="[3,6000]" data-rule-text="true" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Salary <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input id="salary" type="number" name="minsalary" placeholder=" Min. Salary (lac / annum) "
                                data-rule-required="true" data-rule-rangelength="[1,5]" data-rule-text="true"
                                class="form-control">
                        </div>
                        <label class="control-label col-md-1" style="text-align: center">to</label>
                        <div class="col-md-5">
                            <input id="salary" type="number" name="maxsalary" placeholder=" Max. Salary (lac / annum) "
                                data-rule-required="true" data-rule-rangelength="[1,8]" data-rule-text="true"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nature <span class="required">*</span></label>
                        <div class="col-md-5">
                            <label class="radio-inline">
                                <input type="radio" name="nature" id="full-time" value="Full Time" checked> Full Time
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="nature" id="part-time" value="Part Time"> Part Time
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="nature" id="work-from-home" value="Work From Home"> Work From Home
                            </label>
                        </div>
                        <label class="col-md-1 control-label text-right">Duration <span class="required">*</span></label>
                        <div class="col-sm-4"> 
                            <input id="duration" type="text" name="duration" placeholder=" Duration ex: 3 years" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">LinkedIN ID <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input id="linkedin" type="text" name="linkedin" placeholder=" Enter Linkedin Id" class="form-control" >
                        </div> 
                        <label class="control-label col-md-1">Email <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input id="email" type="email" name="email" placeholder=" Enter Email Id"
                                data-rule-required="true" data-rule-rangelength="[1,80]" data-rule-email="true"
                                class="form-control" value="<?php echo $company['company_email']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Contact Number <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input id="contact_number" type="text" name="contact_number" placeholder="Enter Contact Number" data-rule-required="true" class="form-control"  value=" <?php echo $company['contact_number']; ?>" >
                        </div>
                        <label class="control-label col-md-1">Interview <span class="required">*</span></label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" name="interview_date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12">Job Description <span class="required">*</span></label>
                    
                        <div class="col-md-12">
                            <textarea name="description" class="form-control"> </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="Submit" name="submit" id="create-job-btn" class="btn btn-success form-control">Create Job</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </section>

        <style>
            
            #create-job-btn {
                margin-top: 20px;
            }
        </style>

    </div>

    <?php include '../include/footer.php'; ?>

    <script>
        setTimeout(function() {
            $('#Message').fadeOut('fast');
            <?php unset($_SESSION['message']); ?>
        }, 5000);
    </script>



