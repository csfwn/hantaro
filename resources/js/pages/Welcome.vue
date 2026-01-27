<template>
    <div class="min-h-screen bg-white text-gray-900 font-sans">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass-effect">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold text-lg">
                            H
                        </div>
                        <span class="text-xl font-bold text-gray-900">Hantaro</span>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-sm font-medium text-gray-600 hover:text-gray-900">Features</a>
                        <a href="#how-it-works" class="text-sm font-medium text-gray-600 hover:text-gray-900">How It Works</a>
                        <a href="#pricing" class="text-sm font-medium text-gray-600 hover:text-gray-900">Pricing</a>
                        <a href="#faq" class="text-sm font-medium text-gray-600 hover:text-gray-900">FAQ</a>
                    </div>
                    
                    <button class="px-6 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 transition-all">
                        Start Free
                    </button>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900 mb-6">
                            Create your own<br>
                            <span class="bg-gradient-to-r from-purple-400 to-purple-700 bg-clip-text text-transparent">online store</span><br>
                            in minutes
                        </h1>
                        <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
                            Hantaro helps home business owners sell online easily — no tech skills required.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8">
                            <div class="relative">
                                <input 
                                    v-model="email" 
                                    type="email" 
                                    placeholder="Enter your email address" 
                                    class="w-full sm:w-80 px-5 py-4 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500 text-base"
                                >
                            </div>
                            <button 
                                @click="handleStartFree"
                                class="px-8 py-4 rounded-xl bg-purple-600 text-white font-semibold hover:bg-purple-700 transition-all flex items-center justify-center gap-2"
                            >
                                Start Free
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <p class="text-sm text-gray-500">No credit card required • Free forever plan available</p>
                    </div>
                    
                    <!-- Right Visual -->
                    <div class="relative">
                        <div class="relative z-10">
                            <!-- Main Dashboard Mock -->
                            <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-100">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Welcome Back, Sarah! 👋</h3>
                                        <p class="text-sm text-gray-500">Here's your store performance</p>
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <span class="text-purple-600 font-semibold">S</span>
                                    </div>
                                </div>
                                
                                <!-- Stats -->
                                <div class="grid grid-cols-3 gap-4 mb-6">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900">RM1,245</div>
                                        <div class="text-xs text-gray-500">Revenue</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900">89</div>
                                        <div class="text-xs text-gray-500">Orders</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900">156</div>
                                        <div class="text-xs text-gray-500">Visitors</div>
                                    </div>
                                </div>
                                
                                <!-- Chart -->
                                <div class="bg-gradient-to-br from-primary-50 to-purple-50 rounded-xl p-4 h-40 flex items-end justify-between gap-2">
                                    <div class="bg-primary-400 rounded-lg w-full h-16"></div>
                                    <div class="bg-primary-500 rounded-lg w-full h-24"></div>
                                    <div class="bg-primary-300 rounded-lg w-full h-20"></div>
                                    <div class="bg-primary-600 rounded-lg w-full h-32"></div>
                                    <div class="bg-primary-500 rounded-lg w-full h-28"></div>
                                    <div class="bg-primary-700 rounded-lg w-full h-36"></div>
                                </div>
                            </div>
                            
                            <!-- Floating Cards -->
                            <div class="absolute -top-4 -right-4 bg-white rounded-xl shadow-lg p-4 w-48 border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                        <span class="text-green-600 text-xl">✓</span>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">New Order</div>
                                        <div class="text-sm font-semibold">RM45.00</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="absolute -bottom-4 -left-4 bg-white rounded-xl shadow-lg p-4 w-48 border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 text-xl">📦</span>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Products</div>
                                        <div class="text-sm font-semibold">24 items</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <div class="text-4xl font-bold text-gray-900">5k+</div>
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-blue-400 border-2 border-white"></div>
                                <div class="w-8 h-8 rounded-full bg-purple-400 border-2 border-white"></div>
                                <div class="w-8 h-8 rounded-full bg-pink-400 border-2 border-white"></div>
                            </div>
                        </div>
                        <p class="text-gray-600">Home businesses trust Hantaro to power their online stores</p>
                    </div>
                    
                    <div>
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <div class="text-4xl font-bold text-gray-900">4.9</div>
                            <div class="text-yellow-400 text-2xl">★</div>
                        </div>
                        <p class="text-gray-600">Average rating from our happy sellers worldwide</p>
                    </div>
                    
                    <div>
                        <div class="text-4xl font-bold text-gray-900 mb-2">100%</div>
                        <p class="text-gray-600">User satisfaction with mobile-first experience</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section id="how-it-works" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">How Hantaro Works?</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Start selling online in 3 simple steps — no technical skills needed</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold mb-6">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Create Your Store</h3>
                        <p class="text-gray-600 mb-6">Sign up in seconds and customize your store with your brand name and colors</p>
                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                            <div class="text-sm text-gray-700 font-mono">hantaro.my/yourstore</div>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold mb-6">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Add Your Products</h3>
                        <p class="text-gray-600 mb-6">Upload photos, set prices, and add descriptions — as simple as posting on social media</p>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="aspect-square rounded-lg bg-gradient-to-br from-purple-100 to-pink-100"></div>
                            <div class="aspect-square rounded-lg bg-gradient-to-br from-blue-100 to-purple-100"></div>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center text-white text-2xl font-bold mb-6">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Share & Start Selling</h3>
                        <p class="text-gray-600 mb-6">Share your store link on WhatsApp, Instagram, or Facebook and start receiving orders</p>
                        <div class="flex gap-2">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                <span class="text-green-600 font-bold">W</span>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-pink-100 flex items-center justify-center">
                                <span class="text-pink-600 font-bold">I</span>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 font-bold">F</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Storefront Preview -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Beautiful Mobile-First Stores</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Your customers get a seamless shopping experience on any device</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Store Home -->
                    <div class="bg-gray-50 rounded-2xl p-6 border-2 border-gray-200">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="bg-gradient-to-r from-primary-500 to-purple-500 p-6 text-white">
                                <h3 class="text-lg font-bold mb-1">Sarah's Bakery 🍰</h3>
                                <p class="text-sm opacity-90">Homemade with love</p>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="aspect-square rounded-lg bg-gradient-to-br from-orange-200 to-red-200"></div>
                                    <div class="aspect-square rounded-lg bg-gradient-to-br from-pink-200 to-purple-200"></div>
                                    <div class="aspect-square rounded-lg bg-gradient-to-br from-yellow-200 to-orange-200"></div>
                                    <div class="aspect-square rounded-lg bg-gradient-to-br from-green-200 to-teal-200"></div>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-sm text-gray-600 mt-4 font-medium">Product Grid</p>
                    </div>
                    
                    <!-- Product Detail -->
                    <div class="bg-gray-50 rounded-2xl p-6 border-2 border-gray-200">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="aspect-square bg-gradient-to-br from-purple-200 to-pink-200"></div>
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 mb-1">Chocolate Cake</h4>
                                <div class="text-2xl font-bold text-primary-600 mb-3">RM45</div>
                                <div class="flex gap-2 mb-3">
                                    <div class="px-3 py-1 rounded-full bg-gray-100 text-xs">500g</div>
                                    <div class="px-3 py-1 rounded-full bg-gray-100 text-xs">Fresh</div>
                                </div>
                                <button class="w-full py-2.5 rounded-lg bg-primary-600 text-white font-semibold text-sm">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                        <p class="text-center text-sm text-gray-600 mt-4 font-medium">Product Detail</p>
                    </div>
                    
                    <!-- Checkout -->
                    <div class="bg-gray-50 rounded-2xl p-6 border-2 border-gray-200">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-4">
                            <h4 class="font-bold text-gray-900 mb-4">Checkout</h4>
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-semibold">RM45.00</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Delivery</span>
                                    <span class="font-semibold">RM5.00</span>
                                </div>
                                <div class="border-t pt-3 flex justify-between">
                                    <span class="font-bold">Total</span>
                                    <span class="font-bold text-primary-600">RM50.00</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="p-3 rounded-lg border-2 border-primary-500 bg-primary-50 text-center text-sm font-medium">
                                    💳 Online Banking
                                </div>
                                <div class="p-3 rounded-lg border border-gray-200 text-center text-sm">
                                    📱 DuitNow
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-sm text-gray-600 mt-4 font-medium">Checkout Preview</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Everything You Need to Sell Online</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Powerful features designed for home business owners</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="feature in features" 
                        :key="feature.title"
                        class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow"
                    >
                        <div :class="`w-12 h-12 rounded-xl ${feature.bgColor} flex items-center justify-center text-2xl mb-4`">
                            {{ feature.icon }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ feature.title }}</h3>
                        <p class="text-gray-600">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Who It's For -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Perfect For Every Home Business</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join thousands of entrepreneurs selling online with Hantaro</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div 
                        v-for="audience in targetAudience" 
                        :key="audience.title"
                        class="text-center p-6"
                    >
                        <div :class="`w-20 h-20 rounded-2xl ${audience.bgColor} flex items-center justify-center text-4xl mx-auto mb-4`">
                            {{ audience.icon }}
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">{{ audience.title }}</h3>
                        <p class="text-sm text-gray-600">{{ audience.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Flexible Plans for Every E-Commerce</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Start free, upgrade as you grow — no hidden fees</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div 
                        v-for="(plan, index) in pricingPlans" 
                        :key="plan.name"
                        :class="[
                            'bg-white rounded-2xl p-8 shadow-sm',
                            plan.popular ? 'border-2 border-primary-500 relative transform scale-105 shadow-xl' : 'border-2 border-gray-200'
                        ]"
                    >
                        <div v-if="plan.popular" class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <span class="bg-gradient-to-r from-primary-600 to-purple-600 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
                        </div>
                        <div :class="['text-sm font-semibold mb-2', plan.popular ? 'text-primary-600' : 'text-gray-600']">{{ plan.name }}</div>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-gray-900">RM{{ plan.price }}</span>
                            <span class="text-gray-600">/{{ plan.period }}</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li 
                                v-for="feature in plan.features" 
                                :key="feature"
                                class="flex items-start gap-2 text-sm"
                            >
                                <span class="text-green-500 mt-0.5">✓</span>
                                <span :class="feature.includes('Everything') ? 'font-medium' : ''">{{ feature }}</span>
                            </li>
                        </ul>
                        <button 
                            @click="handlePlanClick(plan.name)"
                            :class="[
                                'w-full py-3 rounded-xl font-semibold transition',
                                plan.popular 
                                    ? 'bg-primary-600 text-white hover:bg-primary-700' 
                                    : 'border-2 border-gray-300 text-gray-700 hover:bg-gray-50'
                            ]"
                        >
                            {{ plan.buttonText }}
                        </button>
                    </div>
                </div>
                
                <div class="text-center mt-12">
                    <p class="text-sm text-gray-600">All plans include 14-day free trial • No credit card required • Cancel anytime</p>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                </div>
                
                <div class="space-y-4">
                    <details 
                        v-for="faq in faqs" 
                        :key="faq.question"
                        class="bg-gray-50 rounded-xl p-6 border border-gray-200 group"
                    >
                        <summary class="font-semibold text-gray-900 cursor-pointer list-none flex items-center justify-between">
                            <span>{{ faq.question }}</span>
                            <span class="text-primary-600 group-open:rotate-180 transition-transform">+</span>
                        </summary>
                        <p class="text-gray-600 mt-4">{{ faq.answer }}</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-primary-600 to-purple-600 text-white">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">Start Your Home Business Today</h2>
                <p class="text-lg opacity-90 mb-8 max-w-2xl mx-auto">Join 5,000+ home entrepreneurs who trust Hantaro to power their online stores. No credit card required.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6">
                    <input 
                        v-model="ctaEmail" 
                        type="email" 
                        placeholder="Enter your email" 
                        class="px-6 py-4 rounded-xl border-0 focus:outline-none focus:ring-2 focus:ring-white w-full sm:w-80 text-gray-900"
                    >
                    <button 
                        @click="handleCreateStore"
                        class="px-8 py-4 rounded-xl bg-white text-primary-600 font-bold hover:bg-gray-100 transition-all w-full sm:w-auto"
                    >
                        Create My Store
                    </button>
                </div>
                
                <p class="text-sm opacity-75">Free forever • No credit card required • Setup in 5 minutes</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <!-- Brand -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold text-lg">
                                H
                            </div>
                            <span class="text-xl font-bold text-white">Hantaro</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">Empowering home businesses to sell online — easily and affordably.</p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition">
                                <span class="text-lg">f</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition">
                                <span class="text-lg">𝕏</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition">
                                <span class="text-lg">in</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Product -->
                    <div>
                        <h4 class="font-bold text-white mb-4">Product</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#features" class="hover:text-white transition">Features</a></li>
                            <li><a href="#pricing" class="hover:text-white transition">Pricing</a></li>
                            <li><a href="#" class="hover:text-white transition">Example Stores</a></li>
                            <li><a href="#" class="hover:text-white transition">Success Stories</a></li>
                        </ul>
                    </div>
                    
                    <!-- Company -->
                    <div>
                        <h4 class="font-bold text-white mb-4">Company</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">About Hantaro</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition">Careers</a></li>
                            <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        </ul>
                    </div>
                    
                    <!-- Support -->
                    <div>
                        <h4 class="font-bold text-white mb-4">Support</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Bottom Bar -->
                <div class="border-t border-gray-800 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-sm text-gray-400">© 2025 Hantaro. All rights reserved.</p>
                        <div class="flex gap-6 text-sm">
                            <a href="#" class="hover:text-white transition">Privacy</a>
                            <a href="#" class="hover:text-white transition">Terms</a>
                            <a href="#" class="hover:text-white transition">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

