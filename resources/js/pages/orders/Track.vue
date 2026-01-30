<script setup lang="ts">
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps<{
    order: any
}>()

/**
 * OrderStatus enum mirror
 * Processing = 0
 * Completed  = 1
 * Delivering = 2
 */
const OrderStatus = {
    Processing: 0,
    Completed: 1,
    Delivering: 2,
}

/**
 * Timeline steps (UI order)
 */
const steps = [
    {
        key: OrderStatus.Processing,
        label: 'Processing',
        // description: 'Warehouse, Mirpur 12, Dhaka',
    },
    {
        key: OrderStatus.Delivering,
        label: 'Out of Delivery',
        description: 'On the way',
    },
    {
        key: OrderStatus.Completed,
        label: 'Delivered',
        description: props.order.customer_address,
    },
]

/**
 * Determine current step
 */
const currentIndex = computed(() => {
    if (props.order.data?.status?.value === OrderStatus.Completed) return 3
    if (props.order.data?.status?.value === OrderStatus.Delivering) return 1
    return 0
})

const products = computed(() => props.order.data?.products ?? [])

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
</script>

<template>
    <div class="min-h-screen bg-gray-100 px-4 py-6">

        <!-- Header -->
        <div class="flex items-center mb-4">
            <h1 class="flex-1 text-center font-semibold text-lg">
                Jejak Tempahan
            </h1>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-xl p-4 mb-3">
            <h2 class="font-medium mb-2">
                Maklumat Tempahan
            </h2>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama:</span>
                    <span class="font-medium">{{ order.data?.customer_name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Alamat:</span>
                    <span class="font-medium text-right">
                        {{ order.data?.customer_address }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Tempahan ID:</span>
                    <span class="font-medium">{{ order.data?.ref_no }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Status Pembayaran:</span>
                    <span class="font-medium text-green-600">
                        {{ order.data?.payment_status?.description }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Status Tempahan:</span>
                    <span class="font-medium text-yellow-500">
                        {{ steps[currentIndex].label }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Tarkih:</span>
                    <span class="font-medium">
                        {{ formatMalaysiaDateTime(order.data?.created_at) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 mb-3">
            <h2 class="font-medium">
                Produk Ditempah
            </h2>

            <div v-for="item in products" :key="item.id"
                class="flex justify-between items-start py-3 border-b last:border-b-0">
                <div class="flex-1 text-sm">
                    <span class="font-medium text-gray-900">
                        {{ item.name }}
                    </span>
                    <p class="text-gray-500">
                        Kuantiti: {{ item.quantity }}
                    </p>
                    <p class="text-gray-500">
                        Harga: RM {{ Number(item.price).toFixed(2) }}
                    </p>
                </div>

                <div class="text-right text-sm">
                    <p class="font-medium text-gray-900">
                        RM {{ Number(item.subtotal).toFixed(2) }}
                    </p>
                </div>
            </div>

            <!-- Total -->
            <div class="flex justify-between pt-4 text-sm">
                <span class="text-gray-600">Jumlah Keseluruhan</span>
                <span class="font-semibold text-gray-900">
                    RM {{ Number(order.data?.total_amount).toFixed(2) }}
                </span>
            </div>
        </div>


        <!-- Tracking Timeline -->
        <div class="bg-white rounded-xl p-4 mb-6">
            <div v-for="(step, index) in steps" :key="step.label"
                class="flex items-start gap-3 relative pb-6 last:pb-0">
                <!-- Dot -->
                <div :class="[
                    'w-5 h-5 rounded-full flex items-center justify-center mt-1',
                    index <= currentIndex
                        ? 'bg-black text-white'
                        : 'bg-gray-200'
                ]">
                    <span v-if="index <= currentIndex" class="text-xs">✓</span>
                </div>

                <!-- Line -->
                <div v-if="index < steps.length - 1" class="absolute left-2.5 top-6 w-px h-full"
                    :class="index < currentIndex ? 'bg-black' : 'bg-gray-200'" />

                <!-- Content -->
                <div>
                    <p class="font-medium">{{ step.label }}</p>
                    <p class="text-xs text-gray-500">
                        {{ step.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* intentionally minimal */
</style>
