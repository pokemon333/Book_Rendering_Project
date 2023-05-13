<template>
    <!-- main content wrapper -->
    <div v-if="!pageLoading" class="bg-cyan-50 h-{3000px}"  id="Home">

        
        <nav class="sticky top-0 bg-cyan-50  z-50">
            <div class=" h-12 flex justify-between">

                <!-- logo -->
                <div class="w-1/4 h-full flex justify-start px-1  items-center">
                    <div class="flex justify-start text-cyan-700  items-center h-20 p-6">
                        <p class="text-4xl h-9 w-8 border-slate-300 border-r-2">B</p>
                        <p class="ml-2 text-cyan-400">Brighter</p>
                    </div>
                </div>

                
                <!-- menu for mobile -->
                <div class="w-1/4 h-full  justify-end px-4 items-center hidden max-sm:flex">
                    <button @click="this.showDropDown = !this.showDropDown"> 
                        <i class="fa-solid fa-bars fa-xl   text-cyan-400 cursor-pointer"></i>
                    </button>
                </div>

                <!-- drop down component -->
                <div class="fixed top-11 " v-if="showDropDown">
                        <div class=" w-screen flex justify-between px-10   bg-cyan-50 text-gray-500  text-center border-cyan-300 border-y-[1px]  py-2">
                                <a href="#Home" data-aos="zoom-in" >Home</a> 
                                <a href="#About" class="ml-2" data-aos="zoom-in">About</a>
                                <a href="#contact" class="ml-2" data-aos="zoom-in">Contact</a>
                                <button @click="this.$router.push({name : 'login'})" class="bg-cyan-300 w-28 h-7 ml-2  rounded-sm hover:bg-cyan-400 text-cyan-800  shadow-cyan-500 shadow-sm" data-aos="zoom-in">
                                    SignIn 
                                </button>
                        </div>                
                </div>

                <!-- for desktop -->
                <div class="w-3/4 h-full hidden justify-end px-2  items-center min-[700px]:flex">
                    <div class="w-2/4 text-cyan-800 flex justify-between p-2">
                        <a href="#Home" class="hover:text-cyan-400 ml-2" >Home</a> 
                        <a href="#About"  class="hover:text-cyan-400 ml-2">About</a>
                        <a href="#contact"  class="hover:text-cyan-400 ml-2">Contact</a>
                        <button  @click="this.$router.push({name : 'login'})" class="bg-cyan-300 w-28 h-7 ml-2  rounded-sm hover:bg-cyan-400 text-cyan-800  shadow-cyan-500 shadow-sm">
                                    SignIn 
                                    <i class="fa-solid fa-right-to-bracket  ml-2"></i>
                         </button>
                    </div>
                </div>

            </div>
        </nav>  

        <!-- Home section -->
        <div class="h-[600px] w-full flex flex-col justify-start py-44 items-center bg-cyan-50 " data-aos="zoom-in"   >
                <div class=" flex flex-col justify-end  items-center ">
                    <img src="../../public/flowerbgbook.png"  class="absolute h-72 mb-8"  style="border-radius: 30px;">
                    <div class="h-40  bg-cyan-300 w-60 rounded-xl ">
                    </div>
                </div>
                <div class="mt-2  flex flex-col justify-center items-center">
                    <h1 class="text-2xl text-cyan-700 mb-2 lg:my-4">Welcome to Brighter!</h1>
                    <p class="w-[60%] text-center text-cyan-500 lg:leading-10 ">
                         your one-stop shop for book downloads! With a vast collection of titles and easy-to-use platform, you'll find all your favourite reads in no time.
                    </p>
                    <button  @click="this.$router.push({name : 'login'})"  class="bg-cyan-300 w-28  h-7 ml-2 mt-4 rounded-sm hover:bg-cyan-400 text-cyan-800  shadow-cyan-500 shadow-sm">
                        SignIn 
                        <i class="fa-solid fa-right-to-bracket  ml-2"></i>
                    </button>
                </div>
        </div>

        <div class=" w-full h-screen" id="About">
            <!-- Header -->
            <div class="flex justify-center items-center mb-8">
                <h1 class="text-2xl text-cyan-700">About Us</h1>
            </div>

            <div class="   max-sm:w-full  max-sm:h-[420px]  max-sm:flex-col   flex items-center justify-between md:px-40  lg:px-60 ">
                <div class="bg-cyan-300 rounded-[30px] w-64 h-64 " data-aos="zoom-in-right">
                    <img src="../../public/gitlsmallfile.png" class="h-full w-full" >
                </div>
                <div class="flex items-center flex-col  md:w-80 lg:leading-8 ">
                    <h1 class="text-2xl text-cyan-700 mt-4 mb-4 " data-aos="fade-up">Reduce Screentime</h1>
                    <p class="w-[60%] text-center text-cyan-500 mb-4  " data-aos="fade-up">
                        This website is designed for kids to reduce screen time and gain knowledge from books.
                    </p>
                </div>
            </div>

            <div class="  max-sm:w-full  max-sm:h-[420px]  bg-cyan-50  max-sm:flex-col   flex items-center justify-between md:px-40  lg:mt-20 md:mt-8 lg:px-60  ">
                <div class="bg-cyan-300 rounded-[30px] w-64 h-64 " data-aos="zoom-in-right">
                    <img src="../../public/library_07-removebg-preview-min.png" class="h-full w-full" alt="">
                </div>
                <div class="flex items-center flex-col  md:w-80 md:order-first lg:leading-8 ">
                    <h1 class="text-2xl text-cyan-700 mb-2  max-sm:mt-2  max-sm:mb-2" data-aos="fade-up">Collection</h1>
                    <p class="w-[60%] text-center text-cyan-500 " data-aos="fade-up">
                        We want to provide a large variety of books for download in one place and in the easiest way possible, preferably in .pdf format                
                    </p>
                </div>
            </div>

            <div class=" h-32 pt-12  text-center bg-cyan-50 " id="contact">
                <h1 class="text-cyan-700 text-xl mb-4">Contact Us</h1>
               <div class="px-8 flex justify-center">
                <a href=""><i class="fa-solid fa-envelope fa-xl text-gray-400 hover:text-red-500"></i></a>
                <a href=""><i class="fa-brands fa-telegram fa-xl ml-4 text-gray-400 hover:text-blue-500"></i></a>
                <a href=""><i class="fa-solid fa-address-book fa-xl ml-4 text-gray-400 hover:text-amber-700"></i></a>
               </div>
            </div>
        </div>
    </div>
</template>
<script>
import ApiServices from '../../services/ApiServices';
import TokenServices from '../../services/TokenServices';

export default {
    data(){
        return {
            'pageLoading' : false,
            showDropDown: false
        }
    },
    components:{
      
    },
    methods:{
       
    },
    mounted(){
        let token = TokenServices.getToken();
        if (token) {
            this.$router.push({name : 'client'});    
        }
    }
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,400&display=swap');

*{
    font-family: 'Playfair Display', serif;
}
</style>