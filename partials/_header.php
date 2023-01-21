<header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
    <div class="mdc-toolbar__row">
        <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
            <a class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
        </section>
        <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
            <div class="mdc-menu-anchor">
                <a href="pages/forms/selected-product-list.php" class="mdc-toolbar__icon toggle mdc-ripple-surface"
                    data-mdc-auto-init="MDCRipple">
                    <i class="material-icons">shopping_cart</i>
                    <span class="dropdown-count" id="span_quantity">
                        <?php
                          include ("DBconfig.php");
                          $user_name = "admin";
                          $sql = "SELECT COUNT(id) count FROM bill_data WHERE username = '$user_name';";
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