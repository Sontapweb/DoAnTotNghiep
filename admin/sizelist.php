<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(8) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-folder{
        color: #fff !important;
    }
</style>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Quản lý kích cỡ</h5>
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
                                            <th scope="col" style="width: 30px;">ID</th>
                                            <th scope="col">Tên cỡ</th>
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
      <h2>Thông tin danh mục</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data" id="myForm">

                    <label class="col-sm-2 col-form-label">Dung lượng:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="tieude"  id="tieude" rows="1"></textarea>
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
      <h2>Thông tin danh mục</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">

                    <label class="col-sm-2 col-form-label">Dung lượng:</label>
                    <div class="col-sm-8">
                     <textarea class="form-control" name="tieude_update" id="tieude_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update">
                    </div>
                    
                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="hienthi" id="hienthi_update">
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                        </select>
                        
                    </div>                    

                    <label class="col-sm-6"></label>
                  
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
        var tenkichco = document.getElementById('tieude').value;
        if (!tenkichco) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            tenkichco: tenkichco,
        };

        fetch(`${apiBaseURL}/admin/api/kichco/create.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
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
        var id = document.getElementById('id_update').value;
        var tenkichco = document.getElementById('tieude_update').value;
        if (!tenkichco) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            id: id,
            tenkichco: tenkichco,
            hienthi: document.getElementById('hienthi_update').value,
        };

        fetch(`${apiBaseURL}/admin/api/kichco/update.php`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Cập nhật thành công');
            document.getElementById('modalUpdate').style.display = 'none';
            fetchDataByPage();
        })
        .catch(error => {
            toastr.error('Thông báo', 'Cập nhật thất bại');
        });
    }
    function updateStatusBefore(id, hienthi) {
        var formData = {
            hienthi: hienthi,
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/kichco/updatestatus.php`, {
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

        fetch(`${apiBaseURL}/admin/api/kichco/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/kichco/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('tieude_update').value = data.tenkichco;
                document.getElementById('hienthi_update').value = data.hienthi;

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        

        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/kichco/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}`, {
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

            data.data.forEach(item => {
                var row = tableBody.insertRow();

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);

                cell1.innerHTML = item.id;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.tenkichco + '</a>';
                cell3.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell3.style.textAlign="center";

                cell4.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell4.style.textAlign="center";
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

