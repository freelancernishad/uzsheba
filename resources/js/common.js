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
    watch: {
        '$route':  {
            handler(newValue, oldValue) {

                localStorage.setItem('unioun',this.getUsers.unioun)

            },
        deep: true
        }
    },
    methods: {


         formatBengaliDateTime(dateTime) {
            const dateParts = dateTime.split(' ')[0].split('-');
            const timeParts = dateTime.split(' ')[1].split(':');

            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];

            const hour = parseInt(timeParts[0], 10);
            const minute = parseInt(timeParts[1], 10);

            const bengaliMonths = [
                "জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল",
                "মে", "জুন", "জুলাই", "আগস্ট",
                "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর"
            ];

            const period = hour >= 5 && hour < 12 ? 'সকাল' :
                           hour >= 12 && hour < 17 ? 'দুপুর' :
                           hour >= 17 && hour < 20 ? 'বিকাল' : 'রাত';

            const bengaliHour = hour % 12 === 0 ? 12 : hour % 12;
            const bengaliMinute = minute;

            const formattedTime = `${period} ${this.int_en_to_bn(bengaliHour)}টা ${this.int_en_to_bn(bengaliMinute)} মিনিট`;
            const formattedDate = `${this.int_en_to_bn(day)}/${this.int_en_to_bn(month)}/${this.int_en_to_bn(year)}`;

            return `${formattedDate} ${formattedTime}`;
        },

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
            }else if(value=='uno'){
                return 'উপজেলা নির্বাহী অফিসার';
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


         int_en_to_bn(text) {
            const enToBn = {
                '0': '০',
                '1': '১',
                '2': '২',
                '3': '৩',
                '4': '৪',
                '5': '৫',
                '6': '৬',
                '7': '৭',
                '8': '৮',
                '9': '৯'
            };
            return text.toString().split('').map(char => enToBn[char] || char).join('');
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
