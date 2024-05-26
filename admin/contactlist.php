<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(11) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-chat{
        color: #fff !important;
    }
</style>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Quản lý liên hệ</h3>
                            </div>
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
                        <div class="col-lg-6"></div>
                        <div class="col-lg-2" style="padding: 4px 0 0 0;">                           
                            <select id="filterstatus" onchange="changeStatusFilter()">
                            	<option value="0">Chưa xử lý</option>
                            	<option value="1">Đã xử lý</option>
                            </select>
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
                                            <th scope="col">Tên</th>
                                            <th scope="col">SĐT</th>
                                            <th scope="col">Nội dung</th>
                                            <th scope="col">Thời gian</th>
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

<script type="text/javascript">  
    function updateStatusBefore(id, status) {
        var formData = {
            status: status,
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/lienhe/update.php`, {
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

        fetch(`${apiBaseURL}/admin/api/lienhe/delete.php`, {
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

        

        function changeStatusFilter() {
            filterstatus = document.getElementById('filterstatus').value;
            fetchDataByPage();
        }

        function fetchDataByPage() {
            var searchInput = document.getElementById('search').value;
            var filterstatus = document.getElementById('filterstatus').value;
            fetch(`${apiBaseURL}/admin/api/lienhe/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&search=${searchInput}&filterstatus=${filterstatus}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                displayDataInTable(data);
                displayPage(data);
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
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);

                cell1.innerHTML = item.id;
                cell2.innerHTML = item.ten;
                cell3.innerHTML = item.sdt;
                cell4.innerHTML = item.chude;
                cell5.innerHTML = item.thoigian;

                // Thêm cell6 với giá trị dựa trên item.hienthi
                cell6.innerHTML = item.status == '1' ? '<span class="badge badge-lg badge-dot">' +
                        '<i class="bg-success"></i>Đã xử lý' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Chưa xử lý' +
                    '</span>';
                    cell5.style.textAlign="center";

                cell7.innerHTML = '<button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell7.style.textAlign="center";
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

