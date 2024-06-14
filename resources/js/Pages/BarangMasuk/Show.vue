<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang-masuk.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Lihat Barang Masuk</p>
    </div>

    <div class="card flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Deskripsi</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{props.barang_masuk['tanggal_masuk']}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Kategori</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{props.barang_masuk['kuantitas_masuk']}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Barang</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{props.barang_masuk.barang['merk']}} {{props.barang_masuk.barang['seri']}}</p>
        </div>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    'barang_masuk': Object
})
</script>
