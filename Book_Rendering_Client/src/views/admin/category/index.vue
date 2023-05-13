<template>
    <div class="w-100 h-screen flex justify-center items-center" v-if="pageLoading">
        <n-space>
            <n-spin size="medium" />
        </n-space>
    </div>
    
    <div v-if="!pageLoading">
        <div class="flex" style="height: 500px;">
            <div class="w-8/12    border-r-2 border-slate-300">

                <div v-if="message == 'created'" class="flex justify-between p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                    <i class="fa-solid fa-bell fa-xl mr-2"></i>                    
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Category</span> {{ this.message }} successfully.
                    </div>
                    <button @click="this.message =''">
                        <i class="fa-solid fa-circle-xmark fa-xl" ></i>
                    </button>
                </div>

                <div v-if="message == 'edited'"  class="flex p-4 justify-between text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
                    <i class="fa-solid fa-bell mr-2 fa-xl"></i>                    
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Category</span> {{ this.message }} successfully.
                    </div>
                    <button @click="this.message =''">
                        <i class="fa-solid fa-circle-xmark fa-xl" ></i>
                    </button>
                </div>

                <div v-if="message == 'deleted'"  class="flex p-4 justify-between text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <i class="fa-solid fa-bell mr-2 fa-xl"></i>                    
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Category</span> {{ this.message }} successfully.
                    </div>
                    <button @click="this.message =''">
                        <i class="fa-solid fa-circle-xmark fa-xl" ></i>
                    </button>
                </div>

                <div class="relative overflow-x-auto border-b-2">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   name
                                </th>
                                <th scope="col" class=" py-3">
                                   Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-slate-200 cursor-pointer" v-for="row,index in rows" :key="row.id" >
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" @click="show(index)">
                                  {{ row.id }}
                                </th>
                                <td class="px-6 py-4" @click="show(index)">
                                  {{ row.name }}
                                </td>
                                <td class="px-1 w-32 ">
                                    <button class="bg-slate-100 w-10 h-10 ml-2 rounded-md  hover:text-red-500" @click="remove(index)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            <a href="#"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div class="text-gray-500">
                                <i class="fa-solid fa-hand-pointer"></i>
                                Click to edit
                            </div>
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">{{ this.from }}</span>
                                    to
                                    <span class="font-medium">{{ this.to }}</span>
                                    of
                                    <span class="font-medium">{{ this.total }}</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    <button      class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" @click="prev" v-if="this.prev_page_url">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </button>
                                    <div v-for="page in totalPage">
                                        <button @click="pageChange($event)" :id="page"
                                        class="relative z-10 inline-flex items-center bg-cyan-400 hover:bg-cyan-500  border-x-2 rounded-md px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ page }}</button>
                                    </div>
                                    <button    class=" relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" @click="next" v-if="this.next_page_url">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center  mt-4 w-4/12">
                <div class="w-full max-w-xs" v-if="createOrShow">
                    <div class="bg-white border-slate-300 border-2 rounded-xl px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Category Create
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="username" type="text" placeholder="Create a category name. " v-model="formData.name">
                        </div>
                        <button class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded"
                            @click="formSubmit">
                            Create
                        </button>
                    </div>
                </div>
                <div class="w-full max-w-xs" v-if="!createOrShow">
                    <div class="bg-white border-slate-300 border-2 rounded-xl px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="username" type="text"  v-model="formData.name">
                        </div>
                        <button class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded"
                            @click="edit()">
                            Edit
                        </button>
                        <button class="bg-gray-400 ml-2 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            @click="this.createOrShow = true , this.formData.name =''">
                            close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ApiServices from '../../../../services/ApiServices';

export default {
    data() {
        return {
            message : '',
            createOrShow : true,
            rows : '',
            total:'',
            from : '',
            showData:{},
            to:'',
            perPage:'',
            totalPage:'',
            next_page_url:'',
            prev_page_url:'',
            formData: {
                name: ''
            },
            pageLoading: false,
        }
    },
    mounted() {
        this.pageLoading = true
        this.loadData(1);
    },
    methods: {
        remove(index){
            this.pageLoading = true;
            let id =  this.rows[index].id
            ApiServices.delete('categories/'+ id).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.formData.name = ''
                this.pageLoading = false
                this.message = 'deleted'
                setTimeout(()=>{this.message = ''},2000);

            }).catch(err => {
                console.log(err);
            })
        },
        show(index){
            this.createOrShow = false;
            this.showData = this.rows[index]
            this.formData.name = this.rows[index].name;
            console.log(this.showData);
        },
        loadData(params = '',url = 'categories?page='){
            ApiServices.get(url + params ).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.pageLoading = false
            }).catch(err => {
                console.log(err);
            })
        },
        pageChange($event){
           this.loadData($event.target.id);
        },
        next(){
            this.loadData('',this.next_page_url)
        },
        prev(){
            this.loadData('',this.prev_page_url)
            console.log();
        },
        formSubmit() {
            this.pageLoading = true;
            ApiServices.post('categories', this.formData ).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.formData.name = ''
                this.pageLoading = false
                this.message = 'created'
                setTimeout(()=>{this.message = ''},2000);
            }).catch(err => {
                console.log(err);
            })
        },
        edit(){
            ApiServices.patch('categories/'+ this.showData.id, this.formData ).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.formData.name = ''
                this.pageLoading = false
                this.showData = {}
                this.createOrShow = true
                this.message = 'edited'
                setTimeout(()=>{this.message = ''},2000);

            }).catch(err => {
                console.log(err);
            })
        }
    }
}

</script>