<?php

session_start();
require_once("../config.php");

$_SESSION['company_id'] = 1;

$company_id = 1;
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

        <?php include("../include/left-sidebar.php");  ?>
        
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Internship</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.html">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Dashboard</span></li>
                    </ol>
                    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>

                <div class="widget-body">

                <?php
                $type  = '';
                if (isset($_SESSION['message'])){
                    $type = $_SESSION['message']['type']; $message = $_SESSION['message']['message'];
                }
                if ($type && $message): ?>
                    <div id="Message" class="<?php echo $type == 'error' ? 'alert-danger' : 'alert-success' ?> col-sm-12" style="margin-bottom: 12px; padding: 12px 12px;"><?php echo $message; ?></div>
                <?php endif; ?>

                    <form id="intern-form" method="POST" action="../source/helpers/insert_intern.php" enctype="multipart/form-data">
                    
                         <div class="form-group">
                            <label class="control-label col-md-2">Intern Title <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input id="title" type="text" name="title" placeholder=" Python Developer, UX/UI Designer etc. "
                                    data-rule-required="true" data-rule-rangelength="[1,120]" data-rule-text="true"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">                            
                            <label class="control-label col-md-2">Industry Type <span class="required">*</span></label>
                            <div class="col-md-6">
                                <input id="industry_type" type="text" name="industry_type"
                                    placeholder=" IT " data-rule-required="true" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Address <span class="required">*</span></label>
                            <div class="col-md-5">
                                <input id="location" type="text" name="location" placeholder=" Cannaught Place "
                                    data-rule-required="true" data-rule-rangelength="[3,560]" data-rule-text="true"
                                    class="form-control" value="">
                            </div>
                            <label class="control-label col-md-1" style="text-align: center">City <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="city" type="text" name="city" placeholder=" New Delhi " data-rule-required="true"
                                    data-rule-rangelength="[1,160]" data-rule-text="true" class="form-control" value="">
                            </div>                   
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Profile <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="profile" type="text" name="profile" placeholder=" Like: Python Developer "
                                    data-rule-required="true" data-rule-rangelength="[3,6000]" data-rule-text="true"
                                    class="form-control" value="">
                            </div>
                            <label class="control-label col-md-2">Number of Seats <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" name="no_of_seats" placeholder=" Number of seats " data-rule-required="true"
                                   data-rule-rangelength="[1,160]" data-rule-text="true" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Key Skills <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input id="skills" type="text" name="skills" placeholder=" Key Skills "
                                    data-rule-required="true" data-rule-rangelength="[3,6000]" data-rule-text="true"
                                    class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Stipend <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="minstipend" type="number" name="minstipend" placeholder=" Min. Stipend  "
                                    data-rule-required="true" data-rule-rangelength="[1,5]" data-rule-text="true"
                                    class="form-control">
                            </div>
                            <label class="control-label col-md-1" style="text-align: center">to</label>
                            <div class="col-md-5">
                                <input id="maxstipend" type="number" name="maxstipend" placeholder=" Max. Stipend  "
                                    data-rule-required="true" data-rule-rangelength="[1,8]" data-rule-text="true"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Start Date <span class="required">*</span></label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                            </div>
                            <label class="control-label col-md-1">Last Date <span class="required">*</span></label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="last_date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Employment Type</label>
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
                                <select name="duration" class="form-control">
                                    <option value="1">1 Month</option>
                                    <option value="2">2 Months</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="12">12 Months</option>
                                    <option value="24">24 Months</option>
                                    <option value="36">36 Months</option>
                                </select>
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
                                    class="form-control" value="<?php echo $company['company_email']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Contact Number <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="contact_number" type="text" name="contact_number" pattern="[0-9]{10}"
                                    placeholder=" Enter Contact Number " data-rule-required="true" class="form-control" value="<?php echo $company['contact_number']; ?>" required>
                            </div>

                            <label class="control-label col-md-1">Interview <span class="required">*</span></label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="interview_date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Internship Description <span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control" placeholder="Describe about internship" required> </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-editor3-container">
                                <label class="col-md-12 control-label">Who can apply ? <span class="required">*</span></label>
                                <div class="col-md-12">
                                    <textarea name="eligible" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="Submit" name="submit" id="create-intern-btn" class="btn btn-success form-control">Create Internship</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        <style>
           
            #create-intern-btn {
                margin: 20px;
            }
        </style>

        <?php include("../include/right-sidebar.php"); ?>

    </div>

    <?php include '../include/footer.php'; ?>

    <script>
        setTimeout(function() {
            $('#Message').fadeOut('fast');
            <?php unset($_SESSION['message']); ?>
        }, 5000);
    </script>

