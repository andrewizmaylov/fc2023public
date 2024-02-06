<template>
    <div class="lg:mb-12 md:mb-8 sm:mb-4 mb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg_ld_frame overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="header_68">{{ $t('league_partners')}}</h3>
                <section class="flex items-center space-x-8 my-4">
                    <img :src="`/img/partners/${partner}_white.png`"
                         :id="partner"
                         class="height_responsive w-auto opacity_90"
                         :alt="partner"
                         v-for="partner in partners"
                         :key="partner">
                </section>
                <h3 class="header_56 mt-12">{{ $t('club_partners')}}</h3>
                <section class="flex items-center justify-between my-4 bg-white p-4 rounded">
                    <img :src="`/img/partners/${partner}.png`"
                         :id="partner"
                         class="height_responsive w-auto opacity_90"
                         :alt="partner"
                         v-for="partner in sponsors"
                         :key="partner">
                </section>
            </div>
        </div>
    </div>
</template>
<script setup>
import {onMounted} from 'vue';
const partners = [
    'sportmaster', 'leon'
];
const sponsors = [
    'vvk', 'givova', 'itnok', 'oof_sz', 'football_spb', 'smena', 'hvalovskye'
];
onMounted(() => {
    Event.on('theme_mode', (state) => {
        if (state) {
            partners.forEach(partner => {
                document.getElementById(partner).src = `/img/partners/${partner}_white.png`;
            });
        } else {
            partners.forEach(partner => {
                document.getElementById(partner).src = `/img/partners/${partner}_black.png`;
            });
        }
    });
});
</script>
<style scoped>
.height_responsive {
	@apply lg:h-[32px] md:h-[26px] sm:h-[20px] h-[16px]
}
</style>