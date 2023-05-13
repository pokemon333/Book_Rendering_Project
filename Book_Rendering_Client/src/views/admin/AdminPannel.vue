<template>
     <div class="w-100 h-screen flex justify-center items-center" v-if="pageLoading">
        <n-space>
            <n-spin size="medium" />
        </n-space>
    </div>
    
    <div v-if="!pageLoading">

      <div class="flex w-full">
        <!-- Slide Bar -->
        <div class=" h-screen sticky top-0  p-2 border-r-2 border-gray-300 w-60  flex flex-col justify-between text-gray-500">
            <div class="flex justify-start text-cyan-700  items-center h-20 p-6">
                <p class="text-4xl h-9 w-8 border-slate-300 border-r-2">B</p>
                <p class="ml-2 text-cyan-400">Brighter</p>
            </div>
            <div class=" h-96 flex flex-col justify-evenly">
                <div  v-for="menuItem in menu" :key="menuItem.id">
                    <div class=" h-14 w-full flex pl-6  justify-start items-center hover:bg-slate-300 hover:rounded-md cursor-pointer">
                        <i :class=menuItem.icon></i>
                        <router-link :to="{ name:menuItem.route}" class="ml-4">
                            {{ menuItem.name }}
                        </router-link>
                    </div>
                </div>
            </div>
            <div class=" h-20 flex justify-start pl-6 items-center">
            </div>
        </div>
        <!-- Main-Feed -->
        <div class="w-full h-screen">
            <div class="shadow-sm h-16 flex flex-wrap border-b-2   z-50">
                <div class=" flex justify-center items-center  h-full w-10/12"> 
                    <!-- Future use -->
                </div>
                <div class=" h-full w-2/12  flex items-center justify-center">
                    <div class="md:w-[30%]   h-full flex justify-center items-center">
                    <button v-if="!this.showDropDown" @click="this.showDropDown = true" class="bg-cyan-100 h-10 w-12 rounded-full md:hidden border-[1px] text-cyan-700  border-cyan-300  ">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="relative inline-block text-left ml-4">
                        <div>
                            <button @click="this.accountDropDown = !this.accountDropDown" type="button" class="inline-flex text-slate-500 w-full justify-center gap-x-1.5 rounded-md bg-slate-50  px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-cyan-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                {{ this.authuser.name }}
                                <i class="fa-solid fa-ellipsis-vertical mt-[3px]"></i>
                            </button>
                        </div>
                        <div v-if="accountDropDown" class="absolute right-0 z-10 mt-2 w-56 origin-top-right  rounded-md bg-slate-100 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <div class="text-slate-500 block px-4 py-2 text-sm" >
                                    <i class="fa-solid fa-envelope mr-2"></i>
                                    {{ this.authuser.email }}
                                </div>
                                <div class="text-slate-500 block px-4 py-2 text-sm" >
                                    <button @click="this.logout" class="bg-slate-300 text-slate-600 shadow-sm border-slate-200 border-[1px] cursor-pointer rounded-md w-14 h-8  p-1">
                                        Logout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
            <router-view/>
        </div>
      </div>
    </div>
    
   
</template>
<script>
import ApiServices from '../../../services/ApiServices';
import TokenServices from '../../../services/TokenServices';

export default {
    mounted(){
        this.setAuthUser()
        this.pageLoading = true
        setTimeout(()=>{
            this.pageLoading = false;
        },1000)
    },
    data(){
        return {
            accountDropDown:false,
            authuser:'',
            dropdown : 'hidden' ,
            pageLoading : false,
            menu : [
                {
                    id: 1,
                    name: "Home",
                    icon: "fa-solid fa-house fa-xl",
                    class: "active:bg-blue-700 focus:ring focus:ring-violet-700",
                    route: 'home'
                },
                {
                    id: 2,
                    name: "Dashboard",
                    icon: "fa-solid fa-gauge fa-xl",
                    class: "active:bg-blue-700 focus:ring focus:ring-violet-700",
                    route: 'dash-board'
                },
                {
                    id: 3,
                    name: "Category",
                    icon: "fa-solid fa-boxes-stacked fa-xl",
                    class: "active:bg-blue-700 focus:ring focus:ring-violet-700",
                    route: 'category'
                },
                {
                    id: 4,
                    name: "Author",
                    icon: "fa-solid fa-pen-nib fa-xl",
                    class: "active:bg-blue-700 focus:ring focus:ring-violet-700",
                    route: 'author'
                },
                {
                    id: 5,
                    name: "Products",
                    icon: "fa-brands fa-product-hunt fa-xl",
                    class: "active:bg-blue-700 focus:ring focus:ring-violet-700",
                    route: 'book'
                },
                {
                    id: 6,
                    name: "User",
                    icon: "fa-solid fa-users fa-xl",
                    class: "active:bg-blue-700 focus:ring focus:ring-violet-700",
                    route: 'user'
                }
            ]
        }
    },
    methods:{
        logout(){
            ApiServices.post('user/logout').then((res)=>{
                TokenServices.destroyToken();
                this.$router.push({name : 'home'});    
            }).catch((err)=>console.log(err))
        },
        setAuthUser(){
            ApiServices.get('user').then((res)=>{
                this.authuser = res.data.data
            }).catch((err)=>console.log(err))
        },
        active(){
        if (this.dropdown == 'hidden') {
          this.dropdown = 'block'
        }else{
          this.dropdown = 'hidden'
        }
      }
    }
}

</script>