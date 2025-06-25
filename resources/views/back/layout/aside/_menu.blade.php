<div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
    data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">

    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
        id="#kt_aside_menu" data-kt-menu="true">

        <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-element-11 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i></span>
                <span class="menu-title">Dashboards</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link @if (request()->routeIs('back.dashboard')) active @endif"
                        href="{{ route('back.dashboard') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Default</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->routeIs('back.dashboard.news')) active @endif"
                        href="{{ route('back.dashboard.news') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Berita</span>
                    </a>
                </div>
            </div>
        </div>

        @role('humas|pengurus')
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Post</span>
                </div>
            </div>


            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if (request()->routeIs('back.news.*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-document fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Blog</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.news.category')) active @endif"
                            href="{{ route('back.news.category') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Kategori</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.news.index')) active @endif"
                            href="{{ route('back.news.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Blog</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.news.comment')) active @endif"
                            href="{{ route('back.news.comment') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Komentar</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.partner-link.index')) active @endif"
                    href="{{ route('back.partner-link.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-fasten fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Partner Link</span>
                </a>
            </div>
        @endrole

        @role('humas|pengurus')
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Dakwah & Khutbah</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.ustadz.index')) active @endif"
                    href="{{ route('back.ustadz.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-fasten fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Data Ustadz</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.jumat-time.index')) active @endif"
                    href="{{ route('back.jumat-time.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-fasten fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Waktu Jum'at</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.kajian-time.index')) active @endif"
                    href="{{ route('back.kajian-time.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-fasten fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">waktu Kajian</span>
                </a>
            </div>
        @endrole

        @role('humas|pengurus')
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Keuangan</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.finance.index')) active @endif"
                    href="{{ route('back.finance.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-fasten fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Keuangan</span>
                </a>
            </div>
        @endrole



        @role('pengurus')
            <div class="menu-item pt-5">
                <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Administrator</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.message.index')) active @endif"
                    href="{{ route('back.message.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-sms fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Inbox</span>
                </a>
            </div>

            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if (request()->routeIs('back.whatsapp.*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-setting-4 fs-2"></i>
                    </span>
                    <span class="menu-title">Whatsapp API</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.whatsapp.setting')) active @endif"
                            href="{{ route('back.whatsapp.setting') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pengaturan</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.whatsapp.message')) active @endif"
                            href="{{ route('back.whatsapp.message') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Kirim Pesan</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.user.*')) active @endif"
                    href="{{ route('back.user.index') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-profile-user fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Pengurus & Jamaah</span>
                </a>
            </div>


            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if (request()->routeIs('back.setting.*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-setting-2 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Pengaturan</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.setting.website')) active @endif"
                            href="{{ route('back.setting.website') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Website</span>
                        </a>
                    </div>

                </div>
            </div>
        @endrole

    </div>

</div>
