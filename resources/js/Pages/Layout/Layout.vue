<template>
    <div class="font-nunito">
        <div class="flex flex-row min-h-screen">
            <div class="w-56 bg-gradient-to-b from-primary to-primary-dark p-4 text-white">
                <div class="flex items-center justify-center gap-4">
                    <img src="/images/app_icon.svg" alt="app icon" class="-rotate-12 w-[2.05rem] h-[2.05rem]">
                    <div class="font-extrabold text-center text-base">
                        <p>SINVENT</p>
                    </div>
                </div>
                <div class="line"></div>
                <Link :href="route('dashboard')" class="w-full flex items-center gap-2" id="dashboard" :class="[ route().current('dashboard') ? 'opacity-100' : 'opacity-50' ]">
                    <img src="/images/dashboard_icon.svg" alt="dashboard icon" class="h-3.5 w-3.5">
                    <p class="font-bold text-sm">Dashboard</p>
                </Link>
                <div class="line"></div>
                <Link href="#" class="w-full flex items-center gap-2 mt-8" id="kategori" :class="[ route().current('kategori.*') ? 'opacity-100' : 'opacity-50' ]">
                    <img src="/images/kategori_icon.svg" alt="dashboard icon" class="h-3.5 w-3.5">
                    <p class="font-bold text-sm">Kategori</p>
                </Link>
                <Link href="#" class="w-full flex items-center gap-2 mt-8" id="kategori" :class="[ route().current('barang.*') ? 'opacity-100' : 'opacity-50' ]">
                    <img src="/images/barang_icon.svg" alt="dashboard icon" class="h-3.5 w-3.5">
                    <p class="font-bold text-sm">Barang</p>
                </Link>
                <Link href="#" class="w-full flex items-center gap-2 mt-8" id="kategori" :class="[ route().current('barang-masuk.*') ? 'opacity-100' : 'opacity-50' ]">
                    <img src="/images/barang_masuk_icon.svg" alt="dashboard icon" class="h-3.5 w-3.5">
                    <p class="font-bold text-sm">Barang Masuk</p>
                </Link>
                <Link href="#" class="w-full flex items-center gap-2 mt-8" id="kategori" :class="[ route().current('barang-keluar.*') ? 'opacity-100' : 'opacity-50' ]">
                    <img src="/images/barang_keluar_icon.svg" alt="dashboard icon" class="h-3.5 w-3.5">
                    <p class="font-bold text-sm">Barang Keluar</p>
                </Link>
            </div>
            <div class="flex-grow flex flex-col">
                <div class="w-full shadow-lg h-[70px] py-2 px-8 flex items-center justify-end">
                    <div class="flex h-full items-center">
                        <div class="flex gap-8">
                            <img src="/images/bell_icon.svg" alt="notification" class="opacity-25 w-4">
                            <img src="/images/mail_icon.svg" alt="mail" class="opacity-25 w-4">
                        </div>
                        <div class="bg-black opacity-15 h-3/4 w-[2px] mx-4"></div>
                        <div class="flex items-center gap-4 cursor-pointer" @click="isDroppedDown = !isDroppedDown">
                            <p>Placeholder Username</p>
                            <div class="w-8 aspect-square rounded-full">
                                <img src="/images/undraw_profile.svg" alt="profile" class="w-full h-full">
                            </div>
                        </div>
                        <div v-if="isDroppedDown" class="bg-white px-4 py-2 rounded-lg border-2 cursor-pointer absolute z-50 right-10 top-16 hover:text-admin-danger">
                            <Link href="#" method="POST">Logout</Link>
                        </div>
                    </div>
                </div>
                <div class="h-6 bg-gradient-to-t from-gray-100 to-gray-200"></div>
                <div class="px-6 pb-8 bg-gray-100 flex-grow">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const page = usePage()

const isDroppedDown = ref(false)
</script>
