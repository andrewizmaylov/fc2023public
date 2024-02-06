<template>
    <section class="space-y-4 text_ld">
        <section v-for="(question, i) in data"
                 :key="i"
                 class="font-play">
            <section class="flex items-center justify-between cursor-pointer"
                     @click="toggleQuestion(i)">
                <h4 class="text_21 font-semibold">{{question.q}}</h4>
                <h1 class="text_34 font-bold">{{question.active ? '-':'+'}}</h1>
            </section>
            <p  class="my-4 px-4"
                v-html="question.a"
                v-if="question.active"/>
        </section>
    </section>
</template>
<script setup>
import {ref} from 'vue';

let data = ref([
    {
        active: false,
        q: 'Что нужно, чтобы попасть на матч?',
        a: 'Только билет. Контролёр имеет право попросить у вас документ, подтверждающий возраст или льготную категорию — его тоже лучше взять с собой.'
    },
    {
        active: false,
        q: 'Нужен ли Fan ID?',
        a: 'Нет, не нужен.'
    },
    {
        active: false,
        q: 'Сколько болельщиков могут посещать игры?',
        a: 'Ограничений по количество болельщиков нет. Если у вас есть билет и вы соблюдаете правила посещения — вы можете попасть на игру. На стадионе «Звезда» полностью открыта западная трибуна.'
    },
    {
        active: false,
        q: 'Есть ли льготные билеты?',
        a: `
			Бесплатные билеты действуют детей до 7 лет и представителей льготных категорий:
			<li>Пенсионеры</li>
			<li>Инвалиды</li>
			<li>Ветераны войн</li>
			<li>Герои СССР и РФ</li>
			<li>Ветераны труда</li>
			<li>Ликвидаторы катастроф</li>
			<li>Многодетные семьи</li>
			<li>Сироты</li>
			Бесплатные билеты можно получить в фаншопе клуба, подробности — в наших соцсетях. Детям нужно предъявить свидетельство о рождении, другим категориям — паспорт и документ, подтверждающий категорию.
		`
    },
    {
        active: false,
        q: 'Как купить билеты?',
        a: 'На странице матча в сервисе Яндекс Афиша'
    },
]);

function toggleQuestion(i) {
    data.value[i].active = !data.value[i].active;
}
</script>