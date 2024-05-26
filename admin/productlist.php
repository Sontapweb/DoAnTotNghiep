<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(5) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-box{
        color: #fff !important;
    }
    .dmgoc {
	    font-weight: 600;
	}

	.dmcon {
	    color: #555;
	}
</style>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Quản lý sản phẩm</h3>
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
                        <div class="col-lg-4" style="padding-top:10px;">
                            <button class="btn d-inline-flex btn-sm btn-danger mx-1" onclick="showaddModal()">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Thêm mới</span>
                                </button>
                        </div>  
                        <div class="col-lg-2" style="padding: 4px 10px 0 0;">                           
                            <select id="filterDanhmuc" onchange="changeDanhmucFilter()"></select>
                        </div>                      
                        <div class="col-lg-2" style="padding: 4px 0 0 0;">                           
                            <select id="filterThuonghieu" onchange="changeThuonghieuFilter()"></select>
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
                                            <th scope="col" width="39px">STT</th>
                                            <th scope="col" width="49px">Mã SP</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Thương hiệu</th>      
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Sản phẩm</th>
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
                    <textarea class="form-control" name="tieude" id="tieude" onkeyup="updateUrl()" rows="1"></textarea>
                    </div>

      				<label class="col-sm-1 col-form-label">Mã SP</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" name="masp" id="masp">
                    </div>  

                    <label class="col-sm-2 col-form-label">Danh mục</label>
                        <div class="col-sm-4">
                    <select class="form-control" id="danhmuc" name="danhmuc">
                        </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Giá:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control" id="giahienthi" value="0" oninput="formatPrice('giahienthi','giareal')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" name="gia" id="giareal" placeholder="Nhập thông tin" value="0">
                    </div> 

                    <label class="col-sm-1 col-form-label">Giá KM:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control" id="giakmhienthi" value="0" oninput="formatPrice('giakmhienthi','giakmreal')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" id="giakmreal" placeholder="Nhập thông tin" value="0">
                    </div> 

                    <label class="col-sm-2 col-form-label">Thương hiệu:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="thuonghieu" name="thuonghieu">
                        </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Màu sắc:</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="mausac" name="mausac">
                        </select>
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
                                                          
                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <input type="file" name="hinhanh" id="hinhanh">
                    </div>

                    <label class="col-sm-1 col-form-label">Loại:</label>
                    <div class="col-sm-2">
	                    <select class="form-control" name="loai" id="loai">
	                        <option value="0" >Nổi bật</option>
	                        <option value="1">Không nổi bật</option>
	                    </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="uutien" value="0" 
                    placeholder="Nhập thông tin">
                    </div>
                  
                    <label class="col-sm-2 col-form-label title">Tiêu Đề:</label>
                    <div class="col-sm-8 title">
                    <textarea class="form-control" name="title" id="title" rows="1"></textarea>
                    </div>
                    <div class="col-lg-2"></div>
                    
                    <label class="col-sm-2 col-form-label">Keywords:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="keywords" id="keywords" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="url" id="url" rows="1"></textarea>  
                    </div>

                    <label class="col-sm-2"></label>

                    <label class="col-sm-2 col-form-label">Mô Tả:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                                   

                    <label class="col-sm-2 col-form-label">Thông tin:</label>
                    <div class="col-sm-8">
                     <textarea name="editor1" id="editor1" rows="5" cols="80"></textarea>
                    </div>

                    <div class="col-lg-2"></div>
                                               
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
                    <textarea class="form-control" id="tieude_update" onkeyup="updateUrl()" rows="1"></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="masp_update">
                    </div>

      				<label class="col-sm-1 col-form-label">Mã SP</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="id_update">
                    </div>  

                    <label class="col-sm-2 col-form-label">Danh mục</label>
                        <div class="col-sm-4">
                    <select class="form-control" id="danhmuc_update">
                        </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Giá:</label>
                    <div class="col-sm-2">
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

                    <label class="col-sm-2 col-form-label">Thương hiệu:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="thuonghieu_update">
                        </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Màu sắc:</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="mausac_update">
                        </select>
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
                                                          
                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <img src="" width="70" height="50" id="hienthianh">
                        <input type="file" id="hinhanh_update" />
                    </div> 

                    <label class="col-sm-1 col-form-label">Loại:</label>
                    <div class="col-sm-2">
	                    <select class="form-control" id="loai_update">
	                        <option value="0" >Nổi bật</option>
	                        <option value="1">Không nổi bật</option>
	                    </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="uutien_update" 
                    placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                        <div class="col-sm-4">
                    <select class="form-control" name="hienthi" id="hienthi_update">
                        <option>Trạng thái</option>
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                    </select>
                    </div> 

                    <div class="col-lg-6"></div>
                  
                    <label class="col-sm-2 col-form-label title">Tiêu Đề:</label>
                    <div class="col-sm-8 title">
                    <textarea class="form-control" id="title_update" rows="1"></textarea>
                    </div>
                    <div class="col-lg-2"></div>
                    
                    <label class="col-sm-2 col-form-label">Keywords:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" id="keywords_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" id="url_update" rows="1"></textarea>  
                    </div>

                    <label class="col-sm-2"></label>

                    <label class="col-sm-2 col-form-label">Mô Tả:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="description_update"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                                   

                    <label class="col-sm-2 col-form-label">Thông tin:</label>
                    <div class="col-sm-8">
                     <textarea name="editor1" id="editor1_update" rows="5" cols="80"></textarea>
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

