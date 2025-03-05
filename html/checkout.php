<!DOCTYPE html>
<html>
<head>
	<title>Giỏ hàng</title>

	<?php include 'layouts/head.php'; ?>

</head>
<body>

	<?php include 'layouts/header.php'; ?>

	<section class="section-breadcumb">
	    <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                </ol>
            </nav>
	    </div>
    </section>

	<section class="section-cart bg-white pt-3 pb-3 pt-lg-5 pb-lg-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-12 order-lg-2 mb-4 mb-lg-0">
					<div class="section-sticky">
						<div class="box-consultant box-cart-right p-3 p-lg-4">
							<h3 class="title mb-3">Thanh toán</h3>
							<div class="cart-right-list">
								<div class="cart-right-item">
									<div class="name">1. Viên đặt phụ khoa toàn diện Pigina (6 viên)</div>
									<div class="d-flex justify-content-between fz-13px">
										<div class="left color-theme-intro">Số lượng: 1</div>
										<div class="right fw-semibold">495.000 <span class="color-theme-intro">đ</span></div>
									</div>
								</div>
								<div class="cart-right-item">
									<div class="name">2. Viên đặt phụ khoa toàn diện Pigina (6 viên)</div>
									<div class="d-flex justify-content-between fz-13px">
										<div class="left color-theme-intro">Số lượng: 1</div>
										<div class="right fw-semibold">495.000 <span class="color-theme-intro">đ</span></div>
									</div>
								</div>
								<div class="cart-right-item">
									<div class="name">3. Viên đặt phụ khoa toàn diện Pigina (6 viên)</div>
									<div class="d-flex justify-content-between fz-13px">
										<div class="left color-theme-intro">Số lượng: 1</div>
										<div class="right fw-semibold">495.000 <span class="color-theme-intro">đ</span></div>
									</div>
								</div>
							</div>
							<div class="cart-right-total border-top pt-3">
								<div class="d-flex justify-content-between">
									<div class="left fw-semibold">Tổng tiền:</div>
									<div class="right fw-semibold color-theme">1.485.000 đ</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-12 order-lg-1">
					<div class="cart-container">
						<h3 class="title-page">Thông tin đặt hàng</h3>
						<div class="form-order-wrapper">
							<form action="order-notification.php" class="form-order needs-validation" novalidate>
								<div class="d-sm-flex align-items-sm-center mb-3">
									<div>
										<label class="text-label" for="txtFullname">Họ Tên <span class="text-danger">(*)</span></label>
									</div>
									<div class="flex-grow-1">
										<input type="text" class="form-control" name="txtFullname" id="txtFullname" required="required" />
									</div>
								</div>
								<div class="d-sm-flex align-items-sm-center mb-3">
									<div>
										<label class="text-label" for="txtPhone">Số điện thoại <span class="text-danger">(*)</span></label>
									</div>
									<div class="flex-grow-1">
										<input type="text" class="form-control" name="txtPhone" id="txtPhone" required="required" />
									</div>
								</div>
								<div class="d-sm-flex align-items-sm-center mb-3">
									<div>
										<label class="text-label" for="txtAddress">Địa chỉ <span class="text-danger">(*)</span></label>
									</div>
									<div class="flex-grow-1">
										<input type="text" class="form-control" name="txtAddress" id="txtAddress" required="required" />
									</div>
								</div>
								<div class="d-sm-flex align-items-sm-center mb-3">
									<div>
										<label class="text-label" for="txtEmail">Email</label>
									</div>
									<div class="flex-grow-1">
										<input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="nếu có" />
									</div>
								</div>
								<div class="d-flex justify-content-end">
									<button class="btn btn-theme" type="submit">Xác nhận đặt hàng</button>
									<input name="txtAction" id="txtAction" type="hidden" required="required" class="form-control" value="order_confirm" />
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include 'layouts/footer.php'; ?>

	<?php include 'layouts/javascript.php'; ?>

</body>

</html>