{{--<div class="footer">--}}
	{{--@include('masterGlobal.modalGlobal')--}}
    {{--<div class="footer-inner">--}}
        {{--<div class="footer-content">--}}
						{{--<span class="bigger-120">--}}
							{{--<span class="blue bolder">{{ Session::get('orgName') }}</span>--}}
							{{--Application &copy; 2018--}}
						{{--</span>--}}

            {{--&nbsp; &nbsp;--}}
            {{--<span class="action-buttons">--}}
							{{--<a href="#">--}}
								{{--<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>--}}
							{{--</a>--}}

							{{--<a href="#">--}}
								{{--<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>--}}
							{{--</a>--}}

							{{--<a href="#">--}}
								{{--<i class="ace-icon fa fa-rss-square orange bigger-150"></i>--}}
							{{--</a>--}}
						{{--</span>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">--}}
    {{--<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>--}}
{{--</a>--}}

<div class="footer">
	@include('masterGlobal.modalGlobal')
	<div class="footer-inner">
		<div class="footer-content">
			<div style="float:left; width:350px;">Copyright &copy; 2019 SALT, All Rights Reserved.</div>
			<div style="float:right; width:300px;">Design & Developed By <a target="_blank" href="{{ url('http://www.atilimited.net') }}"><span style="color:red;">ATI</span> <span style="color: green;">Limited</span></a></div>&nbsp;
		</div>
	</div>
</div>
