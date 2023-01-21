<?php
	include ("../../DBconfig.php");
	$user_name = "admin";
	$sql = "SELECT * FROM user_detail where username = '$user_name';";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
		$row = mysqli_fetch_assoc($result);
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/login_form.css">
    <link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<script>
function onload_fun() {
    var company_name = document.getElementById("company_name");
    var address = document.getElementById("address");
    var owner_name = document.getElementById("owner_name");
    var phone_no = document.getElementById("phone_no");
    var gstin_no = document.getElementById("gstin_no");
    var pan_no = document.getElementById("pan_no");
    var email = document.getElementById("email");
    var bank_name = document.getElementById("bank_name");
    var bank_branch_name = document.getElementById("bank_branch_name");
    var bank_ac_number = document.getElementById("bank_ac_number");
    var ifsc_code = document.getElementById("ifsc_code");
    company_name.value = `<?php echo $row['company_name']; ?>`;
    address.value = `<?php echo $row['address']; ?>`;
    owner_name.value = `<?php echo $row['owner_name']; ?>`;
    phone_no.value = `<?php echo $row['phone_no']; ?>`;
    gstin_no.value = `<?php echo $row['gstin_no']; ?>`;
    pan_no.value = `<?php echo $row['pan_no']; ?>`;
    email.value = `<?php echo $row['email']; ?>`;
    bank_name.value = `<?php echo $row['bank_name']; ?>`;
    bank_branch_name.value = `<?php echo $row['bank_branch_name']; ?>`;
    bank_ac_number.value = `<?php echo $row['bank_ac_number']; ?>`;
    ifsc_code.value = `<?php echo $row['ifsc_code']; ?>`;
}
</script>

<body onload="onload_fun();">
    <div class="body-wrapper">
        <aside class="mdc-persistent-drawer mdc-persistent-drawer--open">
            <nav class="mdc-persistent-drawer__drawer">
                <div class="mdc-persistent-drawer__toolbar-spacer">
                    <a href="../../dashboard.php" style="text-decoration: none;" class="brand-logo">
                        <img src="../../images/logo.png" alt="logo">
                    </a>
                </div>
                <div class="mdc-list-group">
                    <nav class="mdc-list mdc-drawer-menu" style="max-height: none; padding-bottom: 153%;">
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="../../index.php">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">desktop_mac</i>
                                Dashboard
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="product-list.php">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">grid_on</i>
                                New bill
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="bill-checklist.php">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">assignment</i>
                                Bill checklist
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="basic-forms.php">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">track_changes</i>
                                Company details
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="customer-forms.php">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">person_outline</i>
                                Customer details
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="product-forms.php">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">layers</i>
                                Available products
                            </a>
                        </div>
                    </nav>
                </div>
            </nav>
        </aside>
        <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
            <div class="mdc-toolbar__row">
                <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                    <a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
                </section>
                <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
                    <div class="mdc-menu-anchor">
                        <a href="selected-product-list.php" style="text-decoration: none;"
                            class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
                            <i class="material-icons">shopping_cart</i>
                            <span class="dropdown-count" id="span_quantity">
                                <?php
    		                include ("../../DBconfig.php");
    		                $sql = "SELECT COUNT(id) count FROM bill_data;";
    		                $result = mysqli_query($conn, $sql);
    		                if (mysqli_num_rows($result) > 0) {
    		                    $row = mysqli_fetch_assoc($result);
    		                    echo $row["count"];
    		                }else {
    		                    echo "0";
    		                }
    		                mysqli_close($conn);
    		                ?>
                            </span>
                        </a>
                    </div>
                </section>
            </div>
        </header>
        <div class="page-wrapper mdc-toolbar-fixed-adjust">
            <form action="../../DBOperation.php?Message=admin&log1=1" method="post">
                <main class="content-wrapper">
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                <div class="mdc-card">
                                    <section class="mdc-card__primary">
                                        <h1 class="mdc-card__title mdc-card__title--large">Company details</h1>
                                    </section>
                                    <section class="mdc-card__supporting-text">
                                        <div class="mdc-layout-grid__inner">
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10"
                                                                for="company_name">Company Name:<span
                                                                    id="requ">&nbsp*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    id="company_name" placeholder="Enter Company Name."
                                                                    name="company_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-leading-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10"
                                                                for="owner_name">Owner Name:<span
                                                                    id="requ">&nbsp*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" required class="form-control"
                                                                    id="owner_name" placeholder="Phone number."
                                                                    name="owner_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-leading-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10" for="phone_no">Phone
                                                                No.:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="phone_no"
                                                                    placeholder="Phone number." name="phone_no">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-leading-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10" for="address">Company
                                                                Address:<span id="requ">&nbsp*</span></label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" required
                                                                    placeholder="Enter company address." rows="5"
                                                                    id="address" name="address"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-leading-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10"
                                                                for="email">Email:</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="email"
                                                                    placeholder="Enter email." name="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-leading-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10" for="gstin_no">GSTIN
                                                                number:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="gstin_no"
                                                                    placeholder="Enter GSTIN number." name="gstin_no">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div class="form-group">
                                                        <div id="demo-tf-box-leading-wrapper">
                                                            <label class="control-label col-sm-10" for="pan_no">PAN
                                                                number:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="pan_no"
                                                                    placeholder="Enter PAN number." name="pan_no">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                <div class="mdc-card">
                                    <section class="mdc-card__primary">
                                        <h1 class="mdc-card__title mdc-card__title--large">Bank details</h1>
                                    </section>
                                    <section class="mdc-card__supporting-text">
                                        <div class="mdc-layout-grid__inner">
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10" for="bank_name">Bank
                                                                name:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="bank_name"
                                                                    placeholder="Enter bank name." name="bank_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10"
                                                                for="bank_branch_name">Bank branch name:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    id="bank_branch_name"
                                                                    placeholder="Enter bank branch name."
                                                                    name="bank_branch_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10"
                                                                for="bank_ac_number">Bank A/C No:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    id="bank_ac_number" placeholder="Enter bank A/C no,"
                                                                    name="bank_ac_number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10" for="ifsc_code.">Bank
                                                                IFSC code:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="ifsc_code"
                                                                    placeholder="Enter Bank IFSC code."
                                                                    name="ifsc_code">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                <div class="mdc-card">
                                    <section class="mdc-card__supporting-text">
                                        <div class="mdc-layout-grid__inner">
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="mdc-list-item mdc-drawer-item purchase-link">
                                                            <input type="submit" style=" width: 100px;" value="save"
                                                                class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link"
                                                                data-mdc-auto-init="MDCRipple">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </form>
            <?php include("../../partials/_footer.php"); ?>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">oops!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="model_id"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
    <script src="../../js/dialog.js"></script>
    <script src="../../js/material.js"></script>
</body>

</html>