<template>
    <Head :title="$t('roles.roles')" />
	
    <section class="form_wrapper">
        <h5 class="text_24 mb-4">{{ $t('roles.title') }}</h5>
        <!--	Existing roles list-->
        <section class="mb-4 ringed_10 rounded overflow-hidden">
            <section v-for="(role, index) in roles"
                     :key="role.id"
                     class="grid grid-cols-5 gap-4 cursor-pointer rounded py-2 text-center opacity_80"
                     :class="index % 2 ? 'bg-gray-100':'bg-gray-200'"
                     @click="fillForm(role)">
                <span class="col-span-1 text_14">{{ role.id }}</span>
                <span class="col-span-2 text_14">{{ role.name }}</span>
                <span class="col-span-2 text_14">{{ role.full_name }}</span>
            </section>
        </section>

        <!--	form -->
        <section class="">
            <div class="col-span-6 sm:col-span-4">
                <Label for="id"
                       :value="$t('roles.role_id')" />
                <NumberInput id="role_id"
                             type="number"
                             class="mt-1 block w-full"
                             v-model="form.id"
                             min="1"
                             step="1" />
                <InputError :message="form.errors.id"
                            class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <Label for="name"
                       :value="$t('roles.name')" />
                <TextInput id="name"
                           type="text"
                           class="mt-1 block w-full"
                           v-model="form.full_name" />
                <InputError :message="form.errors.full_name"
                            class="mt-2" />
            </div>
            <section class="mt-6 w-full flex justify-between items-center">
                <ActionMessage :on="form.recentlySuccessful">
                    {{$t('saved')}}
                </ActionMessage>
                <PrimaryButton :class="{ 'opacity-25': form.processing }"
                               class="ml-auto"
                               :disabled="form.processing"
                               @click="upsertRole">
                    {{$t('save_button')}}
                </PrimaryButton>
            </section>
        </section>
    </section>
</template>
<script setup>
import {Head, router, useForm} from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import Label from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NumberInput from '@/Components/NumberInput.vue';

defineProps(['roles']);

let form = useForm({
    _method: 'POST',
    _id: null,
    id: null,
    name: null,
    full_name: null,
});
function upsertRole() {
    form.post(route('role_upsert'), {
        errorBag: 'role_upsert',
        preserveScroll: true,
        onSuccess: () => {
            router.reload({only: ['roles']});
            ({ _id: form._id, id: form.id, name: form.name, full_name: form.full_name } = { _id: null, id: null, name: null, full_name: null });
        },
    });
}

function fillForm(role) {
    form.errors = Object.assign({}, {});
    ({ id: form.id, name: form.name, full_name: form.full_name } = role);
    form._id = role.id;
}
</script>