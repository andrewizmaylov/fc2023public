<template>
    <section class="flex py-6 sm:py-10">
        <div class="flex-shrink-0">
            <img :src="position.image_url ?? '/img/ball.png'"
                 :alt="position.name"
                 class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48" />
        </div>

        <div class="ml-4 flex flex-1 flex-col sm:ml-6">
            <EditElementComponent :model="'Position'"
                                  :element="position"/>
            <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                <div class="inset-0 absolute z-10 cursor-pointer"
                     @click="toggleCheckbox"/>
                <div>
                    <div class="flex justify-between">
                        <h3 class="text-sm font-medium hover_80">
                            {{ position.name }}
                        </h3>
                    </div>
                    <p class="font-medium">{{ product_price(position) }}</p>
                </div>
				
                <div class="mt-4 sm:mt-0 sm:pr-9">
                    <div class="absolute right-0 top-0">
                        <button type="button"
                                class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500">
                            <input type="checkbox"
                                   name="order_item"
                                   class="rounded ringed"
                                   :id="position.id">
                        </button>
                    </div>
                </div>
            </div>
            <p v-html="position.description"
               class="mt-1.5 text-xs text-main-eclipse line-clamp-3 opacity-75 hover:opacity-100 duration-150 cursor-pointer"
               @click="router.get(route('positions.show', {slug: position.slug}))"/>
        </div>
    </section>
</template>
<script setup>
import {product_price} from '@/Pages/Merch/Composables/useMerch.js';
import EditElementComponent from '@/Pages/Shared/EditElementComponent.vue';
import {router} from '@inertiajs/vue3';

const props = defineProps(['position']);

function toggleCheckbox() {
    let element = Array.from(document.getElementsByName('order_item')).find(el => el.id === props.position.id);
    element.checked = !element.checked;
    Event.emit('update_order', props.position.id);
}
</script>