// Reactive state
const email = ref('')
const ctaEmail = ref('')

// Features data
const features = [
    {
        icon: '🔗',
        bgColor: 'bg-blue-100',
        title: 'Personal Store Link',
        description: 'Get your own custom link like hantaro.my/yourname to share everywhere'
    },
    {
        icon: '📦',
        bgColor: 'bg-purple-100',
        title: 'Product Management',
        description: 'Add unlimited products with photos, prices, variants, and stock tracking'
    },
    {
        icon: '💳',
        bgColor: 'bg-green-100',
        title: 'Accept Payments',
        description: 'FPX online banking, DuitNow QR, or manual bank transfer — your choice'
    },
    {
        icon: '📱',
        bgColor: 'bg-pink-100',
        title: 'WhatsApp Integration',
        description: 'Get instant order notifications via WhatsApp — perfect for your workflow'
    },
    {
        icon: '📊',
        bgColor: 'bg-yellow-100',
        title: 'Sales Dashboard',
        description: 'Track orders, revenue, and top products all in one simple dashboard'
    },
    {
        icon: '📲',
        bgColor: 'bg-red-100',
        title: 'Mobile Optimized',
        description: 'Your store looks perfect on phones, tablets, and desktop — tested by real users'
    }
]

// Target audience data
const targetAudience = [
    {
        icon: '🧁',
        bgColor: 'bg-gradient-to-br from-orange-100 to-red-100',
        title: 'Home Bakers',
        description: 'Sell cakes, cookies, and treats with beautiful product galleries'
    },
    {
        icon: '👗',
        bgColor: 'bg-gradient-to-br from-blue-100 to-purple-100',
        title: 'Online Sellers',
        description: 'Fashion, accessories, gadgets — showcase your products professionally'
    },
    {
        icon: '📦',
        bgColor: 'bg-gradient-to-br from-green-100 to-teal-100',
        title: 'Dropshippers',
        description: 'Manage inventory and orders without holding physical stock'
    },
    {
        icon: '💼',
        bgColor: 'bg-gradient-to-br from-pink-100 to-purple-100',
        title: 'Digital Creators',
        description: 'Sell e-books, templates, courses, and digital downloads'
    }
]

