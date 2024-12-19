<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $LANG['index']; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<div class="border border-info border-opacity-25 rounded p-3">
			<h6 class="text-primary fw-bolder mb-3"><?php echo $LANG['new_order']; ?></h6>
			<div class="table-responsive">
				<table id="table-order" class="table table-striped table-hover table-bordered" style="width:100%">
					<thead>
						<tr>
							<th class="align-middle"><?php echo $LANG['code_order']; ?></th>
							<th class="align-middle"><?php echo $LANG['customer']; ?></th>
							<th class="align-middle text-center"><?php echo $LANG['total_amount']; ?></th>
							<th class="align-middle text-center"><?php echo $LANG['status']; ?></th>
							<th class="align-middle text-center"><?php echo $LANG['order_date']; ?></th>
							<th class="align-middle text-center"><?php echo $LANG['action']; ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#">#1721376023_2</a></td>
							<td>Tuyết Minh Nhật</td>
							<td>500.000 VNĐ</td>
							<td><span class="badge text-bg-info">Chờ xử lý</span></td>
							<td>31/03/2023</td>
							<td>
								<a href="#" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa"><i class="fa-light fa-pen-to-square"></i></a>
								<a href="#" class="badge text-bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem chi tiết"><i class="fa-light fa-circle-info"></i></i></a>
								<a href="#" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa"><i class="fa-light fa-trash-can"></i></a>
							</td>
						</tr>
						<tr>
							<td><a href="#">#1721376023_1</a></td>
							<td>Tuyết Lệ Hàn</td>
							<td>400.000 VNĐ</td>
							<td><span class="badge text-bg-info">Chờ xử lý</span></td>
							<td>31/03/2023</td>
							<td>
								<a href="#" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa"><i class="fa-light fa-pen-to-square"></i></a>
								<a href="#" class="badge text-bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem chi tiết"><i class="fa-light fa-circle-info"></i></i></a>
								<a href="#" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa"><i class="fa-light fa-trash-can"></i></a>
							</td>
						</tr>
						<tr>
							<td><a href="#">#1721376023_3</a></td>
							<td>Tuyết Tâm</td>
							<td>300.000 VNĐ</td>
							<td><span class="badge text-bg-info">Chờ xử lý</span></td>
							<td>30/03/2023</td>
							<td>
								<a href="#" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa"><i class="fa-light fa-pen-to-square"></i></a>
								<a href="#" class="badge text-bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem chi tiết"><i class="fa-light fa-circle-info"></i></i></a>
								<a href="#" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa"><i class="fa-light fa-trash-can"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<section class="box-section mb-3">
		<div class="row">
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary"><?php echo $LANG['order']; ?></h3>
				  	</div>
				  	<div class="card-body">
					  <a href="<?php echo _LINK_ORDER_LIST; ?>" class="btn btn-primary d-block mb-2" title=""><?php echo $LANG['list-order']; ?></a>
					  <a href="<?php echo _LINK_ORDER_CREATE; ?>" class="btn btn-warning d-block mb-2" title=""><?php echo $LANG['add-order']; ?></a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary"><?php echo $LANG['product']; ?></h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="<?php echo _LINK_PRODUCT_LIST; ?>" class="btn btn-primary d-block mb-2" title=""><?php echo $LANG['list-product']; ?></a>
				    	<a href="<?php echo _LINK_PRODUCT_CREATE; ?>" class="btn btn-warning d-block" title=""><?php echo $LANG['add-product']; ?></a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary"><?php echo $LANG['content']; ?></h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="<?php echo _LINK_CONTENT_LIST; ?>" class="btn btn-primary d-block mb-2" title=""><?php echo $LANG['list-article']; ?></a>
				    	<a href="<?php echo _LINK_CONTENT_CREATE; ?>" class="btn btn-warning d-block" title=""><?php echo $LANG['add-article']; ?></a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary"><?php echo $LANG['news']; ?></h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="<?php echo _LINK_NEWS_LIST; ?>" class="btn btn-primary d-block mb-2" title=""><?php echo $LANG['list-news']; ?></a>
				    	<a href="<?php echo _LINK_NEWS_CREATE; ?>" class="btn btn-warning d-block" title=""><?php echo $LANG['add-news']; ?></a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary"><?php echo $LANG['category']; ?></h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="<?php echo _LINK_CATEGORY_PRODUCT; ?>" class="btn btn-success d-block mb-2" title=""><?php echo $LANG['category-product']; ?></a>
				    	<a href="<?php echo _LINK_CATEGORY_CONTENT; ?>" class="btn btn-success d-block" title=""><?php echo $LANG['category-content']; ?></a>
				  	</div>
				</div>
			</div>
		</div>
	</section>
</div>