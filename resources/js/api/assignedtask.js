import { TASKLAND_CONFIG} from "../config";

export default {
    assignTaskTo: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post(TASKLAND_CONFIG.API_URL + '/assignTaskTo', data.data)
    }


}