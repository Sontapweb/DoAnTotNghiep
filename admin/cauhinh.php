<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(12) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-tools{
        color: #fff !important;
    }
</style>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-6 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Thông tin cấu hình</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-sm-end">
                        </div>
                    </div>
                    <div class="row" style="padding:25px;">
                    	<div class="col-lg-12 text-end">
                    		<div>
					            <button type="button" class="btn btn-primary" onclick="updateItem()">Lưu dữ liệu</button>
					        </div>
                    	</div>
                        <div class="col-lg-12">
                        	<form class="form-group row" enctype="multipart/form-data">
                    
                    <label class="col-sm-2 col-form-label">Logo:</label>
                    <div class="col-sm-4">
                     <img src="" width="70" height="50" id="hienthianh">
                        <input type="file" name="logo" id="logo" />
                    </div>

                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" name="email" id="email" 
                    placeholder="Nhập thông tin">
                    </div>

                    <div style="display:none;">
                    	<input type="text" class="form-control" name="id" id="id" 
                    	placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-2 col-form-label">Tiêu đề:</label>
                    <div class="col-sm-4">
                     <textarea name="tieude" class="form-control" id="tieude" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Hotline:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" name="hotline" id="hotline" 
                    placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-4">
                     <textarea name="mota" class="form-control" id="mota"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Keywords:</label>
                    <div class="col-sm-4">
                     <textarea name="keywords" class="form-control" id="keywords"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Youtube:</label>
                    <div class="col-sm-4">
                     <textarea name="youtube" class="form-control" id="youtube"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Facebook:</label>
                    <div class="col-sm-4">
                     <textarea name="facebook" class="form-control" id="facebook"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Twitter:</label>
                    <div class="col-sm-4">
                     <textarea name="twitter" class="form-control" id="twitter"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Google:</label>
                    <div class="col-sm-4">
                     <textarea name="google" class="form-control" id="google"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Instagram:</label>
                    <div class="col-sm-4">
                     <textarea name="instagram" class="form-control" id="instagram"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Messenger:</label>
                    <div class="col-sm-4">
                     <textarea name="messenger" class="form-control" id="messenger"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Zalo:</label>
                    <div class="col-sm-4">
                     <textarea name="zalo" class="form-control" id="zalo"></textarea>
                    </div>

                    <label class="col-sm-6 col-form-label"></label>

                    <!-- <label class="col-sm-2 col-form-label">GoogleAnalytics:</label>
                    <div class="col-sm-10">
                     <textarea name="googleanalytics" class="form-control" id="googleanalytics"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">WebmasterTool:</label>
                    <div class="col-sm-10">
                     <textarea name="webmastertool" class="form-control" id="webmastertool"></textarea>
                    </div>                                                      -->
                                               
      </form>
                        </div>
                        <div class="col-lg-12 text-end">
                    		<div style="padding-top: 10px;">
					            <button type="button" class="btn btn-primary" onclick="updateItem()">Lưu dữ liệu</button>
					        </div>
                    	</div>
                    </div>
                    
                    
                </div>


<script type="text/javascript">     
    function updateItem() {
	    // Lấy file từ input
	    var hinhanhInput = document.getElementById('logo');
	    var hinhanhFile = hinhanhInput.files[0];

	        var formData = new FormData();
	        formData.append('logo', hinhanhFile);
	        formData.append('tieude', document.getElementById('tieude').value);
	        formData.append('mota', document.getElementById('mota').value);
	        formData.append('keywords', document.getElementById('keywords').value);
	        formData.append('hotline', document.getElementById('hotline').value);
	        formData.append('email', document.getElementById('email').value);
	        formData.append('zalo', document.getElementById('zalo').value);
	        formData.append('youtube', document.getElementById('youtube').value);
	        formData.append('twitter', document.getElementById('twitter').value);
	        formData.append('facebook', document.getElementById('facebook').value);
	        formData.append('instagram', document.getElementById('instagram').value);
	        formData.append('google', document.getElementById('google').value);
	        formData.append('messenger', document.getElementById('messenger').value);
	        formData.append('googleanalytics', document.getElementById('googleanalytics').value);
	        formData.append('webmastertool', document.getElementById('webmastertool').value);
	        formData.append('id', document.getElementById('id').value);

	        // Gửi yêu cầu POST sử dụng formData
	        fetch(`${apiBaseURL}/admin/api/cauhinh/update.php`, {
	            method: 'POST',
	            body: formData,
	        })
	        .then(response => response.json())
	        .then(data => {
	            toastr.success('Thông báo', 'Cập nhật thành công');
	            hinhanhInput.value = null;
	            ShowCauhinh(1);
	        })
	        .catch(error => {
	            console.error('Error:', error);
	        });

    }
       
        function ShowCauhinh(id) {
		    fetch(`${apiBaseURL}/admin/api/cauhinh/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {

                document.getElementById('hienthianh').src = `uploads/${data.logo}`;
                document.getElementById('tieude').value = data.tieude;
                document.getElementById('mota').value = data.mota;
                document.getElementById('keywords').value = data.keywords;
                document.getElementById('hotline').value = data.hotline;
                document.getElementById('email').value = data.email;
                document.getElementById('zalo').value = data.zalo;
                document.getElementById('youtube').value = data.youtube;
                document.getElementById('twitter').value = data.twitter;
                document.getElementById('google').value = data.google;
                document.getElementById('instagram').value = data.instagram;
                document.getElementById('facebook').value = data.facebook;
                document.getElementById('messenger').value = data.messenger;
                document.getElementById('googleanalytics').value = data.googleanalytics;
                document.getElementById('webmastertool').value = data.webmastertool;
                document.getElementById('id').value = data.id;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            ShowCauhinh(1);
        });

   
</script>
<?php include 'inc/footer.php';?>

