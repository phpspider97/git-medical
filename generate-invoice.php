
<?php
include("root.php");
include(SITE_ROOT . "/classes/Report.php");
$report_obj = new Report();

include(SITE_ROOT . "/includes/test_result_data.php");
include(SITE_ROOT . "/classes/Encryption.php");
$encryption_obj = new Encryption();

$is_display = false;
$show_side_bar = 'none';

$patient_name = $patient_email = $patient_mobile = $patient_note = '';
$patient_age_sex = $ref_dr = $added_date = '';
$lab_number = $admin_id = $patient_id = '';
$encrypted_patient_id = '';
$member_display_name = $image_path = $admin_email = $logo_image = '';
$admin_bio = $admin_shop_address = $admin_shop_name = '';
$get_breif_report_data = [];
$a_get_report_data = [];
$is_header_display = 1;

function invoice_h($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function invoice_redirect($url) {
    if (ob_get_length()) {
        ob_clean();
    }
    header("Location: " . $url);
    exit();
}

/* Delete report */
if ((isset($_GET['delete']) || isset($_GET['delete_id'])) && isset($_GET['patient_data'])) {
    $patient_id = $encryption_obj->decode($_GET['patient_data']);
    $is_delete = $report_obj->patientDataDelete($patient_id);

    if ($is_delete) {
        $_SESSION['notify_message'] = "Patient information and all reports deleted successfully.";
        $_SESSION['notify_type'] = 'success';
    }

    invoice_redirect(SITE_URL . "/manage-report.php");
}

/* Load patient and report data */
if (isset($_GET['patient_data'])) {
    $is_display = isset($_GET['is_display']);
    $encrypted_patient_id = $_GET['patient_data'];
    $patient_id = $encryption_obj->decode($encrypted_patient_id);

    $button_text = 'Update';
    $admin_id = $report_obj->getAddedByID($patient_id);
    $page_data = $report_obj->getPatientData($admin_id, $patient_id);

    $a_get_data = $setting_obj->getData($admin_id);

    if (!empty($a_get_data)) {
        $is_header_display = $a_get_data['is_report_header'] ?? 1;
    }

    if (!empty($page_data)) {
        $patient_name = $page_data['patient_name'] ?? '';
        $patient_email = $page_data['patient_email'] ?? '';
        $patient_mobile = $page_data['patient_mobile'] ?? '';
        $patient_note = $page_data['patient_note'] ?? '';
        $lab_number = $page_data['lab_number'] ?? '';

        $age = $page_data['patient_age'] ?? '';
        $sex = ucwords($page_data['patient_sex'] ?? '');
        $patient_age_sex = trim($age . ' / ' . $sex, ' /');

        $ref_dr = $page_data['ref_dr'] ?? '';
        $added_date = $page_data['added_date'] ?? '';

        if ($added_date && strtotime($added_date)) {
            $added_date = date('d-m-Y', strtotime($added_date));
        }

        $a_get_lab_data = $page_data['get_lab_data'] ?? [];

        $admin_id = $a_get_lab_data['admin_id'] ?? $admin_id;
        $member_display_name = $a_get_lab_data['admin_name'] ?? '';
        $logo_image = $a_get_lab_data['user_image'] ?? '';
        $image_path = $a_get_lab_data['data_image'] ?? '';
        $admin_email = $a_get_lab_data['admin_email'] ?? '';
        $admin_bio = $a_get_lab_data['admin_about_shop'] ?? '';
        $admin_shop_address = $a_get_lab_data['admin_shop_address'] ?? '';
        $admin_shop_name = $a_get_lab_data['admin_shop_name'] ?? '';

        if (isset($_SESSION['admin_id']) && $admin_id == $_SESSION['admin_id']) {
            $show_side_bar = 'display';
        }

        $get_breif_report_data = $page_data['get_breif_report_data'] ?? [];
        $a_get_report_data = $page_data['get_report_data'] ?? [];

        if (
            preg_match("/^(Mozilla|Opera|PSP|Bunjalloo|wii)/i", $_SERVER['HTTP_USER_AGENT'] ?? '') &&
            !preg_match("/bot|crawl|crawler|slurp|spider|link|checker|script|robot|discovery|preview/i", $_SERVER['HTTP_USER_AGENT'] ?? '')
        ) {
            $report_obj->updateReportView($patient_id, 'lab_patient');
        }
    }
}

/* Share URL */
$report_url = SITE_URL . "/generate-invoice.php?patient_data=" . urlencode($encrypted_patient_id);
$url_encode_data = urlencode($report_url);

/* Send report link */
if (isset($_POST['send_link']) && !empty($patient_id)) {
    unset($_POST['send_link']);
    $_POST['admin_id'] = $admin_id;

    $is_updated = $report_obj->sendLinkEmail($_POST);

    $_SESSION['notify_message'] = $is_updated['msg'] ?? 'Unable to send report link.';
    $_SESSION['notify_type'] = (($is_updated['status'] ?? 0) == 200) ? 'success' : 'danger';

    invoice_redirect(
        SITE_URL_ADMIN . "/generate-invoice.php?patient_data=" . urlencode($encrypted_patient_id)
    );
}

/* Laboratory details */
$lab_title = !empty($admin_shop_name) ? $admin_shop_name : 'BAINS';
$lab_owner = !empty($member_display_name) ? $member_display_name : 'Lakhwinder Singh';
$lab_email = !empty($admin_email) ? $admin_email : '';
$lab_address = !empty($admin_shop_address)
    ? $admin_shop_address
    : 'Vill. Kahiwal (Sri Anandpur Sahib), Distt. Ropar';

$lab_contact_numbers = '99150-25493, 94175-24172';
$lab_qualification = '(Lucky) D.M.L.T.';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Test Report">

    <title>Laboratory Report - <?= invoice_h($patient_name); ?></title>

    <link rel="stylesheet" href="<?= SITE_URL; ?>/assets/css/invoice.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        function changeTemplate(template_id) {
            $('#submit-spin').show();

            $.ajax({
                type: 'POST',
                url: '../ajax/change-template.php',
                data: { template_id: template_id },

                success: function(response) {
                    $('#submit-spin').hide();
                    $('.email_template').html(response);
                },

                error: function() {
                    $('#submit-spin').hide();
                    alert('Unable to change template.');
                }
            });
        }

        function PrintPage() {
            $('.mobile-bottom-nav').hide();
            window.print();
            $('.mobile-bottom-nav').show();
        }

        function copyLink(selector) {
            var input = document.querySelector(selector);

            if (!input) return;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(input.value).then(function() {
                    alert('Link copied successfully!');
                });
            } else {
                input.select();
                document.execCommand('copy');
                alert('Link copied successfully!');
            }
        }

        function updateShareCount(patient_id) {
            $.ajax({
                type: 'POST',
                url: '<?= SITE_URL_ADMIN; ?>/ajax/report-share-update.php',
                data: { patient_id: patient_id }
            });
        }
    </script>

    <style>
        body{
            margin:100px;
        }
        /* =====================================
           GENERAL REPORT DESIGN
        ===================================== */

        #html-template {
            width: 100%;
            box-sizing: border-box;
            background: #fff;
            color: #111;
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 14px;
            line-height: 1.5;
        }

        #html-template * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .cs-invoice,
        .cs-invoice_in {
            background: #fff;
        }

        /* =====================================
           LAB LETTERHEAD
        ===================================== */

        .lab-letterhead {
            width: 100%;
            color: #080b86;
            font-family: Arial, Helvetica, sans-serif !important;
            margin-bottom: 12px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .lab-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
        }

        .lab-brand {
            flex: 1.2;
            text-align: center;
            min-width: 0;
        }

        .lab-logo img {
            max-width: 75px;
            max-height: 60px;
            object-fit: contain;
        }

        .lab-brand h1 {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 38px;
            font-weight: 900;
            margin: 0;
            line-height: 1.1;
            color: red;
        }

        .lab-brand h2 {
            font-size: 20px;
            font-weight: bold;
            margin: 3px 0 6px;
            color: #080b86;
        }

        .lab-address {
            background: #42baf0;
            border: 1px solid #111;
            border-radius: 5px;
            padding: 6px 8px;
            color: #080b86;
            font-size: 13px;
            font-weight: bold;
            line-height: 1.5;
        }

        .lab-owner {
            flex: 1;
            text-align: center;
            overflow-wrap: anywhere;
            min-width: 0;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.5;
        }

        .lab-owner h3 {
            font-size: 19px;
            font-weight: bold;
            margin: 0;
            color: #080b86;
        }

        .lab-owner h4 {
            font-size: 15px;
            margin: 0 0 10px;
            font-weight: bold;
        }

        .lab-owner strong {
            font-size: 14px;
            text-decoration: underline;
        }

        .lab-owner p {
            font-size: 13px;
            font-weight: 600;
            margin: 3px 0;
        }

        .lab-contact-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 6px;
            background: #42baf0;
            border-top: 2px solid #111;
            border-bottom: 3px double #111;
            padding: 7px 10px;
            color: #080b86;
        }

        .lab-contact-bar strong {
            font-size: 17px;
            white-space: nowrap;
        }

        /* =====================================
           PATIENT INFORMATION
        ===================================== */

        #html-template .cs-heading {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 19px !important;
            font-weight: 700 !important;
            color: #000 !important;
            margin-bottom: 12px;
        }

        #html-template ul.cs-grid_row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin: 0;
            padding: 12px !important;
            /* background: #f7f7f7; */
            list-style: none;
        }

        #html-template ul li {
            min-width: 0;
        }

        #html-template ul li p {
            font-size: 14px !important;
            line-height: 1.6 !important;
            margin-bottom: 7px !important;
            overflow-wrap: anywhere;
        }

        #html-template ul li b {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #000 !important;
        }

        #html-template ul li span {
            font-size: 14px !important;
            color: #111 !important;
        }

        /* =====================================
           TEST RESULT TABLE
        ===================================== */

        #html-template .cs-table {
            /* margin-top: 10px; */
            width: 100%;
        }

        #html-template .cs-table table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        #html-template .cs-table thead th {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #000 !important;
            padding: 10px 7px !important;
            background: #eaeaea !important;
            border-bottom: 2px solid #222 !important;
            line-height: 1.4;
            vertical-align: middle;
        }

        #html-template .cs-table tbody td {
            font-size: 14px !important;
            font-weight: 400;
            color: #111 !important;
            padding: 7px 7px !important;
            line-height: 1.5 !important;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }

        /* Test category */
        #html-template .cs-table tbody td b {
            font-size: 16px !important;
            font-weight: 700 !important;
            color: #000 !important;
        }

        /* Test observed value */
        #html-template .cs-table tbody td:nth-child(2) {
            font-size: 15px !important;
            font-weight: 600;
        }

        /* Reference range */
        #html-template .cs-table tbody td:nth-child(4) {
            font-size: 13px !important;
            color: #222 !important;
        }

        /* Widal test nested table */
        #html-template .cs-table tbody table td {
            font-size: 13px !important;
            padding: 7px 5px !important;
            text-align: center;
        }

        /* =====================================
           PATIENT NOTE
        ===================================== */

        #html-template .cs-note {
            font-size: 14px !important;
            line-height: 1.6 !important;
            color: #111 !important;
            margin-top: 15px;
        }

        #html-template .cs-note b {
            font-size: 15px !important;
            font-weight: 700;
        }

        /* =====================================
           LAB FOOTER
        ===================================== */

        .lab-footer {
            width: 100%;
            margin-top: 16px;
            color: #080b86;
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: bold;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .lab-footer-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 5px 20px;
        }

        .sample-collection {
            background: #42baf0;
            border: 1px solid #111;
            padding: 7px 10px;
            font-size: 14px;
            font-weight: bold;
        }

        .lab-technician {
            font-size: 14px;
            padding-right: 25px;
        }

        .lab-equipment {
            color: red;
            font-size: 13px;
            text-align: left;
            padding: 5px;
            font-weight: bold;
        }

        .lab-facilities {
            text-align: center;
            font-size: 12px;
            border-top: 2px solid #111;
            border-bottom: 2px solid #111;
            padding: 7px 3px;
            line-height: 1.5;
        }

        .lab-disclaimer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            background: #42baf0;
            color: #080b86;
            border: 1px solid #111;
            padding: 8px;
            font-size: 11px;
            line-height: 1.5;
        }

        .lab-disclaimer strong {
            white-space: nowrap;
        }

        /* =====================================
           LOADING SPINNER
        ===================================== */

        #submit-spin {
            position: fixed;
            width: 100%;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(255,255,255,0.7);
            z-index: 9999;
            display: none;
        }

        #submit-spin::after {
            content: '';
            display: block;
            position: absolute;
            left: 48%;
            top: 40%;
            width: 40px;
            height: 40px;
            border: 4px solid #000;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* =====================================
           PRINT A4 REPORT
        ===================================== */

        @media print {

            @page {
                size: A4;
                margin: 8mm;
            }

            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
                font-family: Arial, Helvetica, sans-serif !important;
                color: #000 !important;
                font-size: 14px !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .cs-container {
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .cs-invoice {
                border: 0 !important;
                box-shadow: none !important;
            }

            .mobile-bottom-nav,
            .cs-invoice_btns,
            .notification-div,
            #submit-spin,
            .modal {
                display: none !important;
            }

            #html-template,
            #html-template * {
                font-family: Arial, Helvetica, sans-serif !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            #html-template {
                font-size: 14px !important;
                color: #000 !important;
            }

            #html-template .cs-heading {
                font-size: 18px !important;
            }

            #html-template ul li p,
            #html-template ul li b,
            #html-template ul li span {
                font-size: 13.5px !important;
            }

            #html-template .cs-table thead th {
                font-size: 13.5px !important;
                padding: 7px 5px !important;
            }

            #html-template .cs-table tbody td {
                font-size: 13.5px !important;
                padding: 6px 5px !important;
            }

            #html-template .cs-table tbody td b {
                font-size: 15px !important;
            }

            #html-template .cs-table tbody td:nth-child(2) {
                font-size: 14px !important;
                font-weight: 600 !important;
            }

            #html-template .cs-table tbody td:nth-child(4) {
                font-size: 12.5px !important;
            }

            .lab-letterhead,
            .lab-footer {
                break-inside: avoid !important;
                page-break-inside: avoid !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            tr {
                break-inside: avoid !important;
                page-break-inside: avoid !important;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }
        }

        /* =====================================
           MOBILE REPORT
        ===================================== */

        @media screen and (max-width: 600px) {

            .lab-header-top {
                flex-direction: column;
            }

            .lab-brand h1 {
                font-size: 32px;
            }

            .lab-brand h2 {
                font-size: 18px;
            }

            .lab-contact-bar {
                font-size: 12px;
            }

            .lab-contact-bar strong {
                font-size: 14px;
            }

            #html-template ul.cs-grid_row {
                grid-template-columns: 1fr;
            }

            #html-template .cs-table {
                overflow-x: auto;
            }

            #html-template .cs-table table {
                min-width: 600px;
            }

            #html-template .cs-table tbody td {
                font-size: 12px !important;
                padding: 6px 4px !important;
            }

            #html-template .cs-table thead th {
                font-size: 12px !important;
                padding: 7px 4px !important;
            }

            .lab-footer-top {
                padding: 5px;
            }

            .lab-disclaimer {
                flex-direction: column;
                align-items: flex-start;
                font-size: 11px;
            }

            .lab-disclaimer strong {
                white-space: normal;
            }
        }

    </style>
