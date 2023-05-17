<template>
    <div>
        <div id="qrcamera"></div>

    </div>
</template>

<script>

import {Html5QrcodeScanner} from "html5-qrcode"
import {Html5Qrcode} from "html5-qrcode"
export default {

    data() {
        return {
            qrbox:250,
            fps:10,
            scannedResult: null,
            scanner: null,
        }
    },
    mounted () {
    const config = {
      fps: this.fps,
      qrbox: this.qrbox,
    };

    this.scanner = new Html5QrcodeScanner('qrcamera', config);

// This method will trigger user permissions
Html5Qrcode.getCameras().then(devices => {
    console.log(devices)
  if (devices && devices.length) {
    var cameraId = devices[0].id;

  }
}).catch(err => {
});

    this.scanner.render(this.onScanSuccess);
  },


    methods: {

    onScanSuccess (decodedText, decodedResult) {
        console.log(decodedText)

        // http://localhost:8000/tika/verify/7461677568790

        var textSplit = decodedText.split("verify");


        if(textSplit.length==2){
            var textSplitId = textSplit[1].split("/");

            if(textSplitId.length==2){
                var id_no = textSplitId[1];
                if(id_no==''){
                    id_no = '1122'
                }
                this.tikaCreate(id_no);
                this.scanner.pause(true, true);
            }
            // else{
            //     Notification.customError2('সঠিক কিউআর কোড স্ক্যান করুন');
            //     this.scanner.render(this.onScanSuccess);
            //     this.scanner.pause(true, true);
            // }

        }
        // else{
        //     Notification.customError2('সঠিক কিউআর কোড স্ক্যান করুন');
        //     this.scanner.render(this.onScanSuccess);
        //     this.scanner.pause(true, true);
        // }




    //   this.scanner.resume();
    },

    async tikaCreate(id_no=112233){
        var res = await this.callApi('post',`/api/get/data/${id_no}`);

        if(res.data){
            this.$router.push({ name: 'Vaccination', params:{id:res.data.id} })
        }else{
            Notification.customError2('কোনো তথ্য খুজে পাওয়া যায়নি');
            window.location.reload();
            // this.scanner.render(this.onScanSuccess);
        }
        // console.log(res)
    }




  },

  beforeDestroy() {
    if (this.scanner) {
      this.scanner.clear(); // clear the scanner
    }
  },


}
</script>


