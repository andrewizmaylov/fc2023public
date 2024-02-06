<template>
    <section class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <ElementCard :element="team"
                     v-for="team in teams"
                     :key="team.id"
                     @click="showModel(team, 'teams')"/>
    </section>
</template>
<script setup>
import ElementCard from '@/Pages/Stadium/Components/ElementCard.vue';
import {showModel} from '@/Pages/Shared/helpers.js';
defineProps(['teams']);
</script>