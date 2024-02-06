<template>
    <section class="my-16">
        <Swiper :pagination="{
                    clickable: true,
                }"
                :effect="'fade'"
                :slides-per-view="1"
                :autoplay="{
                    delay: 2200,
                }"
                :modules="modules"
                :navigation="true"
                :spaceBetween="24"
                class="mySwiper">
		
            <SwiperSlide v-for="(element, index) in images"
                         :key="index">
                <article class="md:flex block text_ld">
                    <div class="w-[100%] overflow-hidden rounded-[6px] bg-gray-100 shadow">
                        <img :src="element"
                             alt="image"
                             class="w-[100%] h-auto object-cover">
                    </div>
                </article>
		
            </SwiperSlide>
        </Swiper>
    </section>
</template>
<script setup>
import {Swiper, SwiperSlide} from 'swiper/vue';
import { EffectFade, Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css';
const modules = [EffectFade, Navigation, Pagination, Autoplay];

const images = [
    '/img/presentation/01.svg',
    '/img/presentation/02.svg',
    '/img/presentation/03.svg',
    '/img/presentation/04.svg',
    '/img/presentation/05.svg',
    '/img/presentation/06.svg',
    '/img/presentation/07.svg',
    '/img/presentation/08.svg',
    '/img/presentation/09.svg',
    '/img/presentation/10.svg',
    '/img/presentation/11.svg',
    '/img/presentation/12.svg',
    '/img/presentation/13.svg',
    '/img/presentation/14.svg',
    '/img/presentation/15.svg',
    '/img/presentation/16.svg',
    '/img/presentation/17.svg',
    '/img/presentation/18.svg',
    '/img/presentation/19.svg',
    '/img/presentation/20.svg',
    '/img/presentation/21.svg',
];
</script>