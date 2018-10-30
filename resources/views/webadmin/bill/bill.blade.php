@extends('webadmin.Layout.Layout')
@section('title')
	Quản Lý Hóa Đơn
@endsection
@section('css')
			<link rel="stylesheet" href="/css/bootstrap.min.css" />

			<!-- page specific plugin styles -->
			<link rel="stylesheet" href="/css/jquery-ui.min.css" />
			<link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css" />
			<!--Tablelink-->

			<!-- MetisMenu CSS -->
			<link href="\bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

			<!-- Custom CSS -->
			<link href="\dist\css\sb-admin-2.css" rel="stylesheet">

			<!-- Custom Fonts -->
			<link href="\bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

			<!-- DataTables CSS -->
			<link href="\bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

			<!-- DataTables Responsive CSS -->
			<link href="\bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
			<!-- text fonts -->
			<link rel="stylesheet" href="/css/fonts.googleapis.com.css" />

			<!-- ace styles -->
			<link rel="stylesheet" href="/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

			<!--[if lte IE 9]>
			<link rel="stylesheet" href="/css/ace-part2.min.css" class="ace-main-stylesheet" />
			<![endif]-->
			<link rel="stylesheet" href="/css/ace-skins.min.css" />
			<link rel="stylesheet" href="/css/ace-rtl.min.css" />

			<!--[if lte IE 9]>
			<link rel="stylesheet" href="/css/ace-ie.min.css" />
			<![endif]-->

			<!-- inline styles related to this page -->

			<!-- ace settings handler -->
			<script src="/js/ace-extra.min.js"></script>

			<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
	<style>
		#select1
		{
			display: none;
		}
		#Save
		{
			display: none;
		}
		#Cancel
		{
			display: none;
		}
	</style>
@endsection
@section('pathofpage')

    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Trang Chủ</a>
            </li>

            <li>
                <a href="#">Quản Lý</a>
            </li>
            <li class="active">Quản lý hóa đơn </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection
@section('contentname')
    <div class="page-header">

        <h1>
            Quản lý hóa đơn
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Bảng quản lý hóa đơn
            </small>
            <!-- /.nav-search -->
        </h1>
    </div>
@endsection
@section('Content')
                <!-- /.col-lg-12 -->
				@if(session('Thongbao'))
					<div class="alert alert-success">
                        {{session('Thongbao')}} </br>
                    </div>
				@endif
			<table class="table table-striped table-bordered table-hover"  id="dataTables-example">
				<thead>
				<tr align="center">
					<th>ID</th>
					<th>Tên sách</th>
					<th>Người mua</th>
					<th width="50px">Số lượng mua</th>
					<th>Tổng tiền</th>
					<th width="50px">Giảm giá</th>
					<th>Thành tiền</th>
					<th>Trạng thái</th>
					<th width="50px;">Delete</th>
					<th width="110px;">Edit</th>
				</tr>
				</thead>
				<tbody>
				@foreach($Bills as $bl)
				<tr class="odd gradeX" align="center ">
					<td>{{$bl->bill_id}}</td>
					<td>{{$bl->book_name}}</td>
					<td>{{$bl->member_name}}</td>
					<td>{{$bl->bill_count}}</td>
					<td>{{$bl->bill_price}}</td>
					<td>{{$bl->bill_sale}}</td>
					<td>{{$bl->bill_tprice}}</td>
					<td>
                        @if($bl->bill_status == "Chưa hoàn thành")
						<span class="status{{$bl->bill_id}}" style="color: red">{{$bl->bill_status}}</span>
						@elseif($bl->bill_status == "Hủy Đơn")
							<span class="status{{$bl->bill_id}}">{{$bl->bill_status}}</span>
						@else
							<span class="status{{$bl->bill_id}}" style="color: green">{{$bl->bill_status}}</span>
						@endif
						<form action="/admin/dashboard/billmanager/updatebill/{{$bl->bill_id}}" method="POST">
							{{csrf_field()}}
							<div class="form-group">
								<select class="form-control form-control-lg" name="slcbill_status" id="select1{{$bl->bill_id}}" style="display: none">
									<option value="Chưa hoàn thành"> Chưa hoàn thành</option>
									<option value="Hoàn thành"> Hoàn thành</option>
							    	<option value="Hủy Đơn"> Hủy Đơn</option>
								</select>
							</div>

					<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="/admin/dashboard/billmanager/deletebill/{{$bl->bill_id}}" > Delete</a></td>
					<td class="center"><i class="fa fa-pencil fa-fw" id="icon1{{$bl->bill_id}}"></i> <a href="#" id="{{$bl->bill_id}}" class="Edit_r">Edit</a>
						<button type="submit" id="Save{{$bl->bill_id}}" class="btn btn-link" style="color: #337ab7; margin-top: -5px; font-size: 13px; display: none" >Save</button>
						<button type="button" id="Cancel{{$bl->bill_id}}" class="btn btn-link " style="color: #337ab7; margin-top: -5px; font-size: 13px ;display: none">Cancel</button>
					</td>
						</form>
					</td>

				</tr>
				@endforeach
				</tbody>
			</table>
@endsection
@section('Script')
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
	<script src="/js/bootstrap.min.js"></script>

	<!-- page specific plugin scripts -->
	<script src="/js/bootstrap-datepicker.min.js"></script>
	<script src="/js/jquery.jqGrid.min.js"></script>
	<script src="/js/grid.locale-en.js"></script>

	<!-- ace scripts -->
	<script src="/js/ace-elements.min.js"></script>
	<script src="/js/ace.min.js"></script>
	<script src="/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="/dist/js/sb-admin-2.js"></script>

	<!-- DataTables JavaScript -->
	<script src="/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
	<script src="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        $(document).ready(function() {
            var id ;
			$(".Edit_r").on("click",function () {
			    id =$(this).attr('id');
				$("#select1"+id).show();
				$(".status"+id).hide();
				$("#Save"+id).show();
				$("#Cancel"+id).show();
				$("#icon1"+id).hide();
				$(this).hide();
                $("#Cancel"+id).on("click",function () {
                    $("#select1"+id).hide();
                    $(".status"+id).show();
                    $("#Save"+id).hide();
                    $("#Cancel"+id).hide();
                    $("#icon1"+id).show();
                    $("#"+id).show();
                });
            });

        });
	</script>

@endsection