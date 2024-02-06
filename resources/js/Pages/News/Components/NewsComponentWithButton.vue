<template>
    <article class="md:flex block text_ld">
        <div class="md:w-1/2 w-full h-[180px] md:h-[291px] overflow-hidden rounded-[6px] shadow">
            <img :src="element.image_url"
                 alt="news_image"
                 class="w-full h-full object-cover">
        </div>
        <section class="md:w-1/2 w-full md:px-6 md:py-2 p-0 font-play md:flex md:flex-col">
            <h6 class="text_12 mb-1">{{ getHumanDate(element) }}</h6>
            <h1 class="text_34 font-bold opacity-80 mb-3 uppercase"
                data-swiper-parallax="-100">{{ element.name }}</h1>
            <p class="text_16"
               data-swiper-parallax="-200"
               data-swiper-parallax-opacity="0.5">{{ element.description ?? lorem_text }}</p>
			
            <div class="md:mt-auto mt-2">
                <button class="btn_ld btn_main text-xs"
                        @click="showNews(element)">{{ $t('details_button') }}
                </button>
            </div>
        </section>
    </article>
</template>
<script setup>
import {lorem_text, page, showNews} from '@/Pages/Shared/helpers.js';
import useNewsComposable from '@/Pages/News/Composables/useDateComposable.js';

const props = defineProps(['element']);
let {getHumanDate} = useNewsComposable(props.element);

</script>