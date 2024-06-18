<template>
    <div class="flex justify-between items-center">
        <p class="text-[28px] opacity-60">Kategori</p>
        <Link :href="route('kategori.create')">
            <button class="button-primary">
                Tambah +
            </button>
        </Link>
    </div>
    <div v-if="$page.props.errors.error" class="text-admin-danger font-bold pt-4">{{ $page.props.errors.error }}</div>
    <div class="border rounded-lg bg-white shadow-md mt-4">
        <div class="p-5 bg-admin-gray rounded-t-lg border-b flex justify-between items-center">
            <p class="font-bold text-primary">Tabel Kategori</p>
            <div class="flex items-center gap-8">
                <button class="button-primary" @click="router.get(route('kategori.index'))">Reset</button>
                <div class="flex gap-4">
                    <div class="flex gap-2">
                        <input type="checkbox" id="alat" v-model="filterForm.A">
                        <label for="alat">A</label>
                    </div>
                    <div class="flex gap-2">
                        <input type="checkbox" id="modal" v-model="filterForm.M">
                        <label for="modal">M</label>
                    </div>
                    <div class="flex gap-2">
                        <input type="checkbox" id="barang-habis-pakai" v-model="filterForm.BHP">
                        <label for="barang-habis-pakai">BHP</label>
                    </div>
                    <div class="flex gap-2">
                        <input type="checkbox" id="barang-tidak-habis-pakai" v-model="filterForm.BTHP">
                        <label for="barang-tidak-habis-pakai">BTHP</label>
                    </div>
                </div>
                <div class="w-[400px] h-[38px] rounded-md overflow-hidden flex">
                    <input type="text" placeholder="search for..." class="flex-grow border-4 py-1.5 px-3 rounded-l-lg focus:border-2 focus:border-blue-200" v-model="filterForm.search">
                    <div class="w-10 h-full bg-primary rounded-r-lg flex items-center justify-center">
                        <img src="/images/search_icon.svg" alt="search" class="w-3.5">
                    </div>`
                </div>
            </div>
        </div>
        <div class="p-5 w-full">
            <table class="table w-full table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">No.</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Deskripsi</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Kategori</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Action</th>
                </tr>
                <tr v-for="item in props.kategori" :key="item.id">
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{ count++ }}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{ item['deskripsi'] }}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{ item['kategori'] }}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">
                        <div class="flex w-full justify-center gap-2">
                            <Link :href="route('kategori.show', item.id)" class="bg-primary p-2 flex items-center rounded-lg gap-4"><img src="/images/show_icon.svg" alt="show" class="w-6"></Link>
                            <Link :href="route('kategori.edit', item.id)" class="bg-admin-warning p-2 flex items-center rounded-lg gap-4"><img src="/images/edit_icon.svg" alt="edit" class="w-6"></Link>
                            <Link :href="route('kategori.destroy', item.id)" method="delete" as="button" class="bg-admin-danger p-2 flex items-center rounded-lg gap-4"><img src="/images/delete_icon.svg" alt="delete" class="w-6"></Link>
                        </div>
                    </td>
                </tr>
                </thead>
            </table>
            <div class="hidden">{{count = 1}}</div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3"
import { reactive, watch } from 'vue'
import { debounce } from 'lodash'

let count = 1
const props = defineProps({
    'kategori': Object,
    'filters': Object
})

const filterForm = reactive({
    'A': props.filters.A,
    'M': props.filters.M,
    'BHP': props.filters.BHP,
    'BTHP': props.filters.BTHP,
    'search': props.filters.search
})

watch(filterForm, debounce(() => { router.get(route('kategori.index'), filterForm, {
    preserveState: true,
    preserveScroll: true,
})}, 250))
</script>
