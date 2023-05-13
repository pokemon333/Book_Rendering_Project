import ApiServices from '../../services/ApiServices'

export default {
  install: (app) => {
    app.config.globalProperties.$api = ApiServices
  }
}