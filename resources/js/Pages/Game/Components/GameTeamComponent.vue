<template>
    <section class="space-y-4 w-[95%]">
        <section class="flex items-center lg:space-x-4 md:space-x-2">
            <div class="w-auto h-16 p-1">
                <img class="w-full h-full object-contain shrink-0"
                     :src="team.logo_url"
                     alt="team_logo">
            </div>
            <h4 class="Lg:header_68 header_34">{{ team.name }}</h4>
        </section>

        <PlayerComponent class=""
                         :player="player"
                         v-for="player in players"
                         :key="player.id"/>

    </section>
</template>
<script setup>
import PlayerComponent from '@/Pages/Shared/PlayerComponent.vue';
defineProps(['team', 'players']);
</script>