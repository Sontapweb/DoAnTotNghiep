<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(4) .nav-link{
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
                                <h3 class="mb-0">Quản lý DM tin tức</h5>
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
                                            <th scope="col" style="width: 30px;">Mã</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">URL</th>
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

                    <label class="col-sm-2 col-form-label">Tên danh mục:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" name="tendm"  id="tieude" onkeyup="updateUrl()" rows="1"></textarea>
                    </div>
                    
                    <label class="col-sm-2 col-form-label">Vị trí:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" name="uutien" id="uutien" 
                    value="0">
                    </div>    

                    <div class="col-lg-2"></div>                   

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

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Mô Tả:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="description" id="description"></textarea>
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

                    <label class="col-sm-2 col-form-label">Tên danh mục:</label>
                    <div class="col-sm-4">
                     <textarea class="form-control" name="tendm" id="tieude_update" onkeyup="updateUrl()" rows="1"></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="madm_update">
                    </div>

                    <label class="col-sm-2 col-form-label">Vị trí:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" name="uutien" id="uutien_update">
                    </div>

                    <div class="col-lg-2"></div>
                    
                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="hienthi" id="hienthi_update">
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                        </select>
                        
                    </div>                    

                    <label class="col-sm-6"></label>

                    <label class="col-sm-2 col-form-label title">Tiêu Đề:</label>
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

                    <label class="col-sm-2 col-form-label">Mô Tả:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="description" id="description_update"></textarea>
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
        var tendm = document.getElementById('tieude').value;
        var url = document.getElementById('url').value;
        if (!tendm || !url) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            tendm: tendm,
            uutien: document.getElementById('uutien').value,
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            url: url,
            keywords: document.getElementById('keywords').value,
        };

        fetch(`${apiBaseURL}/admin/api/danhmuctintuc/create.php`, {
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
        var madm = document.getElementById('madm_update').value;
        var tendm = document.getElementById('tieude_update').value;
        var url = document.getElementById('url_update').value;
        if (!tendm || !url) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            madm: madm,
            tendm: tendm,
            hienthi: document.getElementById('hienthi_update').value,
            uutien: document.getElementById('uutien_update').value,
            title: document.getElementById('title_update').value,
            description: document.getElementById('description_update').value,
            url: url,
            keywords: document.getElementById('keywords_update').value,
        };

        fetch(`${apiBaseURL}/admin/api/danhmuctintuc/update.php`, {
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
    function updateStatusBefore(madm, hienthi) {
        var formData = {
            hienthi: hienthi,
            madm: madm,
        };

        fetch(`${apiBaseURL}/admin/api/danhmuc/updatestatus.php`, {
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
   
    function performDelete(madm) {
        var formData = {
            madm: madm,
        };

        fetch(`${apiBaseURL}/admin/api/danhmuc/delete.php`, {
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
   
        function openDetail(madm) {
            fetch(`${apiBaseURL}/admin/api/danhmuc/show.php?id=` + madm, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('madm_update').value = data.madm;
                document.getElementById('tieude_update').value = data.tendm;
                document.getElementById('uutien_update').value = data.uutien;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('title_update').value = data.title;
                document.getElementById('keywords_update').value = data.keywords;
                document.getElementById('url_update').value = data.url;
                document.getElementById('description_update').value = data.description;

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        

        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/danhmuctintuc/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}`, {
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
                var cell5 = row.insertCell(4);

                cell1.innerHTML = item.madm;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.madm + '\')">' + item.tendm + '</a>';
                cell3.innerHTML = item.url;
                cell4.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.madm + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.madm + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell4.style.textAlign="center";

                cell5.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.madm + '\')">Xem</button><button onclick="deleteItem(\'' + item.madm + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
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

