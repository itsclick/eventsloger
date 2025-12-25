import axios from "axios";
import { defineStore } from "pinia";
import router from "@/router"; // Correct global router import
import { menustore } from "./menus";
import { useViewDataStore } from "@/store/ViewDataStore";



export const useDeleteDataStore = defineStore("useDeleteDataStore", {
    
    // STATE
    state: () => ({
        // sysmenus: [],
        // sysmenuspaginate: [],
        


        
        
    }),

    // GETTERS
    getters: {
        // menuAccess() { 
            
        //     return this.menustore.getAccess;
        // },
    },

    // ACTIONS
    actions: {



              
 
        // Delete Event
        async deleteEvent(id) {
            const viewStore = useViewDataStore();
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to delete?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/events/deleteEvent/${id}`).then((resp) => {
                        if (resp.data.okay) {
                            Swal.fire({
                                icon: 'success',
                                title: resp.data.msg,
                                showConfirmButton: false,
                                timer: 3000,
                                width: '500px',
                                position: 'center',
                                customClass: {
                                  popup: 'swal-wide'
                                }
                              });
                            
                            
                            viewStore.fetchallevents(); // Refresh list
                        }
                    });
                }
            });
        },
    




        
        







    },










});
