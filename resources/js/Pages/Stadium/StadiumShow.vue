<template>
    <section class="p-6 text_ld font-play">
        <BreadCrumbs :breadcrumbs="breadcrumbs"
                     :element="stadium"
                     :model="model_route('stadium')"/>

        <div class="w-full h-[120px] mt-6 ringed rounded overflow-hidden"
             v-if="stadium.banner_url">
            <img :src="stadium.banner_url"
                 alt="banner"
                 class="w-full h-full object-cover">
        </div>

        <h1 class="header_68">{{ stadium.name }}</h1>

        <MenuTabs :tabs="tabs"
                  :tab_selected="tab_selected"
                  @update_selected="updateSelected"/>

        <section v-if="tab_selected === 1">
            <p class="my-4 text_16"
               v-html="stadium.description" />
            <ImageSlider :images="stadium.details.images"
                         v-if="stadium?.details?.images"/>
        </section>
		
        <p class="my-4 text_16 max-w-[800px]"
           v-html="htmlOutput(stadium.text.schema)"
           v-if="tab_selected === 3"/>

        <AddressBlockOutput :input="stadium"
                            v-if="tab_selected === 4"/>
    </section>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {ref} from 'vue';
import MenuTabs from '@/Components/MenuTabs.vue';
import AddressBlockOutput from '@/Pages/Shared/AddressBlockOutput.vue';
import {htmlOutput} from '@/Pages/Utilities/HtmlOutput.js';
import ImageSlider from '@/Pages/Shared/ImageSlider.vue';
import BreadCrumbs from '@/Pages/Shared/BreadCrumbs.vue';
import {model_route} from '@/Pages/Shared/useForms.js';

const {t} = useI18n();
const props = defineProps(['stadium']);

const tabs = ref([
    {id: 1, name: t('tabs.main_info'), show: true},
    {id: 3, name: t('tabs.text'), show: props.stadium?.text?.schema},
    {id: 4, name: t('tabs.address'), show: true},
]);
let tab_selected = ref(1);
function updateSelected(e) {
    tab_selected.value = e.id;
}

const breadcrumbs = [
    { id: 1, name: t('pages.stadium'), href: 'club.stadiums' },
];
</script>