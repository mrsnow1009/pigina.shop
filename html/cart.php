<!DOCTYPE html>
<html>
<head>
	<title>Đặt hàng</title>

	<?php include 'layouts/head.php'; ?>

</head>
<body>

	<?php include 'layouts/header.php'; ?>

	<section class="section-breadcumb">
	    <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
                </ol>
            </nav>
	    </div>
    </section>

	<section class="section-cart bg-white pt-3 pb-3 pt-lg-5 pb-lg-5">
		<div class="container">
			<div class="cart-container">
				<div class="tb-cart fz-13px">
					<div class="tb-head border-bottom pb-2 mb-3">
						<div class="thtr d-md-flex w-100">
							<div class="thtd-image-name">
								<div class="w-image-name">
									Sản phẩm <span class="badge bg-theme rounded-pill">3</span>
								</div>
							</div>
							<div class="thtd-price ms-auto">
								<div class="w-price d-none d-md-block">Giá</div>
							</div>
							<div class="thtd-reduced-price">
								<div class="w-reduced-price d-none d-md-block">Giá bán</div>
							</div>
							<div class="thtd-quanlity">
								<div class="w-quanlity d-none d-md-block">Số lượng</div>
							</div>
							<div class="thtd-total">
								<div class="w-total d-none d-md-block">Thành tiền</div>
							</div>
						</div>
					</div>
					<div class="tb-body border-bottom pb-3 mb-3">
						<div class="tbtr d-md-flex align-items-md-center w-100">
							<div class="tbtd-image-name d-flex align-items-center">
								<div class="tbtd-remove">
									<div class="w-remove">
										<a href="javascript:;" title="" onclick="removeCart(1)" class="d-inline-block p-1 fz-body">
											<i class="fa-regular fa-trash-can text-danger"></i>
										</a>
									</div>
								</div>
								<div class="tbtd-image ps-3">
									<div class="w-image">
										<a href="san-pham-chi-tiet.php" title="">
											<img src="images/product/vien-dat-se-khit-tai-tao-te-bao.jpg" alt="" loading="lazy" class="w-100" />
										</a>
									</div>
								</div>
								<div class="tbtd-name ps-3 pe-2">
									<div class="w-name">
										<a class="" href="san-pham-chi-tiet.php" title="">Set 18 viên đặt se khít - tái tạo tế bào 3</a>
									</div>
								</div>
							</div>
							<div class="tbtd-price ms-auto">
								<div class="w-price">
									<div class="d-flex justify-content-between d-md-block">
										<div class="d-md-none">Giá</div>
										<div>500.000 <span class="color-theme-intro">đ</span></div>
									</div>
								</div>
							</div>
							<div class="tbtd-reduced-price">
								<div class="w-reduced-price">
									<div class="d-flex justify-content-between d-md-block">
										<div class="d-md-none">Giá bán</div>
										<div>
											<span class="fw-semibold">495.000</span> <span class="color-theme-intro">đ</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tbtd-quanlity">
								<div class="w-quanlity">
									<div class="d-flex justify-content-between align-items-center d-md-block">
										<div class="d-md-none">Số lượng</div>
										<div>
											<div class="button-add-cart">
												<div class="input-group input-add-cart">
													<span class="input-group-text rounded-0" onclick="decreaseQuantityProduct(1)">-</span>
													<input onkeyup="enterQuantityProduct(1)" autocomplete="off" type="text" class="form-control text-center ps-1 pe-1 fz-13px" placeholder="" data-productId="1" name="quantity-input-1" id="quantity-input-1" value="1" />
													<span class="input-group-text rounded-0" onclick="increaseQuantityProduct(1)">+</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tbtd-total">
								<div class="w-total">
									<div class="d-flex justify-content-between d-md-block">
										<div class="d-md-none">Thành tiền</div>
										<div>
											<span class="fw-semibold total-productid-1">495.000</span> <span class="color-theme-intro">đ</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tbtr d-md-flex align-items-md-center w-100">
							<div class="tbtd-image-name d-flex align-items-center">
								<div class="tbtd-remove">
									<div class="w-remove">
										<a href="javascript:;" title="" onclick="removeCart(2)" class="d-inline-block p-1 fz-body">
											<i class="fa-regular fa-trash-can text-danger"></i>
										</a>
									</div>
								</div>
								<div class="tbtd-image ps-3">
									<div class="w-image">
										<a href="san-pham-chi-tiet.php" title="">
											<img src="images/product/dung-dich-ve-sinh-tao-tao-te-bao.png" alt="" loading="lazy" class="w-100" />
										</a>
									</div>
								</div>
								<div class="tbtd-name ps-3 pe-2">
									<div class="w-name">
										<a class="" href="san-pham-chi-tiet.php" title="">Dung dịch vệ sinh tái tạo tế bào</a>
									</div>
								</div>
							</div>
							<div class="tbtd-price ms-auto">
								<div class="w-price">
									<div class="d-flex justify-content-between d-md-block">
										<div class="d-md-none">Giá</div>
										<div>500.000 <span class="color-theme-intro">đ</span></div>
									</div>
								</div>
							</div>
							<div class="tbtd-reduced-price">
								<div class="w-reduced-price">
									<div class="d-flex justify-content-between d-md-block">
										<div class="d-md-none">Giá bán</div>
										<div>
											<span class="fw-semibold">500.000</span> <span class="color-theme-intro">đ</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tbtd-quanlity">
								<div class="w-quanlity">
									<div class="d-flex justify-content-between align-items-center d-md-block">
										<div class="d-md-none">Số lượng</div>
										<div>
											<div class="button-add-cart">
												<div class="input-group input-add-cart">
													<span class="input-group-text rounded-0" onclick="decreaseQuantityProduct(2)">-</span>
													<input onkeyup="enterQuantityProduct(2)" autocomplete="off" type="text" class="form-control text-center ps-1 pe-1 fz-13px" placeholder="" data-productId="2" name="quantity-input-2" id="quantity-input-2" value="2" />
													<span class="input-group-text rounded-0" onclick="increaseQuantityProduct(2)">+</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tbtd-total">
								<div class="w-total">
									<div class="d-flex justify-content-between d-md-block">
										<div class="d-md-none">Thành tiền</div>
										<div>
											<span class="fw-semibold total-productid-2">1.000.000</span> <span class="color-theme-intro">đ</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tb-foot">
						<div class="tftr d-flex justify-content-between w-100">
							<div class="thtd-total ms-md-auto">
								<div class="w-total-amount color-theme text-right fw-bold">Tổng thành tiền:</div>
							</div>
							<div class="thtd-total">
								<div class="w-total color-theme fw-bold fz-body">1.495.000 đ</div>
							</div>
						</div>
						<div class="tftr text-end mt-4">
							<a class="btn btn-theme" href="checkout.php" title="">Đặt hàng và Thanh toán</a>
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