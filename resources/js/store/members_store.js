import axios from "axios";
import { defineStore } from "pinia";
import router from "@/router"; // Correct global router import
import { menustore } from "./menus";



export const useMemberStores = defineStore("memberStore", {
    
    // STATE
    state: () => ({
        membersmodel: [], 
        duesmodel: [],
        groupmodel: [],
        duesmodelpgin: [],
        getgroup:[],
        getallusersmodel:[],
        userpermission:[],
        sysmenus:[],
        duesid:'',
        formvalue:'',
        getgroups:'',
        countmembers: 0,
        countmale: 0,
        countfemale: 0,
        malePercent: 0,
        femalePercent: 0,
        totalgroups:0,
        groupmStats:'',
        
        saveloader: false,
        showErrro: false,
        Erromsg: "",
        toastsuccess:'',
        menustore:menustore(),
        
    }),

    // GETTERS
    getters: {
        menuAccess() { 
            
            return this.menustore.getAccess;
        },
    },

    // ACTIONS
    actions: {



         //function to get all system menus
     async getallsysmenus() {
        try {
            const res = await axios.get('/api/users/getallmenus');
            this.sysmenus = res.data.data // use state property
        } catch (error) {
            console.error('Failed to load groups:', error);
        }
    },
    




//get memberby id
async getuserpermission(user_id) {
    try {
        const res = await axios.get(`/api/users/userpermision/${user_id}`);
        this.userpermission = res.data.data || {}; 
       
    } catch (error) {
        console.error("Error loading member:", error);
        this.userpermission = null;
    }
},



async updatepermision(fromvalue){
    try {
        this.saveloader = true;
        this.showErrro = false;

        const res = await axios.post(`/api/users/updatepermission`, fromvalue);

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


    
          this.menustore.usermenumain();
       
        // Redirect (CORRECT)
        router.push("/users");
        

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




        
        //pay dues
        async paddues(id){
            router.push(`/paddues/${id}`);
        },
        
        //route to member edit
        async editmember(id){
            router.push(`/editmember/${id}`);
        },
        //get memberby id
        async getmemberid(id) {
            try {
                const res = await axios.get(`/api/membership/memberbyid/${id}`);
                this.formvalue = res.data.data || {}; 
                console.log("Member loaded:", this.formvalue);
            } catch (error) {
                console.error("Error loading member:", error);
                this.formvalue = null;
            }
        },

        //update member

        async updatedmember(fromvalue,id){
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post(`/api/membership/updatemember/${id}`, fromvalue);

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
                router.push("/members");

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


        // Delete Group
        async deletemember(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to delete?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/membership/deletemember/${id}`).then((resp) => {
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
                            
                            
                            this.getmembers(); // Refresh list
                        }
                    });
                }
            });
        },

        

        //save membership dues

        async duespayment(fromvalue){
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post(`/api/dues/savedues/`, fromvalue);

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
                router.push("/dues");

            } catch (err) {
                this.saveloader = false;
                this.showErrro = true;

                // this.Erromsg = err.response?.data?.msg ;
                this.Erromsg = err.response?.data?.msg || "Something went wrong";

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

        

     //function to get all groups in dropdown list
     async getgrouplist() {
        try {
            const res = await axios.get('/api/group/getgroups');
            this.getgroups = res.data; // use state property
        } catch (error) {
            console.error('Failed to load groups:', error);
        }
    },


    
        // Fetch all members
        async getmembers(page = 1) {
            try {
                const response = await axios.get(`/api/membership/getmembers?page=${page}`);
                this.membersmodel = response.data.data.data;
                this.duesmodelpgin = response.data.data;
            } catch (error) {
                console.error("Error loading dues:", error);
            }
        },

        // Fetch all system users
        async getallusers(page = 1) {
            try {
                const response = await axios.get(`/api/users/getallusers?page=${page}`);
                this.getallusersmodel = response.data.data.data;
                this.duesmodelpgin = response.data.data;
            } catch (error) {
                console.error("Error loading dues:", error);
            }
        },


        


        // SAVE member
        async savemembers(memberform) {
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post("/api/membership/savemembers", memberform);

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
                router.push("/members");

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




        // Fetch all dues
        async getalldues(page = 1) {
            try {
                const response = await axios.get(`/api/dues/getalldues?page=${page}`);
                this.duesmodel = response.data.duesdata.data;
                this.duesmodelpgin = response.data.duesdata;
            } catch (error) {
                console.error("Error loading dues:", error);
            }
        },

        async editdues(id){
 
             router.push(`/editdues/${id}`);
        },

        async getduesid(id){
            try {
                const response = await axios.get(`/api/dues/duesbyid/${id}`);
                this.formvalue = response.data.data;
                
            } catch (error) {
                console.error("Error loading dues:", error);
            }
        },

        async updateduesbyid(fromvalue,id){
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post(`/api/dues/updateddues/${id}`, fromvalue);

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
                router.push("/dues");

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

 


        // Delete dues
        async deletedues(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to delete?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/dues/deletedues/${id}`).then((resp) => {
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


                            

                            this.getalldues(); // Refresh list
                        }
                    });
                }
            });
        },


        




                // Fetch all Groups
                async allgroups(page = 1) {
                    try {
                        const response = await axios.get(`/api/group/allgroups?page=${page}`);
                        this.groupmodel = response.data.data.data;
                        this.duesmodelpgin = response.data.data;
                    } catch (error) {
                        console.error("Error loading dues:", error);
                    }
                },


                //SAVE GROUPS 
        async savegroup(groupform) {
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post("/api/group/savegroup", groupform);

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
                router.push("/groups");

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


        //SAVE savemenu 
        // async savemenus(groupform) {
        //     try {
        //         this.saveloader = true;
        //         this.showErrro = false;

        //         const res = await axios.post("/api/users/savemenus", groupform);

        //         this.saveloader = false;


        //         Swal.fire({
        //             icon: 'success',
                    
        //             title: res.data.msg,
        //             showConfirmButton: false,
        //             timer: 3000,
        //             width: '500px',
        //             position: 'center',
        //             customClass: {
        //               popup: 'swal-wide'
        //             }
        //           });


               

        //         // Redirect (CORRECT)
        //         router.push("/menus");

        //     } catch (err) {
        //         this.saveloader = false;
        //         this.showErrro = true;

        //         this.Erromsg = err.response?.data?.msg || "Failed to save Group Information";

        //         Swal.fire({
        //             icon: 'error',
                    
        //             title: this.Erromsg,
        //             showConfirmButton: false,
        //             timer: 3000,
        //             width: '500px',
        //             position: 'center',
        //             customClass: {
        //               popup: 'swal-wide'
        //             }
        //           });

                
        //     }
        // },


        //get group edit page
        async editgroup(id){
 
            router.push(`/editgroup/${id}`);
       },

        //get group by id
       async getgroupid(id){
        try {
            const response = await axios.get(`/api/group/groupbyid/${id}`);
            this.formvalue = response.data.data;
            
        } catch (error) {
            console.error("Error loading dues:", error);
        }
    },


        //get group by ID
        async getgroupbyid(id){
            try {
                const response = await axios.get(`/api/group/groupbyid/${id}`);
                this.formvalue = response.data.data;
                
            } catch (error) {
                console.error("Error loading dues:", error);
            }
        },

        async updatedgroupbyid(fromvalue,id){
            try {
                this.saveloader = true;
                this.showErrro = false;

                const res = await axios.post(`/api/group/updategroup/${id}`, fromvalue);

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
                router.push("/groups");

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


       


        // Delete Group
        async deletegroup(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to delete?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/group/deletegroup/${id}`).then((resp) => {
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

                            

                            this.allgroups(); // Refresh list
                        }
                    });
                }
            });
        },

        //membership statistics 
        async memberstats () {
            try {
                const response = await axios.get('/api/membership/countmembers');
        
                this.countmembers = response.data.totalmembers;
                this.countmale    = response.data.totalmale;
                this.countfemale  = response.data.totalfemale;
        
                // Avoid division by zero
                if (this.countmembers > 0) {
                    this.malePercent   = ((this.countmale / this.countmembers) * 100).toFixed(0);
                    this.femalePercent = ((this.countfemale / this.countmembers) * 100).toFixed(0);
                } else {
                    this.malePercent = 0;
                    this.femalePercent = 0;
                }
        
                // ✅ NO chart logic here
            } catch (error) {
                console.error(error);
            }
        },
        

       
        


        //Group statistics 
        async groupstats () {
            try {
                const response = await axios.get('/api/group/countgroup');
                this.totalgroups = response.data.totalgroups;
            } catch (error) {
                console.error(error);
            }
        },

        async groupMemberStats() {
            const res = await axios.get('/api/membership/countMembersPerGroup');
            this.groupmStats = res.data.data;
          }
          
        
        







    },










});
