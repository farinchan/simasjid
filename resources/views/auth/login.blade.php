@extends('auth.layout')
@section('content')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                        action="{{ route("login.post") }}" method="POST">
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Login</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Masuk Dengan Akun Kamu</div>
                        </div>
                        {{-- <div class="row g-3 mb-9">
                            <div class="col-md-6">
                                <a href="#"
                                    class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                    <img alt="Logo" src="{{ asset("back/media/svg/brand-logos/google-icon.svg") }}"
                                        class="h-15px me-3" />Sign in with Google</a>
                            </div>
                            <div class="col-md-6">
                                <a href="#"
                                    class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                    <img alt="Logo" src="{{ asset("back/") }}media/svg/brand-logos/apple-black.svg"
                                        class="theme-light-show h-15px me-3" />
                                    <img alt="Logo" src="{{ asset("back/media/svg/brand-logos/apple-black-dark.svg") }}"
                                        class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
                            </div>
                        </div>
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                        </div> --}}
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Email" name="email" autocomplete="off"
                                class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                class="form-control bg-transparent" />
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="#" class="link-primary" onclick='alert("Upps, Enggak bisa boss, tanya admin dulu")'>Forgot
                                Password ?</a>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">Sign In</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                            <a href="" onclick='alert("Waduh, Kita enggak buka pendaftaran, awokwok")' class="link-primary">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                {{-- <div class="me-10">
                    <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                        <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                            src="{{ asset("back/media/flags/united-states.svg") }}" alt="" />
                        <span data-kt-element="current-lang-name" class="me-1">English</span>
                        <span class="d-flex flex-center rotate-180">
                            <i class="ki-duotone ki-down fs-5 text-muted m-0"></i>
                        </span>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                        data-kt-menu="true" id="kt_auth_lang_menu">
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                        src="{{ asset("back/media/flags/united-states.svg") }}" alt="" />
                                </span>
                                <span data-kt-element="lang-name">English</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset("back/media/flags/spain.svg") }}"
                                        alt="" />
                                </span>
                                <span data-kt-element="lang-name">Spanish</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset("back/media/flags/germany.svg") }}"
                                        alt="" />
                                </span>
                                <span data-kt-element="lang-name">German</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset("back/media/flags/japan.svg") }}"
                                        alt="" />
                                </span>
                                <span data-kt-element="lang-name">Japanese</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                        src="{{ asset("back/media/flags/france.svg") }}" alt="" />
                                </span>
                                <span data-kt-element="lang-name">French</span>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="pages/team.html" target="_blank">Terms</a>
                    <a href="pages/pricing/column.html" target="_blank">Plans</a>
                    <a href="pages/contact.html" target="_blank">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
            style="background-image: url({{ asset("back/media/misc/auth-bg.png") }})">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="index.html" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset("back/media/logos/custom-2.png") }}" class="h-60px h-lg-75px" />
                </a>
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                    src="{{ Storage::url($setting_web->logo) }}" alt="" />
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">{{ $setting_web->name }}</h1>
                <div class="d-none d-lg-block text-white fs-base text-center" style="max-width: 600px" >In this kind of post,
                    {{ $setting_web->about }}
                </div>
            </div>
        </div>
    </div>
@endsection
