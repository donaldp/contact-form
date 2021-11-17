<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Contact :results="contacts" :filters="filters"/>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Contact from '@/Components/Contact.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Contact,
        Head,
    },

    props: [
        'contacts',
        'filters',
    ]
}
</script>
