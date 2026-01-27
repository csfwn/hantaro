<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { CreditCard } from 'lucide-vue-next'

const props = defineProps<{
    order: any
}>();

const done = () => {
    router.visit('/products');
};

// Format datetime to Malaysia timezone
const formatMalaysiaDateTime = (dateString: string) => {
    const date = new Date(dateString);

    // Format to Malaysia timezone (GMT+8)
    const options: Intl.DateTimeFormatOptions = {
        timeZone: 'Asia/Kuala_Lumpur',
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    };

    const formatter = new Intl.DateTimeFormat('en-GB', options);
    const formatted = formatter.format(date);

    // Get AM/PM
    const hour = date.toLocaleString('en-US', {
        timeZone: 'Asia/Kuala_Lumpur',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    });

    return `${formatted.split(',')[0]} ${hour}`;
};

const payAgain = () => {
  router.visit(`/checkout/pay-again/${props.order.id}`);
};
</script>

<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Success/Failed Icon -->
            <div class="flex justify-center mb-6 mt-5">
                <div :class="[
                    'w-12 h-12 rounded-full flex items-center justify-center',
                    props.order.payment_status === 'PAID' || props.order.payment_status === 1
                        ? 'bg-green-500'
                        : 'bg-red-500'
                ]">
                    <svg v-if="props.order.payment_status === 'PAID' || props.order.payment_status === 1"
                        class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg v-else class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Success/Failed Message -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">
                    {{ props.order.payment_status === 'PAID' || props.order.payment_status === 1 ? 'Pembayaran Berjaya'
                        : 'Pembayaran Gagal' }}
                </h1>
                <p class="text-sm text-gray-600">
                    {{ props.order.payment_status === 'PAID' || props.order.payment_status === 1
                        ? 'Langganan anda telah berjaya diperbaharui.'
                        : 'Pembayaran anda tidak berjaya. Sila cuba lagi.'
                    }}
                </p>
            </div>

            <!-- Payment Details Card -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                <!-- Order Header -->
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">#{{ props.order.ref_no }}</h2>
                </div>

                <!-- Products List -->
                <div class="space-y-3 pb-5 border-b border-gray-100">
                    <div v-for="product in props.order.products" :key="product.id"
                        class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">{{ product.name }}</p>
                            <p class="text-gray-600 text-sm">{{ product.quantity }}x RM {{ product.price }}</p>
                        </div>
                        <span class="text-gray-900 font-medium">RM {{ product.subtotal }}</span>
                    </div>
                </div>

                <!-- Price Breakdown -->
                <div class="space-y-3 pb-2 border-b border-gray-100">
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-900 font-semibold text-lg">Jumlah</span>
                        <span class="text-gray-900 font-semibold text-lg">RM {{ props.order.total_amount }}</span>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div class="space-y-3 pt-5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Pelanggan</span>
                        <span class="text-gray-900 text-sm font-medium">{{ props.order.customer_name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Email</span>
                        <span class="text-gray-900 text-sm font-medium">{{ props.order.customer_email }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Telefon</span>
                        <span class="text-gray-900 text-sm font-medium">{{ props.order.customer_phone }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Alamat</span>
                        <span class="text-gray-900 text-sm font-medium text-right">{{ props.order.customer_address
                            }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Tarikh</span>
                        <span class="text-gray-900 text-sm font-medium">{{
                            formatMalaysiaDateTime(props.order.created_at) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Rujukan Pembayaran</span>
                        <span class="text-gray-900 text-sm font-medium">{{ props.order.ref_no }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button v-if="props.order.payment_status === 0"
                    @click="payAgain"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3.5 rounded-xl font-medium transition-colors flex items-center justify-center gap-2">
                    <CreditCard size="20"/>
                    Bayar Semula
                </button>
                <button
                    class="w-full bg-gray-900 hover:bg-gray-800 text-white py-3.5 rounded-xl font-medium transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Muat Turun Resit
                </button>
                <button @click="done"
                    class="w-full bg-white hover:bg-gray-50 text-gray-900 py-3.5 rounded-xl font-medium border border-gray-200 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Kedai
                </button>
            </div>
        </div>

    </div>
</template>

<style scoped>
/* Custom animations can be added here if needed */
</style>