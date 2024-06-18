<template>
    <div class="flex justify-between items-center">
        <p class="text-[28px] opacity-60">Barang</p>
        <Link :href="route('barang.create')">
            <button class="button-primary">
                Tambah +
            </button>
        </Link>
    </div>
    <div v-if="$page.props.errors.error" class="text-admin-danger font-bold">{{ $page.props.flash }}</div>
    <div v-if="$page.props.flash.message" class="text-admin-danger font-bold pt-4">{{ $page.props.flash.message }}</div>
    <div class="border rounded-lg bg-white shadow-md mt-4">
        <div class="p-5 bg-admin-gray rounded-t-lg border-b flex justify-between items-center">
            <p class="font-bold text-primary">Tabel Barang</p>
            <div class="flex items-center gap-2">
                <button class="button-primary" @click="router.get(route('barang.index'))">Reset</button>
                <div>
                    <input type="text" placeholder="Min stok" class="flex-grow border-4 py-1.5 px-3 rounded-l-lg focus:border-2 focus:border-blue-200 w-24" v-model.number="filterForm.min_stok">
                    <input type="text" placeholder="Max stok" class="flex-grow border-4 py-1.5 px-3 rounded-r-lg focus:border-2 focus:border-blue-200 w-24" v-model.number="filterForm.max_stok">
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
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Merk</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Seri</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Spesifikasi</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Stok</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Kategori</th>
                    <th class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">Action</th>
                </tr>
                <tr v-for="item in props.barang" :key="item.id">
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{ count++ }}.</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item['merk']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item['seri']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item['spesifikasi']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">{{item['stok']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">({{item.kategori['kategori']}}) {{item.kategori['deskripsi']}}</td>
                    <td class="px-4 py-2 text-left border-admin-gray-dark border border-opacity-50">
                        <div class="flex w-full justify-center gap-2">
                            <Link :href="route('barang.show', item.id)" class="bg-primary p-2 flex items-center rounded-lg gap-4"><img src="/images/show_icon.svg" alt="show" class="w-6"></Link>
                            <Link :href="route('barang.edit', item.id)" class="bg-admin-warning p-2 flex items-center rounded-lg gap-4"><img src="/images/edit_icon.svg" alt="edit" class="w-6"></Link>
                            <Link :href="route('barang.destroy', item.id)" method="delete" as="button" class="bg-admin-danger p-2 flex items-center rounded-lg gap-4"><img src="/images/delete_icon.svg" alt="delete" class="w-6"></Link>
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
import { Link, usePage, router } from "@inertiajs/vue3"
import { reactive, watch } from "vue"
import { debounce } from "lodash"

const page = usePage()
let count = 1
const props = defineProps({
    'barang': Object,
    'filters': Object
})

const filterForm = reactive({
    'min_stok': props.filters.min_stock,
    'max_stok': props.filters.max_stock,
    'search' : props.filters.search
})

watch(filterForm, debounce( () => { router.get(route('barang.index'), filterForm, {
    preserveState: true,
    preserveScroll: true
}) }, 200 ))
</script>
