<?php include ("../../DBconfig.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap.min2.css">
    <link rel="stylesheet" href="../../css/dataTables.semanticui.min.css">
    <link href="../../css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/buttons.semanticui.min.css"/>
</head>
<body  onload="onload_fun();">
    <div class="body-wrapper">
    <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar_section mdc-toolbar_section--align-start">
                <div class="mdc-menu-anchor">
				    <a href="javascript:history.go(-1)" title="Return to the previous page" style="text-decoration: none;" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
					    <i class="material-icons">arrow_back</i>
				    </a>
			    </div>
			    <div class="mdc-menu-anchor">
                    <a href="../../dashboard.php" class="mdc-toolbar__icon toggle mdc-ripple-surface" style="text-decoration: none;" data-mdc-auto-init="MDCRipple">
            		    <i class="material-icons">dashboard</i>
                    </a>
                </div>
            </section>
            <section class="mdc-toolbar_section mdc-toolbar_section--align-end" role="toolbar">
                <div class="mdc-menu-anchor mr-1">
                    <a class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple" style="text-decoration: none">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <a href="../../login.php" style="text-decoration: none">
                        <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                            <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                                <li class="mdc-list-item" role="menuitem" tabindex="0">
                                    <i class="material-icons mdc-theme--primary mr-1">power_settings_new</i>
                                    Logout
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            </section>
            <h1 class="mdc-typography--headline" style="margin-top: 10px; margin-left: 60px;">Month Wise Payment Report</h1>
        </div>
	</header>
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <div class="mdc-layout-grid">
          	<div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid_cell stretch-card mdc-layout-grid_cell--span-12">
		  			<div class="mdc-card">
					  <section class="mdc-card__supporting-text" style="padding-bottom:unset">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid_cell mdc-layout-grid_cell--span-6-desktop">
					  				<div class="template-demo">
										<div id="demo-tf-box-wrapper">
											<div class="row">
												<div class="col-1">
													<h3 class="mdc-card_title mdc-card_title" style="margin-top:5px;">From:</h3>
												</div>
												<div class="col-4">
													<p class="control-label details"><input id="datepicker_from" readonly/></p>
												</div>
												<div class="col-1">
													<h3 class="mdc-card_title mdc-card_title" style="margin-top:5px;">To:</h3>
												</div>
												<div class="col-4">
													<p class="control-label details"><input id="datepicker_to" readonly/></p>
												</div>
											</div>
										</div>
					  				</div>
								</div>
								<div class="mdc-layout-grid_cell mdc-layout-grid_cell--span-6-desktop">
									<div class="template-demo" style="margin-top:-10px; float:right;">
										<div id="demo-tf-box-wrapper">
											<div class="mdc-list-item mdc-drawer-item purchase-link">
												<input type="button" onclick="change_event();" style="width: 100px;" value="search" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
		  			</div>
				</div>
                <div class="mdc-layout-grid_cell stretch-card mdc-layout-grid_cell--span-12">
              		<div class="mdc-card" style="min-height:550px; padding-left:20px;">
                		<section class="mdc-card__supporting-text">
                    		<div class="mdc-layout-grid__inner">
                        		<div class="mdc-layout-grid_cell mdc-layout-grid_cell--span-12-desktop">
                        			<div class="template-demo">
                            			<div id="demo-tf-box-wrapper">
                                			<div>
                                				<table id="example" class="table table-striped table-bordered" style="width:100%">
                                    				<thead>
                                        				<tr>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Sr. No.</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px; width:100px;">Month</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Total Receipt</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Total Form</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Form Amount</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Term Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Coach Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">CGST</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">SGST</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Total Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Locker Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Cash Payment</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Cheque Payment</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Net Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;"></th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Total  : </th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "totalReceipt">Total Receipt</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "totalForm">Total Form</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "formAmount">Form Amount</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "termFee">Term Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "coachFee">Coach Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "cgst">CGST</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "sgst">SGST</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "totalFee">Total Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "lockerFee">Locker Fee</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "cash">Cash Payment</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "cheque">Cheque Payment</th>
														    <th style="text-align: center; vertical-align: inherit; font-size: 15px;" id = "netAmount">Net Amount</th>
                                            			</tr>
                                                     </tfoot>
                                    			</table>
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
    </div>
	</div>
	<div class="page-wrapper mdc-toolbar-fixed-adjust">
        <div class="mdc-card">
            <footer>
                <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid_cell stretch-card mdc-layout-grid_cell--span-6">
                            <span class="text-muted">Copyright © 2021. All rights reserved.</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../../js/material-components-web.min.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/material.js"></script>
    <script src="../../js/jquery-3.3.1.js"></script>
    <script src="../../js/jquery.dataTables.min.js"></script>
    <script src="../../js/dataTables.semanticui.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../../js/buttons.semanticui.min.js"></script>
    <script type="text/javascript" src="../../js/pdfmake.min.js"></script>
    <script type="text/javascript" src="../../js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../../js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../../js/buttons.print.min.js"></script>
    <script type="text/javascript" src="../../js/buttons.colVis.min.js"></script>
    <script>
    function onload_fun() {
		var from = document.getElementById('datepicker_from');
		var to = document.getElementById('datepicker_to');
		var from_date = new Date()
		var to_date = new Date()
		const fromMonth = String(from_date.getMonth() + 1).padStart(2, '0');
		const fromDay = String(from_date.getDate()).padStart(2, '0');
		const fromYear = from_date.getFullYear()-1;
		from_date = fromMonth  + '/' + fromYear;
		const toMonth = String(to_date.getMonth() + 1).padStart(2, '0');
		const toDay = String(to_date.getDate()).padStart(2, '0');
		const toYear = to_date.getFullYear();
		to_date = toMonth  + '/' + toYear;
		to.value = to_date;
		from.value = from_date;

		change_event();
	}
	function change_event(){
		var temp_ = document.getElementById('datepicker_from');
        temp = temp_.value.split('/');
        var from = temp[1]+'-'+temp[0];
		var temp = document.getElementById('datepicker_to');
        temp = temp.value.split('/');
        var to = temp[1]+'-'+temp[0];
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			dataType: 'JSON',
			data:{from:from, to:to, log18: 1},
			success:function(html) {
				// console.log(html);
				if(html["error"]=="error"){
					$('#example').dataTable().fnClearTable();
				}
				else {
					$("#example").dataTable().fnDestroy();
                    document.getElementById('totalReceipt').innerHTML = Number((html[0]["tReceipt"]).toFixed(2));
                    document.getElementById('termFee').innerHTML = Number((html[0]["tTermFee"]).toFixed(2));
                    document.getElementById('coachFee').innerHTML = Number((html[0]["tCoachFee"]).toFixed(2));
                    document.getElementById('cgst').innerHTML = Number((html[0]["tCgst"]).toFixed(2));
                    document.getElementById('sgst').innerHTML = Number((html[0]["tSgst"]).toFixed(2));
                    document.getElementById('totalFee').innerHTML = Number((html[0]["tTotalFee"]).toFixed(2));
                    document.getElementById('lockerFee').innerHTML = Number((html[0]["tLockerFee"]).toFixed(2));
                    document.getElementById('cash').innerHTML = Number((html[0]["tCash"]).toFixed(2));
                    document.getElementById('cheque').innerHTML = Number((html[0]["tCheque"]).toFixed(2));
                    document.getElementById('netAmount').innerHTML = Number((html[0]["tNetAmount"]).toFixed(2));
                    document.getElementById('totalForm').innerHTML = Number((html[0]["tForm"]).toFixed(2));
                    document.getElementById('formAmount').innerHTML = Number((html[0]["tFormAmount"]).toFixed(2));
					var table = $('#example').DataTable({
						lengthChange: false,
						"scrollY":        "550px",
						"scrollCollapse": true,
						"paging":         true,
						buttons: [{
									extend: 'pdfHtml5',
									footer: true,
									download: 'open',
									title : "Payment Report month Wise " + "\n Month: " + temp_.value + " to " + temp.value,
									messageTop: '',
									exportOptions: {
										columns: ':visible'
									},
									autoPrint: false,
									exportOptions: {
										columns: ':visible'
									},
									customize: function (doc) {
										doc.defaultStyle.fontSize = 10;
										doc.styles.tableHeader.fontSize = 10;
										doc.styles.title.fontSize = 10;
										doc.content[0].text = doc.content[0].text.trim();
										doc['footer']=(function(page, pages) {
											return {
												columns: [
													{
														alignment: 'right',
														text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
													}
												],
												margin: [10, 0]
											}
										});
										doc['header']=(function(page, pages) {
											return {
												columns: [
													'VTC',
													{
														alignment: 'right',
														text: ['VALLABH VIDYANAGR TOWN VALLABH VIDYANAGR PHONE:230700']
													}
												],
												margin: [10, 10]
											}
										});
										var objLayout = {};
										objLayout['hLineWidth'] = function(i) { return .5; };
										objLayout['vLineWidth'] = function(i) { return .5; };
										objLayout['hLineColor'] = function(i) { return '#aaa'; };
										objLayout['vLineColor'] = function(i) { return '#aaa'; };
										objLayout['paddingLeft'] = function(i) { return 4; };
										objLayout['paddingRight'] = function(i) { return 4; };
										doc.content[1].layout = objLayout;
									},
									orientation : 'landscape',
									pageSize : 'A4'
								},
								'colvis',
								'pageLength'
							],
						processing: true,
						data: html,
						"columns"     :     [
							{     "data"     :     "sr_no"},
							{     "data"     :     "Month"        },
							{     "data"     :     "totalReceipt",
							"defaultContent":     "0"            },
							{     "data"     :     "totalForm",
							"defaultContent":     "0"            },
							{     "data"     :     "formAmount",
							"defaultContent":     "0"            },
							{     "data"     :     "termFee",
							"defaultContent":     "0"            },
							{     "data"     :     "coachFee",
							"defaultContent":     "0"            },
							{     "data"     :     "cgst",
							"defaultContent":     "0"            },
							{     "data"     :     "sgst",
							"defaultContent":     "0"            },
							{     "data"     :     "totalFee",
							"defaultContent":     "0"            },
							{     "data"     :     "lockerFee",
							"defaultContent":     "0"            },
							{     "data"     :     "cash",
							"defaultContent":     "0"            },
							{     "data"     :     "cheque",
							"defaultContent":     "0"            },
							{     "data"     :     "netAmount",
							"defaultContent":     "0"            }
							]
					});
					table.buttons().container()
						.appendTo( $('div.eight.column:eq(0)', table.table().container()) );
				}
			}
		});
	}
    </script>
    <script>
        var fullDate = new Date()
		var dateD = parseInt(fullDate.getDate())>9 ? ""+fullDate.getDate(): "0"+fullDate.getDate();
		var monthD = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = dateD + "/" + monthD + "/" + fullDate.getFullYear();
        $(document).ready(function(){
			var table = $('#example').DataTable({
				lengthChange: false,
				"scrollY":        "550px",
        		"scrollCollapse": true,
        		"paging":         true,
                buttons: [{
							extend: 'pdfHtml5',
							download: 'open',
							title : "Payment Report Month Wise " + "\n Date:" + currentDate,
                            messageTop: '',
                            exportOptions: {
                                columns: ':visible'
                            },
                            autoPrint: false,
							exportOptions: {
								columns: ':visible'
							},
							customize: function (doc) {
								doc.defaultStyle.fontSize = 10;
								doc.styles.tableHeader.fontSize = 10;
								doc.styles.title.fontSize = 10;
								doc.content[0].text = doc.content[0].text.trim();
								doc['footer']=(function(page, pages) {
									return {
										columns: [
											{
												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
								doc['header']=(function(page, pages) {
									return {
										columns: [
											'VTC',
											{
												alignment: 'right',
												text: ['VALLABH VIDYANAGR TOWN VALLABH VIDYANAGR PHONE:230700']
											}
										],
										margin: [10, 10]
									}
								});
								var objLayout = {};
								objLayout['hLineWidth'] = function(i) { return .5; };
								objLayout['vLineWidth'] = function(i) { return .5; };
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
								objLayout['paddingLeft'] = function(i) { return 4; };
								objLayout['paddingRight'] = function(i) { return 4; };
								doc.content[1].layout = objLayout;
							},
							orientation : 'landscape',
							pageSize : 'A4'
                        },
						'colvis',
						'pageLength'
                    ],
                  processing: true,
					"columns"     :     [
						{     "data"     :     "sr_no"},
						{     "data"     :     "Month"        },
						{     "data"     :     "totalReceipt",
						"defaultContent":     "0"            },
						{     "data"     :     "totalForm",
						"defaultContent":     "0"            },
						{     "data"     :     "formAmount",
						"defaultContent":     "0"            },
						{     "data"     :     "termFee",
						"defaultContent":     "0"            },
						{     "data"     :     "coachFee",
						"defaultContent":     "0"            },
						{     "data"     :     "cgst",
						"defaultContent":     "0"            },
						{     "data"     :     "sgst",
						"defaultContent":     "0"            },
						{     "data"     :     "totalFee",
						"defaultContent":     "0"            },
						{     "data"     :     "lockerFee",
						"defaultContent":     "0"            },
						{     "data"     :     "cash",
						"defaultContent":     "0"            },
						{     "data"     :     "cheque",
						"defaultContent":     "0"            },
						{     "data"     :     "netAmount",
						"defaultContent":     "0"            }
				 ]
			});
			table.buttons().container()
                .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
        });
	</script>
	<script>
        $('#datepicker_from').datepicker({
            uiLibrary: 'bootstrap4',
			format: "mm/yyyy"
        });
		$('#datepicker_to').datepicker({
            uiLibrary: 'bootstrap4',
			format: "mm/yyyy"
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>

