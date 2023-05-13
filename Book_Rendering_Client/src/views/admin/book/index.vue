<template>
    <div class="w-100 h-screen flex justify-center items-center" v-if="pageLoading">
        <n-space>
            <n-spin size="medium" />
        </n-space>
    </div>

    <div v-if="!pageLoading">
        <div class="flex" style="height: 500px;">
            <div class="w-8/12  h-full  border-r-2 border-slate-300">

                <div class="flex p-4  text-sm text-red-800  border-y-2 border-red-300 bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert" v-if="validationMessages">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Danger</span>
                <div>
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 ml-4 list-disc list-inside" v-for="validationMessage,index in validationMessages">
                        <li>{{ validationMessage[0]}}</li>
                    </ul>
                </div>
                </div>

                <div v-if="message == 'created'"
                    class="flex justify-between p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <i class="fa-solid fa-bell fa-xl mr-2"></i>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Category</span> {{ this.message }} successfully.
                    </div>
                    <button @click="this.message = ''">
                        <i class="fa-solid fa-circle-xmark fa-xl"></i>
                    </button>
                </div>

                <div v-if="message == 'edited'"
                    class="flex p-4 justify-between text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                    role="alert">
                    <i class="fa-solid fa-bell mr-2 fa-xl"></i>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Category</span> {{ this.message }} successfully.
                    </div>
                    <button @click="this.message = ''">
                        <i class="fa-solid fa-circle-xmark fa-xl"></i>
                    </button>
                </div>

                <div v-if="message == 'deleted'"
                    class="flex p-4 justify-between text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                    role="alert">
                    <i class="fa-solid fa-bell mr-2 fa-xl"></i>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Category</span> {{ this.message }} successfully.
                    </div>
                    <button @click="this.message = ''">
                        <i class="fa-solid fa-circle-xmark fa-xl"></i>
                    </button>
                </div>

                <div class="relative overflow-x-auto border-b-2">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    id
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    name
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Book_Type
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Author
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Book_Type
                                </th>
                                <th scope="col" class=" py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-slate-200 cursor-pointer"
                                v-for="row, index in rows" :key="row.id">
                                <th scope="row"
                                    class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    @click="show(index)">
                                    {{ row.id }}
                                </th>
                                <td class="px-2" @click="show(index)">
                                    {{ row.name }}
                                </td>
                                <td class="px-2" @click="show(index)">
                                    {{ row.book_type }}
                                </td>
                                <td class="px-2" @click="show(index)">
                                    {{ row.category.name }}
                                </td>
                                <td class="px-2" @click="show(index)">
                                    {{ row.author.name }}
                                </td>
                                <td class="px-2" @click="show(index)">
                                    <n-image width="30" :src="path(row.image_id.image)"
                                    :previewed-img-props="{ style: { border: '8px solid white' } }"
                                    class="rounded-md "
                                     />
                                </td>
                                <td class="px-2" @click="show(index)">
                                    {{ this.textshort(row.description)  }}
                                </td>
                                <td class="px-2" @click="show(index)">
                                    {{ row.book_type }}
                                </td>
                                <td class="px-1 w-32 ">
                                    <button class="bg-slate-100 w-10 h-10 ml-2 rounded-md  hover:text-red-500"
                                        @click="remove(index)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:">
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
                                    <button
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                        @click="prev" v-if="this.prev_page_url">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </button>
                                    <div v-for="page in totalPage">
                                        <button @click="pageChange($event)" :id="page"
                                            class="relative z-10 inline-flex items-center bg-cyan-400 hover:bg-cyan-500  border-x-2 rounded-md px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{page }}</button>
                                    </div>
                                    <button
                                        class=" relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                        @click="next" v-if="this.next_page_url">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-3 w-4/12 overflow-auto">
                <div class="w-full max-w-xs" v-if="createOrShow">

                    <div class="bg-white border-slate-300 border-2 rounded-xl px-8 pt-2 pb-8 mb-4">
                        <div class="flex">
                            <div class="w-1/2 ">
                                <label class="block text-gray-700 text-sm font-bold mb-2 mt-4">
                                    Upload image
                                </label>
                                <n-image width="100"  :src="imageSrc"
                                    :previewed-img-props="{ style: { border: '8px solid white' } }"
                                    class="border-2 rounded-xl p-2 mt-4"
                                     />
                            </div>
                            <div class=" h-30 w-1/2 items-start ml-4 justify-end flex flex-col">
                                <div class="  justify-center w-22 h-10 ">
                                    <label for="dropzone-file"
                                        class=" border-2 border-slate-300 text-gray-500 bg-white rounded-sm  h-8 p-1  cursor-pointer ">
                                        <i class="fa-solid fa-image fa-xl"></i>
                                        <input id="dropzone-file" type="file" class="hidden"  @change="imageUpload($event)"/>
                                    </label>
                                </div>
                                <select v-model="formData.book_type"  class="bg-white w-24 h-8 border-slate-300 border-2 rounded-md focus:none" >
                                    <option value="" disabled selected>Book Type</option>
                                    <option value="free">Free</option>
                                    <option value="gold">Gold</option>
                                    <option value="silver">Silver</option>
                                    <option value="premium">Premium</option>
                                </select>
                                <select v-model="formData.category_id"  class="bg-white w-24 mt-2 h-8 border-slate-300 border-2 overflow-auto rounded-md focus:none" >
                                    <option value="" disabled selected>Category</option>
                                    <option :value="category.id" v-for="category,index in categoryOptions" :key="index" class="bg-white border-slate-300">{{ category.name }}</option>
                                </select>
                                <select v-model="formData.author_id" class="bg-white w-24 mt-2 h-8  border-slate-300 border-2 rounded-md focus:none">
                                    <option value="" disabled selected>Author</option>
                                    <option :value="author.id" v-for="author,index in authorOptions" :key="index" class="bg-white border-slate-300">{{ author.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="username">
                               Book Create
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Create a book name. " v-model="formData.name">
                            <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="username">
                                Upload PDF file
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               type="file" 
                               @change="fileUpload($event)"
                             >
                                
                        </div>
                        <div>
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Description</label>
                            <textarea id="message" v-model="formData.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your description for the book here..."></textarea>
                        </div>
                       <div class="flex mt-2"> 
                            <button class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded"
                                @click="formSubmit">
                                Create
                            </button>
                            <div>
                                <div class="flex items-center text-gray-500">
                                    <i class="fa-solid fa-image ml-2 mr-2  fa-xl text-xs "></i>
                                    <p >Click to uplaod image</p>
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <i class="fa-solid fa-magnifying-glass ml-2 mr-2  fa-xl text-sm"></i>
                                    <p>Click image for zoom</p>
                                </div>
                            </div>
                       </div>
                        
                    </div>
                </div>

                <div class="w-full max-w-xs" v-if="!createOrShow">
                    <div class="bg-white border-slate-300 border-2 rounded-xl px-8 pt-2 pb-8 mb-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2 mt-4">
                                    Upload image
                                </label>
                                <n-image width="100" :src="path(this.showData.image_id.image)"
                                    :previewed-img-props="{ style: { border: '8px solid white' } }"
                                    class="border-2 rounded-xl p-2"
                                     />
                             
                            </div>
                            <div class=" h-30 w-1/2 items-start ml-4  justify-end flex flex-col">
                                <div class="  justify-center w-22 h-10 ">
                                    <label for="dropzone-file"
                                        class=" border-2 border-slate-300 text-gray-500 bg-white rounded-sm  h-8 p-1  cursor-pointer ">
                                        <i class="fa-solid fa-image fa-xl"></i>
                                        <input id="dropzone-file" type="file" class="hidden"  @change="imageUpload($event)"/>
                                    </label>
                                </div>
                                <select v-model="formData.book_type"  class="bg-white w-24 h-8 border-slate-300 border-2 rounded-md focus:none" >
                                    <option value="" disabled selected>Book Type</option>
                                    <option value="free">Free</option>
                                    <option value="gold">Gold</option>
                                    <option value="silver">Silver</option>
                                    <option value="premium">Premium</option>
                                </select>
                                <select v-model="formData.category_id"  class="bg-white w-24 mt-2 h-8 border-slate-300 border-2 rounded-md focus:none" >
                                    <option value="" disabled selected>Category</option>
                                    <option :value="category.id" v-for="category,index in categoryOptions" :key="index" class="bg-white border-slate-300">{{ category.name }}</option>
                                </select>
                                <select v-model="formData.author_id" class="bg-white w-24 mt-2 h-8 border-slate-300 border-2 rounded-md focus:none">
                                    <option value="" disabled selected>Author</option>
                                    <option :value="author.id" v-for="author,index in authorOptions" :key="index" class="bg-white border-slate-300">{{ author.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="username">
                               Book Edit
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Create a book name. " v-model="formData.name">
                            <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="username">
                                Upload PDF file
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               type="file" 
                               @change="fileUpload($event)"
                             >
                                
                        </div>
                        <div>
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Description</label>
                            <textarea id="message" v-model="formData.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your description for the book here..."></textarea>
                        </div>
                       <div class="flex mt-2"> 
                            <button class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded"
                                @click="edit">
                                Edit
                            </button>
                            <div>
                                <button class="bg-gray-400 ml-2 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded"
                                    @click="this.createOrShow = true , this.formData.name =''">
                                    close
                                </button>
                            </div>
                       </div>
                        
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
            colum:'',
            imageSrc : '../../../../booklogo.png',
            validationMessages:'',
            categoryOptions: [],
            authorOptions: [],
            message: '',
            createOrShow: true,
            rows: '',
            total: '',
            from: '',
            showData: {},
            to: '',
            perPage: '',
            totalPage: '',
            next_page_url: '',
            prev_page_url: '',
            formData: {
                name : '',
                image_id: '',
                file_id: '',
                description: '',
                author_id: '',
                category_id: '',
                book_type:'',
            },
            pageLoading: false,
        }
    },
    mounted() {
        ApiServices.get('categories').then(response => {
                this.categoryOptions = response.data.data.data
                console.log(this.categoryOptions);
            }).catch(err => {
                console.log(err);
            })
        ApiServices.get('authors').then(response => {
                this.authorOptions = response.data.data.data
                console.log(this.authorOptions);
            }).catch(err => {
                console.log(err);
            })
        this.loadData(1);
    },
    methods: {
        textshort(text){
        return text.slice(0,12);
        },
        path(filename){
            return 'http://localhost:8000/storage/image/'+ filename
        },
        fileUpload($event){
            const formData = new FormData();
            formData.append('file', $event.target.files[0]);
            ApiServices.post('files',formData, {
            }).then(res=>{this.formData.file_id = res.data.data}).catch(err=>{alert('err')})
        },
        imageUpload($event){
            const formData = new FormData();
            formData.append('image', $event.target.files[0]);
            ApiServices.post('images',formData, {
            }).then(res=>{this.formData.image_id = res.data.data}).catch(err=>{alert('err')})
            this.imageSrc = URL.createObjectURL($event.target.files[0]);
            console.log(this.imageSrc);
        },
        remove(index) {
            this.pageLoading = true;
            let id = this.rows[index].id
            ApiServices.delete('books/' + id).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.pageLoading = false
                this.message = 'deleted'
                setTimeout(() => { this.message = '' }, 2000);

            }).catch(err => {
                console.log(err);
            })
        },
        show(index) {
            this.createOrShow = false;
            this.showData = this.rows[index]
            this.formData.name = this.rows[index].name;
            this.formData.book_type = this.rows[index].book_type;
            this.formData.description = this.rows[index].description;
            this.formData.category_id = this.rows[index].category.id;
            this.formData.author_id = this.rows[index].author.id;
            this.formData.image_id = this.rows[index].image_id.id 
            this.formData.file_id = this.rows[index].file_id 
            console.log(this.formData);
        },
        loadData(params = '', url = 'books?page=') {
            this.pageLoading = true
            ApiServices.get(url + params).then(response => {
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
        pageChange($event) {
            this.loadData($event.target.id);
        },
        next() {
            this.loadData('', this.next_page_url)
        },
        prev() {
            this.loadData('', this.prev_page_url)
            console.log();
        },
        formSubmit() {
            console.log(this.formData);
            this.pageLoading = true;
            ApiServices.post('books', this.formData).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.formData.name = ''
                this.formData.book_type = ''
                this.formData.description = ''
                this.formData.category_id = ''
                this.formData.author_id = ''
                this.formData.image_id = ''
                this.formData.file_id = ''
                this.imageSrc = '../../../../booklogo.png',
                this.pageLoading = false
                this.validationMessages = '';
                this.message = 'created'
                setTimeout(() => { this.message = '' }, 2000);
            }).catch(err => {
                this.pageLoading = false
                this.validationMessages = err.response.data.errors
                setTimeout(() => { this.validationMessages = '' }, 5000);
            })
        },
        edit() {
            ApiServices.patch('books/' + this.showData.id, this.formData).then(response => {
                this.rows = response.data.data.data;
                this.total = response.data.data.total;
                this.from = response.data.data.from;
                this.to = response.data.data.to;
                this.totalPage = response.data.data.last_page;
                this.next_page_url = response.data.data.next_page_url;
                this.prev_page_url = response.data.data.prev_page_url;
                this.showData = ''
                this.formData.name = ''
                this.formData.book_type = ''
                this.formData.description = ''
                this.formData.category_id = ''
                this.formData.author_id = ''
                this.formData.image_id = ''
                this.formData.file_id = ''
                this.pageLoading = false
                this.showData = {}
                this.createOrShow = true
                this.message = 'edited'
                setTimeout(() => { this.message = '' }, 2000);

            }).catch(err => {
                console.log(err);
            })
        }
    }
}

</script>