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
        formvalue: '',
        eventguest: {},       // object instead of string
    participants: [],     // added participants
       
        


        
        
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
                async editEventbtn(eid){
                    router.push(`/editEventbtn/${eid}`);
        },
        
                //route to call participant list details
                async viewparticipantbtn(eid){
                    router.push(`/paticipantdetails/${eid}`);
        },
                
                
        // get event by ID
         async geteventbyid(eid) {
            try {
                const res = await axios.get(`/api/events/eventbyid/${eid}`);
                this.formvalue = res.data.data || {}; 
                console.log("event ID:", this.formvalue);
            } catch (error) {
                console.error("Error loading event id:", error);
                this.formvalue = null;
            }
        },
         
         //GET EVENT ID AND PARTICIPANTS
async geteventguests(eid) {
  try {
    // Use the correct route
    const res = await axios.get(`/api/events/events/eventbyeid/${eid}`);

    // Assign event object
    this.eventguest = res.data.data || {};

    // Parse participant data safely
    this.participants = (res.data.data?.registrations || []).map(p => {
      let parsed = {};
      try {
        parsed = JSON.parse(p.data || "{}");
      } catch (e) {
        console.error("Error parsing participant data:", e);
      }
      return { ...p, ...parsed };
    });

    console.log("Event guest:", this.eventguest);
    console.log("Participants:", this.participants);

  } catch (error) {
    console.error("Error loading event id:", error);
    this.eventguest = {};
    this.participants = [];
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
