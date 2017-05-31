<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Quản lý</span>
        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('getFacultyManage') }}">Danh mục khoa</a></li>
        <li><a href="{{ route('getUnitManage') }}">Danh mục đơn vị</a></li>
        <li><a href="{{ route('getAdminManage') }}">Danh sách quản trị viên</a></li>
        <li><a href="{{ route('superadmin.course') }}">Danh sách khóa học</a></li>
        <li><a href="{{ route('superadmin.branch') }}">Danh sách ngành học</a></li>
    </ul>
</li>