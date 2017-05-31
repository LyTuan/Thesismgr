<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Quản lý</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('getInstructorIndex') }}">Giảng viên</a></li>
        <li><a href="{{ route('getStudentIndex') }}">Sinh viên</a></li>
    </ul>

</li>
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Đăng ký đề tài</span>
        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('getStudentCanAdd') }}">Sinh viên đủ điều kiện</a></li>
        <li><a href="{{route('managerRegister')}}">Quản lý đăng ký</a></li>
        <li><a href="{{route('managerRegister')}}">Xuất đề nghị</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span> Sửa-Hủy đề tài</span>
        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('listRegister') }}">Thay đổi đề tài</a></li>
        <li><a href="{{route('managerRegister')}}">Sửa đề tài</a></li>
    </ul>
</li>


<!-- RECORD_TOPIC  -->
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Đăng ký bảo vệ</span>
        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{route('managerRecordTopic')}}">Quản lí thời gian đăng ký</a></li>
        <li><a href="{{route('receiveRecordMark')}}">Tiếp nhận hồ sơ bảo vệ</a></li>
        <li><a href="{{route('checkValidRecord')}}">Kiểm tra hợp thức và xuất danh sách</a></li>
    </ul>
</li>

<!-- before  -->
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Bảo vệ và hoàn tất hồ sơ</span>
        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                     </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{route('assignReview')}}">Phân công phản biện</a></li>
        <li><a href="{{route('makeCouncil')}}">Lập hội đồng</a></li>
        <li><a href="{{route('exportEnd')}}">Xuất đề nghị hội đồng bảo vệ</a></li>
    </ul>
</li>

