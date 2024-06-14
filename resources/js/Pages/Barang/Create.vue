<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Tambah Barang</p>

        <form @submit.prevent="form.post(route('barang.store'))" enctype="multipart/form-data">
            <div class="card w-full py-4 flex flex-col gap-4">
                <div class="form-input">
                    <p class="opacity-75 flex text-xl font-bold">Merk</p>
                    <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="merk" v-model="form.merk">
                </div>
                <div class="form-input">
                    <p class="opacity-75 flex text-xl font-bold">Seri</p>
                    <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="seri" v-model="form.seri">
                </div>
                <div class="form-input">
                    <p class="opacity-75 flex text-xl font-bold">spesifikasi</p>
                    <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="spesifikasi" v-model="form.spesifikasi">
                </div>
                <div class="form-input">
                    <p class="opacity-75 flex text-xl font-bold">Stok</p>
                    <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="stok" v-model.number="form.stok">
                </div>
                <div class="form-input">
                    <p class="opacity-75 flex text-xl font-bold">Kategori</p>
                    <select class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="kategori_id" v-model="form.kategori_id">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option v-for="kategoriItem in props.kategori" :key="kategoriItem.id" :value="kategoriItem.id">({{kategoriItem['kategori']}}) {{kategoriItem['deskripsi']}}</option>
                    </select>
                </div>

                <button type="submit" class="button-primary w-fit">Tambah</button>

                <div v-if="form.errors">
                    <div class="text-admin-danger font-bold" v-for="error in form.errors">
                        {{error}}
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    'kategori': Object
})

const form = useForm({
    'merk': null,
    'seri': null,
    'spesifikasi': null,
    'stok': 0,
    'kategori_id': "",
})
</script>
