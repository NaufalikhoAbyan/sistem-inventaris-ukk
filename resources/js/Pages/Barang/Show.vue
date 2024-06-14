<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Lihat Barang</p>
    </div>

    <div class="flex gap-4 h-fit">
        <div class="card flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <p class="text-primary font-bold">Merk</p>
                <div class="w-24"></div>
                <p class="text-2xl">{{props.barang['merk']}}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-primary font-bold">Seri</p>
                <div class="w-24"></div>
                <p class="text-2xl">{{props.barang['seri']}}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-primary font-bold">Spesifikasi</p>
                <div class="w-24"></div>
                <p class="text-2xl">{{props.barang['spesifikasi']}}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-primary font-bold">Stok</p>
                <div class="w-24"></div>
                <p class="text-2xl">{{props.barang['stok']}}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-primary font-bold">Kategori</p>
                <div class="w-24"></div>
                <p class="text-2xl">({{props.barang.kategori['kategori']}}) {{props.barang.kategori['deskripsi']}}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    'barang': Object
})
</script>
