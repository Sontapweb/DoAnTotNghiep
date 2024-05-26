<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(13) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-microsoft-teams{
        color: #fff !important;
    }
</style>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Quản lý CLB</h3>
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
                        <div class="col-lg-8" style="padding-top:10px;">
                            <button class="btn d-inline-flex btn-sm btn-danger mx-1" onclick="showaddModal()">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Thêm mới</span>
                                </button>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Tên CLB</th>
                                            <th scope="col">Hình ảnh</th>
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
      <h2>Thông tin CLB</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">
                    <label class="col-sm-2 col-form-label">Tên CLB:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="tieude" onkeyup="updateUrl()" rows="1" placeholder="Nhập thông tin"></textarea>
                    </div>


                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <input type="file" name="hinhanh" id="hinhanh">
                    </div> 
                                     
                    
                    <label class="col-sm-2 col-form-label">Vị trí:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" name="uutien" id="uutien" 
                    value="0">
                    </div>                               
                    
                        <label class="col-sm-2 col-form-label">Thời gian:</label>
                        <div class="col-sm-4">
                         <input type="datetime-local" id="thoigian" name="thoigian" class="form-control">
                        </div>     

                        <label class="col-sm-2 col-form-label title">Title:</label>
                    <div class="col-sm-8 title">
                    <textarea class="form-control" id="title" name="title" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                    

                    <label class="col-sm-2 col-form-label">Keywords:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" id="keywords" name="keywords" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="url" id="url" rows="1"></textarea>  
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="col-lg-2"></div>    
                            

                    <label class="col-sm-2 col-form-label">Tóm tắt:</label>
                    <div class="col-sm-8">
                     <textarea id="tomtat" rows="10" cols="80"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Mô tả :</label>
                    <div class="col-sm-8">
                     <textarea name="mota" id="editor2" rows="10" cols="80"></textarea>
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
      <h2>Thông tin CLB</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data">
                    <label class="col-sm-2 col-form-label">Tên CLB:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="tieude_update" onkeyup="updateUrl()" rows="1" placeholder="Nhập thông tin"></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update">
                    </div>
  

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <img src="" width="70" height="50" id="hienthianh">
                        <input type="file" name="hinhanh" id="hinhanh_update" />
                    </div> 
                                                                            
                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                        <div class="col-sm-4">
                    <select class="form-control" name="hienthi" id="hienthi_update">
                        <option>Trạng thái</option>
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                    </select>
                    </div>

                    <label class="col-sm-2 col-form-label">Vị trí:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" name="uutien" id="uutien_update" 
                    placeholder="Nhập thông tin">
                    </div>                    

                    <label class="col-sm-2 col-form-label title">Title:</label>
                    <div class="col-sm-8 title">
                    <textarea class="form-control" name="title" id="title_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                   

                    <label class="col-sm-2 col-form-label">Keywords:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="keywords" id="keywords_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="url" id="url_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="description" id="description_update"><</textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Tóm tắt:</label>
                    <div class="col-sm-8">
                     <textarea id="tomtat_update" class="form-control" rows="4" cols="80"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-8">
                     <textarea name="mota" id="editor2_update" rows="10" cols="80"></textarea>
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

<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckfinder/ckfinder.js" type="text/javascript"></script>
<script type="text/javascript">
    CKFinder.setupCKEditor();
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor1_update' );
    CKEDITOR.replace( 'editor2_update' );

    function createItem() {
	    var ten = document.getElementById('tieude').value;
	    var url = document.getElementById('url').value;
	    if (!tieude || !url ) {
	        toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
	        return;
	    }

	    // Lấy file từ input
	    var hinhanhInput = document.getElementById('hinhanh');
	    var hinhanhFile = hinhanhInput.files[0];

	    // Kiểm tra xem có file ảnh được chọn hay không
	    if (hinhanhFile) {
	        // Tạo formData và thêm hình ảnh vào đó
	        var formData = new FormData();
	        formData.append('hinhanh', hinhanhFile);
	        formData.append('ten', ten);
	        formData.append('tomtat', document.getElementById('tomtat').value);
	        formData.append('uutien', document.getElementById('uutien').value);
	        formData.append('thoigian', document.getElementById('thoigian').value);
	        formData.append('mota', CKEDITOR.instances.editor2.getData());
	        formData.append('title', document.getElementById('title').value);
	        formData.append('description', document.getElementById('description').value);
	        formData.append('url', url);
	        formData.append('keywords', document.getElementById('keywords').value);

	        // Gửi yêu cầu POST sử dụng formData
	        fetch(`${apiBaseURL}/admin/api/club/create.php`, {
	            method: 'POST',
	            body: formData,
	        })
	        .then(response => response.json())
	        .then(data => {
	            toastr.success('Thông báo', 'Thêm mới thành công');
	            document.getElementById('modalAdd').style.display = 'none';
	            hinhanhInput.value = null;
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
        var tieude = document.getElementById('tieude_update').value;
	    var url = document.getElementById('url_update').value;
	    if (!tieude || !url ) {
	        toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
	        return;
	    }

	    // Lấy file từ input
	    var hinhanhInput = document.getElementById('hinhanh_update');
	    var hinhanhFile = hinhanhInput.files[0];

	        var formData = new FormData();
	        formData.append('hinhanh', hinhanhFile);
	        formData.append('tieude', tieude);
	        formData.append('tomtat', document.getElementById('tomtat_update').value);
	        formData.append('uutien', document.getElementById('uutien_update').value);
	        formData.append('thoigian', document.getElementById('thoigian_update').value);
	        formData.append('hienthi', document.getElementById('hienthi_update').value);
	        formData.append('mota', CKEDITOR.instances.editor2_update.getData());
	        formData.append('title', document.getElementById('title_update').value);
	        formData.append('description', document.getElementById('description_update').value);
	        formData.append('url', url);
	        formData.append('keywords', document.getElementById('keywords_update').value);
	        formData.append('id', document.getElementById('id_update').value);

	        // Gửi yêu cầu POST sử dụng formData
	        fetch(`${apiBaseURL}/admin/api/club/update.php`, {
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

    }
    function updateStatusBefore(madm, hienthi) {
        var formData = {
            hienthi: hienthi,
            id: madm,
        };

        fetch(`${apiBaseURL}/admin/api/club/updatestatus.php`, {
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
   
    function performDelete(id) {
        var formData = {
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/club/delete.php`, {
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
   
        function openDetail(id) {
            fetch(`${apiBaseURL}/admin/api/club/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('tieude_update').value = data.ten;
                document.getElementById('uutien_update').value = data.uutien;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('tomtat_update').value = data.tomtat;
                document.getElementById('title_update').value = data.title;
                document.getElementById('keywords_update').value = data.keywords;
                document.getElementById('url_update').value = data.url;
                document.getElementById('description_update').value = data.description;
                document.getElementById('hienthianh').src = `uploads/${data.hinhanh}`;

                CKEDITOR.instances.editor2_update.setData(data.mota);
                
                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }



        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/club/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}`, {
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
		    console.log(data);

		    tableBody.innerHTML = '';	  

		    data.data.forEach(item => {
		        var row = tableBody.insertRow();

		        var cell1 = row.insertCell(0);
		        var cell2 = row.insertCell(1);
		        var cell3 = row.insertCell(2);
		        var cell4 = row.insertCell(3);
		        var cell5 = row.insertCell(4);

		        cell1.innerHTML = item.id;
		        cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.ten + '</a>';
		        cell3.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="50px" height="50px"/>';

		        cell4.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell4.style.textAlign="center";

		        cell5.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell5.style.textAlign="center";		       
		    });
		}


        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

