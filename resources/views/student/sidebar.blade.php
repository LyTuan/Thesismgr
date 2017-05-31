<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Duyệt</span>
        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('student.units.index') }}">Theo đơn vị</a></li>
        <li><a href="{{ route('student.scopes.index') }}">Theo lĩnh vực</a></li>
    </ul>

    <a href="{{ route('student.search') }}"><i class="fa fa-link"></i> <span>Tìm kiếm</span></a>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Đăng ký đề tài</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        {{--   <li><a href="{{ route('getStudentCanAdd') }}">Sinh viên đủ điều kiện</a></li>
          <li><a href="{{route('managerRegister')}}">Quản lý đăng ký</a></li> --}}
        <li><a href="{{route('topicRegister')}}">Đăng ký</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Sửa đổi-Hủy đề tài</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('listRegister') }}">Sửa đổi-Hủy đăng ký</a></li>
        {{-- <li><a href="{{route('managerRegister')}}">Thay đổi đề tài</a></li> --}}
    </ul>
</li>

