<template>
    <Head :title="$t('pages.order')" />
	
    <section class="mb-12 p-6 text_ld">
        <h1 class="text_34 font-play font-bold opacity-80 uppercase mb-4">{{ $t('pages.order') }}</h1>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold sm:pl-0">Order ID</th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold">User</th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold">Product</th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold">Status</th>
                                <th scope="col"
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">View order</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="order in orders"
                                :key="order.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium sm:pl-0">{{ order.id }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm opacity-80">{{ order.user.email }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm opacity-80">{{ order.merch.name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm opacity-80">{{ order.status }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <Link :href="route('orders.edit', order)"
                                          class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import {Head, Link} from '@inertiajs/vue3';

defineProps(['orders']);
</script>