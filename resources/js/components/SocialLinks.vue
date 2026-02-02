<script setup>
defineProps({
  links: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <div v-if="links.length" class="mt-4 flex justify-center gap-4">
    <a
      v-for="(link, i) in links"
      :key="i"
      :href="link.url"
      target="_blank"
      rel="noopener"
      class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow hover:scale-105 transition"
      :title="link.label"
    >
      <!-- WhatsApp (REAL) -->
      <svg
        v-if="link.type === 'whatsapp'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-5 w-5 fill-[#25D366]"
      >
        <path d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.48 0 .16 5.32.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.32-1.65a11.86 11.86 0 005.74 1.46h.01c6.58 0 11.9-5.32 11.9-11.9a11.84 11.84 0 00-3.45-8.43zm-8.46 18.3a9.8 9.8 0 01-4.99-1.37l-.36-.22-3.75.98 1-3.65-.24-.38a9.8 9.8 0 01-1.48-5.24c0-5.4 4.39-9.79 9.82-9.79a9.76 9.76 0 016.92 2.87 9.76 9.76 0 012.87 6.92c0 5.4-4.39 9.79-9.79 9.79zm5.38-7.38c-.29-.15-1.72-.85-1.99-.94-.27-.1-.46-.15-.65.15-.2.29-.75.94-.92 1.14-.17.2-.34.22-.63.07-.29-.15-1.24-.46-2.36-1.47-.87-.77-1.45-1.73-1.62-2.02-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.15-.17.2-.29.29-.48.1-.2.05-.37-.02-.51-.07-.15-.65-1.56-.89-2.14-.24-.58-.48-.5-.65-.51h-.56c-.2 0-.51.07-.78.37-.27.29-1.02.99-1.02 2.41 0 1.41 1.05 2.78 1.19 2.97.15.2 2.07 3.16 5.02 4.43.7.3 1.24.48 1.66.61.7.22 1.33.19 1.83.11.56-.08 1.72-.7 1.97-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.56-.34z"/>
      </svg>

      <!-- Instagram (REAL) -->
      <svg
        v-else-if="link.type === 'instagram'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-5 w-5"
      >
        <defs>
          <linearGradient id="ig" x1="0%" y1="100%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#F58529"/>
            <stop offset="30%" stop-color="#DD2A7B"/>
            <stop offset="60%" stop-color="#8134AF"/>
            <stop offset="100%" stop-color="#515BD4"/>
          </linearGradient>
        </defs>
        <path
          fill="url(#ig)"
          d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.51 4.51 0 0012 7.5zm0 7.3A2.8 2.8 0 1114.8 12 2.81 2.81 0 0112 14.8zM17.25 6.25a1.05 1.05 0 11-1.05-1.05 1.05 1.05 0 011.05 1.05z"
        />
      </svg>

      <!-- TikTok (REAL) -->
      <svg
        v-else-if="link.type === 'tiktok'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-5 w-5 fill-black"
      >
        <path d="M21 8.5c-1.9 0-3.6-.6-5-1.7V15a6 6 0 11-6-6c.3 0 .7 0 1 .1v2.9a3.1 3.1 0 10 2 2.9V2h3c.3 2.3 2 4.1 4 4.5v2z"/>
      </svg>
    </a>
  </div>
</template>
