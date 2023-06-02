import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            numbers: {
                0: "০",
                1: "১",
                2: "২",
                3: "৩",
                4: "৪",
                5: "৫",
                6: "৬",
                7: "৭",
                8: "৮",
                9: "৯",
              }
        }
    },

    methods: {
        async callApi(method, url, dataObj ){
            try {
              return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
            } catch (e) {
                return e.response
            }
        },



        dateformatGlobal(date=''){
           return  User.dateformat(date);
        },


        changeName(value){
            if(value=='admin'){
                return 'এডমিন';
            }else if(value=='chairman'){
                return 'উপজেলা চেয়ারম্যান';
            }else if(value=='sub_admin'){
                return 'দায়িত্ব প্রাপ্ত প্রকৌশলী';
            }
        },






         getMonthFromString(mon){
            return new Date(Date.parse(mon +" 10, 2022")).getMonth()+1
         },
        // int_en_to_bn(input=0){
        //     var output = [];
        //     for (var i = 0; i < input.length; ++i) {
        //       if (numbers.hasOwnProperty(input[i])) {
        //         output.push(numbers[input[i]]);
        //       } else {
        //         output.push(input[i]);
        //       }
        //     }
        //     return output.join('');

        // },


        int_en_to_bn(text=0) {
            var result;
            if (text == '0') {
                result = '০';
            } else if (text == '1') {
                result = '১';
            } else if (text == '2') {
                result = '২';
            } else if (text == '3') {
                result = '৩';
            } else if (text == '4') {
                result = '৪';
            } else if (text == '5') {
                result = '৫';
            } else if (text == '6') {
                result = '৬';
            } else if (text == '7') {
                result = '৭';
            } else if (text == '8') {
                result = '৮';
            } else if (text == '9') {
                result = '৯';
            }
            return result;
        },





        checkUserPermission(key){
            if(!this.userPermission) return true
            let isPermitted = false;
            for(let d of this.userPermission){
                if(this.$route.name==d.name){
                    if(d[key]){
                        isPermitted = true
                        break;
                    }else{
                        break
                    }
                }

            }
            return isPermitted
            // return this.$route.name;
        }

    },
    computed: {



        ...mapGetters({
            'SonodName' : 'getUpdateSonodName',
            'SonodNames' : 'getUpdateSonodNames',
            'Users' : 'getUpdateUser',
            // 'userPermission' : 'getUserPermission',
            // 'getUserRoles' : 'getUserRoles',
            'getUnions' : 'getUnions',
            'getType' : 'getType',
            'getUnion' : 'getUnion',
            'getunionInfos' : 'getunionInfos',
            'getvatTax' : 'getvatTax',
        }),

        getUsers(){
            return this.$store.getters.getUpdateUser;

        },

        // isReadPermitted(){
        //     return this.checkUserPermission('read')
        //  },
        //  isWritePermitted(){
        //      return this.checkUserPermission('write')
        //  },
        //  isUpdatePermitted(){
        //      return this.checkUserPermission('update')
        //  },
        //  isDeletePermitted(){
        //      return this.checkUserPermission('delete')
        //  },

    },




}
