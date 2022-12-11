<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps( {
  vacancyId : Number
})

const submit = () => {
  form.post(route('response.save'));
};

const form = useForm({
  message:  '',
  vacancyId: props.vacancyId ? props.vacancyId :  ''
});

</script>

<template>
  <AuthenticatedLayout>
    <form @submit.prevent="submit">
      <div>
        <InputLabel for="title" value="Message" />

        <TextInput
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.message"
            required
        />
      </div>
<!--      <input type="hidden" id="vacancyId">-->

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Send
        </PrimaryButton>
      </div>
    </form>
  </AuthenticatedLayout>
</template>