</head>

<body>

<?php if (isset($_SESSION['notify_message'])) { ?>

    <div class="notification-div alert alert-<?= invoice_h($_SESSION['notify_type'] ?? 'info'); ?> p-2 mt-3 text-center">
        <?= invoice_h($_SESSION['notify_message']); ?>
    </div>

    <?php unset($_SESSION['notify_message'], $_SESSION['notify_type']); ?>

<?php } ?>

<div class="single-html-block">

    <div id="html-template">

        <div class="<?= !empty($is_header_display) ? 'cs-invoice cs-style' : 'cs-invoice cs-style cs-invoice-no-header cs-style-no-header'; ?>"
             style="border:1px solid #000;">

            <div class="cs-invoice_in" id="download_section">

                <?php if (!empty($is_header_display)) { ?>

                <!-- LAB HEADER -->

                <div class="lab-letterhead">

                    <div class="lab-header-top">

                        <div class="lab-brand">

                            <h1>
                                <span style="color:red !important"><?= invoice_h($lab_title); ?></span> <br />
                                LABORATORY
                            </h1>

                            <div class="lab-address">
                                <?= invoice_h($lab_address); ?>
                            </div>

                        </div>

                        <div class="lab-owner">

                            <?php if (!empty($image_path)) { ?>

                                <div class="lab-logo">
                                    <img src="<?= invoice_h($image_path); ?>"
                                         alt="Laboratory Logo">
                                </div> 
                            <?php } ?>

                            Fully Computerised

                            <p><?= invoice_h($lab_email); ?></p>

                            <?= invoice_h($lab_contact_numbers); ?>

                        </div>

                    </div>

                    <div class="lab-contact-bar text-center">

                        <strong>LAB-REPORT</strong>

                    </div>

                </div>

                <?php } ?>

                <!-- PATIENT INFORMATION -->

                <div class="cs-heading cs-style cs-f18 cs-primary_color cs-mb15 cs-semi_bold">
                   &nbsp; Patient Information
                </div>

                <ul class="cs-grid_row cs-col_3"
                    style="border-top:1px solid #000;border-bottom:0px solid #000;">

                    <li>

                        <p class="cs-mb10">
                            <b>Patient Name:</b>
                            <span><?= invoice_h($patient_name); ?></span>
                        </p>

                        <p class="cs-mb0">
                            <b>Patient Age/Sex:</b>
                            <span><?= invoice_h($patient_age_sex); ?></span>
                        </p>

                    </li>

                    <li>

                        <p class="cs-mb10">
                            <b>Ref doctor:</b>
                            <span><?= invoice_h(ucwords($ref_dr)); ?></span>
                        </p>

                        <p class="cs-mb0">
                            <b>Sample Collected On:</b>
                            <span><?= invoice_h($added_date); ?></span>
                        </p>

                    </li>

                    <li>

                        <p class="cs-mb10">
                            <b>Patient Mobile:</b>
                            <span><?= invoice_h($patient_mobile); ?></span>
                        </p>

                    </li>

                </ul>

                <!-- TEST RESULT TABLE -->

                <div class="cs-table cs-style2">

                    <div class="cs-round_border1">

                        <div class="cs-table_responsive">

                            <table>

                                <thead>

                                    <tr class="cs-focus_bg1">

                                        <th class="cs-width_4 cs-semi_bold cs-primary_color">
                                            Test Description
                                        </th>

                                        <th class="cs-width_2 cs-semi_bold cs-primary_color">
                                            Observed Value
                                        </th>

                                        <th class="cs-width_2 cs-semi_bold cs-primary_color cs-text_right">
                                            Unit
                                        </th>

                                        <th class="cs-width_6 cs-semi_bold cs-primary_color cs-text_right">
                                            Reference Range
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                <?php if (!empty($get_breif_report_data)) { ?>

                                    <?php foreach ($get_breif_report_data as $test_description => $data_value) { ?>

                                        <?php if ($test_description == 'Widal test') { ?>

                                            <tr>

                                                <td colspan="4" style="padding:0;">

                                                    <table style="width:100%;">

                                                        <tr>

                                                            <td colspan="7">

                                                                <b style="font-size:16px;margin-top:15px;display:block;color:#000;">
                                                                    <i class="fa fa-hand-point-right"></i>
                                                                    <?= invoice_h(ucfirst($test_description)); ?>
                                                                </b>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td><b>-</b></td>
                                                            <td class="text-center"><b>1:20</b></td>
                                                            <td class="text-center"><b>1:40</b></td>
                                                            <td class="text-center"><b>1:80</b></td>
                                                            <td class="text-center"><b>1:160</b></td>
                                                            <td class="text-center"><b>1:320</b></td>
                                                            <td class="text-center"><b>1:640</b></td>

                                                        </tr>

                                                        <?php if (!empty($data_value)) { ?>

                                                            <?php foreach ($data_value as $a_data_key => $data_value_detail) {

                                                                $data_key = explode('@', $a_data_key)[0];

                                                                $widal_values = explode(',', (string)$data_value_detail);

                                                                $widal_values = array_pad($widal_values, 6, '');

                                                            ?>

                                                                <tr>

                                                                    <td>- <?= invoice_h($data_key); ?></td>

                                                                    <?php for ($i = 0; $i < 6; $i++) { ?>

                                                                        <td class="text-center">
                                                                            <?= invoice_h($widal_values[$i]); ?>
                                                                        </td>

                                                                    <?php } ?>

                                                                </tr>

                                                            <?php } ?>

                                                        <?php } ?>

                                                    </table>

                                                </td>

                                            </tr>

                                        <?php } else { ?>

                                            <tr>

                                                <td class="cs-width_4 colicon" colspan="4">

                                                    <b style="font-size:16px;color:#000;margin-top:15px;display:block;">

                                                        <!-- <i class="fa fa-hand-point-right"></i> -->

                                                       - <?= invoice_h(ucfirst($test_description)); ?>

                                                    </b>

                                                </td>

                                            </tr>

                                            <?php if (!empty($data_value)) { ?>

                                                <?php foreach ($data_value as $a_data_key => $data_value_detail) {

                                                    $key_parts = explode('@', $a_data_key);

                                                    $data_key = $key_parts[0] ?? '';
                                                    $data_unit = $key_parts[1] ?? '';
                                                    $data_parameter = $key_parts[2] ?? '';

                                                    $numeric_result = (float)filter_var(
                                                        $data_value_detail,
                                                        FILTER_SANITIZE_NUMBER_FLOAT,
                                                        FILTER_FLAG_ALLOW_FRACTION
                                                    );

                                                    $range_parts = explode('-', filter_var(
                                                        $data_parameter,
                                                        FILTER_SANITIZE_NUMBER_FLOAT,
                                                        FILTER_FLAG_ALLOW_FRACTION
                                                    ));

                                                    $danger_signal_style = '';

                                                    if (count($range_parts) >= 2 && $data_unit != 'Nill') {

                                                        $min_range = (float)$range_parts[0];
                                                        $max_range = (float)$range_parts[1];

                                                        if ($numeric_result < $min_range || $numeric_result > $max_range) {
                                                            $danger_signal_style = 'font-weight: 800 !important;';
                                                        }
                                                    }

                                                    $display_unit = ($data_unit == 'Nill') ? '' : $data_unit;

                                                    $display_parameter = str_replace('/Nill', '', $data_parameter);

                                                ?>

                                                    <tr>

                                                        <td class="cs-width_4">
                                                            - <?= invoice_h($data_key); ?>
                                                        </td>

                                                        <td class="cs-width_2">

                                                            <?php if (!empty($danger_signal_style)) { ?>

                                                               <span style="<?= $danger_signal_style; ?>"><?= invoice_h($data_value_detail); ?></span>

                                                            <?php } else { ?>

                                                                <?= invoice_h($data_value_detail); ?>

                                                            <?php } ?>

                                                        </td>

                                                        <td class="cs-width_2 cs-text_right">
                                                            <?= invoice_h($display_unit); ?>
                                                        </td>

                                                        <td class="cs-width_6 cs-text_right cs-primary_color">
                                                            <?= invoice_h($display_parameter); ?>
                                                        </td>

                                                    </tr>

                                                <?php } ?>

                                            <?php } ?>

                                        <?php } ?>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="4">No record.</td>
                                    </tr>

                                <?php } ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- PATIENT NOTE -->

                <?php if (!empty($patient_note)) { ?>

                    <div class="cs-note">

                        <div class="cs-note_right">

                            <p class="cs-mb0">
                                <b>Note:</b>
                            </p>

                            <p class="cs-m0">
                                <?= nl2br(invoice_h($patient_note)); ?>
                            </p>

                        </div>

                    </div>

                <?php } ?>

                <?php if (!empty($is_header_display)) { ?>

                <!-- LAB FOOTER -->

                <div class="lab-footer">
 
                    <br><br>

                    <div class="lab-footer-top">

                        <div class="sample-collection">
                            Home Sample Collection Facility Available
                        </div>

                        <div class="lab-technician">
                            Lab Technician
                            <?php if (!empty($logo_image)) { ?>
                                <div class="lab-logo">
                                    <img src="<?= invoice_h($logo_image); ?>"
                                        alt="Laboratory Logo">
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="lab-equipment">
                        Equipped with Computerised Auto Analysers &amp; Cell Counter
                    </div>

                    <div class="lab-facilities">

                        Facility Available: Haematology with CBC, Biochemistry, Lipid Profile,
                        LFT, Serology, Urine, Stool, Sputum, Microbiology

                    </div>

                    <div class="lab-disclaimer">

                        <span>
                            Please co-relate the results clinically, In case of unexpected results, contact lab.
                        </span>

                        <strong>
                            Not Valid For Medico Legal Purpose
                        </strong>

                    </div>

                </div>

                <?php } ?>

            </div>

            <?php if (empty($is_display)) { ?>

                <div class="cs-invoice_btns cs-hide_print d-none">

                    <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                        <i class="fa fa-print"></i>
                        <span>Print</span>
                    </a>

                    <a id="download_btn"
                       class="cs-invoice_btn cs-color2"
                       target="_blank"
                       href="https://wa.me/91<?= invoice_h(preg_replace('/\D+/', '', $patient_mobile)); ?>?text=<?= rawurlencode('Hi ' . $patient_name . ', your test report link from ' . $member_display_name . ': ' . $report_url); ?>">

                        <i class="fa-brands fa-whatsapp" style="font-size:25px;"></i>

                        <span>Share to patient number</span>

                    </a>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

<!-- MOBILE ACTION NAVIGATION -->

<div class="mobile-bottom-nav" style="display:<?= invoice_h($show_side_bar); ?>">

    <div class="mobile-bottom-nav__item">

        <a href="<?= SITE_URL_ADMIN; ?>" style="color:black" class="hide-loader">
            <i class="fa-solid fa-house" title="Go To Home Page"></i>
        </a>

    </div>

    <div class="mobile-bottom-nav__item">

        <a href="<?= SITE_URL; ?>/add-setting.php" style="color:black" class="hide-loader">
            <i class="fa-solid fa-eye" title="Show/Hide Header"></i>
        </a>

    </div>

    <div class="mobile-bottom-nav__item">

        <a href="<?= SITE_URL_ADMIN; ?>/manage-report.php" style="color:black" class="hide-loader">
            <i class="fa-solid fa-list" title="Manage Invoice"></i>
        </a>

    </div>

    <div class="mobile-bottom-nav__item mobile-bottom-nav__item--active1">

        <a href="<?= SITE_URL_ADMIN; ?>/add-report.php?patient_data=<?= urlencode($encrypted_patient_id); ?>"
           style="color:black" class="hide-loader">

            <i class="fa-solid fa-pen-to-square" title="Edit Invoice"></i>

        </a>

    </div>

    <?php if (!empty($patient_email)) { ?>

        <div class="mobile-bottom-nav__item">

            <a href="#" data-bs-toggle="modal" data-bs-target="#send_link"
               style="color:black" class="hide-loader">

                <i class="fa-solid fa-envelope" title="Send Report To Email"></i>

            </a>

        </div>

    <?php } ?>

    <?php if (!empty($patient_mobile)) { ?>

        <div class="mobile-bottom-nav__item">

            <a href="https://wa.me/91<?= invoice_h(preg_replace('/\D+/', '', $patient_mobile)); ?>?text=<?= rawurlencode('Hi ' . $patient_name . ', your test report link from ' . $member_display_name . ': ' . $report_url); ?>"
               style="color:black"
               class="hide-loader"
               onclick="updateShareCount(<?= (int)$patient_id; ?>);">

                <i class="fa-brands fa-whatsapp" title="Send Report To Whatsapp"></i>

            </a>

        </div>

    <?php } ?>

    <div class="mobile-bottom-nav__item">

        <a href="#"
           style="color:black"
           onclick="copyLink('#invoice_link');updateShareCount(<?= (int)$patient_id; ?>);return false;"
           class="hide-loader">

            <i class="fa-solid fa-copy" title="Copy Report Link"></i>

        </a>

    </div>

    <div class="mobile-bottom-nav__item">

        <a href="#" style="color:black" onclick="return false;" class="hide-loader">

            <span class="btn-convert" id="create_pdf">
                <i class="fa-solid fa-file-pdf" title="PDF of Invoice"></i>
            </span>

        </a>

    </div>

    <div class="mobile-bottom-nav__item">

        <a href="#" style="color:black" onclick="PrintPage();return false;" class="hide-loader">

            <i class="fa-solid fa-print" title="Print Report"></i>

        </a>

    </div>

    <div class="mobile-bottom-nav__item">

        <a href="<?= SITE_URL_ADMIN; ?>/generate-invoice.php?patient_data=<?= urlencode($encrypted_patient_id); ?>&delete_id=1"
           onclick="return confirm('Are you sure you want to delete this report?');"
           style="color:black"
           class="hide-loader">

            <i class="fa-solid fa-trash" title="Delete Report"></i>

        </a>

    </div>

</div>

<!-- EMAIL REPORT LINK MODAL -->

<?php if (!empty($patient_email)) { ?>

<div class="modal fade" id="send_link" tabindex="-1"
     aria-labelledby="term_condition" aria-hidden="true">

    <div class="modal-dialog modal-lg text-dark">

        <form method="POST" action="">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="term_condition">

                        REPORT ID #<?= invoice_h(substr($encrypted_patient_id, 0, 11)); ?>

                        Of Patient <?= invoice_h(ucwords($patient_name)); ?>

                    </h5>

                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label for="input-1" class="form-label">
                            EMAIL *
                        </label>

                        <input type="email"
                               class="form-control"
                               id="input-1"
                               placeholder="Enter Patient Email"
                               name="email_id"
                               value="<?= invoice_h($patient_email); ?>"
                               required>

                    </div>

                    <div class="mb-3">

                        <label for="invoice_link" class="form-label">
                            LINK *
                        </label>

                        <input type="text"
                               class="form-control"
                               id="invoice_link"
                               name="email_link"
                               value="<?= invoice_h($report_url); ?>"
                               readonly>

                    </div>

                </div>

                <div class="modal-footer">

                    <input type="hidden"
                           name="sender_shop_name"
                           value="<?= invoice_h($admin_shop_name); ?>">

                    <input type="hidden"
                           name="client_name"
                           value="<?= invoice_h(ucwords($patient_name)); ?>">

                    <button type="submit"
                            name="send_link"
                            value="1"
                            class="btn btn-info"
                            onclick="updateShareCount(<?= (int)$patient_id; ?>);">

                        Send Link
                        <i class="fa-solid fa-link"></i>

                    </button>

                    <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal">

                        Close

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script src="./pdf/assets/js/convert.js"></script>

<script>

    setTimeout(function() {
        $('.notification-div').slideUp(400);
    }, 7000);

    jQuery(function($) {

        $('a.hide-loader').on('click', function() {

            $('#submit-spin').show();

            setTimeout(function() {
                $('#submit-spin').hide();
            }, 700);

        });

        $('form').on('submit', function() {
            $('#submit-spin').show();
        });

    });

</script>

<div id="submit-spin"></div>

<style>

/* =========================================
   EXTRA BOLD & DARK LAB REPORT FONT
========================================= */

#html-template,
#html-template * {
    font-family: Arial, Helvetica, sans-serif !important;
    color: #000 !important;
}

/* General report text */
#html-template {
    font-size: 18px !important;
    font-weight: 600 !important;
}

/* Patient information */
#html-template ul li p,
#html-template ul li span {
    font-size: 16px !important;
    font-weight: 500 !important;
}

#html-template ul li b {
    font-weight: 600 !important;
}

