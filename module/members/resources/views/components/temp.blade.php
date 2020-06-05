@extends('nqadmin-dashboard::master')

@section('content')

    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Thành viên nhóm</h3>
                    <p>Danh sách thành viên trong nhóm</p>
                </div>
            </div>
            <div class="personal_contain">
                <div class="personal-tree">
                    <div class="undefinedline linefloor1"></div>
                    <div class="undefined_node nodefloor1 level3iconLevel">
                        <a href="#" class="parent-fl parent-1"><i class="img-profile type-cb0 type-icon0"></i></a>
                        <div class="parent-name-1"></div>
                        <p class="node-name">{{$user_online->fullname}}</p>
                        <div id="1B">
                            <div class="topline"></div>
                            <div class="leftline linefloor2"></div>
                            {{--Left f1--}}
                            <div class="left_node nodefloor2 level1iconLevel">
                                <a href="#" class="parent-fl parent-2">
                                    <i class="img-profile type-cb0 type-icon0"></i>
                                </a>
                                <div class="parent-name-1"></div>
                                <p class="node-name">Root 2 left</p>
                                <div id="2B">
                                    <div class="topline"></div>
                                    <div class="leftline linefloor3"></div>
                                    <div class="left_node nodefloor3 level1iconLevel">
                                        <a href="parent-fl parent-3">
                                            <i class="img-profile type-cb0 type-icon0"></i>
                                        </a>
                                        <div class="parent-name-1"></div>
                                        <p class="node-name">Root 3 left</p>
                                    </div>
                                    <div class="rightline linefloor3"></div>
                                    <div class="right_node nodefloor3 level1iconLevel">
                                        <a href="#" class="parent-fl parent-3">
                                            <i class="img-profile type-cb0 type-icon0"></i>
                                        </a>
                                        <div class="parent-name-1"></div>
                                        <p class="node-name">Root 3 Right</p>
                                    </div>
                                </div>
                            </div>
                            {{--right f1--}}
                            <div class="rightline linefloor2"></div>
                            <div class="right_node nodefloor2 level1iconLevel">
                                <a href="#" class="parent-fl parent-2">
                                    <i class="img-profile type-cb0 type-icon0"></i>
                                </a>
                                <div class="parent-name-1"></div>
                                <p class="node-name">Root 2 Right</p>
                                <div id="B3">
                                    <div class="topline"></div>
                                    <div class="leftline linefloor3"></div>
                                    <div class="left_node nodefloor3">
                                        <a class="node-add" href="#">
                                            <i class="img-profile type-cb0 type-addnews"></i>
                                        </a>
                                        <div class="parent-name-1"></div>
                                        <p class="node-name node-name-add">Thêm mới</p>
                                        <div id="-1B"></div>
                                    </div>
                                    <div class="rightline linefloor3"></div>
                                    <div class="right_node nodefloor3 level1iconLevel">
                                        <a href="#" class="parent-fl parent-3">
                                            <i class="img-profile type-cb0 type-icon0"></i>
                                        </a>
                                        <div class="parent-name-1"></div>
                                        <p class="node-name">Root 3 right</p>
                                        <div id="B4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-mem">
                    <ul>
                        <li><a href="#">Lên đầu nhánh</a></li>
                        <li><a href="#">Quay lại 1 cấp</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection