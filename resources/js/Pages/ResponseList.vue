<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineProps({
  responses: Object,
  vacancy: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: inline-block">{{ vacancy.id }}# {{ vacancy.title }}</h2>
    </template>
    <div class="min-h-screen w-full bg-gray-300">
      <div class="max-w-screen-md mx-auto px-10 pt-20" v-if="$page.props.responses">
        <ul id="example-1">
          <li v-for="response in responses" :key="response.id" class="mb-4">
            <div class="bg-white md:h-48 rounded-lg shadow-md flex flex-wrap flex-col-reverse md:flex-col">
              <div class="w-full p-4">
                <h3 class="text-3xl font-bold card-buttons">User: {{ response.userId }}</h3>
                <p>{{ response.message }}</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
