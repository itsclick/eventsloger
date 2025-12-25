import axios from "axios";
import { defineStore } from "pinia";
import router from "@/router"; // Correct global router import
import { menustore } from "./menus";
import { useViewDataStore } from "./ViewDataStore";



export const useSaveDataStore = defineStore("useSaveDataStore", {
    
    // STATE
    state: () => ({
        saveloader: false,
        showErrro: false,
        Erromsg: "",
        toastsuccess:'',
        


        
        
    }),

    // GETTERS
    getters: {
        
    },

    // ACTIONS
    actions: {


      async saveEventForm(eventId, fields,user_id) {
  if (!fields || fields.length === 0) {
    Swal.fire("Warning", "At least one field is required", "warning");
    return;
  }

  this.saveloader = true;

  try {
    const payload = {
       user_id: user_id,
      fields: fields.map((field, index) => ({
        label: field.label,
        name: field.name,
        type: field.type,
        required: field.required ? 1 : 0,
        options: field.options ?? null,
        position: index + 1,
      })),
    };

    const response = await axios.post(`/api/events/Addeventform/${eventId}`, payload, {
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    });

    if (response.data.ok) {
      Swal.fire({
        icon: "success",
        title: "Form Saved",
        text: response.data.msg || "Form saved successfully",
        timer: 2000,
        showConfirmButton: false,
      });

      router.push("/evaddevents"); // Redirect back to events list
    }
  } catch (error) {
    if (error.response?.status === 422) {
      const errors = Object.values(error.response.data.errors).flat().join("\n");
      Swal.fire("Validation Error", errors, "error");
    } else {
      Swal.fire("Error", "Failed to save form", "error");
    }
  } finally {
    this.saveloader = false;
  }
},



        // SAVE member
        async saveevents(groupform) {
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post("/api/events/saveevents", groupform);

                this.saveloader = false;

                Swal.fire({
                    icon: 'success',
                    
                    title: res.data.msg,
                    showConfirmButton: false,
                    timer: 3000,
                    width: '500px',
                    position: 'center',
                    customClass: {
                      popup: 'swal-wide'
                    }
                  });


                

                // Redirect (CORRECT)
                router.push("/evaddevents");

            } catch (err) {
                this.saveloader = false;
                this.showErrro = true;

                this.Erromsg = err.response?.data?.msg || "Failed to save member";

                Swal.fire({
                    icon: 'error',
                    
                    title: this.Erromsg,
                    showConfirmButton: false,
                    timer: 3000,
                    width: '500px',
                    position: 'center',
                    customClass: {
                      popup: 'swal-wide'
                    }
                  });

                
            }
        },


              
        //SAVE savemenu 
        async savemenus(groupform) {
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post("/api/users/savemenus", groupform);

                this.saveloader = false;


                Swal.fire({
                    icon: 'success',
                    
                    title: res.data.msg,
                    showConfirmButton: false,
                    timer: 3000,
                    width: '500px',
                    position: 'center',
                    customClass: {
                      popup: 'swal-wide'
                    }
                  });


               

                // Redirect (CORRECT)
                router.push("/menus");

            } catch (err) {
                this.saveloader = false;
                this.showErrro = true;

                this.Erromsg = err.response?.data?.msg || "Failed to save Group Information";

                Swal.fire({
                    icon: 'error',
                    
                    title: this.Erromsg,
                    showConfirmButton: false,
                    timer: 3000,
                    width: '500px',
                    position: 'center',
                    customClass: {
                      popup: 'swal-wide'
                    }
                  });

                
            }
      },
        
        
        
        //update event
         async updateevent(fromvalue,id){
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post(`/api/events/updateevent/${id}`, fromvalue);

                this.saveloader = false;

                Swal.fire({
                    icon: 'success',
                    
                    title: res.data.msg,
                    showConfirmButton: false,
                    timer: 3000,
                    width: '500px',
                    position: 'center',
                    customClass: {
                      popup: 'swal-wide'
                    }
                  });


               

                // Redirect (CORRECT)
                router.push("/evaddevents");

            } catch (err) {
                this.saveloader = false;
                this.showErrro = true;

                this.Erromsg = err.response?.data?.msg || "Failed to save member";

                Swal.fire({
                    icon: 'error',
                    title: this.Erromsg,
                    showConfirmButton: false,
                    timer: 3000,
                    width: '500px',
                    position: 'center',
                    customClass: {
                      popup: 'swal-wide'
                    }
                  });


                
            }
        },
    




        
        







    },










});
