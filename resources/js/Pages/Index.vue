<template>
    <Head title="Contact" />

    <h4 class="text-center text-2xl py-4">How can we help?</h4>

    <BreezeValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 text-center font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="name" value="Name" />
            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

         <div class="mt-4">
            <BreezeLabel for="gender" value="Gender" />
            <select v-model="form.gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option v-for="(gender, key) in genders" :key="key" :value="gender.alias">{{ gender.name }}</option>
            </select>
        </div>

        <div class="mt-4">
            <BreezeLabel for="content" value="Message" />
            <BreezeTextArea id="content" class="mt-1 block w-full" v-model="form.content" required  />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeTextArea from '@/Components/TextArea.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeTextArea,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                gender: 'select',
                content: '',
            }),

            genders: [
                {
                    name: 'Select',
                    alias: 'select',
                },
            ],
        };
    },

    mounted() {
        this.gender();
    },

    methods: {
        /**
         * Submit contact form.
         *
         * @returns {void}
         */
        submit() {
            this.form.post(this.route('contact.submit'), {
                onSuccess: () => this.form.reset(),
            });
        },

        /**
         * Fetch gender list from the backend.
         *
         * @returns {void}
         */
        gender() {
            axios.get('/api/gender').then((response) => this.genders = this.genders.concat(response.data))
        }
    },
};

</script>
