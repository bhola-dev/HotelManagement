<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div
              class="d-flex flex-column flex-shrink-0 p-3 bg-light"
              style="width: 280px"
            >
              <ul class="nav nav-pills flex-column mb-auto">
                <li>
                  <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16">
                      <use xlink:href="#table" />
                    </svg>
                    All Rooms
                  </a>
                </li>
                <li>
                  <a href="#" class="nav-link btn link-dark">
                    <svg class="bi me-2" width="16" height="16">
                      <use xlink:href="#table" />
                    </svg>
                    Booking List
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
