<!DOCTYPE html>

<html lang="en">

@php
    $setting_web = \App\Models\SettingWebsite::first();
@endphp

<head>
    <title>{{ $setting_web->name }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ Str::limit(strip_tags($setting_web->about), 200, '...') }}" />
    <meta name="keywords"
        content="
            {{ $setting_web->name }}, Admin, OJS, Journal, jurnal, jurnal online, jurnal ilmiah, jurnal internasional, jurnal nasional, jurnal terakreditasi, jurnal terindeks scopus, jurnal terindeks sinta, jurnal terindeks google scholar, jurnal terindeks garuda, jurnal terindeks DOAJ, jurnal terindeks crossref, jurnal terindeks issn, jurnal terindeks e-issn, jurnal terindeks p-issn" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $setting_web->name }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $setting_web->name }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="shortcut icon" href="{{ Storage::url($setting_web->favicon) }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />


    <link href="{{ asset('back/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>


<body id="kt_body" class="auth-bg">

    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>



    <div class="d-flex flex-column flex-root">

        @yield('content')

    </div>



    <script>
        var hostUrl = "back/";
    </script>

    <script src="{{ asset('back/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('back/js/scripts.bundle.js') }}"></script>


    <script src="{{ asset('back/js/custom/authentication/sign-in/general.js') }}"></script>

    @include('sweetalert::alert')
    @yield('scripts')

</body>

</html>
