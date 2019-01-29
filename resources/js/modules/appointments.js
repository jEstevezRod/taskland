/*
|-------------------------------------------------------------------------------
| VUEX modules/appointments.js
|-------------------------------------------------------------------------------
| The Vuex data store for the appointments in the calendar
*/

import {appointmentAPI} from "../api/appointment";
import { reject } from "q";


export const appointment = {

    state: {
        appointments: []
    },
    actions:{
        loadAppointments: function ( {commit}, data) {
            let token = window.localStorage.getItem('token');

            return new Promise( (resolve, reject) => {
                appointmentAPI.loadAppointments({ token, data})
                .then( response => {
                    console.log(response);
                    resolve(response.data)
                }, error => {
                    reject(error);
                })
            })
        }
    },
    mutations: {

    },
    getters: {

    }
}