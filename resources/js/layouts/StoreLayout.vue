<script setup lang="ts">
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { ShoppingCart } from 'lucide-vue-next';

const page = usePage();

// Cart info from backend props
const cartQuantity = computed(() => page.props.cartQuantity || 0);
const cartTotal = computed(() => page.props.cartTotal || 0);

// Store info
const store = computed(() => page.props.store || null);
const showFooter = computed(() => !page.url.includes('/carts/review'));
</script>

<template>
    <div class="bg-gray-100 min-h-screen pb-24">
        <!-- HEADER -->
        <header class="bg-white shadow px-4 py-3 flex items-center justify-between">
            <a href="/products" class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Store Logo" class="w-20 h-20 rounded-full object-cover border" />
                <div class="leading-tight">
                    <h1 class="text-base font-bold text-gray-800">{{ store?.name || 'Manisan Kita' }}</h1>
                    <p class="text-xs text-gray-500">Jom beli manisan dan kudapan tradisional Malaysia!</p>
                </div>
            </a>
        </header>

        <!-- PAGE CONTENT -->
        <main class="p-4">
            <slot />
        </main>

        <!-- FOOTER CART -->
        <footer v-if="showFooter"
            class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t shadow-md p-4 flex justify-between items-center">
            <div class="text-red-600 font-bold text-lg italic">
                RM {{ cartTotal.toFixed(2) }}
            </div>

            <Link :href="cartQuantity > 0 ? route('carts.review') : '#'" :class="[
                'px-5 py-2 rounded-lg font-semibold italic flex items-center gap-2 transition',
                cartQuantity > 0
                    ? 'bg-primary text-white hover:bg-yellow-600'
                    : 'bg-gray-300 text-gray-500 cursor-not-allowed'
            ]" @click.prevent="cartQuantity === 0">
                <ShoppingCart :size="16" />
                Seterusnya ({{ cartQuantity }})
            </Link>
            </footer>
    </div>
</template>
