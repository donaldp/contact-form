<template>
    <div>
        <h2 class="text-2xl font-semibold leading-tight">Recent messages</h2>
    </div>
    <div class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select v-model="criteria.gender" class="mt-1 h-11 rounded-r-none block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option v-for="(gender, key) in genders" :key="key" :value="gender.alias">{{ gender.name }}</option>
                </select>
            </div>
        </div>
        <div class="block">
            <input
                placeholder="Query"
                class="appearance-none mt-1 border border-b rounded-l-none block h-11 pl-2 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                v-model="criteria.query"
            />
        </div>
        <div class="block">
            <BreezeButton
                class="ml-2 mt-1 h-11"
                @click="search"
            >
                Search
            </BreezeButton>
        </div>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Gender
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Message
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Created
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contact, key) in results.data" :key="key">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ contact.name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ contact.email }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ contact.gender.name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ contact.content }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ contact.created_at }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                <div class="inline-flex mt-2 xs:mt-0">
                    <a :href="getUrl(results.prev_page_url)"
                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l"
                        :class="{ 'opacity-25': !results.prev_page_url }"
                    >
                        Prev
                    </a>
                    <a :href="getUrl(results.next_page_url)"
                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r"
                        :class="{ 'opacity-25': !results.next_page_url }"
                    >
                        Next
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';

export default {
    components: {
        BreezeButton,
        BreezeInput,
    },

    props: [
        'results',
        'filters'
    ],

     data() {
        return {
            criteria: {
                gender: 'all',
                query: '',
            },

            genders: [
                {
                    name: 'All',
                    alias: 'all',
                },
            ],
        };
    },

    mounted() {
        this.criteria.gender = this.filters.gender;
        this.criteria.query = this.filters.query ?? '';

        this.gender();
    },

    methods: {
        /**
         * Fetch gender list from the backend.
         *
         * @returns {void}
         */
        gender() {
            axios.get('/api/gender').then((response) => this.genders = this.genders.concat(response.data))
        },

        /**
         * Persist search.
         *
         * @returns {void}
         */
        search() {
            window.location.href = `/dashboard?query=${this.criteria.query}&gender=${this.criteria.gender}`;
        },

        /**
         * Get url.
         *
         * @param {string} url
         * @returns {string|null}
         */
        getUrl(url) {
            return url ? `${url}&query=${this.criteria.query}&gender=${this.criteria.gender}` : null;
        }
    }
};
</script>
