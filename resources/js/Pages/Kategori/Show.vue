<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('kategori.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Lihat Kategori</p>
    </div>
    <div class="card flex flex-col gap-4">
        <div class="flex items-center">
            <p class="text-primary font-bold">Deskripsi</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{ props.kategori['deskripsi'] }}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-primary font-bold">Kategori</p>
            <div class="w-24"></div>
            <p class="text-2xl">{{ ubahKategori(props.kategori['kategori']) }}</p>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'kategori': Object
})

function ubahKategori(kategori){
    switch (kategori) {
        case 'A':
            return "Alat";
        case 'M':
            return "Modal";
        case 'BHP':
            return "Barang Habis Pakai";
        case 'BTHP':
            return "Barang Tidak Habis Pakai";
    }
}
</script>
