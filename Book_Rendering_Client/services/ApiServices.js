import axios from 'axios'
import TokenServices from './TokenServices';

const apiAxios = axios.create({
   baseURL: 'http://localhost:8000/api/',
 });

 apiAxios.interceptors.request.use(
  config => {
    const token = TokenServices.getToken();
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
);

 class ApiServices{
 

 static get = (url)=> apiAxios.get(url)

 static post = (url,data)=> apiAxios.post(url,data)

 static patch = (url,data)=>  apiAxios.patch(url,data)

 static put =  (url,data)=> apiAxios.put(url,data)

 static delete = (url)=>apiAxios.delete(url)

 }

 export default ApiServices