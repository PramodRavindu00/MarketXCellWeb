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


let percentVal;
let fileItem;
let fileName;


function uploadProductImage(e){
  fileItem = e.target.files[0];
  fileName = fileItem.name;
  let storageRef = firebase.storage().ref("productIMG/"+fileName);
  let uploadTask = storageRef.put(fileItem);

  uploadTask.on("state_changed",(snapshot)=>{
    console.log(snapshot);
    document.querySelector('#loadingIMG').className = "";
    document.querySelector('#submitbtn').className = "hidden";
  },(error)=>{
    console.log("Error is ", error);
    },()=>{
      uploadTask.snapshot.ref.getDownloadURL().then((url)=>{
        console.log("URL",url);
        document.querySelector('#imgURL').value = url;
        document.querySelector('#loadingIMG').className = "hidden";
        document.querySelector('#submitbtn').className = "";
      })
    })
}

function uploadCategoryImage(e){
  fileItem = e.target.files[0];
  fileName = fileItem.name;
  let storageRef = firebase.storage().ref("categoryIMG/"+fileName);
  let uploadTask = storageRef.put(fileItem);

  uploadTask.on("state_changed",(snapshot)=>{
    console.log(snapshot);
    document.querySelector('#loadingIMG').className = "";
    document.querySelector('#submitbtn').className = "hidden";
  },(error)=>{
    console.log("Error is ", error);
    },()=>{
      uploadTask.snapshot.ref.getDownloadURL().then((url)=>{
        console.log("URL",url);
        document.querySelector('#imgURL').value = url;
        document.querySelector('#loadingIMG').className = "hidden";
        document.querySelector('#submitbtn').className = "";
        return true;
      })
    })
}

function uploadProfilePicture(e){
  fileItem = e.target.files[0];
  fileName = fileItem.name;
  let storageRef = firebase.storage().ref("companyuserIMG/"+fileName);
  let uploadTask = storageRef.put(fileItem);

  uploadTask.on("state_changed",(snapshot)=>{
    console.log(snapshot);
    document.querySelector('#loadingIMG').className = "";
    document.querySelector('#submitbtn').className = "hidden";
  },(error)=>{
    console.log("Error is ", error);
    },()=>{
      uploadTask.snapshot.ref.getDownloadURL().then((url)=>{
        console.log("URL",url);
        document.querySelector('#imgURL').value = url;
        document.querySelector('#loadingIMG').className = "hidden";
        document.querySelector('#submitbtn').className = "";
        return true;
      })
    })
}