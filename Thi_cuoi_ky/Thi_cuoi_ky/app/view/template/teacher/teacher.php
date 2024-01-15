<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="web/css/table_style.css">
<?php
$departments = array(
    "001" => "Khoa học máy tính",
    "002" => "Khoa học dữ liệu",
    "003" => "Hải dương học");

?>
<div class="container">
        <!-- Search form -->
        <div class="col-12">
            <div class="search-form">
                <form>

                    <!-- Bộ môn -->
                    <div class="form-group">
                        <div class="department"><label for="department">Bộ môn</label></div>
                        <select id="department" name="department" class="department-select">
                            <option value=""></option>
                            <?php
                            foreach ($departments as $key => $value) {
                                echo "<option value=\"$key\">$value</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Từ khoá -->
                    <div class="form-group">
                        <div class="keyword"><label for="keyword">Từ khoá</label></div>
                        <input class="keyword-input" type="text" id="keyword" name="keyword">
                    </div>

                    <!--  Search Button  -->
                    <div class="search-button">
                        <button type="submit">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Teacher Information -->
        <div class="col-12">
            <!-- Result count  -->
            <div class="page-title">Số giáo viên viên tìm thấy: xxx </div>
            <table class="table" style="width: 800px">
                <thead style="text-align: center;">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tên giáo viên</th>
                    <th width="20%">Bộ môn</th>
                    <th width="30%">Mô tả chi tiết</th>
                    <th width="25%">Action</th>
                </tr>
                </thead>
                <!-- Danh sách teacher trong Database -->
                <tbody id="tbody">
                <?php foreach ($data['teachers'] as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $departments[$value->specialized]; ?></td>
                        <td><?php echo $value->description; ?></td>
                        <td>
                            <button class="delete-button" onclick="openPopup()" data-id="<?= $value->id; ?>" data-name="<?=  $value->name; ?>" >Xóa</button>
                            <form action = "teacher/teacher_adjust" method="POST" id="teacher_form_<?php echo $value->id; ?>" style="display: None;">
                                <input type="text" name="id" value="<?php echo $value->id; ?>">
                            </form>
                            
                            <button class="update-button" onclick="$('#teacher_form_'+<?php echo $value->id; ?>).submit()">Sửa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>

    <!-- Popup -->
    <div id="popup" style="display:none">
        <div class="popup-content">
            <!--  Bạn chắc chắn muón xóa giáo viên + {Tên giáo viên} -->
            <p id="teacher-name"></p>
            <button id="cancel" class="action-button" onclick="closePopup()">Hủy</button>
            <button id="delete" class="action-button">Xóa</button>
        </div>
    </div>


    <script>
    // Open popup function
    function openPopup() {
        let btn = event.target;
        let teacherID = btn.dataset.id;
        let teacherName = btn.dataset.name;
        document.getElementById("teacher-name").textContent = "Bạn chắc chắn muốn xóa giáo viên " + teacherName + "?";
        document.getElementById("popup").style.display = "block";

        // Xoá sinh viên với ID
        $('#delete').click(function(){

            $.ajax({
                url: 'teacher/teacher_delete',
                type: 'POST',
                data: {id: teacherID}
            })
                .done(function(response){
                        closePopup();
                        // Load lại trang sau 1 giây
                        setTimeout(function()
                        { location.reload();
                         }, 1000);
                })

        })
    }
    // Close popup function
    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }
</script>

<!-- Popup Style -->
<style>
    /* Popup styles */
    #popup {
        position: fixed;
        top: 50%;
        left: 50%;
        width: 400px;
        height: 150px;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 2px solid rgb(5 84 149);
    }

    #popup .popup-content button {
        float: right;
        padding: 12px 5px;
        margin-left: 5px;
    }

</style>

<!-- Script update_table_body -->
<script>
// // Gửi yêu cầu Ajax khi department thay đổi
// document.getElementById('department').addEventListener('change', updateTableBody);
// // Gửi yêu cầu Ajax khi keyword thay đổi
// document.getElementById('keyword').addEventListener('input', updateTableBody);

const form = document.querySelector('form');

form.addEventListener('submit', e => {
    e.preventDefault();
    updateTableBody();
});

function updateTableBody() {
  var department = document.getElementById('department').value;
  var keyword = document.getElementById('keyword').value;

  // Gửi yêu cầu Ajax để cập nhật nội dung của tbody
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var newTbodyHTML = xhr.responseText;
      document.getElementById('tbody').innerHTML = newTbodyHTML;
    }
  };
  var url = 'teacher/search_teacher?department=' + encodeURIComponent(department) + '&keyword=' + encodeURIComponent(keyword);
  xhr.open('GET', url, true);
  xhr.send();
}
</script>