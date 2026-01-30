<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { CreditCard, Download, ArrowLeft } from 'lucide-vue-next'
import { computed } from 'vue'

const props = defineProps<{
    order: any
    gatewayStatus: number
}>()

// ✅ SINGLE SOURCE FOR UI STATE
const isPaid = computed(() => {
    if (props.gatewayStatus === 3) return true
})

const done = () => {
    router.visit('/products')
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

    const hour = date.toLocaleString('en-US', {
        timeZone: 'Asia/Kuala_Lumpur',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    })

    return `${formatted.split(',')[0]} ${hour}`
}

const payAgain = () => {
    router.visit(`/checkout/pay-again/${props.order.id}`)
}

const downloadReceipt = () => {
    window.location.href = `/receipt/${props.order.id}/download`
}

</script>

<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md">

            <!-- Success/Failed Icon -->
            <div class="flex justify-center mb-2 mt-5">
                <div :class="[
                    'w-25 h-25 rounded-full flex items-center justify-center'
                ]">
                    <img v-if="isPaid" src="/gifs/success.gif" alt="Success" class="w-25 h-25 object-contain" />
                    <img v-else src="/gifs/failed.gif" alt="Failed" class="w-18 h-18 object-contain" />
                </div>
            </div>

            <!-- Success/Failed Message -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">
                    {{ isPaid ? 'Pembayaran Berjaya' : 'Pembayaran Gagal' }}
                </h1>
                <p class="text-sm text-gray-600">
                    {{ isPaid
                        ? 'Pesanan anda telah disahkan.'
                        : 'Pembayaran anda tidak berjaya. Sila cuba lagi.'
                    }}
                </p>
            </div>

            <!-- Payment Details Card -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">
                        #{{ props.order.ref_no }}
                    </h2>
                </div>

                <div class="space-y-3 pb-5 border-b border-gray-100">
                    <div v-for="product in props.order.products" :key="product.id"
                        class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">{{ product.name }}</p>
                            <p class="text-gray-600 text-sm">
                                {{ product.quantity }}x RM {{ product.price }}
                            </p>
                        </div>
                        <span class="text-gray-900 font-medium">
                            RM {{ product.subtotal }}
                        </span>
                    </div>
                </div>

                <div class="space-y-3 pb-2 border-b border-gray-100">
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-900 font-semibold text-lg">Jumlah</span>
                        <span class="text-gray-900 font-semibold text-lg">
                            RM {{ props.order.total_amount }}
                        </span>
                    </div>
                </div>

                <div class="space-y-3 pt-5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Pelanggan</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ props.order.customer_name }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Email</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ props.order.customer_email }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Telefon</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ props.order.customer_phone }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Alamat</span>
                        <span class="text-gray-900 text-sm font-medium text-right">
                            {{ props.order.customer_address }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Tarikh</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ formatMalaysiaDateTime(props.order.created_at) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 text-sm">Rujukan Pembayaran</span>
                        <span class="text-gray-900 text-sm font-medium">
                            {{ props.order.ref_no }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button v-if="!isPaid" @click="payAgain"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3.5 rounded-xl font-medium flex items-center justify-center gap-2">
                    <CreditCard size="20" />
                    Bayar Semula
                </button>

                <button v-if="isPaid" @click="downloadReceipt"
                    class="w-full bg-gray-900 hover:bg-gray-800 text-white py-3.5 rounded-xl font-medium flex items-center justify-center gap-2">
                    <Download size="20" />
                    Muat Turun Resit
                </button>

                <button @click="done"
                    class="w-full bg-white hover:bg-gray-50 text-gray-900 py-3.5 rounded-xl font-medium border border-gray-200 flex items-center justify-center gap-2">
                    <ArrowLeft size="20" />
                    Kembali ke Kedai
                </button>
            </div>

        </div>
    </div>
</template>

<style scoped>
/* unchanged */
</style>
