			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">

					<?php
					foreach($w_routes as $route) {

						if (empty($route['nav_title'])) {
							continue;
						}

						$route_name = $route[3];

						$active = false;
						if ($_SERVER['REQUEST_URI'] == $this->url($route_name)) {
							$active = true;
						}
					?>
					<li class="<?= $active ? 'active' : '' ?>"><a href="<?= $this->url($route_name) ?>"><?= $route['nav_title'] ?></a></li>
					<?php } ?>
				</ul>
			</div>