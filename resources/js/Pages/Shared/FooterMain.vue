<template>
    <footer class="menu_ld border-t text_ld"
            aria-labelledby="footer-heading">
        <h2 id="footer-heading"
            class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6">{{ $t('pages.club') }}</h3>
                            <ul role="list"
                                class="mt-6 space-y-4">
                                <li v-for="item in navigation.club"
                                    :key="item.name">
                                    <span @click="proceedUrl(item)"
                                          class="text-sm leading-6 cursor-pointer opacity-70 hover:opacity-100 duration-75">{{ item.name }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6">{{ $t('pages.partners') }}</h3>
                            <ul role="list"
                                class="mt-6 space-y-4">
                                <li v-for="item in navigation.partners"
                                    :key="item.name">
                                    <span @click="proceedUrl(item)"
                                          class="text-sm leading-6 cursor-pointer opacity-70 hover:opacity-100 duration-75">{{ item.name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6">{{ $t('pages.fans') }}</h3>
                            <ul role="list"
                                class="mt-6 space-y-4">
                                <li v-for="item in navigation.fans"
                                    :key="item.name">
                                    <span @click="proceedUrl(item)"
                                          class="text-sm leading-6 cursor-pointer opacity-70 hover:opacity-100 duration-75">{{ item.name }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="hidden">
                            <h3 class="text-sm font-semibold leading-6">{{ $t('pages.press') }}</h3>
                            <ul role="list"
                                class="mt-6 space-y-4">
                                <li v-for="item in navigation.press"
                                    :key="item.name">
                                    <span @click="proceedUrl(item)"
                                          class="text-sm leading-6 cursor-pointer opacity-70 hover:opacity-100 duration-75">{{ item.name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mt-10 xl:mt-0">
                    <h3 class="text-sm font-semibold leading-6">{{ $t('newsletter') }}</h3>
                    <p class="mt-2 text-sm leading-6 opacity-70">{{ $t('newsletter_text') }}</p>
                    <form class="mt-6 sm:flex sm:max-w-md">
                        <label for="email-address"
                               class="sr-only">Email address</label>
                        <input type="email"
                               name="email-address"
                               id="email-address"
                               autocomplete="email"
                               required=""
                               v-model="form.email"
                               @input="form.errors.email = null"
                               class="w-full min-w-0 appearance-none rounded-md ringed bg-white/5 px-3 py-1 text-base shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-64 sm:text-sm sm:leading-6 xl:w-full"
                               :placeholder="$t('newsletter_placeholder')" />
	                    

                        <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                            <span @click="registerUser"
                                  class="btn_ld btn_main cursor-pointer">{{ $t('newsletter_button') }}</span>
                        </div>
                    </form>
                    <InputError :message="form.errors.email"
                                class="mt-2"/>
                </div>
            </div>
            <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">
                <div class="flex space-x-6 md:order-2">
                    <div v-for="item in navigation.social"
                         @click="proceedUrl(item)"
                         :key="item.name"
                         class="text-gray-500 hover:text-gray-400 cursor-pointer">
                        <span class="sr-only">{{ item.name }}</span>
                        <component :is="item.icon"
                                   class="h-6 w-6"
                                   aria-hidden="true" />
                    </div>
                </div>
                <p class="mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0">
                    &copy; {{ new Date().getFullYear() }} {{ $t('app_name') }}. {{ $t('reserved')}}.
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import {useI18n} from 'vue-i18n';
import { defineComponent, h, ref} from 'vue';
import {Link, router, useForm} from '@inertiajs/vue3';
import {proceedUrl} from '@/Pages/Shared/helpers.js';
import InputError from '@/Components/InputError.vue';

const {t} = useI18n();


const navigation = {
    club: [
        { name: t('tabs.news'), href: 'news.index' },
        { name: t('tabs.all_teams'), href: 'club.teams' },
        { name: t('tabs.book_appointment'), href: 'club.book_appointment' },
        { name: t('tabs.games'), href: 'games.index' },
        { name: t('tabs.history'), href: 'club.history' },
    ],
    partners: [
        { name: t('tabs.partners_presentation'), href: 'club.partners_presentation' },
        { name: t('tabs.catalog'), href: 'club.partners_catalog' },
    ],
    fans: [
        { name: t('pages.merch'), href: 'club.merch_index' },
        { name: t('tabs.fans_info'), href: 'club.fans_info' },
        { name: t('tabs.faq'), href: 'club.faq' },
    ],
    press: [
        { name: 'Claim', href: '#' },
        { name: 'Privacy', href: '#' },
        { name: 'Terms', href: '#' },
        { name: t('tabs.contacts'), href: 'news.index' },
    ],
    social: [
        {
            external: true,
            name: 'tg',
            href: '#',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            d: 'M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM12.4301 8.85954C11.263 9.34501 8.93026 10.3498 5.43201 11.8739C4.86395 12.0998 4.56638 12.3208 4.53929 12.5369C4.49351 12.9021 4.95083 13.0459 5.5736 13.2417C5.65831 13.2684 5.74608 13.296 5.83606 13.3252C6.44876 13.5244 7.27295 13.7574 7.70141 13.7666C8.09007 13.775 8.52385 13.6148 9.00276 13.286C12.2713 11.0796 13.9585 9.96442 14.0644 9.94038C14.1392 9.92342 14.2427 9.90209 14.3129 9.96446C14.3831 10.0268 14.3762 10.1449 14.3687 10.1766C14.3234 10.3698 12.5282 12.0387 11.5992 12.9024C11.3096 13.1716 11.1042 13.3626 11.0622 13.4062C10.9681 13.504 10.8722 13.5964 10.7801 13.6852C10.2109 14.2339 9.78403 14.6454 10.8037 15.3174C11.2938 15.6403 11.6859 15.9074 12.0771 16.1738C12.5043 16.4647 12.9304 16.7549 13.4817 17.1163C13.6222 17.2084 13.7563 17.304 13.887 17.3971C14.3842 17.7516 14.8309 18.07 15.3827 18.0192C15.7034 17.9897 16.0346 17.6882 16.2028 16.789C16.6003 14.6638 17.3817 10.0591 17.5623 8.16158C17.5782 7.99534 17.5583 7.78258 17.5423 7.68918C17.5263 7.59579 17.4929 7.46272 17.3715 7.36421C17.2277 7.24755 17.0058 7.22295 16.9065 7.22469C16.4551 7.23265 15.7627 7.47343 12.4301 8.85954Z',
                        }),
                    ]),
            }),
        },
        {
            external: true,
            name: 'vk',
            href: 'https://vk.com/fczvezdaspb',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M0 11.52C0 6.0894 0 3.37413 1.68707 1.68707C3.37413 0 6.0894 0 11.52 0H12.48C17.9106 0 20.6259 0 22.313 1.68707C24 3.37413 24 6.0894 24 11.52V12.48C24 17.9106 24 20.6259 22.313 22.313C20.6259 24 17.9106 24 12.48 24H11.52C6.0894 24 3.37413 24 1.68707 22.313C0 20.6259 0 17.9106 0 12.48V11.52Z M12.7286 17.2792C7.15272 17.2792 3.97236 13.4954 3.83984 7.19922H6.6329C6.72464 11.8205 8.7837 13.778 10.4147 14.1816V7.19922H13.0447V11.1848C14.6553 11.0133 16.3473 9.19706 16.9181 7.19922H19.5481C19.1098 9.6612 17.2749 11.4774 15.9702 12.2241C17.2749 12.8295 19.3647 14.4136 20.1598 17.2792H17.2648C16.6429 15.3621 15.0937 13.8789 13.0447 13.6771V17.2792H12.7286Z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
        {
            external: true,
            name: 'YouTube',
            href: 'https://www.youtube.com/channel/UC93d8DdjOIyIx_NKJYEod5w',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
    ],
};

let form = useForm({
    email: '',
});
function registerUser() {
    console.log(form.email);
    // form.post(route('subscribe_user'))
    form.post(route('subscribe_user'), {
        // form.put(route(model_route(model.toLowerCase()) + '.update', {slug: form.slug}), {
        errorBag: 'createUser',
        preserveScroll: true,
        onSuccess: () => {
            form.email = '';
        }
    });
}
</script>