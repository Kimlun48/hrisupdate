@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('firebase.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>

var firebaseConfig = {
  apiKey: "AIzaSyDej99zkPzNOwxneXzS9op7_1yDhvU-Z-8",
  authDomain: "laravel-firebase-demo-8232d.firebaseapp.com",
  databaseURL: "https://laravel-firebase-demo-8232d-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "laravel-firebase-demo-8232d",
  storageBucket: "laravel-firebase-demo-8232d.appspot.com",
  messagingSenderId: "581079552692",
  appId: "1:581079552692:web:09765c8e846961e65d7de1",
  measurementId: "G-GQXPE9M25S"


        //apiKey: "XXXXXXXXXXX",
        //authDomain: "XXXXXXXX",
        //projectId: "XXXXXXXX",
        //storageBucket: "XXXXXXXXXX",
        //messagingSenderId: "XXXXXXXXX",
        //appId: "XXXXXXXXXXXXX",
        //measurementId: "G-XXXXX"
    };


    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("firebase.save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });

            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });

</script>
@endsection
