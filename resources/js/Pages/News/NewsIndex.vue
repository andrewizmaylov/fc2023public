<template>
    <Head :title="$t('pages.news')" />
	
    <section class="p-6">
        <h1 class="text_68 font-play font-bold opacity-80 uppercase mb-4 text_ld">{{ $t('pages.news') }}</h1>

        <div class="w-full space-y-6">
            <section v-for="element in news"
                     :key="element.id">
                <EditElementComponent :model="MODEL"
                                      :element="element"/>
                <NewsComponentWithButton :element="element"/>
            </section>
        </div>
    </section>
</template>
<script setup>
import {Head} from '@inertiajs/vue3';
import NewsComponentWithButton from '@/Pages/News/Components/NewsComponentWithButton.vue';
import EditElementComponent from '@/Pages/Shared/EditElementComponent.vue';
const props = defineProps(['news']);
const MODEL = 'News';
</script>