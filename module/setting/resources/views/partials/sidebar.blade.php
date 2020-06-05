@inject('contactRepository', 'Contact\Repositories\ContactRepository')

@php
    $listRoute = [
        'nqadmin::setting.site.get'
    ];

    $faqRoute = [
        'nqadmin::faqs.list.get',
    ];

    $contactRoute = [
        'nqadmin::contact.index.get', 'nqadmin::contact.detail.get'
    ];

    $testimonialRoute = [
        'nqadmin::testimonial.index.get', 'nqadmin::testimonial.create.get', 'nqadmin::testimonial.edit.get'
    ];

    $partnerRoute = [
        'nqadmin::partner.index.get', 'nqadmin::partner.create.get', 'nqadmin::partner.edit.get'
    ];

    $pricingRoute = [
        'nqadmin::pricing.index.get', 'nqadmin::pricing.create.get', 'nqadmin::pricing.edit.get'
    ];

    $unread = $contactRepository->countUnread()

@endphp

<li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">
    <i class="fa fa-cog"></i> Cấu hình <i class="fa fa-angle-down "></i></a>
    <ul class="nav flex-column nav-second-level">
        <li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::setting.site.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
                <i class="fa fa-cog" aria-hidden="true"></i> Cấu hình website
            </a>
        </li>

        <li class="nav-item {{in_array(Route::currentRouteName(), $contactRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::contact.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $contactRoute) ? 'active' : '' }}">
                <i class="fa fa-envelope-o" aria-hidden="true"></i> Liên hệ <span class="badge badge-danger ml-2">{{$unread}}</span>
            </a>
        </li>


        <li class="nav-item {{in_array(Route::currentRouteName(), $partnerRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::partner.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $partnerRoute) ? 'active' : '' }}">
                <i class="fa fa-users" aria-hidden="true"></i> Đối tác
            </a>
        </li>

    </ul>
    <!-- /.nav-second-level -->
</li>