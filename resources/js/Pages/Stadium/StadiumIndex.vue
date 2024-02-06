<template>
    <Head :title="$t('pages.stadium')" />
	
    <section class="p-6 font-play">
        <h6 class="header_68">{{ $t('pages.stadium') }}</h6>
        <MenuTabs :tabs="tabs"
                  :tab_selected="tab_selected"
                  @update_selected="updateSelected"/>
		
        <StadiumsComponent :input="home_stadiums"
                           v-if="tab_selected === 1" />
        
        <StadiumsComponent :input="other_stadiums"
                           v-if="tab_selected === 2" />
       
        <FansInfo v-if="tab_selected === 3" />

        <PartnersInfo v-if="tab_selected === 4" />
    </section>
</template>
<script setup>
import {Head} from '@inertiajs/vue3';
import MenuTabs from '@/Components/MenuTabs.vue';
import {useI18n} from 'vue-i18n';
import {ref, computed, onMounted} from 'vue';
import StadiumsComponent from '@/Pages/Stadium/Components/StadiumsComponent.vue';
import FansInfo from '@/Pages/Stadium/Components/FansInfo.vue';
import PartnersInfo from '@/Pages/Stadium/Components/PartnersInfo.vue';
import {defineTab} from '@/Pages/Shared/helpers.js';

const props = defineProps(['stadiums', 'defined_tab']);
const {t} = useI18n();
const tabs = [
    {id: 1, name: t('tabs.stadiums'), show: true, route: 'club.stadiums'},
    {id: 2, name: t('tabs.stadiums_other'), show: true, route: 'club.stadiums_other'},
    // {id: 4, name: t('tabs.partners'), show: true, route: 'club.stadiums_partners'},
];
let tab_selected = ref(1);
function updateSelected(e) {
    tab_selected.value = e.id;
}

let home_stadiums = computed(() => props.stadiums.filter(row => row.club_id));
let other_stadiums = computed(() => props.stadiums.filter(row => !row.club_id));

onMounted(() => {
    tab_selected.value = defineTab(tabs, props.defined_tab);
});
</script>