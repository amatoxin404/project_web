function upload() {

    var image=document.getElementById("img").files[0];

    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    var rand = 10;
    for ( var i = 0; i < rand; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }

    var storageRef = firebase.storage().ref('wisata/'+result);


    var uploadTask=storageRef.put(image);

    uploadTask.on('state_changed',function (snapshot) {

        var progress=(snapshot.bytesTransferred/snapshot.totalBytes)*100;
        console.log("upload is " + progress +" done");
    },function (error) {

        console.log(error.message);
    },function () {

        uploadTask.snapshot.ref.getDownloadURL().then(function (downlaodURL) {

            console.log(downlaodURL);
            if(downlaodURL) {
                document.getElementById("imgFake").value = "Upload Sukses";
                document.getElementById("imgName").value = downlaodURL;
            } else {
                document.getElementById("imgName").value = "Upload Gagal!";
                document.getElementById("imgName").value = "";
            }
        });
    });
}

function uploadBlog() {

    var image=document.getElementById("img").files[0];

    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    var rand = 10;
    for ( var i = 0; i < rand; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }

    var storageRef = firebase.storage().ref('blog/'+result);


    var uploadTask=storageRef.put(image);

    uploadTask.on('state_changed',function (snapshot) {

        var progress=(snapshot.bytesTransferred/snapshot.totalBytes)*100;
        console.log("upload is " + progress +" done");
    },function (error) {

        console.log(error.message);
    },function () {

        uploadTask.snapshot.ref.getDownloadURL().then(function (downlaodURL) {

            console.log(downlaodURL);
            if(downlaodURL) {
                document.getElementById("imgFake").value = "Upload Sukses";
                document.getElementById("imgName").value = downlaodURL;
            } else {
                document.getElementById("imgName").value = "Upload Gagal!";
                document.getElementById("imgName").value = "";
            }
        });
    });
}