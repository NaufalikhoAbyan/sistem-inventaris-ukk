<template>
    <div class="flex justify-between items-center">
        <p class="text-[28px] opacity-60">Barang Masuk</p>
        <Link :href="route('barang-masuk.create')">
            <button class="button-primary">
                Tambah +
            </button>
        </Link>
    </div>
    <div v-if="$page.props.errors.error" class="text-admin-danger font-bold">{{ $page.props.errors.error }}</div>
    <div class="border rounded-lg bg-white shadow-md mt-4">
        <div class="p-5 bg-admin-gray rounded-t-lg border-b flex justify-between items-center">
            <p class="font-bold text-primary">Tabel Barang Masuk</p>
            <div class="flex items-center gap-2">
                <button class="button-primary" @click="router.get(route('barang-masuk.index'))">Reset</button>
                <div>
                    <input type="date" placeholder="Min tanggal" class="flex-grow border-4 py-1.5 px-3 rounded-l-lg focus:border-2 focus:border-blue-200 w-fit" v-model="filterForm.min_tanggal">
                    <input type="date" placeholder="Max tanggal" class="flex-grow border-4 py-1.5 px-3 rounded-r-lg focus:border-2 focus:border-blue-200 w-fit" v-model="filterForm.max_tanggal">
                </div>
                <div>
                    <input type="text" placeholder="Min masuk" class="flex-grow border-4 py-1.5 px-3 rounded-l-lg focus:border-2 focus:border-blue-200 w-36" v-model.number="filterForm.min_masuk">
                    <input type="text" placeholder="Max masuk" class="flex-grow border-4 py-1.5 px-3 rounded-r-lg focus:border-2 focus:border-blue-200 w-36" v-model.number="filterForm.max_masuk">
                </div>
            </div>
        </div>
        <div class="p-5 w-full">
            <table class="table w-full table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">No.</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Tanggal Masuk</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Kuantitas Masuk</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Barang</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Action</th>
                </tr>
                <tr v-for="item in props.barang_masuk">
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{ count++ }}.</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item['tanggal_masuk']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item['kuantitas_masuk']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item.barang['merk']}} {{item.barang['seri']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">
                        <div class="flex w-full justify-center gap-2">
                            <Link :href="route('barang-masuk.show', item.id)" class="bg-primary p-2 flex items-center rounded-lg gap-4"><img src="/images/show_icon.svg" alt="show" class="w-6"></Link>
                            <Link :href="route('barang-masuk.edit', item.id)" class="bg-admin-warning p-2 flex items-center rounded-lg gap-4"><img src="/images/edit_icon.svg" alt="edit" class="w-6"></Link>
                            <Link :href="route('barang-masuk.destroy', item.id)" method="delete" as="button" class="bg-admin-danger p-2 flex items-center rounded-lg gap-4" onclick=""><img src="/images/delete_icon.svg" alt="delete" class="w-6"></Link>
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
import { reactive, watch } from "vue"
import { debounce } from "lodash";

let count = 1
const props = defineProps({
    'barang_masuk': Object,
    'filters': Object
})

const filterForm = reactive({
    'min_tanggal': props.filters.min_tanggal,
    'max_tanggal': props.filters.max_tanggal,
    'min_masuk': props.filters.min_masuk,
    'max_masuk': props.filters.max_masuk
})

watch(filterForm, debounce( () => { router.get(route('barang-masuk.index'), filterForm, {
    preserveState: true,
    preserveScroll: true
}) }, 200 ))
</script>
