const firebaseConfig = {
  apiKey: "AIzaSyCfjgTolvqvyrwH2EXXA9qe726q-Oynr7k",
  authDomain: "marketxcell-a2edb.firebaseapp.com",
  databaseURL: "https://marketxcell-a2edb-default-rtdb.firebaseio.com",
  projectId: "marketxcell-a2edb",
  storageBucket: "marketxcell-a2edb.appspot.com",
  messagingSenderId: "848226701504",
  appId: "1:848226701504:web:febd510680462449191d25",
  measurementId: "G-CRHN8Q2C21"
};

firebase.initializeApp(firebaseConfig);

var fileText = document.querySelector(".fileText");
var uploadPercentage = document.querySelector(".uploadPercentage");
var progress = document.querySelector(".progrees");
var percentVal;
var fileItem;
var fileName;


function getFile(e){
  fileItem = e.target.files[0];
  fileName = fileItem.name;
  fileText.innerHTML = fileName;
}

function uploadImage() {
  let storageRef = firebase.storage().ref("images/"+fileName);
  let uploadTask = storageRef.put(fileItem);

  uploadTask.on("state_changed",(snapshot)=>{
    console.log(snapshot);
    percentVal = Math.floor((snapshot.bytesTransferred/snapshot.totalBytes*100));
    console.log(percentVal);
    uploadPercentage.innerHTML = percentVal+"%";
    progress.style.width=percentVal+"%";
  },(error)=>{
    console.log("Error is ", error);
    },()=>{
      uploadTask.snapshot.ref.getDownloadURL().then((url)=>{
        console.log("URL",url);
      })
    })
}