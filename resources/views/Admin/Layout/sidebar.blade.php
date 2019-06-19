<!-- sidebar start -->
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('amazeui/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>VANFUN</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_sections">
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-edit"></i>广告位管理<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.banner.list')}}">广告位列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-edit"></i>课程管理<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.course.list')}}">课程列表</a></li>
                        </ul>
                    </li>

                    <!--<li>
                        <a><i class="fa fa-edit"></i>行业方案 <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/polang/index.php?s=/Admin/Type/index.html">行业分类</a></li>
                            <li><a href="/polang/index.php?s=/Admin/News/index.html">方案列表</a></li>
                        </ul>
                    </li>
                    <div class="main_menu_side hidden-print main_menu">
                        <ul class="nav side-menu">
                            <li><a href="/polang/index.php?s=/Admin/Productlist/showClassify.html"><i class="fa fa-clone"></i>服务专区<span class="fa fa-gg"></span></a></li>
                        </ul>
                    </div>



                    <li>
                        <a><i class="fa fa-edit"></i> 客户案例  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/polang/index.php?s=/Admin/Hlist/showClassify.html">案例分类</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Help/showClassify.html">客户案例</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-edit"></i> 为什么选择Vanfun <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/polang/index.php?s=/Admin/Aptitude/index.html">为什么选择Vanfun</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Abouts/index.html">个性化</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Recruit/index.html">关于我们</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-edit"></i>企业资讯  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" >
                            <li><a href="/polang/index.php?s=/Admin/Typedsj/index.html">行业类别</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Memorabilia/index.html">动态列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-edit"></i>联系我们  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/polang/index.php?s=/Admin/Join/index.html">加入我们</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Contacts/index.html">联系我们</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Message/index.html">代理商部门</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-edit"></i>广告管理 <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/polang/index.php?s=/Admin/Banner/index.html">首页Banner</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Nbanner/index.html">内页banner</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Abanner/index.html">首页广告</a></li>
                            <li><a href="/polang/index.php?s=/Admin/Wbanner/index.html">移动端banner</a></li>
                        </ul>
                    </li>-->

                </ul>
            </div>

        </div>
        <div class="main_menu_side hidden-print main_menu">
            <ul class="nav side-menu">
                <!--<li><a href="/polang/index.php?s=/Admin/Titles/index.html"><i class="fa fa-clone"></i>title标签<span class="fa fa-gg"></span></a></li>-->
                <li><a  href="{{route('admin.admin.list')}}"><i class="fa fa-home"></i>管理员<span class="fa fa-gg"></span></a></li>
            </ul>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>
<!-- sidebar end -->