<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php
                                $product = new product();
                    $getproductbyId =$product->getproductbyId($_GET['sanpham']);
                    if($getproductbyId){
                        while ($result=$getproductbyId->fetch_assoc()) {              
                ?>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                
                                <h3 class="mb-0" id="h3-title">Các kích cỡ: <?php echo $result['tensp']; ?></h3>
                                <?php
                    $getcolorbyId =$product->getcolorbyId($_GET['color']);
                    if($getcolorbyId){
                        while ($resultc=$getcolorbyId->fetch_assoc()) {              
                ?>
                                <h3>Có màu: <?php echo $resultc['tenmau']; ?></h3>
                            <?php }} ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <ul id="hienthi-dropdown">
                                <li value="0">Hoạt động</li>
                                <li value="1">Đã hủy</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <select id="itemsPerPage" onchange="changeItemsPerPage()">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-lg-6" style="padding-top:10px;">
                            <button class="btn d-inline-flex btn-sm btn-danger mx-1" onclick="showaddModal()">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Thêm mới</span>
                                </button>
                        </div>
                        <div class="col-lg-2 text-end" style="padding-top:10px;">
                            <a class="btn d-inline-flex btn-sm btn-secondary mx-1" href="productcolor.php?sanpham=<?php echo $_GET['sanpham'] ?>">
                                    <span class=" pe-2">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </span>
                                    <span>Quay lại</span>
                                </a>
                        </div>
                        <div class="col-lg-3">
                            <div class="search-container">
                                <input type="text" id="search" class="search-input" placeholder="Tìm kiếm...">
                                <button class="search-button"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="width: 39px;">STT</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Kích cỡ</th>
                                            <th scope="col">Tồn kho</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">#</th>  
                                        </tr>
                                    </thead>
                                    <tbody id="danhmuc-table-body"></tbody>                                
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-pageinfo">
                            <table>
                                <tr>
                                    <td>
                                        <div id="itemCount"></div>
                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="paginationInfo"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-8" style="text-align: right;">
                            <ul id="pagination"></ul>
                        </div>
                    </div>
                    
                    
                </div>


<!-- new modal add update -->
<div class="modal-overlay" id="modalAdd">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin sản phẩm</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">  

      				<label class="col-sm-2 col-form-label">Tên sản phẩm:</label>
                    <div class="col-sm-7">
                    <textarea class="form-control" id="tieude" rows="1" readonly><?php echo $result['tensp']; ?></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="masp" readonly value="<?php echo $result['masp']; ?>">
                    </div>

      				<label class="col-sm-1 col-form-label">Mã SP</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="sanpham" readonly value="<?php echo $result['id']; ?>">
                    </div>  

                    <label class="col-sm-2 col-form-label">Giá:</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" id="giahienthi" value="<?php echo $result['gia']; ?>" oninput="formatPrice('giahienthi','giareal')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" name="gia" id="giareal" placeholder="Nhập thông tin" value="<?php echo $result['gia']; ?>">
                    </div> 

                    <label class="col-sm-1 col-form-label">Giá KM:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control" id="giakmhienthi" value="<?php echo $result['giakm']; ?>" oninput="formatPrice('giakmhienthi','giakmreal')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" name="giakm" id="giakmreal" placeholder="Nhập thông tin" value="<?php echo $result['giakm']; ?>">
                    </div> 

                    <label class="col-sm-1 col-form-label">Kích cỡ:</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="kichco" name="kichco">
                        </select>
                    </div> 

                    <div style="display:none;">
                        <label class="col-sm-1 col-form-label">Thời gian:</label>
                        <div class="col-sm-3">
                         <input type="datetime-local" id="thoigian" name="thoigian">
                        </div>
                    </div> 

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="url" rows="1" readonly><?php echo $result['url']; ?></textarea>  
                    </div>                                                                         

                    <label class="col-sm-1 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="uutien" value="0" 
                    placeholder="Nhập thông tin">
                    </div>                 

                    <label class="col-sm-1 col-form-label">Tồn kho:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="soluong" value="0" 
                    placeholder="Nhập thông tin">
                    </div>
                                                                
      </form>
    </div>
    <div class="modal-footerr">
        <div></div>
        <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
  </div>
</div>


<!-- update -->
<div class="modal-overlay" id="modalUpdate">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin sản phẩm</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">  

      				<label class="col-sm-2 col-form-label">Tên sản phẩm:</label>
                    <div class="col-sm-7">
                    <textarea class="form-control" id="tieude_update" rows="1" readonly><?php echo $result['tensp']; ?></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update">
                    </div>

      				<label class="col-sm-1 col-form-label">Mã SP</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="id_update" readonly value="<?php echo $result['id']; ?>">
                    </div>  

                    <label class="col-sm-2 col-form-label">Giá:</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" id="giahienthi_update" oninput="formatPrice('giahienthi_update','giareal_update')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" id="giareal_update" placeholder="Nhập thông tin" value="0">
                    </div> 

                    <label class="col-sm-1 col-form-label">Giá KM:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control" id="giakmhienthi_update" oninput="formatPrice('giakmhienthi_update','giakmreal_update')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" id="giakmreal_update" placeholder="Nhập thông tin" value="0">
                    </div>  

                    <label class="col-sm-1 col-form-label">Kích cỡ:</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="kichco_update">
                        </select>
                    </div>                                          

                    <div style="display:none;">
                        <label class="col-sm-1 col-form-label">Thời gian:</label>
                        <div class="col-sm-3">
                         <input type="datetime-local" id="thoigian_update">
                        </div>
                    </div>  

                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                        <div class="col-sm-4">
                    <select class="form-control" name="hienthi" id="hienthi_update">
                        <option>Trạng thái</option>
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                    </select>
                    </div>                                  
                    
                    <label class="col-sm-1 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="uutien_update" 
                    placeholder="Nhập thông tin">
                    </div>   

                    <label class="col-sm-1 col-form-label">Tồn kho:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="soluong_update" 
                    placeholder="Nhập thông tin">
                    </div>                                    

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-7">
                    <textarea class="form-control" id="url_update" rows="1" readonly><?php echo $result['url']; ?></textarea>  
                    </div>
                    <div class="col-lg-2"></div>                                                                
      </form>
    </div>
    <div class="modal-footerr">
        <div></div>
        <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
  </div>
</div>
<?php }} ?>

