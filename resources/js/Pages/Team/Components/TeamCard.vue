<template>
    <section class="ringed rounded w-full p-6 grid place-items-center bg_contrast h-64">
        <h1 class="text_14 font-play">{{ team.name }}</h1>
    </section>
</template>
<script setup>
defineProps(['team']);
</script>