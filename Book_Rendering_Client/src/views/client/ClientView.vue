<template>
    <div class="w-full h-screen bg-cyan-50 flex object-cover ">
        

        <!-- side bar -->
        <div class="border-r-2 h-screen w-64 fixed border-blue-200 md:overflow-hidden overflow-auto hover:overflow-auto  z-50  bg-cyan-50  scrollbar-thin scrollbar-track-cyan-200 scrollbar-thumb-cyan-400 " v-if="drawer">

            <!-- logo -->
            <div class=" h-18 sticky top-0 flex justify-between items-center bg-cyan-50 ">
                <div class="flex justify-start text-cyan-700  items-center h-20 p-6">
                        <p class="text-4xl h-9 w-8 border-slate-300 border-r-2">B</p>
                        <p class="ml-2 text-cyan-400">Brighter</p>
                </div>
               <div class="  pr-2 text-cyan-800 items-center"  v-if="drawer">
                    <button @click="this.drawer = !this.drawer" >
                        <i class="fa-solid fa-bars fa-xl cursor-pointer" ></i>
                    </button>
                </div>      
            </div>

            <!-- Category Section -->

            <div class=" h-52 pt-4 px-6">
                <div class="flex hover:bg-cyan-100 cursor-pointer py-2 px-2 rounded-md">
                    <i class="fa-solid fa-boxes-stacked text-cyan-100 bg-cyan-500 rounded-md mr-4 p-2"></i>
                    <h1 class="text-xl text-cyan-700 cursor-pointer  rounded-md">Category</h1>
                </div>
                <div class="border-b-2 my-2 border-blue-200"></div>
                <div class=" h-32  hover:scrollbar-thin scrollbar-track-cyan-200 scrollbar-thumb-cyan-400 overflow-hidden hover:overflow-auto ">
                    <h1 @click="filter(category.id,'')" v-for="category in categorys" :key="category.id" class="hover:bg-cyan-100 text-md cursor-pointer rounded-md text-cyan-800 my-2 px-8 py-1" >{{ category.name }}</h1>
                </div>
            </div>

            <!-- Author Section -->

            <div class=" h-52 pt-4 px-6">
                <div class="flex hover:bg-cyan-100 cursor-pointer py-2 px-2 rounded-md">
                    <i class="fa-solid fa-pen-nib text-cyan-100 bg-cyan-500 rounded-md mr-4 p-2"></i>
                    <h1 class="text-xl text-cyan-700 cursor-pointer  rounded-md">Author</h1>
                </div>
                <div class="border-b-2 my-2 border-blue-200"></div>
                <div class=" h-32  hover:scrollbar-thin scrollbar-track-cyan-200 scrollbar-thumb-cyan-400 overflow-hidden hover:overflow-auto ">
                    <h1 @click="filter('',author.id)" v-for="author,index in authors" :key="author.id" class="hover:bg-cyan-100 text-md cursor-pointer rounded-md text-cyan-800 my-2 px-8 py-1" >{{ author.name }}</h1>
                </div>
            </div>

        </div>

        <!-- Filler for sideBar -->
        <div class="h-screen w-72" v-if="drawer"></div>



        <div class="bg-cyan-50 w-full h-screen">

                <!-- Nav section -->

            <nav class="border-b-2 border-blue-200 bg-cyan-50 sticky top-0 w-full h-16 flex justify-between">
                <div class="w-[10%]  h-full flex justify-start pl-8 text-cyan-800 items-center" v-if="!this.drawer">
                    <button @click="this.drawer = !this.drawer" >
                        <i class="fa-solid fa-bars fa-xl cursor-pointer" ></i>
                    </button>
                </div>
                 <div class="w-[10%]  h-full flex justify-start pl-8 text-cyan-800 items-center" v-if="this.drawer">
                </div>
                <div class="w-[45%]   h-full flex items-center  max-md:hidden  justify-end">
                    <input v-model="searchData.filter"  type="text" class="w-[80%] max-sm:hidden px-4 bg-cyan-100 h-10 rounded-full text-cyan-700 focus:border-cyan-400  focus:outline-none  focus:border-2   border-[1px] border-cyan-300 mr-2">
                    <button @click="search"  class="bg-cyan-100 h-10 w-12 rounded-full  max-sm:hidden border-[1px] text-cyan-700  border-cyan-300  ">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="md:w-[30%]   h-full flex justify-end  px-2 items-center">
                    <button v-if="!this.showDropDown" @click="this.showDropDown = true" class="bg-cyan-100 h-10 w-12 rounded-full md:hidden border-[1px] text-cyan-700  border-cyan-300  ">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="relative inline-block text-left ml-4">
                        <div>
                            <button @click="this.accountDropDown = !this.accountDropDown" type="button" class="inline-flex text-cyan-700 w-full justify-center gap-x-1.5 rounded-md bg-cyan-100  px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-cyan-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                {{ this.authuser.name }}
                                <i class="fa-solid fa-ellipsis-vertical mt-[3px]"></i>
                            </button>
                        </div>
                        <div v-if="accountDropDown" class="absolute right-0 z-10 mt-2 w-56 origin-top-right  rounded-md bg-cyan-100 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <div class="text-cyan-700 block px-4 py-2 text-sm" >
                                    <i class="fa-solid fa-envelope mr-2"></i>
                                    {{ this.authuser.email }}
                                </div>
                                <div class="text-cyan-700 block px-4 py-2 text-sm" >
                                    <button @click="this.logout" class="bg-cyan-300 text-cyan-800 cursor-pointer rounded-md w-14 h-8  p-1">
                                        Logout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- search for mobile -->
            <div class="fixed top-14 " v-if="showDropDown">
                        <div class=" w-screen flex justify-between px-10   bg-cyan-50 text-gray-500  text-center border-cyan-300 border-y-[1px]  py-2">
                            <input v-model="searchData.filter"  type="text" class="w-[80%]  px-4 bg-cyan-100 h-10 rounded-full text-cyan-700 focus:border-cyan-400  focus:outline-none  focus:border-2   border-[1px] border-cyan-300 mr-2">
                            <button @click="search" class="bg-cyan-100 h-10 w-12 rounded-full border-[1px] text-cyan-700  border-cyan-300  ">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>

                        </div>
                </div>

            <!-- Content Section -->

            <div v-if="showOrIndex" class="  bg-cyan-50 w-full px-12 flex justify-around flex-wrap pt-8">
                <div v-if="this.books == ''" class="flex flex-col justify-center items-center  w-full" >
                    <img src="../../../public/searchnotfound.png" class="w-40 h-40 mr-4" alt="" srcset="">
                    <h1 class="text-cyan-700 text-2xl w-72">We're sorry, but the book you searched  for is not currently in our collection</h1>
                </div>
                <div v-for="book in books" :key="book.id" class="w-96 md:w-60 ml-2   bg-cyan-100 border mt-6 flex flex-col justify-between items-center border-gray-200 rounded-xl shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-2">
                        <img class="rounded-t-lg h-48" :src=imagepath(book.image_id) alt="" />
                    </div>
                    <div class="pl-3 pb-3 pr-1  w-full">
                        <h6 class="mb-2 text-xl font-bold tracking-tight text-cyan-600 dark:text-white">{{ book.name }}</h6>
                        <p class="mb-3  font-normal text-cyan-500 dark:text-gray-400">
                            Category : {{ book.category }}
                        </p>                           
                        <p class="mb-3 font-normal text-cyan-500 dark:text-gray-400">
                           Author : {{ book.author }}
                        </p>
                        <p class="mb-3 font-normal text-cyan-500 dark:text-gray-400">
                           Book-Type : {{ book.book_type }}
                        </p>
                       <div class="flex justify-between pr-4">
                            <button @click="showDescription(book.description)"  class="inline-flex cursor-pointer items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                 Description
                            </button>
                            <div v-for="role,index in this.authuser.role" :key="index">
                                <button v-if="book.book_type == role.name" class="rounded-full max-lg:hidden h-10 w-10 bg-cyan-400 text-blue-900" >
                                    <a :href="'http://localhost:8000/storage/pdf/'+book.file_id">
                                        <i class="fa-solid fa-book-open"></i>
                                    </a>
                                </button>
                            </div>
                             <button class="rounded-full h-10 lg:hidden w-10 bg-cyan-400 text-blue-900" @click="download(book.file_id)" >
                                <i class="fa-solid fa-file-arrow-down"></i>
                            </button>
                       </div>
                    </div>
                </div>             
            </div>

            <!-- This is for description -->
            <div v-if="!showOrIndex" class="  w-full flex justify-center items-start">
                <p  class="block w-full px-16 pt-4  bg-cyan-50 pb-2  rounded-lg  mt-2">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Description</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400"> &nbsp &nbsp &nbsp &nbsp{{ this.description  }}</p>
                    <button @click="this.showOrIndex = true"   class="mt-2 inline-flex cursor-pointer items-center px-3 py-2 text-sm font-medium text-center text-white bg-slate-700 rounded-lg hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">
                        Close
                    </button>
                </p>
            </div>



        </div>
       
    </div>
