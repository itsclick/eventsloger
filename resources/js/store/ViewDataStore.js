import axios from "axios";
import { defineStore } from "pinia";
import router from "@/router"; // Correct global router import
import { menustore } from "./menus";



export const useViewDataStore = defineStore("useViewDataStore", {
    
    // STATE
    state: () => ({
        sysmenus: [],
        sysmenuspaginate: [],
        eventlist: [],
        eventpaginate: [],
       formvalue:'',
        


        
        
    }),

    // GETTERS
    getters: {
        menuAccess() { 
            
            return this.menustore.getAccess;
        },
    },

    // ACTIONS
    actions: {

        //route to event form
        async eventformbtn(id) {
             router.push(`/eventform/${id}`);
        },

        //route to call event edit form
                async editEventbtn(id){
                    router.push(`/editEventbtn/${id}`);
        },
        
                //route to call participant list details
                async viewparticipantbtn(id){
                    router.push(`/paticipantdetails/${id}`);
        },
                
                

         async geteventbyid(id) {
            try {
                const res = await axios.get(`/api/events/eventbyid/${id}`);
                this.formvalue = res.data.data || {}; 
                console.log("event ID:", this.formvalue);
            } catch (error) {
                console.error("Error loading event id:", error);
                this.formvalue = null;
            }
        },
         
         
        


         //function to get all system menus
     async getallsysmenus() {
        try {
            const res = await axios.get('/api/users/getallmenus');
            this.sysmenus = res.data.data // use state property
        } catch (error) {
            console.error('Failed to load groups:', error);
        }
        },
        

        //list of all events 
        async fetchallevents(page = 1) {
        try {
            const res = await axios.get(`/api/events/alleventlist/?page=${page}`);
            this.eventlist = res.data.data.data // use state property
            this.eventpaginate=res.data.data
        } catch (error) {
            console.error('Failed to load groups:', error);
        }
        },



          
        
        







    },










});
