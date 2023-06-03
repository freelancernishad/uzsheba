import Vue from "vue";
import Vuex from 'vuex';
Vue.use(Vuex)



const store = new Vuex.Store({
    state:{
        // bookList:['Book 1','Book 2','Book 3','Book 4']
        Users:{},
        Unions:[
            {
                enname:'Chilahati',
                bnname:'চিলাহাটি',
            },
            {
                enname:'Shaldanga',
                bnname:'শালডাঙ্গা',
            },
            {
                enname:'Debiganj Sadar',
                bnname:'দেবীগঞ্জ সদর',
            },
            {
                enname:'Pamuli',
                bnname:'পামুলী',
            },
            {
                enname:'Sundardighi',
                bnname:'সুন্দরদিঘী',
            },
            {
                enname:'Sonahar Mollikadaha',
                bnname:'সোনাহার মল্লিকাদহ',
            },
            {
                enname:'Tepriganj',
                bnname:'টেপ্রীগঞ্জ',
            },
            {
                enname:'Dandopal',
                bnname:'দন্ডপাল',
            },
            {
                enname:'Debiduba',
                bnname:'দেবীডুবা',
            },
            {
                enname:'Chengthi Hazra Danga',
                bnname:'চেংঠী হাজরা ডাঙ্গা',
            }
        ],
        userPermission:{},
        userRoles:{},
        sonodName:{
            bnname:"নাগরিকত্ব সনদ",
            created_at:null,
            enname:"Citizenship certificate",
            template:null,
            updated_at:null
        },
        siteType:'',
        unioun_name:'',
        sonodNameList:{},
        unionInfo:{},
        vatTax:{},

    },// as like data(){return:{}}
    mutations:{
        // ADD_BOOK(state,data){
        //     state.bookList.push(data)
        // },
        // //method 2 direct call
        // REMOVE_BOOK(state,index){
        //     state.bookList.splice(index,1)

        // }


        setUpdateSonodName(state,data){
            state.sonodName = data
        },
        setUpdateSonodNames(state,data){
            state.sonodNameList = data
        },
       async setUpdateUser(state,data){
            state.Users = data

        },


        setUserPermission(state,data){
            state.userPermission = data
        },


        setUserRoles(state,data){
            state.userRoles = data
        },

        setvatTax(state,data){
            state.vatTax = data
        },


        setWebsiteStatus(state,data){


            // if(data=='salbahan')window.location.href='https://uniontax.gov.bd/'
            if(data.subdomainget!='main'){

                axios.post(`/api/union/info?union=${data.subdomainget}`)
                .then((res)=>{
                    // console.log(unionname);
                    // console.log(res);
                    state.unionInfo = res.data
                })
                state.unioun_name = data
                state.siteType = 'Union'
            }else{
                state.siteType = 'main'
            }




        }

    },
    getters:{

        getUpdateSonodName(state){
            return state.sonodName
        },
        getUpdateSonodNames(state){
            return state.sonodNameList
        },
        getUpdateUser(state){
            return state.Users
        },

        getUserPermission(state){
            return state.userPermission
        },

        getUserRoles(state){
            return state.userRoles
        },

        getUnions(state){
            return state.Unions
        },
        getType(state){
            return state.siteType
        },
        getUnion(state){
            return state.unioun_name
        },
        getunionInfos(state){
            return state.unionInfo
        },

      getvatTax(state){
            return state.vatTax
        }


        // totalBook(state){
        //     return state.bookList.length;
        // }

    },// as like computed:{}
    actions:{


        //method 1
        // addBook(content,data){
        //     content.commit('ADD_BOOK',data)
        // }
         //method 2
        // addBook({commit},data){
        //     commit('ADD_BOOK',data)
        // },
        //  removeBook({commit},data){
        //     commit('REMOVE_BOOK',data)
        // }

        //  getUser({commit},data){
        //     commit('GET_USERS',data)
        // }




    },// as like methods:{}

});



export default store;
