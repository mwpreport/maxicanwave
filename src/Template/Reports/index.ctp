<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Reports</h2>
                        <hr>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="white-wrapper mar-top-20">
				<table>
					<tr>
						<td valign="top"><h4>1. </h4></td>
						<td valign="top">
							<h4>Planning</h4>
							<ul>
								<li><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "plan"])?>">a. Plan Summary</a></li>
								<li><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyPlan"])?>">b. Daily Plan</a></li>
							</ul>
						</td>
					</tr>
					<tr>
						<td valign="top"><h4>2. </h4></td>
						<td valign="top">
							<h4>Reporting</h4>
							<ul>
								<li><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyReport"])?>">a. Daily Report</a></li>
								<li><a href="">b. Doctor visit Report</a></li>
								<li><a href="">c. Missed Doctors</a></li>
							</ul>
						</td>
					</tr>
				</table>
				
            </div>
        </section>
    </div>
    <!-- /.content -->
</div>
