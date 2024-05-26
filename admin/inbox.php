<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
$ct = new cart();
if(isset($_GET['shiftid']) ){
   $id = $_GET['shiftid'];
   $time = $_GET['time'];
   $price = $_GET['price'];
   $shifted = $ct->shifted($id,$time,$price);
   
}
if(isset($_GET['confirmid']) ){
   $id = $_GET['confirmid'];
   $time = $_GET['time'];
   $price = $_GET['price'];
   $confirm_admin = $ct->confirm_admin($id,$time,$price);
   
}

if(isset($_GET['delid']) ){
   $id = $_GET['delid'];
   $time = $_GET['time'];
   $price = $_GET['price'];
   $delete = $ct->complete_dathang($id,$time,$price);
   
}

if(isset($_GET['xoa']) ){
   $id = $_GET['xoa'];
   $time = $_GET['time'];
   $price = $_GET['price'];
   $delete = $ct->delete_dathang($id,$time,$price);
   
}


     
    
?>

<style type="text/css">
    .nav1 .nav-item:nth-child(10) .nav-link{
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
                                <h3 class="mb-0">Quản lý đơn hàng</h3>
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
                            	<option value="0">Đang xử lý</option>
                            	<option value="1">Đang vận chuyển</option>
                            	<option value="2">Đã nhận hàng</option>
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
                                            <th scope="col">Thứ tự</th>
                                            <th scope="col">Thời gian</th>
                                            <th scope="col">Mã sản phẩm</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Màu sắc</th>
                                            <th scope="col">Kích cỡ</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Họ tên</th>
                                            <th scope="col">SĐT</th>
                                            <th scope="col">Địa chỉ</th>
                                            <th scope="col">Hành động</th>
                                            <th scope="col">Hủy đơn</th>  
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
                        <div class="col-lg-12">
                            <form action="dsdh.php" method="post">
                                <input type="datetime-local" class="form-control" name="from">
                                <input type="datetime-local" class="form-control" name="to">
                                <select name="status" class="form-control">
                                    <option value="0">Đang xử lý</option>
                                    <option value="1">Đang vận chuyển</option>
                                    <option value="2">Đã nhận hàng</option>
                                </select>
                                <button type="submit" name="export_excel">Lấy</button>
                            </form>
                        </div>
                    </div>
                    
                    
                </div>

<script type="text/javascript">  
    function updateStatusBefore(orderid, trangthai) {
        var formData = {
            trangthai: trangthai,
            orderid: orderid,
        };

        fetch(`${apiBaseURL}/admin/api/donhang/update.php`, {
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

        fetch(`${apiBaseURL}/admin/api/donhang/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/donhang/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&search=${searchInput}&filterstatus=${filterstatus}`, {
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
                var cell10 = row.insertCell(9);
                var cell11 = row.insertCell(10);
                var cell12 = row.insertCell(11);
                var cell13 = row.insertCell(12);

                cell1.innerHTML = i;
                cell2.innerHTML = item.ngaydathang;
                cell3.innerHTML = item.masp;
                cell4.innerHTML = item.tensp;
                cell5.innerHTML = item.tenmau;
                cell6.innerHTML = item.tenkichco;
                cell7.innerHTML = item.soluong;
                cell8.innerHTML = item.gia;
                cell9.innerHTML = item.hoten;
                cell10.innerHTML = item.sdt;
                cell11.innerHTML = item.diachi;

                cell12.innerHTML = item.trangthai == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.orderid + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đang xử lý' +
                    '</span>' : (item.trangthai == '1' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.orderid + '\', 2)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Đang vận chuyển' +
                    '</span>' : '<span class="badge badge-lg badge-dot">' +
                        '<i class="bg-info"></i>Đã nhận hàng' +
                    '</span>');

                    cell12.style.textAlign="center";

                cell13.innerHTML = '<button onclick="deleteItem(\'' + item.orderid + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell13.style.textAlign="center";
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
