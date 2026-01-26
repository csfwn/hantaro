<template>
    <div class="min-h-screen bg-white text-gray-900 font-inter">
        <!-- Hero Section -->
        <section
            class="px-4 py-14 md:px-16 lg:px-32 md:px-16 lg:px-32 md:px-16 lg:px-32 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1">
                <h1 class="text-3xl md:text-6xl font-extrabold leading-tight">
                    Hantaro — <span class="text-primary-600">Penghantaran Makanan Ke Pintu Unit Anda</span>
                </h1>
                <span class="mt-4 text-lg text-gray-600 max-w-xl">
                    Platform penghantaran makanan pantas & mudah terus ke pintu unit anda. Order dari restoran
                    kegemaran — <span class="font-semibold italic">kami hantar! 🚀</span>
                </span>
                <div class="mt-8">
                    <Link href="/products"
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100 transition">
                        Order Sekarang
                    </Link>
                </div>
            </div>

            <!-- Right Image -->
            <div class="flex-1 flex justify-center">
                <img src="/images/landing.svg" alt="Delivery Hero" class="w-70 md:w-[420px] drop-shadow-xl">
            </div>
        </section>

        <!-- Features Section -->
        <section class="bg-gray-50 px-4 py-14 md:px-16 lg:px-32 md:px-16 lg:px-32">
            <h2 class="text-3xl font-bold text-center">Kenapa Pilih Hantaro Untuk Makanan Anda?</h2>
            <p class="text-center text-gray-600 mt-2 mb-12">Cara paling senang untuk order makanan tanpa stress</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <img src="/images/fast.svg" class="h-20 mb-4 mx-auto block" />
                    <h3 class="text-xl font-bold mb-2">Penghantaran Pantas</h3>
                    <p class="text-gray-600">Rider kami bersedia mengambil & menghantar pesanan anda dalam masa yang
                        singkat.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <img src="/images/trust.svg" class="h-20 mb-4 mx-auto block" />
                    <h3 class="text-xl font-bold mb-2">Selamat & Dipercayai</h3>
                    <p class="text-gray-600">Setiap penghantaran dipantau & direkodkan untuk keselamatan maksimum.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <img src="/images/money.svg" class="h-20 mb-4 mx-auto block" />
                    <h3 class="text-xl font-bold mb-2">Harga Berpatutan</h3>
                    <p class="text-gray-600">Caj penghantaran yang kompetitif & telus tanpa caj tersembunyi.</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="px-6 py-20 md:px-16 lg:px-32 text-center">
            <h2 class="text-3xl md:text-4xl font-bold">Sedia Untuk Bermula?</h2>
            <p class="text-gray-600 mt-3 mb-8">
                Tingkatkan penghantaran bisnes anda dengan platform Hantaro.
            </p>
            <!-- <Link href="/register"
                class="px-10 py-4 rounded-xl bg-primary-600 text-white text-lg font-semibold hover:bg-primary-700 transition">
                Daftar Sekarang
            </Link> -->
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 px-6 py-10 md:px-16 lg:px-32">
            <div class="flex flex-col md:flex-row justify-between">
                <p>© 2025 Hantaro. All rights reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <Link href="/privacy">Privasi</Link>
                    <Link href="/terms">Terma</Link>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<style>
@import url('https://rsms.me/inter/inter.css');
</style>
