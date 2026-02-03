<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import { Download, ArrowLeft } from 'lucide-vue-next'
import { computed } from 'vue'

const props = defineProps<{
    order: any
    message?: string
}>()

const isPaid = computed(() => true) // Always true on success page

const done = () => {
    router.visit(`/store/${props.order?.store?.code}`)
}

// Format datetime to Malaysia timezone
const formatMalaysiaDateTime = (dateString: string) => {
    const date = new Date(dateString)

    const options: Intl.DateTimeFormatOptions = {
        timeZone: 'Asia/Kuala_Lumpur',
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    }

    const formatter = new Intl.DateTimeFormat('en-GB', options)
    const formatted = formatter.format(date)

    const hour = date.toLocaleString('ms-MY', {
        timeZone: 'Asia/Kuala_Lumpur',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    })

    return `${formatted.split(',')[0]} ${hour}`
}

const downloadReceipt = () => {
    window.location.href = `/receipt/${props.order.id}/download`
}
</script>

<template>
    <Head title="Pembayaran Berjaya" />
    
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md">

            <!-- Success Icon -->
            <div class="flex justify-center mb-2 mt-5">
                <div class="w-25 h-25 rounded-full flex items-center justify-center">
                    <img src="/gifs/success.gif" alt="Success" class="w-25 h-25 object-contain" />
                </div>
            </div>

            <!-- Success Message -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">
                    Payment Successful
                </h1>
                <p class="text-sm text-gray-600">
                    {{ message || 'Pesanan anda telah disahkan.' }}
                </p>
            </div>

            <!-- Payment Details Card -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">
                        #{{ order.ref_no }}
                    </h2>
                </div>

                <!-- Products List -->
                <div class="space-y-3 pb-5 border-b border-gray-100">
                    <div v-for="product in order.products" :key="product.id"
                        class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">{{ product.name }}</p>
                            <p class="text-gray-600 text-sm">
                                {{ product.quantity }}x RM {{ Number(product.price).toFixed(2) }}
                            </p>
                        </div>
                        <span class="text-gray-900 font-medium">
                            RM {{ Number(product.subtotal).toFixed(2) }}
                        </span>
                    </div>
                </div>

                <!-- Total -->
                <div class="space-y-3 pb-2 border-b border-gray-100">
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-900 font-semibold text-lg">Total Paid</span>
                        <span class="text-gray-900 font-semibold text-lg">
                            RM {{ Number(order.total_amount).toFixed(2) }}
                        </span>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="space-y-3 pt-5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Name</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ order.customer_name }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Email</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ order.customer_email }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Whatsapp No</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ order.customer_phone }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Address</span>
                        <span class="text-gray-900 text-sm font-medium text-right">
                            {{ order.customer_address }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Date</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ formatMalaysiaDateTime(order.created_at) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Payment ID</span>
                        <span class="text-gray-900 text-sm font-medium text-right">
                            {{ order.payment_gateway_reference || order.ref_no }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Payment status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Dibayar
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button @click="downloadReceipt"
                    class="w-full bg-gray-900 hover:bg-gray-800 text-white py-3.5 rounded-xl font-medium flex items-center justify-center gap-2 transition-colors">
                    <Download :size="20" />
                    Muat Turun Resit
                </button>

                <button @click="done"
                    class="w-full bg-white hover:bg-gray-50 text-gray-900 py-3.5 rounded-xl font-medium border border-gray-200 flex items-center justify-center gap-2 transition-colors">
                    <ArrowLeft :size="20" />
                    Kembali ke Kedai
                </button>
            </div>

        </div>
    </div>
</template>