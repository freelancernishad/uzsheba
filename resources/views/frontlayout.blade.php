<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="content-language" content="en">
  <meta name="keywords" content="website, blog, foo, bar">
  <meta name="author" content="John Doe">
  <meta name="publisher" content="John Doe">
  <meta name="copyright" content="John Doe">
  <meta name="description" content="This short description describes my website.">
  <meta name="page-topic" content="Media">
  <meta name="page-type" content="Blogging">
  <meta name="audience" content="Everyone">
  <meta name="robots" content="index, follow">

  <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>:: Welcome to Sechsheba Tetulia ::</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/bangladesh-govt.png') }}" />
    <!-- <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet" onload="if(media!=='all')media='all'"> -->
    <!-- CSS only -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?ver=1.0.0') }}">


    <script type="text/javascript" src="{{asset('assets/js/jquery-1.12.4.min.js')}}"></script>

<meta name="csrf-token"             ="{{ csrf_token() }}" />
	<link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">

<style>
*{
    --defaultColor: <?php  echo $uniounDetials->defaultColor ?>;
}

div#exampleModal {
    z-index: 99999;
}
.serviceBox {
    cursor: pointer;

}
.serviceBox:hover {
  /* transform: scale(1.1); */
  background: none !important;
  text-decoration: none !important;
  box-shadow: 0px 0px 17px -4px #000 !important;
}
a:hover {
  text-decoration: none !important;
}

.serviceBox {
  /* box-shadow: 0px 0px 15px -4px #000 !important; */
  background: #d7d7d7;
  padding: 13px 4px;
  height: 250px !important;
  transition: all 0.4s;
}
div#exampleModal {
            z-index: 99999;
        }

        .bbslider-wrapper.carousel {
            width: 1521px;
        }

        .prev-control-wrapper.control-wrapper {
            display: none;
        }

        .next-control-wrapper.control-wrapper {
            display: none;
        }

        .form_title {
    /* border-bottom: 2px solid #159513; */
    color: #ffffff;
    margin: 23px 0;
    background: #159513;
    padding: 9px 12px 1px 8px;
}

        #somitti {
            display: none;
        }

        #gosti {
            display: none;
        }

        .custom-file-label {
            position: absolute;
            top: 33px !important;
            right: 0;
            left: 14px !important;
            z-index: 1;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            overflow: hidden;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            width: 95% !important;
        }
</style>



<style type="text/css">

  .bbslider-wrapper.carousel {
    width: 1521px;
  }


.prev-control-wrapper.control-wrapper {
    display: none;
}

.next-control-wrapper.control-wrapper {
    display: none;
}
@media only screen and (max-width: 768px) {
    p.footerText {
    float: left !important;
    padding: 0px 0px 0 40px;
    margin-top: 18px;
    font-size: 13px !important;
}

p.help.text-right {
    display: flex;
    justify-content: flex-start !important;
    align-items: center;
    width: 100%;
    padding: 0 0 0 40px;
}


}

.middleHeaderItem.col-md-6.mb-3 {
    z-index: 1;
}


</style>


</head>

<body style="font-family: 'Kalpurush', sans-serif;">


    <div id="app">




        <component :is="$route.meta.layout || 'div'" >
            <router-view />
          </component>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


{{-- <script type="text/javascript" src="{{ asset('slider/js/jquery.bbslider.min.js') }}"></script> --}}

{{-- <script type="text/javascript">
  $(document).ready(function () {



    $('#auto').bbslider({auto: true, timer: 3000, controls: true, loop: true, pauseOnHit: false});




    $('#touch').bbslider({controls: false, touch: true, transition: 'slide', touchoffset: 50});

    $(window).resize(rsz);
    $(window).on('load', rsz);
  });
</script> --}}
{{-- <script src="assets/js/custom.js"></script> --}}





    <script src="{{ asset('js/frontend.js?ver=1.0.9') }}" async ></script>

<script>
    // function linkrun(linkdata){

    //     var link = document.createElement('link');
    //     link.setAttribute("rel", "stylesheet");
    //     link.setAttribute("type", "text/css");
    //     // link.onload = function(){ console.log('loaded'); }
    //     link.setAttribute("href", linkdata);
    //     document.getElementsByTagName("head")[0].appendChild(link);
    //     console.log('load')
    // }


    // linkrun('assets/css/pro.min.css');
    // linkrun('assets/css/style.css');


if ("{{ Auth::user() }}") {
    const storeToken = localStorage.getItem('token');


    if(!storeToken){

        let data = {'_token': "{{ csrf_token() }}"};
        fetch("/logout", {
  method: "POST",
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify(data)
}).then(res => {

});

        // axios.post('/logout').then(()=>{
        //     // window.location.href = '/'
        // })
    }


}else{
    // User.loggedOut()



		localStorage.removeItem('token')
		localStorage.removeItem('user')
		localStorage.removeItem('userid')
		localStorage.removeItem('role')
		localStorage.removeItem('position')




}

</script>



{{--


<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script  type="text/javascript">
    var firebaseConfig = {
    apiKey: "AIzaSyD_k0gk3nJNbiZm3xF4wSD1nMIT5jBDzDE",
    authDomain: "webpush2-cc9ed.firebaseapp.com",
    projectId: "webpush2-cc9ed",
    storageBucket: "webpush2-cc9ed.appspot.com",
    messagingSenderId: "16480631991",
    appId: "1:16480631991:web:db0e4adbad0ce8e475e132",
    measurementId: "G-DS86HSG4Y5"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");

                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);


			var myHeaders = new Headers();
			var requestOptions = {
			  method: 'GET',
			  headers: myHeaders,
			  redirect: 'follow'
			};
            // console.log(window.location.origin)
            var orgin = window.location.origin;
			fetch(orgin+"/api/set/notification?key="+token, requestOptions)
			  .then(response => response.text())
			  .then(result => console.log(result))
			  .catch(error => console.log('error', error));


               // document.getElementById("token").innerHTML=token;
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
				//alert(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>
 --}}





</body>
</html>
