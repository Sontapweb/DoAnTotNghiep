<?php
    include '../lib/session.php';
    Session::checkSession();

?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Trang quản trị</title>
    <?php 
                    include '../classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>
    <link rel="icon" type="image/x-icon" href="uploads/<?php echo $result['logo']?>">
<?php }} ?>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/layout.css?v1.2" media="screen" />
    <!-- BEGIN: load jquery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- END: load jquery -->
    <script src="js/setup.js" type="text/javascript"></script>
    

    <style type="text/css">
      @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

/* Bootstrap Icons */
@import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
td{
    padding: 4px 10px !important;
    font-size: 13px !important;
}
th{
    font-size: 14px !important;
    text-align: center;
    font-weight: 600 !important;
    color: #000 !important;
}
.cke_dialog_container 
{
    z-index: 20000
}
.cke_inner.cke_maximized {
    top: 0px !important;
}
.cke_browser_webkit{
    margin-top: 12px !important;
}
input[type="text"],textarea, select, input[type="file"], input[type="datetime-local"], img{
  margin-top: 8px;
  border-radius: 0 !important;
  border: 1px solid #CCCCCC !important;
}
textarea.form-control {
    min-height: calc(0.9em + 1.3rem + 2px) !important;
}
.form-control{
    padding: 7px 15px !important;
}
label{
    font-size: 15px !important;
    color: #000;
}
.modal-header,.modal-footer{
    border-radius: 0 !important;
}
.modal-content{
    border-radius: 2px;
}
#pagination {
    list-style: none;
    display: flex;
    justify-content: right;
    padding: 10px;
}

#pagination li {
    padding: 2px 8px;
    border: 1px solid #ccc;
    cursor: pointer;
    display: inline-block;
    font-size: 12px;
}

#pagination li:hover {
    background-color: #f2f2f2;
}

#pagination li a {
    text-decoration: none;
    color: #333;
    font-size: 12px;
}

#pagination li.active {
    background-color: #1c84c6;
    color: #fff;
    font-size: 12px;
}

#itemsPerPage{
    padding: 5px 10px;
    border: 1px solid #DDDDDD;
    margin: 10px;
    width: 100%;
}
.col-pageinfo{
    padding: 10px;
}
.col-pageinfo table{
    margin-left: 12px; 
}
.col-pageinfo table,td,th{
    border: 1px solid #e7eaec;
}
#itemCount, #paginationInfo {
    font-size: 14px;    
    color: #333; 
}
.search-container {
    margin: 10px 10px 0 0;
    display: flex;
    justify-content: right;
    align-items: end;
}

/* Style for the search input */
.search-input {
    padding: 5px 10px;
    border: 1px solid #ccc;
    margin: 0 !important;
    width: 100%;
}
.search-input:focus{
    border-color: #4CAF50;
    outline: none;
}

/* Style for the search button */
.search-button {
    padding: 5px 10px;
    background-color: #1c84c6;
    color: white;
    border: 1px solid #1c84c6;
    cursor: pointer;
}
#hienthi-dropdown {
    list-style: none;
    display: flex;
    justify-content: left;
    padding: 10px;
    margin: 0 !important;
}

#hienthi-dropdown li{
    padding: 5px 10px;
    border: 1px solid #DDDDDD;
}

#hienthi-dropdown li.selected {
    background-color: #4CAF50;
    color: white;
}

/* Hiệu ứng hover cho thẻ li */
#hienthi-dropdown li:hover {
    background-color: #ddd;
    cursor: pointer;
}
.card{
    border-radius: 0px !important;
}
.table-responsive{
    padding: 10px;
}
table{
    border: 1px solid #DDDDDD;
}
.nav-link{
    font-size: 15px !important;
}
.nav-link:hover{
    color: #000 !important;
}
#filterDanhmuc,#filterThuonghieu,#filterstatus{
    padding: 7px 10px;
    border: 1px solid #DDDDDD;
    margin-top: 5px;
    width: 100%;
}
.card-header{
    padding: 10px;
}
table a{
    color: #1c84c6;
}
.btn-primary{
    background-color: #1c84c6;
    border-color: #1c84c6;
}
.btn-primary:hover{
    background-color: #1c84c6;
    border-color: #1c84c6;
}

.modal-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.modaladd {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  overflow-y: auto;
  width: 80%;
  max-height: 95%;
  max-width: 1600px;
}

.modal-headerr {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
}

.modal-headerr h2 {
  margin: 0;
}

.modal-bodyy {
  padding: 20px 0;
}
.modal-footerr{
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-top: 1px solid #ccc;
  padding-top: 10px;
}



    </style>
    <body>

    
            
          
    
    