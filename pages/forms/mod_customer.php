<?php
    if(isset($_REQUEST["cust_id"])) {
        include ("../../DBconfig.php");
        $cust_id = $_REQUEST["cust_id"];
        $sql = "SELECT * FROM customers where cust_id = $cust_id;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
            $row = mysqli_fetch_assoc($result);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/login_form.css">
    <link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/style.css">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

</head>

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
  		                $sql_ = "SELECT COUNT(id) count FROM bill_data;";
  		                $result_ = mysqli_query($conn, $sql_);
  		                if (mysqli_num_rows($result_) > 0) {
  		                    $row_ = mysqli_fetch_assoc($result_);
  		                    echo $row_["count"];
  		                }else {
  		                    echo "0";
  		                }
  		                ?>
                            </span>
                        </a>
                        <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="notification-menu">
                            <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                                <li class="mdc-list-item" role="menuitem" tabindex="0">
                                    <i class="material-icons mdc-theme--primary mr-1">email</i>
                                    One unread message
                                </li>
                                <li class="mdc-list-item" role="menuitem" tabindex="0">
                                    <i class="material-icons mdc-theme--primary mr-1">group</i>
                                    One event coming up
                                </li>
                                <li class="mdc-list-item" role="menuitem" tabindex="0">
                                    <i class="material-icons mdc-theme--primary mr-1">cake</i>
                                    It's Aleena's birthday!
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </header>
        <aside id="mdc-dialog-default" class="mdc-dialog" role="alertdialog" aria-hidden="true"
            aria-labelledby="mdc-dialog-default-label" aria-describedby="mdc-dialog-default-description">
            <div class="mdc-dialog__surface">
                <header class="mdc-dialog__header">
                    <h2 id="mdc-dialog-default-label" class="mdc-dialog__header__title">
                        Opps!
                    </h2>
                </header>
                <section id="mdc-dialog-default-description" class="mdc-dialog__body">
                    Let Google help apps determine location. This means sending anonymous location data to Google, even
                    when no apps are running.
                </section>
                <footer class="mdc-dialog__footer">
                    <button type="button"
                        class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept">Accept</button>
                </footer>
            </div>
        </aside>
        <div class="page-wrapper mdc-toolbar-fixed-adjust">
            <form action="../../DBOperation.php?<?php
                                                if(isset($_REQUEST["cust_id"]))
                                                    echo 'log3=1' . '&cust_id=' . $_REQUEST["cust_id"];
                                                else echo 'log2=1';?>" method="post">
                <main class="content-wrapper">
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                <div class="mdc-card">
                                    <section class="mdc-card__primary">
                                        <h1 class="mdc-card__title mdc-card__title--large">Customer details</h1>
                                    </section>
                                    <section class="mdc-card__supporting-text">
                                        <div class="mdc-layout-grid__inner">
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                                <div class="template-demo">
                                                    <div id="demo-tf-box-wrapper">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-10"
                                                                for="company_name">Customer Name:<span
                                                                    id="requ">&nbsp*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    id="customer_name"
                                                                    placeholder="Enter customer Name."
                                                                    name="customer_name">
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
                                                            <label class="control-label col-sm-10"
                                                                for="address">customer's
                                                                Address:<span id="requ">&nbsp*</span></label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control"
                                                                    placeholder="Enter customer's address." rows="5"
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
                                                                for="place_of_supply">Place of supply:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    id="place_of_supply"
                                                                    placeholder="Enter place of supply."
                                                                    name="place_of_supply">
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
                                    <section class="mdc-card__supporting-text">
                                        <div class="mdc-layout-grid__inner">
                                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                                                <div id="demo-tf-box-wrapper">
                                                    <div class="mdc-list-item mdc-drawer-item purchase-link">
                                                        <input type="submit" style="width: 100px;" value="save"
                                                            class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link"
                                                            data-mdc-auto-init="MDCRipple">
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
                <div class="modal-body" id="model_id">dvavsd
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    function onload_fun() {
        var customer_name = document.getElementById("customer_name");
        var address = document.getElementById("address");
        var phone_no = document.getElementById("phone_no");
        var gstin_no = document.getElementById("gstin_no");
        var pan_no = document.getElementById("pan_no");
        var place_of_supply = document.getElementById("place_of_supply");
        <?php if(isset($row)){ ?>
        customer_name.value = `<?php echo $row['name']; ?>`;
        address.value = `<?php echo $row['address']; ?>`;
        phone_no.value = `<?php echo $row['phone_no']; ?>`;
        gstin_no.value = `<?php echo $row['gstin_no']; ?>`;
        pan_no.value = `<?php echo $row['pan_no']; ?>`;
        place_of_supply.value = `<?php echo $row['place_of_supply']; ?>`;
        <?php } ?>
    }
    </script>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
    <script src="../../js/material.js"></script>
    <script src="../../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
</body>

</html>