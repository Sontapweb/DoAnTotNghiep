<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(9) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-images{
        color: #fff !important;
    }
</style>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Quản lý banner</h3>
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
                                            <th scope="col" style="width: 39px;">Thứ tự</th>
                                            <th scope="col">Tiêu đề</th>
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
      <h2>Thông tin banner</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">
                    <label class="col-sm-2 col-form-label">Tiêu đề:</label>
                    <div class="col-sm-10">
                     <input type="text" class="form-control" name="ten" id="ten" 
                    placeholder="Nhập thông tin">
                    </div>  

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-10">
                    <input type="file" name="hinhanh" id="hinhanh" />
                    </div>
                   

                    <label class="col-sm-2 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" name="uutien" id="uutien" 
                    placeholder="Nhập thông tin">
                    </div> 
                    <label class="col-sm-2 col-form-label">Trạng thái:</label>
                        <div class="col-sm-4">
                    <select class="form-control" name="status" id="status">
                        <option value="0" >Hiển thị</option>
                        <option value="1">Ẩn</option>
                    </select>
                    </div> 

                    <label class="col-sm-2 col-form-label">Link xem thêm:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="xemthem" id="xemthem"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Nội dung:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="noidung" rows="5" cols="80" id="noidung"></textarea>
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
      <h2>Thông tin banner</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">
                    <label class="col-sm-2 col-form-label">Tiêu đề:</label>
                    <div class="col-sm-10">
                     <input type="text" class="form-control" name="ten" id="ten_update" 
                    placeholder="Nhập thông tin">
                    </div>    

                    <div style="display:none;">
                        <input type="text" class="form-control" name="id" id="id_update" 
                        placeholder="Nhập thông tin">
                    </div>               

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-10">
                     <img src="" width="250px" height="90px" id="hienthianh_update">
                        <input type="file" name="hinhanh" id="hinhanh_update" />
                    </div>
                    

                    <label class="col-sm-2 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" name="uutien" id="uutien_update" 
                    placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-2 col-form-label">Trạng thái:</label>
                        <div class="col-sm-4">
                    <select class="form-control" name="status" id="status_update">
                        <option>Trạng thái</option>
                            <option value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                    </select>
                    </div>

                    <label class="col-sm-2 col-form-label">Link xem thêm:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="xemthem" id="xemthem_update"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Nội dung:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="noidung" rows="5" cols="80" id="noidung_update"></textarea>
                    </div>
                                               
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
        var uutien = document.getElementById('uutien').value;
        if (!uutien) {
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
            formData.append('ten', document.getElementById('ten').value);
            formData.append('noidung', document.getElementById('noidung').value);
            formData.append('xemthem', document.getElementById('xemthem').value);
            formData.append('uutien', uutien);
            formData.append('status', document.getElementById('status').value);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/slider/create.php`, {
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
        var uutien = document.getElementById('uutien_update').value;
        if (!uutien) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh_update');
        var hinhanhFile = hinhanhInput.files[0];

            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('ten', document.getElementById('ten_update').value);
            formData.append('noidung', document.getElementById('noidung_update').value);
            formData.append('xemthem', document.getElementById('xemthem_update').value);
            formData.append('uutien', uutien);
            formData.append('status', document.getElementById('status_update').value);
            formData.append('id', document.getElementById('id_update').value);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/slider/update.php`, {
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

   
    function performDelete(id) {
        var formData = {
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/slider/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/slider/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('ten_update').value = data.ten;
                document.getElementById('status_update').value = data.status;
                document.getElementById('uutien_update').value = data.uutien;
                document.getElementById('noidung_update').value = data.noidung;
                document.getElementById('xemthem_update').value = data.xemthem;
                document.getElementById('hienthianh_update').src = `uploads/${data.hinhanh}`;
                
                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/slider/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&status=${selectedHienthi}&search=${searchInput}`, {
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

                cell1.innerHTML = item.uutien;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.ten + '</a>';
                cell3.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="150px" height="70px"/>';

                // Thêm cell6 với giá trị dựa trên item.hienthi
                cell4.innerHTML = item.status == '0' ? '<span class="badge badge-lg badge-dot">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell4.style.textAlign="center";

                cell5.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';  
                cell5.style.textAlign="center";             
            });
        }


        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
            populateDanhmucSelect();
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

