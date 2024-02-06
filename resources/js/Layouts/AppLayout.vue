<script setup>
import { Head } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import AppNavigation from '@/Layouts/AppNavigation.vue';
import ThemeWrapper from '@/Layouts/ThemeWrapper.vue';
import FooterMain from '@/Pages/Shared/FooterMain.vue';
import SponsorMain from '@/Layouts/SponsorMain.vue';

defineProps({
    title: String,
});
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />
        <ThemeWrapper/>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <AppNavigation />
            <!-- Page Heading -->
            <header v-if="$slots.header"
                    class="bg_ld_frame shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="lg:py-12 md:py-8 sm:py-4 py-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg_ld_frame overflow-hidden shadow-xl sm:rounded-lg">
                        <slot />
                    </div>
                </div>
            </main>
	        
            <SponsorMain />
	        
            <FooterMain />
        </div>
    </div>
</template>
