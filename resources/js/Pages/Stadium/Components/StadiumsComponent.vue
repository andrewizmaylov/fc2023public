<template>
    <section class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <ElementCard :element="stadium"
                     v-for="stadium in input"
                     :key="stadium.id"
                     @click="router.get(route('stadiums.show', {slug: stadium.slug}))"/>
    </section>
</template>
<script setup>
import ElementCard from '@/Pages/Stadium/Components/ElementCard.vue';
import {router} from '@inertiajs/vue3';

defineProps(['input']);
</script>