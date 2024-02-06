<template>
    <section v-if="games.length">
        <ComponentHeader :model="model" />

        <section class="grid gap-4"
                 :class="grid_cols_calculated">
            <GameCard  v-for="game in games.length > 3 ? games.slice(0,3) : games"
                       :key="game.id"
                       :input="game"/>
        </section>
    </section>
</template>
<script setup>
import {computed} from 'vue';
import GameCard from '@/Pages/Game/Components/GameCard.vue';
import ComponentHeader from '@/Pages/Shared/ComponentHeader.vue';

let model = 'Game';
const props = defineProps(['games']);
let grid_cols_calculated = computed(() => {
    let out = 0;
    if (props.games?.length && props.games.length < 3) {
        out = props.games.length;
    }
    if (props.games?.length && props.games.length >= 3) {
        out = 3;
    }

    return 'grid-cols-' + out;
});
</script>