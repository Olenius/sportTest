<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  vacancy: Object,
})

const submit = () => {
  form.post(route('vacancy.edit', { id: (props.vacancy ? props.vacancy.id :  '')}));
};

const form = useForm({
  title: props.vacancy ? props.vacancy.title :  '',
  description: props.vacancy ? props.vacancy.description :  '',
});

</script>
<template>
  <AuthenticatedLayout>
    <form @submit.prevent="submit">
      <div>
        <InputLabel for="title" value="Title" />

        <TextInput
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
            required
        />
      </div>

      <div>
        <InputLabel for="description" value="Description" />

        <TextInput
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
            required
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Save
        </PrimaryButton>
      </div>
    </form>
  </AuthenticatedLayout>
</template>