// Pricing plans data
const pricingPlans = [
    {
        name: 'Free Plan',
        price: '0',
        period: 'forever',
        popular: false,
        buttonText: 'Start Free',
        features: [
            'Personal store link',
            'Up to 10 products',
            'Basic order management',
            'WhatsApp notifications'
        ]
    },
    {
        name: 'Starter Plan',
        price: '29',
        period: 'month',
        popular: true,
        buttonText: 'Get Started',
        features: [
            'Everything in Free, plus:',
            'Unlimited products',
            'Custom domain support',
            'Online payment (FPX)',
            'Sales analytics'
        ]
    },
    {
        name: 'Growth Plan',
        price: '49',
        period: 'month',
        popular: false,
        buttonText: 'Get Started',
        features: [
            'Everything in Starter, plus:',
            'Priority support',
            'Advanced analytics',
            'Marketing tools',
            'API access'
        ]
    }
]

// FAQ data
const faqs = [
    {
        question: 'Is there a free trial available?',
        answer: 'Yes! Our Free plan is free forever with up to 10 products. You can also try our paid plans free for 14 days with no credit card required.'
    },
    {
        question: 'Do I need technical skills to use Hantaro?',
        answer: 'Not at all! Hantaro is designed for non-technical users. If you can use WhatsApp or Instagram, you can use Hantaro. Everything is point-and-click simple.'
    },
    {
        question: 'What platforms can I integrate with?',
        answer: 'Hantaro works great with WhatsApp, Instagram, Facebook, TikTok, and any platform where you can share links. Your store is mobile-optimized for social media sharing.'
    },
    {
        question: 'How often is the data updated?',
        answer: 'Your sales dashboard updates in real-time. Every order, payment, and product change is reflected instantly so you\'re always up to date.'
    }
]