</template>

<script>
import ApiServices from '../../../services/ApiServices';
import TokenServices from '../../../services/TokenServices';

export default {
  
    data(){
        return{
            accountDropDown:false,
            authuser:'',
            categorys:'',
            drawer : false,
            authors:'',
            books:'',
            showDropDown : false,
            showOrIndex:true,
            description:'',
            filterData:{
                category: '',
                author:''
            },
            searchData:{
                filter : ''
            }
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
                console.log(res);
                this.authuser = res.data.data
            }).catch((err)=>console.log(err))
        },
        filter(category,author){
            this.filterData.category = category;
            this.filterData.author = author
            ApiServices.post("filter",this.filterData).then(res=>{
                        this.books = res.data.data
                        console.log(res.data.data);
                    }).catch(res=>{
                        console.log(res.response.data.message);
                    })
        },
        download(file){
            ApiServices.get('download/'+file).then(res=>{
                        const url = window.URL.createObjectURL(new Blob([res.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download',file.slice(11));
                        document.body.appendChild(link);
                        link.click();

                    }).catch(res=>{
                    console.log(res);
                    })
        },
        search(){
            this.showDropDown =false;
            ApiServices.post("search",this.searchData).then(res=>{
                        this.books = res.data.data
                        console.log(res.data.data);
                    }).catch(res=>{
                        console.log(res.response.data.message);
                    })
        },
        showDescription(des){
            this.showOrIndex = false,
            this.description = des
        },
        controlDrawer(){
            this.drawer = true
        },
        imagepath(image){
            return 'http://localhost:8000/storage/image/' + image;
        },
        getData :  function(){
            let self = this;
            console.log(self.authors);
             ApiServices.get('getcategories').then(res=>{
                    self.categorys = res.data.data
                    }).catch(res=>{
                    console.log(res);
                    })
            
             ApiServices.get('getauthors').then(res=>{
                        self.authors = res.data.data
                    }).catch(res=>{
                        console.log(res);
                    })
            
             ApiServices.get("getproducts").then(res=>{
                        self.books = res.data.data
                    }).catch(res=>{
                        console.log(res);
                    })
        }

    },
    mounted(){
        this.setAuthUser()
        this.getData();
    }
}
</script>

<style>

</style>