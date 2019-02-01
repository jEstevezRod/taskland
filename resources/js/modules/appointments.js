/*
|-------------------------------------------------------------------------------
| VUEX modules/appointments.js
|-------------------------------------------------------------------------------
| The Vuex data store for the appointments in the calendar
*/

import appointmentAPI from "../api/appointment";

export const appointments = {

    state: {
        appointments: [],
        appointment: {}
    },
    actions:{

        loadAppointments: function ( {commit}) {

            let token = window.localStorage.getItem('token');

            return new Promise( (resolve, reject) => {

                appointmentAPI.loadAllAppointments({ token })
                    .then( response => {
                        console.log(response.data);
                        let appointmentsList = [];
                        for (let appointment of response.data) {
                            appointmentsList.push({
                                data: {
                                    title: appointment.title,
                                    description: appointment.description
                                },
                                from: appointment.from,
                                to: appointment.to,
                                date: appointment.date
                            })
                        }
                        commit('setAppointmentList', appointmentsList)
                        resolve(response.data)
                    }, error => {
                        reject(error);
                    })
            })
        },

        newAppointment: function ( {commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise( (resolve, reject) => {

                appointmentAPI.addAppointment({token, data})
                    .then( response => {
                        let appo = response.data.appointment;
                        let appointmentObject = {
                            data: {
                                title: appo.title,
                                description: appo.description
                            },
                            from: appo.from,
                            to: appo.to,
                            date: appo.date
                        };
                        commit('addAppointmentToList', appointmentObject)
                        resolve(response.data)
                    }, error => {
                        reject(error);
                    })
            })
        }

    },
    mutations: {

        setAppointmentList: (state, data) => state.appointments = data,

        addAppointmentToList: (state, data) => state.appointments.push(data)

    },
    getters: {

        getAppointments: (state) => state.appointments,

    }
}