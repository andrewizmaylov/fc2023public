<template>
    <Head :title="$t('pages.team')" />
	
    <section class="p-6 font-play">
        <BreadCrumbs :breadcrumbs="breadcrumbs"
                     :element="team"
                     :model="model_route('team')"/>

        <ElementHeader :element="team"
                       :model="MODEL"/>

        <MenuTabs :tabs="tabs"
                  :tab_selected="tab_selected"
                  @update_selected="updateSelected"/>

        <section class="mb-16"
                 v-if="tab_selected === 1">
            <p v-html="team.description"
               class="text_ld opacity-80 px-1"/>
            <CurrentTeam :team="team" />
        </section>
        
        <TeamNewsComponent :team="team"
                           v-if="tab_selected === 2"/>
        
        <TeamGameComponent :team="team"
                           v-if="tab_selected === 3"/>
       


    </section>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {Head} from '@inertiajs/vue3';
import MenuTabs from '@/Components/MenuTabs.vue';
import {onMounted, ref} from 'vue';
import CurrentTeam from '@/Pages/Team/Components/CurrentTeam.vue';
import TeamNewsComponent from '@/Pages/Team/Components/TeamNewsComponent.vue';
import TeamGameComponent from '@/Pages/Team/Components/TeamGameComponent.vue';
import {defineTab} from '@/Pages/Shared/helpers.js';
import ElementHeader from '@/Pages/Shared/ElementHeader.vue';
import {model_route} from '@/Pages/Shared/useForms.js';
import BreadCrumbs from '@/Pages/Shared/BreadCrumbs.vue';

const props = defineProps(['team', 'defined_tab']);
const {t} = useI18n();

const MODEL = 'Team';
const tabs = [
    {id: 1, name: t('tabs.teams'), show: true, route: 'team.members', props: props.team},
    {id: 2, name: t('tabs.news'), show: true, route: 'team.news', props: props.team},
    {id: 3, name: t('tabs.games'), show: true, route: 'team.games', props: props.team},
];
let tab_selected = ref(1);
function updateSelected(e) {
    tab_selected.value = e.id;
}

onMounted(() => {
    tab_selected.value = defineTab(tabs, props.defined_tab);
});

const breadcrumbs = [
    { id: 1, name: t('pages.club'), href: 'club.teams' },
];
</script>