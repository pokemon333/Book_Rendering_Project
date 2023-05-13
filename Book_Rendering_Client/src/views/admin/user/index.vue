<template>
    <div class="flex justify-center items-center center">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>   
                    <th scope="col" class=" py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-slate-200 cursor-pointer"
                    v-for="row,index in rows" :key="row.id" @click="this.userRoleHandler(row)">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                        {{ row.id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ row.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ row.email }}
                    </td>
                    <td class="px-6 py-4  flex  " >

                        <div >
                            <div v-if="row.role.length == 4" class="mr-2 text-red-500" @click="roleSubmit('admin',)">
                            Admin
                            </div>
                            <div v-if="row.role.length == 3" class="mr-2 text-yellow-500" @click="roleSubmit('gold')">
                                Gold
                            </div>
                            <div v-if="row.role.length == 2" class="mr-2 text-slate-500" @click="roleSubmit('silver')">
                                Silver
                            </div>
                            <div v-if="row.role.length == 1" class="mr-2 text-green-500" @click="roleSubmit('free')">
                                Free
                            </div>
                        </div>

                        <div v-if="index === this.indexNumber && this.showOrIndex">
                            <button v-if="index === this.indexNumber && this.showOrIndex"  @click="this.roleDropDown = !this.roleDropDown" class="text-slate-500 border-2 border-slate-300 hover:cursor-pointer bg-white hover:bg-slate-100 focus:outline-none  font-medium rounded-sm text-sm px-1 py-1 text-center inline-flex items-center   " type="button"> Role Edit <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                            <div id="dropdown" class="z-10  bg-white divide-y divide-gray-100 absolute rounded-lg shadow w-44 dark:bg-gray-700" v-if="roleDropDown" >
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <h1 @click="roleSubmit('admin',row.id)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Admin</h1>
                                </li>
                                <li>
                                    <h1 @click="roleSubmit('silver',row.id)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sliver</h1>
                                </li>
                                <li>
                                    <h1 @click="roleSubmit('gold',row.id)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Gold</h1>
                                </li>
                                <li>
                                    <h1 @click="roleSubmit('free',row.id)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Free</h1>
                                </li>
                                </ul>
                            </div>
                        </div>
            
                        <button @click="showOrIndexHandler(index)" v-if="index != this.indexNumber" class="ml-2">
                            <i class="fa-solid fa-pen-to-square">e</i>
                        </button>
                        <button @click="roleHandlerClose(index) " v-if="index === this.indexNumber" class="ml-2">
                            <i class="fa-solid fa-xmark">c</i>                        
                        </button>

                    </td>
                    <td class="px-1 w-32 ">
                        <button class="bg-slate-100 w-10 h-10 ml-2 rounded-md  hover:text-red-500" @click="remove(index)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import ApiServices from '../../../../services/ApiServices';

    export default {
        data() {
            return {
                rows : '',
                roleDropDown : false,
                showOrIndex : false,
                indexNumber : null
            }
        },
        methods :{
            getUser(){
                ApiServices.get('/alluser').then((res)=>{
                    this.rows = res.data.data;
                }
                ).catch(res=>console.log(res))
            
            },
            roleHandlerClose(number) {
                this.roleDropDown = false;
                this.indexNumber = null
                this.showOrIndex = false
            },
            showOrIndexHandler(number) {
                this.roleDropDown = false;
                this.indexNumber = number
                this.showOrIndex = true
            },
            roleSubmit(role,user){
                ApiServices.get(`/role/${role}/${user}`).then((res)=>{
                    this.getUser();
                }
            ).catch(res=>console.log(res))
            },
           
        },
        mounted() {
            this.getUser();
        }
    }
</script>