<script setup>
import { computed } from 'vue'
import SocialLinks from '@/components/SocialLinks.vue'

const props = defineProps({
    store: Object,
})

/* =========================
   THEME (SAFE)
========================= */
const theme = computed(() => props.store?.data?.theme || {})
const primaryColor = computed(
    () => theme.value.primary || '#000000'
)

/* IMPORTANT: correct key */
const isImageBg = computed(
    () => theme.value.header_background_type === 'image'
)

/* Resolve storage image → public URL */
const backgroundImageUrl = computed(() => {
    if (!theme.value.background_image) return null

    // If already absolute URL, use as-is
    if (theme.value.background_image.startsWith('http')) {
        return theme.value.background_image
    }

    // Otherwise assume Laravel storage
    return `/storage/${theme.value.background_image}`
})

const headerBgStyle = computed(() => {
    if (isImageBg.value && backgroundImageUrl.value) {
        return {
            backgroundImage: `url(${backgroundImageUrl.value})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center',
        }
    }

    return {
        backgroundColor: theme.value.background_color || '#ffffff',
    }
})

const overlayStyle = computed(() => {
    const opacity = Number(theme.value.background_opacity ?? 0.6)

    return {
        background: `linear-gradient(
      to bottom,
      rgba(0,0,0,${opacity}),
      rgba(0,0,0,${Math.min(opacity + 0.8, 0.9)})
    )`,
    }
})
</script>

<template>
    <div class="min-h-screen bg-gray-100" :style="{
        '--primary': primaryColor,
        '--primary-soft': primaryColor + '22'
    }">

        <!-- STORE HEADER -->
        <div class="relative px-4 py-6 shadow-sm" :style="headerBgStyle">
            <!-- Overlay only when image -->
            <div v-if="isImageBg" class="absolute inset-0" :style="overlayStyle" />

            <!-- CONTENT -->
            <div class="relative z-10 mx-auto max-w-md text-center" :class="isImageBg ? 'text-white' : 'text-gray-900'">
                <!-- LOGO -->
                <img v-if="store.data.store_logo_url" :src="store.data.store_logo_url" class="mx-auto h-24 w-24 rounded-xl object-cover shadow-lg
                 ring-1 ring-white/30" />

                <!-- NAME -->
                <h1 class="mt-4 text-xl font-bold" :class="isImageBg ? 'text-white' : 'text-gray-900'">
                    {{ store.data.name }}
                </h1>
                <!-- DESCRIPTION -->
                <div v-if="store.data.description" v-html="store.data.description" class="mt-2 text-sm"
                    :class="isImageBg ? 'text-gray-200' : 'text-gray-600'" />

                <!-- SOCIAL LINKS -->
                <SocialLinks :links="store.data.links" />
            </div>
        </div>

        <!-- PRODUCTS -->
        <div class="mx-auto max-w-md px-4 py-4">
            <slot />
        </div>
    </div>
</template>
