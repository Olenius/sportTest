<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    vacancies: Object,

  })

const user = usePage().props.value.auth.user;
console.log(usePage().props)

function likeReq (url, event) {
  let btnId = event.currentTarget.id
  axios.post(url, "test").then( res => {
    if(res.data === 'like') {
      let btn = document.getElementById(btnId)
      btn.classList.add("red");
      console.log(res.data)
    } else {
      let btn = document.getElementById(btnId)
      btn.classList.remove("red");
    }
  })
}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: inline-block">Job Vacancies</h2>
            <Link
                :href="route('vacancy.edit')"
            >
              <PrimaryButton class="ml-4" style="display: inline-block; margin-left: 10px">Add Vacancy (2 coins)</PrimaryButton>
            </Link>
        </template>

        <div class="min-h-screen w-full bg-gray-300">
          <div class="max-w-screen-md mx-auto px-10 pt-20" v-if="$page.props.vacancies">
            <ul id="example-1">
              <li v-for="vacancy in vacancies" :key="vacancy.id" class="mb-4">
                <div class="bg-white md:h-48 rounded-lg shadow-md flex flex-wrap flex-col-reverse md:flex-col">
                  <div class="w-full p-4">
                    <h3 class="text-3xl font-bold card-buttons">{{ vacancy.title }}</h3>
                    <p>{{ vacancy.description }}</p>
                    <div class="mt-2">
                      <div v-if="vacancy.userId != user.id">
                        <SecondaryButton :id="'likeVac' + vacancy.id" class="card-buttons" v-on:click="likeReq(route('like.vacancy', { id: vacancy.id }), $event)">
                            Like Vacancy
                        </SecondaryButton>
                        <SecondaryButton :id="'likeUsr' + vacancy.id" class="card-buttons" v-on:click="likeReq(route('like.user', { id: vacancy.userId }), $event)">
                            Like User {{ vacancy.userId }}
                        </SecondaryButton>
                        <SecondaryButton class="card-buttons">
                          <Link
                              :href="route('response.add', { id: vacancy.id })"
                          >
                            Response
                          </Link>
                        </SecondaryButton>
                      </div>
                      <div v-if="vacancy.userId == user.id">
                        <SecondaryButton class="card-buttons" >
                          <Link
                              :href="route('response.list', { id: vacancy.id })"
                          >
                            Responses
                          </Link>
                        </SecondaryButton>
                        <SecondaryButton class="card-buttons">
                          <Link
                              :href="route('vacancy.edit', { id: vacancy.id })"
                          >
                            Edit
                          </Link>
                        </SecondaryButton>
                        <DangerButton class="card-buttons">
                          <Link
                              :href="route('vacancy.delete', { id: vacancy.id })"
                          >
                            Delete
                          </Link>
                        </DangerButton>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
    </AuthenticatedLayout>
</template>
