<template>
    <ComponentHeader :model="model" />
	
    <Swiper :pagination="{
                clickable: true,
            }"
            :autoplay="{
                delay: 2200,
                reverseDirection: false,
                disableOnInteraction: false,
                pauseOnMouseEnter: true, // Autoplay pauses on mouse hover
            }"
            :loop="true"
            :modules="modules"
            :spaceBetween="24"
            class="mySwiper md:h-[350px]">

        <SwiperSlide v-for="element in input"
                     :key="element.id">

            <NewsComponentWithButton :element="element"/>

        </SwiperSlide>
    </Swiper>
</template>
<script setup>
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Autoplay, Navigation, Pagination} from 'swiper/modules';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import 'swiper/css';
import ComponentHeader from '@/Pages/Shared/ComponentHeader.vue';
import NewsComponentWithButton from '@/Pages/News/Components/NewsComponentWithButton.vue';

const modules = [Navigation, Pagination, Autoplay];
defineProps(['input']);
let model = 'News';
const onSwiper = (swiper) => {
    console.log(swiper);
};
const onSlideChange = () => {
    console.log('slide change');
};
</script>

