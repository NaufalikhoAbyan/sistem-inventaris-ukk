<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang-keluar.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Lihat Barang Keluar</p>
    </div>

    <div class="card flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Deskripsi</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{props.barang_keluar['tanggal_keluar']}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Kategori</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{props.barang_keluar['kuantitas_keluar']}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Barang</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{props.barang_keluar.barang['merk']}} {{props.barang_keluar.barang['seri']}}</p>
        </div>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    'barang_keluar': Object
})
</script>
