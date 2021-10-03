<?php
session_start();
require_once 'init.php';

$_title = 'Thông Tin Lịch Hẹn - Xin chào bác sĩ';
$_active_nav = 'page_appointment';
$_head = '	<!-- Optional: page related CSS-->

	<link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/fa-brands.css">
	<link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/fa-solid.css">
	<link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css1/bacsi.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

';
$_description = 'Appointment Information';

if($_SESSION['user_type_option_user_type'] =='Patient'){
    header("Location: dashboard.php");
}

?>
<!DOCTYPE html>
<!-- 
Template Name:: SmartAdmin PHP 7 Responsive WebApp - Template built with Bootstrap 4 and PHP 7
Version: 4.5.3
Author: Jovanni Lo
Website: https://smartadmin.lodev09.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-php-7-responsive-webapp-WB05M9585
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <?php include_once APP_PATH.'/includes/head.php'; ?>
    <body class="mod-bg-1 mod-nav-link ">
        <?php include_once APP_PATH.'/includes/theme.php'; ?>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <?php include_once APP_PATH.'/includes/nav.php'; ?>
                <div class="page-content-wrapper">
                    <?php include_once APP_PATH.'/includes/header.php'; ?>
                    <?php include_once 'modal/modal_clinical.php'; ?>
                    <?php include_once 'modal/modal_history_detail.php'; ?>
                    <?php include_once 'modal/modal_lab.php'; ?>
                    <?php include_once 'modal/modal_prescription.php'; ?>
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Xin chào bác sĩ</a></li>
                            
                            <li class="breadcrumb-item active" >CUỘC HẸN > <span id="appt-name"></span></li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i style="color: black" class='subheader-icon fas fa-calendar-check'></i> CUỘC HẸN ><span id="appt-name1"></span>
                            </h1>
                        </div>
                        
                        <div class="container" style="padding-right: 0;padding-left: 0;">
                            <div id="page-content">
                                <input type="hidden" id="patient-id">
                                <input type="hidden" id="patient-name">
                                <input type="hidden" id="patient-address">
                                <input type="hidden" id="doctor-id">
                                <input type="hidden" id="doctor-assigned-name">
                                <input type="hidden" id="appointment-id">
                                <input type="hidden" id="diagnostic_list">
                                <div class="row margin_b15">
                                    <div class="col-5">
                                        <div class="col-12 border-gray51" style="height: 140px!important;">
                                            <div class="row">
                                                <div class="col-4 padding_l" id="user-image">

                                                </div>
                                                <div class="col-8 padding_l">
                                                    <div class="col-12 padding_rl" id="user-name"></div>
                                                    <div class="col-12 padding_rl" id="user-year"></div>
                                                    <div class="col-12 padding_rl" id="user-age"></div>
                                                    <div class="col-12 padding_rl" id="user-phone"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 padding_l text-center">Bệnh nhân</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="col-12 border-gray51" style="height: 140px!important;">
                                            <div class="row">
                                                <div class="col-4 padding_l" id="doctor-image">
                                                    
                                                </div>
                                                <div class="col-8 padding_l">
                                                    <div class="col-12 padding_rl" id="doctor-name"></div>
                                                    <div class="col-12 padding_rl"></div>
                                                    <div class="col-12 padding_rl"></div>
                                                    <div class="col-12 padding_rl"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 padding_l text-center">Bác sĩ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin_b15">
                                    <div class="col-6">
                                        <div class="row margin_b10">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="Type">Loại lịch hẹn</label>
                                                    <select class="form-control" id="Type">
                                                        <option value="Telemedicine">Điều trị từ xa</option>
                                                        <option value="Follow-up Video">Tái khám bằng Video</option>
                                                        <option value="Follow-up Office">Tái khám tại văn phòng</option>
                                                        <option value="Office Visit">Khám và tư vấn tại văn phòng</option>
                                                        <option value="Specialist Referral">Giới thiệu chuyên gia</option>
                                                        <option value="Lab Test">Làm xét nghiệm</option>
                                                        <option value="Other">Khác</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4  padding_l">
                                                <div class="form-group">
                                                    <label  for="date">Date</label>
                                                    <input class="form-control" id="date" type="date" name="date" value="2023-07-23">
                                                </div>
                                            </div>
                                            <div class="col-3 padding_rl">
                                                <div class="form-group">
                                                    <label  for="time-2">Time</label>
                                                    <input class="form-control" id="time-2" type="time" name="time" value="03:30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin_b10">
                                            <div class="col-12 padding_r">
                                                <div class="form-group">
                                                    <label  for="Disposition">Vị trí cuộc hẹn</label>
                                                    <select class="form-control" id="Disposition">
                                                        <option value="Waiting - Triage" selected="selected">Chờ xử lý</option>
                                                        <option value="Triage">Đang xử lý</option>
                                                        <option value="Waiting - Physician">Chờ bác sĩ</option>
                                                        <option value="Consultation">Đang tư vấn</option>
                                                        <option value="Waiting on Testing">Chờ kết quả XN</option>
                                                        <option value="Complete">Hoàn thành</option>
                                                        <option value="No Show">Không hiển thị</option>
                                                        <option value="No Disposition">Chưa xác nhận</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin_b10">
                                            <div class="col-12 padding_r">
                                                <div class="form-group">
                                                    <label  for="ChiefComplaint">Khám bệnh gì</label>
                                                    <select class="form-control" id="ChiefComplaint">
                                                        <option value="Headache">Đau đầu</option>
                                                        <option value="Stomach Pain">Đau bụng</option>
                                                        <option value="Upset Stomach">Đau dạ dày</option>
                                                        <option value="Leg Pain">Đau chân</option>
                                                        <option value="Hand Pain">Đau tay</option>
                                                        <option value="Sore throat">Đau họng</option>
                                                        <option value="Pregnancy">Khám thai</option>
                                                        <option value="Other">Khác</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin_b10">
                                            <div class="col-12 padding_r">
                                                <div class="form-group">
                                                    <label  for="Description">Mô tả</label>
                                                    <textarea class="form-control" id="Description" rows="5" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin_b10">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label  for="TriageStaff">Y tá chỉ định</label>
                                                    <select class="form-control" id="TriageStaff">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 padding_r">
                                                <div class="form-group">
                                                    <label  for="AssignedDoctor">Bác sĩ chỉ định</label>
                                                    <select class="form-control" id="AssignedDoctor">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin_b10">
                                            <div class="col-12 padding_r">
                                                <div class="form-group">
                                                    <label  for="Notes">Lịch sử Ghi chú</label>
                                                    <textarea class="form-control" id="Notes" rows="6" ></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end col-6-->
                                    <div class="col-6">
                                        <div class="row margin_b10">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label  for="Webmeeting">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <a href="#"><u class="color-alert">Webmeeting</u></a>
                                                            </div>
                                                            <div class="col-2">
                                                                <i class="fa fa-external-link"></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input type="text" id="Webmeeting" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 border-gray51">
                                                    <div class="row margin_b10">
                                                        <div class="col-2 padding_r">
                                                            <div class="form-group">
                                                                <label for="BloodPressureDiastolic">Huyết áp</label>
                                                                <input type="text" id="BloodPressureDiastolic" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 padding_r">
                                                            <div class="form-group">
                                                                <label for="BloodPressureSystolic">&nbsp;</label>
                                                                <input type="text" id="BloodPressureSystolic" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 padding_r">
                                                            <div class="form-group">
                                                                <label for="HeartRate">Nhịp tim (BPM)</label>
                                                                <input type="text" id="HeartRate" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="RespiratoryRate">Nhịp thở</label>
                                                                <input type="text" id="RespiratoryRate" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_b10">
                                                        <div class="col-4 padding_r">
                                                            <div class="form-group">
                                                                <label for="BMI">BMI</label>
                                                                <input type="text" id="BMI" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 padding_r">
                                                            <div class="form-group">
                                                                <label for="Temperature">Nhiệt độ</label>
                                                                <input type="text" id="Temperature" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="O2Staturation">Độ bão hòa oxi</label>
                                                                <input type="text" id="O2Staturation" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_b10">
                                                        <div class="col-4 padding_r">
                                                            <div class="form-group">
                                                                <label for="Glucose">Đường huyết</label>
                                                                <input type="text" id="Glucose" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 padding_r">
                                                            <div class="form-group">
                                                                <label for="PainLevel">Mức độ đau đớn</label>
                                                                <input type="text" id="PainLevel" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="Weight">Cân nặng</label>
                                                                <input type="text" id="Weight" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_b10">
                                                        <div class="col-4 padding_r">
                                                            <div class="form-group">
                                                                <label for="Height">Chiều cao</label>
                                                                <input type="text" id="Height" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_b10">
                                                        <div class="col-12">
                                                            <button class="btn btn-succ" id="clinical_show">KHÁM LÂM SÀNG VÀ CẬN LÂM SÀN</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin_b10 margin-top25">
                                            <div class="col-12 ">
                                                <div class="form-group">
                                                    <label  for="Notes">File đính kèm</label>
                                                    <textarea class="form-control" id="Notes" rows="6" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-6-->
                                </div>
                                <div class="row margin_b30">
                                    <div class="col-2"><button class="btn btn-succ w100"><strong>Thêm ghi chú</strong></button></div>
                                    <div class="col-2"><button class="btn btn-succ w100" id="lab-test-new"><strong>Xét nghiệm mới</strong></button></div>
                                    <div class="col-2"><button class="btn btn-succ w100" id="pres-add-new"><strong>Đơn thuốc mới</strong></button></div>
                                </div>
                                <!--tab-->
                                <ul class="nav nav-pills nav-justified" style="border-bottom: 1px solid rgba(0,0,0,.07);" role="tablist">
                                    <li class="nav-item" ><a class="nav-link active" data-toggle="pill" href="#nav_1" style="font-size: 13px">Tiền sử</a></li>
                                    <li class="nav-item" id="tab-appt-click"><a class="nav-link" data-toggle="pill" href="#nav_2" style="font-size: 13px">Lịch hẹn</a></li>
                                    <li class="nav-item" id="tab-lab-click"><a class="nav-link" data-toggle="pill" href="#nav_3" style="font-size: 13px">Xét nghiệm</a></li>
                                    <li class="nav-item" id="tab-prescription-click"><a class="nav-link" data-toggle="pill" href="#nav_4" style="font-size: 13px">Toa thuốc</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#nav_5" style="font-size: 13px">Tài liệu</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#nav_6" style="font-size: 13px">Ghi chú</a></li>
                                    <li class="nav-item" id="tab-invoice-click"><a class="nav-link" data-toggle="pill" href="#nav_7" style="font-size: 13px">Thanh toán</a></li>
                                </ul>
                                <div class="tab-content py-3">
                                    <div class="tab-pane fade show active" id="nav_1" role="tabpanel">
                                        <?php include_once 'tab/history.php'; ?>
                                    </div>
                                    <div style="min-height: 500px;" class="tab-pane fade" id="nav_2" role="tabpanel">
                                        <?php include_once 'tab/history_appointment.php'; ?>
                                    </div>
                                    <div style="min-height: 500px;" class="tab-pane fade" id="nav_3" role="tabpanel">
                                        <?php include_once 'tab/history_lab.php'; ?>
                                    </div>
                                    <div style="min-height: 500px;" class="tab-pane fade" id="nav_4" role="tabpanel">
                                        <?php include_once 'tab/history_prescription.php'; ?>
                                    </div>
                                    <div style="min-height: 500px;" class="tab-pane fade" id="nav_5" role="tabpanel">
                                        <form>
                                            <div class="row " style="text-align: center">
                                                <div class="col order-last">
                                                    <button style="font-size: 16px; padding: 10px 50px;" type="button" class="btn btn-info btn-pills">Tạo mới</button>
                                                </div>
                                                <div class="col">

                                                </div>
                                                <div class="col order-first">
                                                    <h3><strong>Tài liệu</strong></h3>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div style="min-height: 500px;" class="tab-pane fade" id="nav_6" role="tabpanel">
                                        <h2 class="pl-3"><strong>Ghi chú</strong></h2>
                                    </div>
                                    <div style="min-height: 500px;" class="tab-pane fade" id="nav_7" role="tabpanel">
                                        <?php include_once 'tab/history_inv.php'; ?>
                                    </div>
                                </div>
                                <!--endtab-->


                            </div>
                            <!--end panel-->
                        </div>

                    </main>
                    <!-- END Page Content -->
                    <?php include_once APP_PATH.'/includes/footer.php'; ?>
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <?php include_once APP_PATH.'/includes/extra.php'; ?>
        <?php include_once APP_PATH.'/includes/js.php'; ?>

        <script src="<?= APP_URL; ?>/js/appointment/appointment_edit.js" type="text/javascript"></script>

        <script src="<?= APP_URL; ?>/js/modal/modal_history_detail.js" type="text/javascript"></script>
        <script src="<?= APP_URL; ?>/js/modal/modal_clinical.js" type="text/javascript"></script>

        <script src="<?= APP_URL; ?>/js/tab/history_detail.js" type="text/javascript"></script>
        <script src="<?= APP_URL; ?>/js/tab/history_appointment.js" type="text/javascript"></script>
        <script src="<?= APP_URL; ?>/js/tab/history_lab.js" type="text/javascript"></script>
        <script src="<?= APP_URL; ?>/js/tab/history_prescription.js" type="text/javascript"></script>
        <script src="<?= APP_URL; ?>/js/tab/history_inv.js" type="text/javascript"></script>

        <script src="<?= APP_URL; ?>/js/appointment/patient_appointment.js" type="text/javascript"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
        <script src="<?= APP_URL; ?>/js/jquery.twbsPagination.js" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

        <script>
            $("#clinical_show").unbind("click").bind("click",function(){
                $('#clinical-modal-center').modal('show')
            })

        </script>
    </body>
</html>
