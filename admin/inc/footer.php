
</div>
        </main>
    </div>
</div>
</body>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/diacritics"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="ckfinder/ckfinder.js" type="text/javascript"></script>
    <script type="text/javascript">
        CKFinder.setupCKEditor();
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
        CKEDITOR.replace( 'editor1_update' );
        CKEDITOR.replace( 'editor2_update' );        
        $('#myModal').on('shown.bs.modal', function () {
    $(document).off('focusin.modal');
});
    </script>
<script type="text/javascript">
  var apiBaseURL = 'http://localhost/doanhotrosv';
  window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
      if (document.body.scrollTop > 150  || document.documentElement.scrollTop > 150) {
        document.getElementById("add-update").style.position="fixed";
        document.getElementById("add-update").style.top="10px";
        document.getElementById("add-update").style.right="30px";
      } else {
        document.getElementById("add-update").style.position="unset";
      }
    }
    function updateUrl() {
      var tieudeInput = document.getElementById('tieude');
      var urlInput = document.getElementById('url');
      
      var tieudeValue = tieudeInput.value;
      // Loại bỏ dấu và thay thế dấu cách bằng gạch
      var urlValue = removeDiacriticsAndConvert(tieudeValue).toLowerCase().replace(/ /g, '-');
      
      urlInput.value = urlValue;

      var tieudeInputU = document.getElementById('tieude_update');
      var urlInputU = document.getElementById('url_update');
      
      var tieudeValueU = tieudeInputU.value;
      // Loại bỏ dấu và thay thế dấu cách bằng gạch
      var urlValueU = removeDiacriticsAndConvert(tieudeValueU).toLowerCase().replace(/ /g, '-');
      
      urlInputU.value = urlValueU;
    }


    function removeDiacriticsAndConvert(str) {
      return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/đ/g, 'd').replace(/Đ/g, 'D');
    }

    function formatPrice(inputId,outputId) {
      var inputValue = document.getElementById(inputId).value;

      var numericValue = parseFloat(inputValue.replace(/,/g, ''));
      if (isNaN(numericValue)) {
        return;
      }

      var formattedValue = formatNumberWithCommas(numericValue);

      document.getElementById(inputId).value = formattedValue;

      document.getElementById(outputId).value = numericValue;
    }

    function formatNumberWithCommas(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    window.onload = function() {
      formatPrice('giahienthi');
    };


    $(document).ready(function () {
            var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('thoigian').value = now.toISOString().slice(0,16);

        
        });


    function resetForm() {
        var form = document.getElementById("myForm");
        form.reset();
        CKEDITOR.instances.editor1.setData('');
        CKEDITOR.instances.editor2.setData('');
        CKEDITOR.instances.editor3.setData('');
    }

    function resetFormkhac() {
      var form = document.getElementById('formkhac');
      var inputs = form.getElementsByTagName('input');
      var textareas = form.getElementsByTagName('textarea');

      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type !== 'hidden' && inputs[i].id !== 'idvinhvien') {
          inputs[i].value = '';
        }
      }

      for (var j = 0; j < textareas.length; j++) {
        textareas[j].value = '';
      }
      CKEDITOR.instances.editor1.setData('');
      CKEDITOR.instances.editor2.setData('');
      CKEDITOR.instances.editor3.setData('');
    }
    function deleteItem(id) {
        Swal.fire({
            title: 'Xác nhận xóa',
            text: 'Bạn có chắc muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id);
            }
        });
    }
    function updateStatus(id, status) {
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: 'Bạn có chắc muốn đổi trạng thái?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatusBefore(id, status);
            }
        });
    }

    var searchInput = document.getElementById('search');
        var searchButton = document.querySelector('.search-button');

        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                fetchDataByPage();
            }
        });

        searchButton.addEventListener('click', function () {
            fetchDataByPage();
        });

        var currentPage = 1;
        var itemsPerPage = document.getElementById('itemsPerPage').value;
        document.querySelector('#hienthi-dropdown li[value="0"]').classList.add('selected');

        var hienthiDropdown = document.getElementById('hienthi-dropdown');
        var hienthiOptions = hienthiDropdown.getElementsByTagName('li');

        for (var i = 0; i < hienthiOptions.length; i++) {
            hienthiOptions[i].addEventListener('click', function() {
                for (var j = 0; j < hienthiOptions.length; j++) {
                    hienthiOptions[j].classList.remove('selected');
                }
                this.classList.add('selected');
                fetchDataByPage();
            });
        }
        function displayPage(data) {
            var totalPages = Math.ceil(data.total/ itemsPerPage);

            document.getElementById('itemCount').innerHTML = `Tổng: ${data.total}`;
            document.getElementById('paginationInfo').innerHTML = `Page ${currentPage} of ${totalPages}`;

            var paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';

            var firstPageLink = document.createElement('li');
            firstPageLink.textContent = '<<';

            firstPageLink.addEventListener('click', function (event) {
                event.preventDefault();
                currentPage = 1;
                fetchDataByPage();
                updateActivePageStyle();
            });

            paginationContainer.appendChild(firstPageLink);
            paginationContainer.appendChild(document.createTextNode(' '));

            for (var i = 1; i <= totalPages; i++) {
                var pageLink = document.createElement('li');
                pageLink.textContent = i;
                pageLink.addEventListener('click', function (event) {
                    event.preventDefault();
                    currentPage = parseInt(this.textContent);
                    fetchDataByPage();
                    updateActivePageStyle();
                });

                paginationContainer.appendChild(pageLink);
                paginationContainer.appendChild(document.createTextNode(' '));
            }

            var lastPageLink = document.createElement('li');
            lastPageLink.textContent = '>>';

            lastPageLink.addEventListener('click', function (event) {
                event.preventDefault();
                currentPage = totalPages;
                fetchDataByPage();
                updateActivePageStyle();
            });

            paginationContainer.appendChild(document.createTextNode(' '));
            paginationContainer.appendChild(lastPageLink);

            function updateActivePageStyle() {
                var pageLinks = document.querySelectorAll('#pagination li');
                pageLinks.forEach(function (link) {
                    link.classList.remove('active');
                });

                var currentPageLink = document.querySelector(`#pagination li:nth-child(${currentPage + 1})`);
                if (currentPageLink) {
                    currentPageLink.classList.add('active');
                }
            }
            updateActivePageStyle();

        }

        function changeItemsPerPage() {
            var selectedValue = document.getElementById('itemsPerPage').value;
            itemsPerPage = parseInt(selectedValue);
            fetchDataByPage();
        }



function showaddModal(){
    document.getElementById('modalAdd').style.display = 'block';
}
function closeaddModal(){
    document.getElementById('modalAdd').style.display = 'none';
}

function showupdateModal(){
    document.getElementById('modalUpdate').style.display = 'block';
}
function closeupdateModal(){
    document.getElementById('modalUpdate').style.display = 'none';
}

function closecopyModal(){
    document.getElementById('modalCopy').style.display = 'none';
}

    
</script>

</body>
</html>
