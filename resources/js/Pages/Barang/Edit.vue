<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Edit Barang</p>
    </div>

    <form @submit.prevent="form.put(route('barang.update', props.barang.id))" enctype="multipart/form-data">
        <div class="py-4 flex flex-col gap-4">
            <div>
                <p class="opacity-75 flex text-xl font-bold">Merk</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="merk" v-model="form.merk">
            </div>
            <div>
                <p class="opacity-75 flex text-xl font-bold">Seri</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="seri" v-model="form.seri">
            </div>
            <div>
                <p class="opacity-75 flex text-xl font-bold">spesifikasi</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="spesifikasi" v-model="form.spesifikasi">
            </div>
            <div>
                <p class="opacity-75 flex text-xl font-bold">Stok</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="stok" v-model.number="form.stok" disabled>
            </div>
            <div>
                <p class="opacity-75 flex text-xl font-bold">Kategori</p>
                <select class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="kategori_id" v-model="form.kategori_id">
                    <option v-for="kategoriItem in props.kategori" :key="kategoriItem.id" :value="kategoriItem.id">({{kategoriItem['kategori']}}) {{kategoriItem['deskripsi']}}</option>
                </select>
            </div>

            <button type="submit" class="button-primary w-fit">Edit</button>

            <div v-if="form.errors">
                <div class="text-admin-danger font-bold" v-for="error in form.errors">
                    {{error}}
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    'barang': Object,
    'kategori': Object
})

const form = useForm({
    'merk': props.barang.merk,
    'seri': props.barang.seri,
    'spesifikasi': props.barang.spesifikasi,
    'stok': props.barang.stok,
    'kategori_id': props.barang.kategori_id,
})
</script>
