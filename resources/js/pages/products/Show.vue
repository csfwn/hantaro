<script setup lang="ts">
import { ref } from "vue";
import { ArrowLeft, Store } from 'lucide-vue-next';
import StoreLayout from "@/layouts/StoreLayout.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    product: {
        id: number;
        name: string;
        price: number | string;
        main_image_url: string;
        store: {
            name: string;
        };
    };
}>();

// Reactive quantity
const quantity = ref(1);

// Function to update quantity
const updateQuantity = (value: number) => {
    quantity.value = value;
};

const goBack = () => {
    if (history.length > 1) history.back();
    else router.visit('/');
};
</script>

<template>
    <StoreLayout title="Hantaro - View Product">
        <div class="p-2 max-w-lg mx-auto">
            <div class="flex items-center gap-2 mb-3">
                <button @click="goBack" class="p-1 rounded-full hover:bg-gray-100">
                    <ArrowLeft :size="22" />
                </button>
                <h2 @click="goBack" class="text-lg font-semibold">Back</h2>
            </div>
            <img :src="product.data.main_image_url" class="w-full h-64 object-cover rounded-xl" />
            <h1 class="text-2xl font-bold mt-4">{{ product.data.name }}</h1>
            <p class="text-red-600 text-xl font-bold mt-2">RM {{ product.data.price }}</p>

            <div class="flex items-center mt-1 text-sm">
                <span class="text-gray-500">
                    <Store color="gray" :size="16" />
                </span>
                <span class="ml-1 text-gray-500 mr-3">{{ product.data.store?.name }}</span>
                <span class="text-yellow-500 text-base">★</span>
                <span class="ml-1 text-gray-500">4.6</span>
                <span class="ml-3 text-gray-500">86 Reviews</span>
            </div>
            <div class="mt-5">
                <h3 class="text-base font-semibold mb-2">Description</h3>
                <div class="text-base prose prose-sm max-w-none text-gray-700" v-html="product.data.description"></div>
            </div>
        </div>
        <div class="fixed bottom-7 left-0 right-0 bg-white border-t px-6 py-3 shadow-xl">
            <div class="border-gray-200 pb-4 mb-7 flex items-center justify-between">
                <span class="text-lg font-bold">Quantity</span>

                <div class="flex items-center gap-4">

                    <button @click="updateQuantity(Math.max(1, quantity - 1))"
                        class="w-8 h-8 flex items-center  justify-center rounded-full bg-primary text-white font-bold shadow-sm">
                        –
                    </button>

                    <span class="text-base font-bold">
                        {{ quantity }}
                    </span>

                    <button @click="updateQuantity(quantity + 1)"
                        class="w-8 h-8 flex items-center  justify-center rounded-full bg-primary text-white font-bold shadow-sm">
                        +
                    </button>
                </div>
            </div>
        </div>
    </StoreLayout>
</template>
