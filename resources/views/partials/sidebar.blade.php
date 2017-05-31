<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    @if(Auth::user()->isSuperadmin())
                        SuperAdmin
                    @elseif(Auth::user()->isAdmin())
                        {{ Auth::user()->username }}
                    @elseif(Auth::user()->isInstructor())
                        {{ Auth::user()->insstructor->name }}
                    @elseif(Auth::user()->isStudent())
                        {{ Auth::user()->student->name }}
                    @endif
                </p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">CHỨC NĂNG</li>

            @if(Auth::user()->isSuperadmin())
                @include('superadmin.sidebar')
            @elseif(Auth::user()->isAdmin())
                @include('admin.sidebar')
            @elseif(Auth::user()->isInstructor())
                @include('instructor.sidebar')
            @elseif(Auth::user()->isStudent())
                @include('student.sidebar')
            @endif
            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-link"></i> <span>Đăng ký đề tài</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ route('getStudentCanAdd') }}">Sinh viên đủ điều kiện</a></li>--}}
                    {{--<li><a href="{{route('managerRegister')}}">Quản lý đăng ký</a></li>--}}
                    {{--<li><a href="{{route('registerTopic')}}">Đăng ký</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-link"></i> <span>Sửa đổi đề tài</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ route('getStudentCanAdd') }}">Rút đăng ký</a></li>--}}
                    {{--<li><a href="{{route('managerRegister')}}">Thay đổi đề tài</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<!-- RECORD_TOPIC  -->--}}
            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-link"></i> <span>Đăng ký bảo vệ</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{route('managerRecordTopic')}}">Quản lí thời gian đăng ký</a></li>--}}
                    {{--<li><a href="{{route('receiveRecordMark')}}">Tiếp nhận hồ sơ bảo vệ</a></li>--}}
                    {{--<li><a href="{{route('checkValidRecord')}}">Kiểm tra hợp thức và xuất danh sách</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<!-- before  -->--}}
            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-link"></i><span>Bảo vệ và hoàn tất hồ sơ</span>--}}
                    {{--<span class="pull-right-container">--}}
                        {{--<i class="fa fa-angle-left pull-right"></i>--}}
                    {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{route('assignReview')}}">Phân công phản biện</a></li>--}}
                    {{--<li><a href="{{route('makeCouncil')}}">Lập hội đồng</a></li>--}}
                    {{--<li><a href="{{route('exportEnd')}}">Xuất đề nghị hội đồng bảo vệ</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>