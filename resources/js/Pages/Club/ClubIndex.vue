<template>
    <Head :title="$t('pages.club')" />
	
    <section class="p-6 font-play">
        <h6 class="header_68">{{ $t('pages.club') }}</h6>
        <MenuTabs :tabs="tabs"
                  :model="MODEL"
                  :tab_selected="tab_selected"
                  @update_selected="updateSelected"/>

        <ClubTeams :teams="club.teams"
                   v-if="tab_selected === 1" />

        <ClubHistory :club="club"
                     v-if="tab_selected === 2"/>

        <ClubPartners v-if="tab_selected === 3" />

        <BookAppointment :teams="club.teams"
                         v-if="tab_selected === 5"/>

    </section>
</template>
<script setup>
import {Head} from '@inertiajs/vue3';
import MenuTabs from '@/Components/MenuTabs.vue';
import {useI18n} from 'vue-i18n';
import {onMounted, ref} from 'vue';
import ClubTeams from '@/Pages/Club/Components/ClubTeams.vue';
import ClubHistory from '@/Pages/Club/Components/ClubHistory.vue';
import ClubPartners from '@/Pages/Club/Components/ClubPartners.vue';
import {defineTab} from '@/Pages/Shared/helpers.js';
import BookAppointment from '@/Pages/Team/Components/BookAppointment.vue';

const props = defineProps(['club','defined_tab']);
const {t} = useI18n();
const tabs = [
    {id: 2, name: t('tabs.history'), show: true, route: 'club.history'},
    {id: 1, name: t('tabs.all_teams'), show: true, route: 'club.teams'},
    {id: 5, name: t('tabs.book_appointment'), show: true, route: 'club.book_appointment', props: props.team},
    // {id: 3, name: t('tabs.partners'), show: true, route: 'club.partners'},
];
let tab_selected = ref(2);
function updateSelected(e) {
    tab_selected.value = e.id;
}
const MODEL = 'Club';

onMounted(() => {
    tab_selected.value = defineTab(tabs, props.defined_tab);
});
</script>
