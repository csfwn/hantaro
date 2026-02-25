<template>
    <div class="min-h-screen bg-white text-gray-900 font-sans">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">

                    <!-- Logo -->
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-black">
                            Hantaro<span style="color:#F57C20">•</span>
                        </span>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-10">
                        <a href="#features" class="text-sm font-medium text-gray-600">Features</a>
                        <a href="#how-it-works" class="text-sm font-medium text-gray-600">How It Works</a>
                        <a href="#pricing" class="text-sm font-medium text-gray-600">Pricing</a>
                        <a href="#faq" class="text-sm font-medium text-gray-600">FAQ</a>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center gap-4">

                        <!-- Login -->
                        <a href="/admin"
                            class="hidden md:block text-sm font-medium text-gray-700 hover:text-black transition">
                            Log In
                        </a>

                        <!-- CTA -->
                        <a href="/admin/register"
                            class="hidden md:block px-6 py-3 rounded-lg text-white text-sm font-semibold btn-orange">
                            Get Started Free
                        </a>

                        <!-- Hamburger Button -->
                        <button class="md:hidden focus:outline-none" @click="mobileOpen = !mobileOpen">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Mobile Dropdown -->
            <div :class="[
                'md:hidden bg-white border-t border-gray-200',
                mobileOpen ? 'block' : 'hidden'
            ]">
                <div class="px-4 py-6 space-y-4">

                    <a href="#features" @click="mobileOpen = false"
                        class="block text-sm font-medium text-gray-700">Features</a>
                    <a href="#how-it-works" @click="mobileOpen = false"
                        class="block text-sm font-medium text-gray-700">How It Works</a>
                    <a href="#pricing" @click="mobileOpen = false"
                        class="block text-sm font-medium text-gray-700">Pricing</a>
                    <a href="#faq" @click="mobileOpen = false" class="block text-sm font-medium text-gray-700">FAQ</a>

                    <hr>

                    <a href="/admin"
                        class="block w-full text-center px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">
                        Log In
                    </a>

                    <a href="/admin/register" class="block w-full text-center px-6 py-3 rounded-lg text-white text-sm font-semibold btn-orange">
                        Get Started Free
                    </a>

                </div>
            </div>
        </nav>

        <!-- ===== HERO with Floating Cards ===== -->
        <section class="hero-section relative overflow-hidden" style="min-height:100vh; background:#000;">
            <div class="hero-mesh"></div>
            <div class="hero-text-layer">
                <h1 class="hero-h1">
                    Build, Run &amp; Grow Your<br />
                    <span class="hero-italic">Online Store.</span><br />
                    <span class="hero-orange">All-in-One Platform</span>
                </h1>
                <p class="hero-sub">Hantaro is One Platform to build, run, and grow your commerce business — without
                    limits. Built for fast-growing home businesses.</p>
                <div class="hero-btns">
                    <a href="/admin/register" class="btn-orange px-8 py-4 rounded-lg text-white font-semibold flex items-center gap-2">
                        Get Started for Free
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#how-it-works"
                        class="px-8 py-4 rounded-lg border-2 font-semibold btn-outline-orange inline-block text-center">
                        See How It Works
                    </a>
                </div>
            </div>
            <div class="cards-field">
                <div class="float-card card-0">
                    <div class="card-hero-img"
                        style="background:url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400&q=80') center/cover">
                    </div>
                    <div class="card-logo-wrap"><span class="card-logo-text">STWO</span></div>
                    <div class="card-store-name">Manisan Kita</div>
                    <div class="card-store-sub">Manisan Original Malaysia</div>
                    <div class="card-socials">
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-[#25D366]">
                                <path
                                    d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.48 0 .16 5.32.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.32-1.65a11.86 11.86 0 005.74 1.46h.01c6.58 0 11.9-5.32 11.9-11.9a11.84 11.84 0 00-3.45-8.43zm-8.46 18.3a9.8 9.8 0 01-4.99-1.37l-.36-.22-3.75.98 1-3.65-.24-.38a9.8 9.8 0 01-1.48-5.24c0-5.4 4.39-9.79 9.82-9.79a9.76 9.76 0 016.92 2.87 9.76 9.76 0 012.87 6.92c0 5.4-4.39 9.79-9.79 9.79zm5.38-7.38c-.29-.15-1.72-.85-1.99-.94-.27-.1-.46-.15-.65.15-.2.29-.75.94-.92 1.14-.17.2-.34.22-.63.07-.29-.15-1.24-.46-2.36-1.47-.87-.77-1.45-1.73-1.62-2.02-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.15-.17.2-.29.29-.48.1-.2.05-.37-.02-.51-.07-.15-.65-1.56-.89-2.14-.24-.58-.48-.5-.65-.51h-.56c-.2 0-.51.07-.78.37-.27.29-1.02.99-1.02 2.41 0 1.41 1.05 2.78 1.19 2.97.15.2 2.07 3.16 5.02 4.43.7.3 1.24.48 1.66.61.7.22 1.33.19 1.83.11.56-.08 1.72-.7 1.97-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.56-.34z" />
                            </svg></span>
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5">
                                <defs>
                                    <linearGradient id="ig0" x1="0%" y1="100%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#F58529" />
                                        <stop offset="30%" stop-color="#DD2A7B" />
                                        <stop offset="60%" stop-color="#8134AF" />
                                        <stop offset="100%" stop-color="#515BD4" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#ig0)"
                                    d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.51 4.51 0 0012 7.5zm0 7.3A2.8 2.8 0 1114.8 12 2.81 2.81 0 0112 14.8zM17.25 6.25a1.05 1.05 0 11-1.05-1.05 1.05 1.05 0 011.05 1.05z" />
                            </svg></span>
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-black">
                                <path
                                    d="M21 8.5c-1.9 0-3.6-.6-5-1.7V15a6 6 0 11-6-6c.3 0 .7 0 1 .1v2.9a3.1 3.1 0 10 2 2.9V2h3c.3 2.3 2 4.1 4 4.5v2z" />
                            </svg></span>
                    </div>
                    <div class="card-products">
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://cdn.motherhood.com.my/wp-content/uploads/sites/2/2023/05/05135830/Copy-of-Story-MMY-8-1-1-1.png') center/cover">
                            </div><span class="mini-badge">⭐ Popular</span>
                            <div class="mini-name">Kek Coklat</div>
                            <div class="mini-price">RM39.00</div>
                        </div>
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVvj0BE-y_K2nu8beNyL6mPUyBKmDqi4FQcQ&s') center/cover">
                            </div><span class="mini-badge">⭐ Popular</span>
                            <div class="mini-name">Akok</div>
                            <div class="mini-price">RM15.00</div>
                        </div>
                    </div>
                </div>
                <div class="float-card card-1">
                    <div class="card-hero-img"
                        style="background:url('https://images.unsplash.com/photo-1596797038530-2c107229654b?w=400&q=80') center/cover">
                    </div>
                    <div class="card-logo-wrap logo-green"><span class="card-logo-text">SG</span></div>
                    <div class="card-store-name">Spice Garden</div>
                    <div class="card-store-sub">Fresh Spices</div>
                    <div class="card-socials">
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-[#25D366]">
                                <path
                                    d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.48 0 .16 5.32.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.32-1.65a11.86 11.86 0 005.74 1.46h.01c6.58 0 11.9-5.32 11.9-11.9a11.84 11.84 0 00-3.45-8.43zm-8.46 18.3a9.8 9.8 0 01-4.99-1.37l-.36-.22-3.75.98 1-3.65-.24-.38a9.8 9.8 0 01-1.48-5.24c0-5.4 4.39-9.79 9.82-9.79a9.76 9.76 0 016.92 2.87 9.76 9.76 0 012.87 6.92c0 5.4-4.39 9.79-9.79 9.79zm5.38-7.38c-.29-.15-1.72-.85-1.99-.94-.27-.1-.46-.15-.65.15-.2.29-.75.94-.92 1.14-.17.2-.34.22-.63.07-.29-.15-1.24-.46-2.36-1.47-.87-.77-1.45-1.73-1.62-2.02-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.15-.17.2-.29.29-.48.1-.2.05-.37-.02-.51-.07-.15-.65-1.56-.89-2.14-.24-.58-.48-.5-.65-.51h-.56c-.2 0-.51.07-.78.37-.27.29-1.02.99-1.02 2.41 0 1.41 1.05 2.78 1.19 2.97.15.2 2.07 3.16 5.02 4.43.7.3 1.24.48 1.66.61.7.22 1.33.19 1.83.11.56-.08 1.72-.7 1.97-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.56-.34z" />
                            </svg></span>
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5">
                                <defs>
                                    <linearGradient id="ig1" x1="0%" y1="100%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#F58529" />
                                        <stop offset="30%" stop-color="#DD2A7B" />
                                        <stop offset="60%" stop-color="#8134AF" />
                                        <stop offset="100%" stop-color="#515BD4" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#ig1)"
                                    d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.51 4.51 0 0012 7.5zm0 7.3A2.8 2.8 0 1114.8 12 2.81 2.81 0 0112 14.8zM17.25 6.25a1.05 1.05 0 11-1.05-1.05 1.05 1.05 0 011.05 1.05z" />
                            </svg></span>
                    </div>
                    <div class="card-products">
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://putrafood.com/wp-content/uploads/2024/05/Paste-Rempah-Ayam-2-scaled.jpg') center/cover">
                            </div><span class="mini-badge">⭐ Hot</span>
                            <div class="mini-name">Rempah Ayam</div>
                            <div class="mini-price">RM12.00</div>
                        </div>
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://foodal.com/wp-content/uploads/2015/02/Make-Your-Own-Curry-Powder.jpg') center/cover">
                            </div>
                            <div class="mini-name">Curry Powder</div>
                            <div class="mini-price">RM8.50</div>
                        </div>
                    </div>
                </div>
                <div class="float-card card-2">
                    <div class="card-hero-img"
                        style="background:url('https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&q=80') center/cover">
                    </div>
                    <div class="card-logo-wrap logo-pink"><span class="card-logo-text">SC</span></div>
                    <div class="card-store-name">Sweet Corner</div>
                    <div class="card-store-sub">Homemade Pastries &amp; Desserts</div>
                    <div class="card-socials">
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5">
                                <defs>
                                    <linearGradient id="ig2" x1="0%" y1="100%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#F58529" />
                                        <stop offset="30%" stop-color="#DD2A7B" />
                                        <stop offset="60%" stop-color="#8134AF" />
                                        <stop offset="100%" stop-color="#515BD4" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#ig2)"
                                    d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.51 4.51 0 0012 7.5zm0 7.3A2.8 2.8 0 1114.8 12 2.81 2.81 0 0112 14.8zM17.25 6.25a1.05 1.05 0 11-1.05-1.05 1.05 1.05 0 011.05 1.05z" />
                            </svg></span>
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-black">
                                <path
                                    d="M21 8.5c-1.9 0-3.6-.6-5-1.7V15a6 6 0 11-6-6c.3 0 .7 0 1 .1v2.9a3.1 3.1 0 10 2 2.9V2h3c.3 2.3 2 4.1 4 4.5v2z" />
                            </svg></span>
                    </div>
                    <div class="card-products">
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://parisbaguette.com.my/wp-content/uploads/2021/12/Croissant.jpg') center/cover">
                            </div><span class="mini-badge">⭐ New</span>
                            <div class="mini-name">Croissant</div>
                            <div class="mini-price">RM10.00</div>
                        </div>
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://thescranline.com/wp-content/uploads/2024/09/CHOOCLATE-MACARONS-S-02.jpg') center/cover">
                            </div>
                            <div class="mini-name">Macarons</div>
                            <div class="mini-price">RM18.00</div>
                        </div>
                    </div>
                </div>
                <div class="float-card card-3">
                    <div class="card-hero-img"
                        style="background:url('https://images.unsplash.com/photo-1439229747457-a74897f98ec8?w=400&q=80') center/cover">
                    </div>
                    <div class="card-logo-wrap logo-green"><span class="card-logo-text">OF</span></div>
                    <div class="card-store-name">Organic Farm</div>
                    <div class="card-store-sub">Fresh &amp; Natural Daily</div>
                    <div class="card-socials">
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-[#25D366]">
                                <path
                                    d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.48 0 .16 5.32.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.32-1.65a11.86 11.86 0 005.74 1.46h.01c6.58 0 11.9-5.32 11.9-11.9a11.84 11.84 0 00-3.45-8.43zm-8.46 18.3a9.8 9.8 0 01-4.99-1.37l-.36-.22-3.75.98 1-3.65-.24-.38a9.8 9.8 0 01-1.48-5.24c0-5.4 4.39-9.79 9.82-9.79a9.76 9.76 0 016.92 2.87 9.76 9.76 0 012.87 6.92c0 5.4-4.39 9.79-9.79 9.79zm5.38-7.38c-.29-.15-1.72-.85-1.99-.94-.27-.1-.46-.15-.65.15-.2.29-.75.94-.92 1.14-.17.2-.34.22-.63.07-.29-.15-1.24-.46-2.36-1.47-.87-.77-1.45-1.73-1.62-2.02-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.15-.17.2-.29.29-.48.1-.2.05-.37-.02-.51-.07-.15-.65-1.56-.89-2.14-.24-.58-.48-.5-.65-.51h-.56c-.2 0-.51.07-.78.37-.27.29-1.02.99-1.02 2.41 0 1.41 1.05 2.78 1.19 2.97.15.2 2.07 3.16 5.02 4.43.7.3 1.24.48 1.66.61.7.22 1.33.19 1.83.11.56-.08 1.72-.7 1.97-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.56-.34z" />
                            </svg></span>
                    </div>
                    <div class="card-products">
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=200&q=80') center/cover">
                            </div><span class="mini-badge">⭐ Fresh</span>
                            <div class="mini-name">Sayur Organik</div>
                            <div class="mini-price">RM9.00</div>
                        </div>
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=200&q=80') center/cover">
                            </div>
                            <div class="mini-name">Buah Tempatan</div>
                            <div class="mini-price">RM15.00</div>
                        </div>
                    </div>
                </div>
                <div class="float-card card-4">
                    <div class="card-hero-img"
                        style="background:url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=400&q=80') center/cover">
                    </div>
                    <div class="card-logo-wrap logo-amber"><span class="card-logo-text">RC</span></div>
                    <div class="card-store-name">Roasted Co.</div>
                    <div class="card-store-sub">Specialty Coffee Beans</div>
                    <div class="card-socials">
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-black">
                                <path
                                    d="M21 8.5c-1.9 0-3.6-.6-5-1.7V15a6 6 0 11-6-6c.3 0 .7 0 1 .1v2.9a3.1 3.1 0 10 2 2.9V2h3c.3 2.3 2 4.1 4 4.5v2z" />
                            </svg></span>
                    </div>
                    <div class="card-products">
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=200&q=80') center/cover">
                            </div><span class="mini-badge">⭐ Best</span>
                            <div class="mini-name">Liberica Blend</div>
                            <div class="mini-price">RM42.00</div>
                        </div>
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=200&q=80') center/cover">
                            </div>
                            <div class="mini-name">Robusta Dark</div>
                            <div class="mini-price">RM35.00</div>
                        </div>
                    </div>
                </div>
                <div class="float-card card-5">
                    <div class="card-hero-img"
                        style="background:url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80') center/cover">
                    </div>
                    <div class="card-logo-wrap logo-teal"><span class="card-logo-text">BC</span></div>
                    <div class="card-store-name">Batik Craft</div>
                    <div class="card-store-sub">Handmade Batik</div>
                    <div class="card-socials">
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-[#25D366]">
                                <path
                                    d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.48 0 .16 5.32.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.32-1.65a11.86 11.86 0 005.74 1.46h.01c6.58 0 11.9-5.32 11.9-11.9a11.84 11.84 0 00-3.45-8.43zm-8.46 18.3a9.8 9.8 0 01-4.99-1.37l-.36-.22-3.75.98 1-3.65-.24-.38a9.8 9.8 0 01-1.48-5.24c0-5.4 4.39-9.79 9.82-9.79a9.76 9.76 0 016.92 2.87 9.76 9.76 0 012.87 6.92c0 5.4-4.39 9.79-9.79 9.79zm5.38-7.38c-.29-.15-1.72-.85-1.99-.94-.27-.1-.46-.15-.65.15-.2.29-.75.94-.92 1.14-.17.2-.34.22-.63.07-.29-.15-1.24-.46-2.36-1.47-.87-.77-1.45-1.73-1.62-2.02-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.15-.17.2-.29.29-.48.1-.2.05-.37-.02-.51-.07-.15-.65-1.56-.89-2.14-.24-.58-.48-.5-.65-.51h-.56c-.2 0-.51.07-.78.37-.27.29-1.02.99-1.02 2.41 0 1.41 1.05 2.78 1.19 2.97.15.2 2.07 3.16 5.02 4.43.7.3 1.24.48 1.66.61.7.22 1.33.19 1.83.11.56-.08 1.72-.7 1.97-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.56-.34z" />
                            </svg></span>
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5">
                                <defs>
                                    <linearGradient id="ig5" x1="0%" y1="100%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#F58529" />
                                        <stop offset="30%" stop-color="#DD2A7B" />
                                        <stop offset="60%" stop-color="#8134AF" />
                                        <stop offset="100%" stop-color="#515BD4" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#ig5)"
                                    d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.51 4.51 0 0012 7.5zm0 7.3A2.8 2.8 0 1114.8 12 2.81 2.81 0 0112 14.8zM17.25 6.25a1.05 1.05 0 11-1.05-1.05 1.05 1.05 0 011.05 1.05z" />
                            </svg></span>
                        <span class="social-pill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 fill-black">
                                <path
                                    d="M21 8.5c-1.9 0-3.6-.6-5-1.7V15a6 6 0 11-6-6c.3 0 .7 0 1 .1v2.9a3.1 3.1 0 10 2 2.9V2h3c.3 2.3 2 4.1 4 4.5v2z" />
                            </svg></span>
                    </div>
                    <div class="card-products">
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWVrFrWQoj64rtaf5cYN7abLrJWv3sKqG4NA&s') center/cover">
                            </div><span class="mini-badge">⭐ Rare</span>
                            <div class="mini-name">Sarung Batik</div>
                            <div class="mini-price">RM85.00</div>
                        </div>
                        <div class="mini-product">
                            <div class="mini-img"
                                style="background:url('https://media-cdn.tripadvisor.com/media/photo-s/0f/3f/be/72/silk-scarf-3.jpg') center/cover">
                            </div>
                            <div class="mini-name">Scarf Batik</div>
                            <div class="mini-price">RM55.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dashboard Preview -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">
                    <div class="bg-gray-100 border-b border-gray-200 px-4 py-3 flex items-center gap-2">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="flex-1 mx-8">
                            <div class="bg-white rounded px-3 py-1 text-xs text-gray-500 text-center">
                                hantaro.my/dashboard</div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-bold text-black mb-1">Analytics</h3>
                                <p class="text-sm text-gray-500">Monitor your store performance</p>
                            </div>
                            <div class="flex items-center gap-3"><select
                                    class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium bg-white">
                                    <option>Last 30 days</option>
                                </select><button
                                    class="px-4 py-2 rounded-lg text-white text-sm font-medium btn-orange">Share</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <div v-for="stat in stats" :key="stat.label"
                                class="p-6 rounded-xl border border-gray-200 hover:shadow-md transition stat-card">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                        style="background:#FFF3E0"><svg class="w-5 h-5" fill="none" :stroke="'#F57C20'"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                :d="stat.icon" />
                                        </svg></div><span class="text-sm font-medium text-gray-600">{{ stat.label
                                        }}</span>
                                </div>
                                <div class="text-3xl font-bold text-black mb-1">{{ stat.value }}</div>
                                <div class="flex items-center gap-1 text-xs"
                                    :class="stat.up ? 'text-green-600' : 'text-red-600'"><span>{{ stat.change }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="p-6 rounded-xl border border-gray-200">
                                <h4 class="font-bold text-black mb-1">Total Orders</h4>
                                <p class="text-sm text-gray-500 mb-6">Total customer orders completed</p>
                                <div class="space-y-3">
                                    <div v-for="o in orders" :key="o.label">
                                        <div class="flex items-center justify-between text-sm mb-1"><span
                                                class="text-gray-600">{{ o.label }}</span><span class="font-semibold">{{
                                                    o.val }}</span></div>
                                        <div class="w-full bg-gray-100 rounded-full h-2">
                                            <div class="h-2 rounded-full" style="background:#F57C20"
                                                :style="{ width: o.pct + '%' }"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                                    <div class="text-4xl font-bold text-black mb-1">1,250+</div>
                                    <div class="text-sm text-gray-500">Orders</div>
                                </div>
                            </div>
                            <div class="p-6 rounded-xl border border-gray-200">
                                <h4 class="font-bold text-black mb-1">Total Sales</h4>
                                <p class="text-sm text-gray-500 mb-6">Monthly sales for the selected period</p>
                                <div class="h-48 flex items-end justify-between gap-2 mb-4">
                                    <div v-for="bar in bars" :key="bar.label"
                                        class="flex flex-col items-center gap-1 flex-1">
                                        <div class="w-full rounded-t"
                                            :style="{ height: bar.h + '%', background: bar.color }"></div><span
                                            class="text-xs text-gray-500">{{ bar.label }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">May Sales</div>
                                    <div class="text-2xl font-bold text-black">RM220,342,123</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                    <div class="border-r border-gray-200 last:border-r-0">
                        <div class="text-5xl font-bold text-black mb-3">5,000<span style="color:#F57C20">+</span></div>
                        <p class="text-gray-600">Home businesses powered by Hantaro</p>
                    </div>
                    <div class="border-r border-gray-200 last:border-r-0">
                        <div class="flex items-center justify-center gap-2 mb-3">
                            <div class="text-5xl font-bold text-black">4.9</div>
                            <div class="text-3xl" style="color:#F57C20">⭐</div>
                        </div>
                        <p class="text-gray-600">Average rating from sellers worldwide</p>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-black mb-3">100<span style="color:#F57C20">%</span></div>
                        <p class="text-gray-600">Mobile-optimized storefront experience</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section id="how-it-works" class="py-24 px-4 sm:px-6 lg:px-8 bg-black text-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-4xl sm:text-5xl font-bold mb-6">How Hantaro Works?</h2>
                    <p class="text-xl text-gray-400 max-w-3xl mx-auto">Start selling online in 3 simple steps — no
                        technical skills needed</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-6 mx-auto text-white"
                            style="background:#F57C20">1</div>
                        <h3 class="text-2xl font-bold mb-4">Create Your Store</h3>
                        <p class="text-gray-400 mb-6 leading-relaxed">Sign up in seconds and customize your store with
                            your brand name and colors</p>
                        <div class="inline-block px-6 py-3 rounded-lg text-sm font-mono bg-white" style="color:#F57C20">
                            hantaro.my/yourstore</div>
                    </div>
                    <!-- Step 2 — PLACEHOLDER kept identical, will be replaced next -->
                    <div class="text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-6 mx-auto text-white"
                            style="background:#F57C20">2</div>
                        <h3 class="text-2xl font-bold mb-4">Add Your Products</h3>
                        <p class="text-gray-400 mb-6 leading-relaxed">Upload photos, set prices, and add descriptions —
                            as simple as posting on social media</p>
                        <!-- 2×2 product cards -->
                        <div class="grid grid-cols-2 gap-3 max-w-xs mx-auto">
                            <div v-for="p in stepProducts" :key="p.name" class="sp-card">
                                <!-- image + badge -->
                                <div class="sp-img-wrap">
                                    <div class="sp-img" :style="`background:url('${p.img}') center/cover`"></div>
                                    <span v-if="p.badge" class="sp-badge">⭐ {{ p.badge }}</span>
                                </div>
                                <!-- name & price -->
                                <div class="sp-name">{{ p.name }}</div>
                                <div class="sp-price">RM{{ p.price }}</div>
                                <!-- qty row  ─  [ − ]  Qty / 0  [ + ] -->
                                <div class="sp-qty-row">
                                    <button class="sp-btn sp-btn-minus" @click="p.qty > 0 && p.qty--">−</button>
                                    <div class="sp-qty-center">
                                        <span class="sp-qty-label">Qty</span>
                                        <span class="sp-qty-val">{{ p.qty }}</span>
                                    </div>
                                    <button class="sp-btn sp-btn-plus" @click="p.qty++">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-6 mx-auto text-white"
                            style="background:#F57C20">3</div>
                        <h3 class="text-2xl font-bold mb-4">Share &amp; Start Selling</h3>
                        <p class="text-gray-400 mb-6 leading-relaxed">Share your store link on WhatsApp, Instagram, or
                            Facebook and start receiving orders</p>
                        <div class="flex gap-3 justify-center">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-white"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                    <defs>
                                        <linearGradient id="ig3" x1="0%" y1="100%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#F58529" />
                                            <stop offset="30%" stop-color="#DD2A7B" />
                                            <stop offset="60%" stop-color="#8134AF" />
                                            <stop offset="100%" stop-color="#515BD4" />
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#ig3)"
                                        d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.51 4.51 0 0012 7.5zm0 7.3A2.8 2.8 0 1114.8 12 2.81 2.81 0 0112 14.8zM17.25 6.25a1.05 1.05 0 11-1.05-1.05 1.05 1.05 0 011.05 1.05z" />
                                </svg></div>
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-white"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="h-5 w-5 fill-[#25D366]">
                                    <path
                                        d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.48 0 .16 5.32.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.32-1.65a11.86 11.86 0 005.74 1.46h.01c6.58 0 11.9-5.32 11.9-11.9a11.84 11.84 0 00-3.45-8.43zm-8.46 18.3a9.8 9.8 0 01-4.99-1.37l-.36-.22-3.75.98 1-3.65-.24-.38a9.8 9.8 0 01-1.48-5.24c0-5.4 4.39-9.79 9.82-9.79a9.76 9.76 0 016.92 2.87 9.76 9.76 0 012.87 6.92c0 5.4-4.39 9.79-9.79 9.79zm5.38-7.38c-.29-.15-1.72-.85-1.99-.94-.27-.1-.46-.15-.65.15-.2.29-.75.94-.92 1.14-.17.2-.34.22-.63.07-.29-.15-1.24-.46-2.36-1.47-.87-.77-1.45-1.73-1.62-2.02-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.15-.17.2-.29.29-.48.1-.2.05-.37-.02-.51-.07-.15-.65-1.56-.89-2.14-.24-.58-.48-.5-.65-.51h-.56c-.2 0-.51.07-.78.37-.27.29-1.02.99-1.02 2.41 0 1.41 1.05 2.78 1.19 2.97.15.2 2.07 3.16 5.02 4.43.7.3 1.24.48 1.66.61.7.22 1.33.19 1.83.11.56-.08 1.72-.7 1.97-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.56-.34z" />
                                </svg></div>
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-white"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-black">
                                    <path
                                        d="M21 8.5c-1.9 0-3.6-.6-5-1.7V15a6 6 0 11-6-6c.3 0 .7 0 1 .1v2.9a3.1 3.1 0 10 2 2.9V2h3c.3 2.3 2 4.1 4 4.5v2z" />
                                </svg></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-4xl sm:text-5xl font-bold text-black mb-6">Everything You Need to Sell Online</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Powerful features designed for home business
                        owners</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="f in features" :key="f.title"
                        class="p-8 rounded-2xl border border-gray-200 feature-card"
                        style="border-top:3px solid #F57C20">
                        <div class="text-4xl mb-6">{{ f.icon }}</div>
                        <h3 class="text-xl font-bold text-black mb-3">{{ f.title }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ f.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-4xl sm:text-5xl font-bold text-black mb-6">Simple, Transparent Pricing</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Start free, upgrade as you grow — no hidden fees
                    </p>
                </div>

                <!-- Hide scrollbar and center cards with proper spacing -->
                <div class="overflow-x-auto pb-8 scrollbar-hide pt-6">
                    <div class="flex gap-6 justify-center mx-auto" style="width: fit-content; min-width: 100%;">
                        <div v-for="plan in pricingPlans" :key="plan.name"
                            class="bg-white rounded-2xl p-8 relative flex-shrink-0 w-80"
                            :class="plan.popular ? 'shadow-2xl' : 'shadow-md'"
                            :style="plan.popular ? 'border:2px solid #F57C20' : 'border:2px solid #e5e7eb'">

                            <div v-if="plan.popular" class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="text-white px-6 py-2 rounded-full text-sm font-semibold whitespace-nowrap"
                                    style="background:#F57C20">Most Popular</span>
                            </div>

                            <div class="mb-8">
                                <div class="text-sm font-semibold text-gray-600 mb-3">{{ plan.name }}</div>
                                <div class="mb-2 flex items-baseline flex-wrap">
                                    <span class="text-5xl font-bold text-black">RM{{ plan.price }}</span>
                                    <span class="text-gray-600 ml-1">/{{ plan.period }}</span>
                                </div>
                            </div>

                            <ul class="space-y-4 mb-8">
                                <li v-for="feat in plan.features" :key="feat" class="flex items-start gap-3">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="#F57C20"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-sm">{{ feat }}</span>
                                </li>
                            </ul>

                            <button class="w-full py-4 rounded-lg font-semibold transition hover:opacity-90"
                                :style="plan.popular ? 'background:#F57C20;color:#fff' : 'border:2px solid #F57C20;color:#F57C20;background:#fff'">
                                {{ plan.buttonText }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-black mb-6">Frequently Asked Questions</h2>
                </div>
                <div class="space-y-4">
                    <details v-for="faq in faqs" :key="faq.question"
                        class="group border-2 border-gray-200 rounded-xl p-6 faq-item">
                        <summary
                            class="font-semibold text-lg text-black cursor-pointer list-none flex items-center justify-between">
                            <span>{{ faq.question }}</span><span
                                class="text-2xl transition-transform group-open:rotate-45"
                                style="color:#F57C20">+</span>
                        </summary>
                        <p class="text-gray-600 mt-4 leading-relaxed">{{ faq.answer }}</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-24 px-4 sm:px-6 lg:px-8 bg-black text-white">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6">Ready to Start Your <span style="color:#F57C20">Online
                        Business?</span></h2>
                <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto">Join 5,000+ entrepreneurs selling online with
                    Hantaro. No credit card required.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                    <input v-model="ctaEmail" type="email" placeholder="Enter your email address"
                        class="px-6 py-4 rounded-lg w-full sm:w-96 text-white placeholder-gray-500 cta-input"
                        style="border:2px solid #444;background:#1a1a1a">
                    <button class="px-8 py-4 rounded-lg font-bold btn-orange text-white w-full sm:w-auto">Get Started
                        Free</button>
                </div>
                <p class="text-sm text-gray-500">Free forever • No credit card required • Setup in 5 minutes</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 px-4 sm:px-6 lg:px-8 py-10">
            <div class="max-w-7xl mx-auto">
                <div class="border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-600">© 2026 Hantaro. 202503084987 (AS0493179-P).</p>
                    <div class="flex gap-6"><a href="/privacy" class="footer-link">Privacy</a><a href="/terms"
                            class="footer-link">Terms</a></div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { Link } from '@inertiajs/vue3';
const ctaEmail = ref('')
const mobileOpen = ref(false)
/* ── Step-2 product cards ── */
const stepProducts = reactive([
    { name: 'Rempah Ayam', price: '9.50', badge: 'New', qty: 0, img: 'https://images.unsplash.com/photo-1646809156467-6e825869b29f?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
    { name: 'Macarons', price: '18.00', badge: null, qty: 0, img: 'https://images.unsplash.com/photo-1422255198496-21531f12a6e8?q=80&w=1474&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }
])

const stats = [
    { label: 'Website Visitors', value: '500', change: '↑ 2.5%', up: true, icon: 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' },
    { label: 'Total Sales', value: 'RM70k', change: '↓ 1.3%', up: false, icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
    { label: 'Orders', value: '328', change: '↑ 2.3%', up: true, icon: 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z' },
    { label: 'Conversion Rate', value: '5.23%', change: '↑ 1.5%', up: true, icon: 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' }
]
const orders = [
    { label: 'Return & Refund', val: '12', pct: 2 },
    { label: 'Order Pending', val: '251', pct: 42 },
    { label: 'Delivered', val: '1,665', pct: 95 }
]
const bars = [
    { label: 'Mar 1', h: 45, color: '#FFE0B2' },
    { label: 'Mar 8', h: 65, color: '#FFCC80' },
    { label: 'Mar 15', h: 50, color: '#FFE0B2' },
    { label: 'Mar 22', h: 85, color: '#F57C20' },
    { label: 'Mar 31', h: 70, color: '#FFCC80' }
]
const features = [
    { icon: '🔗', title: 'Personal Store Link', description: 'Get your own custom link like hantaro.my/yourname to share everywhere' },
    { icon: '📦', title: 'Product Management', description: 'Add unlimited products with photos, prices, variants, and stock tracking' },
    { icon: '💳', title: 'Accept Payments', description: 'FPX online banking, DuitNow QR, or manual bank transfer — your choice' },
    { icon: '📱', title: 'WhatsApp Integration', description: 'Get instant order notifications via WhatsApp — perfect for your workflow' },
    { icon: '📊', title: 'Sales Dashboard', description: 'Track orders, revenue, and top products all in one simple dashboard' },
    { icon: '📲', title: 'Mobile Optimized', description: 'Your store looks perfect on phones, tablets, and desktop' }
]
const pricingPlans = [
    {
        name: 'Starter (Free)',
        price: '0',
        period: 'forever',
        popular: false,
        buttonText: 'Start Free',
        features: [
            'Unlimited ecommerce store',
            'Unlimited products',
            'Order & inventory management',
            'Checkout & payment handling',
            'Sales summary dashboard',
            'Platform fee per transaction (2.5%–3%)',
            'No monthly commitment'
        ]
    },
    // {
    //     name: 'Growth',
    //     price: '129',
    //     period: 'month',
    //     popular: true,
    //     buttonText: 'Upgrade to Growth',
    //     features: [
    //         'Up to 2 stores',
    //         'Sync 1 marketplace (Shopee OR TikTok OR Lazada)',
    //         'Centralised order dashboard',
    //         'Manual WhatsApp integration',
    //         'Standard sales & order reports',
    //         'Email & ticket support'
    //     ]
    // },
    // {
    //     name: 'Pro',
    //     price: '299',
    //     period: 'month',
    //     popular: false,
    //     buttonText: 'Upgrade to Pro',
    //     features: [
    //         'Up to 5 stores',
    //         'Sync Shopee + TikTok + Lazada',
    //         'Automated order status updates',
    //         'WhatsApp automation (fair usage)',
    //         'Advanced reports & CSV export',
    //         'Multi-user access (staff roles)'
    //     ]
    // },
    // {
    //     name: 'Enterprise',
    //     price: '1,000',
    //     period: 'month',
    //     popular: false,
    //     buttonText: 'Contact Sales',
    //     features: [
    //         'Unlimited stores & channels',
    //         'High-volume order handling',
    //         'Advanced automation & workflows',
    //         'High WhatsApp message limits',
    //         'Dedicated onboarding & support',
    //         'Custom integrations & SLA'
    //     ]
    // }
]

const faqs = [
    { question: 'Is there a free trial available?', answer: 'Yes! Our Free plan is free forever with up to 10 products. You can also try our paid plans free for 14 days with no credit card required.' },
    { question: 'Do I need technical skills to use Hantaro?', answer: 'Not at all! Hantaro is designed for non-technical users. If you can use WhatsApp or Instagram, you can use Hantaro. Everything is point-and-click simple.' },
    { question: 'What platforms can I integrate with?', answer: 'Hantaro works great with WhatsApp, Instagram, Facebook, TikTok, and any platform where you can share links. Your store is mobile-optimized for social media sharing.' },
    { question: 'How often is the data updated?', answer: 'Your sales dashboard updates in real-time. Every order, payment, and product change is reflected instantly so you\'re always up to date.' }
]


</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

* {
    font-family: 'Inter', sans-serif;
}

/* Hide scrollbar but keep functionality */
.scrollbar-hide {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
    /* Chrome, Safari and Opera */
}

details>summary {
    list-style: none;
}

details>summary::-webkit-details-marker {
    display: none;
}

.btn-orange {
    background: #F57C20;
    transition: background .2s;
}

.btn-orange:hover {
    background: #e06a10;
}

.btn-outline-orange {
    border-color: #F57C20;
    color: #F57C20;
    background: transparent;
    transition: background .2s;
}

.btn-outline-orange:hover {
    background: rgba(245, 124, 32, .08);
}

.nav-link {
    transition: color .2s;
}

.nav-link:hover {
    color: #F57C20;
}

.footer-link {
    transition: color .2s;
}

.footer-link:hover {
    color: #F57C20;
}

.cta-input:focus {
    outline: none;
    border-color: #F57C20 !important;
}

.stat-card {
    border-top: 3px solid #F57C20;
}

.feature-card {
    transition: box-shadow .25s, border-color .25s;
}

.feature-card:hover {
    box-shadow: 0 10px 25px rgba(245, 124, 32, .18);
    border-color: #F57C20;
}

.faq-item {
    transition: border-color .2s;
}

.faq-item:hover,
.faq-item[open] {
    border-color: #F57C20;
}

.hero-section {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 80px;
    min-height: 100vh;
    background: #0a0a0a;
    overflow: hidden;
}

.hero-mesh {
    position: absolute;
    inset: 0;
    z-index: 0;
    background: radial-gradient(ellipse 70% 60% at 15% 50%, rgba(245, 124, 32, .18) 0%, transparent 70%), radial-gradient(ellipse 50% 50% at 85% 30%, rgba(245, 124, 32, .10) 0%, transparent 70%), radial-gradient(ellipse 40% 40% at 75% 75%, rgba(245, 124, 32, .06) 0%, transparent 70%);
}

.hero-text-layer {
    position: relative;
    z-index: 10;
    text-align: center;
    max-width: 680px;
    padding: 0 24px;
    pointer-events: none;
}

.hero-text-layer * {
    pointer-events: auto;
}

.hero-h1 {
    font-size: clamp(2.4rem, 5.5vw, 4rem);
    font-weight: 800;
    line-height: 1.15;
    color: #fff;
    margin-bottom: 20px;
}

.hero-italic {
    font-style: italic;
    font-family: 'Georgia', serif;
    color: #fff;
}

.hero-orange {
    color: #F57C20;
    font-style: normal;
}

.hero-sub {
    color: rgba(255, 255, 255, .55);
    font-size: 1.05rem;
    line-height: 1.6;
    margin-bottom: 32px;
}

.hero-btns {
    display: flex;
    gap: 14px;
    justify-content: center;
    flex-wrap: wrap;
}

.cards-field {
    position: absolute;
    inset: 0;
    z-index: 2;
    pointer-events: none;
}

.float-card {
    position: absolute;
    width: 200px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, .45);
    overflow: hidden;
    pointer-events: none;
    will-change: transform;
}

.card-hero-img {
    width: 100%;
    height: 78px;
    background-size: cover;
    background-position: center;
}

.card-logo-wrap {
    position: absolute;
    top: 34px;
    left: 50%;
    transform: translateX(-50%);
    width: 48px;
    height: 48px;
    background: #fff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
    border: 3px solid #fff;
}

.card-logo-wrap.logo-green {
    border-color: #a8e6a0;
}

.card-logo-wrap.logo-pink {
    border-color: #f6a0c0;
}

.card-logo-wrap.logo-amber {
    border-color: #f5c842;
}

.card-logo-wrap.logo-teal {
    border-color: #6dd5d0;
}

.card-logo-text {
    font-weight: 900;
    font-size: .72rem;
    color: #111;
    letter-spacing: -.5px;
}

.card-store-name {
    text-align: center;
    font-weight: 700;
    font-size: .78rem;
    color: #111;
    margin-top: 18px;
}

.card-store-sub {
    text-align: center;
    font-size: .62rem;
    color: #888;
    margin-top: 1px;
}

.card-socials {
    display: flex;
    gap: 6px;
    justify-content: center;
    margin-top: 8px;
}

.social-pill {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-products {
    display: flex;
    gap: 6px;
    padding: 10px 8px 10px;
}

.mini-product {
    flex: 1;
    background: #f7f7f7;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.mini-img {
    width: 100%;
    aspect-ratio: 1;
    background-size: cover;
    background-position: center;
}

.mini-badge {
    position: absolute;
    top: 5px;
    left: 5px;
    background: rgba(0, 0, 0, .7);
    color: #fff;
    font-size: .52rem;
    font-weight: 600;
    padding: 2px 5px;
    border-radius: 5px;
}

.mini-name {
    font-size: .6rem;
    font-weight: 600;
    color: #111;
    padding: 4px 4px 0;
}

.mini-price {
    font-size: .62rem;
    font-weight: 700;
    color: #F57C20;
    padding: 0 4px 4px;
}

.card-0 {
    left: 3%;
    top: 12%;
    animation: float0 5.8s ease-in-out infinite;
}

@keyframes float0 {

    0%,
    100% {
        transform: translateY(0px) rotate(-1.2deg);
    }

    50% {
        transform: translateY(-22px) rotate(0.6deg);
    }
}

.card-1 {
    left: 22%;
    top: 5%;
    animation: float1 6.6s ease-in-out infinite;
    animation-delay: -.8s;
}

@keyframes float1 {

    0%,
    100% {
        transform: translateY(0px) rotate(0.8deg);
    }

    50% {
        transform: translateY(-18px) rotate(-1deg);
    }
}

.card-2 {
    right: 18%;
    top: 4%;
    animation: float2 5.2s ease-in-out infinite;
    animation-delay: -1.6s;
}

@keyframes float2 {

    0%,
    100% {
        transform: translateY(0px) rotate(1deg);
    }

    50% {
        transform: translateY(-26px) rotate(-0.5deg);
    }
}

.card-3 {
    right: 2%;
    top: 42%;
    animation: float3 7s ease-in-out infinite;
    animation-delay: -2.4s;
}

@keyframes float3 {

    0%,
    100% {
        transform: translateY(0px) rotate(-0.7deg);
    }

    50% {
        transform: translateY(-20px) rotate(1.1deg);
    }
}

.card-4 {
    left: 6%;
    bottom: 4%;
    animation: float4 6.1s ease-in-out infinite;
    animation-delay: -3.2s;
}

@keyframes float4 {

    0%,
    100% {
        transform: translateY(0px) rotate(1.4deg);
    }

    50% {
        transform: translateY(-16px) rotate(-0.8deg);
    }
}

.card-5 {
    right: 5%;
    bottom: 2%;
    animation: float5 5.5s ease-in-out infinite;
    animation-delay: -4s;
}

@keyframes float5 {

    0%,
    100% {
        transform: translateY(0px) rotate(-0.5deg);
    }

    50% {
        transform: translateY(-24px) rotate(0.9deg);
    }
}

@media (max-width:1024px) {
    .float-card {
        width: 160px;
    }

    .card-hero-img {
        height: 60px;
    }

    .card-logo-wrap {
        width: 38px;
        height: 38px;
        top: 28px;
    }

    .card-store-name {
        font-size: .68rem;
        margin-top: 14px;
    }

    .card-store-sub {
        font-size: .55rem;
    }
}

@media (max-width:640px) {
    .cards-field {
        display: none;
    }

    .hero-section {
        min-height: auto;
        padding-top: 140px;
        padding-bottom: 60px;
    }
}

/* ========================================
   STEP-2 PRODUCT CARDS  (dark bg section)
   ======================================== */
.sp-card {
    background: #1e1e1e;
    border: 1px solid #333;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

/* image + badge */
.sp-img-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 1;
}

.sp-img {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

.sp-badge {
    position: absolute;
    top: 5px;
    left: 5px;
    background: rgba(0, 0, 0, .72);
    color: #fff;
    font-size: .58rem;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 20px;
}

/* name & price */
.sp-name {
    color: #fff;
    font-size: .7rem;
    font-weight: 600;
    padding: 6px 7px 1px;
    line-height: 1.25;
}

.sp-price {
    color: #F57C20;
    font-size: .75rem;
    font-weight: 700;
    padding: 0 7px 5px;
}

/* qty row  ──  [−]  center  [+] */
.sp-qty-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 4px 7px 7px;
    margin-top: auto;
    gap: 2px;
}

.sp-qty-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    line-height: 1.15;
}

.sp-qty-label {
    color: #777;
    font-size: .54rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .3px;
}

.sp-qty-val {
    color: #fff;
    font-size: .82rem;
    font-weight: 700;
}

/* buttons */
.sp-btn {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: background .15s, transform .1s;
    line-height: 1;
    flex-shrink: 0;
}

.sp-btn:active {
    transform: scale(.85);
}

.sp-btn-minus {
    background: #2a2a2a;
    color: #aaa;
    border: 1px solid #444;
}

.sp-btn-minus:hover {
    background: #3a3a3a;
    color: #fff;
}

.sp-btn-plus {
    background: #F57C20;
    color: #fff;
}

.sp-btn-plus:hover {
    background: #e06a10;
}
</style>