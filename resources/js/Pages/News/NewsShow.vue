<template>
    <section class="text_ld font-play flex space-x-4 p-6">
        <section class="md:w-3/4 w-full">
            <BreadCrumbs :breadcrumbs="breadcrumbs"
                         :element="news"
                         :model="'News'"/>
	        
            <div class="w-full ringed rounded overflow-hidden mb-4 mt-6">
                <img class="w-full h-full object-center"
                     :src="news.image_url"
                     alt="image">
            </div>
            <h6 class="text_12 mb-1">{{ getHumanDate(news) }}</h6>
            <h3 class="header_34 font-semibold">{{ news.name }}</h3>
            <p class="header_21">{{ news.description }}</p>
            <div v-html="output" />
        </section>
        <section class="md:w-1/3 md:block hidden">
            <h4 class="text-sm font-medium">{{ $t('news_other') }}</h4>
            <div class="border_ld rounded gap-3 cursor-pointer mt-6 p-2 hover:shadow-element shadow"
                 v-for="el in all_news"
                 :key="el.id"
                 @click="showNews(el)">
                <article class="flex items-top">
                    <section class="flex-1 pr-1">
                        <h5 class="text_16 font-semibold opacity-80">{{ el.name }}</h5>
                        <p class="text_14 font-thin opacity-60">{{ el.description }}</p>
                    </section>
                    <div class="h-24 w-24 rounded overflow-hidden shrink-0">
                        <img :src="el.image_url"
                             class="w-full h-full object-cover"
                             alt="image">
                    </div>
                </article>
            </div>
        </section>
    </section>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {computed} from 'vue';
import {router} from '@inertiajs/vue3';
import useNewsComposable from '@/Pages/News/Composables/useDateComposable.js';
import {htmlOutput} from '@/Pages/Utilities/HtmlOutput.js';
import {showNews} from '@/Pages/Shared/helpers.js';
import BreadCrumbs from '@/Pages/Shared/BreadCrumbs.vue';
const {t} = useI18n();
function goBack() {
    router.get(route('news.index'));
}
const props = defineProps(['news', 'all_news']);

let {getHumanDate} = useNewsComposable(props.news);
let output = computed(() => props.news.text ? htmlOutput(props.news.text.schema) : '');

const breadcrumbs = [
    { id: 1, name: t('pages.news'), href: 'news.index' },
];

</script>