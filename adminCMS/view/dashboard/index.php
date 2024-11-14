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
			<h6 class="text-primary fw-bolder mb-3">Đơn hàng chưa xử lý</h6>
			<table id="table-order" class="table table-striped table-hover table-bordered" style="width:100%">
				<thead>
		            <tr>
		            	<th>Mã đơn</th>
		                <th>Khách hàng</th>
		                <th>Tổng tiền</th>
		                <th>Trạng thái</th>
		                <th>Ngày đặt</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<tr>
		        		<td>BM03</td>
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
		        		<td>BM02</td>
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
		        		<td>BM01</td>
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
	</section>
	<section class="box-section mb-3">
		<div class="row">
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary">Đơn hàng</h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="#" class="btn btn-primary d-block mb-2" title="">Danh sách Đơn hàng</a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary">Sản phẩm</h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="#" class="btn btn-success d-block mb-2" title="">Danh mục Sản phẩm</a>
				    	<a href="#" class="btn btn-primary d-block mb-2" title="">Danh sách Sản phẩm</a>
				    	<a href="#" class="btn btn-warning d-block" title="">Thêm Sản phẩm</a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary">Tin tức</h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="#" class="btn btn-success d-block mb-2" title="">Danh mục Tin tức</a>
				    	<a href="#" class="btn btn-primary d-block mb-2" title="">Danh sách Tin tức</a>
				    	<a href="#" class="btn btn-warning d-block" title="">Thêm Tin tức</a>
				  	</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
				  	<div class="text-center pt-3">
				  		<h3 class="text-uppercase fw-bold text-primary">Nội dung</h3>
				  	</div>
				  	<div class="card-body">
				    	<a href="#" class="btn btn-success d-block mb-2" title="">Danh mục Nội dung</a>
				    	<a href="#" class="btn btn-primary d-block mb-2" title="">Danh sách Nội dung</a>
				    	<a href="#" class="btn btn-warning d-block" title="">Thêm Nội dung</a>
				  	</div>
				</div>
			</div>
		</div>
	</section>
</div>