<template>
    <Head :title="$t('pages.match')" />
	
    <section class="p-6">
        <h1 class="text_68 font-play font-bold opacity-80 uppercase mb-4 text_ld">{{ $t('pages.match') }}</h1>
	
        <div class="grid grid-cols-3 gap-4">
            <section v-for="element in games"
                     :key="element.id">
                <EditElementComponent :model="MODEL"
                                      :element="element"/>
                <GameCard :input="element"/>
            </section>
        </div>
    </section>
</template>
<script setup>
import {Head} from '@inertiajs/vue3';
import GameCard from '@/Pages/Game/Components/GameCard.vue';
import EditElementComponent from '@/Pages/Shared/EditElementComponent.vue';
const props = defineProps(['games']);
const MODEL = 'Game';
</script>