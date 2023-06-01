<?php

session_start();

if ($_SESSION['page'] == "dashboard") {
	$Link = "dashboard";
} else if ($_SESSION['page'] == "list-beras") {
	$Link = "list-beras";
}

echo $Linkl;

?>

<aside id="sidebar" class="sidebar">

	<ul class="sidebar-nav" id="sidebar-nav">

		<?php
		if ($Link == "dashboard") {

			?>
			
			<li class="nav-item">
				<a class="nav-link" href="index.php">
				<i class="bi bi-grid"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<?php

		} else {

			?>
			
			<li class="nav-item">
				<a class="nav-link collapsed" href="index.php">
				<i class="bi bi-grid"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<?php

		}
		
		?>

		<li class="nav-heading">Pengadaan & Data Stok</li>

		<?php
		
		if ($Link == "list-beras") {

			?>
			
			<li class="nav-item">
				<a class="nav-link collapsed" href="list-beras.php">
				<i class="bi bi-handbag-fill"></i>
					<span>Master Beras</span>
				</a>
			</li>

			<?php

		} else {

			?>
			
			<li class="nav-item">
				<a class="nav-link" href="list-beras.php">
				<i class="bi bi-handbag-fill"></i>
					<span>Master Beras</span>
				</a>
			</li>

			<?php

		}

		?>
		

		<li class="nav-item">
			<a class="nav-link collapsed" href="list-padi.php">
			<i class="bi bi-basket-fill"></i>
				<span>Master Padi</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="list-huut.php">
			<i class="bi bi-bucket-fill"></i>
				<span>Master Huut</span>
			</a>
		</li>

		<!-- <li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#stok-nav" data-bs-toggle="collapse" href="#">
				<i class="bi bi-database-fill-add"></i><span>Pengadaan & Data Stok</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="stok-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
				<li>
					<a href="list-beras.php">
					<i class="bi bi-circle"></i><span>Beras</span>
					</a>
				</li>
				<li>
					<a href="list-padi.php">
					<i class="bi bi-circle"></i><span>Padi</span>
					</a>
				</li>
				<li>
					<a href="list-huut.php">
					<i class="bi bi-circle"></i><span>Huut</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#transaksi-nav" data-bs-toggle="collapse" href="#">
				<i class="bi bi-currency-dollar"></i><span>Data Transaksi Stok</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="transaksi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
				<li>
					<a href="404.php">
					<i class="bi bi-circle"></i><span>Beras</span>
					</a>
				</li>
				<li>
					<a href="404.php">
					<i class="bi bi-circle"></i><span>Padi</span>
					</a>
				</li>
				<li>
					<a href="404.php">
					<i class="bi bi-circle"></i><span>Huut</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="list-transaksi.php">
			<i class="bi bi-menu-button-wide"></i>
				<span>Transaksi</span>
			</a>
		</li> -->

		<li class="nav-item">
			<a class="nav-link collapsed" href="gudang-laporan.php">
			<i class="bi bi-house-gear-fill"></i>
				<span>Gudang Laporan</span>
			</a>
		</li>

		<!-- <li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
			<i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
			<li>
				<a href="components-alerts.html">
				<i class="bi bi-circle"></i><span>Alerts</span>
				</a>
			</li>
			<li>
				<a href="components-accordion.html">
				<i class="bi bi-circle"></i><span>Accordion</span>
				</a>
			</li>
			<li>
				<a href="components-badges.html">
				<i class="bi bi-circle"></i><span>Badges</span>
				</a>
			</li>
			<li>
				<a href="components-breadcrumbs.html">
				<i class="bi bi-circle"></i><span>Breadcrumbs</span>
				</a>
			</li>
			<li>
				<a href="components-buttons.html">
				<i class="bi bi-circle"></i><span>Buttons</span>
				</a>
			</li>
			<li>
				<a href="components-cards.html">
				<i class="bi bi-circle"></i><span>Cards</span>
				</a>
			</li>
			<li>
				<a href="components-carousel.html">
				<i class="bi bi-circle"></i><span>Carousel</span>
				</a>
			</li>
			<li>
				<a href="components-list-group.html">
				<i class="bi bi-circle"></i><span>List group</span>
				</a>
			</li>
			<li>
				<a href="components-modal.html">
				<i class="bi bi-circle"></i><span>Modal</span>
				</a>
			</li>
			<li>
				<a href="components-tabs.html">
				<i class="bi bi-circle"></i><span>Tabs</span>
				</a>
			</li>
			<li>
				<a href="components-pagination.html">
				<i class="bi bi-circle"></i><span>Pagination</span>
				</a>
			</li>
			<li>
				<a href="components-progress.html">
				<i class="bi bi-circle"></i><span>Progress</span>
				</a>
			</li>
			<li>
				<a href="components-spinners.html">
				<i class="bi bi-circle"></i><span>Spinners</span>
				</a>
			</li>
			<li>
				<a href="components-tooltips.html">
				<i class="bi bi-circle"></i><span>Tooltips</span>
				</a>
			</li>
			</ul>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
			<i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
			<li>
				<a href="forms-elements.html">
				<i class="bi bi-circle"></i><span>Form Elements</span>
				</a>
			</li>
			<li>
				<a href="forms-layouts.html">
				<i class="bi bi-circle"></i><span>Form Layouts</span>
				</a>
			</li>
			<li>
				<a href="forms-editors.html">
				<i class="bi bi-circle"></i><span>Form Editors</span>
				</a>
			</li>
			<li>
				<a href="forms-validation.html">
				<i class="bi bi-circle"></i><span>Form Validation</span>
				</a>
			</li>
			</ul>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
			<i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
			<li>
				<a href="tables-general.html">
				<i class="bi bi-circle"></i><span>General Tables</span>
				</a>
			</li>
			<li>
				<a href="tables-data.html">
				<i class="bi bi-circle"></i><span>Data Tables</span>
				</a>
			</li>
			</ul>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
			<i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
			<li>
				<a href="charts-chartjs.html">
				<i class="bi bi-circle"></i><span>Chart.js</span>
				</a>
			</li>
			<li>
				<a href="charts-apexcharts.html">
				<i class="bi bi-circle"></i><span>ApexCharts</span>
				</a>
			</li>
			<li>
				<a href="charts-echarts.html">
				<i class="bi bi-circle"></i><span>ECharts</span>
				</a>
			</li>
			</ul>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
			<i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
			<li>
				<a href="icons-bootstrap.html">
				<i class="bi bi-circle"></i><span>Bootstrap Icons</span>
				</a>
			</li>
			<li>
				<a href="icons-remix.html">
				<i class="bi bi-circle"></i><span>Remix Icons</span>
				</a>
			</li>
			<li>
				<a href="icons-boxicons.html">
				<i class="bi bi-circle"></i><span>Boxicons</span>
				</a>
			</li>
			</ul>
		</li>

		<li class="nav-heading">Pages</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="users-profile.html">
			<i class="bi bi-person"></i>
			<span>Profile</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-faq.html">
			<i class="bi bi-question-circle"></i>
			<span>F.A.Q</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-contact.html">
			<i class="bi bi-envelope"></i>
			<span>Contact</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-register.html">
			<i class="bi bi-card-list"></i>
			<span>Register</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-login.html">
			<i class="bi bi-box-arrow-in-right"></i>
			<span>Login</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-error-404.html">
			<i class="bi bi-dash-circle"></i>
			<span>Error 404</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-blank.html">
			<i class="bi bi-file-earmark"></i>
			<span>Blank</span>
			</a>
		</li> -->

	</ul>

</aside>