<div
    class="mobile-menu group top-0 inset-x-0 fixed bg-theme-1/90 z-[60] border-b border-white/[0.08] dark:bg-darkmode-800/90 md:hidden before:content-[''] before:w-full before:h-screen before:z-10 before:fixed before:inset-x-0 before:bg-black/90 before:transition-opacity before:duration-200 before:ease-in-out before:invisible before:opacity-0 [&.mobile-menu--active]:before:visible [&.mobile-menu--active]:before:opacity-100">
    <div class="flex h-[70px] items-center px-3 sm:px-8">
        <a class="mr-auto flex" href="#">
            SIPKOP
        </a>
        <a class="mobile-menu-toggler" href="#">
            <i data-tw-merge="" data-lucide="bar-chart2" class="stroke-1.5 h-8 w-8 -rotate-90 transform text-white"></i>
        </a>
    </div>
    <div
        class="scrollable h-screen z-20 top-0 left-0 w-[270px] -ml-[100%] bg-primary transition-all duration-300 ease-in-out dark:bg-darkmode-800 [&[data-simplebar]]:fixed [&_.simplebar-scrollbar]:before:bg-black/50 group-[.mobile-menu--active]:ml-0">
        <a href="#"
            class="fixed top-0 right-0 mt-4 mr-4 transition-opacity duration-200 ease-in-out invisible opacity-0 group-[.mobile-menu--active]:visible group-[.mobile-menu--active]:opacity-100">
            <i data-tw-merge="" data-lucide="x-circle"
                class="stroke-1.5 mobile-menu-toggler h-8 w-8 -rotate-90 transform text-white"></i>
        </a>
        <ul class="py-2">
            <li>
                <a class="menu menu--active" href="{{ route('dashboard') }}">
                    <div class="menu__icon">
                        <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                    </div>
                    <div class="menu__title">
                        Dashboard
                        <div class="menu__sub-icon transform rotate-180">
                            <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="menu menu--active" href="{{ route('member.list') }}">
                    <div class="menu__icon">
                        <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                    </div>
                    <div class="menu__title">
                        Member
                        <div class="menu__sub-icon transform rotate-180">
                            <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="menu menu--active" href="{{ route('savings.list') }}">
                    <div class="menu__icon">
                        <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                    </div>
                    <div class="menu__title">
                        Tabungan
                        <div class="menu__sub-icon transform rotate-180">
                            <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="menu menu--active" href="{{ route('loans.list') }}">
                    <div class="menu__icon">
                        <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                    </div>
                    <div class="menu__title">
                        Peminjaman
                        <div class="menu__sub-icon transform rotate-180">
                            <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
