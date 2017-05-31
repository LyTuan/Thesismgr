<?php
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment; FileName=danhsachdt.doc");
?>
        <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ "ThesisMgr | "}}
        {{ $page_title or "" }}

    </title>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">

<!-- @yield('../stylesheets') -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<table style="height: 14px; width: 624px;">
    <tbody>
    <tr style="height: 59px;">
        <td style="width: 317px; height: 59px; text-align: justify;">
            <p style="text-align: center;">ĐẠI HỌC QUỐC GIA HÀ NỘI</p>
            <p style="text-align: center;"><strong>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ </strong></p>
        </td>
        <td style="width: 295px; text-align: justify; height: 59px;">
            <p style="text-align: center;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
            <p style="text-align: center;">Độc lập-Tự do- Hạnh Phúc</p>
        </td>
    </tr>
    </tbody>
</table>
<p>Số :105/QĐ-ĐT </p>
<p style="text-align: right;">Hà nội, ngày 28 tháng 11 năm 2016</p>
<p style="text-align: center;"><strong> QUYẾT ĐỊNH </strong></p>
<p style="text-align: center;"><strong>Về việc duyệt Danh sách cán bộ hướng dẫn khóa luận tốt nghiệp và tên đề tài
        thực hiện của sinh viên khoa Công nghệ Thông tin (bảo vệ đợt 1 năm 2017)</strong></p>
<p style="text-align: center;"><strong>------------------------------------</strong></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong>HIỆU TRƯỞNG</strong></p>
<p style="text-align: center;"><strong>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ</strong></p>
<p style="text-align: center;">Căn cứ Quy định về Tổ chức và Hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội được ban hành theo QUyết định số 3568/QĐ- ĐHQGHN ngày 08/10/2014 của Giám Đốc Đại học Quốc gia Hà Nội.</p>
<p style="text-align: center;">Căn cứ "Quy chế đào tạo đại học ở Đại học Quốc gia Hà Nội" ban hành theo Quyết định số 3079/QĐ-ĐHQGHN ngày 26/10/2010 và được sửa đổi, bổ sung theo Quyết định số 865/QĐ-ĐHQGHN ngày 08/3/2013 của Giám đốc Đại học QUốc gia Hà nội;</p>
<p style="text-align: center;">Căn cứ các Quyết định số 732/QĐ-ĐT ngày 27/09/2016 và số 769/QĐ-ĐT ngày 10/10/2016 của Hiệu trưởng Trường Đại học Công nghệ về việc duyệt điều kiện và danh sách sinh viên thuộc khoa Công nghệ Thông tin làm khóa luận tốt nghiệp(bảo vệ đợt 1 năm 2017).</p>
<p style="text-align: center;">Căn cứ Công văn số 162/CNTT-ĐT ngày 27/10/2016 của Chủ nhiệm khoa Công nghệ Thông tin về việc giao đề tài, cán bộ hướng dẫn khóa luận tốt nghiệp.</p>
<p style="text-align: center;"><strong>Xét đề nghị của Trưởng phòng Đào tạo.</strong></p>
<p style="text-align: center;"><strong>QUYẾT ĐỊNH</strong></p>
<p style="text-align: center;"><strong>Điều 1:&nbsp;</strong>Điều 1: Duyệt danh sách sinh viên, cán bộ hướng dẫn và tên đề tài khóa luận tốt nghiệp cho 243 sinh viên  cho 243 sinh viên đại học hệ chính quy các chương trình đào tạo thuộc khoa Công nghệ Thông tin theo danh sách đính kèm.</p>
<p style="text-align: center;"><strong>Điều 2:</strong> Các cán bộ và sinh viên có tên ở Điều 1 có nhiệm vụ thực hiện và bảo vệ khóa luận tốt nghiệp trong đợt 1 năm 2017 theo đúng Quy chế đào tạo đại học ở Đại học Quốc gia Hà nội và các Quy định hiện hành khác của Trường Đại học Công nghệ.</p>
<p style="text-align: center;"><strong>Điều 3:</strong>Điều 3: Trưởng phòng Hành chính Quản trị, Đào tạo, Chủ nhiệm khoa Công nghệ Thông tin, Thủ trưởng đơn vị có liên quan, các cán bộ và sinh viên có tên ở Điều 1 chịu trách nhiệm thi hành quyết định này.</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p><strong>Nơi nhận: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; HIỆU TRƯỞNG</strong></p>
<p style="text-align: left;"><strong></strong>- Như Điều 3.</p>
<p style="text-align: left;">- Phòng KHTC</p>
<p style="text-align: left;">- Lưu: VT, ĐT, H.5 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Nguyễn Việt Hà</p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;">&nbsp;</p>

<table style="height: 14px; width: 624px;">
    <tbody>
    <tr style="height: 59px;">
        <td style="width: 317px; height: 59px; text-align: justify;">
            <p style="text-align: center;">ĐẠI HỌC QUỐC GIA HÀ NỘI</p>
            <p style="text-align: center;"><strong>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ </strong></p>
        </td>
        <td style="width: 295px; text-align: justify; height: 59px;">
            <p style="text-align: center;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
            <p style="text-align: center;">Độc lập-Tự do- Hạnh Phúc</p>
        </td>
    </tr>
    </tbody>
</table>
<p style="text-align: center;"><strong>DANH SÁCH SINH VIÊN ĐẠI HỌC HỆ CHÍNH QUY CÁC CHƯƠNG TRÌNH ĐÀO TẠO CHUẨN NGÀNH CÔNG NGHỆ  THÔNG TIN

    </strong></p>
<p style="text-align: center;"><strong>BẢO  VỆ KHÓA LUẬN TỐT NGHIỆP  TẠI CÁC HỘI ĐỒNG ĐỢT 2 NĂM 2016</strong></p>
<p style="text-align: center;">(Kèm theo quyết định số:1035/QĐ-ĐT ngày 28/11/2016) 	</p>
<p>Hội đồng công nghệ thông tin:</p>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            {{-- <div class="box-header with-border"> --}}
            {{-- <h3 class="box-title">Danh sách đề tài của sinh viên</h3> --}}
            {{-- </div> --}}
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sinh viên</th>
                        <th>Tên giảng viên hướng dẫn</th>
                        <th>Đề tài</th>
                        {{-- <th>Sửa đề tài</th> --}}
                        {{-- <th>Hủy đăng ký</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    <?php $id=0;?>
                    @foreach($student_array as $student)

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td>{{ $student->name}}</td>
                            <td>{{$instructor_array[$id]->name}}</td>
                            <td>{{$topic_array[$id]->name}}</td>
                            {{-- <td> <a href=""><button type="" class="btn btn-primary">Sửa</button></a> </td> --}}
                            {{-- <td><a href=""><button type="" class="btn btn-danger">Hủy</button></a> </td> --}}
                        </tr>
                        <?php $id++; ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
</body>
</html>
