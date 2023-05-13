import { defineStore } from "pinia";
import TokenServices from "../services/TokenServices";
import ApiServices from "../services/ApiServices";

export const authStore = defineStore("auth",  {
    state: () => {
        return {
            user: {},
            authenicated: !!TokenServices.getToken(), 
            errors: {},
        }
    },
    
    actions: {
        setAuth(user){
            this.user= user,
            this.authenicated = true;
        },
        purgeAuth(){
            this.user= {};
            this.authenicated= false;;
            TokenServices.destroyToken();
        },
        setError(error){
            this.errors = error;
        },
        verifyAuth() {
            if (TokenServices.getToken()) {
                ApiServices.get("user")
                    .then(({ data }) => {
                      this.setAuth(data.data)     
                    })
                    .catch(({ response }) => {
                        this.setError(response);
                        this.purgeAuth();
                    });
                } else {
                    this.purgeAuth();
                }
        },
    },
});