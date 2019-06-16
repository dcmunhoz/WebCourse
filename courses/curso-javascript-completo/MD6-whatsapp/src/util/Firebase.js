const firebase = require('firebase');
require('firebase/firestore');

export class Firebase {

    constructor(){

        this._firebaseConfig = {
            apiKey: "AIzaSyAERNTNhtQZMxT0lQiJEcbgWekDg0AKgFk",
            authDomain: "whatsapp-clone-8b980.firebaseapp.com",
            databaseURL: "https://whatsapp-clone-8b980.firebaseio.com",
            projectId: "whatsapp-clone-8b980",
            storageBucket: "gs://whatsapp-clone-8b980.appspot.com/",
            messagingSenderId: "504374433415",
            appId: "1:504374433415:web:783f4689ccb1cc3e"
        };

        this.init();

    }

    init(){

        if (!window._initializedFirebase) {

            // Initialize Firebase
            firebase.initializeApp(this._firebaseConfig);

            // firebase.firestore().settings({
            //     timestampsInSnapshots: true
            // });

            window._initializedFirebase = true;

        }

    }

    initAuth(){

        return new Promise((s, f)=>{

            let provider = new firebase.auth.GoogleAuthProvider();
            firebase.auth().signInWithPopup(provider).then(result=>{

                let token = result.credential.accessToken;
                let user  = result.user;

                s({
                    user,
                    token
                });

            }).catch(err=>{
                f(err);
            });

        });

    }

    static db(){

        return firebase.firestore();

    }

    static hd(){
        
        return firebase.storage();

    }

}