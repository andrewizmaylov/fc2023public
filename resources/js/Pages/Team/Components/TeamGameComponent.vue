<template>
    <section class="grid grid-cols-2 gap-4"
             v-if="show_section">
        <GameCard  v-for="game in games"
                   :key="game.id"
                   :input="game"/>
    </section>
</template>
<script setup>
import {ref, onMounted} from 'vue';
import GameCard from '@/Pages/Game/Components/GameCard.vue';

const props = defineProps(['team']);

let games = ref([]);
let show_section = ref(false);
function getTeamGames() {
    axios.post(route('games_by_team'), {
        team_id: props.team.id,
    }).then(response => {
        console.log(response.data);
        games.value = response.data;
        show_section.value = true;
    });
}

onMounted(() => {
    getTeamGames();
});
</script>