<template>
    <div class="bg-cyan-50 h-screen">
        <div class="w-100 h-screen flex justify-center items-center">
            <div class="w-92 rounded-md bg-cyan-100  text-cyan-600 p-5">
                <div class="flex justify-end p-2">
                    <h1 class="  text-xl ">Sign Up</h1>
                </div>
                <form action="">
                    <div class="relative z-0 w-full mb-3 group ">
                        <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-cyan-400 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required v-model="form.name"/>
                        <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm  dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6" >Name</label>
                        <p class="text-red-500" v-if="validation.name ">{{ this.validation.name }}</p>
                    </div> 
                    <div class="relative z-0 w-full mb-3 group">
                        <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-cyan-400 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required v-model="form.email"/>
                        <label for="floating_email" class="peer-focus:font-medium absolute text-sm  dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6" >Email</label>
                        <p class="text-red-500"  v-if="validation.email ">{{ this.validation.email }}</p>
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <input type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-cyan-400 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required v-model="form.password"/>
                        <label for="floating_password" class="peer-focus:font-medium absolute text-sm  dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                        <p class="text-red-500"  v-if="validation.password ">{{ this.validation.password }}</p>
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <input type="password" name="floating_password" id="floating_password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-cyan-400 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required  v-model="form.confirm_password"/>
                        <label for="floating_password_confirmation" class="peer-focus:font-medium absolute text-sm  dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">confirm_password</label>
                        <p class="text-red-500"  v-if="validation.confirm_password ">{{ this.validation.confirm_password }}</p>
                    </div>
                    <n-button strong secondary type="success" class="bg-cyan-500 mt-2 text-cyan-100" @click="formSubmit">
                        Sign Up
                    </n-button>
                    <button class="ml-2" @click="this.$router.push({name : 'login'})">Already have an account? </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ApiServices from '../../../services/ApiServices'
import TokenServices from '../../../services/TokenServices.js'

export default {
    data() {
        return {
            'form' :{
                'name' : '',
                'email':'',
                'password':'',
                'confirm_password':''
            },
           'validation':{
            'name' : '',
            'email':'',
            'password':'',
            'confirm_password':''
           }
        }
    },
    methods : {
        formSubmit() {
            ApiServices.post('user/register',this.form)
            .then(res => {
                TokenServices.saveToken(res.data.data.token)
                this.$router.push({name : 'client'});    
            })
            .catch(err=>{           
                 console.log(err);
                let error = err.response.data.errors
                this.validation.name = error.name ? error.name[0] : ''
                this.validation.email = error.email ?error.email[0] :''
                this.validation.password = error.password ?error.password[0] :''
                this.validation.confirm_password = error.confirm_password ?error.confirm_password[0]:''
            })
        },
    },
    mounted() {
        let token = TokenServices.getToken();
        if (token) {
            this.$router.push({name : 'client'});    
        }
    }
}
</script>