<script type="text/javascript">

    function createItem() {
    	var masp = document.getElementById('masp').value;
	    var tensp = document.getElementById('tieude').value;
	    var url = document.getElementById('url').value;
	    var kichco = document.getElementById('kichco').value;
	    if (!masp || !tensp || !url|| !kichco) {
	        toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
	        return;
	    }
            
            var formData = new FormData();
            <?php
                    $getcolorbyId =$product->getproductcolorbyIdAndColor($_GET['sanpham'],$_GET['color']);
                    if($getcolorbyId){
                        while ($resultc=$getcolorbyId->fetch_assoc()) {              
                ?>
            formData.append('hinhanh', '<?php echo $resultc['hinhanh'] ?>');
        <?php }} ?>
            formData.append('masp', masp);
            formData.append('tensp', tensp);            
            formData.append('gia', document.getElementById('giareal').value);
            formData.append('giakm', document.getElementById('giakmreal').value);
            formData.append('uutien', document.getElementById('uutien').value);
            formData.append('mausac', <?php echo $_GET['color'] ?>);   
            formData.append('kichco', kichco); 
            formData.append('soluong', document.getElementById('soluong').value);     
            formData.append('thoigian', document.getElementById('thoigian').value);
            formData.append('url', url);            

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/productsize/create.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                toastr.success('Thông báo', 'Thêm mới thành công');
                document.getElementById('modalAdd').style.display = 'none';
                fetchDataByPage();
                resetForm();
                resetFormkhac();
            })
            .catch(error => {
                console.error('Error:', error);
            });

	}   
    function updateItem() {
	    var kichco = document.getElementById('kichco_update').value;
	    if (!kichco) {
	        toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
	        return;
	    }     
            var formData = new FormData();     
            formData.append('gia', document.getElementById('giareal_update').value);
            formData.append('giakm', document.getElementById('giakmreal_update').value);
            formData.append('uutien', document.getElementById('uutien_update').value);    
            formData.append('mausac', <?php echo $_GET['color'] ?>);   
            formData.append('kichco', kichco); 
            formData.append('soluong', document.getElementById('soluong_update').value);     
            formData.append('thoigian', document.getElementById('thoigian_update').value);
            formData.append('hienthi', document.getElementById('hienthi_update').value);
            formData.append('id', document.getElementById('id_update').value);

	        // Gửi yêu cầu POST sử dụng formData
	        fetch(`${apiBaseURL}/admin/api/productsize/update.php`, {
	            method: 'POST',
	            body: formData,
	        })
	        .then(response => response.json())
	        .then(data => {
	            toastr.success('Thông báo', 'Cập nhật thành công');
	            document.getElementById('modalUpdate').style.display = 'none';
	            fetchDataByPage();
	        })
	        .catch(error => {
	            console.error('Error:', error);
	        });

    }

   
    function performDelete(id) {
        var formData = {
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/productsize/delete.php`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Xóa thành công');
            fetchDataByPage();
        })
        .catch(error => {
            toastr.error('Thông báo', 'Xóa thất bại');
        });
    }
    function updateStatusBefore(id, hienthi) {
        var formData = {
            hienthi: hienthi,
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/productsize/updatestatus.php`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Cập nhật thành công');
            fetchDataByPage();
        })
        .catch(error => {
            toastr.error('Thông báo', 'Cập nhật thất bại');
        });
    }
   
        function openDetail(id) {
            fetch(`${apiBaseURL}/admin/api/productsize/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
            	document.getElementById('id_update').value = data.id;
                document.getElementById('giareal_update').value = data.gia;
                document.getElementById('giahienthi_update').value = formatNumberWithCommas(data.gia);
                document.getElementById('giakmreal_update').value = data.giakm;
                document.getElementById('giakmhienthi_update').value = formatNumberWithCommas(data.giakm);
                document.getElementById('uutien_update').value = data.uutien;
                document.getElementById('kichco_update').value = data.kichco;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('soluong_update').value = data.soluong;
                document.getElementById('thoigian_update').value = data.thoigian;
                
                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function populateColorSelect() {
		    fetch(`${apiBaseURL}/admin/api/mausac/read.php`, {
		        method: 'GET',
		        headers: {
		            'Content-Type': 'application/json',
		        },
		    })
		    .then(response => response.json())
		    .then(danhmucData => {
		        var selectDanhmuc = document.getElementById('mausac');
		        var selectDanhmuc_update = document.getElementById('mausac_update');

		        // Clear existing options
		        selectDanhmuc.innerHTML = '';
		        selectDanhmuc_update.innerHTML = '';

		        // Add initial option for both selects
		        var initialOption = document.createElement('option');
		        initialOption.value = '';
		        initialOption.text = 'Chọn màu';
		        selectDanhmuc.appendChild(initialOption);

		        var initialOptionUpdate = document.createElement('option');
		        initialOptionUpdate.value = '';
		        initialOptionUpdate.text = 'Chọn màu';
		        selectDanhmuc_update.appendChild(initialOptionUpdate);

				danhmucData.data.forEach(item => {
				    var option = document.createElement('option');
				    option.value = item.id;
				    option.text = item.tenmau;
				    selectDanhmuc.appendChild(option);

				    var optionUpdate = document.createElement('option');
				    optionUpdate.value = item.id;
				    optionUpdate.text = item.tenmau;
				    selectDanhmuc_update.appendChild(optionUpdate);

				});

		    })
		    .catch(error => {
		        console.error('Error fetching danh muc data:', error);
		    });
		}
		function populateSizeSelect() {
		    fetch(`${apiBaseURL}/admin/api/kichco/read.php`, {
		        method: 'GET',
		        headers: {
		            'Content-Type': 'application/json',
		        },
		    })
		    .then(response => response.json())
		    .then(danhmucData => {
		        var selectDanhmuc = document.getElementById('kichco');
		        var selectDanhmuc_update = document.getElementById('kichco_update');

		        // Clear existing options
		        selectDanhmuc.innerHTML = '';
		        selectDanhmuc_update.innerHTML = '';

		        // Add initial option for both selects
		        var initialOption = document.createElement('option');
		        initialOption.value = '';
		        initialOption.text = 'Chọn kích cỡ';
		        selectDanhmuc.appendChild(initialOption);

		        var initialOptionUpdate = document.createElement('option');
		        initialOptionUpdate.value = '';
		        initialOptionUpdate.text = 'Chọn kích cỡ';
		        selectDanhmuc_update.appendChild(initialOptionUpdate);

				danhmucData.data.forEach(item => {
				    var option = document.createElement('option');
				    option.value = item.id;
				    option.text = item.tenkichco;
				    selectDanhmuc.appendChild(option);

				    var optionUpdate = document.createElement('option');
				    optionUpdate.value = item.id;
				    optionUpdate.text = item.tenkichco;
				    selectDanhmuc_update.appendChild(optionUpdate);

				});

		    })
		    .catch(error => {
		        console.error('Error fetching danh muc data:', error);
		    });
		}

        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/productsize/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}&filtersanpham=<?php echo $_GET['sanpham'] ?>&filtercolor=<?php echo $_GET['color'] ?>`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                displayPage(data);
                displayDataInTable(data);
            })
            .catch(error => {
                console.error('Error:', error);
                var tableBody = document.getElementById('danhmuc-table-body');
                tableBody.innerHTML = '<p style="text-align:center;">Không có dữ liệu</p>';
            });
        }


        function displayDataInTable(data) {
		    var tableBody = document.getElementById('danhmuc-table-body');

		    tableBody.innerHTML = '';	  
            var i=0;
		    data.data.forEach(item => {
                i++;
		        var row = tableBody.insertRow();

		        var cell1 = row.insertCell(0);
		        var cell2 = row.insertCell(1);
		        var cell3 = row.insertCell(2);
		        var cell4 = row.insertCell(3);
		        var cell5 = row.insertCell(4);
		        var cell6 = row.insertCell(5);
		        var cell7 = row.insertCell(6);

		        cell1.innerHTML = i;
		        cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.tensp + '</a>';
		        cell3.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="50px" height="50px"/>'
                cell4.innerHTML = item.tenkichco;
                cell5.innerHTML = item.soluong;

		        cell6.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell6.style.textAlign="center";

		        cell7.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';	
                cell7.style.textAlign="center";	       
		    });
		}

        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
            populateColorSelect();
            populateSizeSelect();
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