/* Section headings */
#html-template .cs-heading {
    font-size: 19px !important;
    font-weight: 800 !important;
}

/* Test category headings */
#html-template .cs-table tbody td b {
    font-size: 16px !important;
    font-weight: 500 !important;
}

/* Table headings */
#html-template .cs-table thead th {
    font-size: 14px !important;
    font-weight: 800 !important;
    color: #000 !important;
}

/* All test results */
#html-template .cs-table tbody td {
    font-size: 14px !important;
    font-weight: 600 !important;
    color: #000 !important;
}

/* Observed values */
#html-template .cs-table tbody td:nth-child(2) {
    font-size: 15px !important;
    font-weight: 400 !important;
}

/* Reference ranges */
#html-template .cs-table tbody td:nth-child(4) {
    font-size: 13px !important;
    font-weight: 600 !important;
}

/* Patient note */
#html-template .cs-note,
#html-template .cs-note p {
    font-size: 14px !important;
    font-weight: 600 !important;
}

#html-template .cs-note b {
    font-weight: 800 !important;
}

/* Laboratory header */
.lab-brand h1 {
    font-weight: 900 !important;
}

.lab-address,
.lab-contact-bar strong {
    font-weight: 800 !important;
}

/* Laboratory footer */
.lab-footer,
.lab-footer strong,
.sample-collection {
    font-weight: 700 !important;
}

/* Print: maintain bold fonts */
@media print {
    #html-template,
    #html-template * {
        font-family: Arial, Helvetica, sans-serif !important;
        color: #000 !important;
    }

    #html-template .cs-table tbody td {
        font-weight: 600 !important;
    }

    #html-template .cs-table tbody td:nth-child(2),
    #html-template .cs-table tbody td b,
    #html-template .cs-table thead th {
        font-weight: 500 !important;
    }
}

</style>
</body>
</html>