// Methods
const handleStartFree = () => {
    console.log('Start free clicked with email:', email.value)
    // Add your registration logic here
}

const handleCreateStore = () => {
    console.log('Create store clicked with email:', ctaEmail.value)
    // Add your registration logic here
}

const handlePlanClick = (planName) => {
    console.log('Plan clicked:', planName)
    // Add your plan selection logic here
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

* {
    font-family: 'Inter', sans-serif;
}

.glass-effect {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}

.bg-clip-text {
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Custom Tailwind-like colors */
:root {
    --primary-50: #f0f4ff;
    --primary-100: #e0e9ff;
    --primary-200: #c7d6fe;
    --primary-300: #a5bbfc;
    --primary-400: #8197f8;
    --primary-500: #6366f1;
    --primary-600: #5855e6;
    --primary-700: #4c42cb;
    --primary-800: #3f37a4;
    --primary-900: #373482;
}

.text-primary-600 {
    color: var(--primary-600);
}

.bg-primary-50 {
    background-color: var(--primary-50);
}

.bg-primary-100 {
    background-color: var(--primary-100);
}

.bg-primary-300 {
    background-color: var(--primary-300);
}

.bg-primary-400 {
    background-color: var(--primary-400);
}

.bg-primary-500 {
    background-color: var(--primary-500);
}

.bg-primary-600 {
    background-color: var(--primary-600);
}

.bg-primary-700 {
    background-color: var(--primary-700);
}

.hover\:bg-primary-50:hover {
    background-color: var(--primary-50);
}

.hover\:bg-primary-700:hover {
    background-color: var(--primary-700);
}

.border-primary-500 {
    border-color: var(--primary-500);
}

.from-primary-500 {
    --tw-gradient-from: var(--primary-500);
}

.from-primary-600 {
    --tw-gradient-from: var(--primary-600);
}

.to-primary-700 {
    --tw-gradient-to: var(--primary-700);
}

.focus\:ring-primary-500:focus {
    --tw-ring-color: var(--primary-500);
}
</style>