<script type="text/javascript">

    function createItem() {
        var masp = document.getElementById('masp').value;
        var tensp = document.getElementById('tieude').value;
        var url = document.getElementById('url').value;
        var danhmuc = document.getElementById('danhmuc').value;
        var thuonghieu = document.getElementById('thuonghieu').value;
        if (!masp || !tensp || !url || !thuonghieu || !danhmuc) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        // Lấy thời gian hiện tại
        var currentDate = new Date();
        var idSuffix = '' + currentDate.getHours() + currentDate.getMinutes() + currentDate.getSeconds() + currentDate.getDate() + (currentDate.getMonth() + 1) + currentDate.getFullYear();

        // Tạo ID từ thời gian hiện tại
        var newId = 'id' + idSuffix;

        // Thêm ID mới vào input
        var newInputElement = document.createElement('input');
        newInputElement.setAttribute('type', 'text');
        newInputElement.setAttribute('id', newId);
        document.body.appendChild(newInputElement); // Thay 'document.body' bằng phần tử mẹ của input nếu cần

        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh');
        var hinhanhFile = hinhanhInput.files[0];

        // Kiểm tra xem có file ảnh được chọn hay không
        if (hinhanhFile) {
            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('masp', newId);
            formData.append('tensp', tensp);
            formData.append('danhmuc', danhmuc);
            formData.append('thuonghieu', thuonghieu);
            formData.append('gia', document.getElementById('giareal').value);
            formData.append('giakm', document.getElementById('giakmreal').value);
            formData.append('uutien', document.getElementById('uutien').value);
            formData.append('mausac', document.getElementById('mausac').value);
            formData.append('kichco', document.getElementById('kichco').value);
            formData.append('loai', document.getElementById('kichco').loai);
            formData.append('thoigian', document.getElementById('thoigian').value);
            formData.append('thongtin', CKEDITOR.instances.editor1.getData());
            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('url', url);
            formData.append('keywords', document.getElementById('keywords').value);
            formData.append('id', masp);
            formData.append('soluong', 0);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/product/create.php`, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    fetch(`${apiBaseURL}/admin/api/productcolor/create.php`, {
                        method: 'POST',
                        body: formData,
                    })  

                    fetch(`${apiBaseURL}/admin/api/productsize/create.php`, {
                        method: 'POST',
                        body: formData,
                    }) 
                    toastr.success('Thông báo', 'Thêm mới thành công');
                    document.getElementById('modalAdd').style.display = 'none';
                    fetchDataByPage();
                    resetForm();
                    resetFormkhac();
                })
                .catch(error => {                    
                    console.error('Error:', error);
                });                         

        } else {
            toastr.error('Lỗi', 'Vui lòng chọn ảnh');
        }
    }

    function updateItem() {
        var masp = document.getElementById('masp_update').value;
	    var tensp = document.getElementById('tieude_update').value;
	    var url = document.getElementById('url_update').value;
	    var danhmuc = document.getElementById('danhmuc_update').value;
	    var thuonghieu = document.getElementById('thuonghieu_update').value;
	    if (!masp || !tensp || !url|| !thuonghieu || !danhmuc) {
	        toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
	        return;
	    }
        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh_update');
        var hinhanhFile = hinhanhInput.files[0];

	        var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('masp', masp);
            formData.append('tensp', tensp);
            formData.append('danhmuc', danhmuc);
            formData.append('thuonghieu', thuonghieu);            
            formData.append('gia', document.getElementById('giareal_update').value);
            formData.append('giakm', document.getElementById('giakmreal_update').value);
            formData.append('uutien', document.getElementById('uutien_update').value);    
            formData.append('mausac', document.getElementById('mausac_update').value);   
            formData.append('kichco', document.getElementById('kichco_update').value); 
            formData.append('loai', document.getElementById('loai_update').value);     
            formData.append('thoigian', document.getElementById('thoigian_update').value);
            formData.append('hienthi', document.getElementById('hienthi_update').value);
            formData.append('thongtin', CKEDITOR.instances.editor1_update.getData());
            formData.append('title', document.getElementById('title_update').value);
            formData.append('description', document.getElementById('description_update').value);
            formData.append('url', url);
            formData.append('keywords', document.getElementById('keywords_update').value);
            formData.append('id', document.getElementById('id_update').value);

	        // Gửi yêu cầu POST sử dụng formData
	        fetch(`${apiBaseURL}/admin/api/product/update.php`, {
	            method: 'POST',
	            body: formData,
	        })
	        .then(response => response.json())
	        .then(data => {
	            toastr.success('Thông báo', 'Cập nhật thành công');
	            document.getElementById('modalUpdate').style.display = 'none';
	            hinhanhInput.value = null;
	            fetchDataByPage();
	        })
	        .catch(error => {
	            console.error('Error:', error);
	        });            

        var formData2 = {
            masp: masp,
            tensp: tensp,
            url: url,
        };

        fetch(`${apiBaseURL}/admin/api/product/updateproductcolor.php`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData2),
        })
        fetch(`${apiBaseURL}/admin/api/product/updateproductsize.php`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData2),
        })

    }
    function updateStatusBefore(madm, hienthi) {
        var formData = {
            hienthi: hienthi,
            masp: madm,
        };

        fetch(`${apiBaseURL}/admin/api/product/updatestatus.php`, {
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
   
    function performDelete(masp) {
        var formData = {
            masp: masp,
        };

        fetch(`${apiBaseURL}/admin/api/product/delete.php`, {
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
        fetch(`${apiBaseURL}/admin/api/product/deleteprotype.php`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        });
    }
   
        function openDetail(masp) {
            fetch(`${apiBaseURL}/admin/api/product/show.php?masp=` + masp, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('masp_update').value = data.masp;
                document.getElementById('tieude_update').value = data.tensp;
                document.getElementById('danhmuc_update').value = data.danhmuc;
                document.getElementById('thuonghieu_update').value = data.thuonghieu;
                document.getElementById('giareal_update').value = data.gia;
                document.getElementById('giahienthi_update').value = formatNumberWithCommas(data.gia);
                document.getElementById('giakmreal_update').value = data.giakm;
                document.getElementById('giakmhienthi_update').value = formatNumberWithCommas(data.giakm);
                document.getElementById('mausac_update').value = data.mausac;              
                document.getElementById('uutien_update').value = data.uutien;
                document.getElementById('kichco_update').value = data.kichco;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('loai_update').value = data.loai;
                document.getElementById('thoigian_update').value = data.thoigian;
                document.getElementById('title_update').value = data.title;
                document.getElementById('keywords_update').value = data.keywords;
                document.getElementById('url_update').value = data.url;
                document.getElementById('description_update').value = data.description;
                document.getElementById('hienthianh').src = `uploads/${data.hinhanh}`;
                document.getElementById('id_update').value = data.id;

                CKEDITOR.instances.editor1_update.setData(data.thongtin);
                
                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function populateDanhmucSelect() {
		    fetch(`${apiBaseURL}/admin/api/danhmuc/read.php`, {
		        method: 'GET',
		        headers: {
		            'Content-Type': 'application/json',
		        },
		    })
		    .then(response => response.json())
		    .then(danhmucData => {
		        var selectDanhmuc = document.getElementById('danhmuc');
		        var selectDanhmuc_update = document.getElementById('danhmuc_update');
		        var selectDanhmuc_filter = document.getElementById('filterDanhmuc');

		        // Clear existing options
		        selectDanhmuc.innerHTML = '';
		        selectDanhmuc_update.innerHTML = '';

		        // Add initial option for both selects
		        var initialOption = document.createElement('option');
		        initialOption.value = '';
		        initialOption.text = 'Chọn danh mục';
		        selectDanhmuc.appendChild(initialOption);

		        var initialOptionUpdate = document.createElement('option');
		        initialOptionUpdate.value = '';
		        initialOptionUpdate.text = 'Chọn danh mục';
		        selectDanhmuc_update.appendChild(initialOptionUpdate);

		        var initialOptionFilter = document.createElement('option');
		        initialOptionFilter.value = '';
		        initialOptionFilter.text = 'Chọn danh mục';
		        selectDanhmuc_filter.appendChild(initialOptionFilter);

				danhmucData.data.forEach(item => {
				    var option = document.createElement('option');
				    option.value = item.madm;
				    option.text = item.tendm;
				    selectDanhmuc.appendChild(option);

				    var optionUpdate = document.createElement('option');
				    optionUpdate.value = item.madm;
				    optionUpdate.text = item.tendm;
				    selectDanhmuc_update.appendChild(optionUpdate);

				    var optionFilter = document.createElement('option');
				    optionFilter.value = item.madm;
				    optionFilter.text = item.tendm;
				    selectDanhmuc_filter.appendChild(optionFilter);

				});

		    })
		    .catch(error => {
		        console.error('Error fetching danh muc data:', error);
		    });
		}

		var filterdanhmuc = document.getElementById('filterDanhmuc').value;

		function changeDanhmucFilter() {
            filterdanhmuc = document.getElementById('filterDanhmuc').value;
            fetchDataByPage();
        }

        function populateThuonghieuSelect() {
		    // Fetch danh muc tin tuc data from the API
		    fetch(`${apiBaseURL}/admin/api/thuonghieu/read.php`, {
		        method: 'GET',
		        headers: {
		            'Content-Type': 'application/json',
		        },
		    })
		    .then(response => response.json())
		    .then(thoihanData => {
		        var selectThuonghieu = document.getElementById('thuonghieu');
		        var selectThuonghieu_update = document.getElementById('thuonghieu_update');
		        var selectThuonghieu_filter = document.getElementById('filterThuonghieu');

		        // Clear existing options
		        selectThuonghieu.innerHTML = '';
		        selectThuonghieu_update.innerHTML = '';

		        // Add initial option for both selects
		        var initialOption = document.createElement('option');
		        initialOption.value = '';
		        initialOption.text = 'Chọn thương hiệu';
		        selectThuonghieu.appendChild(initialOption);

		        var initialOptionUpdate = document.createElement('option');
		        initialOptionUpdate.value = '';
		        initialOptionUpdate.text = 'Chọn thương hiệu';
		        selectThuonghieu_update.appendChild(initialOptionUpdate);

		        var initialOptionFilter = document.createElement('option');
		        initialOptionFilter.value = '';
		        initialOptionFilter.text = 'Chọn thương hiệu';
		        selectThuonghieu_filter.appendChild(initialOptionFilter);

				thoihanData.data.forEach(item => {
				    var option = document.createElement('option');
				    option.value = item.math;
				    option.text = item.tenth;
				    selectThuonghieu.appendChild(option);

				    var optionUpdate = document.createElement('option');
				    optionUpdate.value = item.math;
				    optionUpdate.text = item.tenth;
				    selectThuonghieu_update.appendChild(optionUpdate);

				    var optionFilter = document.createElement('option');
				    optionFilter.value = item.math;
				    optionFilter.text = item.tenth;
				    selectThuonghieu_filter.appendChild(optionFilter);
				});

		    })
		    .catch(error => {
		        console.error('Error fetching thoi han data:', error);
		    });
		}

		var filterThuonghieu = document.getElementById('filterThuonghieu').value;

		function changeThuonghieuFilter() {
            filterThuonghieu = document.getElementById('filterThuonghieu').value;
            fetchDataByPage();
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

            fetch(`${apiBaseURL}/admin/api/product/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}&filterdanhmuc=${filterdanhmuc}&filterthuonghieu=${filterThuonghieu}`, {
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
                var cell8 = row.insertCell(7);
                var cell9 = row.insertCell(8);

		        cell1.innerHTML = i;
                cell2.innerHTML = item.id;
		        cell3.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.masp + '\')">' + item.tensp + '</a>';
		        cell4.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="50px" height="50px"/>'
		        cell5.innerHTML = item.tendanhmuc;
                cell6.innerHTML = item.tenthuonghieu;

		        cell7.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.masp + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.masp + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell7.style.textAlign="center";
                cell8.innerHTML = '<a href="productcolor.php?sanpham=' + item.masp + '">Danh sách</a>';
                cell8.style.textAlign="center";

		        cell9.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.masp + '\')">Xem</button><button onclick="deleteItem(\'' + item.masp + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';	
                cell9.style.textAlign="center";	       
		    });
		}


        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
            populateDanhmucSelect();
            populateThuonghieuSelect();
            populateColorSelect();
            populateSizeSelect();
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

